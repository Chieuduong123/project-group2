import { defineStore } from "pinia";
import {
  fetchCreateRecommend,
  fetchEditProfile,
  fetchForgotPassword,
  fetchGetPostRecommend,
  fetchGetRecommend,
  fetchLogin,
  fetchLogout,
  fetchRegister,
  fetchUpdateRecommend,
  getInforMe,
} from "../api/userApi";
import { fetchCreateApply, fetchHistoryApply } from "../api/applyApi";
import {
  fetchCreateCV,
  fetchDeleteCV,
  fetchGetCV,
  fetchGetCVById,
  fetchUpdateCV,
} from "../api/cvApi";

export const useUserStore = defineStore("userStore", {
  state: () => {
    return {
      users: [],
      user: {},
      myUser: {},
      histories: [],
      listCV: [],
      cv: {},
      recommend: [],
      accessToken: "" || localStorage.getItem("token"),
      isLogged: JSON.parse(localStorage.getItem("isLogged")) || false,
      isLoading: false,
    };
  },
  actions: {
    actRegisterUser(payload) {
      try {
        this.isLoading = true;
        fetchRegister(payload).then(() => {
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    async actLoginUser(user) {
      try {
        this.isLoading = true;
        const data = await fetchLogin(user);
        if (data) {
          this.isLoading = false;
          this.accessToken = data?.data.token;
          localStorage.setItem("token", data?.data.token);
          localStorage.setItem("isLogged", JSON.stringify(true));
          this.myUser = data.data.seeker;
          this.isLogged = true;
        }
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    actFetchReLogin(accessToken) {
      try {
        this.isLoading = true;
        if (accessToken) {
          getInforMe(accessToken).then((res) => {
            this.isLoading = false;
            this.myUser = res?.data?.seeker;
            this.isLogged = true;
          });
        }
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    actFetchLogout(token) {
      try {
        this.isLogged = false;
        fetchLogout(token).then(() => {
          this.isLoading = false;
          localStorage.setItem("token", "");
          localStorage.setItem("isLogged", JSON.stringify(false));
          this.myUser = {};
          this.isLogged = false;
        });
      } catch (error) {
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    actEditProfile(profile, token) {
      try {
        this.isLoading = true;
        fetchEditProfile(profile, token).then((res) => {
          this.isLoading = false;
          this.actFetchReLogin(token);
        });
      } catch (error) {
        this.isLoading = true;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },

    actApplyJob(idJob, apply, token) {
      try {
        this.isLoading = true;
        fetchCreateApply(idJob, apply, token).then((res) => {
          this.isLoading = false;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actGetHistoryApply(token) {
      try {
        this.isLoading = true;
        fetchHistoryApply(token).then((res) => {
          this.isLoading = false;
          this.histories = res?.data?.application_history;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actGetCV(token) {
      try {
        this.isLoading = true;
        fetchGetCV(token).then((res) => {
          this.isLoading = false;
          this.listCV = res?.data.CV;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actGetCVById(id, token) {
      try {
        this.isLoading = true;
        fetchGetCVById(id, token).then((res) => {
          this.isLoading = false;
          this.cv = res?.data.CV[0];
          console.log("store", this.cv);
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actCreateCV(cv, token) {
      try {
        this.isLoading = true;
        fetchCreateCV(cv, token).then((res) => {
          console.log("cretae", res);
          this.isLoading = false;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      }
    },
    actDeleteCV(id, token) {
      try {
        this.isLoading = true;
        fetchDeleteCV(id, token).then((res) => {
          this.actGetCV(token);
          this.isLoading = false;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actUpdateCV(id, cv, token) {
      try {
        this.isLoading = true;
        fetchUpdateCV(id, cv, token).then((res) => {
          this.actGetCVById(id);
          this.isLoading = false;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actGetRecommend(token) {
      try {
        this.isLoading = true;
        fetchGetRecommend(token).then((res) => {
          console.log("get recommend", res.data[0]);
          this.recommend = res.data[0];
          this.isLoading = false;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actCreateRecommend(payload, token) {
      try {
        this.isLoading = true;
        fetchCreateRecommend(payload, token).then((res) => {
          console.log("create recommend", res);
          this.isLoading = false;
          this.actGetRecommend(token);
          this.actGetPostRecommend(token);
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actUpdateRecommend(idRecommend, payload, token) {
      try {
        this.isLoading = true;
        fetchUpdateRecommend(idRecommend, payload, token).then((res) => {
          console.log("update recommend", res);
          this.isLoading = false;
          this.actGetPostRecommend(token);
          this.actGetRecommend(token);
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      } finally {
        this.isLoading = false;
      }
    },
    actGetPostRecommend(token) {
      try {
        this.isLoading = true;
        fetchGetPostRecommend(token).then((res) => {
          this.recommend = res?.data?.matching_jobs;
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    actForgotPassword(email) {
      try {
        this.isLoading = true;
        fetchForgotPassword(email).then((res) => {
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
  },
  getters: {},
});

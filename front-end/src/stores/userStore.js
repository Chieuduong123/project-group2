import { defineStore } from "pinia";
import {
  fetchEditProfile,
  fetchLogin,
  fetchLogout,
  fetchRegister,
  getInforMe,
} from "../api/userApi";
import { fetchCreateApply, fetchHistoryApply } from "../api/applyApi";
import {
  fetchCreateCV,
  fetchDeleteCV,
  fetchGetCV,
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
      }
    },
    actGetCV(token) {
      try {
        this.isLoading = true;
        fetchGetCV(token).then((res) => {
          this.isLoading = false;
          this.listCV = res?.data;
        });
      } catch (error) {
        console.log(error);
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
          console.log("cretae", res);
          this.isLoading = false;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      }
    },
    actUpdateCV(id, cv, token) {
      try {
        this.isLoading = true;
        fetchUpdateCV(id, cv, token).then((res) => {
          console.log("cretae", res);
          this.isLoading = false;
        });
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      }
    },
  },
  getters: {},
});

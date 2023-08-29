import { defineStore } from "pinia";
import {
  fetchEditProfile,
  fetchLogin,
  fetchLogout,
  fetchRegister,
  getInforMe,
} from "../api/userApi";

export const useUserStore = defineStore("userStore", {
  state: () => {
    return {
      users: [],
      user: {},
      myUser: {},
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
        fetchLogout(token).then(() => {
          this.isLoading = false;
          localStorage.removeItem("token");
          localStorage.removeItem("isLogged");
          this.myUser = {};
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
  },
  getters: {},
});

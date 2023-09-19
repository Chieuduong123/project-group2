import { defineStore } from "pinia";
import { fetchEditProfile, fetchLogout, getInforMe } from "../api/userApi";
import {
  fetchGetAllBusiness,
  fetchGetBusinessById,
  fetchLoginBusiness,
  fetchLogoutBusiness,
  fetchRegisterBusiness,
  fetchUpdateBusiness,
  getInforBusiness,
} from "../api/businessApi";
import { fetchGetApplyByBusiness, fetchGetApplyById } from "../api/applyApi";

export const useBusinessStore = defineStore("businessStore", {
  state: () => {
    return {
      businesses: [],
      business: {},
      myBusiness: {},
      applyList: [],
      apply: [],
      accessToken: "" || localStorage.getItem("tokenBusiness"),
      isLoggedBusiness:
        JSON.parse(localStorage.getItem("isLoggedBusiness")) || false,
      isLoading: false,
    };
  },
  actions: {
    actRegisterBusiness(payload) {
      try {
        this.isLoading = true;
        fetchRegisterBusiness(payload).then(() => {
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    async actLoginBusiness(business) {
      try {
        this.isLoading = true;
        const data = await fetchLoginBusiness(business);
        if (data) {
          this.isLoading = false;
          this.accessToken = data?.data.token;
          localStorage.setItem("tokenBusiness", data?.data.token);
          localStorage.setItem("isLoggedBusiness", JSON.stringify(true));
          this.myBusiness = data.data.seeker;
          this.isLoggedBusiness = true;
        }
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    actFetchReLoginBusiness(accessToken) {
      try {
        this.isLoading = true;
        if (accessToken) {
          getInforBusiness(accessToken).then((res) => {
            this.isLoading = false;
            this.myBusiness = res.data.business;
            localStorage.setItem("isLoggedBusiness", JSON.stringify(true));
            this.isLoggedBusiness = true;
          });
        }
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actFetchLogoutBusiness(token) {
      try {
        this.isLoading = true;
        this.isLoggedBusiness = false;
        localStorage.setItem("tokenBusiness", "");
        localStorage.setItem("isLoggedBusiness", JSON.stringify(false));
        this.isLoggedBusiness = false;
        this.accessToken = "";
        this.myBusiness = {};
        fetchLogoutBusiness(token).then(() => {
          this.isLoading = false;
          localStorage.setItem("tokenBusiness", "");
          localStorage.setItem("isLoggedBusiness", JSON.stringify(false));
          this.isLoggedBusiness = false;
          this.accessToken = "";
          this.myBusiness = {};
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actEditProfile(profile, token) {
      try {
        this.isLoading = true;
        fetchUpdateBusiness(profile, token).then((res) => {
          this.isLoading = false;
          this.actFetchReLoginBusiness(token);
          console.log("resp", res);
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetAllBusiness() {
      try {
        this.isLoading = true;
        fetchGetAllBusiness().then((res) => {
          this.isLoading = false;
          this.businesses = res?.data;
          console.log("====", res.data);
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetBusinessById(id) {
      try {
        this.isLoading = true;
        fetchGetBusinessById(id).then((res) => {
          this.isLoading = false;
          console.log("====", res.data);
          this.business = res.data;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      } finally {
        this.isLoading = false;
      }
    },
    actGetApplyList(token) {
      try {
        this.isLoading = true;
        fetchGetApplyByBusiness(token).then((res) => {
          this.isLoading = false;
          this.applyList = res.data?.applications;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetApplyById(applyId, token) {
      try {
        this.isLoading = true;
        fetchGetApplyById(applyId, token).then((res) => {
          this.isLoading = false;
          this.apply = res.data.application[0];
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
  },
  getters: {},
});

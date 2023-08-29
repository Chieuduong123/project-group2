import { defineStore } from "pinia";
import { fetchEditProfile, fetchLogout, getInforMe } from "../api/userApi";
import {
  fetchGetAllBusiness,
  fetchGetBusinessById,
  fetchLoginBusiness,
  fetchLogoutBusiness,
  fetchRegisterBusiness,
  getInforBusiness,
} from "../api/businessApi";

export const useBusinessStore = defineStore("businessStore", {
  state: () => {
    return {
      businesses: [],
      business: {},
      myBusiness: {},
      accessToken: "" || localStorage.getItem("token"),
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
          localStorage.setItem("token", data?.data.token);
          localStorage.setItem("isLoggedBusiness", JSON.stringify(true));
          this.myBusiness = data.data.seeker;
          this.isLogged = true;
          console.log("===", data);
        }
        console.log("business", data);
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actFetchReLoginBusiness(accessToken) {
      try {
        this.isLoading = true;
        if (accessToken) {
          getInforBusiness(accessToken).then((res) => {
            this.isLoading = false;
            // this.myBusiness = res.data.seeker;
            // localStorage.setItem("isLoggedBusiness", JSON.stringify(true));
            // this.isLogged = true;
            console.log("res business", res);
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
        fetchLogoutBusiness(token).then(() => {
          this.isLoading = false;
          localStorage.removeItem("token");
          localStorage.removeItem("isLoggedBusiness");
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actEditProfile(profile, token) {
      try {
        this.isLoading = true;
        fetchEditProfile(profile, token).then((res) => {
          this.isLoading = false;

          console.log("resp", res);
        });
      } catch (error) {
        this.isLoading = true;
        console.log(error);
      }
    },
    actGetAllBusiness() {
      try {
        this.isLoading = true;
        fetchGetAllBusiness().then((res) => {
          this.isLoading = false;
          console.log("businesses", res);
          this.businesses = res?.data;
        });
      } catch (error) {
        this.isLoading = true;
        console.log(error);
      }
    },
    actGetBusinessById(id) {
      try {
        this.isLoading = true;
        fetchGetBusinessById(id).then((res) => {
          this.isLoading = false;

          this.business = res.data;
        });
      } catch (error) {
        this.isLoading = true;
        console.log(error);
      }
    },
  },
  getters: {},
});

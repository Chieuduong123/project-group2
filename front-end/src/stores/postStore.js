import { defineStore } from "pinia";
import {
  fetchCreatePost,
  fetchDeletePost,
  fetchGetAllPost,
  fetchGetPostByIdBusiness,
  fetchPostById,
  fetchSearch,
  fetchUpdatePost,
} from "../api/postApi";

export const usePostStore = defineStore("postStore", {
  state: () => {
    return {
      posts: [],
      post: {},
      isLoading: false,
      itemsPerPage: 6,
      totalPages: 1,
      currentPage: 1,
    };
  },
  actions: {
    actGetAllPost() {
      try {
        this.isLoading = true;
        fetchGetAllPost().then((res) => {
          this.isLoading = false;
          this.posts = res?.data;
          console.log("res", res);
          this.totalPages = Math.ceil(res.data.length / this.itemsPerPage);
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetPostById(id) {
      try {
        this.isLoading = true;
        fetchPostById(id).then((res) => {
          this.isLoading = false;
          this.post = res.data;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetPostByIdBusiness(id) {
      try {
        this.isLoading = true;
        fetchGetPostByIdBusiness(id).then((res) => {
          this.isLoading = false;
          this.posts = res.data;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actCreatePost(post) {
      try {
        this.isLoading = true;
        fetchCreatePost(post).then((res) => {
          console.log(res);
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actDeletePost(id) {
      try {
        this.isLoading = true;
        fetchDeletePost(id).then((res) => {
          console.log(res);
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actUpdatePost(id, newPost) {
      try {
        this.isLoading = true;
        fetchUpdatePost(id, newPost).then((res) => {
          console.log(res);
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actSearchPost(position, level, location) {
      try {
        this.isLoading = true;
        fetchSearch(position, level, location).then((res) => {
          this.isLoading = false;
          console.log(res);
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
  },
  getters: {},
});

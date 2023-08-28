import { defineStore } from "pinia";
import { fetchGetAllPost, fetchPostById } from "../api/postApi";

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
          this.posts = res.data;
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
  },
  getters: {},
});

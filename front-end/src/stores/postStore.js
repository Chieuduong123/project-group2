import { defineStore } from "pinia";
import {
  fetchCreateFavorite,
  fetchCreatePost,
  fetchDeleteFavorite,
  fetchDeletePost,
  fetchFavoritePost,
  fetchGetAllPost,
  fetchGetPostByIdBusiness,
  fetchGetTopPost,
  fetchPostById,
  fetchPostByIdBusiness,
  fetchPostByTokenBusiness,
  fetchSearch,
  fetchUpdatePost,
} from "../api/postApi";

export const usePostStore = defineStore("postStore", {
  state: () => {
    return {
      posts: [],
      topPosts: [],
      post: {},
      postCompany: [],
      favorites: [],
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
          this.totalPages = Math.ceil(res.data.length / this.itemsPerPage);
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetTopPost() {
      try {
        this.isLoading = true;
        fetchGetTopPost().then((res) => {
          this.isLoading = false;
          this.topPosts = res?.data.jobs;
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
    actGetPostByTokenBusiness(token) {
      try {
        this.isLoading = true;
        fetchPostByTokenBusiness(token).then((res) => {
          this.isLoading = false;
          this.posts = res.data.jobs;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetPostByIdBusiness(id) {
      try {
        this.isLoading = true;
        fetchPostByIdBusiness(id).then((res) => {
          this.isLoading = false;
          this.postCompany = res.data;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actCreatePost(post, token) {
      try {
        this.isLoading = true;
        fetchCreatePost(post, token).then(() => {
          this.actGetPostByTokenBusiness(token);
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actDeletePost(id, token) {
      try {
        this.isLoading = true;
        fetchDeletePost(id, token).then((res) => {
          console.log(res);
          this.actGetPostByTokenBusiness(token);
          this.isLoading = false;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actUpdatePost(id, newPost, token) {
      try {
        this.isLoading = true;
        fetchUpdatePost(id, newPost, token).then((res) => {
          console.log(res);
          this.actGetPostByTokenBusiness(token);
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
          this.posts = res.data.data;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actAddFavorite(id, token) {
      try {
        this.isLoading = true;
        fetchCreateFavorite(id, token).then((res) => {
          this.isLoading = false;
          this.actGetFavorite(token);
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actGetFavorite(token) {
      try {
        this.isLoading = true;
        fetchFavoritePost(token).then((res) => {
          this.isLoading = false;
          this.favorites = res.data.favorite_jobs;
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
    actRemoveFavorite(id, token) {
      try {
        this.isLoading = true;
        fetchDeleteFavorite(id, token).then(() => {
          this.isLoading = false;
          this.actGetFavorite(token);
        });
      } catch (error) {
        this.isLoading = false;
        console.log(error);
      }
    },
  },
  getters: {},
});

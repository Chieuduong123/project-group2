import axios from "axios";
import { BASE_URL } from "../constants/url";
import { useToast } from "vue-toastification";

const toast = useToast();
export const fetchGetAllPost = async () => {
  try {
    const data = await axios.get(`${BASE_URL}job`);
    return data;
  } catch (error) {
    console.log(error);
  }
};
export const fetchGetTopPost = async () => {
  try {
    const data = await axios.get(`${BASE_URL}job/highest`);
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchPostById = async (id) => {
  try {
    const data = await axios.get(`${BASE_URL}job/${id}`);
    console.log("daa", data);
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchGetPostByIdBusiness = (id) => {
  try {
    const data = axios.get(`${BASE_URL}business/job/${id}`);
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchCreatePost = async (post, token) => {
  try {
    console.log("create post", post, token);
    const data = await axios.post(`${BASE_URL}v1/job`, post, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    });
    if (data) {
      toast.success("Đăng bài thành công");
    }
    return data;
  } catch (error) {
    console.log(error);
  }
};
export const fetchPostByIdBusiness = async (id) => {
  try {
    const data = await axios.get(`${BASE_URL}job/business/${id}`);
    return data;
  } catch (error) {
    console.log(error);
  }
};
export const fetchPostByTokenBusiness = async (token) => {
  try {
    const data = await axios.get(`${BASE_URL}v1/job`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json",
        "Content-Type": "application/json",
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchDeletePost = async (id, token) => {
  try {
    const data = await axios.delete(`${BASE_URL}v1/job/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    toast.success("Xoá bài thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchUpdatePost = async (id, newPost, token) => {
  try {
    const data = await axios.post(`${BASE_URL}v1/job/${id}`, newPost, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    toast.success("Cập nhật bài thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchSearch = async (position, level, location) => {
  try {
    const data = await axios.get(
      `${BASE_URL}search?position=${position}&level=${level}&location=${location}`
    );
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchFavoritePost = async (token) => {
  try {
    const data = await axios.get(`${BASE_URL}seeker/favorites`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchCreateFavorite = async (id, token) => {
  try {
    const data = await axios.put(`${BASE_URL}seeker/favorites/${id}`, null, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (data) {
      toast.success("Thêm thành công");
    }
    return data;
  } catch (error) {
    if (error.response.status == 403) {
      toast.warning("Bài này đã có trong danh sách lưu!");
    }
    console.log(error);
  }
};

export const fetchDeleteFavorite = async (id, token) => {
  try {
    const data = await axios.delete(`${BASE_URL}seeker/favorites/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (data) {
      toast.success("Xoá thành công");
    }
    return data;
  } catch (error) {
    console.log(error);
  }
};

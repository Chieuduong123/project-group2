import axios from "axios";
import { BASE_URL } from "../constants/url";
import { useToast } from "vue-toastification";

const toast = useToast();
export const fetchCreateCV = async (cv, token) => {
  try {
    const data = axios.post(`${BASE_URL}seeker/cv`, cv, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    toast.success("Đã lưu");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchGetCV = async (token) => {
  try {
    const data = axios.get(`${BASE_URL}seeker/cv`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};
export const fetchGetCVById = async (id, token) => {
  try {
    const data = axios.get(`${BASE_URL}seeker/cv/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchDeleteCV = async (id, token) => {
  try {
    const data = axios.delete(`${BASE_URL}seeker/cv/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    toast.success("Xoá thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchUpdateCV = async (id, payload, token) => {
  try {
    const data = axios.put(`${BASE_URL}seeker/cv/${id}`, payload, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    toast.success("Đã lưu");
    return data;
  } catch (error) {
    console.log(error);
  }
};

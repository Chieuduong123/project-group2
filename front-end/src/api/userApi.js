import axios from "axios";
import { useToast } from "vue-toastification";
import { BASE_URL } from "../constants/url";
const toast = useToast();
export const fetchRegister = async (payload) => {
  try {
    const data = await axios.post(`${BASE_URL}seeker/register`, payload);
    toast.success("Đăng ký thành công");
    return data;
  } catch (error) {
    toast.warning("Email này đã tồn tại");
    console.log(error);
  }
};

export const fetchLogin = async (user) => {
  try {
    const data = await axios.post(`${BASE_URL}seeker/login`, user);
    toast.success("Đăng nhập thành công");
    return data;
  } catch (error) {
    if (error.response.status === 401) {
      toast.warning("Tài khoản hoặc mật khẩu không chính xác");
    }
    console.log(error);
  }
};

export const getInforMe = async (token) => {
  try {
    const data = await axios.get(`${BASE_URL}seeker/profile`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchLogout = async (token) => {
  try {
    const data = await axios.post(`${BASE_URL}seeker/logout`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchEditProfile = async (profile, token) => {
  try {
    console.log("bên này", profile);
    const data = await axios.post(`${BASE_URL}seeker/profile`, profile, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "multipart/form-data",
      },
      credentials: "same-origin",
    });
    toast.success("Cập nhận thông tin thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

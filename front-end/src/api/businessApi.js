import axios from "axios";
import { useToast } from "vue-toastification";
import { BASE_URL } from "../constants/url";
const toast = useToast();
export const fetchRegisterBusiness = async (payload) => {
  try {
    const data = await axios.post(`${BASE_URL}business/register`, payload);
    toast.success("Đăng ký thành công, vui lòng đợi admin duyệt");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchLoginBusiness = async (business) => {
  try {
    const data = await axios.post(`${BASE_URL}business/login`, business);
    toast.success("Đăng nhập thành công");
    return data;
  } catch (error) {
    if (error.response.status === 401 || 422) {
      toast.warning("Tài khoản hoặc mật khẩu không chính xác");
    }
    console.log(error);
  }
};

export const getInforBusiness = async (token) => {
  try {
    const data = await axios.get(`${BASE_URL}v1/profile`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchLogoutBusiness = async (token) => {
  try {
    const data = await axios.post(`${BASE_URL}v1/logout`, null, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    toast.success("Đăng xuất thành công");
    return data;
  } catch (error) {
    console.log(error);
    toast.warning("error");
  }
};

export const fetchGetAllBusiness = async () => {
  try {
    const data = await axios.get(`${BASE_URL}business`);
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchGetBusinessById = async (id) => {
  try {
    const data = await axios.get(`${BASE_URL}business/${id}`);
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchUpdateBusiness = async (profile, token) => {
  try {
    const data = await axios.post(`${BASE_URL}v1/profile`, profile, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "multipart/form-data",
      },
    });
    toast.success("Cập nhật thông tin thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

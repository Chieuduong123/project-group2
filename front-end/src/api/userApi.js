import axios from "axios";
import { useToast } from "vue-toastification";
const toast = useToast();
export const fetchRegister = async (payload) => {
  try {
    const data = await axios.post(
      `http://localhost:8000/back-end-juong-job/public/api/seeker/register`,
      payload
    );
    toast.success("Đăng ký thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchLogin = async (user) => {
  try {
    const data = await axios.post(
      `http://localhost:8000/back-end-juong-job/public/api/seeker/login`,
      user
    );
    toast.success("Đăng nhập thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const getInforMe = async (token) => {
  try {
    const data = await axios.get(
      `http://localhost:8000/back-end-juong-job/public/api/seeker/profile`,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchLogout = async () => {
  try {
    const data = await axios.post(
      `http://localhost:8000/back-end-juong-job/public/api/seeker/logout`
    );
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchEditProfile = async (profile, token) => {
  try {
    console.log("bên này", profile);
    const data = await axios.post(
      `http://localhost:8000/back-end-juong-job/public/api/seeker/profile`,
      profile,
      {
        headers: {
          Authorization: `Bearer ${token}`,
          Accept: "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "Content-Type": "multipart/form-data",
        },
        credentials: "same-origin",
      }
    );
    toast.success("Cập nhận thông tin thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

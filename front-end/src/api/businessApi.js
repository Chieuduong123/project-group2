import axios from "axios";
import { useToast } from "vue-toastification";
const toast = useToast();
export const fetchRegisterBusiness = async (payload) => {
  try {
    const data = await axios.post(
      `http://localhost:8000/public/api/seeker/register`,
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
    const data = await axios.post(``, user);
    toast.success("Đăng nhập thành công");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const getInforMe = async (email) => {
  try {
    const data = await axios.get(``);
    return data;
  } catch (error) {
    console.log(error);
  }
};

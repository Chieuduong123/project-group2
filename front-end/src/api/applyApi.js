import axios from "axios";
import { BASE_URL } from "../constants/url";
import { useToast } from "vue-toastification";
const toast = useToast();
export const fetchGetApplyByBusiness = async (token) => {
  try {
    const data = await axios.get(`${BASE_URL}v1/applications`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchGetApplyById = async (applyId, token) => {
  try {
    const data = await axios.get(`${BASE_URL}v1/application/${applyId}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchCreateApply = async (idJob, apply, token) => {
  try {
    const data = await axios.post(
      `${BASE_URL}seeker/job/${idJob}/apply`,
      apply,
      {
        headers: {
          Authorization: `Bearer ${token}`,
          Accept: "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "Content-Type": "multipart/form-data",
        },
      }
    );
    toast.success("Ứng tuyển thành công");
    return data;
  } catch (error) {
    if (error.response.status === 403) {
      toast.warning("Bạn đã ứng tuyển vị trí này trước đó!");
    }
    console.log(error);
  }
};

export const fetchHistoryApply = async (token) => {
  try {
    const data = await axios.get(`${BASE_URL}seeker/apply/history`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return data;
  } catch (error) {
    console.log(error);
  }
};

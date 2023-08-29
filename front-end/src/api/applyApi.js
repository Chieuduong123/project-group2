import axios from "axios";

export const fetchGetApply = async () => {
  try {
    const data = await axios.get();
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchGetApplyById = async () => {
  try {
    const data = await axios.get();
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchCreateApply = async () => {
  try {
    const data = await axios.post();
    return data;
  } catch (error) {
    console.log(error);
  }
};

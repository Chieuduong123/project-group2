import axios from "axios";

export const fetchGetAllPost = () => {
  try {
    const data = axios.get("http://localhost:3004/jobs");
    return data;
  } catch (error) {
    console.log(error);
  }
};

export const fetchPostById = (id) => {
  try {
    const data = axios.get(`http://localhost:3004/jobs/${id}`);
    return data;
  } catch (error) {
    console.log(error);
  }
};

import axios from "../config/axios";

/**
 * API get list task
 */
export const getListTask = (params) => {
    return axios.get("/tasks", { params });
};

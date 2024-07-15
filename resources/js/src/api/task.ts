import axios from "../config/axios";

/**
 * API get list task
 */
export const getListTask = (params) => {
    return axios.get("/tasks", { params });
};

/**
 * API get task detail
 * @param param
 * @param id
 */
export const getTaskDetail = (id: any, params: any) => {
    return axios.get(`/task/${id}/detail`, { params });
};

/**
 * API create task
 * @param param
 * @param id
 */
export const createTask = (params: any) => {
    return axios.post(`task/create`, params);
};

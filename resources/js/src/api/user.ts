import axios from "../config/axios";

/**
 * API get list status
 */
export const getListUser = (params) => {
    return axios.get("/users", { params });
};

/**
 * API create status
 * @param param
 */
export const createStatus = (param: FormData) => {
    return axios.post("/status/create", param);
};

/**
 * API update status
 * @param param
 * @param id
 */
export const updateStatus = (id: any, param: any) => {
    return axios.post(`/status/${id}/update`, param);
};

/**
 * API get status detail
 * @param param
 * @param id
 */
export const getStatusDetail = (id: any) => {
    return axios.get(`/status/${id}/detail`);
};

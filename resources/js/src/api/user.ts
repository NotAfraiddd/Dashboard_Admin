import axios from "../config/axios";

/**
 * API get list user
 */
export const getListUser = (params) => {
    return axios.get("/users", { params });
};

/**
 * API create user
 * @param param
 */
export const createStatus = (param: FormData) => {
    return axios.post("/user/create", param);
};

/**
 * API update user
 * @param param
 * @param id
 */
export const updateStatus = (id: any, param: any) => {
    return axios.post(`/user/${id}/update`, param);
};

/**
 * API get user detail
 * @param param
 * @param id
 */
export const getUserDetail = (id: any, params: any) => {
    return axios.get(`/user/${id}/detail`, { params });
};

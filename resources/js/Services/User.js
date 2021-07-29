import axios from "axios";

const getUser = async (userID) => {
    const request = axios.get(`/user/${userID}`);
    const response = await request;
    return response.data;
};

const getAuthUser = async () => {
    const request = axios.get(`/currentUser`);
    const response = await request;
    return response.data;
};

const getEncryptedUserId = async (userID) => {
    const request = axios.post(`/encrypt/${userID}`);
    const response = await request;
    return response.data;
};

export default { getUser, getAuthUser, getEncryptedUserId };

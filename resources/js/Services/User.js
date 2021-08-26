import axios from "axios";

const getUser = async (userID) => {
    try {
        const request = axios.get(`/user/${userID}`);
        const response = await request;
        return response.data;
    } catch (error) {
        console.log(error);
    }
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

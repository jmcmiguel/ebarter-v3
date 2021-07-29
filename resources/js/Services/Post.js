import axios from "axios";

const getAll = async () => {
    const request = axios.get(route("post.index"));
    const response = await request;
    return response.data;
};

const getAuthUserPosts = async () => {
    const request = axios.get("/getAuthUserPosts");
    const response = await request;
    return response.data;
};

const getUserPosts = async (userID) => {
    const request = axios.get(`/getUserPosts/${userID}`);
    const response = await request;
    return response.data;
};

export default { getAll, getAuthUserPosts, getUserPosts };

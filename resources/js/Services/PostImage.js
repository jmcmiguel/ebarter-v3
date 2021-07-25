import axios from "axios";

const get = async (postID) => {
    const request = axios.get(`/postImg/${postID}`);
    const response = await request;
    return response.data;
};

export default { get };

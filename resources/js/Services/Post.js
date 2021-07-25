import axios from "axios";

const getAll = async () => {
    const request = axios.get(route("post.index"));
    const response = await request;
    return response.data;
};

export default { getAll };

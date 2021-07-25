import axios from "axios";

const getUser = async (userID) => {
    const request = axios.get(`/user/${userID}`);
    const response = await request;
    return response.data;
};

export default { getUser };

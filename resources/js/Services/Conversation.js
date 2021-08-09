import axios from "axios";

const checkIfPostExists = async (postID) => {
    const request = axios.get(`/postExistsInConversation/${postID}`);
    const response = await request;
    return response.data;
};

export default { checkIfPostExists };

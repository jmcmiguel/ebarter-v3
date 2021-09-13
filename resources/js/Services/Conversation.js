import axios from "axios";

const checkIfPostExists = async (postID) => {
    try {
        const request = axios.get(`/postExistsInConversation/${postID}`);
        const response = await request;
        return response.data;
    } catch (error) {
        console.log(error);
    }
};

const getConvo = async (convoID) => {
    try {
        const request = axios.get(`/conversation/${convoID}`);
        const response = await request;
        return response.data;
    } catch (error) {
        console.log(error);
    }
};

export default { checkIfPostExists, getConvo };

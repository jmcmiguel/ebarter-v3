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

export default { checkIfPostExists };

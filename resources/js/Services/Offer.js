import axios from "axios";

const checkIfOfferAlreadyExists = async (postID, userID) => {
    const request = axios.post(`/offerExists/post/${postID}/user/${userID}`);
    const response = await request;
    return response.data;
};

export default { checkIfOfferAlreadyExists };

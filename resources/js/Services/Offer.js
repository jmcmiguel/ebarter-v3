import axios from "axios";

const checkIfOfferAlreadyExists = async (postID, userID) => {
    const request = axios.post(`/offerExists/post/${postID}/user/${userID}`);
    const response = await request;
    return response.data;
};

const getPostOffers = async (postID) => {
    const request = axios.get(`/postOffers/${postID}`);
    const response = await request;
    return response.data;
};

export default { checkIfOfferAlreadyExists, getPostOffers };

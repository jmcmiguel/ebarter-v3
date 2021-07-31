import axios from "axios";

const getOfferImages = async (offerID) => {
    const request = axios.get(`/offerImages/${offerID}`);
    const response = await request;
    return response.data;
};

export default { getOfferImages };

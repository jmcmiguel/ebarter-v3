<template>
    <div class="w-full flex" :class="fromAuthUser ? 'justify-start' : 'justify-end'">

        <div class="flex">
            <div class="flex flex-wrap content-end px-1" :class="fromAuthUser ? 'order-first' : 'order-last'">
                <img :src="getProfilePhoto()" alt="photo" class="w-5 h-5 rounded-full order-1">
            </div>

            <div class="bg-gray-100 rounded-md px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                
                <div v-if="message.post_id">
                    <div class="shadow-lg rounded-2xl w-64 p-4 bg-white relative overflow-hidden">
                        <img alt="pic" :src="getPostPhoto()" class="absolute -right-20 -bottom-8 h-40 w-40 mb-4"/>
                        <div class="w-4/6">
                            <p class="text-gray-800 text-lg font-medium mb-2">
                                My post
                            </p>
                            <p class="text-gray-400 text-xs">
                                {{ this.post ? this.post.prod_name : '' }}
                            </p>
                            <p class="text-green-500 text-xl font-medium">
                                ₱{{ this.post ? numberWithCommas(this.post.est_price) : '' }}
                            </p>
                        </div>
                    </div>

                    <div v-if="message.post_id" class="mt-2 mb-2 shadow-lg rounded-2xl w-64 p-4 bg-white relative overflow-hidden">
                        <img alt="pic" :src="getOfferPhoto()" class="absolute -right-20 -bottom-8 h-40 w-40 mb-4"/>
                        <div class="w-4/6">
                            <p class="text-gray-800 text-lg font-medium mb-2">
                                Your Offer
                            </p>
                            <p class="text-gray-400 text-xs">
                                {{ this.offer ? this.offer.prod_name : '' }}
                            </p>
                            <p class="text-green-500 text-xl font-medium">
                                ₱{{ this.offer ? numberWithCommas(this.offer.est_price) : '' }}
                            </p>
                        </div>
                    </div>
                </div>

                <img v-if="message.image_path" :src="`/storage/${message.image_path}`" class="p-1 rounded-2xl" />
                <span class="block">{{ message.content }}</span>
                <span :class="fromAuthUser ? 'text-right' : 'text-left'" class="block text-xs">{{ getTimeAgo(message.created_at) }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import DateHelpers from '@utils/date-helpers'
import PostServices from '@services/Post'
import OfferServices from '@services/Offer'
import PostImageServices from '@services/PostImage'
import OfferImageServices from '@services/OfferImage'

export default {

    props: ['message', 'otherUserPhoto'],

    data(){
        return{
            fromAuthUser: this.$page.props.authUser.id === this.message.sender_id ? false : true,
            post: null,
            offer: null,
            postPhotos: null,
            offerPhotos: null,
        }
    },

    methods:{

        getPostPhoto(){
            return this.postPhotos ? `/storage/${this.postPhotos[0].post_image_path}` : '/img/logo1.png'
        },

        getOfferPhoto(){
            return this.offerPhotos ? `/storage/${this.offerPhotos[0].offer_image_path}` : '/img/logo1.png'
        },

        getProfilePhoto(){
            if(!this.fromAuthUser){
                return this.$page.props.authUser.profile_photo_path
                        ? '/storage/' +this.$page.props.authUser.profile_photo_path
                        : `https://ui-avatars.com/api/?name=${this.$page.props.authUser.name}&color=059669&background=ECFDF5`
            }else{
                return this.otherUserPhoto
            }
        },

        getTimeAgo(date){
            return DateHelpers.getTimeAgo(date)
        },

        async getPost(){
            this.post = await PostServices.getPost(this.message.post_id)
        },
        
        async getOffer(){
            this.offer = await OfferServices.getOffer(this.message.offer_id)
        },

        async getPhotos(){
            this.postPhotos = await PostImageServices.get(this.message.post_id)
            this.offerPhotos = await OfferImageServices.getOfferImages(this.message.offer_id)
        },

        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        },
    },

    created(){
        if(this.message.post_id){
            this.getPost()
            this.getOffer()
            this.getPhotos()
        }
    },

    mounted(){
        
    }
}
</script>
<template>
    <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 sm:px-2 md:px-4 xl:px-4 py-6">
    
        <div class="block bg-white shadow-md hover:shadow-xl rounded-lg">

            <vueper-slides :parallax="1" :parallax-fixed-content="false" fixed-height="12rem" :touchable="false">
                <vueper-slide v-for="image in images" :key="image.id" :image="image.image">
                </vueper-slide>
            </vueper-slides>
            
            <div class="p-4">
                <span v-if="status === 'sold'" class="inline-block px-2 py-1 leading-none bg-red-100 text-red-900 rounded-full font-semibold uppercase tracking-wide text-xs"> Traded </span>
                
                <span v-else class="inline-block px-2 py-1 leading-none bg-green-100 text-green-900 rounded-full font-semibold uppercase tracking-wide text-xs"> {{ status }} </span>
                
                <inertia-link :href="route('dashboard',{
                        category: category,
                        location: route().params.location,
                        price: route().params.price,
                        price2: route().params.price2,
                        hideOwnPost: route().params.hideOwnPost,
                    })">
                    <span class="inline-block px-2 mx-1 py-1 leading-none bg-green-100 text-green-900 rounded-full font-semibold uppercase tracking-wide text-xs"> {{ getCategory(category) }} </span>
                </inertia-link>
                
                <span v-if="isExpired(dateExpiree) && status !== 'sold'" class="inline-block px-2 mx-1 py-1 leading-none bg-red-100 text-red-900 rounded-full font-semibold uppercase tracking-wide text-xs">Expired</span>
                <span v-else-if="isExpiree(dateExpiree) && status !== 'sold'" class="inline-block px-2 mx-1 py-1 leading-none bg-yellow-100 text-yellow-900 rounded-full font-semibold uppercase tracking-wide text-xs">Expiree</span>
                
                <h2 class="mt-2 mb-2 text-xl font-bold"> {{ title }} </h2>
                
                <p class="text-sm"> {{ description }} </p>

                <div class="mt-3 flex items-center">
                    <span class="text-sm font-semibold">Preferred Item: </span>&nbsp;<span class="font-bold"> {{ preferredItem }} </span>
                </div>
                
                <div class="mt-3 flex items-center text-xs text-gray-700">
                    <inertia-link :href="route('userProfile', user.id)" class="flex items-center">
                        <span> <img class="h-6 w-6 mr-2 rounded-full object-cover" :src="getProfilePhoto()" :alt="$page.props.user.name" /> </span>
                        <span class="overflow-ellipsis overflow-hidden">{{ user.id === authUser.id ? 'You' : user.name }} </span> &nbsp; · &nbsp;
                    </inertia-link>
                    <span> {{ getTimeAgo(datePosted) }} </span>
                    <span v-if="isEdited()">&nbsp; · &nbsp; edited</span>
                </div>
            </div>

            <div class="p-4 border-t border-b text-xs text-gray-700">
                <span class="flex items-center mb-1">
                    <span class="far fa-address-card fa-fw text-gray-900 mr-2">Product: </span> {{ prodName }}
                </span> 
                
                <span class="flex items-center mb-1">
                    <span class="far fa-address-card fa-fw text-gray-900 mr-2">Quantity: </span> {{ qty }} {{ getQuantityType(qtyType) }}
                </span> 
            
                <span class="flex items-center mb-1">
                    <span class="far fa-address-card fa-fw text-gray-900 mr-2">Date Produced: </span> {{ formatDate(dateProduced) }}
                </span> 
                
                <span class="flex items-center mb-1">
                    <span class="far fa-address-card fa-fw text-gray-900 mr-2">Date Expiree: </span> {{ formatDate(dateExpiree) }}
                </span> 

                <span class="flex items-center mb-1">
                    <span class="far fa-address-card fa-fw text-gray-900 mr-2">Estimated Price: </span> {{ numberWithCommas(price) }} pesos
                </span>

                <span class="flex items-center mb-1">
                    <span class="far fa-address-card fa-fw text-gray-900 mr-2">Location: </span> {{ user.city }}
                </span>
            </div>


            <div class="flex justify-between">
            
                <div class="p-4 flex items-center text-sm text-gray-600">

                    <div class="flex flex-row mt-1">
                        <svg v-for="(star,index) in feedback.length ? feedback[0].amount : 0" :key="index" xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 1792 1792">
                            <path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
                        </svg>

                        <svg v-for="(star,index) in 5 - (feedback.length ? feedback[0].amount : 0)" :key="index" xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 1792 1792">
                            <path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z"></path>
                        </svg>
                    </div>

                    <span @click="this.$emit('show-feedbacks', feedback)" class="ml-2 cursor-pointer">{{ feedback.length ? feedback.length : 0 }} Ratings</span>
                </div>
                
                <div class="relative p-4">

                    <dropup align="right" width="48" popupPosition="right-0">
                        <template #trigger>
                            <button class="relative z-10 block p-2 transition-colors duration-200 transform bg-gray-300 rounded-md hover:bg-green-500 focus:outline-none focus:bg-green-300">
                                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>
                        </template>

                        <template #content>
                            <div v-if="user.id === authUser.id">
                                <div class="block px-4 py-2 text-xs text-gray-400">Manage Post</div>
                                <jet-dropdown-link :disabled="this.status === 'sold'" @click="showEditModal()" as="button">
                                    Edit Post
                                </jet-dropdown-link>
                                <jet-dropdown-link @click="showDeletePostModal(id, title)" as="button">
                                    Delete Post
                                </jet-dropdown-link>
                                <jet-dropdown-link @click="showOffersModal(id, title)" as="button">
                                    View Offers
                                </jet-dropdown-link>
                            </div>

                            <div v-if="userID !== authUser.id" >
                                <div class="block px-4 py-2 text-xs text-gray-400">Actions Available</div>
                                <jet-dropdown-link :disabled="this.offerExists" @click="showMakeOfferModal(id)" as="button">
                                    Make offer  
                                </jet-dropdown-link>                                
                                <jet-dropdown-link v-if="route().current('cart')" @click="removeFromCart(id)" as="button">
                                    Remove from cart
                                </jet-dropdown-link>
                                <jet-dropdown-link v-if="!route().current('cart')" @click="addToCart(id)" as="button">
                                    Add To Cart
                                </jet-dropdown-link>
                                <jet-dropdown-link @click="showReportModal(id, userID)"  as="button">
                                    Report Post
                                </jet-dropdown-link>
                            </div>
                        </template>
                    </dropup>
          
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import UserServices from '@/Services/User'
    import PostImageServices from '@/Services/PostImage'
    import { VueperSlides, VueperSlide } from 'vueperslides'
    import 'vueperslides/dist/vueperslides.css'
    var dayjs = require('dayjs')
    var relativeTime = require('dayjs/plugin/relativeTime')
    var isBetween = require('dayjs/plugin/isBetween')
    dayjs.extend(isBetween)
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import OfferServices from '@/Services/Offer'
    import Dropup from '@/Components/Dropup'
    import FeedbackServices from '@services/Feedback'

    export default {

        components: {
            VueperSlides, 
            VueperSlide,
            JetDropdownLink,
            Dropup
        },

        props: ['title', 'description', 'price', 'views', 'preferredItem', 'updated_at', 'created_at',
                'status', 'userID', 'prodName', 'qty', 'qtyType', 'showMakeOfferModal','showReportModal',
                'dateProduced', 'dateExpiree', 'category', 'datePosted', 'showOffersModal',
                'id', 'addToCart', 'showEditPostModal', 'showDeletePostModal', 'removeFromCart'],

        data() {
            return{
                authUser: {},
                user: {},
                images: [],
                offerExists: null,
                feedback: []
            }
        },

        methods: {

            async getFeedback(){
                this.feedback = await FeedbackServices.getFeedback(this.id)
            },

            isEdited(){
                return dayjs(new Date(this.updated_at)).isAfter(new Date(this.created_at)) 
                        ? true
                        : false
            },

            showEditModal(){

                const post = {
                    title: this.title,
                    description: this.description,
                    price: this.price,
                    views: this.views,
                    preferredItem: this.preferredItem,
                    status: this.status,
                    userID: this.userID,
                    prodName: this.prodName,
                    qty: this.qty,
                    qtyType: this.qtyType,
                    dateProduced: this.dateProduced,
                    dateExpiree: this.dateExpiree,
                    category: this.category,
                    datePosted: this.datePosted,
                    id: this.id,
                    images: this.images,
                }

                this.showEditPostModal(post)
            },

            numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            getProfilePhoto(){
                if(this.user.profile_photo_path){
                    return '/storage/' + this.user.profile_photo_path
                }else{
                    return `https://ui-avatars.com/api/?name=${this.user.name}&color=059669&background=ECFDF5`
                }
            },

            getTimeAgo(date) {
                dayjs.extend(relativeTime)
                return dayjs(new Date(date)).fromNow()
            },

            formatDate(date) {
                return dayjs(new Date(date)).format('MMM DD, YYYY')
            },

            isExpiree(date){
                if(dayjs(new Date()).isBetween(dayjs(new Date(date)).subtract(1, 'week'), dayjs(new Date(date)))){
                    return true
                }else{
                    return false
                }
            },

            isExpired(date){
                if(dayjs(new Date()).isAfter(new Date(date))){
                    return true
                }else{
                    return false
                }
            },

            getQuantityType(qtyType) {
                switch (qtyType) {
                    case 'categ-1':
                        return 'Kilogram'
                    
                    case 'categ-2':
                        return 'Liter'
                    
                    case 'categ-3':
                        return 'Box'
                    
                    case 'categ-4':
                        return 'Sack'
                    
                    case 'categ-5':
                        return 'Truck'
                    
                    case 'categ-6':
                        return 'Piece'

                    default:
                        return 'Unknown'
                }
            },

            getCategory(category) {

                switch (category) {
                    case 'categ-1':
                        return 'Crops'
                    
                    case 'categ-2':
                        return 'Livestocks'
                    
                    case 'categ-3':
                        return 'Dairy'
                    
                    case 'categ-4':
                        return 'Fish Farming'
                    
                    case 'categ-5':
                        return 'Machineries'
                    
                    case 'categ-6':
                        return 'Others'

                    default:
                        return 'Unknown'
                }

            },

            async getUser(){
                this.user = await UserServices.getUser(this.userID)
            },

            async checkIfOfferAlreadyExists(){
                this.offerExists = await OfferServices.checkIfOfferAlreadyExists(this.id, this.authUser.id)
            },

            async getPostImages(){
                const postImages = await PostImageServices.get(this.id)

                if (postImages.length === 0) {
                    this.images = [{
                        id: 1,
                        image: '/img/noimage.svg',
                    }]
                }else{
                    this.images = postImages.map(image => {
                        return {
                            id: image.id,
                            image: `/storage/${image.post_image_path}` 
                        }
                    })
                }
            }
        },

        created(){
           
            this.getUser()

            this.authUser = this.$page.props.authUser

            this.checkIfOfferAlreadyExists()

            this.getPostImages()

            this.getFeedback()
        },
}
</script>
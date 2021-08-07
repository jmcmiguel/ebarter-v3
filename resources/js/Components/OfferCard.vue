<template>
    <div class="w-full mx-auto bg-white rounded-lg shadow-2xl mt-10">

        <vueper-slides :parallax="1" :parallax-fixed-content="false" fixed-height="20rem" :touchable="false">
            <vueper-slide v-for="image in offerImages" :key="image.id" :image="image.image">
            </vueper-slide>
        </vueper-slides>

        <div class="p-6">
            <div>
                <span class="inline-block px-2 py-1 leading-none bg-green-100 text-green-900 rounded-full font-semibold uppercase tracking-wide text-xs"> {{ getCategory(offer.category) }} </span>
                <span v-if="isExpired(offer.dateExpiree)" class="inline-block px-2 mx-1 py-1 leading-none bg-red-100 text-red-900 rounded-full font-semibold uppercase tracking-wide text-xs">Expired</span>
                <span v-else-if="isExpiree(offer.dateExpiree)" class="inline-block px-2 mx-1 py-1 leading-none bg-yellow-100 text-yellow-900 rounded-full font-semibold uppercase tracking-wide text-xs">Expiree</span>
                
                <p class="block mt-2 text-2xl font-semibold text-gray-800">{{ offer.prod_name }}</p>

                <p class="mt-2 text-sm text-gray-600">Quantity: {{ offer.prod_qty }} {{ getQuantityType(offer.qty_type) }} </p>
            
                <p class="mt-2 text-sm text-gray-600">Date Produced: {{ formatDate(offer.date_produced) }} </p>
            
                <p class="mt-2 text-sm text-gray-600">Date Expiree: {{ formatDate(offer.date_expiree) }} </p>

                <p class="mt-2 text-sm text-gray-600">Estimated Price: {{ numberWithCommas(offer.est_price) }} pesos </p>

                <p class="mt-2 text-sm text-gray-600">Location: {{ user.city }} </p>
            </div>

            <div class="flex justify-between">
                <div>
                    <div v-if="offerror" class="mt-4">
                        <div class="flex items-center">
                            <div class="flex items-center">

                            <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">You made an offer to &nbsp; </span>
                                <img class="object-cover h-5 w-5 rounded-full" :src="getProfilePhoto(this.offeree.profile_photo_path, this.offeree.name)" :alt="this.offeree.name">
                                <inertia-link :href="route('userProfile', this.offeree.id)" class="mx-1 text-xs text-gray-600 dark:text-gray-300">{{ this.offeree.name }}</inertia-link>
                            </div>
                            <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">
                            ·
                            </span>
                            <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">{{ getTimeAgo(offer.created_at) }}</span>
                        </div>
                    </div>
                    <div v-else class="mt-4">
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <img class="object-cover h-10 w-10 rounded-full" :src="getProfilePhoto(this.user.profile_photo_path, this.user.name)" :alt="user.name">
                                <inertia-link :href="route('userProfile', user.id)" class="mx-2 font-semibold text-gray-700 dark:text-gray-200">{{ user.name }}</inertia-link>
                            </div>
                            <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">
                            ·
                            </span>
                            <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">{{ getTimeAgo(offer.created_at) }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <jet-dropdown align="right" width="48">
                        <template #trigger>
                            <button class="relative z-10 mt-5 block p-2 transition-colors duration-200 transform bg-gray-300 rounded-md hover:bg-green-500 focus:outline-none focus:bg-green-300">
                                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>
                        </template>

                        <template #content>
                            <div>
                                <div class="block px-4 py-2 text-xs text-gray-400">Actions Available</div>
                                
                                <div v-if="this.offerror" @click="showCancelOffer(offer.id)">
                                    <jet-dropdown-link as="button">
                                        Cancel Offer
                                    </jet-dropdown-link>
                                </div>

                                <div v-else>
                                    <jet-dropdown-link as="button">
                                        Accept Offer
                                    </jet-dropdown-link>
                                    <jet-dropdown-link as="button">
                                        Reject Offer
                                    </jet-dropdown-link>
                                </div>
                                
                            </div>
                        </template>
                    </jet-dropdown>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserServices from '@/Services/User'
    import PostServices from '@/Services/Post'
    var dayjs = require('dayjs')
    var relativeTime = require('dayjs/plugin/relativeTime')
    var isBetween = require('dayjs/plugin/isBetween')
    dayjs.extend(isBetween)
    import { VueperSlides, VueperSlide } from 'vueperslides'
    import 'vueperslides/dist/vueperslides.css'
    import OfferImageServices from '@/Services/OfferImage'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    export default {

        props: ['offer', 'offerror', 'showCancelOffer'],

        components: {
            VueperSlides, 
            VueperSlide,
            JetDropdown,
            JetDropdownLink
        },

        data(){
            return{

                user:{},

                offeree: {},

                offerImages: [],

                categoryOptions: [
                { text: 'Crops', value: 'categ-1' },
                { text: 'Livestocks', value: 'categ-2' },
                { text: 'Dairy', value: 'categ-3' },
                { text: 'Fish Farming', value: 'categ-4' },
                { text: 'Machineries', value: 'categ-5' },
                { text: 'Others', value: 'categ-6' },
                ],

                qtyOptions: [
                { text: 'Kilogram', value: 'categ-1' },
                { text: 'Liter', value: 'categ-2' },
                { text: 'Box', value: 'categ-3' },
                { text: 'Sack', value: 'categ-4' },
                { text: 'Truck', value: 'categ-5' },
                { text: 'Piece', value: 'categ-6' },
                ],
            }
        },

        methods:{

            numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            formatDate(date) {
                return dayjs(new Date(date)).format('MMM DD, YYYY')
            },

            getTimeAgo(date) {
                dayjs.extend(relativeTime)
                return dayjs(new Date(date)).fromNow()
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

            getProfilePhoto(path, name){
                if(path){
                    return '/storage/' + path
                }else{
                    return `https://ui-avatars.com/api/?name=${name}&color=059669&background=ECFDF5`
                }
            },
        },

        created(){

            // If showing from offerror, display offeree info
            if(this.offerror){
                PostServices.getPostAuthor(this.offer.post_id)
                .then(
                    user => {
                        this.offeree = user
                    }
                ).catch(err => {
                    console.lo
                })
            }

            // Fetch user data of offerror
            UserServices.getUser(this.offer.user_id)
            .then(
                userData => {
                    this.user = userData
                }
            )
            .catch(err => {
                console.log(err.message)
            })

            // Get Offer Images
            OfferImageServices.getOfferImages(this.offer.id)
            .then(
                offerImages => {
                    if (offerImages.length === 0) {
                        this.offerImages = [{
                            id: 1,
                            image: '/img/noimage.svg',
                        }]
                    }else{
                        this.offerImages = offerImages.map(image => {
                            return {
                                id: image.id,
                                image: `/storage/${image.offer_image_path}` 
                            }
                        })
                    }
                }
            ).catch(err =>{
                console.log(err.message)
            })
        }
        
    }
</script>
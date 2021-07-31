<template>
    <div class="w-full mx-auto overflow-hidden bg-white rounded-lg shadow-2xl mt-10">

        <vueper-slides :parallax="1" :parallax-fixed-content="false" fixed-height="12rem" :touchable="false">
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

            <div class="mt-4">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <img class="object-cover h-10 rounded-full" :src="getProfilePhoto()" :alt="user.name">
                        <inertia-link :href="route('userProfile', user.id)" class="mx-2 font-semibold text-gray-700 dark:text-gray-200">{{ user.name }}</inertia-link>
                    </div>
                    <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">
                     ·
                    </span>
                    <span class="mx-1 text-xs text-gray-600 dark:text-gray-300">{{ getTimeAgo(offer.created_at) }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserServices from '@/Services/User'
    var dayjs = require('dayjs')
    var relativeTime = require('dayjs/plugin/relativeTime')
    var isBetween = require('dayjs/plugin/isBetween')
    dayjs.extend(isBetween)
    import { VueperSlides, VueperSlide } from 'vueperslides'
    import 'vueperslides/dist/vueperslides.css'
    import OfferImageServices from '@/Services/OfferImage'

    export default {

        props: ['offer'],

        components: {
            VueperSlides, 
            VueperSlide,
        },

        data(){
            return{

                user:{},

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

            getProfilePhoto(){
                if(this.user.profile_photo_path){
                    return '/storage/' + this.user.profile_photo_path
                }else{
                    return `https://ui-avatars.com/api/?name=${this.user.name}&color=059669&background=ECFDF5`
                }
            },
        },

        created(){

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
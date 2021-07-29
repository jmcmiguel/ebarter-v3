<template>
    <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 sm:px-2 md:px-4 xl:px-4 py-6">
    
        <div class="block bg-white shadow-md hover:shadow-xl rounded-lg">

            <vueper-slides :parallax="1" :parallax-fixed-content="false" fixed-height="12rem" :touchable="false">
                <vueper-slide v-for="image in images" :key="image.id" :image="image.image">
                </vueper-slide>
            </vueper-slides>
            
            <div class="p-4">
                <span class="inline-block px-2 py-1 leading-none bg-green-100 text-green-900 rounded-full font-semibold uppercase tracking-wide text-xs"> {{ status }} </span>
                
                <span class="inline-block px-2 mx-1 py-1 leading-none bg-green-100 text-green-900 rounded-full font-semibold uppercase tracking-wide text-xs"> {{ getCategory(category) }} </span>
                
                <span v-if="isExpired(dateExpiree)" class="inline-block px-2 mx-1 py-1 leading-none bg-red-100 text-red-900 rounded-full font-semibold uppercase tracking-wide text-xs">Expired</span>
                <span v-else-if="isExpiree(dateExpiree)" class="inline-block px-2 mx-1 py-1 leading-none bg-yellow-100 text-yellow-900 rounded-full font-semibold uppercase tracking-wide text-xs">Expiree</span>
                
                <h2 class="mt-2 mb-2 text-xl font-bold"> {{ title }} </h2>
                
                <p class="text-sm"> {{ description }} </p>

                <div class="mt-3 flex items-center">
                    <span class="text-sm font-semibold">Preferred Item: </span>&nbsp;<span class="font-bold"> {{ preferredItem }} </span>
                </div>
                
                <a href="" class="mt-3 flex items-center text-xs text-gray-700">
                    <span> <img class="h-6 w-6 mr-2 rounded-full object-cover" :src="getProfilePhoto()" :alt="$page.props.user.name" /> </span>
                    <span>{{ user.id === authUser.id ? 'You' : user.name }} </span> &nbsp; · &nbsp;
                    <span> {{ getTimeAgo(datePosted) }} </span>
                </a>

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

                <span class="flex items-center mt-5">
                    <img src="/img/eye.svg" alt="views" class="mr-2 h-4 w-4" /> {{ views }} views
                </span>

            </div>


            <div class="flex justify-between">
            
                <div class="p-4 flex items-center text-sm text-gray-600"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-gray-400"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><span class="ml-2">69.69 Ratings</span></div>
                
                <div class="relative p-4">

                    <jet-dropdown align="right" width="48">
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
                                <jet-dropdown-link @click="showEditModal()" as="button">
                                    Edit Post
                                </jet-dropdown-link>
                                <jet-dropdown-link @click="showDeletePostModal(id, title)" as="button">
                                    Delete Post
                                </jet-dropdown-link>
                            </div>

                            <div>
                                <div class="block px-4 py-2 text-xs text-gray-400">Actions Available</div>
                                <jet-dropdown-link v-if="route().current('cart')" as="button">
                                    Make offer
                                </jet-dropdown-link>

                                <jet-dropdown-link v-if="route().current('cart')" as="button">
                                    Remove from cart
                                </jet-dropdown-link>
                                <jet-dropdown-link v-if="this.userID !== this.authUser.id && !route().current('cart')" @click="addToCart(id)" as="button">
                                    Add To Cart
                                </jet-dropdown-link>
                                <jet-dropdown-link v-if="userID !== authUser.id" as="button">
                                    Give Ratings
                                </jet-dropdown-link>
                                <jet-dropdown-link as="button">
                                    Report Post
                                </jet-dropdown-link>
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
    import PostImageServices from '@/Services/PostImage'
    import { VueperSlides, VueperSlide } from 'vueperslides'
    import 'vueperslides/dist/vueperslides.css'
    var dayjs = require('dayjs')
    var relativeTime = require('dayjs/plugin/relativeTime')
    var isBetween = require('dayjs/plugin/isBetween')
    dayjs.extend(isBetween)
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    export default {

        components: {
            VueperSlides, 
            VueperSlide,
            JetDropdown,
            JetDropdownLink,
        },

        props: ['title', 'description', 'price', 'views', 'preferredItem',
                'status', 'userID', 'prodName', 'qty', 'qtyType',
                'dateProduced', 'dateExpiree', 'category', 'datePosted',
                'id', 'addToCart'],

        data() {
            return{
                authUser: {},
                user: {},
                images: [],
            }
        },

        methods: {

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

            }
        },

        created(){
            UserServices.getUser(this.userID)
            .then(
                userData => {
                    this.user = userData
                }
            )
            .catch(err => {
                console.log(err.message)
            })

            UserServices.getAuthUser()
            .then(
                authUser => {
                    this.authUser = authUser
                }
            ).catch(err => {
                console.log(err.message)
            })

            PostImageServices.get(this.id)
            .then(
                postImages => {
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

            )
        }
}
</script>
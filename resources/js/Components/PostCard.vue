<template>
            <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
        
                <div class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
                    
                    <div v-for="image in images" :key="image.id" class="relative pb-48 overflow-hidden">
                        <img class="absolute inset-0 h-full w-full object-cover" :src="'/storage/' + image.post_image_path" alt="post image">
                    </div>
                    
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
                            <span> <img class="h-6 w-6 mr-2 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" /> </span>
                            <span>{{ user.name }} </span> &nbsp; · &nbsp;
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
                            <span class="far fa-address-card fa-fw text-gray-900 mr-2">Estimated Price: </span> {{ price }} pesos
                        </span>

                        <span class="flex items-center mb-1">
                            <span class="far fa-address-card fa-fw text-gray-900 mr-2">Location: </span> {{ user.city }}
                        </span>

                        <span class="flex items-center mt-5">
                            <img src="/img/eye.svg" alt="views" class="mr-2 h-4 w-4" /> {{ views }} views
                        </span>

                    </div>

                    <div class="p-4 flex items-center text-sm text-gray-600"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-gray-400"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><span class="ml-2">69.69 Ratings</span></div>
        
                </div>
        </div>
</template>

<script>
    import UserServices from '@/Services/User'
    import PostImageServices from '@/Services/PostImage'
    var dayjs = require('dayjs')
    var relativeTime = require('dayjs/plugin/relativeTime')

    export default {
        
    props: ['title', 'description', 'price', 'views', 'preferredItem',
            'status', 'userID', 'prodName', 'qty', 'qtyType',
            'dateProduced', 'dateExpiree', 'category', 'datePosted',
            'location', 'id', 'price'],

    data() {
        return{
            user: {},
            images: [],
        }
    },

    methods: {
        getTimeAgo(date) {
            dayjs.extend(relativeTime)
            return dayjs(new Date(date)).fromNow()
        },

        formatDate(date) {
            return dayjs(new Date(date)).format('MMM DD, YYYY')
        },

        isExpiree(date){
            if(dayjs(dayjs(new Date).subtract(1, 'week')).isAfter(new Date(date))){
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
                    break;
                
                case 'categ-2':
                    return 'Liter'
                    break;
                
                case 'categ-3':
                    return 'Box'
                    break;
                
                case 'categ-4':
                    return 'Sack'
                    break;
                
                case 'categ-5':
                    return 'Truck'
                    break;
                
                case 'categ-6':
                    return 'Piece'
                    break;

                default:
                    return 'Unknown'
                    break;
            }
        },

        getCategory(category) {

            switch (category) {
                case 'categ-1':
                    return 'Crops'
                    break;
                
                case 'categ-2':
                    return 'Livestocks'
                    break;
                
                case 'categ-3':
                    return 'Dairy'
                    break;
                
                case 'categ-4':
                    return 'Fish Farming'
                    break;
                
                case 'categ-5':
                    return 'Machineries'
                    break;
                
                case 'categ-6':
                    return 'Others'
                    break;

                default:
                    return 'Unknown'
                    break;
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

        PostImageServices.get(this.id)
        .then(
            postImages => {
                this.images = postImages
            }
        )
    }
}
</script>

<style lang="scss" scoped>
    .c-card {
    img {    
        transition: transform .3s ease-in-out; 
    }
    
    &:hover {
        img {
        transform: scale(1.05)
        }
    }
    }
</style>
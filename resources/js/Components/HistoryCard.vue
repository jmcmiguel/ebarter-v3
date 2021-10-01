<template>
    <div class="flex md:contents">
        <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
            <div class="h-full w-6 flex items-center justify-center">
                <div class="h-full w-1 pointer-events-none" :class="bgColor"></div>
            </div>
            <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full shadow text-center" :class="bgColor">
                <i class="fas fa-check-circle text-white"></i>
            </div>
        </div>

        <div class="col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full" :class="bgColor">
            <h3 class="font-semibold text-lg mb-1">{{ isComplete ? '[Barter Transaction Completed]' : '' }} {{ post ? post.title : '' }}</h3>
            <p class="leading-tight text-justify w-full">{{ date }}</p>
        </div>
    </div>
</template>

<script>
import { computed } from '@vue/runtime-core'
import PostServices from '@services/Post'

export default {

    props: ['isComplete', 'postID', 'date', 'color'],

    computed:{
        bgColor(){
            return `bg-${this.color}-500`
        }
    },

    data(){
        return {
            post: null
        }
    },

    methods:{
        async getPost(postID){
            this.post = await PostServices.getPost(postID)
        }
    },

    created(){
        this.getPost(this.postID)       
    }
    
}
</script>
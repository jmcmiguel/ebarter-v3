<template>
    <div class="w-full flex" :class="fromAuthUser ? 'justify-start' : 'justify-end'">
        <!-- <img src="https://images.unsplash.com/photo-1549078642-b2ba4bda0cdb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=3&amp;w=144&amp;h=144" alt="My profile" class="w-6 h-6 rounded-full order-1"> -->
        <div class="bg-gray-100 rounded-md px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
            <span class="block">{{ message.content }}</span>
            <span class="block text-xs text-right">{{ getTimeAgo(message.created_at) }}</span>
        </div>
    </div>
</template>

<script>
import DateHelpers from '@utils/date-helpers'

export default {

    props: ['message'],

    data(){
        return{
            fromAuthUser: this.$page.props.authUser.id === this.message.sender_id ? false : true
        }
    },

    methods:{
        getTimeAgo(date){
            return DateHelpers.getTimeAgo(date)
        }
    }
}
</script>
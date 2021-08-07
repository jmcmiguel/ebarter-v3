<template>
<div class="w-full flex" :class="fromAuthUser ? 'justify-start' : 'justify-end'">
    <div class="bg-gray-100 rounded px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
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
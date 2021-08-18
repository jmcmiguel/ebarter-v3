<template>
    <div class="w-full flex" :class="fromAuthUser ? 'justify-start' : 'justify-end'">

        <div class="flex">
            <div class="flex flex-wrap content-end px-1" :class="fromAuthUser ? 'order-first' : 'order-last'">
                <img :src="getProfilePhoto()" alt="photo" class="w-5 h-5 rounded-full order-1">
            </div>

            <div class="bg-gray-100 rounded-md px-5 py-2 my-2 text-gray-700 relative" style="max-width: 300px;">
                <span class="block">{{ message.content }}</span>
                <span class="block text-xs text-right">{{ getTimeAgo(message.created_at) }}</span>
            </div>
        </div>

    </div>
</template>

<script>
import DateHelpers from '@utils/date-helpers'

export default {

    props: ['message', 'otherUserPhoto'],

    data(){
        return{
            fromAuthUser: this.$page.props.authUser.id === this.message.sender_id ? false : true
        }
    },

    methods:{

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
        }
    }
}
</script>
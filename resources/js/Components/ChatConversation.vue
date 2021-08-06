<template>
    <a class="hover:bg-gray-100 border-b border-gray-300 px-3 py-2 cursor-pointer flex items-center text-sm focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
        <img class="h-10 w-10 rounded-full object-cover"
        :src="getProfilePhoto()"
        alt="username" />
        <div class="w-full pb-2">
            <div class="flex justify-between">
                <span class="block ml-2 font-semibold text-base text-gray-600 ">{{ getName() }}</span>
                <span class="block ml-2 text-sm text-gray-600">{{ getDate() }}</span>
            </div>
            <span class="block ml-2 text-sm text-gray-600">{{ getContent() }}</span>
        </div>
    </a>
</template>

<script>
import UserServices from '@services/User'
import MessageServices from '@services/Message'
import DateHelpers from '@utils/date-helpers'

export default {

    props: ['convo',],

    data(){
        return{
            authUser: this.$page.props.authUser,
            sender: null,
            receiver: null,
            lastMessage: null,
        }
    },

    methods:{

        getDate(){
            if(this.isNull()) return ''

            return DateHelpers.getTimeAgo(this.lastMessage.created_at);
        },

        getContent(){
            if(this.isNull()) return ''

            return this.lastMessage.content
        },

        getName(){
            if(this.isNull()) return ''

            return this.isUserSender() ? this.receiver.name : this.sender.name
        },

        getProfilePhoto(){

            if(this.isNull()) return ''

            if(this.isUserSender()){
                return this.fetchProfilePhoto(this.receiver)
            }else{
                return this.fetchProfilePhoto(this.sender)
            }

        },

        fetchProfilePhoto(user){
            if(user.profile_photo_path){
                return '/storage/' + user.profile_photo_path
            }else{
                return `https://ui-avatars.com/api/?name=${user.name}&color=059669&background=ECFDF5`
            }
        },

        isUserSender(){
            if(this.isNull()) return ''
            return this.authUser.id === this.sender.id ? true : false
        },

        isNull(){
            return this.sender === null || this.receiver === null || this.lastMessage === null ? true : false
        },
    },

    created(){
        // Get sender data
        UserServices.getUser(this.convo.sender_user_id)
        .then(user => {
            this.sender = user
        })
        .catch(err => {
            console.log(err.message)
        })

        // Get receiver data
        UserServices.getUser(this.convo.receiver_user_id)
        .then(user => {
            this.receiver = user
        })
        .catch(err => {
            console.log(err.message)
        })

        // Get Messages
        MessageServices.getLastMessage(this.convo.id)
        .then(
            lastMessage => {
                this.lastMessage = lastMessage
            }
        )
        .catch(err => {
            console.log(err.message)
        })

    },


}
</script>
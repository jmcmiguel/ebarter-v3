<template>
<div class="col-span-2 bg-white">
    <div class="w-full">
        <div class="flex items-center border-b border-gray-300 pl-3 py-3">
            <img class="h-10 w-10 rounded-full object-cover"
            :src="convo.photo"
            alt="username" />
            <span class="block ml-2 font-bold text-base text-gray-600">{{ convo.name }}</span>
            <span class="connected text-green-500 ml-2" >
                <svg width="6" height="6">
                    <circle cx="3" cy="3" r="3" fill="currentColor"></circle>
                </svg>
            </span>
        </div>
        <div id="chat" class="w-full overflow-y-auto p-10 relative" style="height: calc(100vh - 14.5rem);" ref="toolbarChat">
            <ul>
                <li class="clearfix2">
                    <chat-bubble v-for="message in convo.convo.message" :key="message.id" :message="message"/>
                </li>
            </ul>
        </div>

        <div class="w-full py-3 px-3 flex items-center justify-between border-t border-gray-300">
            <button class="outline-none focus:outline-none">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </button>
            <button class="outline-none focus:outline-none ml-1">
                <svg class="text-gray-400 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>
            </button>

            <input ref="msg_content" v-model="form.msg_content" @keyup.enter="sendMessage"  type="text" class="w-full py-2 pr-4 text-gray-700 bg-white border border-gray-300 rounded-xl focus:border-green-500 focus:outline-none focus:ring-0" placeholder="Type message here...">
            
            <button class="outline-none focus:outline-none" type="submit" @click="sendMessage" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                <svg class="text-gray-400 h-7 w-7 origin-center transform rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                </svg>
            </button>
        </div>
    </div>
</div>
</template>

<script>
import ChatBubble from '@/Components/ChatBubble'
export default {

    props:['convo'],

    components:{
        ChatBubble
    },

    data(){
        return{
            form: this.$inertia.form({
                msg_content: null,
                convo_id: this.convo.convo.id,
                sender_id: this.$page.props.authUser.id,
            }),

            chatDiv: null
        }
    },

    methods:{
        sendMessage() {
            this.form.post(route('message.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                },
                onError: (e) => console.log('something wrong happend'),
                onFinish: () => this.form.reset(),
            })
        },
    },

    mounted(){
        this.chatDiv = document.getElementById('chat')
        this.chatDiv.scrollTop = chat.scrollHeight
    },

    beforeUpdate(){
        this.chatDiv.scrollTop = {}
        this.form.convo_id = this.convo.convo.id
    },

    updated(){
        this.chatDiv.scrollTop = chat.scrollHeight
    }

}
</script>
<template>
<div class="col-span-2 bg-white">
    <div class="w-full">
        <div class="flex items-center border-b border-gray-300 pl-3 py-3">
            <inertia-link class="flex items-center" :href="route('userProfile', getUserID())">
                <img class="h-10 w-10 rounded-full object-cover"
                :src="convo.photo"
                alt="username" />
                <span class="block ml-2 font-bold text-base text-gray-600">{{ convo.name }}</span>
            </inertia-link>
            <span class="connected text-green-500 ml-2" >
                <svg width="6" height="6">
                    <circle cx="3" cy="3" r="3" fill="currentColor"></circle>
                </svg>
            </span>
        </div>
        <div id="chat" class="w-full overflow-y-auto p-10 relative" style="height: calc(100vh - 14.5rem);">
            <ul>
                <li class="clearfix2">
                    <chat-bubble v-for="message in convo.convo.message" :key="message.id" :message="message" :otherUserPhoto="convo.photo"/>
                </li>
            </ul>
        </div>

        <!-- Chat Input Buttons -->
        <chat-box-input :openAddPhoto="openAddPhoto" :convo="convo" :form="form" v-on:messagesent="getNewMessages()"/>

        <!-- Add Photo Modal -->
        <jet-dialog-modal :show="showingAddPhoto" @close="closeAddPhoto">
            <template #title>
                Add a photo
            </template>
            
            <template #content>
                <file-pond
                    name="msgimg"
                    ref="pond"
                    label-idle="Drop files here or <span class='filepond--label-action'>Browse</span>"
                    v-bind:allow-multiple="false"
                    accepted-file-types="image/jpeg, image/png,"
                    v-bind:server="{
                        url: '/msgImg',
                        timeout: 7000,
                        process: {
                            url: '/process',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': this.$page.props.csrf_token
                            },
                            onload: (response) => {
                                logFilePath(response)
                            },
                            withCredentials: false
                        },
                    }"
                v-bind:files="msgimgFiles"
                v-on:init="handleFilePondInit"
                />
                <jet-input type="hidden"
                                id="msgimg_filepath"
                                ref="msgimg_filepath"
                                v-model="msgimgForm.msgimg_filepath" />
            </template>

            <template #footer>
                <jet-secondary-button @click="closeAddPhoto">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="createMsgImg" :class="{ 'opacity-25': msgimgForm.processing }" :disabled="msgimgForm.processing">
                    Send
                </jet-button>
            </template>
        </jet-dialog-modal>

    </div>
</div>
</template>

<script>
import ChatBubble from '@/Components/ChatBubble'
import JetDialogModal from '@/Jetstream/DialogModal'
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetInput from '@/Jetstream/Input'
import ChatBoxInput from '@/Components/ChatBoxInput'

// Create FilePond Component    
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

export default {

    props:['convo'],

    components:{
        ChatBubble,
        JetDialogModal,
        JetButton,
        JetSecondaryButton,
        FilePond,
        JetInput,
        ChatBoxInput
    },

    data(){
        return{
            form: this.$inertia.form({
                msg_content: '',
                convo_id: this.convo.convo.id,
                sender_id: this.$page.props.authUser.id,
            }),

            chatDiv: null,

            showingAddPhoto: false,

            msgimgFiles: null,

            msgimgForm: this.$inertia.form({
                convo_id: this.convo.convo.id,
                sender_id: this.$page.props.authUser.id,
                msg_content: '',
                msgimg_filepath: null,
            }),
        }
    },

    methods:{
        getNewMessages(){
            this.$emit('getnewmessages')
        },

        createMsgImg() {
            this.msgimgForm.post(route('message.store'), {
                preserveScroll: true,
                preserveState: false,
                onSuccess: () => this.closeAddPhoto(),
                onError: (e) => console.log(e),
                onFinish: () => this.form.reset(),
            })
        },

        logFilePath(data){
            this.msgimgForm.msgimg_filepath = data
        },

        handleFilePondInit: function () {
            // FilePond instance methods are available on `this.$refs.pond`
        },

        closeAddPhoto(){
            this.showingAddPhoto = false
        },

        openAddPhoto(){
            this.showingAddPhoto = true
        },
        
        getUserID(){
            return this.$page.props.authUser.id === this.convo.convo.sender_user_id ?
                    this.convo.convo.receiver_user_id : this.convo.convo.sender_user_id
        },
    },

    mounted(){
        // Make sure that the DOM finished rendering
        this.$nextTick(() => {
            this.chatDiv = document.getElementById('chat')
            this.chatDiv.scrollTop = chat.scrollHeight
        })
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
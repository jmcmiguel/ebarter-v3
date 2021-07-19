<template>
    <app-layout>
        <template #header>
            <div class="overflow-y-auto whitespace-nowrap scroll-hidden space-x-5">
                        <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                            All
                        </jet-nav-link>

                        <jet-nav-link :href="route('messages')" :active="route().current('messages')">
                            Livestocks
                        </jet-nav-link>

                        <jet-nav-link :href="route('cart')" :active="route().current('cart')">
                            Crops
                        </jet-nav-link>

                        <jet-nav-link :href="route('cart')" :active="route().current('cart')">
                            Dairy
                        </jet-nav-link>

                        <jet-nav-link :href="route('cart')" :active="route().current('cart')">
                            Fish-Farming
                        </jet-nav-link>

                        <jet-nav-link :href="route('cart')" :active="route().current('cart')">
                            Machineries
                        </jet-nav-link>

                        <jet-nav-link :href="route('cart')" :active="route().current('cart')">
                            Others
                        </jet-nav-link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>
            </div>
        </div>

        <!-- Floating Action Button -->
        <fab @click="showAddPostModal"> 
            <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
            </svg>
        </fab>

        <jet-dialog-modal :show="showingPostModal" @close="closeAddPostModal">
            <template #title>
                Create a post
            </template>

            <template #content>
                Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.
            
                <div class="mt-4 flex flex-col justify-center">
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Post Title"
                                ref="post_title"
                                v-model="form.post_title"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.password" class="mt-2" />

                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Post Description"
                                ref="post_desc"
                                v-model="form.post_desc"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.password" class="mt-2" />
                </div>
            </template>

            <template #footer>
                    <jet-secondary-button @click="closeAddPostModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="logoutOtherBrowserSessions" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Post
                    </jet-button>
                </template>
        </jet-dialog-modal>


    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import JetNavLink from '@/Jetstream/NavLink'
    import Fab from '../Components/Fab'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetButton from '@/Jetstream/Button'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            AppLayout,
            Welcome,
            JetNavLink,
            Fab,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetButton,
             JetSecondaryButton,
        },
        
        data() {
            return {
                showingPostModal: false,
                
                form: this.$inertia.form({
                    password: '',
                })
            }
        },

        methods:{
            showAddPostModal() {
                this.showingPostModal = true
                setTimeout(() => this.$refs.password.focus(), 250)
            },

            closeAddPostModal() {
                this.showingPostModal = false

            },

            logoutOtherBrowserSessions() {
                this.form.delete(route('other-browser-sessions.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),
                })
            },
        }
    }
</script>

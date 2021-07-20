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

        <!-- Add Post Modal -->
        <jet-dialog-modal :show="showingPostModal" @close="closeAddPostModal">
            <template #title>
                Create a post
            </template>

            <template #content>
                Please enter all the details required to post product
            
                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="post_title" value="Post Title" />
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Type post title here"
                                id="post_title"
                                ref="post_title"
                                v-model="form.post_title"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.post_title" class="mt-2" />
                </div>

                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="post_desc" value="Post Description" />
                    <text-area rows="5" class="mt-1 block w-3/4" placeholder="Type post description here"
                                id="post_desc"
                                ref="post_desc"
                                v-model="form.post_desc"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.post_desc" class="mt-2" />
                </div>

                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="prod_name" value="Product Name" />
                    <jet-input type="text" class="mt-1 block w-3/4" placeholder="Type product name here"
                                id="prod_name"
                                ref="prod_name"
                                v-model="form.prod_name"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.prod_name" class="mt-2" />
                </div>

                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="prod_qty" value="Product Quantity" />
                    <jet-input type="number" class="mt-1 block w-3/4" placeholder="Type product quantity here"
                                id="prod_qty"
                                ref="prod_qty"
                                v-model="form.prod_qty"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.post_desc" class="mt-2" />
                </div>

                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="qty_type" value="Quantity Type" />
                    <select class="mt-1 block w-3/4 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                id="qty_type"
                                ref="qty_type"
                                v-model="form.qty_type"
                                required
                                @keyup.enter="logoutOtherBrowserSessions">

                        <option disabled value="" selected>Select qty type here</option>
                        <option v-for="(option, index) in qtyOptions" v-bind:value="option.value" :key="index">
                            {{option.text}}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.qty_type" class="mt-2" />
                </div>

                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="date_produced" value="Date Produced" />
                    <jet-input type="date" class="mt-1 block w-3/4" placeholder="Choose the date when the product was produced"
                                id="date_produced"
                                ref="date_produced"
                                v-model="form.date_produced"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.date_produced" class="mt-2" />
                </div>
                
                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="date_expired" value="Estimated Expiree Date" />
                    <jet-input type="date" class="mt-1 block w-3/4" placeholder="Choose the date when the product was produced"
                                id="date_expired"
                                ref="date_expired"
                                v-model="form.date_expired"
                                required
                                @keyup.enter="logoutOtherBrowserSessions" />
                    <jet-input-error :message="form.errors.date_expired" class="mt-2" />
                </div>
                
                <div class="mt-4 flex flex-col justify-center">
                    <jet-label for="category" value="Category" />
                    <select class="mt-1 block w-3/4 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                id="category"
                                ref=""
                                v-model="form.category"
                                required
                                @keyup.enter="logoutOtherBrowserSessions">

                        <option disabled value="" selected>Select category here</option>
                        <option v-for="(option, index) in categoryOptions" v-bind:value="option.value" :key="index">
                            {{ option.text }}
                        </option>
                    </select>
                    <jet-input-error :message="form.errors.category" class="mt-2" />
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
    import TextArea from '../Components/TextArea'
    import Select from '../Components/Select'
    import JetLabel from '@/Jetstream/Label'

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
            TextArea,
            Select,
            JetLabel
        },
        
        data() {
            return {
                showingPostModal: false,
                
                form: this.$inertia.form({
                    category: 'Select category here',
                    qty_type: 'Select qty type here',
                }),

                categoryOptions: [
                { text: 'Crops', value: 'categ-1' },
                { text: 'Livestocks', value: 'categ-2' },
                { text: 'Dairy', value: 'categ-3' },
                { text: 'Fish Farming', value: 'categ-4' },
                { text: 'Machineries', value: 'categ-5' },
                { text: 'Others', value: 'categ-6' },
                ],

                qtyOptions: [
                { text: 'Kilogram', value: 'categ-1' },
                { text: 'Liter', value: 'categ-2' },
                { text: 'Box', value: 'categ-3' },
                { text: 'Sack', value: 'categ-4' },
                { text: 'Truck', value: 'categ-5' },
                { text: 'Piece', value: 'categ-6' },
                ]
            }
        },

        methods:{
            showAddPostModal() {
                this.showingPostModal = true
                setTimeout(() => this.$refs.post_title.focus(), 250)
            },

            closeAddPostModal() {
                this.showingPostModal = false

            },

            logoutOtherBrowserSessions() {
                this.form.delete(route('other-browser-sessions.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.post_title.focus(),
                    onFinish: () => this.form.reset(),
                })
            },
        }
    }
</script>

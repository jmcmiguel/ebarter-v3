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
        
        <div class="container mx-auto p-6">
            <post-card v-for="post in posts" :key="post.id" :id="post.id" :title="post.title" :description="post.description" 
                        :price="post.est_price" :views="post.views" :preferredItem="post.preferred_prod" :status="post.status" :userID="post.user_id" 
                        :prodName="post.prod_name" :qty="post.prod_qty" :qtyType="post.qty_type" :dateProduced="post.date_produced" 
                        :dateExpiree="post.date_expiree" :category="post.category" :datePosted="post.created_at" />
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
                        <jet-input type="text" class="mt-1 block w-full" placeholder="Type post title here"
                                    id="post_title"
                                    ref="post_title"
                                    v-model="form.post_title"
                                    required />
                        <jet-input-error :message="form.errors.post_title" class="mt-2" />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="post_desc" value="Post Description" />
                        <text-area rows="5" class="mt-1 block w-full" placeholder="Type post description here"
                                    id="post_desc"
                                    ref="post_desc"
                                    v-model="form.post_desc"
                                    required />
                        <jet-input-error :message="form.errors.post_desc" class="mt-2" />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="prod_name" value="Product Name" />
                        <jet-input type="text" class="mt-1 block w-full" placeholder="Type product name here"
                                    id="prod_name"
                                    ref="prod_name"
                                    v-model="form.prod_name"
                                    required />
                        <jet-input-error :message="form.errors.prod_name" class="mt-2" />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="prod_qty" value="Product Quantity" />
                        <jet-input type="number" class="mt-1 block w-full" placeholder="Type product quantity here"
                                    id="prod_qty"
                                    ref="prod_qty"
                                    v-model="form.prod_qty"
                                    required />
                        <jet-input-error :message="form.errors.prod_qty" class="mt-2" />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="qty_type" value="Quantity Type" />
                        <select class="mt-1 block w-full border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                    id="qty_type"
                                    ref="qty_type"
                                    v-model="form.qty_type"
                                    required >

                            <option disabled value="" selected>Select qty type here</option>
                            <option v-for="(option, index) in qtyOptions" v-bind:value="option.value" :key="index">
                                {{option.text}}
                            </option>
                        </select>
                        <jet-input-error :message="form.errors.qty_type" class="mt-2" />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="est_price" value="Estimated Price" />
                        <jet-input type="number" class="mt-1 block w-full" placeholder="Type estimated product price"
                                    id="est_price"
                                    ref="est_price"
                                    v-model="form.est_price"
                                    required />
                        <jet-input-error :message="form.errors.est_price" class="mt-2" />
                    </div>
                    
                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="date_produced" value="Date Produced" />
                        <jet-input type="date" class="mt-1 block w-full" placeholder="Choose the date when the product was produced"
                                    id="date_produced"
                                    ref="date_produced"
                                    v-model="form.date_produced"
                                    required />
                        <jet-input-error :message="form.errors.date_produced" class="mt-2" />
                    </div>
                    
                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="date_expired" value="Estimated Expiree Date" />
                        <jet-input type="date" class="mt-1 block w-full" placeholder="Choose the date when the product was produced"
                                    id="date_expired"
                                    ref="date_expired"
                                    v-model="form.date_expired"
                                    required />
                        <jet-input-error :message="form.errors.date_expired" class="mt-2" />
                    </div>
                    
                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="category" value="Category" />
                        <select class="mt-1 block w-full border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                                    id="category"
                                    ref="category"
                                    v-model="form.category"
                                    required>

                            <option disabled value="" selected>Select category here</option>
                            <option v-for="(option, index) in categoryOptions" v-bind:value="option.value" :key="index">
                                {{ option.text }}
                            </option>
                        </select>
                        <jet-input-error :message="form.errors.category" class="mt-2" />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label for="pref_prod" value="Preferred Product" />
                        <jet-input type="text" class="mt-1 block w-full" placeholder="Type preferred product to receive"
                                    id="pref_prod"
                                    ref="pref_prod"
                                    v-model="form.pref_prod"
                                    required />
                        <jet-input-error :message="form.errors.pref_prod" class="mt-2" />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-label value="Product Images" />
                        <file-pond
                            name="postimg"
                            ref="pond"
                            label-idle="Drop files here or <span class='filepond--label-action'>Browse</span>"
                            v-bind:allow-multiple="true"
                            accepted-file-types="image/jpeg, image/png,"
                            v-bind:server="{
                                url: '/postImg',
                                timeout: 7000,
                                process: {
                                    url: '/process',
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken
                                    },
                                    onload: (response) => {
                                        logFilePath(response)
                                    },
                                    withCredentials: false
                                },
                                revert: {
                                    url: '/revert',
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        '_method': 'DELETE'
                                    }
                                }
                            }"
                        v-bind:files="myFiles"
                        v-on:init="handleFilePondInit"
                        />
                    </div>

                    <div class="mt-4 flex flex-col justify-center">
                        <jet-input type="hidden"
                                    id="postimg_filepath"
                                    ref="postimg_filepath"
                                    v-model="form.postimg_filepath" />
                    </div>
            </template>

            <template #footer>
                    <jet-secondary-button @click="closeAddPostModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="createPost" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
    import vueFilePond from "vue-filepond";
    import "filepond/dist/filepond.min.css";
    import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
    import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
    import FilePondPluginImagePreview from "filepond-plugin-image-preview";
    import PostCard from '@/Components/PostCard';
    import PostServices from '@/Services/Post';

    // Create FilePond Component    
    const FilePond = vueFilePond(
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview
    );

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
            JetLabel,
            FilePond,
            PostCard
        },

        props: ['data', 'errors'],
        
        data() {
            return {
                showingPostModal: false,

                csrfToken: window.Laravel.csrfToken,

                title: null,

                posts: [],

                form: this.$inertia.form({
                    post_title: null,
                    post_desc: null,
                    prod_name: null,
                    prod_qty: null,
                    category: null,
                    qty_type: null,
                    date_produced: null,
                    date_expired: null,
                    pref_prod: null,
                    est_price: null,
                    postimg_filepath: [],
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
                ],

                myFiles: []
            }
        },

        methods:{
            logFilePath(data){
                this.form.postimg_filepath.push(data)
            },
            
            showAddPostModal() {
                this.showingPostModal = true
                setTimeout(() => this.$refs.post_title.focus(), 250)
            },

            closeAddPostModal() {
                this.showingPostModal = false
                this.form.reset()
            },

            createPost() {
                this.form.post(route('post.store'), {
                    preserveScroll: true,
                    onSuccess: () => this.closeAddPostModal(),
                    onError: () => this.$refs.post_title.focus(),
                    onFinish: () => this.form.reset(),
                })
            },

            handleFilePondInit: function () {
                console.log("FilePond has initialized");
                // FilePond instance methods are available on `this.$refs.pond`
            },

        },

        mounted() {
            PostServices.getAll()
            .then(
                allPost => {
                    this.posts = allPost
                }
            )
            .catch(err => {
                console.log(err.message)
            });
        }
    }
</script>
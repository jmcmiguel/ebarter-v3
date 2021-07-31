<template>
    <app-layout>

        <!-- Categories -->
        <template #header>
            <categories />
        </template>

        <!-- All Posts -->
        <div v-if="posts.data.length" class="p-6">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <post-card v-for="post in posts.data" :key="post.id" :id="post.id" :title="post.title" :description="post.description" :showMakeOfferModal="showMakeOfferModal"
                                :price="post.est_price" :views="post.views" :preferredItem="post.preferred_prod" :status="post.status" :userID="post.user_id" :showOffersModal="showOffersModal"
                                :prodName="post.prod_name" :qty="post.prod_qty" :qtyType="post.qty_type" :dateProduced="post.date_produced" :showDeletePostModal="showDeletePostModal"
                                :dateExpiree="post.date_expiree" :category="post.category" :datePosted="post.created_at" :showEditPostModal="showEditPostModal" :addToCart="addToCart" />
                </div>
            </div>
            <pagination :links="posts.links" />
        </div>

        <div v-else class="flex justify-center flex-col mt-20">
            <img class="h-72" src="/img/void.svg" alt="">
            <div class="mx-auto">
            no results found
            </div>
        </div>

        <!-- Floating Action Button -->
        <fab id="fab" @click="showAddPostModal"> 
            <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6 inline-block">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" />
            </svg>
        </fab>

        <!-- Add Post Modal -->
        <add-post-modal :showingPostModal="showingPostModal" :closeAddPostModal="closeAddPostModal" />

        <!-- Edit Post Modal -->
        <edit-post-modal :postData="editPostData" :showingEditModal="showingEditModal" :closeEditPostModal="closeEditPostModal" />

        <!-- Delete Post Modal -->
        <delete-post-modal :postData="deletePostData" :showingDeletePostModal="showingDeleteModal" :closeDeletePostModal="closeDeletePostModal" />

        <!-- Make Offer Modal -->
        <make-offer-modal :showingMakeOfferModal="showingMakeOfferModal" :closeMakeOfferModal="closeMakeOfferModal" :postID="makeOfferData" />

        <!-- Show Offers Modal -->
      <show-offers-modal :showingOffersModal="showingOffersModal" :closeOffersModal="closeOffersModal" />

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Fab from '@/Components/Fab'
    import PostCard from '@/Components/PostCard'
    import Pagination from '@/Components/Pagination'
    import AddPostModal from '@/Components/AddPostModal'
    import Categories from '@/Components/Categories'
    import EditPostModal from '@/Components/EditPostModal'
    import DeletePostModal from '@/Components/DeletePostModal'
    import MakeOfferModal from '@/Components/MakeOfferModal'
    import ShowOffersModal from '@/Components/ShowOffersModal'

    export default {

        components: {
            AppLayout,
            Fab,
            PostCard,
            Pagination,
            AddPostModal,
            Categories,
            EditPostModal,
            DeletePostModal,
            MakeOfferModal,
            ShowOffersModal
        },

        props: ['posts'],

        data(){
            return {
                showingPostModal: false,
                showingEditModal: false,
                editPostData: null,
                showingDeleteModal: false,
                deletePostData: null,
                showingMakeOfferModal: false,
                makeOfferData: null,
                showingOffersModal: false,
            }
        },

        created(){
            window.addEventListener('scroll', this.hideFabOnBottom);
        },

        unmounted() {
            window.removeEventListener('scroll', this.hideFabOnBottom);
        },

        methods: {

            showOffersModal() {
                this.showingOffersModal = true
            },

            closeOffersModal() {
                this.showingOffersModal = false
            },

            addToCart(postID){
                const form = this.$inertia.form({
                    'post_id': postID
                })

                form.post(route('cart.store'), {
                    preserveScroll: true,
                    onSuccess: () => form.reset(),
                    onError: () => this.$refs.post_title.focus(),
                    onFinish: () => form.reset(),
                })
            },

            showAddPostModal() {
                this.showingPostModal = true
            },

            closeAddPostModal() {
                this.showingPostModal = false
            },

            showEditPostModal(postData) {
                this.editPostData = postData
                this.showingEditModal = true
            },

            closeEditPostModal() {
                this.showingEditModal = false
            },

            showDeletePostModal(id, title){
                this.deletePostData = {id: id, title: title}
                this.showingDeleteModal = true
            },
            
            closeDeletePostModal(){
                this.showingDeleteModal = false
            },

            showMakeOfferModal(postID) {
                this.makeOfferData = postID
                this.showingMakeOfferModal = true
            },

            closeMakeOfferModal() {
                this.showingMakeOfferModal = false
            },

            hideFabOnBottom(event) {
                if (window.innerHeight + window.scrollY > document.body.clientHeight - 20) {
                    if(window.scrollY === 0){
                        document.getElementById('fab').style.dispay='unset';                        
                    }else{
                        document.getElementById('fab').style.display='none';
                    }
                }else{
                    document.getElementById('fab').style.display='unset';
                }
            },

        },
    }
</script>
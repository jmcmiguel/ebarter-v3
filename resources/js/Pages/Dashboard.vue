<template>
    <app-layout>

        <!-- Categories -->
        <template #header>
            <categories />
        </template>
        
        <!-- All Posts -->
        <div class="p-6">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <post-card v-for="post in posts.data" :key="post.id" :id="post.id" :title="post.title" :description="post.description" 
                                :price="post.est_price" :views="post.views" :preferredItem="post.preferred_prod" :status="post.status" :userID="post.user_id" 
                                :prodName="post.prod_name" :qty="post.prod_qty" :qtyType="post.qty_type" :dateProduced="post.date_produced" 
                                :dateExpiree="post.date_expiree" :category="post.category" :datePosted="post.created_at" :showEditPostModal="showEditPostModal" />
                </div>
            </div>
            <pagination :links="posts.links" />
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

    export default {

        components: {
            AppLayout,
            Fab,
            PostCard,
            Pagination,
            AddPostModal,
            Categories,
            EditPostModal
        },

        props: ['posts'],

        data(){
            return {
                showingPostModal: false,
                showingEditModal: false,
                editPostData: null,
            }
        },

        created(){
            window.addEventListener('scroll', this.hideFabOnBottom);
        },

        destroyed () {
            window.removeEventListener('scroll', this.hideFabOnBottom);
        },

        methods: {
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

            hideFabOnBottom(event) {
                if (window.innerHeight + window.scrollY > document.body.clientHeight - 20) {
                    document.getElementById('fab').style.display='none';
                }else{
                    document.getElementById('fab').style.display='unset';
                }
            },

        },
    }
</script>
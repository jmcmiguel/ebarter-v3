<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Trader's Cart
            </h2>
        </template>

        <!-- All Posts Added To Cart -->
        <div v-if="posts.data.length" class="p-6">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <post-card v-for="post in posts.data" :key="post.id" :id="post.id" :title="post.title" :description="post.description" 
                                :price="post.est_price" :views="post.views" :preferredItem="post.preferred_prod" :status="post.status" :userID="post.user_id" 
                                :prodName="post.prod_name" :qty="post.prod_qty" :qtyType="post.qty_type" :dateProduced="post.date_produced"
                                :dateExpiree="post.date_expiree" :category="post.category" :datePosted="post.created_at" />
                </div>
            </div>
            <pagination :links="posts.links" />
        </div>

        <div v-else class="flex justify-center flex-col mt-20">
            <img class="h-72" src="/img/void.svg" alt="">
            <div class="mx-auto">
            cart is empty
            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import PostCard from '@/Components/PostCard'
    import Pagination from '@/Components/Pagination'
    
    export default {

        props: ['posts'],

        components:{
            AppLayout,
            PostCard,
            Pagination
        },

        mounted(){
            
        },
        
    }
</script>
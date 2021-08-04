<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Offer's Made</h2>
        </template>


        <!-- All Offers made -->
        <div v-if="offersMade.data.length" class="p-6">
            <div class="container mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <offer-card v-for="postOffer in offersMade.data" :key="postOffer.id" :offer="postOffer" :offerror="true" class="lg:w-3/5"/>
                </div>
            </div>
            <pagination :links="offersMade.links" />
        </div>

        <!-- Show if no offers made yet -->
            <div v-else class="flex justify-center flex-col mt-20">
                <img class="h-72" src="/img/void.svg" alt="">
                <div class="mx-auto">
                    no offer's made yet
                </div>
            </div>

    </app-layout>   
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Pagination from '@/Components/Pagination'
    import OfferCard from '@/Components/OfferCard'

    export default {

        props:['offersMade'],

        components: {
            AppLayout,
            Pagination,
            OfferCard,
        },

        data(){
            return{
            }
        },

        mounted(){

        }

    }
</script>
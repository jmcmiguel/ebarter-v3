<template>
    <app-layout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transaction History
            </h2>
        </template>
            <div class="container p-5 m-5">
                <div v-if="barters.length" class="flex flex-col md:grid grid-cols-12 text-gray-50">
                    <history-card v-for="barter in barters" :key="barter.id" :isComplete="getIsComplete(barter.finished_at)" :postID="barter.post_id" :date="getDate(barter.created_at)"  :color="getColor(barter)"/>
                </div>

                <div v-else class="flex flex-col md:grid grid-cols-12 text-gray-50">
                    <div class="mx-auto">
                        <lottie-animation path="animations/empty-box-2.json" :loop="true" :autoPlay="true" :speed="1"  background="transparent" :width="300" :height="300" />
                        </div>

                        <div class="mx-auto">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">No transactions found yet</h2>
                    </div>
                </div>
            </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import HistoryCard from '@/Components/HistoryCard'
import DateHelpers from '@utils/date-helpers'
import LottieAnimation from 'lottie-vuejs/src/LottieAnimation.vue'

export default {

    props: ['barters'],

    components:{
        AppLayout,
        HistoryCard,
        LottieAnimation
    },

    methods:{
        getDate(date){
            return DateHelpers.getTimeAgo(date);
        },

        getIsComplete(finishedAt){
            return finishedAt ? true : false
        },

        getColor(barter){
            return barter.finished_at ? 'green' : 'red'
        },
    },    
}
</script>
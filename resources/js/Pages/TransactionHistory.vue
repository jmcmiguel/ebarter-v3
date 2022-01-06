<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Transaction History
      </h2>
    </template>
    <div class="container p-5 min-w-full">
      <div
        v-if="offers.data.length"
        class="flex flex-col md:grid grid-cols-12 text-gray-50"
      >
        <history-card
          v-for="offer in offers.data"
          :key="offer.id"
          :ogOffer="offer"
          :postID="offer.post_id"
          :convoID="offer.convo_id"
          :date="getDate(offer.created_at)"
          :status="offer.status"
          :categories="categories"
          :qtyTypes="qtyTypes"
        />
      </div>

      <div v-else class="flex flex-col text-gray-50">
        <div class="mx-auto">
          <lottie-animation
            path="animations/empty-box-2.json"
            :loop="true"
            :autoPlay="true"
            :speed="1"
            background="transparent"
            :width="300"
            :height="300"
          />
        </div>

        <div class="mx-auto">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            No transactions found yet
          </h2>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import HistoryCard from "@/Components/HistoryCard";
import DateHelpers from "@utils/date-helpers";
import LottieAnimation from "lottie-vuejs/src/LottieAnimation.vue";

export default {
  props: ["offers", "categories", "qtyTypes"],

  components: {
    AppLayout,
    HistoryCard,
    LottieAnimation,
  },

  methods: {
    getDate(date) {
      return DateHelpers.formatDate(date);
    },

    getIsComplete(finishedAt) {
      return finishedAt ? true : false;
    },
  },
};
</script>
<template>
    <jet-dialog-modal :show="show" @close="close">
        <template #title>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Feedbacks</h2>
        </template>

        <template #content>
            <div v-if="feedbacks.length">
                <feedback-card v-for="feedback in feedbacks" :key="feedback.id" :feedback="feedback" />
            </div>
            
            <!-- Show if no feedbacks found -->
            <div v-else class="flex justify-center flex-col mt-10 pb-36">

                <div class="mx-auto">
                <lottie-animation path="animations/empty-dessert.json" :loop="true" :autoPlay="true" :speed="1"  background="transparent" :width="300" :height="300" />
                </div>

                <div class="mx-auto -mt-10">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">No feedbacks yet</h2>
                </div>
            </div>
        </template>

        <template #footer>
            <jet-secondary-button @click="close">
                Cancel
            </jet-secondary-button>
        </template>
    </jet-dialog-modal>
</template>

<script>
import JetDialogModal from '@/Jetstream/DialogModal'
import JetButton from '@/Jetstream/Button'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import FeedbackCard from '@/Components/FeedbackCard'
import LottieAnimation from 'lottie-vuejs/src/LottieAnimation.vue'

export default {

    props:['show', 'close', 'feedbacks'],

    components:{
        JetDialogModal,
        JetButton,
        JetSecondaryButton,
        FeedbackCard,
        LottieAnimation
    },

    data(){
        return{
            form: this.$inertia.form({
                
            })
        }
    }
    
}
</script>
<template>
    <jet-dialog-modal :show="showingOffersModal" @close="closeOffersModal">
        <template #title>
            {{ postOffers.length ? postOffers.length : 'No'}} Offers Received from post '{{post.title}}'
        </template>

        <template #content>
            <!-- Show all offers received -->
            <div v-if="postOffers.length" class="p-6">
                <p>
                    Showing all the offers received from other users for this post
                </p>

                <div class="container mx-auto">
                    <div class="flex flex-wrap -mx-4">
                        <offer-card v-for="postOffer in postOffers" :key="postOffer.id" :offer="postOffer" />
                    </div>
                </div>
            </div>

            <!-- Show if no offers received -->
            <div v-else class="flex justify-center flex-col mt-20">
                <img class="h-72" src="/img/void.svg" alt="">
                <div class="mx-auto">
                    no offer received yet
                </div>
            </div>

        </template>

        <template #footer>
                <jet-button @click="closeOffersModal" class="ml-2">
                    Close
                </jet-button>
            </template>
    </jet-dialog-modal>
</template>

<script>
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetButton from '@/Jetstream/Button'
    import OfferServices from '@/Services/Offer'
    import OfferCard from '@/Components/OfferCard'

    export default {

        components:{
            JetDialogModal,
            JetButton,
            OfferCard
        },

        props: ['showingOffersModal', 'closeOffersModal', 'post'],
        
        data() {
            return {

                postOffers: [],

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
            }
        },

        methods:{

        },

        beforeUpdate() {
            OfferServices.getPostOffers(this.post.id)
            .then(
                postOffers => {
                    this.postOffers = postOffers
                }
            ).catch(err => {
                console.log(err.message)
            })
        }
        
    }
</script>
<template>
    <jet-dialog-modal :show="showingOffersModal" @close="closeOffersModal">
        <template #title>
            Offers Received
        </template>

        <template #content>
            This all the offers received from the other users
        </template>

        <template #footer>
                <jet-secondary-button @click="closeOffersModal">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    OK
                </jet-button>
            </template>
    </jet-dialog-modal>
</template>

<script>

    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetButton from '@/Jetstream/Button'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetLabel from '@/Jetstream/Label'

    export default {

        components:{
            JetDialogModal,
            JetInput,
            JetInputError,
            JetButton,
            JetSecondaryButton,
            JetLabel,
        },

        props: ['showingOffersModal', 'closeOffersModal'],
        
        data() {
            return {
                form: this.$inertia.form({

                })
            }
        },

        methods:{

        },

        beforeUnmount() {
        }
        
    }
</script>
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

        <!-- Floating Action Button -->
        <fab/>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import JetNavLink from '@/Jetstream/NavLink'
    import Fab from '../Components/Fab'

    export default {
        components: {
            AppLayout,
            Welcome,
            JetNavLink,
            Fab,
        },
    }
</script>

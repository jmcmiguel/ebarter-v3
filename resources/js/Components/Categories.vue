<template>
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

<script>
    import JetNavLink from '@/Jetstream/NavLink'

    export default {

        components: {
            JetNavLink,
        }
        
    }
</script>
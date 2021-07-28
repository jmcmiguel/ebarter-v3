<template>
    <div class="overflow-y-auto whitespace-nowrap scroll-hidden space-x-5">
        <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
        All
        </jet-nav-link>
        
        <jet-nav-link :href="route('dashboard','categ-1')" :active="route().current('cart')">
        Crops
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-2')" :active="route().current('cart')">
        Livestocks
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-3')" :active="route().current('cart')">
        Dairy
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-4')" :active="route().current('cart')">
        Fish-Farming
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-5')" :active="route().current('cart')">
        Machineries
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-6')" :active="route().current('cart')">
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
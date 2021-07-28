<template>
    <div class="overflow-y-auto whitespace-nowrap scroll-hidden space-x-5">
        <jet-nav-link :href="route('dashboard')" :active="isRouteActive()">
        All
        </jet-nav-link>
        
        <jet-nav-link :href="route('dashboard','categ-1')" :active="isRouteActive('categ-1')">
        Crops
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-2')" :active="isRouteActive('categ-2')">
        Livestocks
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-3')" :active="isRouteActive('categ-3')">
        Dairy
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-4')" :active="isRouteActive('categ-4')">
        Fish-Farming
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-5')" :active="isRouteActive('categ-5')">
        Machineries
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard', 'categ-6')" :active="isRouteActive('categ-6')">
        Others
        </jet-nav-link>
    </div>
</template>

<script>
    import JetNavLink from '@/Jetstream/NavLink'

    export default {

        components: {
            JetNavLink,
        },
        
        methods: {
            isRouteActive(url) {

                if(url === route().params.category) return true

                return false
            },
        }
        
    }
</script>
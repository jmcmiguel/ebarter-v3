<template>
    <div class="overflow-y-auto whitespace-nowrap scroll-hidden space-x-5">
        <jet-nav-link :href="route('dashboard')" :active="isRouteActive()">
        All
        </jet-nav-link>
        
        <jet-nav-link :href="route('dashboard',{
                        category: 'categ-1',
                        location: route().params.location,
                        price: route().params.price,
                    })" :active="isRouteActive('categ-1')">
        Crops
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard',{
                        category: 'categ-2',
                        location: route().params.location,
                        price: route().params.price,
                    })" :active="isRouteActive('categ-2')">
        Livestocks
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard',{
                        category: 'categ-3',
                        location: route().params.location,
                        price: route().params.price,
                    })" :active="isRouteActive('categ-3')">
        Dairy
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard',{
                        category: 'categ-4',
                        location: route().params.location,
                        price: route().params.price,
                    })" :active="isRouteActive('categ-4')">
        Fish-Farming
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard',{
                        category: 'categ-5',
                        location: route().params.location,
                        price: route().params.price,
                    })" :active="isRouteActive('categ-5')">
        Machineries
        </jet-nav-link>

        <jet-nav-link :href="route('dashboard',{
                        category: 'categ-6',
                        location: route().params.location,
                        price: route().params.price,
                    })" :active="isRouteActive('categ-6')">
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
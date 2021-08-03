<template>
    <dropdown align="left" width="250">
        <template #trigger>
            <button class="flex mt-10 mx-auto p-2 transition-colors duration-200 transform bg-gray-300 rounded-md hover:bg-green-500 focus:outline-none focus:bg-green-300">
                <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" class="w-5 h-5 mr-1">
                    <g class="">
                        <path d="M0 0h24v24H0z" fill="none" class=""></path>
                        <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z" class=""></path>
                    </g>
                </svg>
                Filter 
            </button>
        </template>

        <template #content>
            <div class="container mx-auto">
                    <div class="flex flex-col  mx-4 px-8 py-6">
						<div class="flex justify-center text-sm text-gray-700">
							<div class="w-1/5 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Location</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
                                        <jet-nav-link :href="route('dashboard',{
											category: route().params.category,
											location: 'balanga'
										})" :active="isLocationFilterActive('balanga')" class="flex-1">Balanga</jet-nav-link>
									</div>
									<div class="flex py-2 ">
										<jet-nav-link :href="route('dashboard',{
											category: route().params.category,
											location: 'pilar'
										})" :active="isLocationFilterActive('pilar')" class="flex-1">Pilar</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link :href="route('dashboard',{
											category: route().params.category,
											location: 'abucay'
										})" :active="isLocationFilterActive('abucay')" class="flex-1">Abucay</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link :href="route('dashboard',{
											category: route().params.category,
											location: 'bagac'
										})" :active="isLocationFilterActive('bagac')" class="flex-1">Bagac</jet-nav-link>
									</div>
                                    <div class="flex py-2">
										<jet-nav-link :href="route('dashboard',{
											category: route().params.category,
											location: 'morong'
										})" :active="isLocationFilterActive('morong')" class="flex-1">Morong</jet-nav-link>
									</div>
                                    <div class="flex py-2">
										<jet-nav-link :href="route('dashboard',{
											category: route().params.category,
											location: 'dinalupihan'
										})" :active="isLocationFilterActive('dinalupihan')" class="flex-1">Dinalupihan</jet-nav-link>
									</div>
                                    <div class="flex py-2">
										<jet-nav-link :href="route('dashboard',{
											category: route().params.category,
											location: 'orani'
										})" :active="isLocationFilterActive('orani')" class="flex-1">Orani</jet-nav-link>
									</div>
								</div>
							</div>
							<div class="w-32 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Price</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1"> &#60; 100 </jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1"> 101 to 500 </jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">501 to 1,000</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">1,001 to 2,000</jet-nav-link>
									</div>
									<div class="flex py-2 ">
										<jet-nav-link href="#" class="flex-1">2,001 to 5,000</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1"> &#62; 5,000</jet-nav-link>
									</div>
								</div>
							</div>
							<div class="w-28 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Date Posted</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">Ascending</jet-nav-link>
									</div>
									<div class="flex py-2 ">
										<jet-nav-link href="#" class="flex-1">Descending</jet-nav-link>
									</div>
								</div>
							</div>
							<div class="w-28 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Date Produced</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">Today</jet-nav-link>
									</div>
									<div class="flex py-2 ">
										<jet-nav-link href="#" class="flex-1">This week</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">Last week</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">This month</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">Before</jet-nav-link>
									</div>
								</div>
							</div>
                            <div class="w-28 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Availability</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">Available</jet-nav-link>
									</div>
									<div class="flex py-2 ">
										<jet-nav-link href="#" class="flex-1">Unavailable</jet-nav-link>
									</div>
									<div class="flex py-2">
										<jet-nav-link href="#" class="flex-1">Negotiations</jet-nav-link>
									</div>
								</div>
							</div>
						</div>
						<div class="flex mt-5">
							<inertia-link :href="clearFilter()" class="text-gray-700 font-normal text-sm hover:underline">Clear Filter</inertia-link>
						</div>
                    </div>
                </div>
        </template>
    </dropdown> 
</template>

<script>
    import Dropdown from '@/Jetstream/Dropdown'
    import DropdownLink from '@/Jetstream/DropdownLink'
	import JetNavLink from '@/Jetstream/NavLink'
import { registerRuntimeCompiler } from '@vue/runtime-core'

    export default {

        components: {
            Dropdown,
            DropdownLink,
			JetNavLink,
        },

		methods: {
            isLocationFilterActive(url) {

                if(url === route().params.location) return true

                return false
            },

			clearFilter(){
				return route().params.category ? route('dashboard',route().params.category) 
											   : route('dashboard');
			},
        }

    }
</script>
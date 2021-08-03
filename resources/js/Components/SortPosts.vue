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
                                        <inertia-link :href="route('dashboard',{
											category: route().params.category,
											location: 'balanga'
										})" class="flex-1">Balanga</inertia-link>
									</div>
									<div class="flex py-2 font-bold">
										<inertia-link :href="route('dashboard',{
											category: route().params.category,
											location: 'pilar'
										})" class="flex-1">Pilar</inertia-link>
										<inertia-link href="#"><svg class="h-5 py-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg></inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link :href="route('dashboard',{
											category: route().params.category,
											location: 'abucay'
										})" class="flex-1">Abucay</inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link :href="route('dashboard',{
											category: route().params.category,
											location: 'bagac'
										})" class="flex-1">Bagac</inertia-link>
									</div>
                                    <div class="flex py-2">
										<inertia-link :href="route('dashboard',{
											category: route().params.category,
											location: 'morong'
										})" class="flex-1">Morong</inertia-link>
									</div>
                                    <div class="flex py-2">
										<inertia-link :href="route('dashboard',{
											category: route().params.category,
											location: 'dinalupihan'
										})" class="flex-1">Dinalupihan</inertia-link>
									</div>
                                    <div class="flex py-2">
										<inertia-link :href="route('dashboard',{
											category: route().params.category,
											location: 'orani'
										})" class="flex-1">Orani</inertia-link>
									</div>
								</div>
							</div>
							<div class="w-32 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Price</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1"> &#60; 100 </inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1"> 101 to 500 </inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">501 to 1,000</inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">1,001 to 2,000</inertia-link>
									</div>
									<div class="flex py-2 font-bold">
										<inertia-link href="#" class="flex-1">2,001 to 5,000</inertia-link>
										<inertia-link href="#"><svg class="h-5 py-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg></inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1"> &#62; 5,000</inertia-link>
									</div>
								</div>
							</div>
							<div class="w-28 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Date Posted</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">Ascending</inertia-link>
									</div>
									<div class="flex py-2 font-bold">
										<inertia-link href="#" class="flex-1">Descending</inertia-link>
										<inertia-link href="#"><svg class="h-5 py-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg></inertia-link>
									</div>
								</div>
							</div>
							<div class="w-28 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Date Produced</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">Today</inertia-link>
									</div>
									<div class="flex py-2 font-bold">
										<inertia-link href="#" class="flex-1">This week</inertia-link>
										<inertia-link href="#"><svg class="h-5 py-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg></inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">Last week</inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">This month</inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">Before</inertia-link>
									</div>
								</div>
							</div>
                            <div class="w-28 mr-10">
								<h3 class="pb-2 border-b mb-3 text-md text-gray-900 font-semibold">Availability</h3>
								<div class="flex flex-col">
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">Available</inertia-link>
									</div>
									<div class="flex py-2 font-bold">
										<inertia-link href="#" class="flex-1">Unavailable</inertia-link>
										<inertia-link href="#"><svg class="h-5 py-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg></inertia-link>
									</div>
									<div class="flex py-2">
										<inertia-link href="#" class="flex-1">Negotiations</inertia-link>
									</div>
								</div>
							</div>
						</div>
						<div class="flex mt-5">
							<inertia-link href="#" class="text-gray-700 font-normal text-sm hover:underline">Clear Filter</inertia-link>
						</div>
                    </div>
                </div>
        </template>
    </dropdown> 
</template>

<script>
    import Dropdown from '@/Jetstream/Dropdown'
    import DropdownLink from '@/Jetstream/DropdownLink'

    export default {

        components: {
            Dropdown,
            DropdownLink,
        }

    }
</script>
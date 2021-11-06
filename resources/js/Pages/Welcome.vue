<template>
    <div class="bg-indigo-900 relative overflow-hidden h-screen">
    
        <img src="/img/landing_nologo.jpg" class="absolute h-full w-full object-cover"/>
    
        <div class="inset-0 bg-black opacity-25 absolute">
        </div>
        
        <header class="absolute top-0 left-0 right-0 z-20">
            <nav class="container mx-auto px-6 md:px-12 py-4">
                <div class="md:flex justify-center items-center">
                    <div class="flex justify-between items-center">

                        <dropdown align="left" width="48">

                            <template #trigger>
                                <div class="md:hidden">
                                    <button class="text-white focus:outline-none">
                                        <svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                            
                            <template #content>
                                <dropdown-link v-if="$page.props.user" :href="route('dashboard')">
                                    Home
                                </dropdown-link>

                                <template v-else>
                                    <dropdown-link :href="route('login')">
                                        Login
                                    </dropdown-link>
                                    
                                    <dropdown-link :href="route('register')">
                                        Register
                                    </dropdown-link>
                                </template>
                                
                                
                            </template>

                        </dropdown>
                    </div>
                    <div class="hidden md:flex items-center">

                        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-lg uppercase mx-3 text-white cursor-pointer hover:text-gray-300">
                                Home
                            </inertia-link>

                            <template v-else>
                                <inertia-link :href="route('login')" class="text-lg uppercase mx-3 text-white cursor-pointer hover:text-gray-300">
                                    Log in
                                </inertia-link>

                                <inertia-link v-if="canRegister" :href="route('register')" class="text-lg uppercase mx-3 text-white cursor-pointer hover:text-gray-300">
                                    Register
                                </inertia-link>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container mx-auto px-6 md:px-12 relative z-10 flex items-center py-32 xl:py-40">
            <div class="w-full flex flex-col items-center relative z-10">
                <h1 class="font-extrabold text-7xl text-center sm:text-8xl text-white leading-tight mt-4">
                    A Platform for Trading Agricultural Products
                </h1>
                <a v-if="$page.props.user" :href="route('register')" class="block bg-green-600 hover:bg-green-900 rounded-md py-3 px-4 text-lg text-white font-bold uppercase mt-10">
                    Home Page
                </a>
                <a v-else :href="route('dashboard')" class="block bg-green-600 hover:bg-green-900 rounded-md py-3 px-4 text-lg text-white font-bold uppercase mt-10">
                    Register Now
                </a>
            </div>
        </div>

    </div>

    <!-- Team Section -->
    <section class="text-gray-400 bg-gray-900 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="text-2xl font-medium title-font mb-4 text-white tracking-widest">The E-Barter Team</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">The team that brought you, the E-Barter Website.</p>
            </div>

            <div class="flex flex-wrap -m-4">
                <member-card 
                    name="John Michael Miguel" 
                    title="Member"
                    description="Lead the software development phase, and responsible for the overall system development"
                    photo="/img/jmcmiguel.JPG"  />
                <member-card 
                    name="Justine Marie Padilla" 
                    title="Team Leader"
                    description="In-charge of team management and the overall system documentation."
                    photo="/img/jmrpadilla.jpg"  />
                <member-card 
                    name="Elaisa Mae Magpantay" 
                    title="Member"
                    description="Associate for research and documentation of the system."
                    photo="/img/emcmagpantay.jpg"  />
                <member-card 
                    name="Gamel Iloco" 
                    title="Member"
                    description="Leading the data gathering for the system requirements, as well as system testing."
                    photo="/img/giiloco.png"  />
            </div>
        </div>
        </section>

    <!-- Footer -->
    <footer class="text-gray-400 bg-gray-900 body-font">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
            <img src="/img/logo1.png" alt="" class="w-10 h-10 text-white p-2 rounded-full">
            <span class="text-white ml-3 text-xl">E-Barter</span>
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">© 2020 E-Barter —
            <a href="https://github.com/poodzia" class="text-gray-600 ml-1" rel="noopener noreferrer" target="_blank">@poodzia</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
            <a class="text-gray-500">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                </svg>
            </a>
            <a class="ml-3 text-gray-500">
                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                </svg>
            </a>
            <a class="ml-3 text-gray-500">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                </svg>
            </a>
            <a href="https://www.linkedin.com/in/johnmichaelmiguel-c/" class="ml-3 text-gray-500">
                <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                <circle cx="4" cy="4" r="2" stroke="none"></circle>
                </svg>
            </a>
            </span>
        </div>
    </footer>
</template>

<style scoped>
    .bg-gray-100 {
        background-color: #f7fafc;
        background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
    }

    .border-gray-200 {
        border-color: #edf2f7;
        border-color: rgba(237, 242, 247, var(--tw-border-opacity));
    }

    .text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }

    .text-gray-500 {
        color: #a0aec0;
        color: rgba(160, 174, 192, var(--tw-text-opacity));
    }

    .text-gray-600 {
        color: #718096;
        color: rgba(113, 128, 150, var(--tw-text-opacity));
    }

    .text-gray-700 {
        color: #4a5568;
        color: rgba(74, 85, 104, var(--tw-text-opacity));
    }

    .text-gray-900 {
        color: #1a202c;
        color: rgba(26, 32, 44, var(--tw-text-opacity));
    }

    @media (prefers-color-scheme: dark) {
        .dark\:bg-gray-800 {
            background-color: #2d3748;
            background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
        }

        .dark\:bg-gray-900 {
            background-color: #1a202c;
            background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
        }

        .dark\:border-gray-700 {
            border-color: #4a5568;
            border-color: rgba(74, 85, 104, var(--tw-border-opacity));
        }

        .dark\:text-white {
            color: #fff;
            color: rgba(255, 255, 255, var(--tw-text-opacity));
        }

        .dark\:text-gray-400 {
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--tw-text-opacity));
        }
    }
</style>

<script>
    import MemberCard from '@/Components/TeamMemberCard'
    import Dropdown from '@/Jetstream/Dropdown'
    import DropdownLink from '@/Jetstream/DropdownLink'

    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
        },

        components: {
            MemberCard,
            Dropdown,
            DropdownLink
        },

        mounted(){
            console.log("i stopped my subscription to forge cuz im broke, if you see this it still works")
        }

    }
</script>

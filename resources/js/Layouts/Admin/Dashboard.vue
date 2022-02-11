<template>


    <div class="leading-normal tracking-normal" id="main-body">
        <div class="flex flex-wrap">
            <div class="w-1/2 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block bg-mainGray border-r z-30 overflow-auto" :class="sideBarOpen ? '' : 'hidden'" id="main-nav">
                <div class="w-full h-20 border-b flex px-4 items-center mb-8">
                    <Link :href="route('admin.dashboard')" class="flex">
                        <img class="h-16" src="/assets/images/logo.png" alt="SPŠE Prešov">
                        <p class="font-semibold self-center text-3xl text-red-600 pl-4">INTERNÁT</p>
                    </Link>
                </div>

                <div class="mb-4 px-4">
                    <p class="pl-4 text-sm font-semibold mb-1">DOMOV</p>

                    <Link :href="route('admin.dashboard')" >
                        <div :class="[route().current('admin.dashboard') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4  hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="text-gray-700">Dashboard</span>
                        </div>

                    </Link>


                    <Link :href="route('admin.vychadzky')" >
                        <div :class="[route().current('admin.vychadzky') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                            <span class="text-gray-700">Vychádzky</span>
                        </div>

                    </Link>

                    <Link :href="route('admin.workout')">
                        <div :class="[route().current('admin.workout') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                            <span class="text-gray-700">Workout</span>
                        </div>
                    </Link>





                    <Link :href="route('admin.internatnici')" >

                        <div :class="[route().current('admin.internatnici') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="text-gray-700">Internatisti</span>
                        </div>
                    </Link>

                    <Link v-if="$page.props.auth.user.roles.some(e => e.id === 3)" :href="route('admin.users')" >

                        <div :class="[route().current('admin.users') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span class="text-gray-700">Administratíva</span>

                        </div>
                    </Link>


                </div>
                <div class="mb-4 px-4">
                    <p class="pl-4 text-sm font-semibold mb-1 ">Izby</p>

                    <Link :href="route('admin.izby')" >
                        <div :class="[route().current('admin.izby') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="text-gray-700">Všetky Izby</span>
                        </div>
                    </Link>


                    <Link :href="route('admin.hodnotenie.create')">
                        <div :class="[route().current('admin.hodnotenie.create') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-gray-700">Pridať Hodnotenie</span>
                        </div>
                    </Link>

                    </div>
                <div class="mb-4 px-4">
                    <p class="pl-4 text-sm font-semibold mb-1">AKTIVITY</p>

                    <Link :href="route('admin.availableActivities.index')">
                        <div :class="[route().current('admin.availableActivities.index') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                            </svg>
                            <span class="text-gray-700">Dostupné aktivity</span>
                        </div>
                    </Link>

                    <Link :href="route('admin.activity.index')">
                        <div :class="[route().current('admin.activity.index') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                            <span class="text-gray-700">Dnešná aktivita</span>
                        </div>
                    </Link>

                </div>
                <div class="mb-4 px-4">
                    <p class="pl-4 text-sm font-semibold mb-1">OZNÁMENIA</p>

                    <Link :href="route('admin.oznamenie.create')">
                        <div :class="[route().current('admin.oznamenie.create') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-gray-700">Pridať Oznamenie</span>
                        </div>
                    </Link>

                    <Link :href="route('admin.upratovanie.create')">
                        <div :class="[route().current('admin.upratovanie.create') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg  class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            <span class="text-gray-700">Upratovanie</span>
                        </div>
                    </Link>
                </div>


            </div>
        </div>

        <div class="w-full bg-mainGray pl-0 lg:pl-64 min-h-screen" :class="sideBarOpen ? 'overlay' : ''" id="main-content">

            <div class="sticky top-0 z-40">
                <div class="w-full h-20 px-6 bg-mainGray border-b flex items-center justify-between">

                    <!-- left navbar -->
                    <div class="flex">

                        <!-- mobile hamburger -->
                        <div class="inline-block lg:hidden flex items-center mr-4">
                            <button class="hover:text-blue-500 hover:border-white focus:outline-none navbar-burger" >
                                <svg @click="sideBarOpen = !sideBarOpen" class="h-5 w-5" v-bind:style="{ fill: 'black' }" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                            </button>
                        </div>

                        <!-- search bar -->

                    </div>

                    <!-- right navbar -->
                    <div class="flex items-center relative">
                        <div class=" sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Odhlásiť sa
                                        </BreezeDropdownLink>

                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                    </div>

                </div>


            </div>

            <main>
                <slot />
            </main>

        </div>

        <Footer />


        </div>

</template>

<script>
import Sidebar from '@/Components/AdminPanel/Sidebar.vue'
import Navbar from '@/Components/AdminPanel/Navbar.vue'
import Footer from '@/Components/AdminPanel/Footer.vue'

import {Link} from "@inertiajs/inertia-vue3";

import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'

require('@/echo')

export default {
    components: {
        Sidebar,
        Navbar,
        Footer,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        Link
    },

    data() {
        return {
            sideBarOpen: false
        }
    },




}
</script>

<template>



    <div class="leading-normal tracking-normal" id="main-body">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block bg-mainGray border-r z-30" :class="sideBarOpen ? '' : 'hidden'" id="main-nav">
                <div class="w-full h-20 border-b flex px-4 items-center mb-8">
                    <Link :href="route('dashboard')" class="flex">
                        <img class="h-16" src="/assets/images/logo.png" alt="SPŠE Prešov">
                        <p class="font-semibold self-center text-3xl text-red-600 pl-4">INTERNÁT</p>
                    </Link>
                </div>

                <div class="mb-4 px-4">
                    <p class="pl-4 text-sm font-semibold mb-1">DOMOV</p>

                    <Link :href="route('dashboard')" >
                        <div :class="[route().current('dashboard') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4  hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            <span class="text-gray-700">Dashboard</span>
                        </div>

                    </Link>



                    <Link :href="route('hodnotenie')" >
                        <div :class="[route().current('hodnotenie') ? 'bg-gray-200' : '']" class="w-full flex items-center text-blue-400 h-10 pl-4  hover:bg-gray-200 rounded-lg cursor-pointer">
                            <svg class="h-6 w-6 fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!-- Font Awesome Free 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M528.1 171.5L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6zM388.6 312.3l23.7 138.4L288 385.4l-124.3 65.3 23.7-138.4-100.6-98 139-20.2 62.2-126 62.2 126 139 20.2-100.6 98z"/></svg>
                            <span class="text-gray-700">Hodnotenie Izby</span>
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

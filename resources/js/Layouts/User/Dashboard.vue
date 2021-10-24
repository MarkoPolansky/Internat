<template>

    <div class="leading-normal tracking-normal" id="main-body">
        <div class="flex flex-wrap">



            <div class="w-1/2 md:w-1/3 lg:w-64 fixed md:top-0 md:left-0 h-screen lg:block bg-mainGray border-r z-30" :class="sideBarOpen ? '' : 'hidden'" id="main-nav">

                <div class="w-full h-20 border-b flex px-4 items-center mb-8">
                    <p class="font-semibold text-3xl text-blue-400 pl-4">LOGO</p>
                </div>


                <div class="mb-4 px-4">
                    <p class="pl-4 text-sm font-semibold mb-1">DOMOV</p>
                    <div class="w-full flex items-center text-blue-400 h-10 pl-4 bg-gray-200 hover:bg-gray-200 rounded-lg cursor-pointer">
                        <svg class="h-6 w-6 fill-current mr-2" viewBox="0 0 20 20">
                            <path d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
                        </svg>
                        <span class="text-gray-700">Dashboard</span>
                    </div>
                </div>






                <div class="w-full flex items-center   h-16 pl-4  rounded-lg sticky   inset-x-0 bottom-0 bg-blue-200  ">


                    <Link :href="route('logout')" method="post">
                        <svg class="w-6 h-6 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </Link>

                    <svg class="w-6 h-6 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>

                    <div class="mr-2">
                        {{ $page.props.auth.user.name }}
                    </div>

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
                                                Log Out
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

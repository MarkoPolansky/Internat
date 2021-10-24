<template>
<!--    <div class="sticky top-0 z-40">-->
<!--        <div class="w-full h-20 px-6 bg-gray-100 border-b flex items-center justify-between">-->

<!--            &lt;!&ndash; left navbar &ndash;&gt;-->
<!--            <div class="flex">-->

<!--                &lt;!&ndash; mobile hamburger &ndash;&gt;-->
<!--                <div class="inline-block lg:hidden flex items-center mr-4">-->
<!--                    <button class="hover:text-blue-500 hover:border-white focus:outline-none navbar-burger" >-->
<!--                        <svg @click="this.$emit('sideBarOpen')" class="h-5 w-5" v-bind:style="{ fill: 'black' }" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>-->
<!--                    </button>-->
<!--                </div>-->

<!--                &lt;!&ndash; search bar &ndash;&gt;-->

<!--            </div>-->

<!--            &lt;!&ndash; right navbar &ndash;&gt;-->
<!--            <div class="flex items-center relative">-->
<!--                <div class=" sm:flex sm:items-center sm:ml-6">-->
<!--                    &lt;!&ndash; Settings Dropdown &ndash;&gt;-->
<!--                    <div class="ml-3 relative">-->
<!--                        <BreezeDropdown align="right" width="48">-->
<!--                            <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">-->
<!--                                                {{ $page.props.auth.user.name }}-->

<!--                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">-->
<!--                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                            </template>-->

<!--                            <template #content>-->
<!--                                <BreezeDropdownLink :href="route('logout')" method="post" as="button">-->
<!--                                    Log Out-->
<!--                                </BreezeDropdownLink>-->
<!--                            </template>-->
<!--                        </BreezeDropdown>-->
<!--                    </div>-->
<!--                </div>-->

<!--            </div>-->

<!--        </div>-->


<!--    </div>-->
</template>

<script>
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import Sidebar from "@/Components/AdminPanel/Sidebar";
import Footer from "@/Components/AdminPanel/Footer";
export default {
    name: 'Navbar',

    components: {

        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink
    },


    data() {
        return {
            dropDownOpen: false
        }
    },

}
</script>

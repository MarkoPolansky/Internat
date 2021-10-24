<template   >
    <Dashboard>


        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Používatelia</h1>



            <div class="mb-4 flex justify-between items-center">
                <div class="flex-1 pr-4">
                    <div class="relative md:w-1/3">
                        <input type="search"
                               class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                               placeholder="Search...">
                        <div class="absolute top-0 left-0 inline-flex items-center p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="shadow rounded-lg flex">
                        <div class="relative">
                            <button @click.prevent.stop="open = !open"
                                    class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden" viewBox="0 0 24 24"
                                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <path
                                        d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5" />
                                </svg>
                                <span class="hidden md:block">Display</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" width="24" height="24"
                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </button>

                            <div v-show="open"
                                 class="z-50 absolute top-0 right-0 w-40 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-1 overflow-hidden">
                                    <label
                                        class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2">
                                        <div class="text-teal-600 mr-3">
                                            <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" checked @click="toggleColumn">
                                        </div>
                                        <div class="select-none text-gray-700" > behehe</div>
                                    </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative"
                 style="height: 405px;">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                    <tr class="text-left">
                        <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">
                            <label
                                class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" @click="selectAllCheckbox">
                            </label>
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Meno
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Trieda
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Izba
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                            Rola
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="user in users" :key="user.id">
                        <tr>
                            <td class="border-dashed border-t border-gray-200 px-3">
                                <label
                                    class="text-teal-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
                                    <input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" :name="user.id">

                                </label>
                            </td>
                            <td class="border-dashed border-t border-gray-200 userId">
                                <span class="text-gray-700 px-6 py-3 flex items-center" >{{user.name}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 firstName">
                                <span class="text-gray-700 px-6 py-3 flex items-center">{{user.class}}</span>
                            </td>
                            <td class="border-dashed border-t border-gray-200 lastName">
                                <span  v-if="user.apartment" class="text-gray-700 px-6 py-3 flex items-center">{{user.apartment.name}}</span>
                            </td>
                            <td class="border-dashed border-t  border-gray-200 emailAddress">
                                <div class="flex ">
								    <div v-for="role in user.roles" :class="[role.name == 'internatista' ?  ' bg-blue-400 ': 'bg-red-400']" class="text-gray-700 px-2 border-2 rounded-3xl"
                                     >{{role.name}}</div>
                                </div>
                            </td>

                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>





    </Dashboard>
</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
export default {
    components:{
        Dashboard
    },
    props:{
        users: Object

    },
    data() {
        return {
            open: false,

        }
    },

    methods: {
        selectAllCheckbox() {
            console.log("selectedAôô")
        },
        toggleColumn(){
            console.log("toggleColumn")

        }
    },


}
</script>

<style scoped>

</style>

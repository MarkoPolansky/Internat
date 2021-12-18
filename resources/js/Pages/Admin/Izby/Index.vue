<template   >
    <Dashboard>


        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Izby</h1>



            <div class="mb-4 flex justify-between items-center">
                <div class="flex-1 pr-4">


                </div>

            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative "
                 style="height: 600px">
                <table class="border-collapse table-fixed w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                    <tr class="text-left">

                        <th  class=" bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                            Izba
                        </th>
                        <th  class=" bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                            Dnešné hodnotenie
                        </th>
                        <th  class=" bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                            Pocet byvajucich
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">

                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="apartment in apartments" :key="apartment.id">
                        <tr class="hover:bg-gray-100">
                            <td class="border-dashed border-t border-gray-200 userId">
                                <Link :href="route('admin.izby.show',apartment.id)" class="text-gray-700 px-6 py-3 flex items-center" >
                                    <span  >{{apartment.name}}</span>
                                </Link>
                            </td>
                            <td class="border-dashed border-t border-gray-200 firstName">
                                <Link :href="route('admin.izby.show',apartment.id)" class="text-gray-700 px-6 py-3 flex items-center" >
                                    <span v-if="apartment.today_ratting">
                                        {{apartment.today_ratting.edited_ratting}}</span>
                                </Link>
                            </td>
                            <td class="border-dashed border-t border-gray-200 lastName">
                                <Link :href="route('admin.izby.show',apartment.id)" class="text-gray-700 px-6 py-3 flex items-center" >
                                    <span   >{{apartment.users_count}}</span>
                                </Link>
                            </td>
                            <td class="border-dashed border-t  border-gray-200 ">
                                <Link :href="route('admin.izby.show',apartment.id)" class="text-gray-700 px-6 py-3 flex justify-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </Link>
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
import Modal from "@/Components/Modal";
import BreezeButton from "@/Components/Button";
import {Link} from "@inertiajs/inertia-vue3";



export default {
    components:{
        Dashboard,
        Modal,
        BreezeButton,
        Link
    },
    props:{
        apartments: Object
    },
    data() {
        return {
        }
    },



}
</script>

<style scoped>

</style>

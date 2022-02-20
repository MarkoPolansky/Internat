<template   >
    <Dashboard>
        <Head :title="'Izba '+ apartment.name" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Izba / {{apartment.name}}</h1>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full xl:w-1/2 px-3 mb-8 xl:mb-0">
                    <p class="text-xl font-semibold mb-4">Bývajúci</p>


                        <div class="w-full overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-8 ">
                            <table class="border-collapse table-fixed; w-full whitespace-no-wrap bg-white  relative">
                                <thead>
                                <tr class="text-left">

                                    <th  class="w-1/2 cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Meno
                                    </th>
                                    <th  class="w-1/2 cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Skupina
                                    </th>

                                </tr>
                                </thead>
                                <tbody  v-for="user in apartment.users">

                                <tr class="hover:bg-gray-200" >
                                    <td class=" border-t border-gray-200 lastName">
                                        <Link :href="route('admin.internatnici.show',user.id)" class="text-gray-700 px-6 py-3 flex items-center">
                                            {{ user.name }}
                                        </Link>
                                    </td>

                                    <td class=" border-t border-gray-200 lastName">
                                        <Link :href="route('admin.internatnici.show',user.id)" class="text-gray-700 px-6 py-3 flex items-center">
                                            {{ user.class }}
                                        </Link>
                                    </td>

                                </tr>


                                </tbody>

                            </table>



                        </div>


                </div>


                <div class="w-full xl:w-1/2 px-3 mb-8 xl:mb-0">
                    <p class="text-xl font-semibold mb-4"> Hodnotenie izby za posledné 4 týždne</p>

                    <div class="flex flex-col justify-center ">

                        <div class="w-full bg-white border rounded-lg p-4 mb-8 "  v-for="(week,index) in rattingByWeeks">

                            <GraphRoomRatting  :ratting="week" >
                            </GraphRoomRatting>


                        </div>
                    </div>
                </div>
            </div>




        </div>

    </Dashboard>

</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import GraphRoomRatting from "@/Components/GraphRoommRattingMultiple";
import {Head, Link} from "@inertiajs/inertia-vue3";


export default {
    components:{
        Dashboard,
        Link,
        Head,
        GraphRoomRatting
    },
    props:{
        apartment: Object,
        rattingByWeeks: Object
    },
    data() {
        return {
        }
    },
    methods:{
        avg(week){
            let sum = 0
            let count =0;
            week.forEach((day) =>{
                typeof day.edited_ratting === 'number' ? (sum += day.edited_ratting, count++) : sum ;
            })
            return  sum == 0 ? 'Bez hodnotenia' : sum/count

        }

    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>


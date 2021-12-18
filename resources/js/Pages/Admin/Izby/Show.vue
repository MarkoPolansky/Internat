<template   >
    <Dashboard>


        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Izba / {{apartment.name}}</h1>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full xl:w-1/2 px-3">
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


                <div class="w-full xl:w-1/2 px-3">
                    <p class="text-xl font-semibold mb-4"> Hodnotenie izby za posledné 4 týždne</p>

                    <template  v-for="week in rattingByWeeks"  >

                        <div class="w-full overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-8 ">
                            <table class="border-collapse table-fixed; w-full whitespace-no-wrap bg-white  relative">
                                <thead>
                                <tr class="text-left">

                                    <th  class="w-1/2 cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Deň
                                    </th>
                                    <th  class="w-1/2 cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Hodnotenie
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <template  v-for="rating in week" >
                                    <tr  >
                                        <td :class="[rating.edited_ratting == 100 || rating.edited_ratting == 'Bez hodnotenia'  ? ' border-green-500' : 'border-red-500 ']"
                                            class="border-l-8 border-t "
                                            style="border-top-color: rgb(229, 231, 235)">
                                        <span  class=" text-gray-700 px-6 py-3 flex items-center">
                                            {{rating.day_for_human.charAt(0).toUpperCase() + rating.day_for_human.slice(1)}}
                                        </span>
                                        </td>
                                        <td  class=" border-t border-gray-200 lastName">
                                        <span class="text-gray-700 px-6 py-3 flex items-center">
                                            {{rating.edited_ratting}}
                                        </span>
                                        </td>
                                    </tr>
                                </template>

                                <tr class="border-l-8" >
                                    <td class=" text-md border-dotted border-t-4  border-gray-200 " >
                                            <span class=" text-gray-700 px-6 py-3 flex ">
                                                Priemer:
                                            </span>
                                    </td>
                                    <td class=" border-t-4 border-dotted border-gray-200 ">
                                            <span class="text-gray-700 px-6 py-3 flex items-center">
                                                {{avg(week)}}
                                            </span>
                                    </td>
                                </tr>

                                </tbody>

                            </table>



                        </div>
                    </template>
                </div>
            </div>




        </div>

    </Dashboard>

</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import {Head, Link} from "@inertiajs/inertia-vue3";


export default {
    components:{
        Dashboard,
        Link,
        Head,
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


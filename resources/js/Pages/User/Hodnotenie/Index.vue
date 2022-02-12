<template   >
    <Dashboard>
        <Head title="Hodnotenie izby" />

        <div class="container mx-auto  py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Hodnotenie izby za posledné 4 týždne</h1>



                <div class="flex flex-wrap -mx-3">
                    <div class="w-full xl:w-1/2 px-3 mt-8">
                        <p class="text-xl font-semibold mb-4 ">Hodnotenie izby za posledné 4 týždne</p>

                        <div class="flex flex-col justify-center ">

                            <div class="w-full bg-white border rounded-lg p-4 mb-8 "  v-for="(week,index) in rattings">
<!--                                <p class="text-xl font-semibold text-center ">{{ index }}</p>-->

                                <GraphRoomRatting  :ratting="week" >
                                </GraphRoomRatting>


                            </div>
                        </div>
                    </div>


                    <div class="w-full xl:w-1/2 px-3 mt-8">
                        <p class="text-xl font-semibold  mb-4">Vychádzky podľa bodovania izby</p>
                        <div class="w-full overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-8 ">
                            <table class="border-collapse table-fixed; w-full whitespace-no-wrap bg-white  relative">
                                <thead>
                                <tr class="text-left">
                                    <th  class="w-5/12  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Priemer Hodnotenia
                                    </th>
                                    <th  class="w-5/12  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Vychádzky do
                                    </th>

                                </tr>
                                </thead>
                                <tbody>

                                <template  v-for="(rating,index) in ratingRule" >
                                    <tr class=" border-t">
                                        <td  class=" border-t border-gray-200 ">
                                                    <span v-if="index == 0" class="text-gray-700 px-6 py-3 flex items-center">
                                                       100 - {{rating.edited_min_rating}}
                                                    </span>
                                                <span v-else class="text-gray-700 px-6 py-3 flex items-center">
                                                       {{ratingRule[index-1].edited_min_rating}} - {{rating.edited_min_rating}}
                                                    </span>
                                        </td>

                                        <td  class=" border-t border-gray-200 ">
                                                    <span class="text-gray-700 px-6 py-3 flex items-center">
                                                        {{rating.until.substring(0,5)}}
                                                    </span>
                                        </td>

                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>


    </Dashboard>

</template>

<script>
import Dashboard from "@/Layouts/User/Dashboard";
import BreezeButton from "@/Components/Button";
import GraphRoomRatting from "@/Components/GraphRoommRattingMultiple";
import {Head,Link} from "@inertiajs/inertia-vue3";

export default {
    components:{
        Dashboard,
        BreezeButton,
        Link,
        Head,
        GraphRoomRatting
    },
    props:{
        rattings: Object,
        ratingRule: Object
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

<style scoped>

</style>

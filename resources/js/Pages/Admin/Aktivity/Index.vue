<template   >
    <Dashboard>
        <Head title="Ostatné Aktivity" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Ostatné Aktivity</h1>
            <div class="flex flex-wrap -mx-3">

                <div class="w-full xl:w-1/2 px-3 mb-8 xl:mb-0 ">
                    <div class="flex gap-2 justify-between mb-12">
                    <p class="text-2xl font-semibold ">Dnešná Aktivita</p>

                        <a  @click.prevent="showingModalPickActivity = true" href="#">
                            <div>
                                <button class="inline-flex whitespace-nowrap items-center border font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 text-sm leading-5 rounded-xl border-transparent shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 -ml-1 mr-2 h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>

                                    Vybrať Aktivitu</button>
                            </div>
                        </a>
                    </div>


                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative "
                         >
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                            <tr class="text-left">

                                <th  class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Aktivita
                                </th>
                                <th  class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Od
                                </th>
                                <th   class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Do
                                </th>
                                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">

                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            <template v-for="activity in activities" :key="activity.id">


                            <tr class="hover:bg-gray-100">

                                <td class="border-dashed border-t border-gray-200 userId">
                                    <Link :href="route('admin.activity.edit',activity.id)" class="text-gray-700 px-6 py-3 flex items-center" >
                                        <span>{{activity.available_activity.name}}</span>
                                    </Link>
                                </td>
                                <td class="border-dashed border-t border-gray-200 firstName">
                                    <Link :href="route('admin.activity.edit',activity.id)" class="text-gray-700 px-6 py-3 flex items-center" >
                                        <span>{{activity.starts_at}}</span>
                                    </Link>
                                </td>
                                <td class="border-dashed border-t border-gray-200 lastName">
                                    <Link :href="route('admin.activity.edit',activity.id)" class="text-gray-700 px-6 py-3 flex items-center" >
                                        <span>{{activity.ends_at}}</span>
                                    </Link>
                                </td>
                                <td class="border-dashed border-t  border-gray-200 ">
                                    <Link :href="route('admin.activity.edit',activity.id)" class="text-gray-700 px-6  flex items-center">
                                        <div class="text-gray-700 px-6 py-3 flex items-center gap-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                       </div>
                                    </Link>
                                </td>
                             </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="w-full xl:w-1/2 px-3 mb-8 xl:mb-0">
                    <p class="text-2xl font-semibold mb-12">Dnešné hlasovanie</p>
                    <div class="flex gap-3 flex-col sm:flex-row ">
                        <div class="flex-1" v-for="availableActivity in availableActivities" :key="availableActivity.id">
                            <p  class="text-xl font-semibold mb-4">
                                {{availableActivity.name}}</p>
                            <div class="w-full bg-white border rounded-lg p-4 ">
                                <div v-for="vote in availableActivity.today_voters" :key="vote.id">
                                    <Link :href="route('admin.internatnici.show',vote.user)" >
                                        <div  class="w-full bg-gray-100 border rounded-lg flex justify-between items-center px-4 py-2 mb-4 ">
                                            <p class="font-semibold text-md">{{ vote.user.name }}</p>
                                        </div>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </div>

        <ModalAddActivity
            @close="showingModalPickActivity = false"
            :show="showingModalPickActivity"
            :availableActivities="availableActivities">
        </ModalAddActivity>



    </Dashboard>
</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import {Head,Link} from "@inertiajs/inertia-vue3";
import ModalAddActivity from "@/Components/ModalAddActivity";

import VueMultiselect from "vue-multiselect";


export default {
    components:{
        Dashboard,
        ModalAddActivity,
        Link,
        Head,
        VueMultiselect,
    },

    emits:['close'],

    props:{
        activities: Object,
        availableActivities: Object
    },

    data() {
        return {
            deleteForm: this.$inertia.form({
                id:''
            }),
            showingModalPickActivity: false,
            showingModalUpdateActivity: false,
            editingActivity: {}
        }
    },


}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>

<style>
.multiselect__tag {
    background-color: #3869d4;
}

.multiselect__option--highlight{
    background-color: #3869d4;
}
.multiselect__option--highlight::after{
    background-color: #3869d4;
}
</style>

<template   >
    <Dashboard>
        <Head title="Vychádzky" />


        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Vychádzky</h1>
            <div class="flex flex-wrap -mx-3">

                <div class="w-full xl:w-1/3 px-3  mb-8 xl:mb-0">
                    <p class="text-xl font-semibold mb-4">Na vychádzkach </p>

                    <div class="w-full bg-white border rounded-lg p-4">

                        <div v-for="outing in outings" :key="outing.id"
                             :class="[outing.is_late ? 'border-red-500' :' border-green-500']"
                             class="w-full bg-gray-100 border-l-8 rounded-lg flex justify-between items-center px-4 py-2 mb-4 ">
                            <div class="" >
                                <p class="font-semibold text-xl">{{ outing.user.name }}</p>
                                <p>Do: {{outing.available_outing.until.substring(0,5)}}</p>
                            </div>
                                <form method="post" @submit.prevent="submit(outing.id)">
                                    <button type="submit">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                    </button>
                                </form>
                        </div>
                    </div>
                </div>



                <div class="w-full xl:w-1/3 px-3  mb-8 xl:mb-0">
                    <p class="text-xl font-semibold mb-4">Príchod</p>

                    <div class="w-full bg-white border rounded-lg p-4">

                        <div v-for="outing in arrivedOutings" :key="outing.id"
                             :class="[outing.available_outing.until < outing.arrived ? 'border-red-500' :' border-green-500']"
                             class="w-full bg-gray-100 border-l-8 rounded-lg flex justify-between items-center px-4 py-2 mb-4 ">
                            <div>
                                <p class="font-semibold text-xl">{{ outing.user.name }}</p>
                                <p> Príchod: {{outing.arrived.substring(0,5)}}
                                    Do: {{outing.available_outing.until.substring(0,5)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="w-full xl:w-1/3 px-3 mb-8 xl:mb-0">
                    <div class="flex gap-4 mb-12">
                        <p class="text-xl font-semibold mb-4">Predlžené vychádzky podľa priemeru hodnotenia izby za minulý týždeň</p>


                        <a  @click.prevent="showingCreateModal = true" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                    </div>


                    <template  v-for="(group, name) in ratingRules"  >

                        <div class="w-full overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative mt-8 ">
                            <table class="border-collapse table-fixed; w-full whitespace-no-wrap bg-white  relative">
                                <thead>
                                <tr class="text-center">
                                    <th colspan="3"  class="w-1/2  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        {{name}}
                                    </th>
                                </tr>
                                <tr class="text-left">
                                    <th  class="w-5/12  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Priemer Hodnotenia
                                    </th>
                                    <th  class="w-5/12  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                        Vychádzky do
                                    </th>
                                    <th  class="w-2/12  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                <template  v-for="(rating,index) in group" >
                                    <tr class="hover:bg-gray-200 border-t">


                                        <td  class=" border-t border-gray-200 ">
                                            <Link class="text-gray-700 px-6  flex items-center" :href="route('admin.rating-rule.show',rating.id)">
                                                <span v-if="index == 0" class="text-gray-700 md:px-6 py-3 flex items-center">
                                                   100 - {{rating.edited_min_rating}}
                                                </span>
                                                <span v-else class="text-gray-700 md:px-6 py-3 flex items-center">
                                                   {{group[index-1].edited_min_rating}} - {{rating.edited_min_rating}}
                                                </span>
                                            </Link>
                                        </td>

                                        <td  class=" border-t border-gray-200 ">
                                            <Link class="text-gray-700 md:px-6  flex items-center" :href="route('admin.rating-rule.show',rating.id)">
                                                <span class="text-gray-700 px-6 py-3 flex items-center">
                                                    {{rating.until.substring(0,5)}}
                                                </span>
                                            </Link>
                                        </td>

                                        <td class=" border-t  border-gray-200 ">
                                            <Link class="text-gray-700 md:px-6 flex items-center" :href="route('admin.rating-rule.show',rating.id)">
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
                    </template>

                </div>



            </div>


        </div>

        <ModalCreateRattingRule @close="showingCreateModal = false" :show="showingCreateModal" >

        </ModalCreateRattingRule>


    </Dashboard>
</template>

<script>
import {Head,Link} from "@inertiajs/inertia-vue3";
import Dashboard from "@/Layouts/Admin/Dashboard";
import ModalCreateRattingRule from "@/Components/ModalCreateRattingRule";

export default {
    components:{
        Dashboard,
        ModalCreateRattingRule,
        Link,
        Head,
    },
    emits:['close'],

    props:{
        outings: Object,
        arrivedOutings: Object,
        ratingRules: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                outingId: null,
            }),
            showingCreateModal: false
        }
    },


    methods:{
        submit(outingId){
            this.form.outingId = outingId;
            this.form.post(this.route('admin.vychadzky.prichod'), {
                preserveScroll: true,
            })

        }
    },








}
</script>

<style scoped>

</style>

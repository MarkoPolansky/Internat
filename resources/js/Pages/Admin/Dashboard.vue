<template   >
    <Head title="Admin Dashboard" />

    <Dashboard>
        <div class="p-6  mb-20">


            <div class="flex flex-wrap sm:flex-row flex-col  mb-20">

                    <div class="sm:w-1/2 w-full  xl:w-1/4 px-3">
                        <Link :href="route('admin.vychadzky')">
                            <div class="w-full xl:h-full bg-white border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                                <svg class="w-16 h-16  mr-4 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>

                                <div class="text-gray-700">
                                    <p class="font-semibold text-3xl">{{ outings.length }}</p>
                                    <p>Na vychádzkach</p>
                                </div>
                            </div>
                        </Link>
                    </div>



                    <div class="sm:w-1/2 w-full  xl:w-1/4 px-3">
                        <Link :href="route('admin.hodnotenie.create')">
                            <div class="w-full xl:h-full bg-white border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16  mr-4 hidden lg:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                <div class="text-gray-700">
                                    <p class="font-semibold text-3xl">{{ rattedRooms }} / {{roomsCount}}</p>
                                    <p>Ohodnotených izieb</p>
                                </div>
                            </div>
                         </Link>
                    </div>


                <div class="sm:w-1/2 w-full  xl:w-1/4 px-3">
                    <div v-if="activities.length == 0"  class="w-full xl:h-full bg-white border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0" >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16  mr-4 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                        </svg>
                        <div  class="text-gray-700">
                                <a @click.prevent="showingModalPickActivity = true" class="font-semibold text-xl" href="">
                                    Vybrať aktivitu
                                </a>
                        </div>
                    </div>

                    <Link v-else  :href="route('admin.activity.index')">

                        <div class="w-full xl:h-full bg-white border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16  mr-4 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                            </svg>
                            <div  class="text-gray-700">
                                <div  v-for="activity in activities" :key="activity.id" >
                                    <p  class="font-semibold text-xl">
                                        {{activity.available_activity.name}}
                                    </p>
                                        <p> {{activity.starts_at}} - {{activity.ends_at}}</p>
                                </div>

                            </div>

                        </div>

                    </Link >

                </div>


                    <div class="sm:w-1/2 w-full  xl:w-1/4 px-3">
                        <Link :href="route('admin.workout')">
                        <div class="w-full  bg-white border text-blue-400 rounded-lg flex items-center p-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16  mr-4 hidden lg:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>

                            <div class="text-gray-700">
                                <p class="font-semibold text-3xl">{{workouts.length}}</p>
                                <p>Na workoute</p>
                            </div>

                        </div>
                        </Link>
                    </div>


            </div>

            <div class="flex flex-wrap -mx-3">

                <div class="w-full xl:w-1/3 px-3 mb-8 xl:mb-0 ">
                    <p class="text-xl font-semibold mb-4">Práve na vychádzkach</p>

                    <div class=" w-full overflow-y-auto bg-white border rounded-lg p-4 max-h-96">

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

                <div class="w-full xl:w-1/3 px-3 ">
                    <p class="text-xl font-semibold mb-4">Hlasovanie o aktivite</p>
                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                        <GraphTodayActivityVoting :availableActivities="availableActivities">

                        </GraphTodayActivityVoting>
                    </div>
                </div>

                <div class="w-full xl:w-1/3 px-3 mb-8 xl:mb-0">
                    <p class="text-xl font-semibold mb-4">Aktuálne Na Workoute</p>
                    <div class="w-full bg-white border rounded-lg p-4">
                        <div v-for="workout in workouts" :key="workout.id"
                             class="w-full bg-gray-100 border-l-8 border-green-500 rounded-lg flex justify-between items-center px-4 py-2 mb-4 ">
                            <div class="" >
                                <p class="font-semibold text-xl">{{ workout.user.name }}</p>
                                <p>Začiatok: {{workout.created_at.split(' ')[1].substring(0,5)}}</p>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

<!--        <ModalPickActivity @close="showingModalPickActivity = false"-->
<!--                           :show="showingModalPickActivity"-->
<!--                            :availableActivities="availableActivities"/>-->

        <ModalAddActivity
            @close="showingModalPickActivity = false"
            :show="showingModalPickActivity"
            :availableActivities="availableActivities">

        </ModalAddActivity>

    </Dashboard>


</template>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3';
import GraphTodayActivityVoting from "@/Components/GraphTodayActivityVoting";
import Dashboard from "@/Layouts/Admin/Dashboard";
import BreezeButton from "@/Components/Button";
import ModalAddActivity from "@/Components/ModalAddActivity";

export default {
    components:{
        Dashboard,
        Head,
        BreezeButton,
        GraphTodayActivityVoting,
        ModalAddActivity,
        Link
    },
    props:{
        rattedRooms: Number,
        roomsCount: Number,
        outings: Object,
        availableActivities: Object,
        activities: Object,
        workouts: Object,

    },

    emits: ['close'],

    data() {
        return {
            showingModalPickActivity: false,
            form: this.$inertia.form({
                outingId: null,
            }),

        }
    },

    methods: {

        submit(outingId){
            this.form.outingId = outingId;
            this.form.post(this.route('admin.vychadzky.prichod'), {
                preserveScroll: true,
            })

        }
    },

    created(){
        window.Echo.private('outing')
        .listen('OutingCreated',(event) =>{
            this.outings.unshift(event.outing)
        })
    }


}
</script>

<style scoped>

</style>

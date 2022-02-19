<template>
    <Head title="Dashboard" />

    <Dashboard>
        <div class="p-6  mb-20">



        <div class="flex flex-wrap sm:flex-row flex-col  mb-20 ">

            <div  class="sm:w-1/2 w-full  xl:w-1/4 px-3">
                <div   class="w-full xl:h-full bg-white border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                    <svg :class="[outing ? 'text-green-500' : '']" class="w-16 h-16  mr-4 hidden lg:block " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>

                        <div   class="text-gray-700">
                            <p  class="font-semibold text-2xl">Vychádzky</p>

                            <p v-if="outing"  class="font-semibold text-xl">Do {{ outing.available_outing.until.substring(0,5) }}</p>
                            <p v-if="outing" >Nezabudni svoj príchod nahlásiť</p>

                            <template v-else>

                                <div v-if="available_outing == null"  class="text-gray-700">
                                    <p>Bez pridelenej vychádzky</p>
                                </div>

                                <div v-else-if="available_outing.is_late_for_outing"  class="text-gray-700">
                                    <p  class="font-semibold text-2xl">Do {{ HoursMinutes }}</p>
                                    <p>Neskoro na vychádzku</p>
                                </div>
                                <div v-else-if="available_outing.is_banned"  class="text-red-700">
                                    <p>Vychádzky zakázané</p>
                                </div>

                                <div v-else  class="text-gray-700">

                                    <p  class="font-semibold text-2xl">Do {{ HoursMinutes }}</p>

                                    <button form="form" :disabled="form.processing" type="submit">Zobrať vychádzku</button>
                                    <form id="form" method="post" @submit.prevent="submit" >
                                    </form>

                                </div>
                            </template>


                        </div>
                </div>
            </div>

            <div class="sm:w-1/2 w-full  xl:w-1/4  px-3">
                <div class="w-full xl:h-full bg-white border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                    <svg  class="w-16 h-16 text-sm mr-4 hidden lg:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    <div class="text-gray-700">
                        <p class="font-semibold text-2xl">Upratovanie</p>
                        <p v-if="cleaning" class="font-semibold text-2xl">{{DayFormat}}</p>
                        <p v-else> Bez upratovania</p>

                    </div>


                </div>
            </div>

            <div class="sm:w-1/2 w-full  xl:w-1/4  px-3">

                <div   class="w-full xl:h-full bg-white border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0" >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16  mr-4 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                    </svg>
                    <div v-if="activities.length == 0" class="text-gray-700">
                        <p class="font-semibold text-2xl text-gray-700 ">Aktivita</p>
                        <p>Aktivita nebola vybratá</p>
                    </div>


                    <div v-else class="text-gray-700">
                        <p class="font-semibold text-2xl text-gray-700 ">Aktivita</p>

                        <div  v-for="activity in activities" :key="activity.id" >
                            <p  class="font-semibold text-xl">
                                {{activity.available_activity.name}}
                            </p>
                            <p> {{activity.starts_at}} - {{activity.ends_at}}</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="sm:w-1/2 w-full  xl:w-1/4  px-3 ">
                <form @submit.prevent></form>
                <div v-if="!isOnWorkout" @click="goWorkout" class="w-full  xl:h-full bg-white hover:bg-blue-100 cursor-pointer border text-blue-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16  mr-4 hidden lg:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>

                    <div class="text-gray-700">
                        <p class="font-semibold text-3xl">Workout</p>
                        <p>Idem na workout</p>
                    </div>

                </div>
                <div v-else @click="backWorkout" class="w-full  xl:h-full bg-white hover:bg-blue-100 cursor-pointer border text-green-400 rounded-lg flex items-center p-6 mb-6 xl:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16  mr-4 hidden lg:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>

                    <div class="text-gray-700">
                        <p class="font-semibold text-3xl">Workout</p>
                        <p>Vrátil som sa </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3">

            <div class="w-full xl:w-1/3 px-3">
                <p class="text-xl font-semibold mb-4">Hodnotenie izby tohto týždňa</p>

                <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                    <GraphRoomRatting :ratting="rattedDays">

                    </GraphRoomRatting>

                </div>
            </div>

            <div class="w-full xl:w-1/3 px-3">
                <p class="text-xl font-semibold mb-4">Hlasovanie o aktivite</p>

                <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                    <GraphTodayActivityVoting :availableActivities="availableActivities">

                    </GraphTodayActivityVoting>

                    <div class="flex justify-between text-center gap-x-2 px-8 ">
                        <button v-for="activity in availableActivities"
                                @click="vote(activity)"
                                type="submit"
                                style="	font-size: 0.6rem; line-height: 0.8rem;"
                                class="w-full mx-auto overflow-hidden items-center px-2 py-2 bg-gray-800 border border-transparent rounded-md font-semibold  text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                :class="{ 'opacity-25': activityForm.processing , 'bg-chartBlue hover:bg-chartBlue cursor-default focus:border-chartBlue': activity.today_voters.length > 0  }"    >
                            {{ activity.name }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full xl:w-1/3 px-3">
                <p class="text-xl font-semibold mb-4">Oznámenia</p>
                <div class="w-full bg-white border rounded-lg p-4 max-h-100 overflow-y-auto">
                    <div v-for="announcement in announcements" :key="announcement.id"
                         class="w-full bg-gray-100 border rounded-lg flex justify-between items-center px-4 py-2 mb-4">
                        <div>
                            <p class="font-semibold text-xl">{{ announcement.title }}</p>
                            <p> {{ announcement.body }}</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
</div>
    </Dashboard>
</template>

<script>
import Dashboard from '@/Layouts/User/Dashboard'
import { Head } from '@inertiajs/inertia-vue3';
import {computed} from "vue";
import BreezeButton from "@/Components/Button";
import GraphTodayActivityVoting from "@/Components/GraphTodayActivityVoting";
import GraphRoomRatting from "@/Components/GraphRoomRatting";

export default {
    components: {
        Dashboard,
        Head,
        BreezeButton,
        GraphTodayActivityVoting,
        GraphRoomRatting
    },

    props: {
        available_outing: Object,
        outing: Object,
        cleaning: Object,
        announcements: Object,
        availableActivities: Object,
        activities: Object,
        rattedDays: Object,
        isOnWorkout: Number ,

    },

    data() {
        return {
            form: this.$inertia.form({
            }),
            activityForm: this.$inertia.form({
                activityId: null
            }),
            workout: this.$inertia.form({
            }),
        }
    },


    computed: {
        HoursMinutes() {
            return this.available_outing.until.substring(0,5)
        },
        DayFormat(){
           return this.cleaning.day_for_human.charAt(0).toUpperCase() + this.cleaning.day_for_human.split(' ')[0].slice(1);
        }

    },
    methods: {
        vote(activity){
            this.activityForm.activityId = activity.id
            this.activityForm.post(this.route('activity.vote'),{
                preserveScroll: true
            })
        },
        submit() {
            this.form.post(this.route('vychadzky.odchod'),{
                preserveScroll: true
            })
        },

        goWorkout(){
            this.workout.post(this.route('workout.odchod'),{
                preserveScroll: true
            })
        },
        backWorkout(){
            this.workout.post(this.route('workout.prichod'),{
                preserveScroll: true
            })
        },

        isOutingBanned(){
               return this.available_outing.is_banned
        }
    },






}
</script>

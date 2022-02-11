<template   >
    <Dashboard>
        <Head title="Workout" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Workout</h1>
            <div class="flex flex-wrap -mx-3">

                <div class="w-full xl:w-1/3 px-3">
                    <p class="text-xl font-semibold mb-4">Aktuálne Na Workoute</p>
                    <div class="w-full bg-white border rounded-lg p-4">
                        <div v-for="workout in onWorkouts" :key="workout.id"
                             class="w-full bg-gray-100 border-l-8 border-green-500 rounded-lg flex justify-between items-center px-4 py-2 mb-4 ">
                            <div class="" >
                                <p class="font-semibold text-xl">{{ workout.user.name }}</p>
                                <p>Začiatok: {{workout.created_at.split(' ')[1].substring(0,5)}}</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="w-full xl:w-1/3 px-3">
                    <p class="text-xl font-semibold mb-4">Vrátili sa z Workoutu</p>

                    <div class="w-full bg-white border rounded-lg p-4">

                        <div v-for="workout in arrivedWorkouts" :key="workout.id"
                             class="w-full bg-gray-100 border-l-8 rounded-lg flex justify-between items-center px-4 py-2 mb-4 ">
                            <div>
                                <p class="font-semibold text-xl">{{ workout.user.name }}
                                </p>
                                <p> Začiatok: {{workout.created_at.split(' ')[1].substring(0,5)}}
                                    Príchod: {{workout.arrived.split(' ')[1].substring(0,5)}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>



            </div>



            <div class="w-full xl:w-1/2 mb-12 xl:mb-0 px-4 mx-auto mt-24">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ">

                    <div class="block w-full overflow-x-auto ">


                    </div>
                </div>
            </div>

        </div>

    </Dashboard>
</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import {Head} from "@inertiajs/inertia-vue3";

export default {
    components:{
        Dashboard,
        Head

    },
    props:{
        workouts: Object,

    },
    data() {
        return {
            form: this.$inertia.form({
                outingId: null,
            }),
        }
    },

    computed:{
        arrivedWorkouts(){
            return this.workouts.filter((workout)=>{
                return workout.arrived != null
            })
        },
        onWorkouts(){
            return this.workouts.filter((workout)=>{
                return workout.arrived == null
            })
        },

    },

    methods:{
        submit(outingId){
            this.form.post(this.route('admin.vychadzky.prichod'), {
                preserveScroll: true,
            })

        }
    },

    mounted(){
        console.log(this.workouts)
    }
}
</script>

<style scoped>

</style>

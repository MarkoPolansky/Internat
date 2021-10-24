<template   >
    <Dashboard>


        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Vychádzky</h1>
            <div class="flex flex-wrap -mx-3">

                <div class="w-full xl:w-1/3 px-3">
                    <p class="text-xl font-semibold mb-4">Dnes</p>

                    <div class="w-full bg-white border rounded-lg p-4">

                        <div v-for="outing in outings" :key="outing.id" class="w-full bg-gray-100 border rounded-lg flex justify-between items-center px-4 py-2 mb-4 ">
                            <div>
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

export default {
    components:{
        Dashboard,

    },
    props:{
        outings: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                outingId: null,
            }),
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

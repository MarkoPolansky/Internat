<template   >
    <Dashboard>


        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Hodnotenie Izieb</h1>



                <div class="w-full xl:w-1/2 mb-12 xl:mb-0 px-4 mx-auto mt-24">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ">

                        <div class="block w-full overflow-x-auto ">

                            <form @submit.prevent="submit" action="">

                            <table class="items-center bg-transparent w-full border-collapse ">
                                <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6   align-middle border border-solid border-blueGray-100 py-3 text-lg uppercase border-l-0 border-r-0 whitespace-nowrap  text-left text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Izba
                                    </th>
                                    <th class="px-6   align-middle border border-solid border-blueGray-100 py-3 text-lg uppercase border-l-0 border-r-0 whitespace-nowrap  text-left text-gray-600 font-bold tracking-wider uppercase text-xs">
                                        Hodnotenie
                                    </th>

                                </tr>
                                </thead>

                                <tbody>
                                <template v-for="room in rooms" :key="room.id">
                                    <tr>
                                        <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left  text-gray-600 font-bold tracking-wider uppercase text-xs ">
                                            {{room.name}}
                                        </th>
                                        <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4 ">
                                            <StarRating  v-model:rating="form[room.id].rating"  v-if="room.today_ratting" :rating="room.today_ratting.rating" :show-rating="false" :increment="0.5">
                                            </StarRating>

                                            <StarRating v-else  v-model:rating="form[room.id].rating"  :show-rating="false" :increment="0.5">
                                            </StarRating>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>


                            </table>



                                <button class=" w-full mx-auto border-2 rounded-lg  p-4 bg-white hover:text-blue-500  text-2xl bg-blue-500 text-white text-bold" type="submit">
                                    Uložiť
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

        </div>






    </Dashboard>
</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import StarRating from 'vue-star-rating'
export default {
    components:{
        Dashboard,
        StarRating

    },
    props:{
        rooms: Array
    },


    data() {
        return {
            form: {
            }

        }
    },

    methods: {
        submit() {

            this.$inertia.post(this.route('admin.hodnotenie.update'),this.form )

        },

    },



    beforeMount() {
        this.rooms.forEach((room) =>{
            if (room.today_ratting)
            this.form[room.id] = {'rating': room.today_ratting.rating,'ratingId': room.today_ratting.id}
            else
                this.form[room.id] = {'rating': null,'ratingId': null}
        })

        console.log(this.form)
    }


}
</script>

<style scoped>

</style>

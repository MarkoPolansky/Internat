<template   >
    <Dashboard>





        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Hodnotenie Izieb</h1>
<!--                <div class="w-1/2 sm:w-full mb-12 xl:mb-0 px-4  mt-6">-->
<!--                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ">-->


               <div class="flex flex-wrap -mx-3">
                 <div class="w-full xl:w-1/3 px-3">
                     <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative ">
                         <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                             <thead>
                             <tr class="text-left">

                                 <th  class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                     Izba
                                 </th>
                                 <th  class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                     Hodnotenie
                                 </th>
                             </tr>
                             </thead>
                             <tbody>
                             <template v-for="room in rooms" :key="room.id">


                                 <tr class="p-2">

                                     <td class="  border-gray-200 text-gray-700 px-6 py-3 flex items-center">
                                         {{room.name}}
                                     </td>
                                     <td class=" border-gray-200 ">
                                         <StarRating  v-model:rating="form[room.id].rating"  v-if="room.today_ratting" :rating="room.today_ratting.rating" :show-rating="false" :increment="0.5">
                                         </StarRating>

                                         <StarRating v-else  v-model:rating="form[room.id].rating"  :show-rating="false" :increment="0.5">
                                         </StarRating>
                                     </td>
                                 </tr>
                             </template>
                             </tbody>
                         </table>
                         <form @submit.prevent="submit" action="">
                             <div class="flex justify-center m-4">
                                 <BreezeButton >
                                     Uložiť
                                 </BreezeButton>
                             </div>
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
import BreezeButton from "@/Components/Button";

export default {
    components:{
        Dashboard,
        StarRating,
        BreezeButton

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

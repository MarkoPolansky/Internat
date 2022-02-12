<template   >
    <Dashboard>
        <Head title="Hodnotenie Izieb" />




        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Hodnotenie Izieb</h1>
<!--                <div class="w-1/2 sm:w-full mb-12 xl:mb-0 px-4  mt-6">-->
<!--                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ">-->


               <div class="flex flex-wrap -mx-3">
                 <div class="w-full xl:w-1/2 px-3">
                     <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative ">
                         <table class="border-collapse table-fixed w-full whitespace-no-wrap bg-white table-striped relative">
                             <thead>
                             <tr class="text-left">

                                 <th  class="w-1/5  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                     Izba
                                 </th>
                                 <th  class="w-2/5  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                     Hodnotenie
                                 </th>
                                 <th  class="w-2/5  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                     Stratené body za
                                 </th>
                             </tr>
                             </thead>
                             <tbody>
                             <template v-for="room in rooms" :key="room.id">


                                 <tr class="p-2">

                                     <td class="  border-gray-200 text-gray-700 px-6 py-3 ">
                                         {{room.name}}
                                     </td>
                                     <td class=" border-gray-200 ">
                                         <StarRating  v-model:rating="form[room.id].rating"  v-if="room.today_ratting" :rating="room.today_ratting.rating" :show-rating="false" :increment="0.5">
                                         </StarRating>

                                         <StarRating v-else  v-model:rating="form[room.id].rating"  :show-rating="false" :increment="0.5">
                                         </StarRating>
                                     </td>


                                     <td v-show="form[room.id].rating <5 && form[room.id].rating >=0.5" class="p-2">

                                         <div class="border-gray-200 text-gray-700 px-6 flex items-center">
                                             <BreezeInput type="text" class="block w-full" v-model="form[room.id].message" />
                                         </div>
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
import {Head} from "@inertiajs/inertia-vue3";
import StarRating from 'vue-star-rating'
import BreezeButton from "@/Components/Button";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";

export default {
    components:{
        Dashboard,
        Head,
        StarRating,
        BreezeButton,
        BreezeInput,
        BreezeLabel,

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
            this.form[room.id] = {'rating': room.today_ratting.rating,'ratingId': room.today_ratting.id,'message': room.today_ratting.message}
            else
                this.form[room.id] = {'rating': null,'ratingId': null,'message':null}
        })

    }


}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>

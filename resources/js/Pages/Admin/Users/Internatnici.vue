<template   >
    <Dashboard>
        <Head title="Internatisti" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Internatisti</h1>



            <div class="mb-4 flex justify-between items-center">
                <div class="flex-1 pr-4 ">
                    <div class="relative md:w-1/3">
                        <input v-model="search" type="search"
                               class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                               placeholder="Hľadať...">
                        <div class="absolute top-0 left-0 inline-flex items-center p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </div>
                    </div>
                </div>

                <Link :href="route('admin.invite.create')">
                    <div>
                        <button class="inline-flex whitespace-nowrap items-center border font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 text-sm leading-5 rounded-xl border-transparent shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 -ml-1 mr-2 h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>

                            Pozvať poúživateľa</button>
                    </div>
                </Link>

            </div>

            <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-192 ">
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                    <tr class="text-left">

                        <th @click="sortByName" class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                            Meno
                        </th>
                        <th @click="sortByClass" class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                            Skupina
                        </th>
                        <th  @click="sortByApartment" class="cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                            Izba
                        </th>
                        <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">

                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="user in filteredUsers" :key="user.id">
                        <tr class="hover:bg-gray-100">
                            <td class="border-dashed border-t border-gray-200 ">
                                <Link class="text-gray-700 px-6 py-3 flex items-center" :href="route('admin.internatnici.show',user)">
                                 <span  >{{user.name}}</span>
                                </Link>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <Link class="text-gray-700 px-6 py-3 flex items-center" :href="route('admin.internatnici.show',user)">
                                <span v-if="user.class" >{{user.class}}</span>
                                </Link>
                            </td>
                            <td class="border-dashed border-t border-gray-200 ">
                                <Link class="text-gray-700 px-6 py-3 flex items-center" :href="route('admin.internatnici.show',user)">
                                    <span  v-if="user.apartment" >{{user.apartment.name}}</span>
                                </Link>
                            </td>
                            <td class="border-dashed border-t  border-gray-200 ">
                                    <Link class="text-gray-700 px-6 py-3 flex justify-end" :href="route('admin.internatnici.show',user)">
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
        </div>





    </Dashboard>

</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import Modal from "@/Components/Modal";
import BreezeButton from "@/Components/Button";
import {Head,Link} from "@inertiajs/inertia-vue3";



export default {
    components:{
        Dashboard,
        Modal,
        Head,
        BreezeButton,
        Link
    },
    props:{
        users: Object
    },
    data() {
        return {
            search: '',
            isSortedByClass: false,
            isSortedByName: false,
            isSortedByApartment: false,
        }
    },

    computed:{
      filteredUsers(){
           return this.users.filter((user) =>{
               if( user.apartment &&  user.class)
               return user.name.toLowerCase().includes(this.search.toLowerCase()) ||
                     user.apartment.name.toLowerCase().includes(this.search.toLowerCase())||
                     user.class.toString().includes(this.search.toLowerCase())
               else
               if (user.apartment)
                   return user.name.toLowerCase().includes(this.search.toLowerCase()) ||
                       user.apartment.name.toLowerCase().includes(this.search.toLowerCase())
               else
                   if (user.class)
                       return user.name.toLowerCase().includes(this.search.toLowerCase()) ||
                           user.class.toString().includes(this.search.toLowerCase())
               else
                   return user
           })
     }
    },

    methods: {

        sortByClass(){
            this.isSortedByClass = !this.isSortedByClass
            this.users.sort((a,b) =>{
                let fa = a.class,
                    fb = b.class;

                if (fa < fb) {
                    return this.isSortedByClass;
                }
                if (fa > fb) {
                    return !this.isSortedByClass;
                }
                return 0;
            })
        },
        sortByName(){
            this.isSortedByName = !this.isSortedByName
            this.users.sort((a,b) =>{
                let fa = a.name,
                    fb = b.name;

                if (fa < fb) {
                    return this.isSortedByName;
                }
                if (fa > fb) {
                    return !this.isSortedByName;
                }
                return 0;
            })
        },
        sortByApartment(){
            console.log(this.users)
            this.isSortedByApartment = !this.isSortedByApartment
            this.users.sort((a,b) =>{
                let fa = a.apartment_id,
                    fb = b.apartment_id;

                if (fa < fb) {
                    return this.isSortedByApartment;
                }
                if (fa > fb) {
                    return !this.isSortedByApartment;
                }
                return 0;
            })
        },
    },


}
</script>

<style scoped>

</style>

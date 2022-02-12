<template   >
    <Dashboard>
        <Head title="Dostupné aktivity" />


        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Dostupné aktivity</h1>
            <div class="flex flex-wrap -mx-3">

                <div class="w-full xl:w-1/2 px-3">
                    <p class="text-2xl font-semibold mb-12">Pridať Aktivitu</p>

                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                        <BreezeValidationErrors class="mb-4" />
                        <form @submit.prevent="submit">
                            <div>
                                <BreezeLabel for="name" value="Názov Aktivity" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required  />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Vytvoriť
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>




                <div class="w-full xl:w-1/2 px-3 ">
                    <p class="text-2xl font-semibold mb-12 ">Všetky aktivity</p>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative ">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                            <tr class="text-left">
                                <th   class="w-4/5 cursor-pointer bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Aktivita
                                </th>
                                <th class="w-1/5 bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">

                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            <template v-for="activity in availableActivities" :key="activity.id">


                                <tr class="hover:bg-gray-100">

                                    <td class="border-dashed border-t border-gray-200 userId">
                                        <Link :href="route('admin.availableActivities.edit',activity.id)" class="text-gray-700 px-6 py-3 flex items-center" >
                                            <span>{{activity.name}}</span>
                                        </Link>
                                    </td>

                                    <td class="border-dashed border-t  border-gray-200 ">
                                        <Link :href="route('admin.availableActivities.edit',activity.id)" class="text-gray-700 px-6 py-3 flex justify-end">
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




            </div>

<!--            <div class="w-full xl:w-1/2 mb-12 xl:mb-0 px-4 mx-auto mt-24">-->
<!--                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-lg ">-->

<!--                    <div class="block w-full overflow-x-auto ">-->

<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

        </div>





    </Dashboard>
</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import {Head, Link} from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";


export default {
    components:{
        Dashboard,
        Head,
        Link,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },

    emits:['close'],

    props:{
        availableActivities: Object
    },

    data() {
        return {
            form: this.$inertia.form({
                name:''
            }),
        }
    },

    methods:{
        submit(){
            this.form.post(route('admin.availableActivities.store'),{
                preserveScroll: true,
                onSuccess: () => this.form.reset('name')
            })
        },
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

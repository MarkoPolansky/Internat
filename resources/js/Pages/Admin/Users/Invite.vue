<template>
    <Head title="Pozvať poúživateľa " />

    <Dashboard>

        <div class="container mx-auto py-4 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Pozvať poúživateľa </h1>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full xl:w-1/3 px-3 mb-8 xl:mb-0">
                    <p class="text-xl font-semibold mb-4">Pozvánka</p>
                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                        <BreezeValidationErrors class="mb-4" />
                        <form @submit.prevent="submit">

                            <div>
                                <BreezeLabel for="name" value="Meno" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                            </div>

                            <div class="mt-4">
                                <BreezeLabel  value="Rola" />
                                <VueMultiselect v-model="form.role"
                                                :options="roles"
                                                :preselectFirst="true"
                                                placeholder="Hľadať"
                                                selectedLabel="Pridaný"
                                                selectLabel="Enter pre pridanie"
                                                deselectLabel="Enter pre odobratie"
                                                label="name"
                                                track-by="name">
                                </VueMultiselect>


                            </div>


                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4 " :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Pozvať
                                </BreezeButton>
                            </div>
                        </form>

                    </div>
                </div>


                <div class="w-full xl:w-2/3 px-3 mb-8 xl:mb-0">
                    <p class="text-xl font-semibold mb-4">Pozvánky</p>


                    <div class="w-full overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative max-h-96 ">
                        <table class="border-collapse table-fixed; w-full whitespace-no-wrap bg-white  relative">
                            <thead>
                            <tr class="text-left">
                                <th  class="w-1/2  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Meno
                                </th>
                                <th  class="w-1/2  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Email
                                </th>
                                <th  class="w-1/2  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Rola
                                </th>
                                <th  class="w-1/2  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                    Dní do expirácie
                                </th>
                                <th  class="w-1/2  bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-md">
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <template  v-for="invite in invited" >

                                <tr class="hover:bg-gray-100">
                                    <td class="border-dashed border-t border-gray-200 ">
                                                            <span class="text-gray-700 px-6 py-3 flex items-center">
                                                                {{invite.name}}</span>
                                    </td>

                                    <td class="border-dashed border-t border-gray-200 ">
                                                                <span class="text-gray-700 px-6 py-3 flex items-center">
                                                                    {{invite.email}}</span>
                                    </td>
                                    <td class="border-dashed border-t border-gray-200 ">
                                                                <span v-for="role in invite.roles"
                                                                      :class="[role.id == 1 ? 'bg-blue-600 hover:bg-blue-700': 'bg-red-600 hover:bg-red-700' ]"
                                                                      class="rounded-xl border-transparent text-sm p-1 shadow-sm text-white">
                                                                {{role.name}}
                                                                </span>
                                    </td>

                                    <td class="border-dashed border-t border-gray-200 ">
                                                                <span class="text-gray-700 px-6 py-3 flex justify-center">
                                                                   {{invite.status}}</span>
                                    </td>

                                    <td>

                                        <span class="text-red-600 px-6 py-3 flex items-center">
                                            <form method="post" @submit.prevent="deleteSubmit(invite.id)">
                                                <button :class="[deleteForm.processing ? 'opacity-25' : '']" :disabled="deleteForm.processing" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </span>
                                    </td>

                                </tr>

                            </template>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </Dashboard>
</template>

<script>
import Dashboard from '@/Layouts/Admin/Dashboard'
import { Head } from '@inertiajs/inertia-vue3';
import VueMultiselect from 'vue-multiselect'
import BreezeButton from "@/Components/Button";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import BreezeCheckbox from "@/Components/Checkbox";

export default {
    components: {
        Dashboard,
        Head,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        BreezeCheckbox,
        VueMultiselect

    },

    props: {
        invited: Object,
        roles: Object
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                role: ''
            }),

            deleteForm: this.$inertia.form({
            }),


        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.invite'),{
                preserveScroll: true,
                onSuccess: () => this.form.reset('name','email'),
            })
        },
        deleteSubmit(id){
            this.deleteForm.id = id
            this.deleteForm.delete(this.route('admin.invite.destroy',id),{
                preserveScroll: true,
                onSuccess: () => this.deleteForm.reset('id'),
            })
        }
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



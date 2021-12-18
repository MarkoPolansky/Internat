<template>
    <Head title="Dashboard" />

    <Dashboard>
        <div class="container mx-auto py-4 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Upratovanie</h1>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full xl:w-1/2 px-3">
                            <p class="text-xl font-semibold mb-4">Pridať upratovanie</p>

                            <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                                <BreezeValidationErrors class="mb-4" />

                                <form @submit.prevent="submit">
                                    <div>
                                        <BreezeLabel for="day" value="Deň" />
                                        <BreezeInput id="day" type="date" class="mt-1 block w-full" v-model="form.day" required autofocus autocomplete="day" />
                                    </div>

                                    <div class="mt-4">
                                        <BreezeLabel for="class" value="Skupina" />
                                        <select v-model="form.class" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full mt-1 block w-full" id="class" required autofocus >
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>


                                    <div class="flex items-center justify-end mt-4">
                                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Vytvoriť
                                        </BreezeButton>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="w-full xl:w-1/2 px-3">
                            <p class="text-xl font-semibold mb-4">Naplánované upratovania</p>
                            <div class="w-full bg-white border rounded-lg p-4">
                                <div v-for="cleaning in cleanings" :key="cleaning.id"
                                     class="w-full bg-gray-100 border rounded-lg flex justify-between items-center px-4 py-2 mb-4">
                                    <div>
                                        <p class="font-semibold text-xl">Skupina {{ cleaning.class }}</p>
                                        <p> {{ cleaning.day_for_human }}</p>
                                    </div>
                                    <span class="text-red-600">
                                <form method="post" @submit.prevent="deleteSubmit(cleaning.id)">
                                    <button :class="[deleteForm.processing ? 'opacity-25' : '']" :disabled="deleteForm.processing" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </span>
                                </div>
                            </div>
                        </div>



                    </div>
        </div>

    </Dashboard>
</template>

<script>
import Dashboard from '@/Layouts/Admin/Dashboard'
import { Head } from '@inertiajs/inertia-vue3';
import {computed} from "vue";
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
    },

    props: {
        cleanings: Object

    },

    data() {
        return {
            form: this.$inertia.form({
                class: String,
                day: Date,
            }),

            deleteForm: this.$inertia.form({
                id: null
            }),
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.upratovanie.store'),{
                preserveScroll: true,
                onSuccess: () => this.form.reset('class', 'day'),
            })
        },
        deleteSubmit(id){
            this.deleteForm.id = id
            this.deleteForm.delete(this.route('admin.upratovanie.destroy'),{
                preserveScroll: true,
                onSuccess: () => this.deleteForm.reset('id'),
            })
        }
    },



}
</script>

<template>
    <Head title="Oznámenia" />

    <Dashboard>

        <div class="container mx-auto py-4 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Oznámenia</h1>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full xl:w-1/2 px-3">
                    <p class="text-xl font-semibold mb-4">Pridať oznámenie</p>
                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                        <BreezeValidationErrors class="mb-4" />
                        <form @submit.prevent="submit">
                            <div class="block mt-4">
                                <label class="multiselect">Komu *</label>
                                <VueMultiselect required name="multiselect" id="multiselect" v-model="form.users" :options="options" :multiple="true" group-values="users"
                                                 group-label="class" :group-select="true"
                                                 placeholder="Hľadať"
                                                 selectedLabel="Pridaný"
                                                 selectLabel="Enter pre pridanie"
                                                 deselectLabel="Enter pre odobratie"
                                                 selectGroupLabel="Enter pre pridanie skupiny"
                                                 deselectGroupLabel="Enter pre odobratie skupiny"
                                                 track-by="name"
                                                 :closeOnSelect="false"
                                                 :hideSelected="true"
                                                  noResult="noResult"
                                                 label="name"
                                                ><span slot="noResult">Oops! No elements found. Consider changing the search query.</span></VueMultiselect>
                            </div>
                            <div class="block mt-4">
                                <BreezeLabel for="title" value="Predmet oznámenia *" />
                                <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required   />
                            </div>
                            <div class="block mt-4">
                                <BreezeLabel for="body" value="Správa *" />
                                <textarea v-model="form.body" id="body" rows="2" cols="50" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full mt-1 block w-full" required >

                                </textarea>
<!--                                <BreezeInput id="body" type="textarea" class="mt-1 block w-full" v-model="form.body" required autofocus  />-->
                            </div>
                            <div class="block mt-4">
                                <BreezeLabel for="visible_until" value="Zobrazovať do" />
                                <BreezeInput id="visible_until" type="date" class="mt-1 block w-full" v-model="form.visible_until"     />
                            </div>


                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <BreezeCheckbox name="send_email" v-model:checked="form.send_email" />
                                    <span class="ml-2 text-sm text-gray-600">Poslať email</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4 " :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Vytvoriť
                                </BreezeButton>
                            </div>
                        </form>

                    </div>
                </div>


                <div class="w-full xl:w-1/2 px-3">
                    <p class="text-xl font-semibold mb-4">Všetky oznámenia</p>
                    <div class="w-full bg-white border rounded-lg p-4 overflow-y-auto max-h-192">
                        <div v-for="announcement in announcements" :key="announcement.id"
                             class="w-full bg-gray-100 border rounded-lg flex justify-between items-center px-4 py-2 mb-4">
                            <div>
                                <p class="font-semibold text-xl">{{ announcement.title }}</p>
                                <p> {{ announcement.body }}</p>
                                <p class="font-semibold" v-if="announcement.number_of_days">Viditeľné ešte: {{ announcement.number_of_days }}</p>
                                <p v-else class="font-semibold" >Viditeľné do zmazania</p>


                            </div>
                            <span class="text-red-600">
                                <form method="post" @submit.prevent="deleteSubmit(announcement.id)">
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
            users: Object,
            announcements: Object
    },

    data() {
        return {
            form: this.$inertia.form({
                title: '',
                body: '',
                users: [],
                visible_until: Date,
                send_email: false
            }),

            deleteForm: this.$inertia.form({
                id: null
            }),
            options: this.users,

        }
    },

    methods: {
        submit() {
            this.form.post(this.route('admin.oznamenie.store'),{
                preserveScroll: true,
                onSuccess: () => this.form.reset('visible_until','value','body','title','users','send_email'),
            })
        },
        deleteSubmit(id){
            this.deleteForm.id = id
            this.deleteForm.delete(this.route('admin.oznamenie.destroy'),{
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



<template   >
    <Dashboard>
        <Head :title="'Internatnik '+ user.name" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Internatnik / {{user.name}}</h1>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full xl:w-1/2 px-3">
                        <p class="text-xl font-semibold mb-4">Osobné údaje</p>

                        <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                            <BreezeValidationErrors class="mb-4" />
                            <p class="text-green-500 mb-4" v-if="form.wasSuccessful">
                                Úspešne uložené
                            </p>


                            <form @submit.prevent="saveUser">



                                <div class="block">
                                    <BreezeLabel for="name" value="Meno" />
                                    <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required   />
                                </div>

                                <div class="mt-4">
                                    <BreezeLabel for="class" value="Skupina" />
                                    <select v-model="form.class" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full mt-1 block w-full" id="class"   >
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>

                                <div class="mt-4">
                                    <BreezeLabel  value="Izba" />
                                    <VueMultiselect v-model="form.apartment"
                                                 :options="apartments"
                                                    placeholder="Hľadať"
                                                    selectedLabel="Pridaný"
                                                    selectLabel="Enter pre pridanie"
                                                    deselectLabel="Enter pre odobratie"
                                                    label="name"
                                                 track-by="name">
                                    </VueMultiselect>


                                </div>



                                <div class="flex items-center justify-end mt-4">
                                    <BreezeButton type="button" @click="showingDeleteModal = true"
                                                  class="ml-4 bg-red-600 hover:bg-red-500 text-black"
                                                  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Vymazať
                                    </BreezeButton>

                                    <BreezeButton class="ml-4 " :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Uložiť
                                    </BreezeButton>
                                </div>


                            </form>

                        </div>
                    </div>


                    <div class="w-full xl:w-1/2 px-3">
                        <p class="text-xl font-semibold mb-4">Dostupné vychádzky na najbližší týždeň </p>
                        <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                            <p class="text-green-500 mb-4" v-if="available_outing_form.wasSuccessful">
                                Úspešne uložené
                            </p>
                            <BreezeValidationErrors class="mb-4" />

                            <form @submit.prevent="saveOuting">
                                <div>
                                    <BreezeLabel for="until" value="Do" />
                                    <BreezeInput id="until" type="time" class="mt-1 block w-full" v-model="available_outing_form.until"  />
                                </div>
                                <p class="text-sm">
                                    Internatnik dostane každý týždeň novú predĺženú vychádzku na základe hodnotenia izby
                                </p>


                                <div class="flex items-center justify-between mt-4">
                                    <div>
                                        <p class="text-red-600" v-if="!this.user.available_outing" >
                                            Internatista nemá pridelenú žiadnu vychádzku
                                        </p>
                                        <p class="text-red-600" v-else-if="this.user.available_outing.is_banned" >
                                            Internatista má zakázané vychádzky
                                        </p>
                                    </div>


                                    <span>

                                        <BreezeButton @click="banOuting"  v-if="!this.available_outing_form.is_banned"  type="button"  class="ml-4 bg-red-600 hover:bg-red-500 text-black"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Zakázať vychádzky
                                        </BreezeButton>

                                        <BreezeButton class="ml-4 " :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Uložiť
                                        </BreezeButton>
                                    </span>
                                </div>


                            </form>
                        </div>
                    </div>
            </div>

            <ModalConfirmDeleteInternatnik @close="showingDeleteModal = false" :user="user" :show="showingDeleteModal">

            </ModalConfirmDeleteInternatnik>




</div>

    </Dashboard>

</template>

<script>
import Dashboard from "@/Layouts/Admin/Dashboard";
import BreezeButton from "@/Components/Button";
import {Head, Link} from "@inertiajs/inertia-vue3";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import BreezeCheckbox from "@/Components/Checkbox";
import VueMultiselect from "vue-multiselect";
import ModalConfirmDeleteInternatnik from "@/Components/ModalConfirmDeleteInternatnik";

export default {
    components:{
        Dashboard,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        BreezeCheckbox,
        Link,
        Head,
        VueMultiselect,
        ModalConfirmDeleteInternatnik

    },
    props:{
        user: Object,
        apartments: Object
    },

    emits:['close'],
    data() {
        return {
            form: this.$inertia.form({
                name:'',
                class:'',
                apartment:''
            }),
            available_outing_form: this.$inertia.form({
              until: '',
              is_banned: false,
              user_id: ''
            }),
            showingDeleteModal: false,

        }
    },

    methods: {
        saveUser() {
            // console.log(this.form)
            this.form.put(this.route('admin.internatnici.update',this.user),{
                preserveScroll: true
            })
        },

        saveOuting() {
            this.available_outing_form.post(this.route('admin.dostupne-vychadzky.store'),{
                onSuccess: () =>{    this.available_outing_form.until = this.user.available_outing.until
                    this.available_outing_form.reset('is_banned')},
                preserveScroll: true
            })
        },

        banOuting(){
            this.available_outing_form.is_banned = true
            this.saveOuting()
        }

    },

    created(){
        this.form.name = this.user.name
        this.form.class = this.user.class
        this.form.apartment = this.user.apartment

        if (this.user.available_outing)
        this.available_outing_form.until = this.user.available_outing.until

        this.available_outing_form.user_id = this.user.id


    }



}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>


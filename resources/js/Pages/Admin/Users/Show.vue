<template   >
    <Head :title="'Administratíva '+ user.name" />

    <Dashboard>
        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Administratíva / {{user.name}}</h1>
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

                            <div class="block mt-4">
                                <label class="multiselect">Roly</label>

                                <VueMultiselect
                                    v-model="form.roles"
                                    :options="roles"
                                    :multiple="true"
                                    :close-on-select="false"
                                    :clear-on-select="false"
                                    :searchable="false"
                                    placeholder="Vybrať"
                                    label="name"
                                    track-by="name"
                                    :preselect-first="true"
                                    selectedLabel="Pridaný"
                                    selectLabel="Enter pre pridanie"
                                    deselectLabel="Enter pre odobratie"
                                    selectGroupLabel="Enter pre pridanie skupiny"
                                    deselectGroupLabel="Enter pre odobratie skupiny">
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


<!--                <div class="w-full xl:w-1/2 px-3">-->
<!--                    <p class="text-xl font-semibold mb-4">Dostupné vychádzky na najbližší týždeň </p>-->
<!--                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">-->
<!--                      -->
<!--                    </div>-->
<!--                </div>-->

            </div>

            <ModalConfirmDeleteUser @close="showingDeleteModal = false" :user="user" :show="showingDeleteModal">

            </ModalConfirmDeleteUser>




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
import ModalConfirmDeleteUser from "@/Components/ModalConfirmDeleteUser"

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
        ModalConfirmDeleteUser
    },
    props:{
        user: Object,
        roles: Object
    },

    emits:['close'],
    data() {
        return {
            form: this.$inertia.form({
                name:'',
                roles:[],
            }),
            showingDeleteModal: false,

        }
    },

    methods: {
        saveUser() {
            this.form.put(this.route('admin.users.update',this.user),{
                preserveScroll: true
            })
        },
    },

    created(){
        this.form.name = this.user.name
        this.form.roles = this.user.roles
    }



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


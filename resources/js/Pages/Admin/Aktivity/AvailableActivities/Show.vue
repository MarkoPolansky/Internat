<template   >
    <Dashboard>
        <Head title="Dostupná aktivita" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Dostupná aktivita </h1>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full xl:w-1/2 px-3">
                    <p class="text-xl font-semibold mb-4">{{availableActivity.name}}</p>

                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                        <BreezeValidationErrors class="mb-4" />
                        <p class="text-green-500 mb-4" v-if="form.wasSuccessful">
                            Úspešne uložené
                        </p>

                        <form @submit.prevent="submit">

                            <div>
                                <BreezeLabel for="name" value="Názov Aktivity" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required  />
                            </div>


                            <div class="flex items-center justify-end mt-4">

                                <BreezeButton @click="deleteActivity"  type="button"  class="ml-4 bg-red-600 hover:bg-red-500 text-black"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Vymazať
                                </BreezeButton>


                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
import BreezeButton from "@/Components/Button";
import {Head, Link} from "@inertiajs/inertia-vue3";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import BreezeCheckbox from "@/Components/Checkbox";
import VueMultiselect from "vue-multiselect";

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
        VueMultiselect
    },
    props:{
        availableActivity: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name:'',
            }),
        }
    },

    methods: {
        submit() {
            this.form.put(this.route('admin.availableActivities.update',this.availableActivity.id),{
                preserveScroll: true
            })
        },
        deleteActivity(){
            this.$inertia.delete(this.route('admin.availableActivities.destroy',this.availableActivity.id))
        }
    },

    created(){
        this.form.name = this.availableActivity.name
    }



}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>


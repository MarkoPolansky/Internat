<template   >
    <Dashboard>
        <Head title="Ostatné Aktivity" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Ostatné Aktivity </h1>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full xl:w-1/2 px-3">
                    <p class="text-xl font-semibold mb-4">{{activity.available_activity.name}}</p>

                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                        <BreezeValidationErrors class="mb-4" />
                        <p class="text-green-500 mb-4" v-if="form.wasSuccessful">
                            Úspešne uložené
                        </p>

                        <form @submit.prevent="submit">
                            <div class="block ">
                                <BreezeLabel for="starts_at" value="Od" />
                                <BreezeInput id="visible_until" type="time" class="mt-1 block w-full" v-model="form.starts_at"     />
                            </div>

                            <div class="block mt-4">
                                <BreezeLabel for="ends_at" value="Do" />
                                <BreezeInput id="ends_at" type="time" class="mt-1 block w-full" v-model="form.ends_at"     />
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <BreezeButton @click="deleteActivity"    type="button"  class="ml-4 bg-red-600 hover:bg-red-500 text-black"  :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
        activity: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                starts_at:'',
                ends_at:'',
            }),
        }
    },

    methods: {
        submit() {
            console.log(this.form)
            this.form.put(this.route('admin.activity.update',this.activity.id),{
                preserveScroll: true
            })
        },
        deleteActivity(){
            this.$inertia.delete(this.route('admin.activity.destroy',this.activity.id))
        }
    },

    created(){
        this.form.starts_at = this.activity.starts_at
        this.form.ends_at = this.activity.ends_at
        console.log(this.activity)
    }



}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">
</style>


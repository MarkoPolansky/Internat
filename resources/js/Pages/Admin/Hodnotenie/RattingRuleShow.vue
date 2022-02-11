<template   >
    <Dashboard>
        <Head title="Vyhchádzka podľa hodnotenia" />

        <div class="container mx-auto py-6 px-4">
            <h1 class="text-3xl py-4 border-b mb-10">Vyhchádzka podľa hodnotenia</h1>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full xl:w-1/2 px-3">
                    <p class="text-xl font-semibold mb-4">Edit</p>

                    <div class="w-full bg-white border rounded-lg p-4 mb-8 xl:mb-0">
                        <BreezeValidationErrors class="mb-4" />
                        <p class="text-green-500 mb-4" v-if="form.wasSuccessful">
                            Úspešne uložené
                        </p>

                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <BreezeLabel for="class" value="Skupina" />
                                <select v-model="form.class" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full mt-1 block w-full" id="class" required  >
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <div class="mt-4">
                                <div class="block mt-4">
                                    <BreezeLabel for="min_rating" value="Minimálne hodnotenie" />
                                    <BreezeInput id="min_rating" :min="0" :max="100" type="number" class="mt-1 block w-full" v-model="form.min_rating"  required   />
                                </div>
                            </div>


                            <div class="mt-4">
                                <div class="block mt-4">
                                    <BreezeLabel for="until" value="Vychádzky do" />
                                    <BreezeInput id="until" type="time" class="mt-1 block w-full" v-model="form.until"  required   />
                                </div>
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


export default {
    components:{
        Dashboard,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Link,
        Head,
    },
    props:{
        ratingRule: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                min_rating: 0,
                until: '',
                class: '',
            }),
        }
    },

    methods: {
        submit() {
            this.form.put(this.route('admin.rating-rule.update',this.ratingRule.id),{
                preserveScroll: true
            })
        },
        deleteActivity(){
            this.$inertia.delete(this.route('admin.rating-rule.destroy',this.ratingRule.id))
        }
    },

    created(){
        this.form.min_rating = this.ratingRule.edited_min_rating
        this.form.until = this.ratingRule.until
        this.form.class = this.ratingRule.class
    }



}
</script>

<style scoped>
</style>


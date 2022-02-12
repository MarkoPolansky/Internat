<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-6 py-4">
            <div class="text-lg">
                <slot name="title">

                    <div class="flex">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">



                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>

                        <h3 class="text-xl font-semibold ml-4">Výber aktivity</h3>
                    </div>
                </slot>
            </div>
            <div class="mt-4">
                <slot name="content">
                    <BreezeValidationErrors class="mb-4" />
                    <form  @submit.prevent="submit" id="form"  >

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

                    </form>
                </slot>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 text-right">
            <slot name="footer">

                <SecondaryButton   @click="close"  >
                    Zrušiť
                </SecondaryButton>


                <BreezeButton  @click="submit" class="ml-4" >
                    Uložiť
                </BreezeButton>
            </slot>
        </div>
    </modal>
</template>

<script>
import Modal from "@/Components/ModalSecond";
import BreezeButton from "@/Components/Button";
import SecondaryButton from "@/Components/SecondaryButton";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeCheckbox from "@/Components/Checkbox";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import VueMultiselect from "vue-multiselect";

export default {
    emits: ['close'],

    components: {
        Modal,
        BreezeButton,
        SecondaryButton,
        BreezeInput,
        BreezeLabel,
        BreezeCheckbox,
        BreezeValidationErrors,
        VueMultiselect
    },
    data() {
        return {
            form: this.$inertia.form({
                min_rating: 0,
                until: '',
                class: '',

            })
        }
    },

    props: {
        availableActivities:{
            default: []
        },
        show: {
            default: false
        },
        maxWidth: {
            default: '2xl'
        },
        closeable: {
            default: true
        },
    },

    methods: {
        close() {
            this.$emit('close')
        },

        submit(){
            this.form.post(this.route('admin.rating-rule.store'),{
                onSuccess: () => this.$emit('close'),
                preserveScroll: true
            })
        },


    }
}
</script>

<style scoped>
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.custom-number-input input:focus {
    outline: none !important;
}

.custom-number-input button:focus {
    outline: none !important;
}

</style>


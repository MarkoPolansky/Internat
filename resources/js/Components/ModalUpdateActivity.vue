<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-6 py-4">
            <div class="text-lg">
                <slot name="title">

                    <div class="flex">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-semibold ml-4">Úprava Aktivity </h3>
                    </div>
                </slot>
            </div>
            <div class="mt-4">
                <slot name="content">
                    <BreezeValidationErrors class="mb-4" />
                    <form  @submit.prevent="submit" id="form"  >

                        <div class="block mt-4">
                            <BreezeLabel for="starts_at" value="Od" />
                            <BreezeInput id="visible_until" type="time" class="mt-1 block w-full" v-model="availableActivity.starts_at"     />
                        </div>

                        <div class="block mt-4">
                            <BreezeLabel for="ends_at" value="Do" />
                            <BreezeInput id="ends_at" type="time" class="mt-1 block w-full" v-model="availableActivity.ends_at"     />
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
                    availableActivity_id: '',
                    starts_at: '',
                    ends_at:  '',
                    acitivy: {}
                })
        }
    },

    props: {
        availableActivity: Object,
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
        computed:{
            starting(){
                return this.availableActivity.starts_at
            },

            ending(){
                return this.availableActivity.ends
            }
        },

       updated() {
            this.form.acitivy = {...this.availableActivity}
       }

    },

}
</script>

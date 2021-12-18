<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="px-6 py-4">
            <div class="text-lg">
                <slot name="title">

                    <div class="flex">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg xmlns="http://www.w3.org/2000/svg"  class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>

                        <h2 class="text-xl font-semibold ml-4">Si si istý?</h2>
                    </div>
                </slot>
            </div>
            <div class="mt-4">
                <slot name="content">
                    <BreezeValidationErrors class="mb-4" />
                    <form  @submit.prevent="submit" id="form" >

                       <h3>Potvrdením sa pernamentne vymaže {{user.name}}.</h3>

                    </form>
                </slot>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-100 text-right">
            <slot name="footer">

                <SecondaryButton   @click="close"  >
                    Zrušiť
                </SecondaryButton>


                <BreezeButton   @click="submit" class="ml-4" >
                    Vymazať
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
            deleteForm: this.$inertia.form({
            })
        }
    },

    props: {
        user: Object,

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
            this.deleteForm.delete(this.route('admin.users.destroy',this.user),{
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


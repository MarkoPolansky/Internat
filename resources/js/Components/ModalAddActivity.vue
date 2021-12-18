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
                        <div class="block mt-4">
                            <BreezeLabel for="multiselect" value="Aktivity" />
                            <VueMultiselect name="multiselect" id="multiselect"
                                            v-model="form.availableActivities"
                                            :options="availableActivities"
                                            :multiple="true"
                                            :close-on-select="false"
                                            :clear-on-select="false"
                                            :searchable = "false"
                                            track-by="name"
                                            label="name"
                                            placeholder="Vybrať"
                                            selectedLabel="Pridaný"
                                            selectLabel="Enter pre pridanie"
                                            deselectLabel="Enter pre odobratie"
                            >
                            </VueMultiselect>
                        </div>

                        <div class="block mt-4">
                            <BreezeLabel for="starts_at" value="Od" />
                            <BreezeInput id="visible_until" type="time" class="mt-1 block w-full" v-model="form.starts_at"     />
                        </div>

                        <div class="block mt-4">
                            <BreezeLabel for="ends_at" value="Do" />
                            <BreezeInput id="ends_at" type="time" class="mt-1 block w-full" v-model="form.ends_at"     />
                        </div>


                        <div class="block mt-4">
                            <label class="flex items-center" @click="form.send_email = !form.send_email">
                                <BreezeCheckbox v-model:checked="form.send_email" name="send_email"  />
                                <span class="ml-2 text-sm text-gray-600">Oznámiť o výbere emailom </span>
                            </label>
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


                <BreezeButton :disabled="form.processing" :class="[form.processing ? 'opacity-25' : '']" @click="submit" class="ml-4" >
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
                availableActivities: [],
                starts_at: '16:30',
                ends_at:  '17:30',
                send_email: true
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
            this.form.post(this.route('admin.activity.store'),{
                onSuccess: () => this.$emit('close'),
                preserveScroll: true
            })
        },

        mounted() {
            // console.log(this.availableActivities)
            console.log("sdaddds")

        }

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


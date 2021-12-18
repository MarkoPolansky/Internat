<template>
    <div v-if="show" @click="close" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div  class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!--
              Background overlay, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle  sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
              Modal panel, show/hide based on modal state.

              Entering: "ease-out duration-300"
                From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                To: "opacity-100 translate-y-0 sm:scale-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100 translate-y-0 sm:scale-100"
                To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            -->
            <div @click.prevent.stop class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex">

                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">



                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>

                        <h3 class="text-xl font-semibold ml-4">Výber aktivity</h3>
                    </div>


                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">

                        <div class="mt-2">
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
<!--                                        <input v-model:checked="form.send_email"  name="activo" type="checkbox" id="collaborator">-->
<!--                                        <span class="ml-2 text-sm text-gray-600">Oznámiť o výbere emailom </span>-->

                                        <BreezeCheckbox v-model:checked="form.send_email" name="send_email"  />
                                        <span class="ml-2 text-sm text-gray-600">Oznámiť o výbere emailom </span>
                                    </label>
                                </div>

                            </form>


                        </div>
                    </div>

                </div>
                <div class="bg-gray-50 px-4 py-3 flex justify-between mt-12 ">

                    <SecondaryButton   @click="close"  >
                        Zrušiť
                    </SecondaryButton>


                    <BreezeButton  @click="submit" class="ml-4" >
                        Uložiť
                    </BreezeButton>




                </div>
            </div>
        </div>
    </div>
</template>

<script>

import BreezeButton from "@/Components/Button";
import SecondaryButton from "@/Components/SecondaryButton";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";
import VueMultiselect from "vue-multiselect";
import BreezeCheckbox from "@/Components/Checkbox";


export default {
    components:{
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

    props:{
        show:{
            default: false
        },
        availableActivities:{
            default: []
        }
    },
    methods:{
        submit(){
            this.form.post(this.route('admin.activity.store'),{
                onSuccess: () => this.$emit('close')

            })
        },

        close(){
            this.$emit('close')
        },
    },

    mounted() {
        console.log(this.availableActivities)
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


<template>
    <div v-show="show" @click="close" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

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

                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">

                            <svg  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>

                        </div>

                        <h3 class="text-xl font-semibold mb-4">Úprava</h3>
                    </div>


                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">

                            <div class="mt-2">
                                <BreezeValidationErrors class="mb-4" />
                                <form  @submit.prevent="edit"  @change="changed">

                                    <div>
                                        <BreezeLabel for="name" value="Meno" />
                                        <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="propModel.name"  required autofocus autocomplete="day" />
                                    </div>

                                    <div class="mt-4">
                                        <BreezeLabel for="class" value="Skupina" />
                                        <select v-model="propModel.class" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full mt-1 block w-full" id="class" required autofocus >
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>


<!--                                    <div>-->
<!--                                        <BreezeLabel for="day" value="Deň" />-->
<!--                                        <BreezeInput id="day" type="date" class="mt-1 block w-full" v-model="form.day" required autofocus autocomplete="day" />-->
<!--                                    </div>-->


                                </form>


                            </div>
                        </div>

                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                    <BreezeButton  @click="close"  class="ml-4" >
                        Ok
                    </BreezeButton>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

import BreezeButton from "@/Components/Button";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";

export default {
    components:{
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },

    data() {
        return {
            isDirty: false,
        }
    },
    computed: {
        propModel: {
            get () { return this.user },
            set (value) { this.$emit('update:user', value) },
        },
    },

    props:{
        show:{
            default: false
        },
        user:{
            default: []
        }
    },
    methods:{
        close(){
            console.log(this.isDirty)
            if(this.isDirty) {
                this.isDirty = false
                this.$emit('close',this.user)
            }  else
                this.$emit('close',);
        },
        changed(){
            this.isDirty= true
        }
    },




}

</script>

<style scoped>

</style>

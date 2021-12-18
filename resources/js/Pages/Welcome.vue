<template>
    <Head title="Welcome" />




<div class="bg-white">
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800 lg:pb-20 max-w-2xl mx-auto md:max-w-3xl lg:max-w-6xl">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="#" class="flex">
                <svg class="mr-3 h-10" viewBox="0 0 52 72" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.87695 53H28.7791C41.5357 53 51.877 42.7025 51.877 30H24.9748C12.2182 30 1.87695 40.2975 1.87695 53Z" fill="#76A9FA"/><path d="M0.000409561 32.1646L0.000409561 66.4111C12.8618 66.4111 23.2881 55.9849 23.2881 43.1235L23.2881 8.87689C10.9966 8.98066 1.39567 19.5573 0.000409561 32.1646Z" fill="#A4CAFE"/><path d="M50.877 5H23.9748C11.2182 5 0.876953 15.2975 0.876953 28H27.7791C40.5357 28 50.877 17.7025 50.877 5Z" fill="#1C64F2"/></svg>
                <span class="self-center text-lg font-semibold whitespace-nowrap dark:text-white">FlowBite</span>
            </a>
            <div class="flex md:order-2">
                <div v-if="canLogin" >
                    <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-gray-700">
                        <button type="button" class="flex items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                             <span>
                                 Domov
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </Link>

                    <Link v-else  :href="route('login')">
                        <button type="button" class="flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                             <span>
                                 Prihlásiť sa
                             </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        </button>
                    </Link>

                </div>
            </div>
        </div>
    </nav>

    <div class="lg:pb-20 max-w-xl mx-auto md:max-w-2xl lg:max-w-5xl">
        <div class="container px-6 py-16 max-w-6xl mx-auto">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2">
                    <div class="lg:max-w-lg">
                        <h1 class="text-5xl font-semibold text-gray-800 uppercase dark:text-white lg:text-6xl">
                        Bývať na internáte nemusí byť vždy chaos
                        </h1>
                        <p class="mt-2 text-2xl lg:text-xl text-gray-600 dark:text-gray-400">
                            SPSE-PO-Internát je riešenie ktoré uľahčí bývanie na internáte
                        </p>
                    </div>
                </div>


                <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                    <img class="w-full h-full lg:max-w-2xl" src="/assets/images/Analytics process_Monochromatic.svg" alt="Analytics process_Monochromatic">
                </div>
            </div>
        </div>
    </div>

    <section class="relative z-10">
        <div class="absolute w-full h-full inset-0 flex flex-col">
            <div class="w-full flex-1"></div>
            <div class="w-full flex-1 bg-red-100"></div>
        </div>
        <div class="relative max-w-screen-xl mx-auto pl-4 md:px-8">
            <div class="shadow-2xl rounded-l-xl overflow-hidden md:rounded-xl">
                <img class="w-full overflow-hidden" style="min-width: 740px;" src="/assets/images/User_Dashboard.png" alt="Envoyer Screenshot">
            </div>
        </div>
    </section>

    <section class="bg-red-100 py-16">

<!--        <div class="max-w-screen-xl mx-auto pl-4 md:px-8 ">-->
<!--            <h2 class="text-4xl font-semibold text-gray-800 uppercase dark:text-white">-->
<!--                Tvoja vlastná platforma kde máš prehľad o všetkých potrebných veciach na jednom mieste-->
<!--            </h2>-->
<!--        </div>-->

        <div class="lg:pb-20 max-w-xl mx-auto md:max-w-2xl lg:max-w-5xl">
            <div class="container px-6 pt-16 max-w-6xl mx-auto">
                <div class="items-center lg:flex">
                    <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                        <img class="w-full h-full lg:max-w-2xl" src="/assets/images/Rocket Boy_Monochromatic.svg" alt="Analytics process_Monochromatic">
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="lg:max-w-lg">
                            <h1 class="text-4xl font-semibold text-gray-800 uppercase dark:text-white lg:text-5xl">
                                Jedným klikom
                            </h1>

                            <div class="flex flex-col">
                                <div class="flex gap-2 mt-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-2xl lg:text-xl text-gray-800 dark:text-gray-400">
                                        Zobrať predĺženú vychádzku na základe dobrého hodnotenia izby
                                    </p>
                                </div>

                                <div class="flex  gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-2xl lg:text-xl text-gray-800 dark:text-gray-400">
                                        Nahlásiť svoju prítomnosť na workoutovom ihrisku
                                    </p>
                                </div>

                                <div class="flex  gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-2xl lg:text-xl text-gray-800 dark:text-gray-400">
                                        Prejaviť záujem o aktivitu hlasovaním
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="items-center lg:flex mt-10">

                    <div class="w-full lg:w-1/2">
                        <div class="lg:max-w-lg">
                            <h1 class="text-4xl font-semibold text-gray-800 uppercase dark:text-white lg:text-5xl">
                                Všetko na jednom mieste
                            </h1>

                            <div class="flex flex-col">
                                <div class="flex gap-2 mt-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-2xl lg:text-xl text-gray-800 dark:text-gray-400">
                                        Deň kedy sa upratuje izba
                                    </p>
                                </div>

                                <div class="flex  gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-2xl lg:text-xl text-gray-800 dark:text-gray-400">
                                        Aktivita dňa
                                    </p>
                                </div>

                                <div class="flex  gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-2xl lg:text-xl text-gray-800 dark:text-gray-400">
                                        Hodnotenie Izby
                                    </p>
                                </div>

                                <div class="flex  gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <p class="mt-2 text-2xl lg:text-xl text-gray-800 dark:text-gray-400">
                                        Ostatné oznamenia
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                        <img class="w-full h-full lg:max-w-2xl" src="/assets/images/PR_Outline.svg" alt="Analytics process_Monochromatic">
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

    <Footer></Footer>
</template>

<style scoped>

</style>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Footer from "@/Components/AdminPanel/Footer";


export default {
    components: {
      Head,
      Link,
      Footer,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
}
</script>

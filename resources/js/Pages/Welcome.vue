<template>
<!--    <Head title="Welcome" />-->




<div class="bg-white">
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800 lg:pb-20 max-w-2xl mx-auto md:max-w-3xl lg:max-w-6xl">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <Link :href="route('welcome')" class="flex">
                <img class="mr-3 h-16" src="/assets/images/logo.png" alt="SPŠE Prešov">
                <p class=" font-semibold self-center whitespace-nowrap text-2xl text-red-600 4">INTERNÁT</p>
            </Link>
            <div class="flex md:order-2">

                    <Link v-if="$page.props.auth.user" :href="route(dashboardRoute)" class="text-sm text-gray-700">
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
                        <button type="button" class="flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-light rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                             <span>
                                 Prihlásiť sa
                             </span>
                            <svg xmlns="http://www.w3.org/2000/svg" class=" h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        </button>
                    </Link>

            </div>
        </div>
    </nav>

    <div class="lg:pb-20 max-w-xl mx-auto md:max-w-2xl lg:max-w-5xl">
        <div class="container px-6 py-16 max-w-6xl mx-auto">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2">
                    <div class="lg:max-w-lg sm:text-left text-center ">
                        <h1 class="text-5xl font-semibold text-gray-800 uppercase dark:text-white lg:text-6xl">
                        Bývanie na internáte nemusí byť vždy chaos
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
        <div class="relative max-w-screen-xl mx-auto px-4 md:px-8">
            <div class="shadow-2xl rounded-l-xl overflow-hidden md:rounded-xl">
                <img class="w-full overflow-hidden"  src="/assets/images/User_Dashboard.png" >
            </div>
        </div>
    </section>

    <section class="bg-red-100 py-16">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        dashboardRoute: String,
    },
}
</script>

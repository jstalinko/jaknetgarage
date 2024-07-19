<template>
    <section class="py-10 px-5 md:px-20 lg:px-64" id="serviceSection">
        <div >
            <div class="flex flex-col md:flex-row justify-start mb-10 border-b-2 border-gray-600 w-3/12">
                <h2
                    class="text-secondary text-3xl text-center md:text-left md:text-4xl mb-5 md:mb-0 poppins-bold uppercase">
                    <i class="mdi mdi-face-agent"></i> Layanan Kami</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="service in Services" :key="service.id"
                    class="bg-white rounded-lg  overflow-hidden flex flex-col items-center p-4 border-2 border-amber-500 hover:bg-gray-100 hover:cursor-pointer hover:shadow-lg hover:animate-pulse">
                    <div class="w-16 h-16 mb-4 flex justify-center items-center">
                        <span :class="`mdi mdi-${service.icon} text-4xl`"></span>
                    </div>
                    <h2 class="text-xl font-bold mb-2 text-center">{{ service.name }}</h2>
                    <p class="text-gray-700 text-center">{{ service.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { reactive } from 'vue';

defineProps({Services: Object});
</script>

<style scoped>
.container {
    max-width: 1200px;
}
</style>

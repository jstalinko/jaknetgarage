<template>
    <section id="services" class="py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Layanan Kami</h2>
        <div class="flex flex-wrap justify-center">
            <div class="service-card" v-for="service in services" :key="service.title">
                <h3 class="text-xl font-semibold mb-2">{{ service.title }}</h3>
                <p>{{ service.description }}</p>
            </div>
        </div>
    </section>
</template>

<script setup>

import { ref } from 'vue';

const services = ref([
    { title: 'Servis Berkala', description: 'Layanan servis berkala untuk memastikan motor Anda selalu dalam kondisi prima.' },
    { title: 'Perbaikan Mesin', description: 'Perbaikan mesin dengan teknisi berpengalaman dan suku cadang asli.' },
    { title: 'Ganti Oli', description: 'Ganti oli cepat dan tepat untuk menjaga performa motor Anda.' },
]);

</script>

<style scoped>
.service-card {
    background: #f4f4f4;
    padding: 1rem;
    margin: 1rem;
    border-radius: 0.5rem;
    text-align: center;
    max-width: 300px;
}
</style>
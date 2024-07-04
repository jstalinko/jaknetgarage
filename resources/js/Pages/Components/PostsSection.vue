<template>
    <section id="posts" class="py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Post Terbaru</h2>
        <div class="flex flex-wrap justify-center">
            <div class="post-card" v-for="post in posts" :key="post.title">
                <div class="flex items-center mb-4">
                    
                    <h3 class="text-xl font-semibold">{{ post.title }}</h3>
                </div>
                <p>{{ post.excerpt }}</p>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
const posts = ref([
    { title: 'Cara Merawat Motor dengan Benar', excerpt: 'Merawat motor dengan benar dapat memperpanjang usia motor Anda. Pelajari langkah-langkahnya di sini.' },
    { title: 'Tips Memilih Sparepart Berkualitas', excerpt: 'Memilih sparepart berkualitas adalah hal penting. Berikut adalah beberapa tips yang bisa Anda ikuti.' },
    { title: 'Perbaikan Mesin: Kapan Harus ke Bengkel?', excerpt: 'Pelajari tanda-tanda kapan mesin motor Anda memerlukan perbaikan oleh teknisi profesional.' },
])
</script>

<style scoped>
.post-card {
    background: #f4f4f4;
    padding: 1rem;
    margin: 1rem;
    border-radius: 0.5rem;
    max-width: 300px;
}
</style>
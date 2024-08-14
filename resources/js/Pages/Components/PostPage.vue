<template>
    <section class="bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-start mb-10 border-b-2 border-gray-600 w-3/12">
                <h2
                    class="text-secondary text-3xl text-center md:text-left md:text-4xl mb-5 md:mb-0 poppins-bold uppercase">
                    <i class="mdi mdi-newspaper"></i> Artikel Terbaru</h2>
            </div>
            <!-- <swiper
          :modules="[Navigation, Pagination]"
          navigation
          pagination={{ clickable: true }}
          class="mySwiper"
        >
          <swiper-slide v-for="post in posts" :key="post.id" class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img :src="post.image" alt="Post Image" class="w-full h-48 object-cover">
            <div class="p-4">
              <h3 class="text-xl font-bold text-gray-800">{{ post.title }}</h3>
              <p class="text-gray-600 mt-2">{{ post.excerpt }}</p>
              <a :href="`/posts/${post.id}`" class="text-blue-500 mt-4 inline-block">Read more</a>
            </div>
          </swiper-slide>
        </swiper> -->
            <swiper :modules="modules" :slides-per-view="3" :space-between="10" navigation
                :scrollbar="{ draggable: true }"  :mousewheel="true" :autoplay="{delay: 5000}">
                <swiper-slide v-for="post in Posts" :key="post.id" class="bg-white rounded-lg border-2 overflow-hidden">
                    <img :src="post.image" :alt="post.title" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <Link :href="`/post/${post.id}`">
                        <h3 class="text-xl font-bold text-gray-800">{{ post.title }}</h3>
                        </Link>
                        <p class="text-gray-600 mt-2"><i class="mdi mdi-calendar"></i> {{ new
                            Date(post.created_at).toLocaleDateString() }}</p>
                        <Link :href="`/post/${post.id}`" class="text-blue-500 mt-4 inline-block">Read more</Link>
                    </div>
                </swiper-slide>
                ...
            </swiper>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/autoplay';
import 'swiper/css/mousewheel';

import { Swiper, SwiperSlide } from 'swiper/vue'

import { Navigation, Pagination, Scrollbar, A11y, Autoplay , Mousewheel } from 'swiper/modules';

const modules = [Navigation, Pagination, Scrollbar, A11y, Autoplay , Mousewheel];
defineProps({ Posts: Object })
</script>

<style scoped>
/* Tambahkan gaya kustom jika diperlukan */
</style>
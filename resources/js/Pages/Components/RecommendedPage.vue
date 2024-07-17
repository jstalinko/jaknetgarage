<template>
    <section class="bg-[#ffcc4c] py-10 px-5 md:py-20 md:px-64">
      
      <div class="border-b-2 border-gray-700 w-3/12">
        <h1 class="mt-5 mb-10 text-3xl poppins-bold uppercase"><i class="mdi mdi-star-circle"></i> Rekomendasi Produk</h1>
      </div>
      <br><br>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mb-10">
        <div class="rounded-lg " v-for="(product, index) in ProductsRecommended" :key="index">
          <img class="w-full rounded-t-lg" :src="helpers.imageUrl(product.image)" :alt="product.name" />
          <div class="flex flex-col gap-2 text-gray-600 bg-gray-100 p-5 rounded-b-lg hover:shadow-lg">
            <Link :href="'/product/' + product.slug"><h4 class="font-bold hover:underline">{{ product.name }}</h4></Link>
           
            <div class="flex flex-col md:flex-row md:justify-between">
              <b class="text-sm mt-2">{{ product.price == 0 ? 'Tanya Admin' : helpers.rupiah(product.price) }}</b>
              <span class="text-sm mt-2"><i class="mdi mdi-tag"></i> {{ product.subcategory.name }}</span>
            </div>
            <a :href="helpers.WaButton(Global , '/product/'+product.slug)" class="bg-amber-500 px-8 py-2 rounded-full text-gray-600 font-bold text-center hover:bg-amber-600 hover:text-white uppercase text-xs md:text-lg" target="_blank"><i class="mdi mdi-whatsapp"></i> {{ Global.Settings.action_button_text }}</a>
          </div>
        </div>
      </div>
      <!-- <div class="flex justify-center" v-show="Filter==null">
        <Link href="/products?filter=all" class="bg-white border-2 p-2 rounded-full text-gray-600  hover:border-gray-600 mt-10"><i class="mdi mdi-view-list"></i> Tampilkan Semua</Link>
        
      </div> -->

      <!-- <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-10 gap-x-5 gap-y-10 md:gap-y-32">
        
        <div class="flex flex-col items-center relative bg-gray-100 rounded-lg hover:outline outline-1 outline-gray-500 py-5 px-1" v-for="p in ProductsRecommended">
          <img class="w-32 sm:w-40 absolute -top-10" :src="helpers.imageUrl(p.image)" alt="" />
          <div class="my-10 text-center text-gray-600">
            <h4 class="text-lg md:text-xl font-bold my-5 animate-pulse">{{ p.name }}</h4>
          <div class="flex flex-col items-center mt-2">
            <span class="text-xl font-semibold ">{{ helpers.rupiah(p.price) }}</span>
            <span class="text-sm font-thin"><s>{{ helpers.rupiah(helpers.autoDiscount(p.price)) }}</s></span>
            <span class="text-md text-gray-500 mt-1"><i class="mdi mdi-tag"></i> {{ p.subcategory.name }}</span>
            <div class="flex items-center mt-1">
              <i class="mdi mdi-eye-outline text-gray-700"></i>
              <span class="ml-1 text-sm text-gray-600">{{ p.views }}x</span>
            </div>
          </div>
          </div>
          <div class="flex items-center gap-5">
            <a class="bg-gray-500 hover:bg-gray-600 py-1 px-5 sm:px-10 rounded-full  gap-2 text-white font-bold uppercase" :href="helpers.WaButton(Global,'/product/'+p.slug)" target="_blank">
              <i class="mdi mdi-whatsapp"></i>
              {{ Global.Settings.action_button_text }}
            </a>
            
          </div>
          
        </div>
        
      </div> -->
<br><br>
      <div class="flex justify-center">
        <Link href="/products?filter=recommended" class="bg-white p-2 rounded-full text-center text-gray-600 hover:outline mt-10"><i class="mdi mdi-view-list"></i> Tampilkan Semua</Link>
      </div>
    </section>
  </template>
  
  <script setup>
import { Link } from '@inertiajs/vue3';
import {inject} from 'vue';
const helpers = inject('helpers');
defineProps({ProductsRecommended: Object , Global: Object})
</script>
<template>
  <div>
    <section class="py-10 px-5 md:px-20 lg:px-64">
      <div class="flex flex-col md:flex-row justify-start mb-10 border-b-2 border-gray-600 w-3/12">
        <h2 class="text-secondary text-3xl text-center md:text-left md:text-4xl mb-5 md:mb-0 poppins-bold uppercase"><i class="mdi mdi-store"></i> {{ HeadTitle }}</h2>
      </div>

      <div class="flex flex-col flex-wrap md:flex-row justify-between mb-10 mt-5">
    <div class="flex flex-wrap gap-1 justify-start">
        <Link href="?filter=all" class="bg-amber-400 hover:bg-amber-600 text-gray-600 font-bold py-2 px-4 rounded-full" preserve-scroll>
            <i class="mdi mdi-view-list"></i> Semua Produk
        </Link>
        <Link href="?filter=new" class="bg-amber-400 hover:bg-amber-600 text-gray-600 font-bold py-2 px-4 rounded-full" preserve-scroll>
            <i class="mdi mdi-moon-new"></i> Terbaru
        </Link>
        <Link href="?filter=populer" class="bg-amber-400 hover:bg-amber-600 text-gray-600 font-bold py-2 px-4 rounded-full" preserve-scroll>
            <i class="mdi mdi-star-box"></i> Terpopuler
        </Link>
    </div>
    <div class="flex justify-end">
        <Link v-show="Filter == 'desc_harga'" href="?filter=asc_harga" class="bg-amber-400 hover:bg-amber-600 text-gray-600 font-bold py-2 px-4 rounded-full" preserve-scroll>
            <i class="mdi mdi-sort-descending"></i> Harga
        </Link>
        <Link v-show="Filter == 'asc_harga'" href="?filter=desc_harga" class="bg-amber-400 hover:bg-amber-600 text-gray-600 font-bold py-2 px-4 rounded-full" preserve-scroll>
            <i class="mdi mdi-sort-ascending"></i> Harga
        </Link>
        <Link v-show="Filter !== 'asc_harga' && Filter !== 'desc_harga'" href="?filter=desc_harga" class="bg-amber-400 hover:bg-amber-600 text-gray-600 font-bold py-2 px-4 rounded-full" preserve-scroll>
            <i class="mdi mdi-sort"></i> Harga
        </Link>
    </div>
</div>


      <div class="bg-amber-400 m-5 p-3 rounded text-gray-600 flex justify-between" v-show="Filter !== null">
       <div v-if="Filter != 'search'">
        <span class="font-thin underline">Filter </span> : 
        <span class="font-bold" v-if="Filter == 'all'">Semua Produk</span>
        <span class="font-bold" v-if="Filter == 'new'">Produk Terbaru</span>
        <span class="font-bold" v-if="Filter == 'populer'">Produk Terpopuler</span>
        <span class="font-bold" v-if="Filter == 'asc_harga'">Harga Termurah</span>
        <span class="font-bold" v-if="Filter == 'desc_harga'">Harga Termahal</span>
        <span class="font-bold" v-if="Filter == 'recommended'">Rekomendasi Produk</span>
        <span class="font-bold" v-if="Filter == 'category'">Kategori</span>

       </div>
       <div v-else>
        <span class="font-thin underline">Search </span> :
        <span class="font-bold">{{FilterQuery}}</span>
       </div>
       <div class="hover:font-bold">
        <Link href="?filter" preserve-scroll><i class="mdi mdi-close"></i> Reset</Link>
       </div>

      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 mb-10">
        <div class="rounded-lg " v-for="(product, index) in Products" :key="index">
          <img class="w-full rounded-t-lg" :src="helpers.imageUrl(product.image)" :alt="product.name" />
          <div class="flex flex-col gap-2 text-gray-600 bg-[#FFCC4C] p-5 rounded-b-lg hover:shadow-lg">
            <Link :href="'/product/' + product.slug"><h4 class="font-bold hover:underline">{{ product.name }}</h4></Link>
           
            <div class="flex flex-col md:flex-row md:justify-between">
              <b class="text-sm mt-2">{{ product.price == 0 ? 'Tanya Admin' : helpers.rupiah(product.price) }}</b>
              <span class="text-sm mt-2"><i class="mdi mdi-tag"></i> {{ product.category.name }}</span>
            </div>
            <a :href="helpers.WaButton(Global,'/product/'+product.slug)" class="bg-amber-500 px-8 py-2 rounded-full text-gray-600 font-bold text-center hover:bg-amber-600 hover:text-white uppercase text-xs md:text-lg" target="_blank"><i class="mdi mdi-whatsapp"></i> Pesan </a>

         <div class="flex items-center justify-between">
          <a :href="product.shopee_url" class="bg-yellow-500 px-8 py-2 rounded-full text-gray-100 font-bold text-center hover:bg-yellow-600 hover:text-white uppercase text-xs md:text-lg" target="_blank">SHOPEE</a>
            
            <a :href="product.tokopedia_url" class="bg-green-500 px-8 py-2 rounded-full text-gray-100 font-bold text-center hover:bg-green-600 hover:text-white uppercase text-xs md:text-lg" target="_blank">TOKOPEDIA</a>
         </div>

          </div>
        </div>
      </div>
      <div class="flex justify-center" v-show="Filter==null">
        <Link href="/products?filter=all" class="bg-white border-2 p-2 rounded-full text-gray-600  hover:border-gray-600 mt-10"><i class="mdi mdi-view-list"></i> Tampilkan Semua</Link>
        
      </div>
    </section>
    <br><br> 
  </div>          
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { inject } from 'vue';     
const helpers = inject('helpers');

defineProps({
  Products: Object, 
  HeadTitle: String, 
  Filter: String,
  Global: Object,
  FilterQuery:String
  });
</script>

                                                       
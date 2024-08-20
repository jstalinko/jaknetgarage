<template>
    <div>
        <JustHead :Global="props.globals" :title="props.product.name" />
        <Navbar :Categories="props.categories" :Settings="props.globals.settings" />

        <div class="container mx-auto mt-10">
            <br>
            <div class="border-b-2 border-black mt-12">

                <nav class="flex items-center space-x-2 text-gray-700 py-4">
                    <Link href="/" class="hover:text-gray-900"><i class="mdi mdi-home"></i> Home</Link>
                    <span>></span>
                    <Link href="/product" class="hover:text-gray-900"><i class="mdi mdi-tag"></i>
                    Product</Link>
                    <span>></span>
                    <span class="text-gray-500">{{ props.product?.name }}</span>
                </nav>
            </div>
            <div class="flex flex-col md:flex-row mt-10 ">

                <div class="md:w-1/2">
                    <div class="p-5">
                        <img :src="helpers.imageUrl(props.product.image)" :alt="props.product.name"
                            class="w-full rounded-lg transition-transform duration-500 ease-in-out transform hover:scale-125 hover:cursor-zoom-in">
                        <br>
                        <hr>
                       <div class="hidden md:block">
                        <h3 class="text-2xl poppins-bold mt-5 mb-3"><i class="mdi mdi-table-furniture"></i> Produk
                            Serupa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5 mb-10 mt-5">
                            <div class="rounded-lg" v-for="(product, index) in props.products" :key="index">
                                <img class="w-full rounded-t-lg" :src="helpers.imageUrl(product.image)"
                                    :alt="product.name" />
                                <div
                                    class="flex flex-col gap-2 text-gray-100 bg-[#FF0000] p-5 rounded-b-lg hover:shadow-lg">
                                    <Link :href="'/product/' + product.slug">
                                    <h4 class="font-bold hover:underline">{{ product.name }}</h4>
                                    </Link>

                                    <div class="flex flex-col md:flex-row md:justify-between">
                                        <b class="text-sm mt-2">{{ product.price == 0 ? 'Tanya Admin' :
                                            helpers.rupiah(product.price) }}</b>
                                        <span class="text-sm mt-2"><i class="mdi mdi-tag"></i> {{
                                            product.category.name }}</span>
                                    </div>
                                    <a class="bg-red-500 px-8 py-2 rounded-lg text-white font-bold text-center hover:bg-red-700 uppercase"
                                        :href="helpers.WaButton(props.globals,'/product/'+product.slug)"><i class="mdi mdi-whatsapp"></i> PESAN</a>
                                </div>
                            </div>
                        </div>
                       </div>

                    </div>
                </div>
                <div class="md:w-1/2 px-10 py-10">
                    <h1 class="text-3xl font-bold text-center md:text-left mb-4 poppins-bold"><i
                            class="mdi mdi-cart-heart"></i> {{ props.product.name }}</h1>
                    <div class="flex flex-col md:flex-row justify-between items-center mt-4">
                        <span class="text-sm md:text-xl font-semibold border-2 p-2 rounded-full border-red-400 mb-2">{{ props.product.price
                            == 0 ? 'Tanya Admin' : helpers.rupiah(props.product.price) }}</span>
                        <span class="text-md text-gray-500 border-2 p-2 rounded-full border-red-400 mb-2"><i
                                class="mdi mdi-tag"></i> {{ props.product.category.name }}</span>
                        <span class="text-sm text-gray-500 border-2 p-2 rounded-full border-red-400 mb-2"><i
                                class="mdi mdi-eye-outline"></i> {{ props.product.views }}x dilihat</span>
                    </div>
                    <!-- <button
                        class="bg-red-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded block w-full mt-4">
                        <i class="mdi mdi-whatsapp"></i> Pesan Sekarang
                    </button> -->
                    <div class="text-gray-600 text-center md:text-left px-4 mt-5">
                        <div class="prose lg:prose-xl" v-html="props.product.description"></div>
                    </div>
                    <a
                        class="bg-red-500 hover:bg-amber-600 text-white font-bold py-2 px-4 rounded-full block w-full mt-4 uppercase text-center" :href="helpers.WaButton(props.globals,'/product/'+props.product.slug)" target="_blank" >
                        <i class="mdi mdi-whatsapp"></i> PESAN </a>
                        <a
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full block w-full mt-4 uppercase text-center" :href="props.product.shopee_url" target="_blank" >
                         SHOPEE </a>
                        <a
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full block w-full mt-4 uppercase text-center" :href="props.product.tokopedia_url" target="_blank" >
                        TOKOPEDIA </a>

                    <div class="block md:hidden">
                        <h3 class="text-2xl poppins-bold mt-5 mb-3"><i class="mdi mdi-table-furniture"></i> Produk
                            Serupa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5 mb-10 mt-5">
                            <div class="rounded-lg" v-for="(product, index) in Products" :key="index">
                                <img class="w-full rounded-t-lg" :src="helpers.imageUrl(product.image)"
                                    :alt="product.name" />
                                <div
                                    class="flex flex-col gap-2 text-gray-600 bg-[#FF0000] p-5 rounded-b-lg hover:shadow-lg">
                                    <Link :href="'/product/' + product.slug">
                                    <h4 class="font-bold hover:underline">{{ product.name }}</h4>
                                    </Link>

                                    <div class="flex flex-col md:flex-row md:justify-between">
                                        <b class="text-sm mt-2">{{ product.price == 0 ? 'Tanya Admin' :
                                            helpers.rupiah(product.price) }}</b>
                                        <span class="text-sm mt-2"><i class="mdi mdi-tag"></i> {{
                                            product.category.name }}</span>
                                    </div>
                                    <a class="bg-red-500 px-8 py-2 rounded-lg text-white font-bold text-center hover:bg-amber-700 uppercase"
                                        :href="helpers.WaButton(props.globals,'/product/'+product.slug)"><i class="mdi mdi-whatsapp"></i> PESAN</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <Footer :Pages="props.posts" :Socmed="props.globals.settings.sosmed" :Global="props.globals"/>
    </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import { Link } from '@inertiajs/vue3';
import { inject } from 'vue';
import JustHead from '../Components/JustHead.vue';
import Footer from '../Components/Footer.vue';
defineProps({
    product: Object,
    Products: Object,
    Category: Object,
    Categories: Object,
    Global: Object,
    props: Object
});
const helpers = inject('helpers');


</script>
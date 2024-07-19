<template>
<div class="fixed top-0 w-full bg-white p-2 z-50 hidden md:block">
    <div class="flex items-center justify-center min-h-screen bg-white" v-if="searchOpen">
      
        <br>
        <div class="relative w-full max-w-screen-md">
            <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-600 poppins-bold animate-pulse">JAKNET GARAGE</h1>
        </div>
        <div>
            <input
                type="text"z
                placeholder="Search..."
                class="w-full p-4 text-amber-600 bg-transparanet  rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500" v-model="query"
            />
          <button class="bg-amber-500 w-full rounded-lg mt-2 text-gray-600 p-3 font-bold hover:bg-amber-400" type="button" role="button" @click="doSearch" ><i class="mdi mdi-magnify"></i> Search</button>
          <button type="button" role="button" @click="toggleSearch" class="absolute top-0 right-0 mt-4 mr-4 text-black hover:text-red-500"
          aria-label="Close"
                >
                    <i class="mdi mdi-close-circle-outline text-3xl"></i>
                </button>
        </div>
        </div>
    </div>
    <header class="flex justify-between items-center p-3 px-4">
        <div class="flex items-center gap-2">
            <span class="font-bold text-xl text-gray-700 poppins-bold">JAKNET GARAGE</span>

        </div>

		<nav class="flex-1 mx-10">
        <ul class="flex justify-center gap-20 font-bold text-xl text-gray-500">
            <li class="hover:text-[#FEC43C]">
                <Link href="/">Beranda</Link>
            </li>
            <li class="hover:text-[#FEC43C]">
                <Link href="/#serviceSection">Layanan</Link>
            </li>
            <li class="relative hover:text-[#FEC43C]">
                <button id="dropdownButton" @click="toggleDropdown" type="button" aria-expanded="true" aria-haspopup="true">
                    Suku Cadang
                    <i class="mdi mdi-chevron-down"></i>
                </button>
                <div v-if="isOpen" class="origin-top-right absolute mt-2 w-56 rounded-md shadow-lg bg-amber-400 ring-1 ring-black ring-opacity-5">
                    <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
						<Link class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-600" role="menuitem" v-for="(cat,index) in Categories" :href="'/product?filter=category&cat='+cat.id" >{{ cat.name }}</Link>
                    </div>
                </div>
            </li>
            <li class="hover:text-[#FEC43C]">
                <Link href="/contact">Hubungi</Link>
            </li>
            <li class="hover:text-[#FEC43C]">
                <Link href="/about">Tentang</Link>
            </li>
        </ul>
    </nav>

        <button class="flex gap-5 bg-[#FEC43C] rounded-full px-4  text-gray-500" type="button" role="button" @click="toggleSearch">
            <i class="mdi mdi-magnify text-3xl"></i> 
		</button>
    </header>
</div>




<div class="fixed bottom-0 left-0 right-0 bg-gray-100 p-3 mb-1 z-50 rounded-lg md:hidden">
        <nav class="flex justify-around items-center text-amber-600">
            <a href="/" class="flex flex-col items-center hover:text-black">
                <i class="mdi mdi-home-outline"></i>
                <span class="text-xs">Beranda</span>
            </a>
            <a href="/product" class="flex flex-col items-center hover:text-black">
                <i class="mdi mdi-cube-outline"></i>
                <span class="text-xs">Produk</span>
            </a>
            <div class="relative" @click="toggleDropdown">
                <a class="flex flex-col items-center hover:text-black">
                    <i class="mdi mdi-tag-multiple"></i>
                    <span class="text-xs">Suku Cadang</span>
                </a>
                <div v-if="isOpen" class="absolute bottom-12 w-screen bg-white  rounded-lg">
                    <ul class="flex flex-col justify-center p-3 ">
                        <li v-for="(category,index) in Categories" :key="index" class="py-1">
                            <Link :href="'/product?filter=category&cat='+category.id" class="text-black hover:text-amber-600">
                                {{ category.name }}
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="/contact" class="flex flex-col items-center hover:text-black">
                <i class="mdi mdi-phone-outline"></i>
                <span class="text-xs">Hubungi</span>
            </a>
            <a href="/about" class="flex flex-col items-center hover:text-black">
                <i class="mdi mdi-information-outline"></i>
                <span class="text-xs">Tentang</span>
            </a>
        </nav>
    </div>

<div class="fixed top-0 left-0 right-0 bg-white shadow-md p-2 z-50 block md:hidden">
    <div class="flex justify-between space-x-4">
        <div class="flex space-x-2">
           <h1 class="text-xl poppins-bold mt-2">JAKNET GARAGE</h1>
        </div>
      
    </div>
</div>





</template>

<script setup>
import { Link , router} from '@inertiajs/vue3';
import {ref,onMounted,onBeforeUnmount,watch} from 'vue';

defineProps({Categories: Object});

const isOpen = ref(false);
const searchOpen = ref(false);
const query = ref('');

const doSearch = async() => {
    if(query.value == '') return;
    router.visit('/product?filter=search&q='+query.value,{preserveScroll:true});
}

const toggleSearch = () => {
    searchOpen.value = !searchOpen.value;
}

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
	console.log(isOpen.value);
};

const closeDropdown = (event) => {
    if (!event.target.closest('.relative')) {
        isOpen.value = false;
    }
};

onMounted(() => {
    window.addEventListener('click', closeDropdown);
});

onBeforeUnmount(() => {
    window.removeEventListener('click', closeDropdown);
});
</script>
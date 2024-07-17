<template>
    <div class="hidden md:block">
        <footer class="flex flex-col border-t-2 bg-gradient-to-b from-amber-400 via-amber-100 to-white">
			<div
				class="flex justify-between gap-10 py-20 px-64 bg-primary bg-[url('/assets/images/dots.png')] bg-cover">
				<nav>
					<h5 class="font-bold text-2xl text-slate-500 mb-8">Produk Kami</h5>
					<ul class="flex flex-col gap-3">
						<li><Link href="/products?filter=all">Semua Produk</Link> </li>
						<li><Link href="/products?filter=populer">Produk Terlaris</Link></li>
						<li><Link href="/products?filter=new">Produk Terbaru</Link></li>
					</ul>
				</nav>

				<nav>
					<h5 class="font-bold text-2xl text-slate-500 mb-8">HALAMAN</h5>
					<ul class="flex flex-col gap-3">
						<li><Link href="/about-us">Tentang Kami</Link></li>
						<li><Link href="/linker">Hubungi Kami</Link></li>
						
					</ul>
				</nav>

				
				<nav>
					<h5 class="font-bold text-2xl text-slate-500 mb-8">SOCIAL MEDIA</h5>
					<div class="flex gap-5 mb-3">
						<a target="_blank"  :class="classNames[sos.type]"  v-for="(sos,index) in Socmed" :href="sos.link"><i :class="icons[sos.type]"></i> </a>
					</div>
					<p class="text-lg max-w-sm">
						Jangan ragu untuk berkonsultasi dan tanya kami! 
						Kami siap melayani kebutuhan anda!
					</p>
				</nav>
			</div>

			<div class="bg-white flex justify-center gap-10 py-3 font-bold text-xs">
				
				<span>IA PROPERTY &copy; {{new Date().getFullYear()}}. All rights reserved. </span>
			</div>
		</footer>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import {ref} from 'vue';
defineProps({Global: Object, Socmed: Object,Pages: Object});
const icons = ref({
	'tiktok':'mdi mdi-music-note-eighth',
	'instagram':'mdi mdi-instagram',
	'facebook':'mdi mdi-facebook',
	'twitter':'mdi mdi-twitter',
	'whatsapp':'mdi mdi-whatsapp',
	'youtube':'mdi mdi-youtube'
});
const classNames = ref({
	'tiktok':'px-3 py-2 bg-gray-600 text-white rounded text-xl hover:bg-gray-500',
	'instagram':'px-3 py-2 bg-pink-600 text-white rounded text-xl hover:bg-pink-500',
	'facebook':'px-3 py-2 bg-blue-600 text-white rounded text-xl hover:bg-blue-500',
	'twitter':'px-3 py-2 bg-gray-600 text-white rounded text-xl hover:bg-gray-500',
	'whatsapp':'px-3 py-2 bg-green-600 text-white rounded text-xl hover:bg-green-500',
	'youtube':'px-3 py-2 bg-red-600 text-white rounded text-xl hover:bg-red-500'
});

</script>
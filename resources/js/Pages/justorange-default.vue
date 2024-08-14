<template>
	<JustHead :Global="props.globals" />
	<div>
		<Navbar :Categories="props.categories" />

		<div class="hidden md:block relative">
			<section class="grid grid-cols-2 gap-4 ">

				<div class="flex flex-col  justify-center ">
					
				<div class="flex flex-col items-center">
					<h1 class="text-8xl font-bold w-2/3 mb-5 poppins-bold animate-pulse">
						 <span class="text-gray-600">GTMOTO</span>
                         <span class="text-amber-600">MINDS</span>
					</h1>

					<p class="text-secondary w-3/4 text-lg text-left p-2">
						Kami adalah bengkel motor yang menyediakan solusi terbaik untuk semua kebutuhan servis dan suku cadang motor Anda. 
                        Kami menawarkan berbagai layanan berkualitas tinggi termasuk servis motor, penggantian suku cadang, dan layanan kustomisasi motor sesuai keinginan Anda.
					</p>
				</div>


					<div class="mt-5 px-32"><br>
					<Link href="/products" class="bg-amber-400 p-3 rounded text-gray-600 hover:bg-amber-600 mt-5">Belanja sekarang!</Link>
					</div>
					
				</div>
				
				<div >
                    
					<img src="/undraw_car.svg"  class="min-h-screen hover:grayscale" />
				</div>
				
			</section>
			
			<div>
				
			</div>
		</div>
		<Services :Services="props.services" />
		<ProductPage :Products="props.products" :HeadTitle="HeadTitle" :Filter="props.filter" :Global="props.globals" :FilterQuery="props?.filter_query"/>
		<PostPage :Posts="props.posts" />
		<Testimonial :Testimonials="props.testimonials" />

	

		<Footer :Global="props.globals" :Socmed="props.globals.settings.sosmed" :Pages="props.posts" />
	</div>
</template>


<script setup>
import Navbar from './Components/Navbar.vue';
import Services from './Components/Services.vue';
import Testimonial from './Components/Testimonial.vue';
import ProductPage from './Components/ProductPage.vue';
import Footer from './Components/Footer.vue';
import JustHead from './Components/JustHead.vue';
import {Link} from '@inertiajs/vue3';
import PostPage from './Components/PostPage.vue';

defineProps({ ProductsRecommended:Object,
			  Products: Object, 
			  Testimonials: Object,
			  Pages: Object,
              props: Object
			 });
const HeadTitle = 'Produk Kami';
const Action = 'all';

</script>
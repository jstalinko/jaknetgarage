<template>
    <div>
        <header class="bg-gray-800 text-white py-4">
            <nav class="container mx-auto flex justify-between items-center">
                <div class="text-xl font-bold">JakNet Garage</div>
                <ul class="flex space-x-4">
                    <li><a href="#home" class="hover:text-gray-400">Beranda</a></li>
                    <li><a href="#services" class="hover:text-gray-400">Layanan</a></li>
                    <li><a href="#products" class="hover:text-gray-400">Sparepart</a></li>
                    <li><a href="#contact" class="hover:text-gray-400">Kontak</a></li>
                </ul>
            </nav>
        </header>
        <HeroSection />
        <ServicesSection />
        <ProductsSection />
        <PostsSection/>
        <ContactSection />
        <footer class="bg-gray-800 text-white text-center py-4">
            <p>&copy; 2024 JakNet Garage. All rights reserved.</p>
        </footer>
    </div>
</template>

<script setup>
import HeroSection from './Components/HeroSection.vue';
import ServicesSection from './Components/ServicesSection.vue';
import ProductsSection from './Components/ProductsSection.vue';
import ContactSection from './Components/ContactSection.vue';
import PostsSection from './Components/PostsSection.vue';

</script>
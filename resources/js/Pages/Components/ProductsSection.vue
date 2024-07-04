<template>
  <section id="products" class="py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Sparepart</h2>
    <div class="flex flex-wrap justify-center">
      <div class="product-card" v-for="product in products" :key="product.name">
        <img :src="product.image" :alt="product.name" class="mb-4">
        <h3 class="text-xl font-semibold mb-2">{{ product.name }}</h3>
        <p>Harga: {{ product.price }}</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import {ref} from 'vue';
const products= ref([
        { name: 'Oli Mesin', price: 'Rp 50.000', image: 'https://placehold.co/600x400?text=Hello+World' },
        { name: 'Ban Motor', price: 'Rp 200.000', image: 'https://placehold.co/600x400?text=Hello+World' },
        { name: 'Aki Motor', price: 'Rp 150.000', image: 'https://placehold.co/600x400?text=Hello+World' },
      ]);
</script>

<style scoped>
.product-card {
  background: #f4f4f4;
  padding: 1rem;
  margin: 1rem;
  border-radius: 0.5rem;
  text-align: center;
  max-width: 300px;
}
</style>

<template>
    <JustHead :Global="props.globals"/>
    <div>
        <Navbar :Categories="props.categories" />
        <br><br>
        <ProductPage :Products="props.products"  :Filter="props.filter" :HeadTitle="HeadTitle" :Global="props.globals" :FilterQuery="props.filter_query"  />
        
        <Footer :Socmed="props.globals.settings.sosmed" :Pages="props.posts"/>

    </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import ProductPage from '../Components/ProductPage.vue';
import Footer from '../Components/Footer.vue';
import JustHead from '../Components/JustHead.vue';
const HeadTitle = "Produk Kami";
defineProps({
    props: Object
})
</script>
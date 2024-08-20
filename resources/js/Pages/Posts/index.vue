<template>
    <div>
        <Navbar :Categories="props.categories" />

        <PostPage :Posts="props.posts" />


        <Footer :Socmed="props.globals.settings.sosmed" :Pages="props.posts" :Global="props.globals"/>

    </div>
</template>

<script setup >
import Navbar from '../Components/Navbar.vue';
import PostPage from '../Components/PostPage.vue';
import Footer from '../Components/Footer.vue';
defineProps({ props: Object });
</script>

<template>

    <div>
        <JustHead :Global="props.global" :title="props.post.title" />
        <Navbar :Categories="props.Categories" />
        <br><br>
        <div class="container mx-auto mt-10 w-8/12 min-h-screen border-2 rounded px-10 py-10">
            <h1 class="text-3xl font-bold text-center md:text-left mb-4 poppins-bold"><i class="mdi mdi-newspaper"></i>
                {{ props.post.title }}</h1>
                <img :src="helpers.imageUrl(props.post.image)"  :alt="props.post.title" class="object-cover justify-center rounded"/>
            <div class="prose lg:prose-xl" v-html="props.post.content"></div>
        </div>

        <Footer/>
    </div>
</template>

<script setup>
import JustHead from '../Components/JustHead.vue';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';
import {inject} from 'vue';
const helpers = inject('helpers');


defineProps({props: Object})

</script>
<template>

    <div>
        <JustHead :Global="props.global" :title="props.post.title" />
        <Navbar :Categories="props.categories" :Settings="props.globals.settings" />
        <br><br>
        <div class="mt-10 container max-w-7xl mx-auto min-h-screen bg-gray-100 rounded-lg px-8 py-5">
            <h1 class="text-4xl text-center poppins-bold underline mt-10 mb-4"><i class="mdi mdi-newspaper"></i>
                {{ props.post.title }}</h1>
                <img :src="helpers.imageUrl(props.post.image)"  :alt="props.post.title" class="object-cover justify-center rounded"/>
            <div class="mb-2 mt-5 prose lg:prose-xl" v-html="props.post.content"></div>
        </div>

        <Footer :Socmed="props.globals.settings.sosmed" :Pages="props.posts" :Global="props.globals"/>
        
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
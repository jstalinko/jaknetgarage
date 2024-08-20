<template>
    <div>
        <JustHead :Global="props.globals" :title="'Tentang Kami'" />
        <Navbar :Categories="props.categories" :Settings="props.globals.settings" />

        <div class="mt-10 container max-w-7xl mx-auto min-h-screen bg-gray-100 rounded-lg px-8 py-5">
            <h1 class="text-4xl text-center poppins-bold underline mt-10">Tentang Kami</h1>

            <div class="prose lg:prose-xl poppins-regular" v-html="props.globals.settings.about"></div>

        </div>
    </div>
    
</template>

<script setup>
import JustHead from "./Components/JustHead.vue";
import Navbar from "./Components/Navbar.vue";
const prop = defineProps({props: Object});
</script>
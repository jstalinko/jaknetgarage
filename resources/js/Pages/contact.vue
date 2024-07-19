<template>
    <div>
        <Navbar />

        {{ props.settings }}
    </div>
    
</template>

<script setup>
import Navbar from './Components/Navbar.vue';
defineProps({props: Object});
</script>
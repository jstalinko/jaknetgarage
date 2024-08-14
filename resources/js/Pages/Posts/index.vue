<template>
    <div>
        <Navbar :Categories="props.categories" />

        <PostPage :Posts="props.posts" />
    </div>
</template>

<script setup lang="ts">
import Navbar from '../Components/Navbar.vue';
import PostPage from '../Components/PostPage.vue';

defineProps({ props: Object });
</script>

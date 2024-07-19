<template>

    <Head>
        <title v-if="title == '' || title == null"> {{ Global?.settings?.site_name }} | {{ Global?.settings?.site_description }}</title>
        <title v-else>{{ title }} - {{ Global?.settings?.site_name }}</title>
       
    </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
defineProps({ Global: Object, title: String });
</script>
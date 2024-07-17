<template>

    <Head>
        <title v-if="title == '' || title == null"> {{ Global?.Settings?.name }} | {{ Global?.Settings?.tag }}</title>
        <title v-else>{{ title }} - {{ Global?.Settings?.name }}</title>
        <div v-if="title == '' || title == null">
            <meta head-key="description" name="description" :content="Global?.Settings?.meta_description" />

        </div>
        <div v-else>
            <meta head-key="description" name="description"
                :content="'Temukan produk furniture berkualitas hanya di iahomefurniture.com - ' + title" />

        </div>
        <meta head-key="keywords" name="keywords" :content="Global?.Settings?.meta_keywords" />
        <meta head-key="author" name="author" :content="Global?.Settings?.meta_author" />
    </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
defineProps({ Global: Object, title: String });
</script>
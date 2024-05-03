<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "../Components/Header.vue";
import ListBlockGo from "../Components/ListGo/ListBlockGo.vue";

import HomeStartSection from "@/Components/HomeStartSection.vue";
</script>

<template>
    <Head title="Журнал" />
    <Header />
    <div v-if="$page.props.auth.user">
        <HomeStartSection />
        <ListBlockGo />
    </div>

</template>

<style></style>

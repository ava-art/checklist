<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "../Components/Header.vue";

import ListCategories from "../Components/Home/ListCategories.vue"


</script>

<template>
    <Head title="Главная CheckList" />
    <Header />
    <div v-if="$page.props.auth.user" class="container">
       <ListCategories />
    </div>

</template>

<style>
.container{
    max-width: 600px;
    margin: 20px auto;
}
</style>

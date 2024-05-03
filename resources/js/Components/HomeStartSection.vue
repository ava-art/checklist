<script setup>
import HomeCar from "./SVG/HomeCar.vue";
import HomeVelo from "./SVG/HomeVelo.vue";
import HomeSamokat from "./SVG/HomeSamokat.vue";
import HomeGiro from "./SVG/HomeGiro.vue";
import HomeKart from "./SVG/HomeKart.vue";
import HomeRoller from "./SVG/HomeRoller.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <ul
        class="category-list flex flex-wrap mt-4 gap-3 p-4 container-custom justify-between"
    >
        <Link
            :href="route('start', { list: '2' })"
            class="category-item flex justify-center items-center bg-white rounded-xl p-2"
            ><div class="category-item_img">
                <HomeCar /></div
        ></Link>
        <Link
            :href="route('start', { list: '1' })"
            class="category-item flex justify-center items-center bg-white rounded-xl p-2"
            ><div class="category-item_img">
                <HomeVelo /></div
        ></Link>
        <Link
            :href="route('start', { list: '3' })"
            class="category-item flex justify-center items-center bg-white rounded-xl p-2"
            ><div class="category-item_img">
                <HomeSamokat /></div
        ></Link>
        <Link
            :href="route('start', { list: '4' })"
            class="category-item flex justify-center items-center bg-white rounded-xl p-2"
            ><div class="category-item_img">
                <HomeGiro /></div
        ></Link>
        <Link
            :href="route('start', { list: '5' })"
            class="category-item flex justify-center items-center bg-white rounded-xl p-2"
            ><div class="category-item_img">
                <HomeKart /></div
        ></Link>
        <Link
            :href="route('start', { list: '6' })"
            class="category-item flex justify-center items-center bg-white rounded-xl p-2"
            ><div class="category-item_img">
                <HomeRoller /></div
        ></Link>
    </ul>
</template>

<style>
.category-item {
    width: 30%;
    cursor: pointer;
    transition: all 0.1s linear;
}
.category-item:hover {
    background-color: #e9e9e9;
}

.category-item svg {
    max-width: 60px;
    max-height: 50px;
}
</style>

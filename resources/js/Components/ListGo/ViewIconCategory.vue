<script setup>
import HomeSamokat from "../SVG/HomeSamokat.vue";
import HomeVelo from "../SVG/HomeVelo.vue";
import HomeRoller from "../SVG/HomeRoller.vue";
import HomeCar from "../SVG/HomeCar.vue";
import HomeKart from "../SVG/HomeKart.vue";
import HomeGiro from "../SVG/HomeGiro.vue";

defineProps({
    category: {
        type: String,
    },
});
</script>

<template>
   
        <HomeVelo v-if="category == 'Велосипеды'" />
        <HomeCar v-if="category == 'Машинки'" />
        <HomeKart v-if="category == 'Картинг'" />
        <HomeGiro v-if="category == 'Гироскутеры'" />
        <HomeRoller v-if="category == 'Ролики'" />
        <HomeSamokat v-if="category == 'Самокаты'" />
    
</template>

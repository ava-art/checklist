<script setup>
import SVGBonus from "../SVG/SVGBonus.vue";
import SVGCredit from "../SVG/SVGCredit.vue";
import SVGNalichka from "../SVG/SVGNalichka.vue";
import SVGPhone from "../SVG/SVGPhone.vue";

defineProps({
    sposob: {
        type: String,
    },
});
</script>

<template>
    <SVGNalichka v-if="sposob == 'Наличные'" />
    <SVGPhone v-if="sposob == 'Перевод'" />
    <SVGCredit v-if="sposob == 'Терминал'" />
    <SVGBonus v-if="sposob == 'Бонус'" />
</template>

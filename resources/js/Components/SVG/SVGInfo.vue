<script setup>

const props = defineProps({
    item:{
        type: Array
    }
})

const item = props.item[0]
</script>
<template>
    <svg 
    v-if="item.money_full_drive > item.money_pay_start"
    class="inner-item-stop w-full"
    :class="{active : item.beetwenMin > item.time_rent && item.time_rent < 122 && item.time_rent != 0}"
    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
       <path 
            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"
        />
    </svg>
    <svg 
    v-if="item.money_full_drive <= item.money_pay_start"
    class="inner-item-success w-full"
    :class="{active : item.beetwenMin > item.time_rent && item.time_rent < 122 && item.time_rent != 0}"
    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
       <path 
            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"
        />
    </svg>
</template>
<style>
@keyframes inner-item {
    0% {
        box-shadow: 0 0 15px #e6e6e6ce;
    }
    50% {
        box-shadow: -70px 0 15px #e81919ce;
    }
    100% {
        box-shadow: 0 0 15px #e6e6e6ce;
    }
}
@keyframes inner-item-succe {
    0% {
        box-shadow: 0 0 15px #e6e6e6ce;
    }
    50% {
        box-shadow: -70px 0 15px #19e82089;
    }
    100% {
        box-shadow: 0 0 15px #e6e6e6ce;
    }
}
.inner-item-stop path {
    fill: #e8191989;
}

.inner-item-stop.active {
    animation: inner-item 1300ms infinite;
}
.inner-item-success path {
    fill: #19e82089;
}

.inner-item-success.active {
    animation: inner-item-succe 1300ms infinite;
}
</style>
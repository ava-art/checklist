<script setup>
const props = defineProps({
    time: {
        type: String,
    },
});

let howTime = "";

switch (Number(props.time)) {
    case 0:
        howTime = "ФАКТ";
        break;
    case 10:
        howTime = "10 минут";
        break;
    case 20:
        howTime = "20 минут";
        break;
    case 30:
        howTime = "30 минут";
        break;
    case 60:
        howTime = "1 час";
        break;
    case 120:
        howTime = "2 часа";
        break;
    case 180:
        howTime = "День";
        break;
    case 240:
        howTime = "Сутки";
        break;

    default:
        break;
}

</script>
<template> ({{ howTime }})</template>

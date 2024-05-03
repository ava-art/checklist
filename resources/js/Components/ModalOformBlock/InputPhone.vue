<script setup>
import { onBeforeUpdate, ref } from "vue";
import SVGClose from "../SVG/SVGClose.vue";
import { useStartStore } from "../../../stores/StartStore";

const startStore = new useStartStore();



onBeforeUpdate(async () => {
    if (
        startStore.startInfo.phone.length == 10 &&
        !startStore.startInfo.Client.phone
    ) {
        try {
            const res = await fetch(
                `https://app.welotochka.ru/api/postoyanniki/${startStore.startInfo.phone}`
            );
            const {data} = await res.json();
            
            if (data.img) {
                data.old_rent.reverse()
                startStore.startInfo.Client = data;
            } else {
                startStore.startInfo.Client = {};
            }
        } catch (error) {
            console.log(error);
        }
    } else {
        startStore.startInfo.Client = {};
        startStore.startInfo.photo = ''
    }
});
</script>
<template>
    <div class="flex relative">
        <div
            @click="
                (startStore.startInfo.phone = ''),
                    (startStore.startInfo.Client = {})
            "
            v-if="startStore.startInfo.phone.length"
            class="absolute top-4 left-2 cursor-pointer img-full"
        >
            <SVGClose />
        </div>
        <!-- <span class=" absolute eight-number">8</span> -->
        <input
            type="tel"
            class="w-full rounded-md mt-2 mb-2 pl-14"
            placeholder="Номер с 9"
            @input="(e) => (startStore.startInfo.phone = e.target.value.replace(/[^0-9]/g, ''))"
            :value="startStore.startInfo.phone"
        />
        <a
            :href="'tel:8' + startStore.startInfo.phone"
            class="absolute top-3 bg-slate-200 p-1 right-1 rounded-md text-sky-500"
            >ПРОЗВОН</a
        >
    </div>
</template>

<style>
.eight-number{
    top: 17px;
    left: 36px;
}
</style>
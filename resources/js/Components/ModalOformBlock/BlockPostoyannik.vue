<script setup>
import { ref } from "vue";
import { useStartStore } from "../../../stores/StartStore";
import { useChangeStore } from "../../../stores/ChangeStore";

import SVGArrow from "../SVG/SVGArrow.vue";
import LoaderKoleso from "../LoaderKoleso.vue";
import EditItemInfo from "../SVG/EditItemInfo.vue";

const startStore = new useStartStore();
const changeStore = new useChangeStore();

const activeFullPhoto = ref(false);
const activeOldGo = ref(false);
</script>
<template>
    <div class="flex justify-start gap-3 mb-2 mt-2 relative">
        <div
            @click="() => (changeStore.client = startStore.startInfo.Client)"
            
            class="w-6 cursor-pointer absolute top-0 right-0 flex items-center justify-center"
        >
            <EditItemInfo />
        </div>
       

        <div class="block-photo w-20 h-24 border border-gray-200 rounded-xl">
            <div
                @click="activeFullPhoto = !activeFullPhoto"
                v-if="startStore.startInfo.Client.img"
                class="w-full h-full bg-cover bg-center rounded-xl"
                :class="{ img_full_client : activeFullPhoto }"
                :style="
                    'background-image:url(https://app.welotochka.ru/' +
                    startStore.startInfo.Client.img +
                    '); background-size: contain;'
                "
            ></div>
            <LoaderKoleso v-else />
        </div>
        <div>
            <div>{{ startStore.startInfo.Client.name }}</div>
            <div>{{ startStore.startInfo.Client.family }}</div>
            <a
                class="text-sky-500"
                :href="'tel:' + startStore.startInfo.Client.phone"
                >{{ startStore.startInfo.Client.phone }}</a
            >
            <div>Печатей: {{ startStore.startInfo.count_bonus }}</div>
        </div>
    </div>
    <div v-if="startStore.startInfo.Client.comment">
        Комментарий : {{ startStore.startInfo.Client.comment }}
    </div>
</template>

<style>
.img_full_client{
    position: fixed;
  width: 100%;
  left: 0px;
  background-repeat: no-repeat;
  border: 5px solid #ffe607;
  z-index: 100;
  top: 47px;
  max-height: 90vh;
  height: 50%;
  background-color: #1f1f1f;
  background-size: contain;
  background-position: center;
}
</style>
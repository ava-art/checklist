<script setup>
import { Head } from "@inertiajs/vue3";
import Header from "../Components/Header.vue";
import OformGo from "../Components/SVG/OformGo.vue";
import ModalOform from "../Components/ModalOform.vue";
import ModalShields from "../Components/ModalShields.vue";
import ModalRepair from "../Components/ModalRepair.vue";

import { useHomeStore } from "../../stores/HomeStore";
import { ref } from "vue";
import ViewIconCategory from "@/Components/ListGo/ViewIconCategory.vue";
import SVGShield from "@/Components/SVG/SVGShield.vue";
import SVGRepairs from "@/Components/SVG/SVGRepairs.vue";
import LoaderKoleso from "@/Components/LoaderKoleso.vue";

const homeStore = new useHomeStore();

let params = new URL(document.location).searchParams;

homeStore.getFreeItems(params);

const activeFullPhoto = ref(null);
</script>

<template>
    <Head title="Журнал" />
    <Header />
    <div v-if="$page.props.auth.user">
        <div
            class="flex justify-center flex-wrap gap-2 mt-6 mb-28 container-main"
            v-if="homeStore.listItems.free != []"
        >
            <div
                :style="'background: ' + item.color + '90;'"
                class="border-black border relative list-free-items p-2 py-0 rounded-lg bg-white flex gap-1 font-semibold items-center text-sm cursor-pointer"
                v-for="(item, id) of homeStore.listItems.free"
                :class="{
                    active: homeStore.listItems.checked.filter(
                        (el) => el.id == item.id
                    ).length,
                }"
                key="item.id"
            >
            
                <img
                    v-if="item.image"
                    class="block rounded-md w-2/12"
                    :src="'https://app.welotochka.ru/' + item.image"
                    alt=""
                    :class="{ img_full_start: activeFullPhoto == item.id }"
                    @click="
                        activeFullPhoto == item.id
                            ? (activeFullPhoto = null)
                            : (activeFullPhoto = item.id)
                    "
                />
                <div v-else class="w-6">
                    <ViewIconCategory  :category="item.category.name" />
                </div>
                <div
                    @click="homeStore.editActiveElemt(item)"
                    class="w-9/12 min-h-9 flex items-center"
                >
                    {{ item.name }}
                </div>
                <div class="w-1/12 flex flex-col">
                    <div
                        class="w-1/12 absolute top-0 right-0 border-l border-l-black h-full"
                    >
                        <div
                            class="w-full h-2/4 shield-p flex items-center"
                            @click="homeStore.itemRepair = item"
                        >
                            <SVGRepairs :active="item" />
                        </div>
                        <hr class="border-t-black" />
                        <div
                            class="w-full h-2/4 shield-p flex items-center"
                            @click="homeStore.itemShields = item"
                        >
                            <SVGShield :active="item" />
                        </div>
                    </div>
                </div>
                <ModalShields :item="item" />
                <ModalRepair :item="item" />
            </div>
        </div>
        <LoaderKoleso v-if="homeStore.loader" />

        <ModalOform />

        <div
            @click="homeStore.clickOform"
            class="btn-oform fixed bottom-6 right-6 transition-all cursor-pointer rounded-full"
            :class="homeStore.hidden.oform"
        >
            <OformGo />
        </div>
    </div>
</template>

<style>
.list-free-items {
    width: 45%;
    transition: all 0.2s linear;
}
.container-main {
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
.list-free-items:hover {
    opacity: 1 !important;
}
.list-free-items.active {
    background: rgb(27, 27, 27) !important;
    color: rgb(255, 0, 0);
}
.btn-oform.active {
    transform: rotate(45deg);
}
.shield-p {
    padding: 2px;
}
</style>

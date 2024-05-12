<script setup>
import { ref } from "vue";
import { useHomeStore } from "/resources/stores/HomeStore";
import ElementChekList from "./ElementChekList.vue";

const homeStore = new useHomeStore();

const props = defineProps({
    category: {
        type: Object,
    },
});

const open = ref(false);
const add = ref(false);

const addElement = (newElement, category) => {
    homeStore.addElement(newElement, category);
    add.value = false
};

const newElement = ref("");
</script>
<template>
    <div>
        <div class="mb-2 text-center font-bold" @click="open = !open">
            {{ category.name }}
        </div>
        <div class="border-t mb-2 collapses" :class="{ open: open }">
            <div style="min-height: 0px">
                <div
                    class="bg-gray-50 p-1 mb-2 mt-1 rounded-lg"
                    :key="element.id"
                    v-for="element of category.elements"
                >
                    <ElementChekList :element="element" />
                </div>
                <div>
                    <div
                        @click="add = !add"
                        :class="{ active: add }"
                        class="m-auto text-center close-btn mt-2 bg-orange-200 w-10 h-10 rounded-full font-bold flex items-center justify-center"
                    >
                        +
                    </div>
                    <div class="collapses" :class="{ open: add }">
                        <div style="min-height: 0">
                            <div
                                class="relative border border-gray-800 mt-2 p-2 rounded-lg flex items-center justify-between gap-3"
                            >
                                <input
                                    @input="
                                        (e) => (newElement = e.target.value)
                                    "
                                    placeholder="Новый элемент"
                                    type="text"
                                    class="w-4/5 pr-24 block border-none m-auto rounded-lg"
                                />
                                <div
                                    @click="
                                        () => addElement(newElement, category)
                                    "
                                    class="h-10 add-btn-element bg-orange-200 p-2 rounded-lg"
                                >
                                    Добавить
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.add-btn-element {
    top: 1px;
}
.close-btn {
    transition: 0.2s linear;
}
.close-btn.active {
    transform: rotate(45deg);
}
</style>

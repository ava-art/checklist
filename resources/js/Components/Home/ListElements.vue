<script setup>
import { ref } from "vue";
import { useHomeStore } from "/resources/stores/HomeStore";

const homeStore = new useHomeStore();

const props = defineProps({
    category: {
        type: Object,
    },
});

const open = ref(false);
const add = ref(false);
const comment = ref(false);
const newElement = ref('')
</script>
<template>
    <div>
        <div class="mb-2 text-center font-bold" @click="open = !open">
            {{ category.name }}
        </div>
        <div class="border-t mb-2 collapses" :class="{ open: open }">
            <div style="min-height: 0px">
                <div class="flex justify-between w-full mb-2 mt-2">
                    <span>Помыть пол</span>
                    <div>O</div>
                </div>
                <div class="mb-2 text-center" @click="comment = !comment">Комментарий</div>
                <div class="collapses" :class="{ open: comment }">
                    <div style="min-height: 0">
                        <div class="border p-1 mb-2">
                            <textarea class="w-full"> Текст</textarea>
                            <div
                                class="bg-orange-200 w-28 text-center rounded-lg m-auto mb-2 mt-2 p-2"
                            >
                                Сохранить
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div
                        @click="add = !add"
                        class="m-auto text-center bg-orange-200 w-10 h-10 rounded-full font-bold flex items-center justify-center"
                    >
                        +
                    </div>
                    <div class="collapses" :class="{ open: add }">
                        <div style="min-height: 0">
                            <div class="relative">
                                <input
                                @input="e => newElement = e.target.value "
                                    type="text"
                                    class="w-4/5 pr-24 block m-auto rounded-lg mt-2"
                                />
                                <div
                                @click="() => homeStore.addElement(newElement, category)"
                                    class="absolute top-0 right-10 h-10 add-btn-element bg-orange-200 p-2 rounded-lg"
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
</style>

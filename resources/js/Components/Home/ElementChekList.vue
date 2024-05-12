<script setup>
import { ref } from "vue";
import { useHomeStore } from "/resources/stores/HomeStore";
const homeStore = new useHomeStore();

const props = defineProps({
    element: {
        type: Object,
    },
});

const comment = ref(false);
const changeName = ref(false);
const newName = ref(props.element.name)
const commentText = ref(props.element.comment);
const checked = ref(props.element.checked);
const updateChecked = () => {
    checked.value = !checked.value;
    homeStore.changeChecked(checked.value, props.element.id);
};

const changeNameFunc = () =>{
    if (newName == props.element.name ) return changeName.value = false
    
    homeStore.changeName(newName.value, props.element.id)

    changeName.value = false
}
</script>
<template>
    <div class="flex justify-between w-full mb-2 mt-2">
        <div class="flex-col flex">
            <span @click="changeName = !changeName" v-if="!changeName">{{
                newName
            }}</span>
            <div v-if="changeName " class="flex gap-3">
                <input type="text" :value="newName" @input="e => newName = e.target.value" class=" rounded-lg border-gray-300" />
                <button class=" bg-orange-200 px-2 rounded-lg" @click="changeNameFunc" >Сохранить</button>
            </div>
        </div>
        <div>
            <span class="thumbler">
                <label class="switch">
                    <input
                        @input="updateChecked"
                        :checked="checked"
                        type="checkbox"
                    />
                    <span class="slider round"></span>
                </label>
            </span>
        </div>
    </div>
    <div class="mb-2 text-left text-gray-400" @click="comment = !comment">
        {{ element.comment ? element.comment : "Комментарий ..." }}
    </div>
    <div class="collapses" :class="{ open: comment }">
        <div style="min-height: 0">
            <div class="border p-1 mb-2">
                <textarea
                    class="w-full"
                    @change="(e) => (commentText = e.target.value)"
                >
 {{ commentText }}</textarea
                >
                <div
                    @click="
                        () => (
                            homeStore.saveComment(commentText, element.id),
                            (element.comment = commentText),
                            (comment = false)
                        )
                    "
                    class="bg-orange-200 w-28 text-center rounded-lg m-auto mb-2 mt-2 p-2"
                >
                    Сохранить
                </div>
            </div>
        </div>
    </div>
</template>
<style></style>

<script setup>
import { ref } from "vue";
import { useStopStore } from "../../../stores/StopStore";
import BlockPayChange from "./BlockPayChange.vue";
import { usePage } from "@inertiajs/vue3";
import InputFilePhoto from "../ModalOformBlock/InputFilePhoto.vue";
import BlockPostoyannik from "../ModalOformBlock/BlockPostoyannik.vue";

const stopStore = new useStopStore();

const user = usePage().props.auth.user;

const props = defineProps({
    item: {
        type: Array,
    },
});

const cat = props.item[0].category_id;
stopStore.changeItem = props.item[0];

stopStore.getElements(stopStore.changeItem.category_id);
stopStore.changeItem.who_update = user.name;
</script>
<template>
    <div
        class="fixed w-screen h-screen top-0 left-0 z-40 bg-black bg-opacity-80"
        @click.self="() => (stopStore.viewModal = {})"
    >
        <div
            class="wrap-modal-all w-11/12 min-h-16 bg-white rounded-xl m-auto mt-12 p-2 pt-0 overflow-y-scroll"
        >
            
            <div
                class="wrap-go-items items-center flex flex-wrap gap-2 justify-center text-sm"
            >
                <select
                    name="how_time_start"
                    id="how-time"
                    class="w-6/12 rounded-md mt-2 mb-2"
                    @change="
                        (e) =>
                            (stopStore.changeItem.element_id = e.target.value)
                    "
                >
                    <option
                        v-if="stopStore.changeItem.category_id == cat"
                        selected
                        :value="stopStore.changeItem.element.id"
                    >
                        {{ stopStore.changeItem.element.name }}
                    </option>
                    <option v-else selected value="0">Не выбрано</option>
                    <option
                        v-for="el of stopStore.changeItem.elements"
                        :value="el.id"
                    >
                        {{ el.name }}
                    </option>
                </select>
            </div>

            <hr />
            
            <div>
                <BlockPayChange :item="item" />
            </div>
            <div
                v-if="user.role == 'admins'"
                class="flex justify-between mb-2 pl-3 pr-3 pt-2 pb-2 mt-2 rounded-xl border-red-300 border items-center"
            >
                <input
                    class="rounded-lg"
                    type="date"
                    :value="stopStore.changeItem.date_start"
                    @input="e => stopStore.changeItem.date_start = e.target.value"
                />
                <input
                    class="rounded-lg"
                    type="time"
                    :value="stopStore.changeItem.time_start"
                    @input="e => stopStore.changeItem.time_start = e.target.value"
                />
            </div>
            <hr />

            <textarea
                class="mt-2 mb-2 w-full rounded-xl"
                placeholder="Комментарий"
                name="start-comment"
                id="start-comment"
                @input="
                    (e) => (stopStore.changeItem.comment_start = e.target.value)
                "
                :value="stopStore.changeItem.comment_start"
            ></textarea>
            <hr />
            <div>
                <div
                    @click="() => stopStore.sendChangeItemRent()"
                    class="w-3/5 cursor-pointer m-auto mt-3 flex h-10 items-center justify-center p-5 pl-7 pr-7 bg-red-500 text-xl rounded-xl mb-2"
                >
                    Изменить
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bgRed {
    background-color: rgb(228, 159, 159);
}
</style>

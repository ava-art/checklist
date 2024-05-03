<script setup>
import { ref } from "vue";
import { useStartStore } from "../../../stores/StartStore";
import LoaderKoleso from "../LoaderKoleso.vue";
import { onUpdated } from "vue";
import SVGCheckYes from "../SVG/SVGCheckYes.vue";


const startStore = new useStartStore();
const loaderUploadPhoto = ref(false);
const activeFullPhoto = ref(false);

const uploadPhoto = async (file) => {
    const data = new FormData();
    data.append("photo", file);
    data.append("phone", startStore.startInfo.phone);
    data.append("user", startStore.user.name);

    try {
        loaderUploadPhoto.value = true;
        const res = await fetch("https://app.welotochka.ru/api/upload", {
            headers: {
                "X-CSRF-TOKEN": startStore.csrf,
            },
            method: "POST",
            body: data,
        });
        const datas = await res.json();
        startStore.startInfo.Client = datas.data;
        startStore.startInfo.photo = datas.data.img;
    } catch (error) {
        console.log(error);
    }
};

const clickInpuUpload = () => {
    document.querySelector("#fileUploadReview").click();
};
onUpdated(() => {
    if (startStore.startInfo.photo) {
        loaderUploadPhoto.value = false;
    }
});
const addNewClients = async () => {
   
    const { photo } = startStore.startInfo;
    const client = {
        id: startStore.startInfo.Client.id,
        name: startStore.startInfo.add_name,
        family: startStore.startInfo.add_family,
        phone: startStore.startInfo.phone,
        comment: startStore.startInfo.add_comment ? startStore.startInfo.add_comment : "",
        user:startStore.user.name,
        photo,
        postoyannik: 1,
    };
    
    if (client.name && client.photo && client.family) {
        const data = new FormData();
        data.append('client', JSON.stringify(client));

        try {
        const res = await fetch(`https://app.welotochka.ru/api/add-client`, {
            headers: {
                "X-CSRF-TOKEN": startStore.csrf,
            },
            method: "POST",
            body: data,
        });
        const datas = await res.json();

        startStore.startInfo.Client = datas.data
    } catch (error) {
        console.log(error);
    }
    } else {
        alert("Фото, имя и фамилия обязательны!");
    }
};
</script>
<template>
    <div v-if="startStore.startInfo.Client.postoyannik != 1 ">
        <div
            v-if="startStore.startInfo.photo"
            @click="startStore.startInfo.photo = ''"
            class="text-red-500"
        >
            заменить фото
        </div>
        <div class="flex justify-start gap-3 mb-2">
            <div
                @click="activeFullPhoto = !activeFullPhoto"
                class="block-photo w-1/4 h-24 border border-gray-200 rounded-xl relative"
                v-if="!startStore.startInfo.photo"
            >
                <div class="cursor-pointer">
                    <span
                        v-if="!loaderUploadPhoto"
                        @click="clickInpuUpload"
                        class="absolute w-full h-full text-7xl text-center top-2 text-slate-400"
                        >+</span
                    >
                    <input
                        v-if="!loaderUploadPhoto"
                        @change="(e) => uploadPhoto(e.target.files[0])"
                        id="fileUploadReview"
                        type="file"
                        accept="image/png, image/jpeg, image/jpg"
                        class="w-3/5 rounded-md mt-1 mb-1 m-auto opacity-0"
                    />
                </div>
                <LoaderKoleso v-if="loaderUploadPhoto" />
            </div>
            <div
                v-else
                @click="activeFullPhoto = !activeFullPhoto"
                class="block-photo w-1/4 h-24 border border-gray-200 rounded-xl relative"
                :class="{ img_full: activeFullPhoto }"
                :style="
                    'background-image:url(https://app.welotochka.ru/' +
                    startStore.startInfo.photo +
                    '); background-size: contain; background-position:center;'
                "
            ></div>
            <div class="w-2/4">
                <input
                    type="text"
                    class="w-full rounded-md mt-1 mb-1"
                    placeholder="Имя"
                    @input="
                        (e) => (startStore.startInfo.add_name = e.target.value)
                    "
                    :value="startStore.startInfo.add_name"
                />
                <input
                    type="text"
                    class="w-full rounded-md mt-1 mb-1"
                    placeholder="Фамилия"
                    @input="
                        (e) =>
                            (startStore.startInfo.add_family = e.target.value)
                    "
                    :value="startStore.startInfo.add_family"
                />
            </div>
            <div
                class="flex items-center border rounded-xl p-2 cursor-pointer bg-lime-500"
                @click="addNewClients"
            >
                <SVGCheckYes />
            </div>
        </div>
        <textarea
        v-if="startStore.startInfo.photo"
            class="w-full rounded-xl p-0 indent-3 h-8"
            placeholder="Комментарий к клиенту"
            @input="(e) => (startStore.startInfo.add_comment = e.target.value)"
            :value="startStore.startInfo.add_comment"
        ></textarea>
    </div>
</template>

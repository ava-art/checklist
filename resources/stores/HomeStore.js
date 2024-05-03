import { defineStore } from "pinia";
import { ref } from "vue";

let csrf = "";

document.cookie.split("; ").forEach((el) => {
    let arEl = el.split("=");

    if (arEl[0] == "XSRF-TOKEN") {
        csrf = el.split("=")[1];
    }
});

export const useHomeStore = defineStore("homeStore", () => {
    const hidden = ref({
        burger: "",
        menu: "hidden-menu",
        oform: "not",
    });
    const loader = ref(true)
    const listItems = ref({
        free: [],
        checked: [],
        checkedIds: [],
    });
    const itemShields = ref({});
    const itemRepair = ref({});

    const clickOform = () => {
        hidden.value.oform == "not"
            ? (hidden.value.oform = "active")
            : (hidden.value.oform = "not");
    };
    const getFreeItems = async (params) => {
        loader.value = true
        listItems.value.free = [];
        const res = await fetch(`https://app.welotochka.ru/api/start/${params.get("list")}`);
        const data = await res.json();

        data.data.forEach((element) => {
            if (element.go != 1) {
                listItems.value.free.push(element);
            }
        });
        loader.value = false
    };

    const setShields = async () =>{
      
        const sendData = new FormData();
        sendData.append("set_shield", JSON.stringify(itemShields.value));
        try {
            const res = await fetch("https://app.welotochka.ru/api/set-shileds", {
                method: "POST",
                body: sendData,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            });
            const { data } = await res.json();
            
            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {}
    }
    const setRepair = async () =>{
      
        const sendData = new FormData();
        sendData.append("set_repair", JSON.stringify(itemRepair.value));
        try {
            const res = await fetch("https://app.welotochka.ru/api/set-repair", {
                method: "POST",
                body: sendData,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            });
            const { data } = await res.json();
           
            if (data == 1) {
                window.location.href = "/";
            }
        } catch (error) {
            console.log(error);
        }
    }

    const editActiveElemt = (item) => {
        console.log(item);
        const arChekeds = listItems.value.checked;
        const filter = arChekeds.filter(el => el.id == item.id)
        if (!filter.length) {
            arChekeds.push(item);
            listItems.value.checked = arChekeds;
        } else {
            let newAr = [];
            arChekeds.forEach((el) => {
                if (el.id != item.id) {
                    newAr.push(el);
                }
            });
            listItems.value.checked = newAr;
        }
    };

    return {
        hidden,
        listItems,
        itemShields,
        loader,
        setShields,
        itemRepair,
        setRepair,
        clickOform,
        getFreeItems,
        editActiveElemt,
    };
});

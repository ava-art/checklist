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
    const loader = ref(true);
    const newCategory = ref({
        checked: false,
        name: "",
    });
    const categories = ref([]);
    const elements = ref({
        open: [],
        add: [],
    });

    const getCategories = async () => {
        const res = await fetch(`/api/get-category`);
        const data = await res.json();
        categories.value = data;
    };

    const addCategory = async () => {
        if (!newCategory.value.checked)
            return (newCategory.value.checked = !newCategory.value.checked);

        if (newCategory.value.name == "")
            return alert("Введите название категории");
        const sendData = new FormData();
        sendData.append("data", JSON.stringify(newCategory.value.name));

        try {
            const res = await fetch(`/api/add-category`, {
                method: "POST",
                body: sendData,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            });
            const data = await res.json();

            if (data) {
                newCategory.value.checked = false;
                newCategory.value.name = "";
                categories.value = data['data']
            }
        } catch (error) {
            console.log(error);
        }
    };

    const addElement = async (name, category) => {
        if (name == "") return alert("Введите название елемента");

        const sendData = new FormData();
        sendData.append(
            "data",
            JSON.stringify({
                name,
                category_id: category.id,
                user_id: category.user_id,
            })
        );

        try {
            const res = await fetch(`/api/add-element`, {
                method: "POST",
                body: sendData,
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
            });
            const data = await res.json();

            if (data) {
                newCategory.value.checked = false;
                newCategory.value.name = "";
                console.log("Запрос на категории");
            }
        } catch (error) {
            console.log(error);
        }
    };

    return {
        addCategory,
        getCategories,
        addElement,
        newCategory,
        categories,
        elements,
        hidden,
        loader,
    };
});

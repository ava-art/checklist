import { defineStore } from "pinia";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

let csrf = "";
document.cookie.split("; ").forEach((el) => {
    let arEl = el.split("=");

    if (arEl[0] == "XSRF-TOKEN") {
        csrf = el.split("=")[1];
    }
});

const date = new Date();
const mounth =
    date.getMonth() < 10 ? `0${date.getMonth() + 1}` : date.getMonth();
const day = date.getDate() < 10 ? `0${date.getDate()}` : date.getDate();
const now = `${date.getFullYear()}-${mounth}-${day}`;

export const useStatiscticsStore = defineStore("statisticsStore", () => {
    const defineElements = ref([]);
    const listElements = ref([]);
    const loader = ref(true)
    const checkedUser = ref("all");
    const allUsers = ref([]);
    const Rashod = ref({
        checked: true,
    });
    const Acessory = ref({
        checked: true,
    });
    const viewModal = ref(null);
    const viewRashod = ref(false);
    const viewAcessory = ref(false);
    const changeItem = ref({});
    const addRashod = ref({
        what: null,
        sum: null,
        who_add: usePage().props.auth.user.name,
    });
    const fullMoney = ref({
        itog: 0,
        nal: 0,
        per: 0,
        ter: 0,
        bonus: 0,
    });

    const checkCategory = ref({
        Машинки: true,
        Велосипеды: true,
        Самокаты: true,
        Гироскутеры: true,
        Картинг: true,
        Ролики: false,
    });
    const checkSposob = ref({
        Наличные: true,
        Перевод: true,
        Терминал: true,
        Бонус: true,
    });
    const sposobPay = ref({
        Наличные: 0,
        Перевод: 0,
        Терминал: 0,
        Бонус: 0,
    });
    const moneyFull = ref(0);
    const dateInput = ref({
        start: now,
        stop: now,
    });
    const clearFullSumm = () => {
        moneyFull.value = 0;
        sposobPay.value["Наличные"] = 0;
        sposobPay.value["Перевод"] = 0;
        sposobPay.value["Терминал"] = 0;
        sposobPay.value["Бонус"] = 0;
    };

    const changeCategory = (category) => {
        checkCategory.value[category] = !checkCategory.value[category];
        filterPanel();
    };
    const changeCheckSposob = (sposob) => {
        checkSposob.value[sposob] = !checkSposob.value[sposob];
        filterPanel();
    };
    const changeCheckedUser = (user) => {
        checkedUser.value = user;
        filterPanel();
    };
    const filterPanel = () => {
        clearFullSumm();
        const newAr = [];
        defineElements.value.forEach((el) => {
            let moneyPayStartAll = 0;
            let moneyPayStopAll = 0;
            let moneyFullRentAll = 0;

            const filterAr = [];
            el[1].forEach((elem) => {
                allUsers.value.includes(elem.who_start)
                    ? ""
                    : allUsers.value.push(elem.who_start);
                allUsers.value.includes(elem.who_stop)
                    ? ""
                    : allUsers.value.push(elem.who_stop);
                if (elem.category.name == "Защита")
                    elem.category.name = "Ролики";

                if (checkCategory.value[elem.category.name]) {
                    if (
                        checkSposob.value[elem.sposob_pay_start] ||
                        checkSposob.value[elem.sposob_pay_stop] ||
                        (!elem.sposob_pay_start && !elem.sposob_pay_stop)
                    ) {
                        if (
                            checkedUser.value == "all" ||
                            checkedUser.value == elem.who_start ||
                            checkedUser.value == elem.who_stop
                        ) {
                            if (!elem.money_pay_start) elem.money_pay_start = 0;
                            if (!elem.money_pay_stop) elem.money_pay_stop = 0;
                            if (
                                elem.sposob_pay_start == "Бонус" ||
                                elem.sposob_pay_stop == "Бонус"
                            ) {
                                sposobPay.value["Бонус"] += 1;
                            } else {
                                sposobPay.value[elem.sposob_pay_start] +=
                                    elem.money_pay_start;
                                sposobPay.value[elem.sposob_pay_stop] +=
                                    elem.money_pay_stop;
                            }

                            moneyPayStartAll += elem.money_pay_start;
                            moneyPayStopAll += elem.money_pay_stop;
                            moneyFullRentAll += elem.money_full_drive
                            moneyFull.value +=
                                elem.money_pay_start + elem.money_pay_stop;
                            return filterAr.push(elem);
                        }
                    }
                }
            });

            filterAr.forEach((elem) => {
                if (checkCategory.value[elem.category.name]) {
                    elem.money_pay_full = moneyPayStartAll + moneyPayStopAll;
                    elem.money_pay_start_all = moneyPayStartAll;
                    elem.money_pay_stop_all = moneyPayStopAll;
                    elem.money_full_drive_all = moneyFullRentAll;
                }
            });
            if (filterAr.length) {
                newAr.push(filterAr);
            }
        });
        if (Rashod.value.checked) {
            moneyFull.value = moneyFull.value - Rashod.value.sum;
            sposobPay.value["Наличные"] =
                sposobPay.value["Наличные"] - Rashod.value.sum;
        }
        if (Acessory.value.checked) {
            moneyFull.value = moneyFull.value + Acessory.value.sum;

            Acessory.value.list.forEach((el) => {
                sposobPay.value[el[1].sposob_pay] += el[1].full_price;
            });
        }
        listElements.value = newAr;
        loader.value = false
    };
    const deletePhoto = async (id) => {
        const formData = new FormData();
        formData.append("delete_photo", JSON.stringify(id));
        const resConf = confirm('Точно удалить фото документа?')
        if (!resConf) return

        try {
            const res = await fetch(`https://app.welotochka.ru/api/delete-photo`, {
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
                method: "POST",
                body: formData,
            });
            const { data } = await res.json();

            if (data) return window.location.reload();
            return "Ошибка удаления";
        } catch (error) {}
    };
    const getStatistic = async () => {

        if (!usePage().props.auth.user.name) return;
        try {
            loader.value = true
            const res = await fetch(
                `https://app.welotochka.ru/api/statistics/${dateInput.value.start}/${dateInput.value.stop}`
            );
            const { data } = await res.json();
            listElements.value = Object.entries(data[0]).reverse();
            defineElements.value = Object.entries(data[0]).reverse();
            Rashod.value.list = Object.entries(data[1]).reverse();
            Acessory.value.list = Object.entries(data[2]).reverse();
            if (Rashod.value.list.length) {
                if (Rashod.value.list.length == 1) {
                    Rashod.value.sum = Rashod.value.list[0][1].sum;
                } else {
                    Rashod.value.sum = Rashod.value.list.reduce((sum, el) => {
                        return sum + el[1].sum;
                    }, 0);
                }
            } else {
                Rashod.value.sum = 0;
                Rashod.value.list = [];
            }
            if (Acessory.value.list.length) {
                if (Acessory.value.list.length == 1) {
                    Acessory.value.sum = Acessory.value.list[0][1].full_price;
                } else {
                    Acessory.value.sum = Acessory.value.list.reduce(
                        (sum, el) => {
                            return sum + el[1].full_price;
                        },
                        0
                    );
                }
            } else {
                Acessory.value.sum = 0;
                Acessory.value.list = [];
            }
            filterPanel();
        } catch (error) {}
    };

    const onChangeItem = async () => {
        const formData = new FormData();
        formData.append("change", JSON.stringify(changeItem.value));

        const res = await fetch("https://app.welotochka.ru/api/change-stat", {
            headers: {
                "X-CSRF-TOKEN": csrf,
            },
            method: "POST",
            body: formData,
        });
        const { data } = await res.json();
        if (!data[0]) return alert("Ошибка");

        viewModal.value = null;
    };
    const onDeleteItem = async () => {
        if (!confirm(`Удалить ${changeItem.value.element.name}?`)) return;

        const formData = new FormData();
        formData.append("delete", JSON.stringify(changeItem.value));

        const res = await fetch("https://app.welotochka.ru/api/delete-stat", {
            headers: {
                "X-CSRF-TOKEN": csrf,
            },
            method: "POST",
            body: formData,
        });
        const { data } = await res.json();
        if (!data[0]) return alert("Ошибка");

        const newStatAr = [];

        listElements.value.forEach((el, id) => {
            let arr = [];
            el.forEach((elem) => {
                if (elem.id != changeItem.value.id) arr.push(elem);
            });
            if (arr.length) newStatAr.push(arr);
        });

        listElements.value = newStatAr;
        viewModal.value = null;
    };
    const onAddRashod = async () => {
        const formData = new FormData();
        formData.append("add_rashod", JSON.stringify(addRashod.value));

        try {
            const res = await fetch(`https://app.welotochka.ru/api/add-rashod`, {
                headers: {
                    "X-CSRF-TOKEN": csrf,
                },
                method: "POST",
                body: formData,
            });
            const { data } = await res.json();

            if (data) {
                addRashod.value = {
                    what: null,
                    sum: null,
                    who_add: usePage().props.auth.user.name,
                };
                viewRashod.value = false;
                return window.location.reload();
            }
            return "Ошибка удаления";
        } catch (error) {}
    };
    const changeCheckedRashod = () => {
        Rashod.value.checked = !Rashod.value.checked;
        filterPanel();
    };
    const changeCheckedAcessory = () => {
        Acessory.value.checked = !Acessory.value.checked;
        filterPanel();
    };
    return {
        listElements,
        checkCategory,
        dateInput,
        Acessory,
        viewAcessory,
        loader,
        changeCheckedRashod,
        changeCheckedAcessory,
        onAddRashod,
        changeItem,
        Rashod,
        checkedUser,
        addRashod,
        changeCheckedUser,
        allUsers,
        viewRashod,
        changeCategory,
        changeCheckSposob,
        filterPanel,
        moneyFull,
        sposobPay,
        deletePhoto,
        checkSposob,
        onDeleteItem,
        viewModal,
        onChangeItem,
        getStatistic,
    };
});

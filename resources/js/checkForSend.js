const checkForSend = (item) => {
    let name = "";

    name = item.element.name;

    if (
        (item.sposob_pay_stop &&
            !item.money_pay_stop &&
            item.sposob_pay_stop != "Бонус") ||
        (!item.sposob_pay_stop &&
            item.money_pay_stop &&
            item.sposob_pay_stop != "Бонус")
    ) {
        alert(`Выберите способ оплаты или впишите сумму ${name}`);
        return 1;
    }
    if (item.money_pay_stop < 0) {
        alert(`Сумма не может быть меньше 0 ${name}`);
        return 1;
    }
    if (!item.money_pay_start) {
        item.money_pay_start = 0;
    }
    if (
        Number(item.money_pay_stop) + Number(item.money_pay_start) == 0 &&
        item.sposob_pay_stop != "Бонус" &&
        !item.comment_stop
    ) {
        alert(`Почему 0? пиши комментарий ${name}`);
        return 1;
    }

    return 0;
};

export default checkForSend;

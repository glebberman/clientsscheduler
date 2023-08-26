import React from "react";
import { Link } from "@inertiajs/react";
import moment from "moment";

const MonthsList = ({ currentMonth, years, events }) => {
    const startOfMonth = moment(currentMonth).startOf("month");
    const endOfMonth = moment(currentMonth).endOf("month");
    const days = [];
    // console.log(years);
    console.log(events);
    const day = startOfMonth.clone().startOf("week");

    while (day.isSameOrBefore(endOfMonth, "day")) {
        days.push(day.clone());
        day.add(1, "day");
    }

    return <div>123</div>;
};

export default MonthsList;

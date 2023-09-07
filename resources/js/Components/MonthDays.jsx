import React from "react";
import utils from "../utils";

const MonthDays = ({
    activeYear,
    activeMonth,
    events,
    weekFirstDay,
    daysNamesShortList,
    monthsNamesList,
    setActiveDay,
    setShowDay,
}) => {
    let prevMonth, prevMonthYear, nextMonth, nextMonthYear;

    activeMonth = activeMonth.toString().padStart(2, "0");

    if (parseInt(activeMonth) === 1) {
        prevMonth = "12";
        prevMonthYear = activeYear - 1;
    } else {
        prevMonth = (parseInt(activeMonth) - 1).toString().padStart(2, "0");
        prevMonthYear = activeYear;
    }

    if (parseInt(activeMonth) === 12) {
        nextMonth = "01";
        nextMonthYear = activeYear + 1;
    } else {
        nextMonth = (parseInt(activeMonth) + 1).toString().padStart(2, "0");
        nextMonthYear = activeYear;
    }

    const firstDayOfMonthDayOfWeekNumber =
        events[activeYear]["months"][activeMonth]["days"]["01"]["dayOfWeek"];

    const daysFromPrevMonth = firstDayOfMonthDayOfWeekNumber - weekFirstDay;
    console.log(daysFromPrevMonth);
    const daysFromNextMonth =
        42 -
        daysFromPrevMonth -
        Object.keys(events[activeYear]["months"][activeMonth]["days"]).length;

    const handleDayClick = (event) => {
        setActiveDay(event.currentTarget.dataset.date);
        setShowDay(true);
    };

    const splitMonthDaysElementsByWeeks = (monthDaysElements) => {
        const weeks = [];

        for (let i = 0; i < monthDaysElements.length; i += 7) {
            weeks.push(monthDaysElements.slice(i, i + 7));
        }

        return weeks;
    };

    const getWeekElements = (days, index) => {
        return (
            <div
                className="week grid grid-cols-7 sm:h-16 md:h-16 lg:h-20 xl:h-20"
                key={index}
            >
                {getDayElements(days)}
            </div>
        );
    };

    const getDayElements = (days) => {
        return days.map((day, index) => {
            const isActiveMonthClasses =
                day.monthRelative === "current" ? "" : "text-gray-300";

            const eventClasses = day.data.events
                ? "rounded-full bg-blue-400 h-6 w-6 ml-2 text-white text-center"
                : "";

            return (
                <a
                    href="#"
                    key={day.date}
                    className={`day  flex ${day.monthRelative} ${isActiveMonthClasses}`}
                    title={day.date}
                    data-date={day.date}
                    onClick={handleDayClick}
                >
                    <span className="number sm:text-base md:text-xl lg:text-2xl">
                        {day.number}
                    </span>
                    <span className={`events ${eventClasses}`}>
                        {day?.data?.events
                            ? Object.keys(day.data.events).length
                            : ""}
                    </span>
                </a>
            );
        });
    };

    let prevMonthDays = [],
        currentMonthDays = [],
        nextMonthDays = [];

    Object.keys(events[prevMonthYear]["months"][prevMonth]["days"])
        .sort()
        .forEach((day, index, arr) => {
            if (index >= arr.length - daysFromPrevMonth) {
                prevMonthDays.push({
                    date: prevMonthYear + "-" + prevMonth + "-" + day,
                    number: index + 1,
                    data: events[prevMonthYear]["months"][prevMonth]["days"][
                        day
                    ],
                    monthRelative: "previous",
                });
            }
        });

    Object.keys(events[activeYear]["months"][activeMonth]["days"])
        .sort()
        .forEach((day, index) => {
            currentMonthDays.push({
                date: activeYear + "-" + activeMonth + "-" + day,
                number: index + 1,
                data: events[activeYear]["months"][activeMonth]["days"][day],
                monthRelative: "current",
            });
        });

    Object.keys(events[nextMonthYear]["months"][nextMonth]["days"])
        .sort()
        .forEach((day, index) => {
            if (parseInt(index) < daysFromNextMonth) {
                nextMonthDays.push({
                    date: day + "." + nextMonth + "." + nextMonthYear,
                    number: index + 1,
                    data: events[nextMonthYear]["months"][nextMonth]["days"][
                        day
                    ],
                    monthRelative: "next",
                });
            }
        });

    let days = prevMonthDays.concat(currentMonthDays).concat(nextMonthDays);
    let weeks = splitMonthDaysElementsByWeeks(days);

    return (
        <div className="days-grid">
            <h2 className="sm:text-2xl md:text-4xl lg:text-6xl xl:text-6xl sm:mb-2 md:mb-4 lg:mb-6">
                {utils.capitalizeFirstLetter(
                    monthsNamesList[parseInt(activeMonth)].regular
                )}{" "}
                {activeYear}
            </h2>
            <div className="title grid grid-cols-7 sm:text-base md:text-xl lg:text-2xl sm:mb-2 md:mb-4 lg:mb-6 text-bold">
                <span>
                    {utils.capitalizeFirstLetter(daysNamesShortList[1])}
                </span>
                <span>
                    {utils.capitalizeFirstLetter(daysNamesShortList[2])}
                </span>
                <span>
                    {utils.capitalizeFirstLetter(daysNamesShortList[3])}
                </span>
                <span>
                    {utils.capitalizeFirstLetter(daysNamesShortList[4])}
                </span>
                <span>
                    {utils.capitalizeFirstLetter(daysNamesShortList[5])}
                </span>
                <span>
                    {utils.capitalizeFirstLetter(daysNamesShortList[6])}
                </span>
                <span>
                    {utils.capitalizeFirstLetter(daysNamesShortList[7])}
                </span>
            </div>
            {weeks.map((week, index) => getWeekElements(week, index))}
        </div>
    );
};

export default MonthDays;

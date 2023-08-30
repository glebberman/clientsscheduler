import React from "react";

const MonthDays = ({ activeYear, activeMonth, events, weekFirstDay }) => {
    let prevMonth, prevMonthYear, nextMonth, nextMonthYear;

    if (activeMonth === "01") {
        prevMonth = "12";
        prevMonthYear = activeYear - 1;
    } else {
        prevMonth = (parseInt(activeMonth) - 1).toString().padStart(2, "0");
        prevMonthYear = activeYear;
    }

    if (activeMonth === "12") {
        nextMonth = "01";
        nextMonthYear = activeYear + 1;
    } else {
        nextMonth = (parseInt(activeMonth) + 1).toString().padStart(2, "0");
        nextMonthYear = activeYear;
    }

    const firstDayOfMonthDayOfWeekNumber =
        events[activeYear][activeMonth]["01"]["dayOfWeek"];

    const daysFromPrevMonth =
        firstDayOfMonthDayOfWeekNumber - (1 - weekFirstDay);

    const daysFromNextMonth =
        42 -
        daysFromPrevMonth -
        Object.keys(events[activeYear][activeMonth]).length;

    let prevMonthDays = [],
        currentMonthDays = [],
        nextMonthDays = [];

    Object.keys(events[prevMonthYear][prevMonth])
        .sort()
        .forEach((day, index, arr) => {
            if (index >= arr.length - daysFromPrevMonth) {
                prevMonthDays.push({
                    date: prevMonthYear + "-" + prevMonth + "-" + day,
                    number: index + 1,
                    data: events[prevMonthYear][prevMonth][day],
                    monthRelative: "previous",
                });
            }
        });

    Object.keys(events[activeYear][activeMonth])
        .sort()
        .forEach((day, index) => {
            currentMonthDays.push({
                date: activeYear + "-" + activeMonth + "-" + day,
                number: index + 1,
                data: events[activeYear][activeMonth][day],
                monthRelative: "current",
            });
        });

    Object.keys(events[nextMonthYear][nextMonth])
        .sort()
        .forEach((day, index) => {
            if (parseInt(index) < daysFromNextMonth) {
                nextMonthDays.push({
                    date: day + "." + nextMonth + "." + nextMonthYear,
                    number: index + 1,
                    data: events[nextMonthYear][nextMonth][day],
                    monthRelative: "next",
                });
            }
        });

    let days = prevMonthDays.concat(currentMonthDays).concat(nextMonthDays);
    let weeks = splitMonthDaysElementsByWeeks(days);

    return (
        <div className="days-grid">
            {weeks.map((week, index) => getWeekElements(week, index))}
        </div>
    );
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
            className="week grid grid-cols-7 sm:h-8 md:h-20 lg:h-32 xl:h-48"
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
        console.log(day);

        const eventClasses = day.data.events
            ? "rounded-full bg-blue-400 h-6 w-6 ml-2 text-white text-center"
            : "";

        return (
            <a
                href="#"
                key={day.date}
                className={`day  flex ${day.monthRelative} ${isActiveMonthClasses}`}
                title={day.date}
            >
                <span className="number sm:text-base md:text-xl lg:text-3xl">
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

export default MonthDays;

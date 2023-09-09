import React, { useState, useRef, useEffect } from "react";
import utils from "@/utils";
import Hour from "@/Components/Hour";

const Day = ({
    dayEvents,
    activeDay,
    settings,
    setActiveDay,
    monthsNamesList,
    dayName,
}) => {
    const rows = [];
    const dayDateArr = activeDay.split("-");
    const activeYear = dayDateArr[0];
    const activeMonthName = monthsNamesList[parseInt(dayDateArr[1])].declension;
    const activeDayNum = parseInt(dayDateArr[2]);
    const workingHours = [...settings.workingHours.matchAll(/\d+(?=\:)/g)];

    for (let i = parseInt(workingHours[0]); i <= workingHours[1]; i++) {
        const hourNum = i < 24 ? i : 0;

        rows.push(
            <div
                className="hour-row text-xs divide-y first:divide-y-0 relative"
                data-hour="i"
                key={"hour-" + i}
            >
                <span className="hour-num absolute px-2 sm:px-2 md:px-2 bottom-0">
                    {("0" + hourNum).slice(-2) + ":00"}
                </span>
                <Hour hourNumber={hourNum} />
            </div>
        );
    }

    return (
        <>
            <span className="date text-base sm:text-base md:text-xl lg:text-2xl">
                {utils.capitalizeFirstLetter(dayName)}, {activeDayNum}{" "}
                {activeMonthName} {activeYear}
            </span>
            <div className="day p-2 sm:p-2 md:p-2">{rows}</div>
        </>
    );
};

export default Day;

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React, { useState } from "react";
import { Head } from "@inertiajs/react";
import utils from "@/utils";
import EmployeesList from "@/Components/EmployeesList";
import MonthList from "@/Components/MonthList";
import MonthDays from "@/Components/MonthDays";
import Day from "@/Components/Day";
import HorizontalScroller from "@/Components/HorizontalScroller";

export default function Calendar({
    auth,
    translations,
    settings,
    weekFirstDay,
    defaultActiveYear,
    defaultActiveMonth,
    defaultActiveDay,
    monthsNamesList,
    daysNamesList,
    daysNamesShortList,
    events,
    employees,
    defaultEmployee,
}) {
    defaultActiveYear = parseInt(defaultActiveYear);
    const [activeYear, setActiveYear] = useState(defaultActiveYear);
    const [activeMonth, setActiveMonth] = useState(defaultActiveMonth);
    const [activeDay, setActiveDay] = useState(defaultActiveDay);
    const [showDay, setShowDay] = useState(true);

    const activeDayMonthNumber = activeDay.split("-")[2];

    let yearsEventsCount = {};
    Object.keys(events).forEach((year) => {
        yearsEventsCount[year] = {
            title: year,
            eventsCount: events[year].count,
        };
    });

    let monthsEventsCount = {};
    Object.keys(events[activeYear].months).forEach((month) => {
        monthsEventsCount[month] = {
            title: utils.capitalizeFirstLetter(
                monthsNamesList[parseInt(month)].regular
            ),
            eventsCount: events[activeYear].months[month].count,
        };
    });

    return (
        <AuthenticatedLayout
            user={auth.user}
            translations={translations}
            header={
                <>
                    <h2 className="inline-block font-semibold text-xl text-gray-800 leading-tight">
                        {utils.capitalizeFirstLetter(translations.schedule)}
                    </h2>
                    <EmployeesList
                        employees={employees}
                        defaultEmployee={defaultEmployee}
                    />
                </>
            }
        >
            <Head title={utils.capitalizeFirstLetter(translations.schedule)} />
            <HorizontalScroller
                id="years-scroller"
                dataToScroll={yearsEventsCount}
                activeItem={activeYear}
                setActiveItem={setActiveYear}
                setShowDay={setShowDay}
            />

            <HorizontalScroller
                id="months-scroller"
                dataToScroll={monthsEventsCount}
                activeItem={activeMonth}
                setActiveItem={setActiveMonth}
                setShowDay={setShowDay}
            />

            <div className="py-12 h-[calc(100vh-235px)] overflow-y-auto">
                <div
                    className={
                        "max-w-7xl mx-auto px-2  sm:px-6 lg:px-8 transition-all" +
                        (showDay ? " block" : " hidden")
                    }
                >
                    <div className="bg-white overflow-hidden sm:p-2 md:p-5 lg:p-10 shadow-sm sm:rounded-lg">
                        <Day
                            dayEvents={
                                events[activeYear]["months"][activeMonth][
                                    "days"
                                ][activeDayMonthNumber]
                            }
                            activeDay={activeDay}
                            settings={settings}
                            dayName={
                                daysNamesList[
                                    parseInt(
                                        events[activeYear]["months"][
                                            activeMonth
                                        ]["days"][activeDayMonthNumber][
                                            "dayOfWeek"
                                        ]
                                    )
                                ]
                            }
                            setActiveDay={setActiveDay}
                            setShowDay={setShowDay}
                            monthsNamesList={monthsNamesList}
                        />
                    </div>
                </div>
                <div
                    className={
                        "max-w-7xl mx-auto sm:px-6 lg:px-8 transition-all" +
                        (showDay ? " hidden" : " block")
                    }
                >
                    <div className="bg-white overflow-hidden sm:p-2 md:p-5 lg:p-10 shadow-sm sm:rounded-lg">
                        <MonthDays
                            activeYear={activeYear}
                            activeMonth={activeMonth}
                            events={events}
                            weekFirstDay={weekFirstDay}
                            daysNamesShortList={daysNamesShortList}
                            monthsNamesList={monthsNamesList}
                            setShowDay={setShowDay}
                            setActiveYear={setActiveYear}
                            setActiveMonth={setActiveMonth}
                            setActiveDay={setActiveDay}
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

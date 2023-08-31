import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React, { useState } from "react";
import { Head } from "@inertiajs/react";
import utils from "../utils";
import EmployeesList from "@/Components/EmployeesList";
import MonthDays from "@/Components/MonthDays";
import HorizontalScroller from "@/Components/HorizontalScroller";

export default function Calendar({
    auth,
    weekFirstDay,
    defaultActiveYear,
    defaultActiveMonth,
    yearsData,
    monthsNamesList,
    daysNamesList,
    daysNamesShortList,
    trans,
    events,
    employees,
    defaultEmployee,
}) {
    defaultActiveYear = parseInt(defaultActiveYear);
    const [activeYear, setActiveYear] = useState(defaultActiveYear);
    const [activeMonth, setActiveMonth] = useState(defaultActiveMonth);

    const handleSetActiveYear = (newYear) => {
        setActiveYear(parseInt(newYear));
    };
    console.log(daysNamesShortList);
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <>
                    <h2 className="inline-block font-semibold text-xl text-gray-800 leading-tight">
                        {utils.capitalizeFirstLetter(trans["calendar"])}
                    </h2>
                    <EmployeesList
                        employees={employees}
                        defaultEmployee={defaultEmployee}
                    />
                </>
            }
        >
            <Head title="Calendar" />
            <HorizontalScroller
                yearsData={yearsData}
                activeYear={activeYear}
                setActiveYear={handleSetActiveYear}
            />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden sm:p-2 md:p-5 lg:p-10 shadow-sm sm:rounded-lg">
                        <MonthDays
                            activeYear={activeYear}
                            activeMonth={activeMonth}
                            events={events}
                            weekFirstDay={weekFirstDay}
                            daysNamesShortList={daysNamesShortList}
                            monthsNamesList={monthsNamesList}
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

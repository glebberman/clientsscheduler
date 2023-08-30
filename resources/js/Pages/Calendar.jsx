import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React, { useState } from "react";
import { Head } from "@inertiajs/react";
import EmployeesList from "@/Components/EmployeesList";
import MonthDays from "@/Components/MonthDays";
import HorizontalScroller from "@/Components/HorizontalScroller";

export default function Calendar({
    auth,
    weekFirstDay,
    defaultActiveYear,
    defaultActiveMonth,
    yearsData,
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

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <>
                    <h2 className="inline-block font-semibold text-xl text-gray-800 leading-tight">
                        Calendar
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
                        <div className="title grid grid-cols-7 sm:text-base md:text-xl lg:text-4xl sm:mb-2 md:mb-5 lg:mb-10">
                            <span>Mon</span>
                            <span>Tue</span>
                            <span>Wen</span>
                            <span>Thu</span>
                            <span>Fri</span>
                            <span>Sat</span>
                            <span>Sun</span>
                        </div>
                        <MonthDays
                            activeYear={activeYear}
                            activeMonth={activeMonth}
                            events={events}
                            weekFirstDay={weekFirstDay}
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

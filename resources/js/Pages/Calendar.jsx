import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React, { useState } from "react";
import { Head } from "@inertiajs/react";
import MonthsList from "@/Components/MonthsList";
import HorizontalScroller from "@/Components/HorizontalScroller";

export default function Calendar({
    auth,
    currentMonth,
    yearsData,
    events,
    defaultActiveYear = null,
}) {
    const [activeYear, setActiveYear] = useState(parseInt(defaultActiveYear));
    console.log(events);
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Calendar
                </h2>
            }
        >
            <Head title="Calendar" />
            <HorizontalScroller
                yearsData={yearsData}
                activeYear={activeYear}
                setActiveYear={setActiveYear}
            />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <MonthsList
                            currentMonth={currentMonth}
                            yearsData={yearsData}
                            events={events}
                            activeYear={activeYear}
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

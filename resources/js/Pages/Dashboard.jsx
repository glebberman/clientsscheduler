import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React, { useState } from "react";
import { Head } from "@inertiajs/react";
import utils from "@/utils";

export default function Dashboard({ auth, translations }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            translations={translations}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {utils.capitalizeFirstLetter(translations.dashboard)}
                </h2>
            }
        >
            <Head title={utils.capitalizeFirstLetter(translations.dashboard)} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            You're logged in!
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

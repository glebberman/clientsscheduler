import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import React, { useState } from "react";
import { Head, router } from "@inertiajs/react";
import utils from "@/utils";
import TextInput from "@/Components/TextInput";
import Select from "@/Components/Select";

export default function Settings({
    auth,
    translations,
    translationList,
    storedSettings,
}) {
    const [settings, setSettings] = useState(storedSettings);

    function handleOnChange(event) {
        const { name, value } = event.target;
        settings[name] = value;
        router.patch(
            "/settings",
            { name, value },
            {
                onSuccess: (page) => {
                    setSettings({ ...page.props.storedSettings });
                },
            }
        );
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            translations={translations}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {utils.capitalizeFirstLetter(translations.settings)}
                </h2>
            }
        >
            <Head title={utils.capitalizeFirstLetter(translations.settings)} />

            <div className="py-12">
                <div className="max-w-2xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <Select
                                id="language"
                                type="text"
                                name="language"
                                value={settings.language}
                                selectedValue={settings.language}
                                label={utils.capitalizeFirstLetter(
                                    translations.language
                                )}
                                options={translationList}
                                className="mt-1 block w-full"
                                autoComplete="language"
                                isFocused={true}
                                onChange={(event) => handleOnChange(event)}
                            />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}

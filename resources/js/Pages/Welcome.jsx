import { Link, Head, router } from "@inertiajs/react";
import Login from "./Auth/Login";

export default function Welcome({ auth, userCount }) {
    if (!auth.user) {
        console.log(userCount);
        return (
            <>
                <div className="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                    <Login canResetPassword={true} canRegister={!userCount} />
                </div>
            </>
        );
    }

    return router.get("/register");
}

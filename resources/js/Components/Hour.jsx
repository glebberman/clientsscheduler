import React, { useState, useRef, useEffect } from "react";

const Hour = ({ hourNumber, startMinute = null, endMinute = null }) => {
    let ten_minutes = [];

    for (let i = 0; i < 60; i = i + 10) {
        ten_minutes.push(
            <div
                className="ten-minutes-row block h-1"
                data-ten_minutes={i}
                key={"ten-minutes-" + i}
            >
                <span className="ten-minutes"></span>
            </div>
        );
    }

    return <div className={`hour hour-${hourNumber} block`}>{ten_minutes}</div>;
};

export default Hour;

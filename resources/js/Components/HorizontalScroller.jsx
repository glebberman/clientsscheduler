import React, { useState, useRef, useEffect } from "react";

const HorizontalScroller = ({ yearsData, activeYear, setActiveYear }) => {
    const [scrollAmount, setScrollAmount] = useState(0);
    const [touchStarted, setTouchStarted] = useState(false);
    const [yearsOpacity, setYearsOpacity] = useState(0);
    const scrollContainerRef = useRef(null);
    const touchStartX = useRef(null);
    const itemWidth = 200;

    const handleTouchStart = (event) => {
        touchStartX.current = event.touches[0].clientX;
    };

    useEffect(() => {
        scrollTo(activeYear);
        showYears();
    });

    const scrollTo = (year) => {
        const nodes = Array.prototype.slice.call(
            document.querySelector(".years-container").children
        );
        const scrollItem = document.querySelector(
            `.years-container [data-year='${year}']`
        );
        const scrollItemIndex = nodes.indexOf(scrollItem) - 1;
        const offsetX = window.innerWidth / 2 - itemWidth * 1.5;

        setScrollAmount(scrollItemIndex * itemWidth - offsetX);
    };

    // const windowResizeHanler = () => {
    //     scrollTo(activeYear);
    // };

    // window.removeEventListener("resize", windowResizeHanler);
    // window.addEventListener("resize", windowResizeHanler);

    const handleTouchMove = (event) => {
        if (!touchStarted && touchStartX.current !== null) {
            const touchCurrentX = event.touches[0].clientX;
            const touchDeltaX = touchStartX.current - touchCurrentX;

            setScrollAmount((prevScrollAmount) => {
                if (touchDeltaX < 0) {
                    scrollLeft();
                } else {
                    scrollRight();
                }
            });

            touchStartX.current = touchCurrentX;
            setTouchStarted(true);
        }
    };

    const handleTouchEnd = () => {
        touchStartX.current = null;
        setTouchStarted(false);
    };

    const handleScroll = (direction) => {
        const scrollStep = itemWidth;
        const maxScroll = (Object.keys(yearsData).length - 1) * scrollStep;

        if (direction === "left" && scrollAmount > 0) {
            scrollLeft();
        } else if (direction === "right" && scrollAmount < maxScroll) {
            scrollRight();
        }
    };

    const handleMouseWheel = (event) => {
        const scrollStep = itemWidth;
        const maxScroll = (Object.keys(yearsData).length - 1) * scrollStep;
        if (event.deltaY < 0 && scrollAmount > 0) {
            scrollLeft();
        } else if (event.deltaY > 0 && scrollAmount < maxScroll) {
            scrollRight();
        }
    };

    const handleYearClick = (year) => {
        setActiveYear(year);
    };

    const showYears = () => {
        setYearsOpacity(1);
    };

    const hideYears = () => {
        setYearsOpacity(0);
    };

    const scrollLeft = () => {
        setActiveYear(activeYear - 1);
    };

    const scrollRight = () => {
        setActiveYear(activeYear + 1);
    };

    let scrollItems = [];
    for (let year in yearsData) {
        scrollItems.push({ year, count: yearsData[year] });
    }

    const opacityTransition =
        yearsOpacity === 0 ? "transition-opacity" : "transition";

    return (
        <div className="horizontal-scroller-container relative">
            <button
                className="px-4 py-2 z-20 border border-gray-300 rounded-l bg-gray-100 absolute top-0 left-0 focus:outline-none"
                onClick={() => handleScroll("left")}
            >
                &lt;
            </button>
            <div className="overflow-x-hidden flex items-center z-10">
                <div
                    className={`years-container flex ${opacityTransition}`}
                    style={{
                        opacity: yearsOpacity,
                        transform: `translateX(-${scrollAmount}px)`,
                    }}
                    onTouchStart={handleTouchStart}
                    onTouchMove={handleTouchMove}
                    onTouchEnd={handleTouchEnd}
                    onWheel={handleMouseWheel}
                    ref={scrollContainerRef}
                >
                    {scrollItems.map((itemData, index) => {
                        let countSpan = itemData.count ? (
                            <span className="count inline-block rounded-full bg-blue-400 h-6 w-6 ml-2 text-white text-center">
                                {itemData.count}
                            </span>
                        ) : (
                            ""
                        );

                        let active = itemData.year == activeYear;

                        return (
                            <a
                                href="#"
                                key={index}
                                onClick={() => handleYearClick(itemData.year)}
                                data-year={itemData.year}
                                style={{ width: itemWidth + "px" }}
                                className={
                                    "px-4 py-2 z-10 text-center" +
                                    (active ? " current" : "")
                                }
                            >
                                <span
                                    className={
                                        "year" + (active ? " font-bold" : "")
                                    }
                                >
                                    {itemData.year}
                                </span>
                                {countSpan}
                            </a>
                        );
                    })}
                </div>
            </div>
            <button
                className="px-4 py-2 border z-20 border-l-0 border-gray-300 rounded-r bg-gray-100 absolute top-0 right-0 focus:outline-none"
                onClick={() => handleScroll("right")}
            >
                &gt;
            </button>
        </div>
    );
};

export default HorizontalScroller;

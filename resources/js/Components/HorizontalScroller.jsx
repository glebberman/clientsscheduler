import React, { useState, useRef, useEffect } from "react";
import utils from "../utils";

const HorizontalScroller = ({
    id,
    dataToScroll,
    activeItem,
    setActiveItem,
    setShowDay,
}) => {
    const [scrollAmount, setScrollAmount] = useState(0);
    const [touchStarted, setTouchStarted] = useState(false);
    const [itemsOpacity, setItemsOpacity] = useState(0);
    const [translateX, setTranslateX] = useState(0);
    const scrollContainerRef = useRef(null);
    const touchStartX = useRef(null);
    const itemWidth = 200;

    const handleTouchStart = (event) => {
        touchStartX.current = event.touches[0].clientX;
    };

    useEffect(() => {
        scrollTo(activeItem);
        showScroller();
        correctTranslate();
    });

    const scrollTo = (item) => {
        const nodes = Array.prototype.slice.call(
            document.getElementById(id).children
        );
        const scrollItem = document.querySelector(
            `#${id} [data-item='${item}']`
        );
        const scrollItemIndex = nodes.indexOf(scrollItem);
        const offsetX = window.innerWidth / 2 - itemWidth * 1.5;

        setScrollAmount(scrollItemIndex * itemWidth - offsetX);
        // setShowDay(false);
    };

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

    const handleScroll = (event) => {
        event.preventDefault();
        event.stopPropagation();
    };

    const handleMouseWheel = (event) => {
        if (event.deltaY < 0) {
            scrollLeft();
        } else if (event.deltaY > 0) {
            scrollRight();
        }
    };

    const handleItemClick = (item) => {
        setActiveItem(item);
        setShowDay(false);
    };

    const showScroller = () => {
        setItemsOpacity(1);
    };

    const hideScroller = () => {
        setItemsOpacity(0);
    };

    const correctTranslate = () => {
        const itemIndex = Object.keys(dataToScroll)
            .sort((a, b) => parseInt(a) - parseInt(b))
            .indexOf("" + activeItem);

        if (window.innerWidth < Object.keys(dataToScroll).length * itemWidth) {
            const stickingOut = Math.floor(
                (Object.keys(dataToScroll).length * itemWidth -
                    window.innerWidth) /
                    itemWidth /
                    2
            );
            console.log(
                Object.keys(dataToScroll).sort((a, b) => {
                    return parseInt(a) > parseInt(b);
                })
            );

            const itemsWidthsPerWindow = Math.floor(
                window.innerWidth / itemWidth
            );

            if (itemIndex <= stickingOut) {
                setTranslateX((stickingOut + 1 - itemIndex) * itemWidth);
            } else if (itemIndex > itemsWidthsPerWindow) {
                setTranslateX(
                    (itemsWidthsPerWindow + stickingOut - 1 - itemIndex) *
                        itemWidth
                );
            }
        }
    };

    const scrollLeft = () => {
        var activeItemIndex = Object.keys(dataToScroll).indexOf(
            "" + activeItem
        );

        var previousItem =
            Object.keys(dataToScroll)[activeItemIndex - 1] ??
            Object.keys(dataToScroll).slice(-1);

        setActiveItem(previousItem);
        setShowDay(false);
    };

    const scrollRight = () => {
        var activeItemIndex = Object.keys(dataToScroll).indexOf(
            "" + activeItem
        );

        var nextItem =
            Object.keys(dataToScroll)[activeItemIndex + 1] ??
            Object.keys(dataToScroll)[0];

        setActiveItem(nextItem);
        setShowDay(false);
    };

    let scrollItems = [];
    for (let scrollItemName in dataToScroll) {
        scrollItems.push({
            number: scrollItemName,
            item: dataToScroll[scrollItemName].title,
            count: dataToScroll[scrollItemName].eventsCount,
        });
    }

    scrollItems.sort((a, b) => {
        return parseInt(a.number) - parseInt(b.number);
    });

    const opacityTransition =
        itemsOpacity === 0 ? "transition-opacity" : "transition";

    const itemsElements = scrollItems.map((itemData, index) => {
        let countSpan = itemData.count ? (
            <span
                className="count absolute inline-block text-sm 
                            -mx-1 sm:-mx-1 md:-mx-2 lg:-mx-2 
                            -my-1 sm:-my-1 md:-my-2 lg:-my-2 
                            sm:text-sm md:text-base lg:text-base 
                            text-blue-400 h-6 w-6 ml-2 text-white text-center"
            >
                {itemData.count}
            </span>
        ) : (
            ""
        );

        let active = itemData.number == activeItem;

        return (
            <a
                href="#"
                key={index}
                onClick={() => handleItemClick(itemData.number)}
                data-item={itemData.number}
                style={{ width: itemWidth + "px" }}
                className={
                    "px-4 py-2 z-10 text-center" + (active ? " current" : "")
                }
            >
                <span className={"scroll-item" + (active ? " font-bold" : "")}>
                    {itemData.item}
                </span>
                {countSpan}
            </a>
        );
    });

    return (
        <div className="horizontal-scroller-container relative">
            <button
                className="px-4 py-2 z-20 text-blue-400 hover:text-blue-300 rounded-l bg-gray-200 absolute top-0 left-0 focus:outline-none"
                onClick={scrollLeft}
            >
                &lt;
            </button>
            <div className="overflow-x-hidden flex items-center z-10 justify-center">
                <div
                    id={id}
                    className={`items-container flex ${opacityTransition}`}
                    style={{
                        opacity: itemsOpacity,
                        transform: `translateX(${translateX}px)`,
                    }}
                    onTouchStart={handleTouchStart}
                    onTouchMove={handleTouchMove}
                    onTouchEnd={handleTouchEnd}
                    onWheel={handleMouseWheel}
                    onScroll={handleScroll}
                    ref={scrollContainerRef}
                >
                    {itemsElements}
                </div>
            </div>
            <button
                className="px-4 py-2 z-20 text-blue-400 hover:text-blue-300 rounded-r bg-gray-200 absolute top-0 right-0 focus:outline-none"
                onClick={scrollRight}
            >
                &gt;
            </button>
        </div>
    );
};

export default HorizontalScroller;

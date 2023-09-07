import utils from "../utils";

const MonthList = ({
    events,
    monthsNamesList,
    setActiveMonth,
    activeMonth = null,
}) => {
    // console.log(events);
    const monthList = Object.keys(monthsNamesList).map((monthNumber) => {
        const monthName = utils.capitalizeFirstLetter(
            monthsNamesList[monthNumber]
        );
        const isActive = parseInt(monthNumber) === parseInt(activeMonth);

        return (
            <a
                href={`#month-${monthNumber}`}
                className={`month inline-block bg-blue-200 sm:rounded md:rounded lg:rounded hover:bg-blue-300 m-1 sm:m-2 md:m-4 lg:m-4 p-1 sm:p-2 md:p-4 lg:p-4${
                    isActive ? " active text-bold" : ""
                }`}
                key={monthNumber}
                onClick={(event) => {
                    event.preventDefault();
                    event.stopPropagation();
                    if (isActive) return;
                    setActiveMonth(monthNumber);
                }}
            >
                {monthName}
            </a>
        );
    });

    // return <>{monthList}</>;
    return (
        <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div className="bg-white overflow-hidden sm:p-2 md:p-5 lg:p-10 shadow-sm sm:rounded-lg">
                    {monthList}
                </div>
            </div>
        </div>
    );
};

export default MonthList;

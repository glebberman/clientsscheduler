export default function YearList({ years, activeYear = null }) {
    const currentYear = new Date().getFullYear();
    let currentClass;

    let yearsList = Object.keys(years).map((year) => {
        if (activeYear) {
            currentClass = activeYear == year ? "selected" : "";
        } else {
            currentClass = currentYear == year ? "selected" : "";
        }

        return (
            <option
                href="#year-events"
                className="year-events"
                key={year}
                selected={currentClass}
            >
                <span className="year">{year}</span> -
                <span className="events-count">{years[year]}</span>
            </option>
        );
    });

    return <select className="years">{yearsList}</select>;
}

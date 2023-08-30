const EmployeesList = ({ employees, defaultEmployee }) => {
    let value = "";

    employees = employees.map((employee) => {
        const firstName = employee.first_name ?? "";
        const secondName = employee.second_name
            ? " " + employee.second_name
            : "";
        const lastName = employee.last_name ? " " + employee.last_name : "";
        const fullName = firstName + secondName + lastName;

        if (defaultEmployee.id === employee.id) {
            value = fullName;
        }

        return (
            <option
                value={fullName}
                key={employee.id}
                data-id={employee.id}
                readOnly={true}
            />
        );
    });

    return (
        <div className="employees inline-block ml-2 w-1/2">
            <input
                list="employees"
                placeholder="Employee"
                value={value}
                className="w-full"
                readOnly={true}
            />
            <datalist id="employees">{employees}</datalist>
        </div>
    );
};

export default EmployeesList;

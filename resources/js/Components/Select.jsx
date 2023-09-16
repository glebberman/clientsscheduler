import { forwardRef, useEffect, useRef } from "react";

export default forwardRef(function Select(
    {
        label,
        className = "",
        isFocused = false,
        selectedValue = null,
        options = {},
        ...props
    },
    ref
) {
    const input = ref ? ref : useRef();
    let optionsElements = "";
    console.log(props);
    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    let id = props.id ?? Math.random().toString(16);

    if (Object.keys(options).length) {
        optionsElements = (
            <>
                {Object.keys(options).map((value, index) => {
                    return (
                        <option key={`option-${id}-${index}`}>
                            {options[value]}
                        </option>
                    );
                })}
            </>
        );
    }

    return (
        <label className="grid grid-flow-col items-center">
            {label && <span>{label}</span>}
            <select
                {...props}
                className={
                    "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm " +
                    className
                }
                ref={input}
            >
                {optionsElements}
            </select>
        </label>
    );
});

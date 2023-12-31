import { forwardRef, useEffect, useRef } from "react";

export default forwardRef(function TextInput(
    {
        type = "text",
        className = "",
        isFocused = false,
        datalist = {},
        ...props
    },
    ref
) {
    const input = ref ? ref : useRef();
    let datalistElement = "";

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    let id = props.id ?? Math.random().toString(16);
    console.log(datalist);
    if (Object.keys(datalist).length) {
        props.list = `datalist-${id}`;

        datalistElement = (
            <datalist id={props.list}>
                {Object.keys(datalist).map((value, index) => {
                    return (
                        <option
                            key={`datalist-${id}-${index}`}
                            value={datalist[value]}
                        >
                            {datalist[value]}
                        </option>
                    );
                })}
            </datalist>
        );
    }

    return (
        <>
            <input
                {...props}
                type={type}
                className={
                    "border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm " +
                    className
                }
                ref={input}
            />
            {datalistElement}
        </>
    );
});

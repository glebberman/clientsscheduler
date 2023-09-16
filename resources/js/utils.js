const utils = {
    capitalizeFirstLetter(string) {
        if (!string) {
            return "";
        }

        return string.charAt(0).toUpperCase() + string.slice(1);
    },

    objectFlip(obj) {
        const ret = {};
        Object.keys(obj).forEach((key) => {
            ret[obj[key]] = key;
        });
        return ret;
    },
};

export default utils;

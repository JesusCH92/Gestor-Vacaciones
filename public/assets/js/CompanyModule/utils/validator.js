var validator = ( function () {
    var isBlankInput = function ({ input }) {
        return input === "";
    };

    var isInputLengthGreaterThanTen = function ({ input }) {
        return input.length > 10;
    };

    return {
        isBlankInput : isBlankInput,
        isInputLengthGreaterThanTen : isInputLengthGreaterThanTen
    }
});
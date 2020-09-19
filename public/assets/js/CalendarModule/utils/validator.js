var validator = ( function () {
    var isValidDate = function ($dateString) {
        var $date = new Date($dateString);
        return $date instanceof Date && !isNaN($date) && ($date >= new Date('2019-01-01'));
    };

    var endDateIsGreaterThanInitDate = function ($initDateString, $endDateString) {
        var $initDate = new Date($initDateString);
        var $endDate = new Date($endDateString);
        return $initDate < $endDate;
    };

    var isIntegerPositive = function ($number) {
        return 0 > ($number * 1)// * Convert string number to number;
    };

    return {
        isValidDate : isValidDate,
        endDateIsGreaterThanInitDate : endDateIsGreaterThanInitDate,
        isIntegerPositive : isIntegerPositive
    }
});
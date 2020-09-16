<?php

declare(strict_types=1);

namespace App\DayOffForm\ApplicationService;

use App\DayOffForm\ApplicationService\DTO\DatesOfCalendarResponse;
use DateInterval;
use DatePeriod;
use DateTimeImmutable;

final class GetDatesOfCalendar
{

    public function __invoke(DateTimeImmutable $init_date, DateTimeImmutable $end_date, array $feastdays): array
    {
        $year = $init_date->format('Y');
        $month = $init_date->format('m');
        $monthArray = [
            'year' => $year,
            'month' => $month,
            'week' => []
        ];

        $datePeriod = $this->daysInBetween($init_date, $end_date);
        $yearArray = $this->saveMonthsInArray($datePeriod, $feastdays, $month, $monthArray);

        $calendarDatesResponse = [];

        foreach ($yearArray as $monthCalendar) {
            array_push($calendarDatesResponse, new DatesOfCalendarResponse(
                $monthCalendar['year'],
                $monthCalendar['month'],
                $monthCalendar['week']
            ));
        }
        return $calendarDatesResponse;
    }

    public function daysInBetween($init_date, $end_date)
    {
        return new DatePeriod(
            $init_date,
            new DateInterval('P1D'),
            $end_date->modify('+1 day')
        );
    }

    public function saveMonthsInArray($datePeriod, $feastdays, $month, $monthArray)
    {
        $yearArray = [];
        $datesArray = [];
        foreach ($datePeriod as $date) {
            if ($this->checkDiferentMonth($date, $month)) {
                array_push($yearArray, $monthArray);

                $year = $date->format('Y');
                $month = $date->format('m');

                $monthArray = [
                    'year' => $year,
                    'month' => $month,
                    'week' => []
                ];

                $datesArray = [];
            }

            $dayArray = $this->saveWeeksInArray($feastdays, $date);
            array_push($datesArray, $dayArray);
            $monthArray['week'] = $datesArray;

        }
        array_push($yearArray, $monthArray);
        return $yearArray;
    }

    public function checkDiferentMonth(DateTimeImmutable $date, string $month)
    {
        if ($date->format('m') != $month) {
            return true;
        }
        return false;
    }

    public function saveWeeksInArray(array $feastdays, DateTimeImmutable $date)
    {

        $isFeastday = $this->isFeastDay($feastdays, $date);
        $dayOfWeek = date("w", strtotime($date->format('Y-m-d')));

        $dayArray = [
            'date' => $date->format('Y-m-d'),
            'day' => $dayOfWeek,
            'feastday' => $isFeastday
        ];
        return $dayArray;
    }

    public function isFeastDay(array $feastdays, DateTimeImmutable $date)
    {
        $isFeastday = false;

        foreach ($feastdays as $feastday) {
            if ($date->format('Y-m-d') == $feastday) {
                $isFeastday = true;
            }
        }
        return $isFeastday;
    }
}
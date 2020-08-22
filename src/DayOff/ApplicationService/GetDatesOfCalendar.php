<?php

declare(strict_types = 1);

namespace App\DayOff\ApplicationService;

use App\DayOff\ApplicationService\DTO\DatesOfCalendarResponse;
use DatePeriod;
use DateTimeImmutable;

final class GetDatesOfCalendar
{
    private $yearArray = [];
    private $monthArray;
    private $datesArray = [];
    private $month;

    public function __construct()
    {
    }

    public function __invoke(DateTimeImmutable $init_date, DateTimeImmutable $end_date, array $feastdays): array
    {
        $year = $init_date->format('Y');
        $this->month = $init_date->format('m');
        $this->monthArray = [
            'year' => $year,
            'month' => $this->month,
            'week' => []
        ];

        $datePeriod = $this->daysInBetween($init_date, $end_date);
        $this->saveInArrayPeriodOfTime($datePeriod,$feastdays);

        $calendarDatesResponse = [];
        // $calendarDatesFormat = new DatesOfCalendarResponse(

        // )
        foreach ($this->yearArray as $monthCalendar) {
            array_push($calendarDatesResponse, new DatesOfCalendarResponse(
                $monthCalendar['year'],
                $monthCalendar['month'],
                $monthCalendar['week']
            ));
        }
        return $calendarDatesResponse;
    }

    public function daysInBetween($init_date, $end_date): DatePeriod
    {
        return new \DatePeriod(
            $init_date,
            new \DateInterval('P1D'),
            $end_date->modify('+1 day')
        );
    }

    public function checkMonth(DateTimeImmutable $date)
    {
        if ($date->format('m') != $this->month) {
            array_push($this->yearArray, $this->monthArray);

            $year = $date->format('Y');
            $this->month = $date->format('m');

            $this->monthArray = [
                'year' => $year,
                'month' => $this->month,
                'week' => []
            ];

            $this->datesArray = [];
        }
    }

    public function saveInArrayPeriodOfTime($datePeriod,$feastdays)
    {
        foreach ($datePeriod as $date) {
            $this->checkMonth($date);

            $isFeastday = false;

            foreach ($feastdays as $feastday) {
                // dump($date->format('Y-m-d'));
                // dump($feastday['date']);exit;
                if ($date->format('Y-m-d') === $feastday) {
                    $isFeastday = true;
                }
            }
            // if (in_array($date->format('Y-m-d'), $feastdays)) {
            //     $isFeastday = true;
            // }

            $dayOfWeek = date("w", strtotime($date->format('Y-m-d')));

            $dayArray = [
                'date' => $date->format('Y-m-d'),
                'day' => $dayOfWeek,
                'feastday' => $isFeastday
            ];

            array_push($this->datesArray, $dayArray);
            $this->monthArray['week'] = $this->datesArray;

        }
        array_push($this->yearArray, $this->monthArray);
    }
}
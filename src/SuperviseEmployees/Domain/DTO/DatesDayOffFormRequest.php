<?php


namespace App\SuperviseEmployees\Domain\DTO;


class DatesDayOffFormRequest
{
    private  $dayOffForm;

    public function __construct($dayOffForm)
    {
        $this->dayOffForm = $dayOffForm;
    }

    public function dayOffForm()
    {
        return $this->dayOffForm;
    }
}
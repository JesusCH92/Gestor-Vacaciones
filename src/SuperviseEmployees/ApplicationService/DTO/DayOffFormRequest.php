<?php


namespace App\SuperviseEmployees\ApplicationService\DTO;


final class DayOffFormRequest
{
    private string $dayOffFormId;

    public function __construct(string $dayOffFormId)
    {
        $this->dayOffFormId = $dayOffFormId;
    }

    public function dayOffFormId(): string
    {
        return $this->dayOffFormId;
    }

}
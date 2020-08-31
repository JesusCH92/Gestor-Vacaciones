<?php


namespace App\DayOffForm\ApplicationService\DTO;


final class ApproveDayOffFormRequest
{
    private string $dayOffFormId;
    private string $supervisorId;
    private string $comment;

    public function __construct(string $dayOffFormId, string $supervisorId, string $comment)
    {
        $this->dayOffFormId = $dayOffFormId;
        $this->supervisorId = $supervisorId;
        $this->comment = $comment;
    }

    public function dayOffFormId(): string
    {
        return $this->dayOffFormId;
    }

    public function supervisorId(): string
    {
        return $this->supervisorId;
    }

    public function comment(): string
    {
        return $this->comment;
    }
}
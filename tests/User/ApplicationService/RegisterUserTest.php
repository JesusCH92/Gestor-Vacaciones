<?php


namespace App\Tests\Calendar\User\ApplicationService;


use App\Entity\Company;
use App\Entity\Department;
use App\Tests\User\Infrastructure\OrmUserFactoryDummy;
use App\Tests\User\Infrastructure\OrmUserRepositoryInvalidStub;
use App\Tests\User\Infrastructure\OrmUserRepositoryStub;
use App\User\ApplicationService\DTO\RegisterUserRequest;
use App\User\ApplicationService\Exception\AlreadyExistingUserException;
use App\User\ApplicationService\RegisterUser;
use App\User\Domain\Exception\InvalidRoleException;
use PHPUnit\Framework\TestCase;

class RegisterUserTest extends TestCase
{

    /**
     * @test
     */
    public function throwExceptionIfUserEmailAlreadyExists()
    {
        $this->expectException(AlreadyExistingUserException::class);

        $company = new Company();
        $registerUserRequest = new RegisterUserRequest('miriam','lopez','663786798','miriam@gmail.com','password',new Department('TFM','t', $company),$company,'ROLE_USER');

        $ormUserFactoryDummy = new OrmUserFactoryDummy();
        $ormUserRepositoryStub = new OrmUserRepositoryInvalidStub();

        $registerUser = new RegisterUser($ormUserFactoryDummy,$ormUserRepositoryStub);
        $registerUser->__invoke($registerUserRequest);

    }

    /**
     * @test
     */
    public function throwExceptionIfUserRoleIsNotUserOrSupervisor()
    {
        $this->expectException(InvalidRoleException::class);
        $company = new Company();
        $registerUserRequest = new RegisterUserRequest('miriam','lopez','663786798','miriam@gmail.com','password',new Department('TFM','t', $company),$company,'ROLE_EMPLOYEE');

        $ormUserFactoryDummy = new OrmUserFactoryDummy();
        $ormUserRepositoryStub = new OrmUserRepositoryStub();

        $registerUser = new RegisterUser($ormUserFactoryDummy,$ormUserRepositoryStub);
        $registerUser->__invoke($registerUserRequest);
    }
}
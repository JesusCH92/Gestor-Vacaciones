<?php


namespace App\DayOffForm\Infrastructure;


use App\DayOffForm\Domain\DTO\UsersInDayOffFormFilteredRequest;
use App\DayOffForm\Domain\UsersInDayOffFormRepository;
use App\DayOffForm\Domain\ValueObject\StatusDayOffForm;
use App\Entity\Calendar;
use App\TypeDayOff\Domain\Constants\DayOff;
use Doctrine\ORM\EntityManagerInterface;

class OrmUsersInDayOffFormRepository implements UsersInDayOffFormRepository
{
    public const USERSINDAYOFFFORMBYNAMEINDEPARTMENT = 'usersInDayOffFormByNameInDepartment';
    public const USERSINDAYOFFFORMINDEPARTMENT = 'usersInDayOffFormByNameInDepartment';
    public const USERSINDAYOFFFORMBYNAME = 'usersInDayOffFormByName';
    public const USERSINDAYOFFFORM = 'usersInDayOffFormByName';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function filterUserInDayOff(UsersInDayOffFormFilteredRequest $usersInDayOffFormFilteredRequest): array
    {
        $filtereDayOffFormType = $usersInDayOffFormFilteredRequest->filtereDayOffFormType();
        $calendar = $usersInDayOffFormFilteredRequest->calendar();
        $userName = $usersInDayOffFormFilteredRequest->userName();
        $departmentId = $usersInDayOffFormFilteredRequest->departmentId();

        $userInDayOffFilteredCollection = $this->$filtereDayOffFormType($calendar, $userName, $departmentId);

        return $userInDayOffFilteredCollection;
    }

    private function usersInDayOffFormByNameInDepartment(Calendar $calendar, string $userName, int $departmentId)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb
            ->select('u.userId', 'u.email', 'u.name', 'u.lastname', 'dof.codeDayOffForm',
                'dor.dayOffSelected.dayOffSelected')
            ->from('App\User\Infrastructure\Model\SymfonyUser', 'u')
            ->leftJoin(
                'App\Entity\DayOffForm',
                'dof',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'u.userId = dof.user'
            )
            ->leftJoin('App\Entity\DayOffFormRequest',
                'dor',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'dof = dor.dayOffForm'
            )
            ->where('
            u.name like :userName
            and u.department = :departmentId
            and dof.calendar = :calendar 
            and dof.typeDayOff = :typeDayOff and dof.statusDayOffForm.statusDayOffForm = :statusDayOffForm
            ')
            ->setParameter('calendar', $calendar)
            ->setParameter('typeDayOff', DayOff::HOLIDAY)
            ->setParameter('statusDayOffForm', StatusDayOffForm::APPROVED)
            ->setParameter('userName', "%$userName%")
            ->setParameter('departmentId', $departmentId);
        return $qb->getQuery()->getResult();
    }

    private function usersInDayOffFormByName(Calendar $calendar, string $userName, int $departmentId)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb
            ->select('u.userId', 'u.email', 'u.name', 'u.lastname', 'dof.codeDayOffForm',
                'dor.dayOffSelected.dayOffSelected')
            ->from('App\User\Infrastructure\Model\SymfonyUser', 'u')
            ->leftJoin(
                'App\Entity\DayOffForm',
                'dof',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'u.userId = dof.user'
            )
            ->leftJoin('App\Entity\DayOffFormRequest',
                'dor',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'dof = dor.dayOffForm'
            )
            ->where('
            u.name like :userName
            and dof.calendar = :calendar 
            and dof.typeDayOff = :typeDayOff and dof.statusDayOffForm.statusDayOffForm = :statusDayOffForm
            ')
            ->setParameter('calendar', $calendar)
            ->setParameter('typeDayOff', DayOff::HOLIDAY)
            ->setParameter('statusDayOffForm', StatusDayOffForm::APPROVED)
            ->setParameter('userName', "%$userName%");
        return $qb->getQuery()->getResult();
    }


    public function findDayOffFormRequestByCalendarUserId(Calendar $calendar, string $userId): array
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb
            ->select('u.userId', 'u.email', 'u.name', 'u.lastname', 'dof.codeDayOffForm',
                'dor.dayOffSelected.dayOffSelected')
            ->from('App\User\Infrastructure\Model\SymfonyUser', 'u')
            ->leftJoin(
                'App\Entity\DayOffForm',
                'dof',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'u.userId = dof.user'
            )
            ->leftJoin('App\Entity\DayOffFormRequest',
                'dor',
                \Doctrine\ORM\Query\Expr\Join::WITH,
                'dof = dor.dayOffForm'
            )
            ->where('
            u.userId = :userId
            and dof.calendar = :calendar 
            and dof.typeDayOff = :typeDayOff and dof.statusDayOffForm.statusDayOffForm = :statusDayOffForm
            ')
            ->setParameter('calendar', $calendar)
            ->setParameter('typeDayOff', DayOff::HOLIDAY)
            ->setParameter('statusDayOffForm', StatusDayOffForm::APPROVED)
            ->setParameter('userId', $userId);
        return $qb->getQuery()->getResult();
    }
}
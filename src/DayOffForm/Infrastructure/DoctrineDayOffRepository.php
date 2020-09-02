<?php


namespace App\DayOffForm\Infrastructure;


use App\DayOffForm\Domain\DayOffRepository;
use App\DayOffForm\Domain\ValueObject\StatusDayOffForm;
use App\Entity\Calendar;
use App\Entity\DayOffForm;
use App\Entity\DayOffFormRequest;
use App\TypeDayOff\Domain\Constants\DayOff;
use App\User\Domain\User;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineDayOffRepository implements DayOffRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findOne(User $user)
    {
        $dayOffRepository = $this->entityManager->getRepository(DayOffForm::class);
        return $dayOffRepository->findBy(['idUser' => $user]);
    }

    public function findByUserAndStatusDayOffForm(User $user, Calendar $calendar, string $typeDayOffForm): array
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
SELECT d.countDayOffRequest.countDayOffRequest
FROM App\Entity\DayOffForm d
WHERE d.user = :user AND d.calendar = :calendar AND d.typeDayOff = :type AND (d.statusDayOffForm.statusDayOffForm = :approved OR d.statusDayOffForm.statusDayOffForm = :pending )
DQL
            )->setParameters(
                [
                    'user' => $user,
                    'calendar' => $calendar,
                    'type' => $typeDayOffForm,
                    'approved' => StatusDayOffForm::APPROVED,
                    'pending' => StatusDayOffForm::PENDING
                ]
            );
        return $query->getResult();
    }

    public function saveDayOffForm(DayOffForm $dayOffForm, array $dayOffFormRequestCollection): void
    {
        $this->entityManager->persist($dayOffForm);
        $this->entityManager->flush();

        $this->saveDayOffFormRequest($dayOffFormRequestCollection);

    }

    public function saveDayOffFormRequest(array $dayOffFormRequestCollection): void
    {
        foreach ($dayOffFormRequestCollection as $dayOffFormRequest) {
            $this->entityManager->persist($dayOffFormRequest);
            $this->entityManager->flush();
        }
    }

    public function approveDayOffForm(string $dayOffFormId, string $observation, string $supervisorId)
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
UPDATE App\Entity\DayOffForm d
SET d.statusDayOffForm.statusDayOffForm = :status, d.observation = :observation, d.supervisorId = :supervisor
WHERE d.codeDayOffForm = :code
DQL
            )->setParameters(
                [
                    'status' => StatusDayOffForm::APPROVED,
                    'observation' => $observation,
                    'supervisor' => $supervisorId,
                    'code' => $dayOffFormId
                ]
            );
        $query->execute();
    }

    public function denyDayOffForm(string $dayOffFormId, string $observation, string $supervisorId)
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
UPDATE App\Entity\DayOffForm d
SET d.statusDayOffForm.statusDayOffForm = :status, d.observation = :observation, d.supervisorId = :supervisor
WHERE d.codeDayOffForm = :code
DQL
            )->setParameters(
                [
                    'status' => StatusDayOffForm::DENIED,
                    'observation' => $observation,
                    'supervisor' => $supervisorId,
                    'code' => $dayOffFormId
                ]
            );
        $query->execute();
    }

    public function findDaysOffRequest(array $dayOffFormCollection): array
    {
        $dayOffFormRequestCollection = [];
        $dayOffRepository = $this->entityManager->getRepository(DayOffFormRequest::class);
        foreach ($dayOffFormCollection as $dayOffForm) {
            $dayOffFormRequest = $dayOffRepository->findBy(['dayOffForm' => $dayOffForm]);
            $datesArray = [];
            foreach ($dayOffFormRequest as $dates) {
                array_push($datesArray, $dates->dayOffSelected());
            }
            $dayOffArray = [
                'dayOffId' => $dayOffForm->codeDayOffForm(),
                'dates' => $datesArray
            ];
            array_push($dayOffFormRequestCollection, $dayOffArray);
        }
        return $dayOffFormRequestCollection;
    }

    public function findByCalendar(Calendar $calendar): array
    {
        $query = $this
            ->entityManager
            ->createQuery(
                <<<DQL
SELECT d
FROM App\Entity\DayOffForm d
WHERE d.calendar = :calendar AND d.typeDayOff = :type AND (d.statusDayOffForm.statusDayOffForm = :approved)
DQL
            )->setParameters(
                [
                    'calendar' => $calendar,
                    'type' => DayOff::HOLIDAY,
                    'approved' => StatusDayOffForm::APPROVED
                ]
            );
        $dayOffCollection = $query->getResult();
        return $this->findDaysOffRequest($dayOffCollection);

    }

    public function findByDepartmentAndUsername(Calendar $calendar, string $userName, int $departmentId)
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb
            ->select('u.userId','u.name','u.lastname', 'dof.codeDayOffForm', 'dor.dayOffSelected.dayOffSelected')
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
}
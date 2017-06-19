<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: mamadou
 * Date: 30/05/17
 * Time: 11:43
 */
namespace AW\LeaveRequestBundle\Service;

use AW\LeaveRequestBundle\Entity\LeaveRequest;
use AW\LeaveRequestBundle\Event\LeaveRequestEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class LeaveRequestService
 * @package AW\LeaveRequestBundle\Service
 */
class LeaveRequestService
{
    /**
     * Entity Manager
     *
     * @var em
     */
    private $em;

    /**
     * EventDispatcher
     *
     * @var eventDispatcher
     */
    private $eventDispatcher;

    public function __construct(EntityManager $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $newLeaveRequest
     * @return int
     */
    public function create(array $newLeaveRequest){

        $leaveRequest = new LeaveRequest();
        $leaveRequest->setCivility($newLeaveRequest['civility']);
        $leaveRequest->setFirstName($newLeaveRequest['firstName']);
        $leaveRequest->setLastName($newLeaveRequest['lastName']);
        $leaveRequest->setCreatedAt(new \Datetime($newLeaveRequest['createdAt']));
        $leaveRequest->setValidatedAt(new \Datetime($newLeaveRequest['validatedAt']));

        $this->em->persist($leaveRequest);
        $this->em->flush();

        $this->eventDispatcher->dispatch(LeaveRequestEvent::CREATE, new LeaveRequestEvent($leaveRequest));

        return $leaveRequest->getId();
    }

}

<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: mamadou
 * Date: 30/05/17
 * Time: 12:08
 */
namespace AW\LeaveRequestBundle\EventListener;

use AW\LeaveRequestBundle\Event\LeaveRequestEvent;
use AW\LeaveRequestBundle\Producer\LeaveRequestCreateProducer;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * Class LeaveRequestListener
 * @package AW\LeaveRequestBundle\EventListener
 */
class LeaveRequestListener
{
    /**
     * @var LeaveRequestCreateProducer
     */
    private $leaveRequestCreateProducer;

    /**
     * LeaveRequestListener constructor.
     * @param LeaveRequestCreateProducer $leaveRequestCreateProducer
     */
    public function __construct(
        LeaveRequestCreateProducer $leaveRequestCreateProducer
    )
    {
        $this->leaveRequestCreateProducer = $leaveRequestCreateProducer;
    }

    /**
     * @param LeaveRequestEvent $leaveRequestEvent
     */
    public function onLeaveRequestCreate(LeaveRequestEvent $leaveRequestEvent)
    {
        $this->leaveRequestCreateProducer->create($leaveRequestEvent->getLeaveRequest());

        $leaveRequestEvent->stopPropagation();
    }
}

<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: mamadou
 * Date: 30/05/17
 * Time: 12:08
 */
namespace AW\LeaveRequestBundle\Event;

use AW\LeaveRequestBundle\Entity\LeaveRequest;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class LeaveRequestEvent
 * @package AW\LeaveRequestBundle\Event
 */
class LeaveRequestEvent extends Event
{
    const CREATE = 'aw_leave_request.event.leaveRequest_create';

    /**
     * @var LeaveRequest
     */
    private $leaveRequest;

    /**
     * LeaveRequestEvent constructor.
     * @param LeaveRequest $leaveRequest
     */
    public function __construct(LeaveRequest $leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    /**
     * @return LeaveRequest
     */
    public function getLeaveRequest()
    {
        return $this->leaveRequest;
    }
}

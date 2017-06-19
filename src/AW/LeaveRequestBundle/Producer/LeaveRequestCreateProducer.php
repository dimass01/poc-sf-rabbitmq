<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: mamadou
 * Date: 30/05/17
 * Time: 12:33
 */
namespace AW\LeaveRequestBundle\Producer;

use AW\LeaveRequestBundle\Entity\LeaveRequest;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class LeaveRequestCreateProducer
{
    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * LeaveRequestCreateProducer constructor.
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param LeaveRequest $leaveRequest
     */
    public function create(LeaveRequest $leaveRequest)
    {
        $message = [
            'leaveRequestId' => $leaveRequest->getId(),
            'civility' => $leaveRequest->getCivility(),
            'firstName' => $leaveRequest->getFirstName(),
            'lastName' => $leaveRequest->getLastName(),
            'createdAt' => $leaveRequest->getCreatedAt(),
            'validatedAt' => $leaveRequest->getValidatedAt(),
            'timestamp' => date('Y-m-d H:i:s')
        ];

        $this->producer->publish(json_encode($message));
    }
}

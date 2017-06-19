<?php
declare(strict_types = 1);

namespace AW\LeaveRequestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LeaveRequestLog
 *
 * @ORM\Table(name="leave_request_log")
 * @ORM\Entity(repositoryClass="AW\LeaveRequestBundle\Repository\LeaveRequestLogRepository")
 */
class LeaveRequestLog
{
    const CREATE = 'Create';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=10)
     */
    private $action;

    /**
     * @var array
     *
     * @ORM\Column(name="message", type="json_array")
     */
    private $message;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return LeaveRequestLog
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set message
     *
     * @param array $message
     *
     * @return LeaveRequestLog
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }
}

<?php
declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: mamadou
 * Date: 30/05/17
 * Time: 13:59
 */
namespace AW\LeaveRequestBundle\Consumer;

use AW\LeaveRequestBundle\Entity\LeaveRequestLog;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
//use Symfony\Component\HttpKernel\Log\LoggerInterface;
use PSR\Log\LoggerInterface;

/**
 * Class LeaveRequestCreateConsumer
 * @package AW\LeaveRequestBundle\Consumer
 */
class LeaveRequestCreateConsumer implements ConsumerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * LeaveRequestCreateConsumer constructor.
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     */
    public function __construct(
        EntityManagerInterface $em,
        LoggerInterface $logger
    ) {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * @param AMQPMessage $message
     */
    public function execute(AMQPMessage $message)
    {
        $body = json_decode($message->body, true);

        try {
            $this->log($body);
            echo sprintf($body);
            echo sprintf('Leave request create - ID:%s @ %s ...', $body['leaveRequestId'], date('Y-m-d H:i:s')).PHP_EOL;
        } catch (Exception $e) {
            $this->logError($message, $e->getMessage());
        }
    }

    /**
     * @param $message
     */
    private function log($message)
    {
        $log = new LeaveRequestLog();
        $log->setAction(LeaveRequestLog::CREATE);
        $log->setMessage($message);

        $this->em->persist($log);
        $this->em->flush();
    }

    /**
     * @param $message
     * @param $error
     */
    private function logError($message, $error)
    {
        $data = [
            'error' => $error,
            'class' => __CLASS__,
            'message' => $message
        ];

        $this->logger->error(json_encode($data));
    }
}

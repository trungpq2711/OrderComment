<?php

namespace Trung\OrderComment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Sales\Model\Order;
use Trung\OrderComment\Model\Config;

class PublishQueueOrderComment implements ObserverInterface
{
    const TOPIC_NAME = 'order.comment';

    /**
     * @var PublisherInterface
     */
    protected $messagePublisher;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var Config
     */
    protected $modelConfig;

    /**
     * @param PublisherInterface $publisher
     * @param \Psr\Log\LoggerInterface $logger
     * @param Config $modelConfig
     */
    public function __construct(
        PublisherInterface $publisher,
        \Psr\Log\LoggerInterface $logger,
        Config $modelConfig
    ) {
        $this->messagePublisher = $publisher;
        $this->logger = $logger;
        $this->modelConfig = $modelConfig;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if($this->modelConfig->getOrderCommentActive()) {
            $order = $observer->getEvent()->getOrder();
            try {
                $this->messagePublisher->publish(self::TOPIC_NAME, $order->getIncrementId());
            } catch (\InvalidArgumentException $e){
                $this->logger->debug($e->getMessage());
            }
        }
    }
}

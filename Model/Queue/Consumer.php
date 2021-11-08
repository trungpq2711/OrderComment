<?php

namespace Trung\OrderComment\Model\Queue;

use Magento\Sales\Model\OrderRepository;
use Trung\OrderComment\Model\Config;

class Consumer
{
    /**
     * @var Config
     */
    protected $modelConfig;

    /**
     * @var \Magento\Sales\Api\Data\OrderInterface
     */
    protected $orderInterface;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param Config $modelConfig
     * @param \Magento\Sales\Api\Data\OrderInterface $orderInterface
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        Config $modelConfig,
        \Magento\Sales\Api\Data\OrderInterface $orderInterface,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->modelConfig = $modelConfig;
        $this->orderInterface = $orderInterface;
        $this->logger = $logger;
    }

    /**
     * @param $orderId
     */
    public function process($orderId)
    {
        $orderComment = $this->modelConfig->getOrderComment();
        if ($orderComment){
            try {
                $order = $this->orderInterface->loadByIncrementId($orderId);
                $order->addCommentToStatusHistory($orderComment);
                $this->orderInterface->save($order);
            } catch (\Exception $e){
                $this->logger->debug($e->getMessage());
            }
        } else {
            $this->logger->debug(__('Please config order comment'));
        }
    }
}

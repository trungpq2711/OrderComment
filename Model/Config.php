<?php

namespace Trung\OrderComment\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    const SALES_GENERAL_ORDER_COMMENT_ACTIVE = 'sales/general/order_comment_active';

    const SALES_GENERAL_ORDER_COMMENT = 'sales/general/order_comment';

    protected $cacheConfig = [];

    /**
     * @var ScopeInterface
     */
    protected $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeInterface
     */
    public function __construct(
        ScopeConfigInterface $scopeInterface
    ) {
        $this->scopeConfig = $scopeInterface;
    }

    /**
     * @return int
     */
    public function getOrderCommentActive()
    {
        if (empty($this->cacheConfig[self::SALES_GENERAL_ORDER_COMMENT_ACTIVE])) {
            $this->cacheConfig[self::SALES_GENERAL_ORDER_COMMENT_ACTIVE] = $this->scopeConfig->getValue(self::SALES_GENERAL_ORDER_COMMENT_ACTIVE, ScopeInterface::SCOPE_STORE);
        }
        return (int)$this->cacheConfig[self::SALES_GENERAL_ORDER_COMMENT_ACTIVE];
    }

    /**
     * @return string
     */
    public function getOrderComment()
    {
        if (empty($this->cacheConfig[self::SALES_GENERAL_ORDER_COMMENT])) {
            $this->cacheConfig[self::SALES_GENERAL_ORDER_COMMENT] = $this->scopeConfig->getValue(self::SALES_GENERAL_ORDER_COMMENT, ScopeInterface::SCOPE_STORE);
        }
        return $this->cacheConfig[self::SALES_GENERAL_ORDER_COMMENT];
    }
}

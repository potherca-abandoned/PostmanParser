<?php

namespace Potherca\PostmanParser;

interface PostmanItemCollection extends PostmanItem
{
    const ATTRIBUTE_ORDER = 'order';
    /**
     * @return \string[]
     */
    public function getOrder();

    /**
     * @param \string[] $order
     */
    public function setOrder($order);
}

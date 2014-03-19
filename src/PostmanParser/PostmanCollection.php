<?php

namespace Potherca\PostmanParser;

interface PostmanCollection
{
    /**
     * @return \string[]
     */
    public function getOrder();

    /**
     * @param \string[] $order
     */
    public function setOrder($order);
}

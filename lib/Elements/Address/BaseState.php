<?php

namespace PHPHealth\CDA\Elements\Address;

use PHPHealth\CDA\Elements\AbstractSimpleElement;

abstract class BaseState extends AbstractSimpleElement
{

    /**
     * @return string
     */
    protected function getElementTag(): string
    {
        return 'state';
    }

}
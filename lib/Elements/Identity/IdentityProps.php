<?php

namespace PHPHealth\CDA\Elements\Identity;

use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;

class IdentityProps extends AbstractElement
{
    protected function getElementTag(): string
    {
        return 'identity:Props';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc);
    }


}
<?php

namespace PHPHealth\CDA\Elements\MedService;

use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;

class MedServiceServiceType extends CodedValue
{
    public function getTagName(): string
    {
        return 'medService:serviceType';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc);
    }


}
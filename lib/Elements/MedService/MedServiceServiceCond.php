<?php

namespace PHPHealth\CDA\Elements\MedService;

use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;

class MedServiceServiceCond extends CodedValue
{
    public function getTagName(): string
    {
        return 'medService:serviceCond';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc);
    }


}
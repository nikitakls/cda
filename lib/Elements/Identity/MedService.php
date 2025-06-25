<?php

namespace PHPHealth\CDA\Elements\Identity;

use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;

class MedService extends AbstractElement
{
    public function __construct(CodedValue $codedValue)
    {
        $this->code = $codedValue;
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        $this->code->setValueToElement($el, $doc);
//        $this->code->set
        return $el;
    }

    public function getElementTag(): string
    {
        return $this->code->getTagName();
    }

}
<?php

namespace PHPHealth\CDA\Elements\Identity;

use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;

class IdentityPolicy extends AbstractElement
{
    protected $Number;

    public function setNumber(string $Number): IdentityPolicy
    {
        $this->Number = $Number;
        return $this;
    }

    protected function getElementTag(): string
    {
        return 'identity:InsurancePolicy';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if($this->Number){
            $el->appendChild($this->getTypeDocument($doc));
            $el->appendChild($this->getNumber($doc));
        } else {
            $el->setAttribute('nullFlavor', NullFlavourInterface::NoInformation);
        }
        return $el;
    }

    protected function getTypeDocument(\DOMDocument $doc): \DOMElement
    {
        $type = $doc->createElement('identity:InsuracePolicyType');
        $type->setAttribute('xsi:type', 'CD');
        $type->setAttribute('code', '2');
        $type->setAttribute('codeSystem', '1.2.643.5.1.13.13.11.1035');
        $type->setAttribute('codeSystemVersion', '1.3');
        $type->setAttribute('codeSystemName', 'Виды полиса обязательного медицинского страхования');
        $type->setAttribute('displayName', 'Полис ОМС единого образца, бессрочный');
        return $type;
    }

    protected function getNumber(\DOMDocument $doc): \DOMElement
    {
        $series = $doc->createElement('identity:Number');
        $series->setAttribute('xsi:type', 'ST');
        $series->appendChild($doc->createTextNode($this->Number));
        return $series;
    }


}
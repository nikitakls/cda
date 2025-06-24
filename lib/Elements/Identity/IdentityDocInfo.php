<?php

namespace PHPHealth\CDA\Elements\Identity;

use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Helper\ItemsEntities;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;

class IdentityDocInfo extends AbstractElement
{
    public const TYPE = ItemsEntities::IDENTITY_DOC_INFO;

    public const TYPE_OWN_MONEY = 3;
    public const TYPE_DMS = 2;

    protected $docType = self::TYPE_OWN_MONEY;
    protected $Series;
    protected $Number;
    protected $FromDate;
    protected $ToDate;
    protected $Inn;

    public function setDocumentType(int $docType): IdentityDocInfo
    {
        $this->docType = $docType;
        return $this;
    }

    public function setSeries(string $Series): IdentityDocInfo
    {
        $this->Series = $Series;
        return $this;
    }

    public function setNumber(string $Number): IdentityDocInfo
    {
        $this->Number = $Number;
        return $this;
    }

    public function setInn(string $inn): IdentityDocInfo
    {
        $this->Inn = $inn;
        return $this;
    }

    public function setFromDate(string $from): IdentityDocInfo
    {
        $this->FromDate = $from;
        return $this;
    }

    public function setToDate(string $to): IdentityDocInfo
    {
        $this->ToDate = $to;
        return $this;
    }

    protected function getElementTag(): string
    {
        return 'identity:DocInfo';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if ($this->Number) {
            $el->appendChild($this->getTypeDocument($doc));
            $el->appendChild($this->getPolicyType($doc));

            $el->appendChild($this->getSeries($doc));
            $el->appendChild($this->getNumber($doc));
            $el->appendChild($this->getInn($doc));
            $el->appendChild($this->getEffectiveTime($doc));

        } else {
            $el->setAttribute('nullFlavor', NullFlavourInterface::NoInformation);
        }


        return $el;
    }

    protected function getTypeDocument(\DOMDocument $doc): \DOMElement
    {
        if($this->docType === self::TYPE_DMS){
            return $this->getDmsTypeDocument($doc);
        }
        $type = $doc->createElement('identity:IdentityDocType');
//        $type->setAttribute('xsi:type', 'CD');
        $type->setAttribute('code', '3');
        $type->setAttribute('codeSystem', '1.2.643.5.1.13.13.99.2.724');
        $type->setAttribute('codeSystemVersion', '1.1');
        $type->setAttribute('codeSystemName', 'Типы документов оснований');
        $type->setAttribute('displayName', 'Договор на оказание платных медицинских услуг');
        return $type;
    }

    protected function getDmsTypeDocument(\DOMDocument $doc): \DOMElement
    {
        $type = $doc->createElement('identity:IdentityDocType');
//        $type->setAttribute('xsi:type', 'CD');
        $type->setAttribute('code', '2');
        $type->setAttribute('codeSystem', '1.2.643.5.1.13.13.99.2.724');
        $type->setAttribute('codeSystemVersion', '1.1');
        $type->setAttribute('codeSystemName', 'Типы документов оснований');
        $type->setAttribute('displayName', 'Полис ДМС');
        return $type;
    }

    protected function getPolicyType(\DOMDocument $doc): \DOMElement
    {
        $type = $doc->createElement('identity:InsurancePolicyType');
        $type->setAttribute('nullFlavor', NullFlavourInterface::NotApplicable);
        return $type;
    }

    protected function getSeries(\DOMDocument $doc): \DOMElement
    {
        $series = $doc->createElement('identity:Series');
        $series->setAttribute('xsi:type', 'ST');
        if(!$this->Series){
            $series->setAttribute('nullFlavor', NullFlavourInterface::NotApplicable);
        } else {
            $series->appendChild($doc->createTextNode($this->Series));
        }
        return $series;
    }

    protected function getNumber(\DOMDocument $doc): \DOMElement
    {
        $series = $doc->createElement('identity:Number');
        $series->setAttribute('xsi:type', 'ST');
        if(!$this->Number){
            $series->setAttribute('nullFlavor', NullFlavourInterface::NotApplicable);
        } else {
            $series->appendChild($doc->createTextNode($this->Number));
        }

        return $series;
    }

    protected function getInn(\DOMDocument $doc): \DOMElement
    {
        $series = $doc->createElement('identity:INN');
        $series->setAttribute('xsi:type', 'ST');
        if(!$this->Inn){
            $series->setAttribute('nullFlavor', NullFlavourInterface::NoInformation);
        } else {
            $series->appendChild($doc->createTextNode($this->Inn));
        }

        return $series;
    }

    protected function getEffectiveTime(\DOMDocument $doc): \DOMElement
    {
        $eff = $doc->createElement('identity:effectiveTime');
        $low = $doc->createElement('identity:low');
            $low->setAttribute('value', $this->FromDate);
//        $low->append($doc->createTextNode($this->FromDate));
        $high = $doc->createElement('identity:high');
        $high->setAttribute('value', $this->FromDate);
//        $high->append($doc->createTextNode($this->ToDate));
        $eff->appendChild($low);
        $eff->appendChild($high);
        return $eff;
    }

}
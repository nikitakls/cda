<?php

namespace PHPHealth\CDA\Elements\Identity;

use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Interfaces\NullFlavourInterface;

class IdentityDoc extends AbstractElement
{
    protected $isPasport = true;
    protected $Series;
    protected $Number;
    protected $IssueOrgName;
    protected $IssueOrgCode;
    protected $IssueDate;

    public function setDocymentType($isPasport = true): IdentityDoc
    {
        $this->isPasport = $isPasport;
        return $this;
    }

    public function setSeries(string $Series): IdentityDoc
    {
        $this->Series = $Series;
        return $this;
    }

    public function setNumber(string $Number): IdentityDoc
    {
        $this->Number = $Number;
        return $this;
    }

    public function setIssueOrgName(string $IssueOrgName): IdentityDoc
    {
        $this->IssueOrgName = $IssueOrgName;
        return $this;
    }

    public function setIssueOrgCode(string $IssueOrgCode): IdentityDoc
    {
        $this->IssueOrgCode = $IssueOrgCode;
        return $this;
    }

    public function setIssueDate(string $IssueDate): IdentityDoc
    {
        $this->IssueDate = $IssueDate;
        return $this;
    }


    protected function getElementTag(): string
    {
        return 'identity:IdentityDoc';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        if($this->Number){
            $el->appendChild($this->getTypeDocument($doc));
            $el->appendChild($this->getNumber($doc));

            if($this->Series){
                $el->appendChild($this->getSeries($doc));
            }
            if($this->IssueOrgName){
                $el->appendChild($this->getIssueOrgName($doc));
            }
            if($this->IssueOrgCode){
                $el->appendChild($this->getIssueOrgCode($doc));
            }
            if($this->IssueDate){
                $el->appendChild($this->getIssueDate($doc));
            }

        } else {
            $el->setAttribute('nullFlavor', NullFlavourInterface::NoInformation);
        }


        return $el;
    }

    protected function getTypeDocument(\DOMDocument $doc): \DOMElement
    {
        $type = $doc->createElement('identity:IdentityCardType');
        $type->setAttribute('xsi:type', 'CD');
        $type->setAttribute('code', '1');
        $type->setAttribute('codeSystem', '1.2.643.5.1.13.13.99.2.48');
        $type->setAttribute('codeSystemVersion', '4.2');
        $type->setAttribute('codeSystemName', 'Документы, удостоверяющие личность');
        $type->setAttribute('displayName', 'Паспорт гражданина РФ');
        return $type;
    }

    protected function getSeries(\DOMDocument $doc): \DOMElement
    {
        $series = $doc->createElement('identity:Series');
        $series->setAttribute('xsi:type', 'ST');
        $series->appendChild($doc->createTextNode($this->Series));
        return $series;
    }

    protected function getNumber(\DOMDocument $doc): \DOMElement
    {
        $series = $doc->createElement('identity:Number');
        $series->setAttribute('xsi:type', 'ST');
        $series->appendChild($doc->createTextNode($this->Number));
        return $series;
    }

    protected function getIssueOrgName(\DOMDocument $doc): \DOMElement
    {
        $issueOrgName = $doc->createElement('identity:IssueOrgName');
        $issueOrgName->setAttribute('xsi:type', 'ST');
        $issueOrgName->appendChild($doc->createTextNode($this->IssueOrgName));
        return $issueOrgName;
    }

    protected function getIssueOrgCode(\DOMDocument $doc): \DOMElement
    {
        $issueOrgCode = $doc->createElement('identity:IssueOrgCode');
        $issueOrgCode->setAttribute('xsi:type', 'ST');
        $issueOrgCode->appendChild($doc->createTextNode($this->IssueOrgCode));
        return $issueOrgCode;
    }

    protected function getIssueDate(\DOMDocument $doc): \DOMElement
    {
        $issueDate = $doc->createElement('identity:IssueDate');
        $issueDate->setAttribute('xsi:type', 'TS');
        $issueDate->setAttribute('value', $this->IssueDate);
        return $issueDate;
    }

}
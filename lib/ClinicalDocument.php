<?php

/*
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace PHPHealth\CDA;

/**
 * Root class for clinical document
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class ClinicalDocument
{
    const NS_CDA = '';
    
    /**
     * the templateId of the document. Will be inserted into doc, like
     * 
     * ```
     * <ClinicalDocument templateId="2.16.840.1.113883.3.27.1776">
     * ```
     * 
     * TODO : always equals to '2.16.840.1.113883.3.27.1776'
     *
     * @var string
     */
    private $templateId = '2.16.840.1.113883.3.27.1776';
    
    /**
     * the title of the document
     *
     * @var string
     */
    private $title;
    
    private $rootComponent;
    
    public function __construct()
    {
        $this->rootComponent = new Component\RootBodyComponent();
    }
    
    /**
     * 
     * @return string
     */
    function getTitle()
    {
        return $this->title;
    }

    /**
     * 
     * @param string $title
     * @return \PHPHealth\CDA2\ClinicalDocument
     */
    function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * 
     * @return Component\RootBodyComponent;
     */
    public function getRootComponent()
    {
        return $this->rootComponent;
    }
    
    /**
     * 
     * @return \DOMDocument
     */
    public function toDOMDocument()
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        
        $doc = $dom->createElement('ClinicalDocument');
        $dom->appendChild($doc);
        // set the default NS
        $dom->createAttributeNS('urn:hl7-org:v3','xmlns');
        // add templateId
        $doc->setAttribute('templateId', $this->templateId);
        // add title
        $doc->appendchild($dom->createElement('title', $this->title));
        // add components
        if (!$this->getRootComponent()->isEmpty()) {
            $doc->appendChild($this->getRootComponent()->toDOMElement($dom));
        }
        
        $this->isInitialized = true;
        
        return $dom;
    }
    
    
}
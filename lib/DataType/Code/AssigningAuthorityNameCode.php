<?php
/**
 *
 * @package     PHPHealth\CDA
 * @author      Peter Gee <https://github.com/pgee70>
 * @link        https://framagit.org/php-health/cda
 *
 */


namespace PHPHealth\CDA\DataType\Code;

use PHPHealth\CDA\DataType\AnyType;

class AssigningAuthorityNameCode extends AnyType
{
    /** @var \string */
    private $assigningAuthorityName;
    /** @var \string */
    private $root;
    /** @var \string */
    private $extension;

    /**
     * @param \DOMElement       $el
     * @param \DOMDocument|NULL $doc
     */
    public function setValueToElement(\DOMElement $el, \DOMDocument $doc)
    {
        if ($this->hasAssigningAuthorityName()) {
            $el->setAttribute('assigningAuthorityName', $this->getAssigningAuthorityName());
        }

        if ($this->hasRoot()) {
            $el->setAttribute('root', $this->getRoot());
        }

        if ($this->hasExtension()) {
            $el->setAttribute('extension', $this->getExtension());
        }
    }

    /**
     * @return bool
     */
    public function hasAssigningAuthorityName(): bool
    {
        return false === empty($this->assigningAuthorityName);
    }

    /**
     * @return string
     */
    public function getAssigningAuthorityName(): string
    {
        return $this->assigningAuthorityName;
    }

    /**
     * @param $assigningAuthorityName
     *
     * @return AssigningAuthorityNameCode
     */
    public function setAssigningAuthorityName($assigningAuthorityName): self
    {
        $this->assigningAuthorityName = $assigningAuthorityName;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasRoot(): bool
    {
        return false === empty($this->root);
    }

    /**
     * @return string
     */
    public function getRoot(): string
    {
        return $this->root;
    }

    /**
     * @param $root
     *
     * @return AssigningAuthorityNameCode
     */
    public function setRoot($root): self
    {
        $this->root = $root;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasExtension(): bool
    {
        return false === empty($this->extension);
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param $extension
     *
     * @return AssigningAuthorityNameCode
     */
    public function setExtension($extension): self
    {
        $this->extension = $extension;
        return $this;
    }
}
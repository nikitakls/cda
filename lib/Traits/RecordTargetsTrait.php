<?php

/**
 * The MIT License
 *
 * Copyright 2018  Peter Gee <https://github.com/pgee70>.
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
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */


namespace PHPHealth\CDA\Traits;


use PHPHealth\CDA\RIM\Participation\RecordTarget;

/**
 * Trait RecordTargetsTrait
 *
 * @package PHPHealth\CDA\Traits
 */
trait RecordTargetsTrait
{
    /** @var RecordTarget[] */
    private $recordTargets = [];

    /**
     * @param \DOMElement  $el
     * @param \DOMDocument $doc
     *
     * @return RecordTargetsTrait
     */
    public function renderRecordTargets(\DOMElement $el, \DOMDocument $doc): self
    {
        if ($this->hasRecordTargets()) {
            foreach ($this->getRecordTargets() as $record_target) {
                $el->appendChild($record_target->toDOMElement($doc));
            }
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function hasRecordTargets(): bool
    {
        return \count($this->recordTargets) > 0;
    }

    /**
     * @return RecordTarget[]
     */
    public function getRecordTargets(): array
    {
        return $this->recordTargets;
    }

    /**
     * @param RecordTarget[] $recordTargets
     *
     * @return self
     */
    public function setRecordTargets(array $recordTargets): self
    {
        foreach ($recordTargets as $record_target) {
            if ($record_target instanceof RecordTarget) {
                $this->addRecordTarget($record_target);
            }
        }
        return $this;
    }

    /**
     * @param RecordTarget $recordTarget
     *
     * @return RecordTargetsTrait
     */
    public function addRecordTarget(RecordTarget $recordTarget): self
    {
        $this->recordTargets[] = $recordTarget;
        return $this;
    }
}
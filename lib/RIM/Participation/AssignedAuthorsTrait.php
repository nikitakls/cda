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

namespace PHPHealth\CDA\RIM\Participation;


use PHPHealth\CDA\RIM\Role\AssignedAuthor;

/**
 * Trait AssignedAuthorsTrait
 *
 * @package PHPHealth\CDA\RIM\Participation
 */
trait AssignedAuthorsTrait
{
    /** @var AssignedAuthor[] */
    private $assignedAuthors = array();

    /**
     * @return array
     */
    public function getAssignedAuthors(): array
    {
        return $this->assignedAuthors;
    }

    /**
     * @param $assignedAuthors
     *
     * @return self
     */
    public function setAssignedAuthors($assignedAuthors): self
    {
        foreach ($assignedAuthors as $assigned_author) {
            if ($assigned_author instanceof AssignedAuthor) {
                $this->addAssignedAuthor($assigned_author);
            }
        }

        return $this;
    }

    /**
     * @param AssignedAuthor $assigned_author
     *
     * @return AssignedAuthorsTrait
     */
    public function addAssignedAuthor(AssignedAuthor $assigned_author): self
    {
        $this->assignedAuthors[] = $assigned_author;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAssignedAuthors(): bool
    {
        return \count($this->assignedAuthors) > 0;
    }


}
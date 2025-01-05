<?php

namespace Slidewind\Html;

use PhpOffice\PhpPresentation\Shape\RichText\Paragraph as RichTextParagraph;

final class Paragraph extends Element
{
    public function render()
    {
        $paragraph = new RichTextParagraph;

        $children = array_filter($this->children);

        foreach ($this->children as $key => $child) {
            $paragraph->addText($child);
        }

        return $paragraph;
    }
}

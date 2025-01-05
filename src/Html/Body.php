<?php

namespace Slidewind\Slidewind\Html;

use PhpOffice\PhpPresentation\Shape\RichText;

final class Body extends Element
{
    public function render()
    {
        $text = new RichText;

        $text->setParagraphs($this->children);

        return $text;
    }
}

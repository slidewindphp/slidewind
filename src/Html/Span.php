<?php

namespace Slidewind\Html;

use PhpOffice\PhpPresentation\Shape\RichText\Run;

final class Span extends Element
{
    public function render()
    {
        if (empty(trim($this->content))) {
            return null;
        }

        $objText = new Run($this->content);
        // $objText->setFont(clone $this->font);
        // $this->addText($objText);

        return $objText;
    }
}

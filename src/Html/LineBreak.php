<?php

namespace Slidewind\Slidewind\Html;

use PhpOffice\PhpPresentation\Shape\RichText\Run;

final class LineBreak extends Element
{
    public function render()
    {
        $objText = new Run("\n");
        // $objText->setFont(clone $this->font);
        // $this->addText($objText);

        return $objText;
    }
}

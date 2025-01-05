<?php

namespace Slidewind\Slidewind\Components;

use PhpOffice\PhpPresentation\Shape\RichText;

final class Code extends Element
{
    public function render()
    {
        $text = new RichText;

        $text->setWidth($this->styles->getWidth());
        $text->setHeight($this->styles->getHeight());

        $text->setOffsetX($this->styles->getLeft());
        $text->setOffsetY($this->styles->getTop());

        $text->createTextRun($this->content);

        return $text;
    }
}

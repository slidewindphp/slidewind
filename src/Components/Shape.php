<?php

namespace Slidewind\Slidewind\Components;

use PhpOffice\PhpPresentation\Shape\AutoShape;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Fill;

final class Shape extends Element
{
    public function render()
    {
        $shape = new AutoShape;

        $shape->setWidth($this->styles->getWidth());
        $shape->setHeight($this->styles->getHeight());

        $shape->setOffsetX($this->styles->getLeft());
        $shape->setOffsetY($this->styles->getTop());

        $shape->setType($this->properties['type']);

        $shape
            ->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->setStartColor(new Color('FF953735'))
            ->setEndColor(new Color('FF953735'));

        return $shape;
    }
}

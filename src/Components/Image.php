<?php

namespace Slidewind\Slidewind\Components;

use PhpOffice\PhpPresentation\Shape\Drawing\File;

final class Image extends Element
{
    public function render()
    {
        $file = new File;

        $file->setPath($this->properties['src']);

        $file->setResizeProportional(false); // TODO: impostare solo se esistono entrambi i valori

        $file->setWidth($this->styles->getWidth());
        $file->setHeight($this->styles->getHeight());

        $file->setOffsetX($this->styles->getLeft());
        $file->setOffsetY($this->styles->getTop());

        return $file;
    }
}

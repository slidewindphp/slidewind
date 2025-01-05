<?php

namespace Slidewind\Components;

use PhpOffice\PhpPresentation\Slide as PhpSlide;
use PhpOffice\PhpPresentation\Slide\Background\Color;
use PhpOffice\PhpPresentation\Style\Color as StyleColor;
use Slidewind\Components\Attributes\AllowedChildren;

#[AllowedChildren([
    Text::class,
    Shape::class,
    Image::class,
    Code::class,
])]
final class Slide extends Element
{
    public function render()
    {
        // $color = $this->styles->getBackgroundColor();

        $slide = new PhpSlide;

        // if (!is_null($color)) {
        //     $slide->setBackground((new Color())->setColor(
        //         new StyleColor($color)
        //     ));
        // }

        $children = array_filter($this->children); // TODO: remove

        foreach ($children as $shape) {
            $slide->addShape($shape);
        }

        return $slide;
    }
}

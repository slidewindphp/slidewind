<?php

namespace Slidewind\Slidewind\Components;

use PhpOffice\PhpPresentation\DocumentProperties;
use PhpOffice\PhpPresentation\PhpPresentation;
use Slidewind\Slidewind\Components\Attributes\AllowedChildren;

#[AllowedChildren([
    Slide::class,
])]
final class Presentation extends Element
{
    public function render()
    {
        $presentation = (new PhpPresentation);
        $presentation->removeSlideByIndex(0);

        $children = array_filter($this->children);

        foreach ($children as $index => $item) {

            if ($item instanceof DocumentProperties) {
                $presentation->setDocumentProperties($item);
            } else {
                (fn () => ( // rebind parent
                    $this->parent = $presentation
                ))->call($item);

                $presentation->addSlide($item, $index);
            }
        }

        return $presentation;
    }
}

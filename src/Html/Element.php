<?php

namespace Slidewind\Slidewind\Html;

use Slidewind\Slidewind\ValueObjects\Styles;

abstract class Element
{
    public function __construct(
        protected string $content,
        protected array $children,
        protected array $properties,
        protected ?Styles $styles
    ) {
        $this->children = array_values(
            array_filter($children)
        );
    }

    public function render() {}
}

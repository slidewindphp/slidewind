<?php

namespace Slidewind\Slidewind\Components;

use Slidewind\Slidewind\ValueObjects\Styles;

abstract class Element
{
    public function __construct(
        protected string $content,
        protected array $children,
        protected array $properties,
        protected ?Styles $styles
    ) {}

    public function render() {}
}

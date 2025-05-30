<?php

namespace Slidewind\Components;

use Slidewind\ValueObjects\Property as PropertyValue;

final class Property extends Element
{
    public function render()
    {
        return new PropertyValue(
            type: $this->properties['type'] ?? 'default',
            name: $this->properties['name'],
            value: $this->content,
        );
    }
}

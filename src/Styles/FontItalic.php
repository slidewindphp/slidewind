<?php

namespace Slidewind\Slidewind\Styles;

class FontItalic extends Style
{
    protected static string $pattern = '/^(italic|not-italic)$/';

    public function getValue(): mixed
    {
        return static::match($this->style) === 'italic';
    }
}

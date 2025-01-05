<?php

namespace Slidewind\Slidewind\Styles;

class Underline extends Style
{
    protected static string $pattern = '/^(underline|no-underline)$/';

    public function getValue(): mixed
    {
        return static::match($this->style) === 'underline';
    }
}

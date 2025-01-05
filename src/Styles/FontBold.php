<?php

namespace Slidewind\Styles;

class FontBold extends Style
{
    protected static string $pattern = '/^font-(normal|bold)$/';

    public function getValue(): mixed
    {
        return static::match($this->style) === 'bold';
    }
}

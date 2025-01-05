<?php

namespace Slidewind\Slidewind\Styles;

use InvalidArgumentException;

abstract class Style
{
    protected static string $pattern = '';

    public function __construct(
        protected string $style
    ) {
        $this->style = trim($style);

        if (! static::isMatch($style)) {
            throw new InvalidArgumentException;
        }
    }

    public static function make(string $style): static
    {
        return new static($style);
    }

    public function getValue(): mixed
    {
        return static::match($this->style);
    }

    public static function match(string $style): string
    {
        $style = trim($style);

        preg_match(static::$pattern, $style, $matches);

        if (! $matches) {
            return '';
        }

        return $matches[1] ?? $matches[0];
    }

    public static function isMatch(string $style): bool
    {
        return ! empty(
            static::match($style)
        );
    }
}

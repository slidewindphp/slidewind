<?php

namespace Slidewind\Slidewind\ValueObjects;

use Slidewind\Slidewind\Styles\FontBold;
use Slidewind\Slidewind\Styles\FontItalic;
use Slidewind\Slidewind\Styles\Height;
use Slidewind\Slidewind\Styles\Left;
use Slidewind\Slidewind\Styles\Style;
use Slidewind\Slidewind\Styles\Top;
use Slidewind\Slidewind\Styles\Underline;
use Slidewind\Slidewind\Styles\Width;

final readonly class Styles
{
    public function __construct(
        public array $styles = []
    ) {}

    public static function fromClass(string $styles)
    {
        $styles = explode(' ', $styles);

        $styles = array_map(fn (string $style) => match (true) {
            FontBold::isMatch($style) => FontBold::make($style),
            FontItalic::isMatch($style) => FontItalic::make($style),
            Height::isMatch($style) => Height::make($style),
            Left::isMatch($style) => Left::make($style),
            Top::isMatch($style) => Top::make($style),
            Underline::isMatch($style) => Underline::make($style),
            Width::isMatch($style) => Width::make($style),
            default => null,
        }, $styles);

        return new self(
            array_filter($styles)
        );
    }

    public function getTop(): int
    {
        return $this->getInt(Top::class);
    }

    public function getLeft(): int
    {
        return $this->getInt(Left::class);
    }

    public function getWidth(): int
    {
        return $this->getInt(Width::class);
    }

    public function getHeight(): int
    {
        return $this->getInt(Height::class);
    }

    public function isFontBold(): bool
    {
        return $this->getBool(FontBold::class);
    }

    public function isFontItalic(): bool
    {
        return $this->getBool(FontItalic::class);
    }

    public function isUnderline(): bool
    {
        return $this->getBool(Underline::class);
    }

    private function getInt(string $class, int $default = 0): int
    {
        return $this->getValue($class) ?? $default;
    }

    private function getBool(string $class, bool $default = false): bool
    {
        return $this->getValue($class) ?? $default;
    }

    private function getValue(string $class): int|bool|null
    {
        $styles = array_filter($this->styles, fn (Style $style): bool => (
            is_a($style, $class)
        ));

        $styles = array_values($styles);

        $style = $styles[count($styles) - 1] ?? null;

        return $style?->getValue();
    }
}

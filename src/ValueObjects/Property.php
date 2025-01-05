<?php

namespace Slidewind\Slidewind\ValueObjects;

final readonly class Property
{
    public function __construct(
        public string $type,
        public string $name,
        public string $value,
    ) {}
}

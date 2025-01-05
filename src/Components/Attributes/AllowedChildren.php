<?php

namespace Slidewind\Components\Attributes;

use Attribute;
use ReflectionClass;
use Slidewind\Components\Element;

#[Attribute()]
final readonly class AllowedChildren
{
    public function __construct(
        public array $children
    ) {}

    // TODO: refactor
    public static function filterAllowed(Element $element, array $children): array
    {
        $instance = self::getInstance($element);

        $allowedNames = array_map(
            callback: fn ($child) => $child::name(),
            array: $instance->children
        );

        return array_filter(
            $children,
            fn ($child) => in_array(
                needle: $child->getName(),
                haystack: $allowedNames,
                strict: true
            )
        );
    }

    private static function getInstance(Element $element): self
    {
        $reflectionClass = new ReflectionClass($element::class);
        $attributes = $reflectionClass->getAttributes(self::class);
        $attr = reset($attributes);

        return $attr->newInstance();
    }
}

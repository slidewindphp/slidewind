<?php

namespace Slidewind;

use DOMDocument;
use DOMNode;
use PhpOffice\PhpPresentation\IOFactory;
use Slidewind\ValueObjects\Node;
use Slidewind\ValueObjects\Styles;

final class Slidewind
{
    public function render(string $html): void
    {
        $output = $this->parse($html); // ->render();

        $oWriterPPTX = IOFactory::createWriter($output, 'PowerPoint2007');
        $oWriterPPTX->save('/Users/edelazzari/dev/prova.pptx');
    }

    public function parse(string $html)// : Components\Element
    {
        $dom = new DOMDocument;

        $html = trim($html);
        $dom->loadHTML($html, LIBXML_NOERROR | LIBXML_COMPACT | LIBXML_HTML_NODEFDTD | LIBXML_NOBLANKS | LIBXML_NOXMLDECL);

        /** @var DOMNode $presentation */
        $presentation = $dom->getElementsByTagName('presentation')->item(0);

        return $this->convert(new Node($presentation));
    }

    private function convert(Node $node)// : Components\Element //|string
    {
        $children = [];

        foreach ($node->getChildNodes() as $child) {
            $children[] = $this->convert($child);
        }

        return $this->toElement($node, $children);
    }

    private function toElement(Node $node, array $children)// : Components\Element //|string
    {
        // if ($node->isText()) {
        //     return $node->getValue();
        // }

        $properties = [
            ...$node->getAttributes(),
        ];

        $styles = Styles::fromClass($node->getClassAttribute());

        return match ($node->getName()) {
            'presentation' => (new Components\Presentation($node->getHtml(), $children, $properties, $styles))->render(),
            'slide' => (new Components\Slide($node->getHtml(), $children, $properties, $styles))->render(),
            'code' => (new Components\Code($node->getHtml(), $children, $properties, $styles))->render(),
            'image' => (new Components\Image($node->getHtml(), $children, $properties, $styles))->render(),
            'shape' => (new Components\Shape($node->getHtml(), $children, $properties, $styles))->render(),
            'text' => (new Components\Text($node->getHtml(), $children, $properties, $styles))->render(),
            'properties' => (new Components\Properties($node->getHtml(), $children, $properties, $styles))->render(),
            'property' => (new Components\Property($node->getHtml(), $children, $properties, $styles))->render(),
            // default => Slidewind::text($children, $styles, $properties),
            default => null,
        };
    }
}

<?php

namespace Slidewind;

use DOMDocument;
use DOMNode;
use Slidewind\ValueObjects\Node;
use Slidewind\ValueObjects\Styles;

final class Html
{
    public function render(string $html): void
    {
        $output = $this->parse($html); // ->render();

        dd($output);
    }

    public function parse(string $html)// : Components\Element
    {
        $dom = new DOMDocument;

        $html = str_replace("\n", '', $html);
        $html = str_replace("\t", '', $html);
        // deduplicate
        $html = preg_replace('/'.preg_quote(' ', '/').'+/u', ' ', $html);
        $html = trim($html);
        $html = "<body>{$html}</body>";

        $dom->loadHTML($html, LIBXML_NOERROR | LIBXML_COMPACT | LIBXML_HTML_NODEFDTD | LIBXML_NOBLANKS | LIBXML_NOXMLDECL);

        /** @var DOMNode $body */
        $body = $dom->getElementsByTagName('body')->item(0);

        // dd((new Node($body))->getHtml());

        return $this->convert(new Node($body));
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
        // dump($node->getName().'___'.$node->getValue());

        // if ($node->isText()) {
        //     return $node->getValue();
        // }

        $properties = [
            ...$node->getAttributes(),
        ];

        $styles = Styles::fromClass($node->getClassAttribute());

        return match ($node->getName()) {
            'p' => (new Html\Paragraph($node->getHtml(), $children, $properties, $styles))->render(),
            'br' => (new Html\LineBreak($node->getHtml(), $children, $properties, $styles))->render(),
            'span' => (new Html\Span($node->getHtml(), $children, $properties, $styles))->render(),
            '#text' => (new Html\Span($node->getValue(), $children, $properties, $styles))->render(),
            'strong' => (new Html\Strong($node->getHtml(), $children, $properties, $styles))->render(),
            'body' => (new Html\Body($node->getHtml(), $children, $properties, $styles))->render(),
            '#comment' => null,
            default => dd($node->getName()),
        };
    }
}

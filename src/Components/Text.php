<?php

namespace Slidewind\Slidewind\Components;

use PhpOffice\PhpPresentation\Shape\RichText;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Font;
use Slidewind\Slidewind\Html;

final class Text extends Element
{
    public function render()
    {
        if ($this->properties['type'] === 'plain') {
            $text = new RichText;

            $text->setWidth($this->styles->getWidth());
            $text->setHeight($this->styles->getHeight());

            $text->setOffsetX($this->styles->getLeft());
            $text->setOffsetY($this->styles->getTop());

            $textRun = $text->createTextRun($this->content);

            $font = $textRun->getFont();

            $font->setBold($this->styles->isFontBold());

            $font->setItalic($this->styles->isFontItalic());

            $font->setUnderline(
                $this->styles->isUnderline()
                    ? Font::UNDERLINE_SINGLE
                    : Font::UNDERLINE_NONE
            );

            $font->setSize(60);

            $font->setColor(new Color('FFE06B20'));

            return $text;
        }

        if ($this->properties['type'] === 'html') {

            $text = (new Html)->parse($this->content);

            $text->setWidth($this->styles->getWidth());
            $text->setHeight($this->styles->getHeight());

            $text->setOffsetX($this->styles->getLeft());
            $text->setOffsetY($this->styles->getTop());

            return $text;
        }

        dd('ok');

    }
}

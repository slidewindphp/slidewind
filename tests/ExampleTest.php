<?php

use PhpOffice\PhpPresentation\Shape\AutoShape;
use Slidewind\Slidewind\Slidewind;

it('can test', function () {

    $html = view('test', [
        'shape' => AutoShape::TYPE_ROUNDED_RECTANGLE,
        'image' => __DIR__.'/Support/Assets/200.png',
    ]);

    dd($html)

    // 'top-[20pt] left-[40pt] w-[200pt] h-[400pt]',
    // 'font-bold font-normal',
    // 'italic', // not-italic
    // 'no-underline underline',

    (new Slidewind)->render($html);

    expect(true)->toBeTrue();
});

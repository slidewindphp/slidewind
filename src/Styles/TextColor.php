<?php

namespace Slidewind\Slidewind\Styles;

class BackgroundColor extends Style
{
    protected static string $pattern = '/text-\[#([a-fA-F0-9]{6})\]/';
}

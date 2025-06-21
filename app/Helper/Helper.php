<?php

use Illuminate\Support\Str;

function filter($text)
{
    return Str::title($text);
}

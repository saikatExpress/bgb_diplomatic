<?php

use Illuminate\Support\Str;

function filter($text)
{
    if($text != ''){
        return Str::title($text);
    }else{
        return 'N/A';
    }
}
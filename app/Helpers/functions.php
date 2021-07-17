<?php

use Illuminate\Support\Str;

function str_plural($word, $count)
{
    return Str::plural($word, $count);
}

function str_limit($value, $limit)
{
    return Str::limit($value, $limit);
}

function str_slug($title)
{
    return Str::slug($title) . "-" . Str::random(10);
}

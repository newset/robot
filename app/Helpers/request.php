<?php

if ( ! function_exists('rq_ins'))
{
    function rq_ins()
    {
        return new Request();
    }
} else dd('function rq_ins exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('is_get'))
{
    function is_get()
    {
        return strtolower(Request::method()) === 'get';
    }
} else dd('function is_get exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('is_post'))
{
    function is_post()
    {
        return strtolower(Request::method()) === 'post';
    }
} else dd('function is_post exists.' . __FILE__ . ':' . __LINE__);


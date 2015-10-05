<?php

if ( ! function_exists('conf'))
{
    function conf($segs)
    {
        return Config::get($segs);
    }
} else dd('function conf exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('v_rule'))
{
    function v_rule($segs)
    {
        return conf('v_rule.' . $segs);
    }
} else dd('function v_rule exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('cons'))
{
    function cons($segs)
    {
        return conf('constant.' . $segs);
    }
} else dd('function cons exists.' . __FILE__ . ':' . __LINE__);


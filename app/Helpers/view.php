<?php
if ( ! function_exists('V'))
{
    function V($segs)
    {
        return view($segs);
    }
} else dd('function V exists.' . __FILE__ . ':' . __LINE__);


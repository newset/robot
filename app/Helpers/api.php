<?php

if (!function_exists('api_model_path'))
{
    function api_model_path($version, $modelNamespace='Models')
    {
        return 'App\\' . $modelNamespace . '\\' . A . '\\' . API_NAME . '\\' . '_' . $version . '\\' . d('api_model_name');
    }
} else dd('function api_model_path exists.' . __FILE__ . ':' . __LINE__);


if (!function_exists('call_api'))
{
    function call_api($version, $d)
    {
        $api_name = api_model_path($version);
        $api_ins = new $api_name;
        return $api_ins->leader($d);
    }
} else dd('function call_api exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('is_api_call'))
{
    function is_api_call()
    {
        return conf('api.segment_name') === Request::segment(conf('api.start_segment_index'));
    }
} else dd('function is_api_call exists.' . __FILE__ . ':' . __LINE__);


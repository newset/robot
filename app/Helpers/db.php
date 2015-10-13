<?php

if ( ! function_exists('c_kv'))
{
    /**
     * create kv ins record.
     * @param $arr
     * @return array
     */
    function c_kv($arr)
    {
        if ( ! array_has($arr, ['k', 'v', 'ins_name', 'ins_id']))
            return ee(2);
        $ins = M($arr['ins_name'], 'kv');
        $r = $ins->create($arr);
        return $r ? ss($ins) : ee(1);
    }
} else dd('function c_kv exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('c_t'))
{

    /**
     * create type ins record.
     * @param $arr
     * @return array
     */
    function c_t($arr)
    {
//        dd($arr);
        $required_field = ['type_name'];
        if ( ! has_keys($arr, $required_field))
            return ee(2);
        if (array_has($arr, 'is_status'))
            $ins = M($arr['ins_name'], 'ts');
        else
            $ins = M($arr['ins_name'], 't');

        if ( ! array_has($arr, 'status_id'))
            $arr['status_id'] = 1;

        unset($arr['ins_name']);
        unset($arr['is_status']);

        $r = $ins->create($arr);
        return $r ? ss($ins) : ee(1);
    }
} else dd('function c_t exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('c_k'))
{
    function c_k($data)
    {
        $ins = M($data['ins_name'], 'tk');
        $d = array_only(['type_name']);
        $ins->fill($d);
        $ins->save();
    }
} else dd('function c_k exists.' . __FILE__ . ':' . __LINE__);

//if (!function_exists('c_meta'))
//{
//    /* create meta table records */
//    function c_meta($type, $arr)
//    {
//        switch($type)
//        {
//            case 'record_status':
//                if(has_keys($arr, ['type_name', 'status_name']))
//                {}
//                break;
//            case 'datatype':
//                has_keys(['type_name']);
//                break;
//        }
//    }
//} else dd('function c_meta exists.' . __FILE__ . ':' . __LINE__);


if ( ! function_exists('table_name'))
{
    function table_name($ins_name, $type = 'i', $prefix = null, $suffix = null)
    {

        switch ($type)
        {
            case 'i':
                if ( ! $prefix) $prefix = 'i_';
                break;
            case 'v':
                if ( ! $prefix) $prefix = 'v_';
                break;
            case 't':
                if ( ! $prefix) $prefix = 't_';
                break;
            case 'tk':
                if ( ! $prefix) $prefix = 't_k_';
                break;
            case 'kv':
                if ( ! $prefix) $prefix = 'kv_';
                break;
            case 'ts':
                if ( ! $prefix)
                    $prefix = 't_';
                if ( ! $suffix)
                    $suffix = '_status';
                break;
            case 'tks':
                if ( ! $prefix)
                    $prefix = 't_k_';
                if ( ! $suffix)
                    $suffix = '_status';
                break;
            case 'raw':
            default:
                $prefix = '';
                $suffix = '';
                break;
        }

        return $prefix . $ins_name . $suffix;
    }
} else dd('function table_name exists.' . __FILE__ . ':' . __LINE__);

/* ================= debug ==================== */

if ( ! function_exists('db_c'))
{
    function db_c($ins_name, $ins_type, $d)
    {
        $d['created_at'] =\Carbon\Carbon::now()->toDateTimeString();
        $d['updated_at'] =\Carbon\Carbon::now()->toDateTimeString();
        DB::table(table_name($ins_name, $ins_type))->insert($d);
    }
} else dd('function db_c exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('k_exists'))
{
    function k_exists($ins_name, $k_name, $v)
    {
        $ins = kvIns($ins_name);
        $cond = [
            //d('db.ins_id')   => ,
            d('db.key_name')   => $k_name,
            d('db.value_name') => $v
        ];
        return $ins->where($cond)->exists();
    }
} else dd('function k_exists exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('filter_by_field'))
{
    function filter_by_field($d, $ins_name, $ins_type='i')
    {
        $fields = Schema::getColumnListing(table_name($ins_name, $ins_type));
        return array_only($d, $fields);
    }
} else dd('function filter_by_field exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('table_fields'))
{
    function table_fields($ins_name, $ins_type)
    {
        return Schema::getColumnListing(table_name($ins_name, $ins_type));
    }
} else dd('function table_fields exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('fillable_fields'))
{
    function fillable_fields($ins_name, $d, $ins_type='i')
    {
        return array_only($d,
            Schema::getColumnListing(table_name($ins_name, $ins_type)));
    }
} else dd('function fillable_fields exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('fillable_fields_kv'))
{
    function fillable_fields_kv($ins_name, $d)
    {
        $ins = M($ins_name, 'tk');
        //$all_types = $ins->select(d('db.type_name'))->get()->toArray()[0];
        $all_keys = $ins->get()->pluck(d('db.type_name'))->toArray();
        if(!$all_keys) return false;
        $fillable = array_only($d, $all_keys);
        return $fillable;
    }
} else dd('function fillable_fields_kv exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('db_log'))
{
    function db_log()
    {
        return DB::getQueryLog();
    }
} else dd('function db_log exists.' . __FILE__ . ':' . __LINE__);



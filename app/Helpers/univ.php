<?php

if ( ! function_exists('api_version'))
{
    function api_version()
    {
        return API_VERSION;
    }
} else dd('function api_version exists.' . __FILE__ . ':' . __LINE__);


/*get current request*/
if ( ! function_exists('rq'))
{
    /**
     * Return specified element of Request.
     * Return all items of Request if empty parameter.
     *
     * @param null $ele
     *
     * @return array
     */
    function rq($ele = null)
    {
        if ( ! $ele) return Request::all();
        return Request::get($ele);
    }
} else
{
    dd('function rq exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('rqOnly'))
{
    /**
     * Only return request items specified.
     *
     * @param $arr array
     *
     * @return mixed
     */
    function rqOnly($arr)
    {
        return Request::only($arr);
    }
} else dd('function rqOnly exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('rqHas'))
{
    /**
     * Check if specified element exists in a request.
     *
     * @param $name
     *
     * @return bool
     */
    function rqHas($name)
    {
        if (Request::has($name)) return true;
        return false;
    }
} else dd('function rqHas exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('is_master'))
{
    /**
     * Check to see if current user has the character
     * of master.
     *
     * @param string $master
     *
     * @return bool
     */
    function is_master($master = 'master')
    {
        $ch = his_chara();
        if (his_chara())
        {
            if (in_array($master, $ch))
            {
                return true;
            }
            return false;
        }
        return false;
    }
} else
{
    dd('function is_master exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('is_reg_model'))
{
    /**
     * Check to see if current user has the character
     * of model.
     *
     * @param string $model
     *
     * @return bool
     */
    function is_reg_model($model = 'reg_model')
    {
        $ch = his_chara();
        if (his_chara())
        {
            if (in_array($model, $ch))
            {
                return true;
            }
            return false;
        }
        return false;
    }
} else
{
    dd('function is_reg_model exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('is_reg_user'))
{
    /**
     * Check to see if current user has the character
     * of regular user.
     *
     * @param string $reg_user
     *
     * @return bool
     */
    function is_reg_user($reg_user = 'reg_user')
    {
        $ch = his_chara();
        if (his_chara())
        {
            if (in_array($reg_user, $ch))
            {
                return true;
            }
            return false;
        }
        return false;
    }
} else
{
    dd('function is_reg_user exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('is_logged_in'))
{

    /**
     * Check to see if current user is logged in.
     * @return bool
     */
    function is_logged_in()
    {
        if (Session::has('is_logged_in'))
            return true;
        return false;
    }
} else
{
    dd('function is_logged_in exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('is_billing_admin'))
{
    /**
     * Check to see whether current user is a finance.
     *
     * @param string $billing_admin
     *
     * @return bool
     */
    function is_billing_admin($billing_admin = 'billing_admin')
    {
        $ch = his_chara();
        if (his_chara())
        {
            if (in_array($billing_admin, $ch))
            {
                return true;
            }
            return false;
        }
        return false;
    }
} else
{
    dd('function is_billing_admin exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('is_reg_admin'))
{
    /**
     * Check to see if current user is regular admin.
     *
     * @param string $reg_admin
     *
     * @return bool
     */
    function is_reg_admin($reg_admin = 'reg_admin')
    {
        $ch = his_chara();
        if (his_chara())
        {
            if (in_array($reg_admin, $ch))
            {
                return true;
            }
            return false;
        }
        return false;
    }
} else
{
    dd('function is_reg_admin exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('ee'))
{
    /**
     * Use this function to return a error state of
     * a curtain method call.
     *
     *
     * @param string $type What kind of error
     * @param null $d Data to attach
     * @param int $status_num Error code, default 0.
     *
     * @return array             e.g. [ status => 0, d => some_data_to_attach ]
     */
    function ee($type, $d = null, $status_num = 0)
    {
        $es = [];
        $es['db_insert_failed'] = $es[1] = 'db_insert_failed';
        $es['invalid_argument'] = $es[2] = 'invalid_argument';
        $es['api_error'] = $es[3] = 'api_error';
        $es['invalid_state'] = $es[4] = 'invalid_state';
        $es['insufficient_permission'] = $es[5] = 'insufficient_permission';
        $es['wrong_request_method_type'] = $es[6] = 'wrong_request_method_type';
        $es['db_delete_failed'] = $es[7] = 'db_delete_failed';
        $es['db_update_failed'] = $es[8] = 'db_update_failed';
        $es['record_conflict'] = 'record_conflict';
        $es['invalid_fields'] = 'invalid_fields';
        $es['token_mismatch'] = 'token_mismatch';
        $es['missing_parent_id'] = 'missing_parent_id';

        if ( ! empty($es[$type]) && (is_string($type) || is_numeric($type)))
            $data['reason'] = $es[$type];
        else
            $data['reason'] = $type;

        $data['additional_info'] = $d;
        $data['request_data'] = rq();

        if (debugging())
        {
            $data['session'] = sess();
        }

        return [
            'status' => $status_num,
            'd'      => $data,
        ];
    }
} else
{
    dd('function ee exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('ss'))
{
    /**
     * Use this function to return a error state of
     * a curtain method call.
     *
     * @param mixed $data Data to attach.
     * @param int $status_num Error code, default 1.
     *
     * @return array             e.g. [ d => some_data_to_attach status => 1,  ]
     */
    function ss($data = null, $status_num = 1)
    {
        return [
            'status' => $status_num,
            'd'      => $data,
        ];
    }
} else
{
    dd('function ss exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('makeLogKvData'))
{
    /**
     * Specify what to log.
     *
     * @param      $kvArr
     * @param null $ins
     *
     * @return array
     */
    function makeLogKvData($kvArr, $ins = null)
    {
        if ( ! $ins) $logData = [];
        else
        {
            $insArr = $ins->toArray();
            $logData = $insArr['kvs'];
        }
        foreach ($kvArr as $k => $v)
        {
            $logData[] = ['k' => $k, 'v' => $v];
        }

        return $logData;
    }
} else
{
    dd('function makeLogKvData exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('cUser'))
{
    /**
     * Return instance of current user if current user is logged in,
     * else return error state;
     * @param $with
     * @return object
     */
    function cUser($with = [])
    {
        if ( ! is_logged_in())
            return ee(4);

        $userIns = M('user');
        if ($with)
        {
            foreach ($with as $w)
            {
                $userIns = $userIns->with($w);
            }
        }
        $userIns = $userIns->find(uid());
        return $userIns;
    }
} else
{
    dd('function cUser exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('debugging'))
{
    /**
     * Detect whether app is in debug mode.
     * @return bool
     */
    function debugging()
    {
        if (Config::get('app.debug'))
            return true;
        return false;
    }
} else dd('function debugging exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('M'))
{
    /**
     * Return model instance.
     * You can pass an instance name (not model class name) like: 'user'
     * it would return an instance of IUser.
     * `M('user')` is equivalent to `new App\Models\IUser();`
     * `M('user', 'kv')` is equivalent to `new App\Models\KvUser();`
     *
     * @param        $insName
     * @param string $type
     * @param bool $onlyClassName
     *
     * @return string
     */
    function M($insName, $type = 'i', $data = null, $onlyClassName = false)
    {
        $className = MName($insName, $type);
        if ($onlyClassName)
            return $className;
        if ($data)
            return new $className($data);
        if (class_exists($className))
            return new $className;
        return false;
    }

} else dd('function M exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('C'))
{
    /**
     * Controller name
     * @param $name
     * @param bool $type
     * @return string
     */
    function C($name, $type = false)
    {
        if ( ! $type)
            $s = ucfirst($name) . ucfirst(d('controller'));
        else
            $s = ucfirst($name) . ucfirst(d('controller'));
        return $s;
    }
} else dd('function C exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('mmData'))
{
    /**
     * Model Meta Data
     * Get data form t_* tables;
     *
     * @param        $modelNameSingular
     * @param        $without
     * @return array
     */
    function mmData($modelNameSingular, $without = [])
    {
        foreach (wolf('model_types') as $t)
        {
            $modelName = MName($modelNameSingular, $t);
            if ( ! class_exists($modelName) ||
                in_array($t, $without) ||
                ! starts_with($t, wolf('m_t'))
            ) continue;
            $frontModelName = camel_case(class_basename($modelName));
            $data[$frontModelName] = $modelName::all()->toArray();
        }
        if ($data) return ss($data);
        return ee('invalid_argument', func_get_args());
    }
} else dd('function mmData exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('newIns'))
{
    /**
     * @param        $insName
     * @param        $vals
     * @param string $kvTablePrefix
     * @param string $tKTablePrefix
     *
     * @return array
     */
    function newIns($insName, $vals, $withKvs = true, $kvTablePrefix = 'Kv', $tKTablePrefix = 'TK')
    {
        $ins = M($insName);
        $ins->fill($vals);
        $r = $ins->save();
        $ins->touch();
        if ($r)
        {
            if ($withKvs)
            {
                $kvIns = kvIns($insName);
                $tkIns = tkIns($insName);
                $primaryKey = $insName . '_id';

                $dataToKv = [];
                $allTk = $tkIns->get();
                //            dd($allTk->toArray());
                switch ($insName)
                {
                    case 'user':
                        foreach ($allTk as $tk)
                        {
                            $dataToKv[] = [
                                'k'          => $tk->type_name,
                                'v'          => '',
                                $primaryKey  => $ins->$primaryKey,
                                'datatype'   => $tk->datatype,
                                't_group_id' => $tk->group_id,
                                'status_id'  => $tk->status_id,
                            ];
                        }
                        break;
                    default:
                        foreach ($allTk as $tk)
                        {
                            $dataToKv[] = [
                                'k'         => $tk->type_name,
                                'v'         => '',
                                $primaryKey => $ins->$primaryKey,
                            ];
                        }
                        break;
                }

                $rr = $kvIns->insert($dataToKv);
                if ($rr) return ss($ins);
                return ee('db_insert_failed');
                dd($allTk);
            }
        }
        return $r ? ss($ins) : ee(1);
    }
} else dd('function newIns exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('MName'))
{
    /**
     * Get model name from ins name;
     * e.g.
     * MName('user', 't') would return 'TUser'
     * MName('user', 'tk') would return 'TKUser'
     * MName('user', 'kv') would return 'KvUser'
     *
     * @param $ins_name
     * @param $type
     * @param $prefix
     * @param $suffix
     * @param $modelNamespace
     *
     * @return string       model name
     */
    function MName($ins_name, $type = 'i', $prefix = null, $suffix = null, $modelNamespace = 'Models')
    {
        if ($type)
            switch ($type)
            {
                case 'i':
                    if ( ! $prefix) $prefix = 'I';
                    break;
                case 'v':
                    if ( ! $prefix) $prefix = 'V';
                    break;
                case 't':
                    if ( ! $prefix) $prefix = 'T';
                    break;
                case 'tk':
                    if ( ! $prefix) $prefix = 'TK';
                    break;
                case 'kv':
                    if ( ! $prefix) $prefix = 'Kv';
                    break;
                case 'ts':
                    if ( ! $prefix)
                        $prefix = 'T';
                    if ( ! $suffix)
                        $suffix = 'Status';
                    break;
                case 'tks':
                    if ( ! $prefix)
                        $prefix = 'TK';
                    if ( ! $suffix)
                        $suffix = 'Status';
                    break;
                case 'raw':
                default:
                    $prefix = '';
                    $suffix = '';
                    break;
            }
        return 'App\\' . $modelNamespace . '\\' . $prefix . studly_case($ins_name) . $suffix;
    }
} else dd('function MName exists.' . __FILE__ . ':' . __LINE__);

//if (!function_exists('table_name'))
//{
//    function table_name($ins_name, $type=null)
//    {
//        if(! $type || $type='i')
//            return d('ins_') . $ins_name;
//
//        switch($type)
//        {
//            case 't':
//                return d('db.type_');
//            case 'k':
//                return d('db.key_');
//            case 'kv':
//                return d('db.key_value_');
//            case '':
//                return d('db.key_value_');
//        }
//    }
//} else dd('function table_name exists.' . __FILE__ . ':' . __LINE__);


if ( ! function_exists('tmap'))
{
    function tmap($type_name)
    {
        $id = Config::get('tmap.' . $type_name);
        return $id;
    }
} else dd('function tmap exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('authGet'))
{
    function authGet($ins)
    {
        if (is_master())
        {
            return $ins->all();
        }
        //if(is_admin())
        //{
        //    //$ins = $ins->where()
        //}
        return $ins->where(d('status_id'), tmap('setting_status.public'));
    }
} else dd('function authGet exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('is_admin'))
{
    function is_admin($type_name = 'reg_admin')
    {
        $ch = his_chara();
        if (his_chara())
        {
            if (in_array($type_name, $ch))
            {
                return true;
            }
            return false;
        }
        return false;
    }

} else dd('function is_admin exists.' . __FILE__ . ':' . __LINE__);


if ( ! function_exists('kvIns'))
{
    function kvIns($insName)
    {
        return M($insName, 'kv');
    }
} else dd('function kvIns exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('tkIns'))
{
    function tkIns($insName)
    {
        return M($insName, 'tk');
    }
} else dd('function tkIns exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('idName'))
{
    /**
     * user ==> user_id
     * @param $insName
     * @param string $idSuffix
     * @return bool|string
     */
    function idName($insName, $idSuffix = '_id')
    {
        if ( ! $insName) return false;
        return strtolower($insName) . $idSuffix;
    }
} else dd('function idName exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('typeIdName'))
{
    function typeIdName($insName, $prefix = 't_')
    {
        return $prefix . idName($insName);
    }
} else dd('function typeIdName exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('echoL'))
{
    function echoL($str)
    {
        echo $str . '<br>';
    }
} else dd('function echoL exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('u_'))
{
    /**
     * Update a kv record or create new kv record
     *
     * @param string $kvs
     * @param string $kv_id
     * @param string $kName
     * @param string $vName
     *
     * @return array
     */
    function u_($kvs = 'kvs', $kv_id = 'kv_id', $kName = 'k', $vName = 'v')
    {
        //                dd(rq());
        $insName = rq('insName');
        $insId = rq('insId');
        $k = rq('k');
        $v = rq('v');
        $tableType = rq('tt');
        $ins = M($insName);

        //        dd(rq());
        if ($insName && $k && is_string($v) || is_numeric($v))
        {
            if (rq('datatype') === 'date' || rq('datatype') === 'datetime')
            {
                $v = \Carbon\Carbon::parse($v);
            }

            if (rq('datatype') === 'number')
            {
                if ( ! is_numeric($v)) return ee(2, 'is_not_numeric');
            }
            $idName = $kv_id;
            $insId = rq($kv_id);
            if ($tableType === 'kv')
            {
                //                dd($idName, $insId);
                $idName = 'kv_id';
                $ins = M($insName, 'kv')
                    ->where($idName, $insId)
                    ->firstOrFail();
                //                dd($ins->toArray());
                $ins->$vName = $v;
                $r = $ins->save();
                return $r ? ss() : ee('db_insert_failed');
            }

        } else if ($insId)
        {

        }
        return ee(2);
        //            $r = $ins->fill($data)->save();
        //            $ins->touch();
        //
        //            if ($r)
        //                return $r ? ss(['id' => $id]) : ee('db_insert_failed');
        //            dd($ins->toArray());

        //            $kv = $ins->$kvs()
        ////                ->where(idName('user'), $insId)
        //                ->where(idName('user'), $insId)
        //                ->whereHas('kvs', function($q) use ($data)
        //                {
        //                    $q->where($kName, '')
        //                })
        //                ->firstOrNew($data);
        //            $kv->$vName = $v;
        //            $r = $kv->save();
        //

    }

} else dd('function u_ exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('makePath'))
{
    function makePath($pathname, $mode = 0775, $recursive = true)
    {
        if ( ! file_exists($pathname))
            return File::makeDirectory($pathname, $mode, $recursive);
        return true;
    }
} else dd('function makePath exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('rqFile'))
{
    function rqFile($name)
    {
        if ( ! Request::hasFile($name)) return false;
        return Request::file($name);
    }
} else dd('function rqFile exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('wolf'))
{
    function wolf($segment = '', $ignoreCase = false)
    {
        if (empty($segment))
            return Config::get('constants.wolf');
        else
            $segment = $segment = $ignoreCase ? $segment : strtoupper($segment);
        return Config::get('constants.wolf.' . $segment);
    }
} else dd('function wolf exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('d'))
{
    /**
     * dictionary
     * @param $word
     * @return mixed
     */
    function d($word)
    {
        $word = (String)$word;

        $r = Config::get('dict' . DOT . $word);

        if ( ! $r) die('word ' . $word . ' not found in dict');

        return $r;
    }
} else dd('function d exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('sheep'))
{
    function sheep($segment = '', $ignoreCase = false)
    {
        if (empty($segment))
            return Config::get('constants.sheep');
        else
            $segment = $ignoreCase ? $segment : strtoupper($segment);
        return Config::get('constants.sheep.' . $segment);
    }
} else dd('function sheep exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('R'))
{
    function R($insName, $conds)
    {
        if (is_string($insName) && is_array($conds))
        {
            $ins = M($insName);

            if ( ! empty($cond['reverse']) && $cond['reverse'] === 'desc')
                $sc = 'desc';
            else
                $sc = 'asc';


            if (empty($conds['where']) && empty($conds['whereOr']))
            {
                forEach ($conds as $cond)
                {
                    $ins = $ins->where($cond);
                }
            }

            if ( ! empty($conds['where']))
            {
                forEach ($conds as $cond)
                {
                    $ins = $ins->where($cond);
                }
            }

            if ( ! empty($conds['whereOr']))
            {
                forEach ($conds as $cond)
                {
                    $ins = $ins->whereOr($cond);
                }
            }

            if (is_numeric($conds['limit']))
            {
                $ins = $ins->take($conds['limit']);
            }

            if ( ! empty($conds['orderBy']))
            {
                $ins = $ins->orderBy($conds['orderBy'], $sc);
            }

            return $ins->get();
        }
        return ee(2);
    }
} else dd('function R exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('saveFiles'))
{
    function saveFiles($files, $fileType)
    {
        switch ($fileType)
        {
            case 'image':
                $imageIns = M('image');
                $images = $imageIns->makeImages($files);
                return $imageIns->saveImages($images);
                break;
        }
    }
} else dd('function saveFiles exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('timeDir'))
{
    function timeDir($nestArr = ['year', 'month', 'day'])
    {
        $now = \Carbon\Carbon::now();
        $dirName = '';
        foreach ($nestArr as $n)
        {
            $dirName .= sprintf("%02d", $now->$n) . '/';
        }
        return $dirName;
    }
} else dd('function timeDir exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('makeUploadDir'))
{
    function makeUploadDir($fileType, $storageType = 'user')
    {
        $dir = timeDir();
        switch ($fileType)
        {
            case 'image':
                $segment1 = wolf('IMAGE_LOCAL_PATH');
                break;
            case 'video':
                $segment1 = wolf('VIDEO_LOCAL_PATH');
                break;
        }
        switch ($storageType)
        {
            case 'user':
                $segment2 = 'user/';
                break;
        }
        $path = $segment1 . $segment2 . $dir;
        makePath($path);
        return ['segment' => $dir, 'whole' => $path];
    }
} else dd('function makeUploadDir exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('timeFileName'))
{
    function timeFileName($extension)
    {
        return uniqid() . 'lala' . str_replace('.', '', str_replace(' ', '.', microtime())) . '.' . $extension;
    }
} else dd('function timeFileName exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('logIt'))
{
    function logIt($meta, $kvs = [])
    {
        if (empty($meta)) return ee(2);

        if (is_string($meta))
        {
            $metaData['type'] = $meta;
            $metaData['c_usertoken'] = username();
            $metaData['ip_address'] = Request::getClientIp();
        } else if (is_array($meta))
        {
            if (empty($meta['type']))
                return ee(2);

            if (empty($meta['c_usertoken']))
                $meta['c_usertoken'] = username();

            if (empty($meta['ip_address']))
                $meta['ip_address'] = Request::getClientIp();

            $metaData = $meta;
        } else return ee(2);

        if ( ! empty($kvs))
        {
            $kvs = makeLogKvData($kvs);
        }

        $logIns = M('log');
        $logIns->makeLog($metaData, $kvs);
    }
} else dd('function logIt exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('stsS'))
{
    /**
     * @return array    ['status' => 'success']
     */
    function stsS()
    {
        return [sheep('sts') => sheep('s')];
    }
} else dd('function stsS exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('stsF'))
{
    /**
     * @return array    ['status' => 'fail']
     */
    function stsF()
    {
        return [sheep('sts') => sheep('f')];
    }
} else dd('function stsF exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('logCUserOut'))
{
    function logCUserOut()
    {
        \Session::flush();
    }
} else dd('function logCUserOut exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('refreshSiteSettings'))
{
    function refreshSiteSettings()
    {
        $ins = M('site_setting');
        $settings = $ins::all();
        foreach ($settings as $s)
        {
            Config::set('constants.sheep.settings.' . $s->k, $s->v);
        }

        return $settings;
    }
} else dd('function refreshSiteSettings exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('refreshSiteMessages'))
{
    function refreshSiteMessages()
    {
        $m = M('message_template');
        $messages = $m::all();
        foreach ($messages as $m)
        {
            Config::set('constants.sheep.messages.' . $m->message_name, array_only($m->toArray(), ['message_name', 'title', 'body']));
        }
    }
} else dd('function refreshSiteMessages exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('getVWithIns'))
{
    function getVWithIns($insName, $pk, $k)
    {
        $ins = M($insName);
        $r = $ins->with(['kvs' => function ($q) use ($k)
        {
            $q->where(
                ['k' => $k,]
            )->firstOrFail();
        }])->findOrFail($pk);

        return $r;
    }
} else dd('function getVWithIns exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('getV'))
{
    function getV($insName, $pk, $k)
    {
        $r = getVWithIns($insName, $pk, $k);
        $r = $r->kvs[0]['v'];
        return $r;
    }
} else dd('function getV exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('setV'))
{
    function setV($insName, $pk, $k, $v)
    {
        $kName = sheep('k');
        $vName = sheep('v');

        $ins = M($insName, 'kv')->where([idName($insName) => $pk, $kName => $k])->firstOrFail();
        $ins->$vName = $v;
        $r = $ins->save();
        $ins->touch();

        return $r ? ss($ins) : ee(1);
    }
} else dd('function setV exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('refreshKs'))
{
    function refreshKs($insName)
    {
        $kvInsColl = M($insName)->with(sheep('kvs'))->get();
        $kInses = M($insName, 'tk')->get()->toArray();
        $newKvsIns = [];
        foreach ($kvInsColl as $ins)
        {
            $insKvArr = $ins->kvs->toArray();
            $currentKeys = array_pluck($insKvArr, 'k');
            foreach ($kInses as $k)
            {
                if ( ! in_array($k['type_name'], $currentKeys))
                {
                    $newKvsIns[] = M($insName, 'kv',
                        [
                            'k'          => $k['type_name'],
                            'v'          => '',
                            'datatype'   => $k['datatype'],
                            't_group_id' => $k['group_id'],
                            'status_id'  => $k['status_id'],
                        ]);
                }
            }
            $ins->kvs()->saveMany($newKvsIns);
            $ins->kvs()->touch();
            $newKvsIns = [];
        }
    }
} else dd('function refreshKs exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('getKs'))
{
    function getKs($insName, $typename = 'type_name')
    {
        $r = M($insName, 'tk')->get();
        return $r->lists($typename);
    }
} else dd('function getKs exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('uBalance'))
{
    function uBalance($userId, $balance = 'balance')
    {
        return (int)getV('user', $userId, $balance);
    }
} else dd('function uBalance exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('l'))
{
    /**
     * equevilent to trans();
     * @param null $id
     * @param array $parameters
     * @param string $domain
     * @param null $locale
     *
     * @return mixed
     */
    function l($id = null, $parameters = [], $domain = 'messages', $locale = null)
    {
        return call_user_func_array("trans", func_get_args());
    }
} else dd('function l exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('has_keys'))
{
    function has_keys($arr, $required_keys)
    {
        if (count(array_intersect_key(array_flip($required_keys), $arr)) === count($required_keys))
            return true;
        return false;
    }
} else dd('function has_keys exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('php_reg'))
{
    function php_reg($regex_string)
    {
        return '/' . $regex_string . '/';
    }
} else dd('function php_reg exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('captcha_name'))
{
    function captcha_name()
    {
        return uniqid('captcha_') . '_' . rand(1, 99999);
    }
} else dd('function captcha_name exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('captcha_url'))
{
    function captcha_url()
    {
        return A . '/img/captcha/';
    }
} else dd('function captcha_url exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('s_to_m'))
{
    function s_to_m($seconds)
    {
        return $seconds / 60;
    }
} else dd('function s_to_m exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('m_to_s'))
{
    function m_to_s($minutes)
    {
        return $minutes * 60;
    }
} else dd('function m_to_s exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('his_captcha_data'))
{
    function his_captcha_data()
    {
        $d = sess('him.captcha_data');
        if ($d)
            return sess('him.captcha_data');
        return 0;
    }
} else dd('function his_captcha_data exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('cook'))
{
    function cook($segs)
    {
        return url('$/' . $segs);
    }
} else dd('function cook exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('shot'))
{
    function shot($segs)
    {
        return url('_/' . $segs);
    }
} else dd('function shot exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('lang_path'))
{
    function lang_path()
    {
        return base_path() . SLASH . 'resources' . SLASH . 'lang' . SLASH . conf('app.locale') . SLASH;
    }
} else dd('function lang_path exists.' . __FILE__ . ':' . __LINE__);

//if ( ! function_exists('shot'))
//{
//    function shot($segs)
//    {
//        return base_url() . url('_/' . $segs);
//    }
//} else dd('function shot exists.' . __FILE__ . ':' . __LINE__);
//
//if ( ! function_exists('cook'))
//{
//    function cook($segs)
//    {
//        return base_url() . url('$/' . $segs);
//    }
//} else dd('function cook exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('hash_password'))
{
    function hash_password($password)
    {
        $hashed = $password ? md5(md5(HASH_SEED . $password) . HASH_SEED) : false;
        return $hashed;
    }
} else dd('function hash_password exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('locations'))
{
    function locations()
    {
        return require(app_path() . '/../storage/location.php');
    }
} else dd('function locations exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('city'))
{
    function city($id)
    {
        $locations = locations();
        foreach ($locations['city'] as $city)
        {
            if ($city['id'] == $id)
            {
                return $city['name'];
            }
        }
        return null;
    }
} else dd('function city exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('province'))
{
    function province($id)
    {
        $locations = locations();
        foreach ($locations['province'] as $province)
        {
            if ($province['id'] == $id)
            {
                return $province['name'];
            }
        }
        return null;
    }
} else dd('function city exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('arr_except_vals'))
{
    function arr_except_vals($array, $values)
    {
        foreach ($values as $value)
        {
            foreach ($array as $k => $v)
            {
                if ($value === $v)
                {
                    unset($array[$k]);
                }
            }
        }
        return $array;
    }
} else dd('function city exists.' . __FILE__ . ':' . __LINE__);


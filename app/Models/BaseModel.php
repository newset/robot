<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

use Validator, Schema, Carbon\Carbon;

class BaseModel extends Model
{
    //use SoftDeletes;

    public $model;

    public $defaultOrderRule = 'id asc';
    //protected $softDelete = true;

    /**
     * The validator rule
     */
    public $createRule = [];
    public $updateRule = [];

    public $messages = [
        'required' => '字段:attribute不能为空.',
        'unique' => '字段:attribute值已被占用.',
    ];

    public function __construct($prefix = 'i')
    {
        $this->table = table_name($this->ins_name, $prefix);

        // dd($this->table, $prefix);
    }

    public function ruler()
    {
        return $this->createRule;
    }

    /**
     * @return array of all fields.
     */
    public function all_fields()
    {
        return Schema::getColumnListing($this->table);
    }

    /**
     * 把Model安全的字段返回给前台
     */
    public function getSafeColumns($model = null)
    {
        if ($model)
        {
            foreach ($this->guarded as $coloum)
            {
                if ($coloum != 'id')
                {
                    $model->$coloum = null;
                }
            }
            return $model;
        } else
        {
            foreach ($this->guarded as $coloum)
            {
                if ($coloum != 'id')
                {
                    $this->$coloum = null;
                }
            }
        }
    }

    /**
     * 创建和更新
     */
    public function cu($rq = null)
    {
        if ( ! $rq)
            $rq = rq();


        if ( ! empty($rq['id']))
        {
            if ($ins = $this->findOrFail($rq['id']))
            {
                return $this->u($rq);
            } else
            {
                return $this->c($rq);
            }
        } else
        {
            return $this->c($rq);
        }
    }

    /**
     * 创建
     */
    public function c($rq = null)
    {
        if ( ! $rq)
        {
            $rq = rq();
        }
        $validator = Validator::make($rq, $this->createRule, $this->messages);

        if ($validator->passes())
        {
            $d = array_only($rq, $this->all_fields());
            $this->fill($d);

            if ($this->save())
            {
                $this->eventFire('c');
                $this->assignRelateData();
                $this->getSafeColumns();
                return ss($this);
            } else
            {
                return ee(1);
            }
        } else
        {
            return ee(2, $validator->errors());
        };
    }

    /**
     * 更新
     */
    public function u($rq = null)
    {
        if ( ! $rq)
            $rq = rq();

        $validator = Validator::make($rq, $this->updateRule);

        if ($validator->passes())
        {
            $ins = $this->findOrFail($rq['id']);

            $d = array_only($rq, $this->all_fields());

            if (rq('password'))
            {
                if (empty($d['password'])){
                    unset($d['password']);
                }
                else{
                    $ins->password = $d['password'];
                }
            }

            if ( ! empty($d['updated_at'])) unset($d['updated_at']);
            if ( ! empty($d['created_at'])) unset($d['created_at']);

            $date_input = $this->get_all_date_type();
            $date_input = $this->prepare_date_fields($date_input);
            $d = array_merge($d, $date_input);

            $ins->fill($d);

            if ($ins->save())
            {
                $ins->eventFire('u');
                $ins->assignRelateData();
                $ins->getSafeColumns();
                return ss($ins, 0);
            } else
            {
                return ee(8);
            }
        } else
        {
            return ee(2, $validator->errors());
        };
    }

    public function prepare_date_fields(Array $dates)
    {
        foreach ($dates as $k => $v)
        {
            $dates[$k] = Carbon::parse($v);
        }
        return $dates;
    }

    /**
     * 删除
     */
    public function d()
    {
        $r = $this->findOrFail(rq('id'))->delete();

        //$ins->deleted_timestam = time();
        //if ($ins->save())
        //{
        //    $ins->eventFire('d');
        //    $ins->assignRelateData();
        //    $ins->getSafeColumns();
        //    return ss($ins);
        //} else
        //{
        //    return ee(7);
        //}
        return $r?  ss($r):ee();
    }

    public function r_builder($in = null)
    {
        $rq = $in ? $in : rq();
        $builder = $this;

        if ( ! empty(rq('relation')))
        {
            if (is_string($rq['relation']))
            {
                $builder = $builder->with($rq['relation']);
            } elseif (is_array($rq['relation']))
            {
                foreach ($rq['relation'] as $rel)
                {
                    $builder = $builder->with(/*[*/$rel/* => function($q)
                    {
                        $q->whereNull('deleted_at');
                    }]*/);
                }
            }
        }

        if ( ! empty(rq('where')))
        {
            $where = $rq['where'];
            foreach ($where as $k => $v)
            {
                if ($k == 'password')
                {
                    $where[$k] = hash_password($v);
                }
            }

            $builder = $builder->where($where);
        }

        if ( ! empty(rq('whereLike')))
        {
            $where = $rq['whereLike'];
            foreach ($where as $k => $v)
            {
                $builder = $builder->where($k, 'like', '%'.$v.'%');
            }
        }

        // whereIn
         if ( ! empty(rq('whereIn')))
        {
            $where = $rq['whereIn'];
            foreach ($where as $k => $v)
            {
                $builder = $builder->where($k, 'in', $v);
            }

        }

        if ( ! empty(rq('super_where')))
        {
            foreach ($rq['super_where'] as $wh)
            {
                if ( ! empty($wh['key']) && ! empty($wh['val']))
                {
                    $wh['operator'] = ! empty($wh['operator']) ? $wh['operator'] : '=';
                    $wh['boolean'] = ! empty($wh['boolean']) ? $wh['boolean'] : 'and';
                    $builder = $builder->where($wh['key'], $wh['operator'], $wh['val'], $wh['boolean']);
                }
            }
        }

        if ( ! empty(rq('where_has')))
        {
            foreach ($rq['where_has'] as $relation => $cond)
            {
                $builder = $builder->whereHas($relation, function ($q) use ($cond)
                {
                    $q->where($cond);
                });
            }
        }

        if ( ! empty(rq('super_where_has')))
        {
            foreach ($rq['super_where_has'] as $wheres)
            {
                foreach ($wheres as $relation => $cond)
                {
                    $builder = $builder->whereHas($relation, function ($q) use ($cond)
                    {
                        if ( ! empty($cond['key']) && ! empty($cond['val']))
                        {
                            $cond['operator'] = ! empty($cond['operator']) ? $cond['operator'] : '=';
                            $cond['boolean'] = ! empty($cond['boolean']) ? $cond['boolean'] : 'and';
                            $q->where($cond['key'], $cond['operator'], $cond['val'], $cond['boolean']);
                        }
                    });
                }
            }
        }

        if ( ! empty(rq('order_by')))
        {
            $builder = $builder->orderByRaw($rq['order_by']);
        } else
        {
            $builder = $builder->orderBy('created_at', 'desc');
            //$builder = $builder->orderBy('id', 'desc');
        }

        return $builder;
    }

    public function p_builder($builder)
    {
        $rq = rq();
        $default_limit = 50;

        if (rq('id'))
        {
            $ret = $builder->findOrFail($rq['id']);
        }

        if ( ! empty(rq('pagination')))
        {
            $limit = ! empty(rq('limit')) ? $rq['limit'] : $default_limit;
            $pagin = $rq['pagination'];

            $builder = $builder
                ->skip($limit * ($pagin - 1));
        }


        if (is_numeric(rq('limit')))
        {
            if ($rq['limit'] == 0)
            {
                $builder = $builder;
            } else
                $builder = $builder->take($rq['limit']);
        } else
            $builder = $builder->take($default_limit);

        return $builder;
    }

    /**
     * 查询
     *
     * 携带 id 查询单条记录
     * 不携带 id 查询所有记录
     */
    public function r()
    {
        DB::enableQueryLog();

        $builder = $this->r_builder(rq());

        // 先获取统计
        $count = $builder->count();

        $builder = $this->p_builder($builder);
        $builder = $builder->whereNull('deleted_at');
        $main = isset($ret) ? $ret : $builder->get()->toArray();
        //$date_fields = $this->get_all_date_type($main);
        $r = [
            'main'  => $main,
            'count' => $count
        ];

        return ss($r);
    }

    /**
     * 查询某个字段是否存在某个值
     */
    public function getDoesExistValue()
    {
        $rq = rq();
        if ( ! empty($rq['col']) && ! empty($rq['val']))
        {
            $where[$rq['col']] = $rq['val'];
            $ret = $this->where($where)->get();
            if ($ret->count())
            {
                return ss(true);
            } else
            {
                return ss(false);
            }
        } else
        {
            return ee(2);
        }
    }

    public function get_all_date_type(array $collection = [])
    {
        if (empty($collection))
            $collection = rq();

        $needle = '_at';
        $matches = [];
        foreach ($collection as $k => $v)
        {
            if (preg_match('/^.+' . $needle . '$/i', $k))
            {
                if (empty($v)) continue;
                $matches[$k] = $v;
            }
        }
        return $matches;
    }

    /**
     * 为CURD提供关联数据
     */
    public function assignRelateData()
    {
        //
    }

    /**
     * 触发事件
     */
    public function eventFire($eventName)
    {
    }

    /**
     * 整理排序规则
     */
    public function orderHandle($buider, array $orders)
    {
        $orders = array_only($orders, $this->all_fields());
        foreach ($orders as $col => $direction)
        {
            $buider = $buider->orderBy($col, $direction);
        }
        return $buider;
    }

    /**
     * 整理查询条件
     *
     * @todo 处理or && like
     */
    public function whereHandle($buider, array $wheres)
    {
        foreach ($wheres as $k => $where)
        {
            if (in_array($where['key'], $this->all_fields()))
            {
                if (empty($where['boolean']) || $where['boolean'] !== 'or' || $where['boolean'] !== 'and')
                {
                    $where['boolean'] = 'and';
                }
                $buider = $buider->where($where['key'], $where['operator'], $where['val'], $where['boolean']);
            }
        }
        return $buider;
    }


    public function doesInFields($col, $ins = null)
    {
        if (empty($ins))
        {
            return in_array($col, $this->all_fields());
        } else
        {
            return in_array($col, M($ins)->all_fields());
        }
    }

    public function exist($cond = null)
    {
        $cond = $cond ? $cond : rq();
        if (rq('ins_name') && rq('k') && rq('v'))
        {
            $ins = M($cond['ins_name']);

            $r = (int)$ins->where($cond['k'], $cond['v'])->exists();
            return ss($r);
        }
        return ee(2);
    }

    public function parse_mdb($dbName, $tName, $sql = null)
    {
        //$dbName = base_path() . '/storage/mdb/test.mdb';
        //$tName = "table1";

        if ( ! file_exists($dbName))
        {
            return ee(2, "Could not find database file.");
        }

        $conn = odbc_connect("Driver={Microsoft Access Driver (*.mdb)};Dbq=$dbName; ", '', '');

        $sql = $sql ? $sql : "SELECT * FROM $tName";

        $rs = odbc_exec($conn, $sql);

        if ( ! $rs)
        {
            exit("There is an error in the SQL!");
        }

        $data = array();
        $i = 0;

        while ($row = odbc_fetch_array($rs))
        {
            $data[$i] = $row;
            $i++;
        }

        odbc_close($conn);
        return $data;
    }

}

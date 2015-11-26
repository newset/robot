<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Input;
use DB;

class VMark extends IMark
{

    protected $guarded = ['id'];

    protected $ins_name = 'mark';

    public function __construct()
    {
        parent::__construct();
        $this->table = table_name($this->ins_name, 'v');
    }

    public function r_() {
        // if (he_is('agency')){
            return $this->__r_();
        // }
        $sql = 'select * from v_mark where 1=1 ';
        $where = [];

        if(Input::has('where.cust_id')) {
            $sql .= ' and v_mark.cust_id like ? ';
            $where[] = '%'.Input::get('where.cust_id').'%';
        }
        $status = Input::get('where.status');
        if(!empty($status)) {
            $id = array_map('intval',$status);
            $id = implode(",",$id);
            $sql .= ' and v_mark.status in ('.$id.') ';
        }
        //销售状态
        $selling_status = Input::get('where.sold');

        if(!empty($selling_status)) {
            $subtracted = array_map(function ($x) { return $x-1; } , $selling_status);
            $sub_sql = ' and sold in (' . implode(',', $subtracted).') ' ;
            $sql .= $sub_sql;
        }
        $agency_id = Input::get('where.agency_id');
        if ($agency_id) {
            $sql .= 'and v_mark.agency_id = ? ';
            $where[] = $agency_id;
        }

        $hospital_id = Input::get('where.hospital_id');
        if ($hospital_id) {
            $sql .= 'and v_mark.hospital_id = ? ';
            $where[] = $hospital_id;
        }

        $pagination = Input::get("pagination",1);
        $offset = 0;
        $perpage = 50;

        $result = DB::select(DB::raw($sql),$where);
        $r = [
            'count' => count($result),
            'main'  => array_slice($result,($pagination - 1) * $perpage,$perpage)
        ];

        return ss($r);

    }

    public function __r_()
    {
        if ( ! rq('where') && he_is('employee'))
            return $this->r();

        $builder = $this;
        $rq = rq();
        if (true)
        {
            if (he_is('agency'))
            {
              $builder = $builder->where('agency_id', uid());
            }

            $where = $rq['where'];

            if (!empty( $where['cust_id'])) {
                $builder = $builder->where('cust_id', 'like', '%'.$where['cust_id'].'%');
            }

            if ( ! empty($where['status_type_id']))
            {
                $status = $where['status_type_id'];
                switch ($status)
                {
                    case 1:
                        $builder = $builder->where(['used_at' => null, 'damaged_at' => null]);
                        break;
                    case 2:
                        $builder = $builder->whereNotNull('used_at')->where('damaged_at', null);
                        break;
                    case 3:
                        $builder = $builder->where('agency_id', '<>', 1);
                        break;
                    case 4:
                        $builder = $builder->whereNotNull('damaged_at');
                        break;
                    case 5:
                        $builder = $builder/*->whereNotNull('damaged_at')*/
                        ->whereNotNull('replacement_id');
                        break;
                }
            }

            $status = Input::get('where.status');
            if(!empty($status)) {
                $id = array_map('intval',$status);
                $other = array_diff($id, [2, -2]);
                $used = array_diff($id, $other);

                $sql =' 1=1 and (';
                if (!empty($other)) {
                    $sql .= 'status in ('.implode(',', $other).') ';
                }

                if (!empty($used) && !empty($other)) {
                    $sql .= ' or ';
                }
                if (!empty($used)) {
                    # code...
                    switch (array_sum($used)) {
                        case 0:
                            $sql .= ' (status =2)';
                            break;
                        case -2:
                            $sql .= '(status = 2 and doctor_id is not null)';
                            break;
                        case 2:
                            $sql .= '(status = 2 and doctor_id is null)';
                            break;
                        default:
                            break;
                    }
                }

                $sql .= ')';
                $builder = $builder->whereRaw($sql);
            }

            if ( ! empty($where['selling_status_type_id']))
            {
                $status = $where['selling_status_type_id'];
                switch ($status)
                {
                    case 1:
                        $builder = $builder->where('agency_id', 1);
                        break;
                    case 2:
                        $builder = $builder->where('agency_id', '<>', 1);
                        break;
                }
            }

            if ( ! empty($where['agency_name']))
            {
                $v = $where['agency_name'];
                $builder = $builder->where('agency_name', 'like', '%' . $v . '%');
            }

            if ( ! empty($where['agency_id']))
            {
                $v = $where['agency_id'];
                $builder = $builder->where('agency_id', '=', $v);
            }

            if ( ! empty($where['hospital_id']))
            {
                $v = $where['hospital_id'];
                $builder = $builder->where('hospital_id', '=', $v);
            }

            if ( ! empty($where['hospital_name']))
            {
                $v = $where['hospital_name'];
                $builder = $builder->where('hospital_name', 'like', '%' . $v . '%');
            }

            if ( ! empty($where['doctor_name']))
            {
                $v = $where['doctor_name'];
                $builder = $builder->where('doctor_name', 'like', '%' . $v . '%');
            }

            if ( ! empty($where['from_created_at']) && ! empty($where['to_created_at']))
            {
                $builder = $builder->where('created_at', '>=', Carbon::parse($where['from_created_at']));
                $builder = $builder->where('created_at', '<=', Carbon::parse($where['to_created_at']));
            } elseif ( ! empty($where['from_created_at']))
            {
                $builder = $builder->where('created_at', '>=', Carbon::parse($where['from_created_at']));
            } elseif ( ! empty($where['to_created_at']))
            {
                $builder = $builder->where('created_at', '<=', Carbon::parse($where['to_created_at']));
            }

            if ( ! empty($where['from_shipped_at']) && ! empty($where['to_shipped_at']))
            {
                $builder = $builder->where('shipped_at', '>=', Carbon::parse($where['from_shipped_at']));
                $builder = $builder->where('shipped_at', '<=', Carbon::parse($where['to_shipped_at']));
            } elseif ( ! empty($where['from_shipped_at']))
            {
                $builder = $builder->where('shipped_at', '>=', Carbon::parse($where['from_shipped_at']));
            } elseif ( ! empty($where['to_shipped_at']))
            {
                $builder = $builder->where('shipped_at', '<=', Carbon::parse($where['to_shipped_at']));
            }
            
            if ( ! empty($where['from_sold_at']) && ! empty($where['to_sold_at']))
            {
                $builder = $builder->where('sold_at', '>=', Carbon::parse($where['from_sold_at']));
                $builder = $builder->where('sold_at', '<=', Carbon::parse($where['to_sold_at']));
            } elseif ( ! empty($where['from_sold_at']))
            {
                $builder = $builder->where('sold_at', '>=', Carbon::parse($where['from_sold_at']));
            } elseif ( ! empty($where['to_sold_at']))
            {
                $builder = $builder->where('sold_at', '<=', Carbon::parse($where['to_sold_at']));
            }

            if ( ! empty($where['from_used_at']) && ! empty($where['to_used_at']))
            {
                $builder = $builder->where('used_at', '>=', Carbon::parse($where['from_used_at']));
                $builder = $builder->where('used_at', '<=', Carbon::parse($where['to_used_at']));
            } elseif ( ! empty($where['from_used_at']))
            {
                $builder = $builder->where('used_at', '>=', Carbon::parse($where['from_used_at']));
            } elseif ( ! empty($where['to_used_at']))
            {
                $builder = $builder->where('used_at', '<=', Carbon::parse($where['to_used_at']));
            }

            if ( ! empty($where['from_damaged_at']) && ! empty($where['to_damaged_at']))
            {
                $builder = $builder->where('damaged_at', '>=', Carbon::parse($where['from_damaged_at']));
                $builder = $builder->where('damaged_at', '<=', Carbon::parse($where['to_damaged_at']));
            } elseif ( ! empty($where['from_damaged_at']))
            {
                $builder = $builder->where('damaged_at', '>=', Carbon::parse($where['from_damaged_at']));
            } elseif ( ! empty($where['to_damaged_at']))
            {
                $builder = $builder->where('damaged_at', '<=', Carbon::parse($where['to_damaged_at']));
            }

            if ( ! empty($where['from_archive_at']) && ! empty($where['to_archive_at']))
            {
                $builder = $builder->where('archive_at', '>=', Carbon::parse($where['from_archive_at']));
                $builder = $builder->where('archive_at', '<=', Carbon::parse($where['to_archive_at']));
            } elseif ( ! empty($where['from_archive_at']))
            {
                $builder = $builder->where('archive_at', '>=', Carbon::parse($where['from_archive_at']));
            } elseif ( ! empty($where['to_archive_at']))
            {
                $builder = $builder->where('archive_at', '<=', Carbon::parse($where['to_archive_at']));
            }
            //归档状态
            if (!empty($where['archive'])){
                if (in_array(1, $where['archive'])  && !in_array(2, $where['archive'])){
                    $builder = $builder->whereNotNull('archive_at');
                }
                if (in_array(2, $where['archive']) && !in_array(1, $where['archive'])){
                    $builder = $builder->whereNull('archive_at');
                }
            }
            //销售状态
            if (!empty($where['sold'])){
                $total = array_sum($where['sold']);
                switch ($total) {
                    case 1:
                        $builder = $builder->where('hospital_id', '=', '-1')->where('agency_id', '=', -1);
                        break;
                    case 2:
                        $builder = $builder->where('agency_id', '>=', 1);
                        break;
                    case 3:
                        $builder = $builder->whereRaw('(agency_id >= 1 or (hospital_id = -1 and agency_id = -1))');
                        break;
                    case 4:
                        $builder = $builder->where('hospital_id', '>', 0);
                        break;
                    case 5:
                        $builder = $builder->whereRaw('(v_mark.hospital_id = -1 and v_mark.agency_id = -1 or v_mark.hospital_id>0)');
                        break;
                    case 6:
                        $builder = $builder->whereRaw('(v_mark.hospital_id = -1 and v_mark.agency_id > 1 or v_mark.hospital_id>0)');
                        break;
                    case 7:
                    default:
                        # code...
                        break;
                }
            }

            if ( ! empty($where['from_surgery_at']) && ! empty($where['to_surgery_at']))
            {
                $builder = $builder->where('surgery_at', '>', Carbon::parse($where['from_surgery_at']));
                $builder = $builder->where('surgery_at', '<', Carbon::parse($where['to_surgery_at']));
            } elseif ( ! empty($where['from_surgery_at']))
            {
                $builder = $builder->where('surgery_at', '>', Carbon::parse($where['from_surgery_at']));
            } elseif ( ! empty($where['to_surgery_at']))
            {
                $builder = $builder->where('surgery_at', '<', Carbon::parse($where['to_surgery_at']));
            }

        }

        if (array_key_exists('archive_at', $rq['where']))
            $builder = $builder->where('archive_at', $rq['where']['archive_at']);

        if(he_is('department'))
        {
            $dep_ins = M('department');
            $dep_ins = $dep_ins->where('id', uid())->first();
            $builder = $this->whereHas('hospital', function($q) use ($dep_ins)
            {
                $q->where('id', $dep_ins->hospital_id);
            });
        }
        DB::enableQueryLog();

        $builder = $builder->limit(50);
        $main = $builder->get();
        $sql = DB::getQueryLog();
        //print_r($sql);
        return ss([
            'main'  => $main,
            'count' => $builder->count(),
            'sql' => $builder->toSql()
        ]);
    }
}

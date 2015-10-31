<?php
if ( ! function_exists('add_chara'))
{
    function add_chara($chara)
    {
        return Session::push('his_chara', $chara);
    }
} else dd('function add_chara exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('log_him_in'))
{
    function log_him_in($d = null)
    {
        Session::put('is_logged_in', 1, 6000);
        if ($d)
            Session::put($d);
    }
} else dd('function log_him_in exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('log_him_out'))
{
    function log_him_out()
    {
        Session::forget('is_logged_in');
        Session::forget('his_chara');
    }
} else dd('function log_him_out exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('set_chara'))
{
    function set_chara($chara_name)
    {
        Session::push('his_chara', $chara_name);
    }
} else dd('function set_chara exists.' . __FILE__ . ':' . __LINE__);

if ( ! function_exists('he_is'))
{
    function he_is($chara_name)
    {
        $ch = his_chara();
        if ($ch)
        {
            if (in_array($chara_name, $ch))
            {
                return true;
            }
            return false;
        }
        return false;
    }
} else dd('function he_is exists.' . __FILE__ . ':' . __LINE__);

/*get current user characters*/
if ( ! function_exists('his_chara'))
{
    /**
     * Return current user's characters.
     * @return mixed
     */
    function his_chara()
    {
        return Session::get('his_chara');
    }
} else
{
    dd('function his_chara exists.' . __FILE__ . ':' . __LINE__);
}


if ( ! function_exists('sess'))
{
    /**
     * Return specified session data.
     * Return all session if empty parameter.
     *
     * @param null $eleK
     *
     * @return mixed
     */
    function sess($eleK = null, $val = null)
    {
        if($val){
            Session::put($eleK, $val);
        }

        if (empty($eleK))
            return Session::all();
        else
            $ele = Session::get($eleK);
        if (empty($ele)) return false;
        else return $ele;
    }
} else dd('function sess exists.' . __FILE__ . __LINE__);


/*get current user username*/
if ( ! function_exists('username'))
{
    /**
     * Return current user's username if logged in.
     * @return bool
     */
    function username()
    {
        if (is_logged_in())
            return Session::get('username');
        else return false;
    }
} else
{
    dd('function username exists.' . __FILE__ . ':' . __LINE__);
}

if ( ! function_exists('uid'))
{
    /**
     * Return current user's user_id if logged in.
     * @return mixed
     */
    function uid()
    {
        if (is_logged_in())
            return Session::get('uid');

        return false;
    }
} else
{
    dd('function uid exists.' . __FILE__ . ':' . __LINE__);
}

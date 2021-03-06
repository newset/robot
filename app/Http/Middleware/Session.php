<?php
/**
 * 根据数据库设置的 session 时间调整
 */

namespace App\Http\Middleware;

use Closure;
use Config, Cache, Log;

class Session
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = Cache::get('i_settings', null);
        if ($settings) {
            $lifetime = array_get($settings, 'user.session_expire') * 60 ? array_get($settings, 'user.session_expire') * 60  : 60;
            Log::info('setting life time: '.$lifetime);
            Config::set('session.lifetime', $lifetime);
        }

        // 修改 email 配置
        $mail = array_get($settings, 'email');
        if ($mail) {
            foreach ($mail as $key => $value) {
                // dd($key, $value);
                if ($value) {
                    config(['mail.'.$key => $value]);
                }
                if ($key == 'username') {
                    config(['mail.from.address' => $value]);
                }
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof TokenMismatchException){
            $data = [
                'msg' => 'CSRF Token 错误, 请刷新页面',
                'code' => '00001'
            ];
            // todo 检查当前用户 token 错误原因
            // 
            
            return response($data, 403);
        }

        if ($e->getMessage() == 'insufficient_permission') {
            if (!uid()) {
                $data = [
                    'msg' => '登录过期',
                    'code' => '00001'
                ];
            }else{
                $data = [
                    'msg' => '无权限访问',
                    'code' => '00002'
                ];
            }
            
            return response($data, 403);
        }

        return parent::render($request, $e);
    }
}

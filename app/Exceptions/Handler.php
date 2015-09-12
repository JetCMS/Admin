<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        ModelNotFoundException::class,
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

       

        if($e instanceof TokenMismatchException) 
        {
            if ($request->ajax())
            {
                $e = new TokenMismatchException($e->getMessage(), $e);
            } 
            else
            {
                return response()->view('errors.400', [], 400);
            }
        }

        if($e instanceof NotFoundHttpException) 
        {
            if ($request->ajax())
            {
                $e = new NotFoundHttpException($e->getMessage(), $e);
            } 
            else
            {
                return response()->view('errors.404', [], 404);
            }
        }        
        
        return parent::render($request, $e);
    }
}

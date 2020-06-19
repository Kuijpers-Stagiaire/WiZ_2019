<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        if($this->isHttpException($exception))
        {
            switch ($exception->getStatusCode())
                {
                    case 401:
                        return redirect()->route('401');
                    break;
                    case 403:
                        return redirect()->route('403');
                    break;
                    case 404:
                        return redirect()->route('404');
                    break;
                    case 419:
                        return redirect()->route('419');
                    break;
                    case 429:
                        return redirect()->route('429');
                    break;
                    case 500:
                        return redirect()->route('500');
                    break;
                    case 503:
                        return redirect()->route('503');
                    break;
                }
        }
        else
        {
            return parent::render($request, $exception);
        }
    }
}

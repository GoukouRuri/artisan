<?php

namespace App\Exceptions;

use Exception;
use App\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Database\Eloquent\ModelNotFoundException::class
    ];

    public function report(Exception $exception)
    {
        parent::report($exception);
    }


}

<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{


    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e,Request $request) {
            if ($request->is('api/users/*')) {
                return response()->json([
                    'success' => 'Record not found.',
                    'message'=> 'The user with the requested identifier does not exist',
                    'fails'=> ['user_id ' => 'User id ' .$request->user. ' not found'],
                ], 404);
            }
            else if ($request->is('api/users*')) {
                return response()->json([
                    'success' => false,
                    'message'=> 'Page not found.',
                ], 404);
            }
            else if ($request->is('api/positions*')) {
                return response()->json([
                    'success' => false,
                    'message'=> 'Page not found.',
                ], 404);
            }

        });
    }
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


}

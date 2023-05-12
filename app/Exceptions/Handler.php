<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // jika terdeteksi route api tidak login terlebih dahulu
        $this->renderable(function (RouteNotFoundException $e, $request,) {

            if ($request->is('api/*')) {
                return response()->json([
                    'status'  => false,
                    'message' => 'You do not have the required authorization.',
                ], 403);
            }
        });

        // jika terdeteksi tidak punya izin untuk akses
        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {

            if ($request->is('api/*')) {
                return response()->json([
                    'status'  => false,
                    'message' => 'You do not have the required authorization.',
                ], 403);
            }
        });
    }
}

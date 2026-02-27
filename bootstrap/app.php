<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                $cid = app()->has('cid') ? app('cid') : Str::uuid()->toString();
                app()->instance('cid',$cid);
                Log::error("x-correlation-id: {$cid}", ['error' => $e->__toString()]);
                $firstErrors = collect($e->errors())
                    ->map(fn ($messages) => $messages[0]);
                return response()->json([
                    'status'  => false,
                    'result'  => null,
                    'message' => $firstErrors->first(),
                    'errors'  => $firstErrors,
                    'x-correlation-id'=>app('cid')

                ], 422);
            }
        });
    })->create();

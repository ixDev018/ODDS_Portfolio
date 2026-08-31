<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Http\Exceptions\PostTooLargeException $e, \Illuminate\Http\Request $request) {
            $maxSize = ini_get('upload_max_filesize') ?: ini_get('post_max_size') ?: '128M';
            $message = "The uploaded file is too large for the server. Maximum allowed file size is {$maxSize}.";

            if ($request->expectsJson() || $request->ajax() || $request->is('admin/*') || $request->is('api/*')) {
                return response()->json(['error' => $message, 'message' => $message], 413);
            }

            return redirect()->back()->withInput()->withErrors(['file' => $message, 'cover_image' => $message]);
        });
    })->create();

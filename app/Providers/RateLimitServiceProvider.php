<?php

namespace App\Providers;

use App\Traits\ApiResponseTrait;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class RateLimitServiceProvider extends ServiceProvider
{
    use ApiResponseTrait;

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        RateLimiter::for('api_rate_limit', function (Request $request) {
            $limit = config('api.rate_limit', 60);
            $minutes = config('api.rate_limit_minutes', 1);
            $message = 'Too Many Request Try Later';

            return Limit::perMinute($limit,$minutes)
                ->by($request->ip())
                ->response(function () use ($message)  {
                    return $this->respondToManyRequests($message);
                });
        });
    }
}

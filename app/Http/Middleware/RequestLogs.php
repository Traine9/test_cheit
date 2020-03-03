<?php

namespace App\Http\Middleware;

use App\Models\RequestLog;
use Closure;

class RequestLogs
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $controller = @$request->route()->action['controller'];
        if ($controller) {
            list($action, $method) = explode('@', $controller);

            $action = preg_replace('/.*\\\/u', '', $action);
        } else {
            $action = 'inline';
            $method = 'handler';
        }

        $requestData = $request->all();
        if (!empty($request->route('log'))) {
            $requestData['id'] = $request->route('log');
        }

        $logData = [
            'ip' => $request->ip(),
            'action' => $action,
            'method' => $method,
            'type' => $request->method(),
            'data' => json_encode($requestData),
        ];

        resolve('App\Services\RequestLogService')->store($logData);

        return $next($request);
    }
}


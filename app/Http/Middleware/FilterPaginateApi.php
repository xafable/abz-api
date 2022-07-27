<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FilterPaginateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);



        $data['success'] = true;
        $data['page'] = $response->getData(true)['meta']['current_page'];
        $data['total_pages'] = $response->getData(true)['meta']['last_page'];
        $data['total_users'] = $response->getData(true)['meta']['total'];
        $data['count'] = $response->getData(true)['meta']['per_page'];
        $data['links'] = ['next_url'=>$response->getData(true)['links']['next'],
                          'prev_url'=>$response->getData(true)['links']['prev']];
        $data['success'] = true;
        $data['users'] = $response->getData(true)['data'];

        $response->setData($data);

        return $response;
    }
}

<?php namespace JetCMS\Admin\Http\Middleware;

use AdminAuth;
use Closure;
use Route;
use URL;
use Illuminate\Contracts\Auth\Guard;

class Admin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (AdminAuth::check() and Route::currentRouteName() == 'admin.logout')
        {
            return $next($request);
        }

        if (AdminAuth::guest())
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            } 
            else
            {
                return redirect()->guest(route('admin.login'));
            }
        }
        else
        {
            $user_access = [];
            foreach (config('jetcms.setting.auth.user_access') as $val) {
                $user_access[] = mb_strtolower($val);
            }

            if (!in_array(mb_strtolower(AdminAuth::user()->email), $user_access)) 
            {
                if ($request->ajax()) 
                {
                    return response('Unauthorized.', 401);
                } 
                else 
                {
                    return redirect()->guest(route('admin.401'));
                }
            }

        }

		

        return $next($request);
    }
}

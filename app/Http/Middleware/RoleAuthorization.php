<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles = null)
    {
        // Pre-Middleware Action

        // $response = $next($request);

        if($roles != null) {
            // auth()->shouldUse($guard);
            try {
                //Access token from the request        
                $token = JWTAuth::parseToken();
                
                //Try authenticating user
                $user = $token->authenticate();
            }
            
            //Thrown if token has expired
            catch (TokenExpiredException $e) {        
                return $this->unauthorized('Your token has expired. Please, login again.');
            }
            
            //Thrown if token invalid
            catch (TokenInvalidException $e) {
                return $this->unauthorized('Your token is invalid. Please, login again.');
            }
            
            //Thrown if token was not found in the request.
            catch (JWTException $e) {
                return $this->unauthorized('Please, attach a Bearer Token to your request');
            }

            //If user was authenticated successfully and user is in one of the acceptable roles, send to next request.
            if ($user &&
                         (  in_array($user->role, explode('|', $roles)) ||
                            $user->nama_keluarga != null
                         )
            ) {
                return $next($request);
            }
        }
        // Post-Middleware Action

        return $this->unauthorized($user);
    }

    private function unauthorized($message = null){
        return response()->json([
            'message' => $message ? $message : 'You are unauthorized to access this resource',
            'success' => false
        ], 401);
    }
}

<?php

namespace App\Http\Controllers\api\v1;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\api\v1\UserResource;
use App\Http\Requests\api\v1\UserStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'checkTokenValidity']]);
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();

        $user = User::where('external_id', $user->id)
            ->where('external_auth', 'google')
            ->first();

        if ($user) {
            // Here he should recieve the login method
        } else {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'external_id' => $user->id,
                'external_auth' => 'google',
            ]);

            // after creating the user he should be logged in
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        try {
            return $this->respondWithToken(Auth::refresh());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error refreshing token'], 500);
        }
    }

    public function checkTokenValidity(Request $request)
    {
        try {
            $token = $request->cookie('jwt');

            if (empty($token)) {
                return response()->json(['valid' => false, 'error' => 'Token is empty']);
            }

            JWTAuth::setToken($token)->getPayload();
            return response()->json(['valid' => true]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'valid' => false,
                'error' => 'Token is invalid'
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json([
                'valid' => false, 'error' => 'Token has expired'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'valid' => false,
                'error' => 'Error refreshing token'
            ]);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(
            [
                'data' => new UserResource(Auth::user())
            ],
            201
        );
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        Cookie::forget('jwt');

        return response()->json([
            'message' => 'Successfully logged out'
        ], 201);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {

        return response([
            'message' => 'success',
        ], 201)->withCookie(
            'jwt',
            $token,
            60,
            null,
            null,
            false,
            true
        );
    }

    public function register(UserStoreRequest $request)
    {
        $user = User::create($request->all());

        return response()->json(
            [
                'data' => new UserResource($user)
            ],
            201
        );
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $bearerToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearerToken);
        if ($token && !static::isTokenExpired($token->expires_at)) {
            return response()->json([
                'token' => $bearerToken,
                'message' => "Already logged in.",
            ]);
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        /* @var $user User */
        $user = User::whereEmail($request->email)->firstOrFail();

        $token = $user->createToken('auth-token');

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ]);
    }

    private static function isTokenExpired($expiresAt)
    {
        if (empty($expiresAt)) {
            return false;
        }

        $now = new DateTime();
        return $expiresAt <= $now;
    }

    public function status(Request $request)
    {
        $user = $request->user('sanctum');
        $menus = [];
        $links = [];

        if ($user) {
            $links['profile'] = [
                "label" => "Profile",
                "url" => route('api.user'),
            ];
            $links['logout'] = [
                "label" => "Logout",
                "url" => route('api.logout'),
            ];
        } else {
            $links['login'] = [
                "label" => "Login",
                "url" => route('api.login'),
            ];
        }

        return [
            'token' => $request->bearerToken(),
            'message' => $user ? "Authenticated." : "Unauthenticated.",
            'user' => $user,
            'menus' => $menus,
            'links' => $links,
        ];
    }

    public function registration(Request $request): JsonResponse|array
    {
        $bearerToken = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearerToken);
        if ($token && !static::isTokenExpired($token->expires_at)) {
            return response()->json([
                'token' => $bearerToken,
                'message' => "Registration only allowed for guest.",
            ]);
        }

        return ['data' => (new CreateNewUser())->create($request->all())];
    }

    public function logout(Request $request): JsonResponse
    {
        $bearerToken = $request->bearerToken();
        $segments = explode('|', $bearerToken);
        $success = $request
            ->user()
            ->tokens()
            ->where('id', $segments[0] ?? 0)
            ->delete();

        return response()->json([
            'message' => $success ? "Logout success" : "Logout failed",
        ]);
    }
}

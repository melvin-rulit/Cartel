<?php

namespace App\Http\Controllers\V1\Api\Auth;

use AllowDynamicProperties;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Nette\Utils\Random;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{


    /**
     * @OA\Post(
     *     path="/api/auth/check-sms",
     *     summary="Check SMS",
     *     description="Check the SMS code sent to the user.",
     *     tags={"Auth"},
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         required=true,
     *         description="User's phone number",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="sms_code",
     *         in="query",
     *         required=false,
     *         description="SMS code received by the user",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Access Token",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                 example="7|Bk3yG6MN9F1Te1OXBLx1Ua6nghELLY9iHlOPCwaw69cbcc31",
     *                 description="Access token"
     *             ),
     *             @OA\Property(
     *                 property="role",
     *                 type="array",
     *                 @OA\Items(type="string"),
     *                 example={"user"},
     *                 description="Roles associated with the user"
     *             )
     *         ),
     *         @OA\Response(
     *             response=422,
     *             description="Validation Error",
     *             @OA\JsonContent()
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="SMS Code is incorrect",
     *         @OA\JsonContent()
     *     )
     * )
     */


    public function checkSMS(Request $request): JsonResponse|array
    {

        $request->validate([
            'phone' => 'required',
//            'sms_code' => 'required',
        ]);

        $user = User::where('phone', $request->phone)->first();

        return [
            "token" => $user->createToken('auth_token')->plainTextToken,
        ];

//        if($user->sms_code == $request->sms_code){
//            $user->sms_verified = true;
//            $user->save();
//
//            return [
//                "token" => $user->createToken('auth_token')->plainTextToken,
//            ];
//        }
//        return response()->json(['message'=>'SMS Code is incorrect'],422);
    }


    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login",
     *     description="Login a user. Reverse access token.",
     *     tags={"Auth"},
     *     @OA\Parameter (
     *     name="phone",
     *     in="query",
     *     required=true),
     *     @OA\Response(
     *     response=200,
     *     description="true",
     *     @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *     response=422,
     *     description="Validation Error",
     *     )
     * )
     * @throws DatabaseException
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            $user = User::create([
                'name' => 'User_' . rand(1000, 9999),
                'phone' => $request->phone,
                'password' => Hash::make(Random::generate(8)),
            ]);

//            $this->database->getReference($this->tablename)->push($user->only(['id', 'phone']));  //Запись пользователей в базу Firebase
        }
        event(new UserRegistered($user));

        return response()->json(['message' => 'true']);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/refresh/token",
     *     summary="Refresh token",
     *     description="Удалить все ранее созданные токены и сгенерировать новый",
     *     tags={"Auth"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Token refreshed successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="new_generated_token")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Unauthenticated")
     *         )
     *     )
     * )
     */

    public function refreshToken(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken('New Token')->plainTextToken;

        return response()->json($token);
    }

    public function destroyToken(int $tokenId, Request $request)
    {
//Auth::user()->tokens()->where('id', $tokenId)->delete();
//        return response()->json($request->user());
    }

    /**
     * @OA\Post(
     *     path="auth/logout",
     *     summary="Logout",
     *     description="Logout a user. Delete all tokens.",
     *     tags={"Auth"},
     *     @OA\Parameter (
     *     name="phone",
     *     in="query",
     *     required=true),
     *     @OA\Response(
     *     response=204,
     *     description="No Content",
     *     )
     * )
     */

    public function logout(Request $request): \Illuminate\Http\Response
    {
        $user = User::where('phone', $request->phone)->first();

        if($user){
            $user->tokens()->delete();
            $user->fcmToken = null;
            $user->save();
        }

        return response()->noContent();
    }
}

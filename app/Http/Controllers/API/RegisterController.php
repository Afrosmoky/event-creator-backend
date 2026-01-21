<?php

namespace App\Http\Controllers\API;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\ElementResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user. You should provide following parameters, describe later in parameters section: name, email, password and c_password(repeated)",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *          name="c_password",
     *          in="query",
     *          description="User's password confirmed",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return ApiResponseClass::sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('EmkaApp')->plainTextToken;
        $success['name'] =  $user->name;

        return ApiResponseClass::sendResponse($success, 'User register successfully.');
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Authenticate user and generate JWT token. Use this token later for each call to authorize",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="User's password",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('EmkaApp')->plainTextToken;
            $success['name'] =  $user->name;

            return ApiResponseClass::sendResponse($success, 'User login successfully.');
        }
        else{
            return ApiResponseClass::sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}

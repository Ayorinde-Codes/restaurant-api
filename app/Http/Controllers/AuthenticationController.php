<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\UserResource;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {

                return $this->errorResponse("Invalid Credentials");
            }
        } catch (JWTException $e) {

            return $this->ServerErrorResponse("could_not_create_token");
        }

        $data = [
            'token' => $token,
            'user' => Auth::user()
        ];

        return $this->okResponse("Login Successful", $data);
    }

    /* *
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(UserRequest $request)
    {
        try {
            $response = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $createUser = User::create($response);

            $token = JWTAuth::fromUser($createUser);

            if ($createUser) {


                $data['user'] = $createUser;
                $data['token'] = $token;

                return $this->createdResponse("User Created Successfully", new UserResource($data));
            } else {
                return $this->errorResponse("User Creation Failed");
            }
        } catch (\Exception $e) {

            return $this->errorResponse('User Registration Failed!');
        }
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return $this->notFoundResponse('User Not Found!');
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return $this->ServerErrorResponse('token_expired', $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return $this->ServerErrorResponse('token_invalid', $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return $this->ServerErrorResponse('token_absent', $e->getStatusCode());
        }

        return $this->okResponse("User", $user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->okResponse("Successfully logged out");
    }
}

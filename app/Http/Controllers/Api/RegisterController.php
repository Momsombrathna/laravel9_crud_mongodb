<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseController
{
    /**
     * Register a user
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->getRegistrationValidationRules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::createWithToken($input);
        $success['token'] =  $user->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User registered successfully.');
    }

    /**
     * Login a user
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User logged in successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    /**
     * Get the validation rules for user registration
     *
     * @return array
     */
    private function getRegistrationValidationRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
    }
}

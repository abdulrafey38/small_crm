<?php //controller for login, register and logout user, get user apis

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'email' => ['unique:users,email'],
            'password' => 'required',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->firstname = $request->firstName;
        $user->lastname = $request->lastName;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 201);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->only('email', 'password');
        $jwt_token = null;
        // $user=auth()->user();

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'expiry' => '3600',
            'user' => auth()->user(),
        ]);
    }

    public function logout(Request $request)
    {

        // Get JWT Token from the request header key "Authorization"
        if ($request->header("Authorization")) {
            $token = $request->header("Authorization");
            // Invalidate the token
            try {
                JWTAuth::invalidate(JWTAuth::getToken());
                return response()->json([
                    "status" => "success",
                    "message" => "User successfully logged out.",
                ]);
            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return response()->json([
                    "status" => "error",
                    "message" => "Failed to logout, please try again.",
                ], 500);
            }
        } else {
            return response()->json([
                "status" => "error",
                "message" => "token must be provided with request header",
            ], 422);
        }

    }

    public function getAuthUser(Request $request)
    {
        if ($request->header("Authorization")) {
            $user = JWTAuth::authenticate($request->header("Authorization"));
            return response()->json(['user' => $user]);
        } else {
            return response()->json(['Message' => 'Please provide the token']);
        }
    }

    public function update(Request $request)
    {
        \error_log($request);
        $user = Auth::user();

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->phone = $request->phone;
        $user->firstname = $request->firstName;
        $user->lastname = $request->lastName;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }

}

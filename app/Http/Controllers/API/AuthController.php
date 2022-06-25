<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\UserCustomer;
use App\Models\UserSupplier;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    /**
     * User will be logged in after login process
     *
     * @var boolean
     */
    public $loginAfterSignUp = true;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }

    /**
     * Register function for user with API
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        // Validate inputs
        $validator = Validator::make($request->all(), [
            'f_name'    => 'required',
            'l_name'    => 'required',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required',
            'type'      => ['required', 'string', Rule::in(['admin', 'customer', 'supplier']),],
            'address'   => 'string|max:255',
            'phone'     => 'string|max:255',
            'zone'      => 'string|max:255',
            'street'    => 'string|max:255',
        ]);

        // Check if there are validation errors
        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        // Create a new user record
        $user = User::create([
            'f_name'    => $request->f_name,
            'l_name'    => $request->l_name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'type'      => $request->type,
        ]);

        // Check whether the user type is customer or supplier
        if($request->type == "customer") {

            $supplier = new UserCustomer();
            $supplier->user_id  = $user->id;
            $supplier->phone    = $request->phone;
            $supplier->zone     = $request->zone;
            $supplier->street   = $request->street;
            $supplier->save();

        } elseif($request->type == "supplier") {

            $supplier = new UserSupplier();
            $supplier->user_id = $user->id;
            $supplier->address = $request->address;
            $supplier->save();
        }

        $token = auth('api')->login($user);

        return $this->respondWithToken($token);
    }

    /**
     * Login function for user with API
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated user's data
     *
     * @param Request $request
     * @return void
     */
    public function getAuthUser(Request $request)
    {
        // return response()->json(auth('api')->user());
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
    
        } catch (TokenExpiredException $e) {
    
            return response()->json(['token_expired']);
    
        } catch (TokenInvalidException $e) {
    
            return response()->json(['token_invalid']);
    
        } catch (JWTException $e) {
    
            return response()->json(['token_absent']);
    
        }
    
        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return void
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Helper function to make the response easier
     *
     * @param [type] $token
     * @return void
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // The token expires after an hour afterward the user can either log in again or get a refresh token.
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}

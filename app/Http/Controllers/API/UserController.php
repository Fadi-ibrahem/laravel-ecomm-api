<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Front\UserRepositoryInterface;
use App\Services\API\User\UpdateUserValidationService;

class UserController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepo;

    /**
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Users using UserRepo
        $users = $this->userRepo->index();

        // The response
        return response()->json(compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Check whether the authenticated user is authorized to show the sent user id
        if(auth('api')->user()->id == $user->id) {
            return response()->json($user);
        }
        return response()->json("You aren't able to show this user");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, UpdateUserValidationService $validator)
    {
        // Check whether the authenticated user is authorized to update the sent user id
        if(auth('api')->user()->id == $user->id){

            // Validate inputs using external service
            if($errors = $validator->isValid($request)) return response()->json($errors);
            
            // Update the specific user using UserRepo
            $this->userRepo->update($user, $request->all());

            // The response 
            return response()->json("User Updated Successfully!");
        }
        return response()->json("You aren't able to update this user"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Check whether the authenticated user is authorized to delete the sent user id
        if(auth('api')->user()->id == $user->id){

            // Delete the specific user using UserRepo
            $this->userRepo->delete($user);

            // The response
            return response()->json("User Deleted Successfully!");
        }
    }

}

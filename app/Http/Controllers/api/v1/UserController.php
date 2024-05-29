<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\api\v1\UserUpdateRequest;
use App\Http\Requests\api\v1\UserStoreRequest;
use App\Http\Resources\api\v1\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();
        return response()->json([
            'data' => UserResource::collection($users),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->all());

        return response()->json(
            [
                'data' => new UserResource($user)
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json([
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Used to update all data from the req information params
        $user = User::find($id);
        $user->update($request->all());
        return response()->json([
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function getCustomers()
    {
        $users = User::where('user_type', 'customer')->get();
        return response()->json([
            'data' => UserResource::collection($users),
        ], 200);
    }
}

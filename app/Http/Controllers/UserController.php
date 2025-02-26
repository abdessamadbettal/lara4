<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
        /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('throttle:60,1', null, null),
            new Middleware('auth:api', null, null),

            // Restrict access to index and store methods to admin role only
            new Middleware('role:admin', ['only' => ['index', 'store']]),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request()->get('page', 1);
        $perPage = request()->get('per_page', 10);
        $users = User::paginate($perPage, ['*'], 'page', $page);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Check if the authenticated user is the same as the user being updated
        if (Auth::user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // check if the authenticated user is the same as the user being deleted
        if (Auth::user()->id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user->delete();

        return response()->noContent(); // 204
    }
}

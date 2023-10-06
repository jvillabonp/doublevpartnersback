<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $users = User::query();
            if (!empty($request->get('q'))) {
                $users->where('name', 'LIKE', "%" . $request->get('q') . "%");
            }
            return response()->json(
                $users->paginate($request->get('perPage', 25))
                    ->appends([
                        'perPage' => $request->get('perPage', 25),
                        'q' => $request->get('q')
                    ]),
                200
            );
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'  => 'required',
                'email' => 'required|email|unique:users,email'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            User::create($request->only('name', 'email'));

            return response()->json([
                'message' => 'Created'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $email)
    {
        try {
            $user = User::with('tickets')->where('email', $email)->first();
            if (!$user) {
                return response()->json([
                    'message' => 'Not Found'
                ], 404);
            }

            return response()->json($user, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $users = Ticket::query();
            if (!empty($request->get('q'))) {
                $users->where('description', 'LIKE', "%" . $request->get('q') . "%");
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
            $validator = Validator::make($request->all() ,[
                'description'   => 'required',
                'user'          => 'required|email|exists:users,email',
                'status'        => 'nullable|in:abierto,cerrado'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $user = User::where('email', $request->get('user'))->first();

            $ticket = Ticket::create([
                'token'         => Str::uuid()->toString(),
                'description'   => $request->get('description'),
                'user_id'       => $user->id,
                'status'        => $request->get('status', 'abierto')
            ]);

            return response()->json([
                'message' => 'Ticket created with ID: ' . $ticket->token
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
    public function show(string $id)
    {
        try {
            $ticket = Ticket::with('user')->where('token', $id)->first();
            if (!$ticket) {
                return response()->json([
                    'message' => 'Not Found.'
                ], 404);
            }

            return response()->json($ticket, 200);
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
        try {
            $ticket = Ticket::where('token', $id)->first();
            if (!$ticket) {
                return response()->json([
                    'message' => 'Not Found'
                ], 404);
            }

            $validator = Validator::make($request->all() ,[
                'user'          => 'nullable|email|exists:users,email',
                'status'        => 'required|in:abierto,cerrado'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }


            $user = $ticket->user;
            if (!empty($request->get('user'))) {
                $user = User::where('email', $request->get('email'))->first();
            }

            $ticket = $ticket->update([
                'description'   => $request->get('description', $ticket->description),
                'user_id'       => $user->id,
                'status'        => $request->get('status', 'abierto')
            ]);

            return response()->json([
                'message' => 'Ticket update'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $ticket = Ticket::where('token', $id)->first();
            if (!$ticket) {
                return response()->json([
                    'message' => 'Not Found'
                ], 404);
            }

            $ticket->delete();

            return response()->json([
                'message' => 'Ticket Deleted'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function restore(string $id): JsonResponse
    {
        try {
            $ticket = Ticket::withTrashed()->where('token', $id)->first();
            if (!$ticket) {
                return response()->json([
                    'message' => 'Not Found'
                ], 404);
            }

            $ticket->restore();

            return response()->json([
                'message' => 'Ticket Restore'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

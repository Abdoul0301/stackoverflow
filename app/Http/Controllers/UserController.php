<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = $this->user->all();

            return response()->json([
                "status" => 200,
                "message" => "Liste des utilisateurs",
                "users" => $users
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);
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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'in:superviseur,utilisateur',
                'validated_answers_count' => 'integer|min:0',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => $request->input('role', 'utilisateur'),
                'validated_answers_count' => $request->input('validated_answers_count', 0),
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Utilisateur créé avec succès!",
                "user" => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = $this->user->findOrFail($id);

            return response()->json([
                "status" => 200,
                "message" => "Détails de l'utilisateur",
                "user" => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);
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
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'role' => 'in:superviseur,utilisateur',
                'validated_answers_count' => 'integer|min:0',
            ]);

            $user = $this->user->findOrFail($id);

            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role', 'utilisateur'),
                'validated_answers_count' => $request->input('validated_answers_count', 0),
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Utilisateur mis à jour avec succès!",
                "user" => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = $this->user->findOrFail($id);
            $user->delete();

            return response()->json([
                "status" => 200,
                "message" => "Utilisateur supprimé avec succès!",
                "user" => $user
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);

        }
    }
}

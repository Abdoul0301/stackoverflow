<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected $answer;

    public function __construct()
    {
        $this->answer = new Answer();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $answers = $this->answer->all();

            return response()->json([
                "status" => 200,
                "message" => "Liste des réponses",
                "answers" => $answers
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
                'body' => 'required',
                'user_id' => 'required|exists:users,id',
                'question_id' => 'required|exists:questions,id',
                'status' => 'in:attente,valider,refuser'
            ]);

            $answer = Answer::create([
                'body' => $request->input('body'),
                'user_id' => $request->input('user_id'),
                'question_id' => $request->input('question_id'),
                'status' => $request->input('status', 'attente'),
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Réponse créée avec succès!",
                "answer" => $answer
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
    public function show( $id)
    {
        try {
            $answer = $this->answer->findOrFail($id);

            return response()->json([
                "status" => 200,
                "message" => "Détails de la réponse",
                "answer" => $answer
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
                'body' => 'required',
                'user_id' => 'required|exists:users,id',
                'question_id' => 'required|exists:questions,id',
                'status' => 'in:attente,valider,refuser'
            ]);

            $answer = $this->answer->findOrFail($id);

            $answer->update([
                'body' => $request->input('body'),
                'user_id' => $request->input('user_id'),
                'question_id' => $request->input('question_id'),
                'status' => $request->input('status', 'attente'),
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Réponse mise à jour avec succès!",
                "answer" => $answer
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
    public function destroy( $id)
    {
        try {
            $answer = $this->answer->findOrFail($id);
            $answer->delete();

            return response()->json([
                "status" => 200,
                "message" => "Réponse supprimée avec succès!",
                "answer" => $answer
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);
        }
    }
}

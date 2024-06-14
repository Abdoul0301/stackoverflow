<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $question;

    public function __construct()
    {
        $this->question = new Question();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $questions = $this->question->all();

            return response()->json([
                "status" => 200,
                "message" => "Liste des questions",
                "questions" => $questions
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
                'title' => 'required',
                'body' => 'required',
                'user_id' => 'required|exists:users,id',
            ]);

            $question = Question::create([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'user_id' => $request->input('user_id'),
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Question créée avec succès!",
                "question" => $question
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
            $question = $this->question->findOrFail($id);

            return response()->json([
                "status" => 200,
                "message" => "Détails de la question",
                "question" => $question
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
                'title' => 'required',
                'body' => 'required',
                'user_id' => 'required|exists:users,id',
            ]);

            $question = $this->question->findOrFail($id);

            $question->update([
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'user_id' => $request->input('user_id'),
            ]);

            return response()->json([
                "status" => 200,
                "message" => "Question mise à jour avec succès!",
                "question" => $question
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
            $question = $this->question->findOrFail($id);
            $question->delete();

            return response()->json([
                "status" => 200,
                "message" => "Question supprimée avec succès!",
                "question" => $question
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => $e->getCode(),
                "message" => $e->getMessage()
            ]);
        }
    }
}

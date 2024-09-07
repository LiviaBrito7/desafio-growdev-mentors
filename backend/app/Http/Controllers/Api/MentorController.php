<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // Listar todos os mentores
    public function index()
    {
        $mentors = Mentor::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Mentores listados com sucesso',
            'data' => $mentors
        ], 200);
    }

    // Criar um novo mentor
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mentors,email',
            'cpf' => 'required|string|unique:mentors,cpf',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro na validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $mentor = Mentor::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Mentor criado com sucesso',
            'data' => $mentor
        ], 201);
    }

    // Exibir um mentor específico
    public function show($id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mentor não encontrado'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Mentor recuperado com sucesso',
            'data' => $mentor
        ], 200);
    }

    // Atualizar um mentor
    public function update(Request $request, $id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mentor não encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mentors,email,'.$mentor->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro na validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $mentor->name = $request->name;
        $mentor->email = $request->email;
        $mentor->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Mentor atualizado com sucesso',
            'data' => $mentor
        ], 200);
    }

    // Deletar um mentor
    public function destroy($id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mentor não encontrado'
            ], 404);
        }

        $mentor->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Mentor deletado com sucesso'
        ], 200);
    }
}

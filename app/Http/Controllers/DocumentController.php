<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DocumentController extends Controller
{
    public function index()
    {
        return Document::with('user')->get();
    }

    public function store(Request $request)
    {
        // Валидация входных данных
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:8096',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Получение текущего пользователя из JWT-токена
            $user = auth()->user();

            // Сохранение файла
            $path = $request->file('file')->store('documents', 'public');

            // Создание записи в базе данных
            $document = Document::create([
                'file_path' => $path,
                'user_id' => $user->id, // Автоматически привязываем к текущему пользователю
            ]);

            // Возвращаем JSON-ответ
            return response()->json([
                'message' => 'File uploaded successfully',
                'file_path' => $path,
                'url' => Storage::url($path),
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while uploading the file'], 500);
        }
    }

    public function show(Document $document)
    {
        return $document->load('user');
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->validate([
            'file_path' => 'sometimes|string',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $document->update($data);
        return $document;
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return response()->noContent();
    }
}
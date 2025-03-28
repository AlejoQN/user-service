<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    // Obtener perfil del usuario autenticado
    public function profile()
    {
        return response()->json(Auth::user()); 
    }

    // Actualizar perfil del usuario autenticado
    public function update(Request $request)
    {
        $user = Auth::user(); 

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return response()->json(['message' => 'Perfil actualizado']);
    }

    // Listar todos los usuarios (solo accesible por administradores)
    public function index()
    {
        return response()->json(User::all());
    }

    // Eliminar usuario por ID (solo accesible por administradores)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return response()->json(['message' => 'Usuario eliminado']);
    }
}

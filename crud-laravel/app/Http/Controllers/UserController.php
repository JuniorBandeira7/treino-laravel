<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Costumer;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Exception;

class UserController extends Controller
{
    public function loginView()
    {
        return view("users.login");
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => 'required|email|max:255',
            "password" => "required|min:6"
        ]);

        if (!$user = User::where('email', $data['email'])->first()){
            return redirect()->back()->with("error", "credenciais incorretas");
        }

        if (Hash::check($data['password'], $user->password)) {
            Session::put('user_id', $user->id);
        } else {
            return redirect()->back()->with("error", "credenciais incorretas");
        }

        //dd(session()->all());
        return redirect()->route("costumers")->with("success", "logado");
    }

    public function registerView()
    {
        return view("users.register");
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|max:255|string",
                "email" => "required|email|unique:users,email|max:255",
                "password" => "required|min:6",
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

        try {
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao criar usuário.', 'details' => $e->getMessage()], 500);
        }

        return redirect(route("costumers"))->with("success", "Usuário cadastrado com sucesso!");
    }

    public function dashboard()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }
        
        $costumers = Costumer::paginate(5);

        return view("costumers.costumers", ["costumers" => $costumers]);
    }

    public function logout(){
        Session::flush();

        return redirect(route("loginView"));
    }
}

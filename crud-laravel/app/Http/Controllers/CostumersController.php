<?php

namespace App\Http\Controllers;

use App\Http\Requests\CostumerRequest;
use App\Models\Costumer;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\Rule;

class CostumersController extends Controller
{
    public function costumersView(){
        $costumers = Costumer::paginate(5);

        return view("costumers.costumers", ['costumers' => $costumers]);
    }

    public function costumersEditView(string $id){
        return view("costumers.editCostumer", ["costumer" => Costumer::findOrFail($id)]);
    }

    public function updateCostumer(Request $request, $id){
        // dd("gf   egeg");
        try {
            $validated = $request->validate([
                "name" => "required|max:255|string",
                "email" => "required|email|unique:users,email|max:255",
                "country" => "required|max:255|string",
                Rule::unique('costumers', 'email')->ignore($id)
            ]);

            $costumer = Costumer::findOrFail($validated['id']); 
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }   
        
        try {
            $costumer->update($costumer->validated());

            return redirect(route("costumers"))->with("success", "Usuário cadastrado com sucesso!");
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }    
    }

    public function createCustumerView(){
        return view("costumers.createCostumer");
    }   

    public function createCostumer(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|max:255|string",
                "email" => "required|email|unique:users,email|max:255",
                "country" => "required|max:255|string",
            ]);

        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

        try {
            Costumer::create([
                "name" => $request->name,
                "email" => $request->email,
                "country" => $request->country,
            ]);

            return redirect(route("costumers"))->with("success", "Usuário cadastrado com sucesso!");
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }    
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $entity = $request->entity;
        $references = Reference::join('entities', 'references.id_entity', 'entities.id')->select('entities.name', 'references.*')->where('entities.id', $entity->id)->get();
        return response()->json(["references" => $references, "entity" => $entity]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $reference_number)
    {
        //
        try {
            $entity = $request->entity;

            $reference = Reference::create([
                'amount' => $request->amount,
                'end_datetime' => $request->end_datetime,
                'reference_id' => $reference_number,
                'entity_code' => $entity->code,
                'id_entity' => $entity->id,
            ]);
            return response()->json(['message' => 'Reference created', 'reference' => $reference], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Error creating reference', 'entity' => $entity], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $reference_number)
    {
        //
        $entity = $request->entity;
        $reference = Reference::where('reference_id', $reference_number)->first();

        if (!$reference) {
            return response()->json(['message' => 'Reference not found'], 404);
        }

        return response()->json(['Reference' => $reference]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $reference_number)
    {
        //

        try {
            $entity = $request->entity;

            $reference = Reference::where('reference_id', $reference_number)->update([
                'amount' => $request->amount,
                'end_datetime' => $request->end_datetime,
                'entity_code' => $entity->code,
                'id_entity' => $entity->id,
            ]);
            return response()->json(['message' => 'Reference updated', 'reference' => $reference], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => 'Error updating reference', 'entity' =>  $entity], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $reference_number)
    {
        //
        $entity = $request->entity;
        $reference = Reference::where('reference_id', $reference_number)->first();

        if (!$reference) {
            return response()->json(['message' => 'Reference not found'], 404);
        }

        $reference->delete();

        return response()->json(['message' =>  'Reference deleted']);
    }
    public function reference_ids(Request $request){
        $entity = $request->entity;
        $reference_id = $this->generateReference();
        return response()->json(['reference_id' =>  $reference_id]);
    }


    private function generateReference()
    {
        $reference_id = rand(100000000, 999999999); // Gera um número aleatório de 9 dígitos

        // Verificar se o código gerado já existe no banco de dados
        while (Reference::where('reference_id', $reference_id)->where('status','pending')->exists() || Reference::where('reference_id', $reference_id)->withTrashed()->where('status','pending')->exists()) {
            $reference_id = rand(100000000, 999999999); // Gera um novo número aleatório
        }

        return $reference_id;
        
    }

    

}


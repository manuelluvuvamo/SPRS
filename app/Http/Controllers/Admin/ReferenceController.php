<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use App\Models\Payment;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReferenceController extends Controller
{
    //

    public function __construct()
    {

        $this->Logger = new Logger();
    }
    public function loggerData($mensagem)
    {

        $this->Logger->Log('info', $mensagem);
    }
    public function loggerDataError($mensagem)
    {

        $this->Logger->Log('error', $mensagem);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data["references"] = Reference::join('entities', 'references.id_entity', 'entities.id')->select('entities.name', 'entities.code', 'references.*')->get();

        return view('admin.reference.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["entities"] = Entity::all();
        return view('admin.reference.create.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //dd($request);
        $request->validate([
            'amount' => 'required',
            'end_datetime' => 'required',
            'id_entity' => 'required',

        ], [
                'amount.required' => 'O Valor da Referência é um campo Obrigatório',
                'end_datetime.required' => 'A Expiração da Referência é um campo Obrigatório',
                'id_entity.required' => 'A Entidade da Referência é um campo Obrigatório',
            ]);

        try {
            $entity = Entity::find($request->id_entity);
            # co
            $ref = isset($request->reference_number) ? $request->reference_number : $this->generateReference();
            $reference = Reference::create([
                'amount' => $request->amount,
                'end_datetime' => $request->end_datetime,
                'reference_id' => $ref,
                'entity_code' => $entity->code,
                'id_entity' => $request->id_entity,

            ]);

            $this->loggerData(" Cadastrou a referência  de " . $request->amount . ", id: " . $reference->id);
            return redirect()->back()->with('reference.create.success', 1);

        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('reference.create.error', 1);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data["reference"] = Reference::join('entities', 'references.id_entity', 'entities.id')->select('entities.*', 'references.*')->where('references.id', $id)->first();
        return view('admin.reference.edit.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data["reference"] = Reference::join('entities', 'references.id_entity', 'entities.id')->select('entities.*', 'references.*')->where('references.id', $id)->first();
        return view('admin.reference.edit.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //

        $request->validate([
            'amount' => 'required',
            'end_datetime' => 'required',
            'id_entity' => 'required',

        ], [
                'amount.required' => 'O Valor da Referência é um campo Obrigatório',
                'end_datetime.required' => 'A Expiração da Referência é um campo Obrigatório',
                'id_entity.required' => 'A Entidade da Referência é um campo Obrigatório',
            ]);

        try {
            //code...
            $cur = Reference::find($id);
            $entity = Entity::find($request->id_entity);
            $ref = isset($request->reference_number) ? $request->reference_number : $this->generateReference();
            $reference = Reference::findOrFail($id)->update([

                'amount' => $request->amount,
                'end_datetime' => $request->end_datetime,
                'reference_id' => $ref,
                'entity_code' => $entity->code,
                'id_entity' => $request->id_entity,

            ]);
            $this->loggerData("Editou a reference de id, valor, expiração e id de referência ($cur->id, $cur->amount, $cur->end_datetime,  $cur->reference_id ) para ($request->amount, $request->end_datetime,  $ref)");

            return redirect()->back()->with('reference.update.success', 1);

        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('reference.update.error', 1);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            //code...
            $reference = Reference::findOrFail($id);

            Reference::findOrFail($id)->delete();
            $this->loggerData("Eliminou a referência de id, valor, id de referência e data de expiração ($reference->id, $reference->amount, $reference->reference_id, $reference->end_datetime)");
            return redirect()->back()->with('reference.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('reference.destroy.error', 1);
        }
    }

    public function purge($id)
    {
        //
        try {

            $reference = Reference::findOrFail($id);


            Reference::findOrFail($id)->forceDelete();
            $this->loggerData("Purgou a referência de id, valor, id de referência e data de expiração ($reference->id, $reference->amount, $reference->reference_id, $reference->end_datetime)");
            return redirect()->back()->with('reference.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('reference.purge.error', 1);
        }
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

    public function pay($id)
    {
        //
        try {
            //code...
            $reference = Reference::findOrFail($id);

            $payment = Payment::create([
                'amount' =>$reference->amount,
                'reference_id' =>$reference->reference_id,
                'id_reference' =>$reference->id,
                'entity_code' =>$reference->entity_code,
            ]);

            $reference->update([
                'status'=>'paid',
            ]);
            
            $this->loggerData("Pagou a referência de id, valor, id de referência e data de expiração ($reference->id, $reference->amount, $reference->reference_id, $reference->end_datetime)");
            return redirect()->back()->with('reference.pay.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('reference.pay.error', 1);
        }
    }
}
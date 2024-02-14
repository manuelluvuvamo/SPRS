<?php

namespace App\Http\Controllers\Admin;

use App\Events\EntidadeCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Entity;
use App\Models\Logger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EntityController extends Controller
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

        $data["entities"] = Entity::join('users','entities.id_user','users.id')
        ->select('users.name as user', 'users.first_name','users.middle_name', 'users.last_name', 'entities.*')->get();
        
      

        if (Auth::user()->level != "Administrador") {
            # code...
            $data["entities"] = Entity::where('id_user', Auth::user()->id)->get();
        }
        //dd( $data["entities"]);
        return view('admin.entity.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data["users"] = User::get();
        return view('admin.entity.create.index', $data);
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
            'name' => 'required|string|max:255',
            'short_name' => 'string|max:10',
            'nif' => 'max:14|unique:entities',
            'email' => 'string|email|unique:entities',
            'phone_number' => 'unique:entities',
            'code' => 'unique:entities',

        ], [
                'name.required' => 'O Nome da entidade é um campo Obrigatório',
                'short_name.max' => 'O Nome Curto da entidade deve ter no máximo 10 caracteres',
                'nif.max' => 'O NIF deve ter no máximo 14 caracteres',
                'nif.unique' => 'O NIF que introduziu já está sendo utilizado por uma entidade',
                'email.unique' => 'O Email que introduziu já está sendo utilizado por uma entidade',
                'phone_number.unique' => 'O Telefone que introduziu já está sendo utilizado por uma entidade',
                'code.unique' => 'O Código de Entidade que introduziu já está sendo utilizado por uma entidade',
            ]);

        try {
            //code...


            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $upload = $this->upload_img($request);


                $entity = Entity::create([
                    'nif' => $request->nif,
                    'email' => $request->email,
                    'name' => $request->name,
                    'short_name' => $request->short_name,
                    'phone_number' => $request->phone_number,
                    'image' => $upload,
                    'api_token' => Str::random(60),
                    'code' => $request->code,
                    'id_user' => ($request->id_user)?$request->id_user:Auth::user()->id, 

                ]);
                // Dispare o evento EntidadeCreated
                //event(new EntidadeCreated($entity));

                $this->loggerData(" Cadastrou a entidade " . $request->name . ", id: " . $entity->id . ", Email: $request->email" . ", NIF: $request->nif e Telefone: $request->phone_number");
                return redirect()->back()->with('entity.create.success', 1);

            } else {
                # co
                $entity = Entity::create([
                    'nif' => $request->nif,
                    'email' => $request->email,
                    'name' => $request->name,
                    'short_name' => $request->short_name,
                    'phone_number' => $request->phone_number,
                    'api_token' => Str::random(60),
                    'code' => $request->code,
                    'id_user' => ($request->id_user)?$request->id_user:Auth::user()->id, 

                ]);
                // Dispare o evento EntidadeCreated
                //event(new EntidadeCreated($entity));
                $this->loggerData(" Cadastrou a entidade " . $request->name . ", id: " . $entity->id . ", Email: $request->email" . ", NIF: $request->nif e Telefone: $request->phone_number");
                return redirect()->back()->with('entity.create.success', 1);
            }
        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('entity.create.error', 1);
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
        $data["entity"] = Entity:: join('users','entities.id_user','users.id')
        ->select('users.name as user', 'users.first_name','users.middle_name', 'users.last_name', 'entities.*')->where('entities.id',$id)->first();
        $data["users"] = User::get();
        return view('admin.entity.edit.index', $data);
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
            'name' => 'required|string|max:255',
            'short_name' => 'string|max:10',
            'nif' => 'max:14',
            'email' => 'string|email',
            


        ], [
                'name.required' => 'O Nome da entidade é um campo Obrigatório',
                'short_name.max' => 'O Nome Curto da entidade deve ter no máximo 10 caracteres',
                'nif.max' => 'O NIF deve ter no máximo 14 caracteres',

            ]);

      /*   try { */
            //code...
            $emp = Entity::find($id);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {

                $upload = $this->upload_img($request);

                if (isset($emp->image)) {
                    # code...
                    $path = public_path($emp->image);
                    unlink($path);
                }




                $entity = Entity::findOrFail($id)->update([
                    'nif' => $request->nif,
                    'email' => $request->email,
                    'name' => $request->name,
                    'short_name' => $request->short_name,
                    'phone_number' => $request->phone_number,
                    'image' => $upload,
                    'code' => $request->code,
                    'id_user' => ($request->id_user)?$request->id_user:Auth::user()->id, 


                ]);
                $this->loggerData("Editou a entidade de id, nome, nome curto, email, nif, telefone ($emp->id, $emp->name, $emp->short_name, $emp->email, $emp->nif, $emp->phone_number) para ($request->name, $request->short_name, $request->email, $request->nif, $request->phone_number)");
                return redirect()->back()->with('entity.update.success', 1);


            } else {
                # code...




                $entity = Entity::findOrFail($id)->update([
                    'nif' => $request->nif,
                    'email' => $request->email,
                    'name' => $request->name,
                    'short_name' => $request->short_name,
                    'phone_number' => $request->phone_number,
                    'code' => $request->code,
                    'id_user' => ($request->id_user)?$request->id_user:Auth::user()->id, 

                ]);
                $this->loggerData("Editou a entidade de id, nome, nome curto, email, nif, telefone ($emp->id, $emp->name, $emp->short_name, $emp->email, $emp->nif, $emp->phone_number ) para ($request->name, $request->short_name, $request->email, $request->nif, $request->phone_number )");

                return redirect()->back()->with('entity.update.success', 1);
            }
        /* } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('entity.update.error', 1);
        } */
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
            $entity = Entity::findOrFail($id);

            /*  if (isset($entity->image)) {
                 # code...
                   $path = public_path($entity->image);
                  if (is_dir( $path)) {
                     # code...
                     unlink($path);
                 }
             } */

            Entity::findOrFail($id)->delete();
            $this->loggerData("Eliminou a entidade de id, nome, nome curto, email, nif, telefone ($entity->id, $entity->name, $entity->short_name, $entity->email, $entity->nif, $entity->phone_number ) ");
            return redirect()->back()->with('entity.destroy.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('entity.destroy.error', 1);
        }
    }

    public function purge($id)
    {
        //
        try {

            $entity = Entity::findOrFail($id);

            if (isset($entity->image)) {
                # code...
                $path = public_path($entity->image);
                if (is_dir($path)) {
                    # code...
                    unlink($path);
                }

            }

            Entity::findOrFail($id)->forceDelete();
            $this->loggerData("Purgou a entidade de id, nome, nome curto, email, nif, telefone ($entity->id, $entity->name, $entity->short_name, $entity->email, $entity->nif, $entity->phone_number ) ");
            return redirect()->back()->with('entity.purge.success', 1);
        } catch (\Throwable $th) {
            //throw $th;
            $this->loggerDataError($th->getMessage());
            return redirect()->back()->with('entity.purge.error', 1);
        }
    }






    public function upload_img(Request $request)
    {


        $name = uniqid(date('HisYmd'));
        $image = $request->file('image');
        // Recupera a extensão do arquivo
        $extension = $request->image->extension();
        $nameFile = "{$name}.{$extension}";
        $destinationPath = public_path("/images/entidade");
        $image->move($destinationPath, $nameFile);
        $upload = "images/entidade/" . $nameFile;

        // Verifica se NÃO deu certo o upload ( Redireciona de volta )
        if (!$upload) {
            return redirect()
                ->back()
                ->with('error', 'Falha ao fazer upload')
                ->withInput();
        } else {

            return $upload;

        }
    }

    private function gerarcodeUnico()
    {
        $codeUnico = mt_rand(10000, 99999); // Gera um número aleatório de 5 dígitos

        // Verificar se o código gerado já existe no banco de dados
        while (Entity::where('code', $codeUnico)->exists()) {
            $codeUnico = mt_rand(10000, 99999); // Gera um novo número aleatório
        }

        return $codeUnico;
    }


}
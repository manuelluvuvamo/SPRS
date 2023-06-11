<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index(){
        $data["payments"] = Payment::join('references', 'payments.id_reference', 'references.id')
        ->join('entities', 'references.id_entity', 'entities.id')
        ->select('entities.name', 'entities.code', 'references.*','payments.created_at','payments.id')->get();

        return view('admin.payment.index', $data);
    }

    public function index2(){
        $data["payments"] = Payment::join('references', 'payments.id_reference', 'references.id')
        ->join('entities', 'references.id_entity', 'entities.id')
        ->select('entities.name', 'entities.code', 'references.*','payments.deleted_at','payments.id')
        ->onlyTrashed()
        ->get();

        return view('admin.payment.index2', $data);
    }
}

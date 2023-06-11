<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $entity = $request->entity;
        $payments = Payment::join('references', 'payments.id_reference', 'references.id')
        ->join('entities', 'references.id_entity', 'entities.id')
        ->select('entities.name', 'entities.code', 'references.amount', 'references.reference_id','references.end_datetime','payments.created_at as pyment_datetime','payments.id')
        ->where('entities.id', $entity->id)->get();
        return response()->json(["payments" => $payments, "entity" => $entity]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
        $entity = $request->entity;
        $payment = payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();

        return response()->json(['message' =>  'Payment deleted']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuetationStoreRequest;
use App\Mail\AlertMail;
use App\Models\Prescription;
use App\Models\Product;
use App\Models\Quetation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class QuetationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('QUETATION VIEW');

        $prescriptions = Prescription::with('customer')
                        ->whereNotNull('status')
                        ->when(auth()->user()->type != 1, function($query){
                            return  $query->where('added_by',auth()->user()->id);
                        });
        $prescriptions = $prescriptions->get();

        return Inertia::render('Quetation/view',['prescriptions' => $prescriptions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuetationStoreRequest $request)
    {
        $this->authorize('QUETATION SEND');

        foreach($request->validated()['products'] as $product){

            $quetation = new Quetation();
            $quetation->prescription_id = $request->validated()['prescription_id'];
            $quetation->product_id = $product['id'];
            $quetation->qty = $product['qty'];
            $quetation->save();

        }

        $prescription = Prescription::find($request->validated()['prescription_id']);


        $prescription = Prescription::with('customer','user','images','quetation.product')->where('id',$request->validated()['prescription_id'])->first();
        $prescription->status = 2;
        $prescription->update();

        Mail::to($prescription->customer->email)->send(new AlertMail($prescription));

        return redirect()->route('prescriptions.index')
        ->with('message', 'quetation sent successfully');
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
    }
}

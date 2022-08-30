<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrescriptionStoreRequest;
use App\Models\Prescription;
use App\Models\Product;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('PRESCRIPTION VIEW');

        $prescriptions = Prescription::with('customer')
                        ->whereNull('status')
                        ->when(auth()->user()->type != 1, function($query){
                            return  $query->where('added_by',auth()->user()->id);
                        });
        $prescriptions = $prescriptions->get();

        return Inertia::render('Prescription/view',['prescriptions' => $prescriptions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('PRESCRIPTION ADD');

        $period = new CarbonPeriod('00:00', '2 hours', '24:00');
        $slots = [];
        foreach($period as $item){
            array_push($slots,$item->format("h:i A"));
        }

        $newSlots = [];
        foreach($slots as $key => $slot){
            if(isset($slots[$key+1])){
                array_push($newSlots,($slot." - ".$slots[$key+1]));
            }
        }

        return Inertia::render('Prescription/add',[
            "timeSlots" => $newSlots
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrescriptionStoreRequest $request)
    {
        $this->authorize('PRESCRIPTION ADD');

        $prescription = Prescription::create($request->validated() + ['added_by' => auth()->user()->id]);

        foreach($request->validated()['images'] as $key=>$base64Image){

            $image_64 = $base64Image; //your base64 encoded data

            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        
            $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
        
            // find substring fro replace here eg: data:image/png;base64,
            
            $image = str_replace($replace, '', $image_64); 
            
            $image = str_replace(' ', '+', $image); 
            
            $imageName = $key.'_'.time().'.'.$extension;
            
            Storage::disk('public')->put($imageName, base64_decode($image));

            $prescription->images()->create( [
                "path" => "/"."storage/". $imageName
            ]);

           
        }

        return redirect()->route('prescriptions.index')
        ->with('message', 'prescription created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('PRESCRIPTION VIEW DETAILS');

        $products = Product::all();
        $prescription = Prescription::with('customer','user','images','quetation.product')->where('id',$id)->first();

        return Inertia::render('Prescription/details',[
            "prescription" => $prescription,
            "products" => $products
        ]);
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

    public function status($id, $status)
    {
        // $status == 1 
        // ? $this->authorize('QUETATION ACCEPT')
        // : $this->authorize('QUETATION REJECT');

        $prescription = Prescription::find($id);
        $prescription->status = $status;
        $prescription->update();

        $msg = $status == 1
                ? 'Quetaion Aprroved'
                : ($status == 0
                ? 'Quetaion Rejected'
                :'' );

        return redirect()->route('prescriptions.show',$id)
        ->with('message', $msg);

    }
}

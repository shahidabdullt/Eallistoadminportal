<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreCustomerRequest;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function customersinvoiceslists(Request $request){
        $type=$request->query('type');
        if($type=='customer'){
            $users=User::where('isadmin','0')->get();
            return view('customerslists',['users'=>$users]);
        }
        else if($type=='invoice'){
            $invoices=Invoice::paginate(7)->appends(['type'=>'invoice']); 
        
            return view('invoiceslists',['invoices'=>$invoices]);
        }
       
       
    }

    public function customerAndInvoiceCreation(Request $request,){
        $type=$request->query('type');
        if($type=='customer'){
            return view('customercreation');
        }
        elseif($type=='invoice'){
            $users=User::where('isadmin','0')->get();
            
            return view('invoicecreation',['users'=>$users]);
        }

        abort(404,'invalid request type');
       
    }

    public function customerAndInvoiceRegister(Request $request){
        $type=$request->input('type');
       
        if($type==='customer'){
            $validated=Validator::make($request->all(),(new StoreCustomerRequest())->rules());
            $validated=$validated->validated();
                User::create($validated);
                return redirect()->route('customersinvoices', ['type' => 'customer']);

        }
       elseif($type==='invoice'){
        
        $validatedinvoice=Validator::make($request->all(),(new StoreInvoiceRequest())->rules());
        
        $validatedinvoice=$validatedinvoice->validated();
            $validatedinvoice['user_id']=$request->input('useridinvoice');
             $invoice=Invoice::create($validatedinvoice);
           
            if ($invoice->status == 'Unpaid') {
                return redirect()->route('invoice.pay', ['invoice_id' => $invoice->id]);
            }
            else{
                return redirect()->route('customersinvoices', ['type' => 'invoice']);
            }
          

       }
      
       abort(404, "Invalid request type");
      
      
    }

    public function edit($id){
        $user=User::find($id);
        if(!$user){
            return response()->json(['error'=>'User not found'],404);
        }

        return response()->json($user);
        
    }

    public function invoiceedit($id){
        // dd($id);
        $invoice=Invoice::with('user')->find($id);
        if(!$invoice){
            return response()->json(['error'=>'invoice not found'],404);
        }

        return response()->json($invoice);
    }

    public function update(Request $request,$userid){ 
        $user= User::find($userid);
        $userid=$user->id;
        if(!$user){
            return response()->json(['user not found'],404);
        }
        $validated=$request->validate([
            'username'=>['required'],
            'address'=>['nullable'],
            'mobile'=>['nullable','digits_between:7,15'],
            'email'=>['nullable','email',Rule::unique('users')->ignore($userid)],
        ]);
        // $data = $request->validated();
    $user->update($validated);
       
    return response()->json(['message' => 'User updated successfully']);
          
       
    }

    public function invoiceupdate(StoreInvoiceRequest $invoicerequest,$id){
        
        $invoice= Invoice::find($id);
        if(!$invoice){
            return response()->json(['invoice not found'],404);
        }
     $validated=Validator::make($invoicerequest->all(),(new StoreInvoiceRequest())->rules());
     $validated=$validated->validated();
       $invoice->update([
        'date'   => $validated['date'] ,
        'amount' => $validated['amount'] ,
        'status' => $validated['status'],
    ]);

    
 
       
    return response()->json(['message' => 'Invoice updated successfully']);
    }
}

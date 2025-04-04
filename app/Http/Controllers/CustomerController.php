<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
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
            $invoices=Invoice::all(); 
        
            return view('invoiceslists',['invoices'=>$invoices]);
        }
       
       
    }

    public function customerAndInvoiceCreation(Request $request){
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
        $type=$request->query('type');
        if($type=='customer'){
            $validated=$request->validate([
                'username' => 'required',
                'email' => 'nullable|email|unique:users,email',
                'mobile' => 'nullable|digits_between:7,15',
                'address'=>'nullable',
                'password'=>'nullable',
                ]);
                User::create($validated);
                return redirect()->route('customersinvoices', ['type' => 'customer']);

        }
       elseif($type=='invoice'){
        $validatedinvoice=$request->validate([ 
            'user_id' => 'required|exists:users,id',
            'date'=>'nullable|date',
            'amount'=>'nullable|numeric',
            'status'=>'required|in:Unpaid,Paid,Cancelled',           
            ]);
            Invoice::create($validatedinvoice);
            return redirect()->route('customersinvoices', ['type' => 'invoice']);

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

    public function update(Request $request,$id){ 
        $user= User::find($id);
        if(!$user){
            return response()->json(['user not found'],404);
        }
        $validated= $request->validate([
        'username'=>'required|string',
        'email'=>'nullable','email',Rule::unique('users')->ignore($user->id), //ignore current users email
        'mobile' => 'nullable|digits_between:7,15',
        'address'=>'nullable',
       ]);
      
       $user->update($validated);
       
    return response()->json(['message' => 'User updated successfully']);
          
       
    }

    public function invoiceupdate(Request $request,$id){
        $invoice= Invoice::find($id);
        if(!$invoice){
            return response()->json(['invoice not found'],404);
        }
        $validated= $request->validate([
        'username'=>'required|string',
        'useridinvoice'=>'required|integer',
        'date'=>'nullable|date', 
        'amount' => 'nullable|numeric',
        'status'=>'required|in:Unpaid,Paid,Cancelled',
       ]);
      
       $invoice->update([
        'date'   => $validated['date'] ,
        'amount' => $validated['amount'] ,
        'status' => $validated['status'],
    ]);

    
 
       
    return response()->json(['message' => 'Invoice updated successfully']);
    }
}

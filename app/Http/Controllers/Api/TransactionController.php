<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Transaction;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::all();

        if(count($transaction) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaction
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $transaction = Transaction::find($id);

        if(!is_null($transaction)){
            return response([
                'message' => 'Retrieve Transaction Success',
                'data' => $transaction
            ],200);
        }

        return response([
            'message' => 'Transaction Not Found',
            'data' => null
        ],404);

    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'nama_lengkap' => 'required|max:60',
            'phone_number_transaksi' => 'required',
            'booking_date' => 'required',
            'checkout_date' => 'required',
            'room_type' => 'required',
            'totalpayment' => 'required',
            'payment_with' => 'required'
        ]);

        if($validate -> fails())
            return response(['message' => $validate ->errors()],400);

        $transaction = Transaction::create($storeData);
        return response([
            'message' => 'Add Transaction Success',
            'data' => $transaction,
        ],200);
    }

    public function destroy($id){
        $transaction = Transaction::find($id);

        if(is_null($transaction)){
            return response([
                'message' => 'Transaction Not Found',
                'data' => null
            ],404);
        }

        if($transaction -> delete()){
            return response([
                'message' => 'Delete Transaction Success',
                'data' => $transaction,
            ],200);
        }
        return response([
            'message' => 'Delete Transaction Failed',
            'data' => null,
        ],400);


    }

    public function update(Request $request, $id){
        $transaction = Transaction::find($id);
        if(is_null($transaction)){
            return response([
                'message' => 'Transaction Not Found',
                'data' => null
            ],404);
        }
//MAYBE THIS IS ERROR
        $updateData = $request -> all();
        $validate = Validator::make($updateData,[
            'nama_lengkap' => 'required|max:60',
            'phone_number_transaksi' => 'required',
            'booking_date' => 'required',
            'checkout_date' => 'required',
            'room_type' => 'required',
            'totalpayment' => 'required',
            'payment_with' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);


        $transaction->nama_lengkap = $updateData['nama_lengkap'];
        $transaction->phone_number_transaksi = $updateData['phone_number_transaksi'];
        $transaction->booking_date = $updateData['booking_date'];
        $transaction->checkout_date = $updateData['checkout_date'];
        $transaction->room_type = $updateData['room_type'];
        $transaction->totalpayment = $updateData['totalpayment'];
        $transaction->payment_with = $updateData['payment_with'];

        if($transaction->save()){
            return response([
                'message' => 'Update Transaction Success',
                'data' => $Transaction,
            ],200);
        }

        return response([
            'message' => 'Update Transaction Failed',
            'data' => null,
        ],400);

    }
}

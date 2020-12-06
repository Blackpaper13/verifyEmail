<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Room;

class RoomController extends Controller
{
    public function index(){
        $room = Room::all();

        if(count($room) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $room
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $room = Room::find($id);

        if(!is_null($room)){
            return response([
                'message' => 'Retrieve Room Success',
                'data' => $room
            ],200);
        }

        return response([
            'message' => 'Room Not Found',
            'data' => null
        ],404);

    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'nama_tipe' => 'required',
            'bed' => 'required',
            'harga_kamar' => 'required'
        ]);

        if($validate -> fails())
            return response(['message' => $validate ->errors()],400);

        $room = Room::create($storeData);
        return response([
            'message' => 'Add Room Success',
            'data' => $room,
        ],200);
    }

    public function destroy($id){
        $room = Room::find($id);

        if(is_null($room)){
            return response([
                'message' => 'Room Not Found',
                'data' => null
            ],404);
        }

        if($room -> delete()){
            return response([
                'message' => 'Delete Room Success',
                'data' => $room,
            ],200);
        }
        return response([
            'message' => 'Delete Room Failed',
            'data' => null,
        ],400);


    }

    public function update(Request $request, $id){
        $room = Room::find($id);
        if(is_null($room)){
            return response([
                'message' => 'Room Not Found',
                'data' => null
            ],404);
        }
        //MAYBE THIS IS ERROR
        $updateData = $request -> all();
        $validate = Validator::make($updateData,[
            'nama_tipe' => 'required',
            'bed' => 'required',
            'harga_kamar' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);


        $room->nama_tipe = $updateData['nama_tipe'];
        $room->bed = $updateData['bed'];
        $room->harga_kamar = $updateData['harga_kamar'];

        if($room->save()){
            return response([
                'message' => 'Update Room Success',
                'data' => $room,
            ],200);
        }

        return response([
            'message' => 'Update Room Failed',
            'data' => null,
        ],400);

    }
}

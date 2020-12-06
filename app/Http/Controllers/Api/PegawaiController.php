<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Pegawai;


class PegawaiController extends Controller
{
    public function index(){
        $pegawai = Pegawai::all();

        if(count($pegawai) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pegawai
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $pegawai = Pegawai::find($id);

        if(!is_null($pegawai)){
            return response([
                'message' => 'Retrieve Pegawai Success',
                'data' => $pegawai
            ],200);
        }

        return response([
            'message' => 'Pegawai Not Found',
            'data' => null
        ],404);

    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData,[
            'nama_pegawai' => 'required|max:60',
            'umur' => 'required',
            'job' => 'required',
            'gaji' => 'required'
        ]);

        if($validate -> fails())
            return response(['message' => $validate ->errors()],400);

        $pegawai = Pegawai::create($storeData);
        return response([
            'message' => 'Add Pegawai Success',
            'data' => $pegawai,
        ],200);
    }

    public function destroy($id){
        $pegawai = Pegawai::find($id);

        if(is_null($pegawai)){
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ],404);
        }

        if($pegawai -> delete()){
            return response([
                'message' => 'Delete Pegawai Success',
                'data' => $pegawai,
            ],200);
        }
        return response([
            'message' => 'Delete Pegawai Failed',
            'data' => null,
        ],400);


    }

    public function update(Request $request, $id){
        $pegawai = Pegawai::find($id);
        if(is_null($pegawai)){
            return response([
                'message' => 'Pegawai Not Found',
                'data' => null
            ],404);
        }
//MAYBE THIS IS ERROR
        $updateData = $request -> all();
        $validate = Validator::make($updateData,[
            'nama_pegawai' => 'max:60',
            'umur' => 'required',
            'job' => 'required',
            'gaji' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);


        $pegawai->nama_pegawai = $updateData['nama_pegawai'];
        $pegawai->umur = $updateData['umur'];
        $pegawai->job = $updateData['job'];
        $pegawai->gaji = $updateData['gaji'];

        if($pegawai->save()){
            return response([
                'message' => 'Update Pegawai Success',
                'data' => $pegawai,
            ],200);
        }

        return response([
            'message' => 'Update Pegawai Failed',
            'data' => null,
        ],400);

    }
}

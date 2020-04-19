<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Detail_model;
use App\Mobil_model;
use Auth;

class DetailController extends Controller
{
    public function store(Request $request)
    {

        if(Auth::User()->level=="petugas"){
        $validator=Validator::make($request->all(),[
            'id_transaksi'=>'required',
            'id_mobil'=>'required',
            'lama_sewa'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $harga = Mobil_model::where('id_mobil',$request->id_mobil)->first();
        $total = $harga->harga_sewa_per_hari * $request->lama_sewa;
        
            $simpan=Detail_model::insert([
                'id_transaksi'=>$request->id_transaksi,
                'id_mobil'=>$request->id_mobil,
                'total'=>$total,
                'lama_sewa'=>$request->lama_sewa

            ]);
            if($simpan){
                $status="Sukses menambahkan data!";
            }else{
                $status="Gagal menambahkan data!";
            }
            return response()->json(compact('status'));
        
        }else{
        return response()->json(['status'=>'anda bukan petugas']);
        }
    }

    public function tampil_detail()
    {
        if(Auth::User()->level=="petugas"){
            $dt_detail=Detail_model::get();
            return response()->json($dt_detail);
        }else{
            return response()->json(['status'=>'anda bukan petugas']);
        }
    }
}

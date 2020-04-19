<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Transaksi_model;
use App\Detail_model;
use App\Mobil_model;
use Auth;
use DB;
class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'id_penyewa'=>'required',
            'id_petugas'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),
            400);
        }else{
            $insert=Transaksi_model::insert([
                'id_penyewa'=>$request->id_penyewa,

                'id_petugas'=>$request->id_petugas
            ]);
            if($insert){
                $status="Sukses menambahkan data!";
            }else{
                $status="Gagal menambahkan data!";
            }
            return response()->json(compact('status'));
        }
    }

    public function tampil_transaksi(Request $req)
    {
        $transaksi=DB::table('transaksi')->join('penyewa', 'penyewa.id_penyewa', 'transaksi.id_penyewa')
                                         ->get();

        if($transaksi->count() > 0){
            $data_transaksi = array();
       

        foreach ($transaksi as $t){
            $grand = DB::table('detail_transaksi')->select('total')
            ->get();
            
            $detail = DB::table('detail_transaksi')->join('jenis_mobil','detail_transaksi.id_jenis_mobil','=','jenis_mobil.id_jenis_mobil')
            ->where('id_transaksi','=',$t->id_transaksi)
            ->get();

            $data_transaksi = array(
                'nama penyewa' => $t->nama_penyewa,
                'alamat' => $t->alamat,
                'telp' => $t->telp,
                'no_ktp' => $t->no_ktp,
                'total bayar' => $grand,
                'detail' => $detail,
            );
        }
        return Response()->json($data_transaksi);
    
    }
    }
}

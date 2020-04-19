<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Penyewa_model;
use Auth;

class PenyewaController extends Controller
{
    public function store(Request $request)
    {
        if(Auth::User()->level=="admin"){
        $validator=Validator::make($request->all(),[
            'nama_penyewa'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'no_ktp'=>'required'
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),
            400);
        }else{
            $insert=Penyewa_model::insert([
                'nama_penyewa'=>$request->nama_penyewa,
                'alamat'=>$request->alamat,
                'telp'=>$request->telp,
                'no_ktp'=>$request->no_ktp
            ]);
            if($insert){
                $status="Sukses menambahkan data!";
            }else{
                $status="Gagal menambahkan data!";
            }
            return response()->json(compact('status'));
        }
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function update($id,Request $req)
    {
        if(Auth::User()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama_penyewa'=>'required',
            'alamat'=>'required',
            'telp'=>'required',
            'no_ktp'=>'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Penyewa_model::where('id_penyewa', $id)->update([
            'nama_penyewa'=>$req->nama_penyewa,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp,
            'no_ktp'=>$request->no_ktp
        ]);
        if($ubah){
            return Response()->json(['status'=>'Data berhasil diubah!']);
        }else{
            return Response()->json(['status'=>'Data gagal diubah!']);
        }
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }
    public function destroy($id)
    {
        if(Auth::User()->level=="admin"){
        $hapus=Penyewa_model::where('id_penyewa',$id)->delete();
        if($hapus){
            return Response()->json(['status'=>'Data berhasil dihapus!']);
        }else{
            return Response()->json(['status'=>'Data gagal dihapus!']);
        }
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }

    public function tampil_penyewa()
    {
        if(Auth::User()->level=="admin"){
        $data_penyewa=Penyewa_model::get();
        return Response()->json($data_penyewa);
        
        }else{
        return response()->json(['status'=>'anda bukan admin']);
        }
    }
}

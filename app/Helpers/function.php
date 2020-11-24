<?php

function periode(){
    $data=App\Perioderisikobisnis::all();

    return $data;
}
function cek_periode($id){
    $data=App\Perioderisikobisnis::where('id',$id)->first();

    return $data['name'];
}

function unitkerja(){
    $data=App\Unitkerja::all();

    return $data;
}

function detail_risiko_get($id){
    $data=App\Risikobisnisdetail::whereIn('risikobisnis_id',$id)->get();

    return $data;
}

function sumber_risiko_get($id){
    $data=App\Sumberrisiko::where('risikobisnisdetail_id',$id)->get();

    return $data;
}

function sumber_risiko_count($id){
    $data=App\Sumberrisiko::where('risikobisnisdetail_id',$id)->count();

    return $data;
}

function cek_kpi($id){
    $data=App\Kpi::where('id',$id)->first();
    return $data;
}

function cek_unit($id){
    $data=App\Unitkerja::where('objectabbr',$id)->first();
    return $data['nama'];
}

function cek_dampak($id){
    $data=App\Dampak::where('id',$id)->first();
    return $data['nama'];
}

function cek_rolenya(){
    
    $data=App\Model_has_roles::where('model_id',Auth::user()['nik'])->first();
    return $data['role_id'];
}

function cek_matrik($peluang,$dampak){
    $data=App\Matrikrisiko::where('dampak_id',$dampak)->where('peluang_id',$peluang)->first();
    return $data;
}

function total_kpi($priode){
    
}
function cek_kriteria($dampak_id,$kategori_id,$kriteriatipe){
    $data=App\Kriteria::where('dampak_id',$dampak_id)->where('kategori_id',$kategori_id)->where('tipe',$kriteriatipe)->first();
    return $data;
}

function cek_klasifikasi($id){
    $data=App\Klasifikasi::where('id',$id)->first();
    return $data;
}

function risiko_bisnis_get($unit,$periode){
    $data  = array_column(
        App\Risikobisnis::where('unit_id',$unit)->where('perioderisikobisnis_id',$periode)->get()->toArray(),'id');

    return $data;
}

function subdit(){
    $data  = array_column(
        App\Unitkerja::where('nama','LIKE','%Subdit%')->get()->toArray(),'objectabbr');

    return $data;
}
function divisi($unit){
    $un=substr($unit,0,2);
    if($un==''){
        $data  = array_column(
            App\Unitkerja::where('objectabbr','xxxxx')->get()->toArray(),'objectabbr');
    }else{
        $data  = array_column(
            App\Unitkerja::where('objectabbr','LIKE',$un.'%')->get()->toArray(),'objectabbr');
    }
   

    return $data;
}





?>
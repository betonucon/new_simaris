<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unitkerja;
use App\Risikobisnis;
use App\Risikobisnisdetail;
use App\Perioderisikobisnis;
use App\Sumberrisiko;
use App\Kpi;
use App\Klasifikasi;
use App\Peluang;
use App\Dampak;
use App\Kriteria;
use App\Matrikrisiko;
use App\Exports\RisikobisnisExport;
use Maatwebsite\Excel\Facades\Excel;
class LaprisikobisnisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $periode=$request->periode;
        $unitkerja=$request->unitkerja;
        $tingkat=$request->tingkat;

          
        
        return view('laporan.laprisikobisnis', compact('periode','unitkerja','tingkat'));
    }

    public function index_subdit(Request $request)
    {
        $periode=$request->periode;
        $unitkerja=$request->unitkerja;
        $tingkat=$request->tingkat;
        
          
        
        return view('laporan.laprisikobisnis_subdit', compact('periode','unitkerja','tingkat'));
    }

    public function export_excel(Request $request)
    {
        $periode=$request->periode;
        $unitkerja=$request->unit;
        $tingkat=$request->tingkat;

          
        
        return view('exports.bisnis', compact('periode','unitkerja','tingkat'));
    }
    public function export_excel_subdit(Request $request)
    {
        $periode=$request->periode;
        $unitkerja=$request->unit;
        $tingkat=$request->tingkat;

          
        
        return view('exports.bisnis_subdit', compact('periode','unitkerja','tingkat'));
    }
    function cek_kri($jenis,$param){
        $hsl='';
        if($jenis=='1'||$jenis=='4'||$jenis=='5'||$jenis=='7'){
            $hsl.='<p class="text-red">'.$param.'</p>';
        }else{
            $hsl.=''.$param.'';
        }
        return $hsl;
    }
    public function export(Request $request) 
    {
        $period = $request->periode;//'Kwartal I-2019';//
        $unit   = $request->unit;//'36000';//
        $tingkat= $request->tingkat;
        // dd($period."-".$unit."-".$tingkat);
        
        // return Excel::download(new RisikobisnisExport, 'risikobisnis.xlsx');
        return (new RisikobisnisExport)
            ->forPeriod($period)
            ->forUnit($unit)
            ->forTingkat($tingkat)
            ->download('Risikobisnis.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}

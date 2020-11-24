@extends('layouts.app')
@section('style')

@endsection

@section('content')
<script>
function exportexcel(){
    
    if (confirm("Apakah anda yakin ?") == true) {
            window.location.assign("{{url('export_excel_persubdit')}}")
     }
}

  
</script>
<style>
    table{
        margin-bottom:50px;
    }
    .ttd{
        padding:3px;
        font-size:11px;
        font-weight:bold;
        text-align:center;
        background:aqua;
    }
    .tdisi{
        padding:3px;
        font-size:11px;
        vertical-align:top;
    }
</style>
<section class="content-header">
    <h1>
        Laporan
        <small>Risiko Proses Bisnis Persubdit</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    {{-- <div class="callout callout-success"> --}}
    <div class="box">
        <div class="box-body">
                
            <table class="table table-bordered">
                <tr>
                    <th>Periode</th>
                    {{-- <th>Periode</th> --}}
                    <th>Subdit</th>
                    <th>Tingkat risiko</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <form id="formcari" method="GET">
                    
                        
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <select class="form-control select2" style="width: 100%;" name="periode"
                                            id="periode" required>
                                            <option value="">Pilih Periode</option>
                                            @foreach (periode() as $period)
                                                @if(isset($risikobisnis->periode))
                                                    @if(($period->id)==($risikobisnis->perioderisikobisnis_id)){
                                                    <option value="{{$period->id}}" selected>{{$period->nama}}/{{$period->tahun}}</option>
                                                    @else
                                                    <option value="{{$period->id}}">{{$period->nama}}/{{$period->tahun}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$period->id}}">{{$period->nama}}/{{$period->tahun}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input name="_token" value="{{ csrf_token() }}" type="hidden">
                                    </div>
                                </div>
                            </div>


                    </td>
                    <td>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-10">
                                    <select class="form-control select2" style="width: 100%;" name="unitkerja"
                                        id="unitkerja" required>
                                        <option value="">Pilih Unit</option>
                                        
                                        @foreach(subdit() as $runit)
                                            
                                            <option value="{{$runit}}">{{cek_unit($runit)}}</option>
                                            
                                        @endforeach
                                       
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                        
                    </td>
                    <td>
                            <div class="row">
                                    <div class="col-xs-10">
                                        <select class="form-control select2" style="width: 100%;" name="tingkat"
                                            id="tingkat" required>
                                            @if($tingkat=='All')
                                            <option value="">Pilih</option>
                                            <option value="All" selected>All</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Tinggi">Tinggi</option>
                                            <option value="Ekstrim">Ekstrim</option>
                                            @endif
                                            @if($tingkat=='Rendah')
                                            <option value="">Pilih</option>
                                            <option value="All">All</option>
                                            <option value="Rendah" selected>Rendah</option>
                                            <option value="Tinggi">Tinggi</option>
                                            <option value="Ekstrim">Ekstrim</option>
                                            @endif
                                            @if($tingkat=='Tinggi')
                                            <option value="">Pilih</option>
                                            <option value="All">All</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Tinggi" selected>Tinggi</option>
                                            <option value="Ekstrim">Ekstrim</option>
                                            @endif
                                            @if($tingkat=='Ekstrim')
                                            <option value="">Pilih</option>
                                            <option value="All">All</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Tinggi">Tinggi</option>
                                            <option value="Ekstrim" selected>Ekstrim</option>
                                            @endif
                                            @if($tingkat=='')
                                            <option value="">Pilih</option>
                                            <option value="All">All</option>
                                            <option value="Rendah">Rendah</option>
                                            <option value="Tinggi">Tinggi</option>
                                            <option value="Ekstrim" selected>Ekstrim</option>
                                            @endif
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                    </td>
                    <td>
                            <button type="submit" class="btn btn-primary pull-right">Cari</button>
                            
                    </form>
                    </td>
                </tr>

            </table>
        </div>
    </div>
    {{-- </div> --}}
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a class="btn btn-success" onclick="reload()"><i class="fa  fa-refresh" title=""> Refresh</i></a>
                    
                    <a href="{{url('export_excel_subdit?unit='.$unitkerja.'&tingkat='.$tingkat.'&periode='.$periode)}}" class="btn btn-info my-3" target="_blank"><i class="fa  fa-file-excel-o" title=""> Export Excel</i></a>    
                    
                </div>
                
                <div class="box-body">
                
                        @foreach(divisi($unitkerja) as $uun)
                                <table width="100%" border-collapse="collapse">
                                    <tr>
                                    <td class="ttd" colspan="4">UNIT KERJA {{cek_unit($uun)}}</td>
                                    <td class="ttd" colspan="6">RISIKO UNIT KERJA</td>
                                    </tr>
                                    <tr>
                                        <td class="ttd" rowspan="2">NO</td>
                                        <td class="ttd" rowspan="2">KPI</td>
                                        <td class="ttd" rowspan="2">NAMA RISIKO</td>
                                        <td class="ttd" rowspan="2">SUMBER AKIBAT</td>
                                        <td class="ttd" rowspan="2">AKIBAT</td>
                                        <td class="ttd" rowspan="2">TINGKAT RISIKO</td>
                                        <td class="ttd" colspan="4">RESPON RISIKO</td>
                                    </tr>
                                    <tr>
                                        <td class="ttd">MITIGASI </td>
                                        <td class="ttd">TARGET</td>
                                        <td class="ttd">PIC</td>
                                        <td class="ttd">STATUS</td>
                                    </tr>
                                    @foreach(detail_risiko_get(risiko_bisnis_get($uun,$periode)) as $no=> $resik)
                                        @foreach(sumber_risiko_get($resik['id']) as $x=> $sumber) 
                                            <tr>
                                                @if($x==0)
                                                    <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}">{{$no+1}}</td>
                                                    <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}" width="8%">{{cek_kpi($resik['id'])['nama']}}</td>
                                                    <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}" >{{$resik['risiko']}}</td>
                                                @endif
                                                    <td class="tdisi">{{$sumber['namasumber']}}</td>
                                                @if($x==0)
                                                    <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}">{{cek_kriteria($resik['dampak_id'],$resik['kategori_id'],$resik['kriteriatipe'])['nama']}}</td>
                                                    <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}">{{cek_matrik($resik['peluang_id'],$resik['dampak_id'])['tingkat']}}</td>
                                                @endif
                                                    <td class="tdisi">{{$sumber['mitigasi']}}</td>
                                                    <td class="tdisi">{{$sumber['start_date']}} S/D <br>{{$sumber['end_date']}}</td>
                                                    <td class="tdisi">{{$sumber['pic']}}</td>
                                                    <td width="5%" class="tdisi">{{$sumber['statussumber']}}</td>
                                            </tr>
                                        @endforeach 
                                    @endforeach
                                </table>
                        @endforeach
                </div>
                
            </div>
            
        </div>
        
    </div>
    @include('resiko/resikobisnis/modal/sumberresikobisnis')
    @include('resiko/risikobisnisverifi/modal/komentar')
</section>
@endsection
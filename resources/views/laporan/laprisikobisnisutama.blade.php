@extends('layouts.app')
@section('style')

@endsection

@section('content')
<script>
function exportexcel(){
    
    if (confirm("Apakah anda yakin ?") == true) {
            $.ajax({
                url: "{{ url('export') }}",
                method: 'get',
                success: function (data) {
                    if (data == 'success') {
                        alert('Export berhasil !');
                        location.reload();
                       
                    } else {
                        alert('Export gagal !');
                        location.reload();
                    }

                }
            });
        }
}

  
</script>
<section class="content-header">
    <h1>
        Laporan
        <small>Risiko Proses Bisnis KPI Utama</small>
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
                    <th>Unit Kerja</th>
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
                                            @foreach ($periodeall as $period)
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
                                        
                                        @foreach($unitkerja as $runit)
                                        @if(isset($risikobisnis))
                                        @if($risikobisnis->unit_id==$runit->objectabbr)
                                        <option value="{{$runit->objectabbr}}" selected>{{$runit->nama}}</option>
                                        @else
                                        <option value="{{$runit->objectabbr}}">{{$runit->nama}}</option>
                                        @endif
                                        @else
                                        <option value="{{$runit->objectabbr}}">{{$runit->nama}}</option>
                                        @endif
                                        @endforeach
                                       
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
                    <a class="btn btn-primary" onclick="exportexcel()"><i class="fa  fa-file-excel-o" title=""> Export Excel</i></a>
                    </div>
                
                <div class="box-body">
                    <?=$hsl;?>
                </div>
                
            </div>
            
        </div>
        
    </div>
    @include('resiko/resikobisnis/modal/sumberresikobisnis')
    @include('resiko/risikobisnisverifi/modal/komentar')
</section>
@endsection
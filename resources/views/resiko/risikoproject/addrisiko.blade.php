@extends('layouts.app')
@section('style')

@endsection
@section('content')
<script>
function pilihdampak(krinama,dampakid,katid,level){
    //alert(dmapakid+'-'+katid+'-'+level+'-'+krinama);
    var peluangid = $("#peluang").val();
    getmatrix(peluangid,dampakid);
    $("#idkategori").val(katid);
    $("#iddampak").val(dampakid);
    $("#dampak").val(krinama);
    $('#modal-dampakrisiko').modal('toggle');
  }
  function getmatrix(peluangid,dampakid){
    $.ajax({
            url:"{{ url('getmatrixrisiko') }}/"+peluangid+"/"+dampakid,
            method: 'GET',
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status+" : "+thrownError);
                $(".loading").hide();
              },
            success: function(data) {
              console.log(data.warna);
              $("#warna").val(data.warna);
              $("#buttonwarna").html('<button type="button" class="btn btn-'+data.warna+' btn-sm">'+data.tingkat+'</button>');
           }
        });
  }
  function addrisiko(){
    var no=$('#rowsumber').val();
    $('#sumberresikobisnis tbody').append(`
        <tr id="input_${no}">
        
        <td><textarea class="form-control" rows="2" name="sumberrisiko[]" id="sumberrisiko[]" required></textarea></td>
        <td><textarea class="form-control" rows="2" name="mitigasi[]" id="mitigasi[]" required></textarea></td>
        <td><input  class="form-control" type="number" name="biaya[]" id="biaya[]" required></td>
        <td><input size="5" type="date" class="form-control" id="startdate[]" name="startdate[]" placeholder="yyyy-m-d" required></td>
        <td><input size="5" type="date" class="form-control" id="enddate[]" name="enddate[]" placeholder="yyyy-m-d" required></td>
        <td><textarea class="form-control" rows="2" name="pic[]" id="pic[]" required></textarea></td>
        <td><textarea class="form-control" rows="2" name="status[]" id="status[]" required></textarea></td>
        <td>
        <button type="button" class="btn btn-warning" onclick="hapustempsumber(${no})"><i class="fa fa-trash"></i></button>
        
        </td>
        </tr>
        <tr id="file_${no}"><td colspan="8">Lampiran dokumen mitigasi :<input type="file" id="gambar[]" name="gambar[]" value="0"></td></tr>
             `);
             no = (no-1) + 2;
             $('#rowsumber').val(no);
  }
  function hapustempsumber(e){
         if(confirm("Apakah anda yakin ?")){
          $("#input_"+e).remove();
          $("#file_"+e).remove();
    }}
  function kembali(){
    if (confirm("Batal proses, anda yakin ?") == true) {
        history.back();
        }
    
  }
  
</script>
<section class="content-header">
<h1>
    Data
    <small>Tambah risiko project</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li><li class="active">Tambah risiko project</li>
</ol>
</section>
<section class="content">
<div class="box">
        <div class="box-body">
                <div class="box box-warning">
                    @if (count($errors) > 0)
                   
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        <form action="{{ url('storeriskproject') }}" method="post" enctype="multipart/form-data">
                        
                        <input name="_token" value="{{ csrf_token() }}" type="hidden">
                        <div class="form-group">
                
                            <label>Periode/tahun</label>
                            <div class="row">
                            <div class="col-xs-8">
                            @if(isset($unituser->objectabbr))
                            <input type="hidden" name="unitid" id="unitid" value="{{ $unituser->objectabbr }}">
                            @endif
                            <input type="text" class="form-control" name="periode" id="periode" value="{{ $periodeaktif->nama }}" placeholder="Periode ..." readonly>
                            </div>
                            <div class="col-xs-4">
                            <input type="text" class="form-control" name="tahun" id="tahun" value="{{ $periodeaktif->tahun }}" placeholder="Tahun ..." readonly>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Project</label>
                            <select class="form-control select2" style="width: 100%;" name="project" id="project" required>
                                @foreach ($project as $rowproject)
                                <option value="{{$rowproject->id}}">{{$rowproject->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahap Project</label>
                            <select class="form-control select2" style="width: 100%;" name="tahapproject" id="tahapproject" required>
                                @foreach ($tahapproject as $rowtahapproject)
                                <option value="{{$rowtahapproject->id}}">{{$rowtahapproject->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Risiko</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="risiko" id="risiko" required>{{ old('risiko') }}</textarea>
                        </div>
                        <div class="form-group">
                        <label>Akibat</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="akibat" id="akibat" required>{{ old('akibat') }}</textarea>
                        </div>
                        <div class="form-group">
                        <label>Klasifikasi</label>
                        <select class="form-control select2" style="width: 100%;" name="klasifikasi" id="klasifikasi" required>
                            @foreach ($klasifikasi as $rowklasifikasi)
                            <option value="{{$rowklasifikasi->id}}">{{$rowklasifikasi->nama}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                        <label>Peluang</label>
                        <select class="form-control select2" style="width: 100%;" name="peluang" id="peluang">
                            @foreach ($peluang as $rowpeluang)
                            <option value="{{$rowpeluang->id}}">{{$rowpeluang->level}}-{{$rowpeluang->nama}}-{{$rowpeluang->kriteria}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                        
                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-dampakrisiko"><i class="fa fa-search (alias)" title="">&nbsp;Dampak</i></a><br><br>
                        <input type="hidden" class="form-control" name="iddampak" id="iddampak" value="{{ old('iddampak') }}" readonly>
                        <input type="hidden" class="form-control" name="idkategori" id="idkategori" value="{{ old('idkategori') }}"  readonly>
                        <input type="text" class="form-control" name="dampak" id="dampak" value="{{ old('dampak') }}" placeholder="Dampak ..." readonly required>
                        </div>
                        <div class="form-group">
                        <label>Warna</label>
                        <input type="hidden" class="form-control" name="warna" id="warna" value="{{ old('warna') }}"  readonly>
                        <div id="buttonwarna"></div>
                        </div>
                        <div class="form-group">
                                
                        <a class="btn btn-primary" onclick="addrisiko()"><i class="fa fa-plus (alias)" title=""></i></a>
                        
                        <table id="sumberresikobisnis" class="table table-bordered table-striped" >
                            <input type="hidden" id="rowsumber" value="1">
                            <thead>
                            <tr>
                            <th>Sumber risiko</th>
                            <th>Mitigasi</th>
                            <th>Biaya</th>
                            <th>Startdate</th>
                            <th>Enddate</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                        
                        </div>
                    <div class="form-group">
                        <label>Indikator</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="indikator" id="indikator" required>{{ old('indikator') }}</textarea>
                    </div>
                    <div class="form-group">
                    <label>Nilai ambang</label>
                    <input type="text" class="form-control" name="nilaiambang" id="nilaiambang" value="{{ old('nilaiambang') }}" required>
                    </div>
                    <a type="button" href="{{ url('risikoproject') }}" class="btn btn-default pull-left">Batal</a>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                    
                </form>
                </div>
        </div>

</div>
@include('resiko/resikobisnis/modal/dampakrisiko')
@include('resiko/resikobisnis/modal/addsumberrisikobisnis')
</section>

    
@endsection

@extends('layouts.app')
@section('style')

@endsection

@section('content')
<script>
  
</script>
<section class="content-header">
  <h1>
    Data
    <small>{{$judul}}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<div class="box">
    
<section class="content">
    
        <div class="box-header">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Periode aktif : <b>{{$periodeaktif->nama." ".$periodeaktif->tahun}}</b> dari tanggal : <b>{{$periodeaktif->start_date}}</b> sampai tanggal <b>{{$periodeaktif->end_date}}</b>
                <br>KPI yang diupload otomatis masuk ke periode aktif saat ini, pastikan data yang akan diimport sudah benar !
              </div>
            @include('layouts.flash')
            <a class="btn btn-primary" href="{{ url('addkpi') }}"><i class="fa  fa-plus" title=""> KPI Baru</i></a>
            <div align="right">
             
            <form action="{{ url('importkpi') }}" method="post" enctype="multipart/form-data">
              <input name="_token" value="{{ csrf_token() }}" type="hidden">
              <input type="file" id="file" name="excel" required>
              <button class="btn btn-success" type="submit" class="btn btn-primary pull-right"><i class="fa fa-file-excel-o" title=""> Import KPI</i></button>
            </form>
          </div>
            
        </div>
        
        <div class="box-body">
            <form id="formcari" method="GET">
                <input name="_token" value="{{ csrf_token() }}" type="hidden">
            <table class="table table-bordered" >
                <tr>
                    <th width="80%">Unit Kerja</th><th></th>
                </tr>
                <tr>
                  <td><select class="form-control select2" style="width: 100%;" name="unitkerja"
                    id="unitkerja" required>
                    <option value="">Pilih Unit</option>
                    
                    @foreach($unitkerja as $runit)
                    @if(isset($requnit))
                    @if($requnit==$runit->objectabbr)
                    <option value="{{$runit->objectabbr}}" selected>{{$runit->nama}}</option>
                    @else
                    <option value="{{$runit->objectabbr}}">{{$runit->nama}}</option>
                    @endif
                    @else
                    <option value="{{$runit->objectabbr}}">{{$runit->nama}}</option>
                    @endif
                    @endforeach
                   
                </select></td>
                <td><button type="submit" class="btn btn-primary pull-right">Cari</button></td>
                </tr>
            </table>
          </form>
            <table id="tblkpi" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    {{-- <th>Periode</th> --}}
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Unit</th>
                    <th>Tahun</th>
                    <th>Level</th>
                    {{-- <th>KPI utama</th> --}}
                    <th>Kwartal</th>
                    <th width="20%">Nama (tahun) Periode</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                    $no=0;
                    @endphp
                  @foreach($kpi as $data)
                  @php
                  $no++;
                  @endphp
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{$data->kode}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->namaunit}}</td>
                    <td>{{$data->tahun}}</td>
                    <td><a class="btn btn-{{$data->warna}}" href="#">{{$data->namalevel}}</a></td>
                    {{-- <td>
                      @if($data->utama=='Y')
                      <a class="btn btn-primary" href="#">{{$data->utama}}</a>
                      @endif
                    </td> --}}
                    <td>{{$data->kwartal}}</td>
                    <td>{{$data->namaperiode}} ( {{$data->tahunperiode}} )</td>
                    <td>
                        @if($periodeaktif->id==$data->perioderisikobisnis_id)
                        <a href="{{url('editkpi',['id'=>$data->id])}}" class="btn btn-small" title="Edit"><i class="fa fa-edit"></i></a>
                        <a href="{{url('destroykpi',['id'=>$data->id])}}" class="btn btn-small"><i class="fa fa-trash" title="Hapus"></i></a>
                        @endif
                      </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>   
    </div>
    <script>
      $(function () {
        $('#tblkpi thead tr').clone(true).appendTo( '#tblkpi thead' );
        $('#tblkpi thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input size="5" type="text" placeholder="Cari..."/>' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
        } );
    var table = $('#tblkpi').DataTable( {
      orderCellsTop: true,
        fixedHeader: true,
       responsive: true
    } );
      })
    </script>
</section>
@endsection
<?php libxml_use_internal_errors(true);?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
</head>
<body>
<table width="100%" border-collapse="collapse">
                        <tr>
                           <td class="ttd" colspan="4">UNIT KERJA</td>
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
                        @foreach(detail_risiko_get(risiko_bisnis_get($unitkerja)) as $no=> $resik)
                            @foreach(sumber_risiko_get($resik['id']) as $x=> $sumber) 
                                <tr>
                                    @if($x==0)
                                        <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}">{{$no+1}}</td>
                                        <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}" width="8%">{{cek_kpi($resik['id'])['nama']}}</td>
                                        <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}" >{{$resik['risiko']}}</td>
                                    @endif
                                        <td class="tdisi">{{$sumber['namasumber']}}</td>
                                    @if($x==0)
                                        <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}">{{cek_klasifikasi($resik['klasifikasi_id'])['nama']}}</td>
                                        <td class="tdisi" rowspan="{{sumber_risiko_count($resik['id'])}}">{{cek_matrik($resik['peluang_id'],$resik['dampak_id'])['tingkat']}}</td>
                                    @endif
                                        <td class="tdisi">{{$sumber['mitigasi']}}</td>
                                        <td class="tdisi"></td>
                                        <td class="tdisi">{{$sumber['pic']}}</td>
                                        <td class="tdisi"></td>
                                </tr>
                            @endforeach 
                        @endforeach
                    </table>
</body>
</html>
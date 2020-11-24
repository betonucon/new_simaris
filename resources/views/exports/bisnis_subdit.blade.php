<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=laporan_unit_".cek_unit($unitkerja).".xls");
	?>
<style>
    table{
        border-collapse:collapse;
        margin-bottom:50px;
    }
    .ttd{
        padding:3px;
        font-size:11px;
        font-weight:bold;
        text-align:center;
        background:aqua;
        border:solid 1px #000;
    }
    .tdisi{
        padding:3px;
        font-size:11px;
        vertical-align:top;
        border:solid 1px #000;
    }
</style>    
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
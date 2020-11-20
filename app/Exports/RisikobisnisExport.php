<?php
namespace App\Exports;
 
use App\Risikobisnis;
use App\Kpi;
use App\Unitkerja;
use App\Perioderisikobisnis;
use App\Risikobisnisdetail;
use App\Sumberrisiko;
use App\validasibisnis;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View; 
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithDrawings;

// class RisikobisnisExport implements FromCollection
class RisikobisnisExport implements FromView,  ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function forPeriod($periode){
            $this->periode = $periode;
            return $this;
    }
    public function forUnit($unit){
        $this->unit = $unit;
        return $this;
    }
    public function forTingkat($tingkat){
        $this->tingkat = $tingkat;
        return $this;
    }
    public function forYou(){
        $this->jml = 0;
        return $this;
    }
    // public function collection()
    public function view(): View
    {
        $periode=$request->periode;
        $unitkerja=$request->unitkerja;
        $tingkat=$request->tingkat;

          
        
        return view('exports.risikobisnis', ['periode'=>$periode,'unitkerja'=>$unitkerja,'tingkat'=>$tingkat]);
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
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Logo');
                $drawing->setDescription('Logo');
                $drawing->setPath(public_path('logo.png'));
                $drawing->setCoordinates('B2');
                $drawing->setHeight(70);
                // $drawing->setWidth(40);
                $drawing->setWorksheet($event->sheet->getDelegate());

                $sheet = $event->sheet;
                $event->sheet->getStyle('B6:P'. $sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ]
                ]);
                // $sheet->getParent()->getDefaultStyle()->getAlignment()->setWrapText(true);
                $sheet->getStyle('A11:P'. $sheet->getHighestRow())->applyFromArray(
                    array(
                        'font' => array(
                            'name' => 'Calibri',
                            'size' => 10,

                        )
                    )
                );
                $sheet->getStyle('B6:P7')->applyFromArray([
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  10,
                        'bold'      =>  true
                    ),
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                ]);
                $sheet->getStyle('B9:P9')->applyFromArray([
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  15,
                        'bold'      =>  true
                    ),
                ]);
                
                $sheet->getStyle('G'. $sheet->getHighestRow().':P' . $sheet->getHighestRow())->applyFromArray([
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ]
                ]);
                $sheet->getStyle('B9:P10')->applyFromArray([
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  13,
                        'bold'      =>  true
                    ),
                ]);
                $sheet->getStyle('H6:K7')->applyFromArray([
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => array(
                        'name'      =>  'Calibri',
                        'size'      =>  15,
                        'bold'      =>  true
                    ),
                ]);
                $sheet->getStyle('B11:P'. $sheet->getHighestRow())->applyFromArray([
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP
                    ]
                ]);
                $event->sheet->getColumnDimension('B')->setAutoSize(false);
                $event->sheet->getColumnDimension('C')->setAutoSize(false);
                $event->sheet->getColumnDimension('D')->setAutoSize(false);
                $event->sheet->getColumnDimension('E')->setAutoSize(false);
                $event->sheet->getColumnDimension('F')->setAutoSize(false);
                $event->sheet->getColumnDimension('G')->setAutoSize(false);
                $event->sheet->getColumnDimension('H')->setAutoSize(false);
                $event->sheet->getColumnDimension('I')->setAutoSize(false);
                $event->sheet->getColumnDimension('J')->setAutoSize(false);
                $event->sheet->getColumnDimension('K')->setAutoSize(false);
                $event->sheet->getColumnDimension('L')->setAutoSize(false);
                $event->sheet->getColumnDimension('M')->setAutoSize(false);
                $event->sheet->getColumnDimension('N')->setAutoSize(false);
                $event->sheet->getColumnDimension('O')->setAutoSize(false);
                $event->sheet->getColumnDimension('P')->setAutoSize(false);
                $event->sheet->getColumnDimension('B')->setWidth(5);
                $event->sheet->getColumnDimension('C')->setWidth(35);
                $event->sheet->getColumnDimension('D')->setWidth(25);
                $event->sheet->getColumnDimension('E')->setWidth(25);
                $event->sheet->getColumnDimension('F')->setWidth(25);
                $event->sheet->getColumnDimension('G')->setWidth(25);
                $event->sheet->getColumnDimension('H')->setWidth(25);
                $event->sheet->getColumnDimension('I')->setWidth(25);
                $event->sheet->getColumnDimension('J')->setWidth(25);
                $event->sheet->getColumnDimension('K')->setWidth(7);
                $event->sheet->getColumnDimension('L')->setWidth(25);
                $event->sheet->getColumnDimension('M')->setWidth(7);
                $event->sheet->getColumnDimension('N')->setWidth(25);
                $event->sheet->getColumnDimension('O')->setWidth(30);
                $event->sheet->getColumnDimension('P')->setWidth(20);
                $sheet->getRowDimension(7)->setRowHeight(50);
                $sheet->getRowDimension(8)->setRowHeight(7);
                $sheet->getStyle('B6:P' . $sheet->getHighestRow())
                ->getAlignment()->setWrapText(true);
                $sheet->getStyle('L7:O7')
                ->getAlignment()->setWrapText(true);

            },
        ];
    }
}
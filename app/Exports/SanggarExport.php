<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class SanggarExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
{
    protected $data;

    // Terima hasil query langsung dari controller
    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        // Tambahkan nomor urut dan format ulang datanya
        return $this->data->values()->map(function ($item, $key) {
            return [
                'no' => $key + 1,
                'nama_sanggar' => $item->nama_sanggar,
                'jalan_rt_rw' => $item->jalan_rt_rw,
                'desa_kel' => $item->desa_kel,
                'kecamatan' => $item->kecamatan,
                'no_sk' => $item->no_sk,
                'tahun_sk' => $item->tahun_sk,
                'jabatan_penandatangan' => $item->jabatan_penandatangan ?? '-',
                'nama_penandatangan' => $item->nama_penandatangan,
                'nama_pimpinan' => $item->nama_pimpinan,
                'jenis_kelamin' => $item->jenis_kelamin,
                'nik' => $item->nik,
                'no_hp' => $item->no_hp,
                'jumlah_anggota' => $item->jumlah_anggota,
                'bidang_garapan_seni' => $item->bidang_garapan_seni,
            ];
        });
    }

    public function headings(): array
    {
        return [
            ['DAFTAR SANGGAR, PADEPOKAN, KOMUNITAS DI PROVINSI JAWA BARAT'],
            ['KABUPATEN CIREBON'],
            [
                'NO',
                'NAMA SANGGAR / KOMUNITAS',
                'JALAN RT/RW',
                'DESA / KEL',
                'KEC.',
                'NO. SK',
                'TAHUN',
                'JABATAN YANG MENANDATANGANI',
                'NAMA PEJABAT PENANDATANGAN',
                'NAMA PIMPINAN',
                'L/P',
                'NIK',
                'NO. HP',
                'JUMLAH ANGGOTA',
                'JENIS / BIDANG GARAPAN SENI'
            ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Gabung sel untuk judul dan subjudul
        $sheet->mergeCells('A1:O1');
        $sheet->mergeCells('A2:O2');

        // Judul utama
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '000000']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        // Subjudul
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '000000']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        // Header tabel
        $sheet->getStyle('A3:O3')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 11],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '800000']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center', 'wrapText' => true],
        ]);

        // Lebar kolom
        $widths = [
            'A' => 5, 'B' => 15, 'C' => 18, 'D' => 18, 'E' => 15,
            'F' => 10, 'G' => 10, 'H' => 15, 'I' => 15, 'J' => 15,
            'K' => 8, 'L' => 15, 'M' => 15, 'N' => 10, 'O' => 10
        ];
        foreach ($widths as $col => $w) {
            $sheet->getColumnDimension($col)->setWidth($w);
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Border seluruh tabel
                $sheet->getStyle("A3:{$highestColumn}{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => 'thin',
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Warna baris bergantian
                for ($row = 4; $row <= $highestRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle("A{$row}:O{$row}")->applyFromArray([
                            'fill' => [
                                'fillType' => 'solid',
                                'startColor' => ['rgb' => 'F9F9F9'],
                            ],
                        ]);
                    }
                }

                // Rata kiri untuk teks panjang
                $sheet->getStyle("B4:B{$highestRow}")->getAlignment()->setHorizontal('left');
                $sheet->getStyle("C4:E{$highestRow}")->getAlignment()->setHorizontal('left');
            },
        ];
    }
}

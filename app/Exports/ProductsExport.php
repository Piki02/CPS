<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProductsExport implements FromCollection, WithHeadings, WithStyles, WithDrawings, WithCustomStartCell, WithColumnWidths
{
    public function collection()
    {
        return Product::with('category')->get()->map(function ($product, $index) {
            return [
                'No' => $index + 1,
                'CATEGORY' => $product->category->name ?? 'N/A',
                'PRODUCTS' => $product->name,
                'UNIT' => $product->unit,
                'QTY' => '', // Empty for manual input
                'UNIT PRICE' => $product->price,
                'TOTAL' => '=F' . ($index + 11) . '*E' . ($index + 11), // Formula for total
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'CATEGORY',
            'PRODUCTS',
            'UNIT',
            'QTY',
            'UNIT PRICE',
            'TOTAL',
        ];
    }

    public function startCell(): string
    {
        return 'A10';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 50,
            'D' => 10,
            'E' => 10,
            'F' => 15,
            'G' => 15,
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Company Logo');
        $drawing->setPath(public_path('Img/Logo sin Fondo.png'));
        $drawing->setHeight(130); // Increased from 90
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function styles(Worksheet $sheet)
    {
        // Hide gridlines for a clean white background
        $sheet->setShowGridlines(false);

        // Header Information
        $sheet->mergeCells('C1:G1');
        $sheet->setCellValue('C1', 'List of Supplies');
        $sheet->getStyle('C1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('C3:G3');
        $sheet->setCellValue('C3', 'SHIP CHANDLER');
        $sheet->getStyle('C3')->getFont()->setBold(true)->setSize(14)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF003366'))->setUnderline(true);
        $sheet->getStyle('C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('C4:G4');
        $sheet->setCellValue('C4', '"Supplying the Caribbean One Vessel at a Time"');
        $sheet->getStyle('C4')->getFont()->setItalic(true)->setSize(12);
        $sheet->getStyle('C4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('C5:G5');
        $sheet->setCellValue('C5', 'Phone: +502 4919-1164 / +502 5371-8796');
        $sheet->getStyle('C5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('C6:G6');
        $sheet->setCellValue('C6', 'supply@caribbeanps.com.gt // m.burgos@caribbeanps.com.gt');
        $sheet->getStyle('C6')->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('FF003366'))->setUnderline(true);
        $sheet->getStyle('C6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Add border to the header section
        $sheet->getStyle('A1:G6')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Vessel and Master Info
        $sheet->mergeCells('A8:B8');
        $sheet->setCellValue('A8', 'VESSEL NAME:');
        $sheet->getStyle('A8')->getFont()->setBold(true);
        $sheet->getStyle('A8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->mergeCells('C8:D8');
        $sheet->getStyle('C8:D8')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        $sheet->mergeCells('E8:F8');
        $sheet->setCellValue('E8', 'MASTER NAME:');
        $sheet->getStyle('E8')->getFont()->setBold(true);
        $sheet->getStyle('E8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->setCellValue('G8', '');
        $sheet->getStyle('G8')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);

        // Table Header Styling (Row 10)
        $sheet->getStyle('A10:G10')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F2F2F2'],
            ],
        ]);

        // Data Styling
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A11:G' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Center "No", "UNIT", "QTY"
        $sheet->getStyle('A11:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D11:E' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Currency Formatting
        $sheet->getStyle('F11:G' . $lastRow)->getNumberFormat()->setFormatCode('$ #,##0.00');

        return [];
    }
}

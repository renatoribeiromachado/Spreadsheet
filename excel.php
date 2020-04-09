<?php
    set_time_limit(1000);
    ini_set('memory_limit',-1);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);

    require_once 'vendor/autoload.php';
    require_once 'getData.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use Symfony\Component\HttpFoundation\StreamedResponse;
    use Symfony\Component\HttpFoundation\Response;

    \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );

    function getColumn($column){
            $first = (chr((($column-26)/26)+65));
            $second = chr(($column%26)+65);
            return $first.$second;
    }

    function setLine($sheet, $line, $obra){
            $startX = 9;
            $posX = $startX + $line;

            $sheet
            ->getStyle("B$posX:DH$posX")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet
            ->getStyle("B$posX:DH$posX")
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            $sheet->setCellValue("B$posX", $obra->Atualizacao);
            $sheet->setCellValue("C$posX", $obra->Publicacao);

            $sheet->getStyle("B$posX")
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

            $sheet->getStyle("C$posX")
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);

            $sheet->setCellValue("D$posX", $obra->Projeto);
            $sheet->setCellValue("E$posX", $obra->Valor);

            $columnsUntilNow = 4; 

    }

    $streamedResponse = new StreamedResponse();
    $streamedResponse->setCallback(function () {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("Model.xlsx");
            $dataInicial = DateTime::createFromFormat('d/m/Y', $_POST['data_inicial'])->format('Y-m-d');
            $dataFinal = DateTime::createFromFormat('d/m/Y', $_POST['data_final'])->format('Y-m-d');
            $obras = getObras($dataInicial, $dataFinal);

            $line = 0;

            foreach($obras as $obra){
                    setLine($spreadsheet->getActiveSheet(), $line, $obra);
                    $line++;
            }

            $writer =  new Xlsx($spreadsheet);
            $writer->save('php://output');
    });

    $docName = 'nomeArquivo';

    $streamedResponse->setStatusCode(Response::HTTP_OK);
    $streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $streamedResponse->headers->set('Content-Disposition', "attachment; filename=\"$docName.xlsx\"");

    return $streamedResponse->send();
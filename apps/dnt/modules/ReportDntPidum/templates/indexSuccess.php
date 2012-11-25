<?php
// Create new PHPExcel object
/*$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nomor Perkara')
            ->setCellValue('C1', 'Nomor dan Tanggal putusan inkrah')
            ->setCellValue('D1', 'Terpidana')
            ->setCellValue('E1', 'Denda')
			->setCellValue('G1', 'Biaya Perkara')
			->setCellValue('H1', 'Uang rampasan / Temuan')
			->setCellValue('I1', 'Hasil lelang barang rampasan')
			->setCellValue('J1', 'Jumlah hasil dinas')
			->setCellValue('K1', 'Keterangan')
			->setCellValue('E2', 'APB')
			->setCellValue('F2', 'APS');

// Add data
//echo count($test);
/*for ($i = 3; $i <= 50; $i++) {
	foreach($test as $test){
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "FName".$test['NAMA']);
		$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, "LName $i");
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $i, "PhoneNo $i");
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $i, "FaxNo $i");
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $i, true);
	}
		
}*/

/*foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	echo 'Worksheet - ' , $worksheet->getTitle() , EOL;

	foreach ($worksheet->getRowIterator() as $row) {
		echo '    Row number - ' , $row->getRowIndex();

		$cellIterator = $row->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
		foreach ($cellIterator as $cell) {
			if (!is_null($cell)) {
				echo '        Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue();
			}
		}
	}
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');

$objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
$objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
$objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
$objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
$objPHPExcel->getActiveSheet()->mergeCells('G1:G2');
$objPHPExcel->getActiveSheet()->mergeCells('H1:H2');
$objPHPExcel->getActiveSheet()->mergeCells('I1:I2');
$objPHPExcel->getActiveSheet()->mergeCells('J1:J2');
$objPHPExcel->getActiveSheet()->mergeCells('K1:K2');
$objPHPExcel->getActiveSheet()->mergeCells('E1:F1');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getStyle('E1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;*/

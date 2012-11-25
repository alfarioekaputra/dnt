<?php

/**
 * ReportDntPidum actions.
 *
 * @package    dnt
 * @subpackage ReportDntPidum
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReportDntPidumActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    
    $connection = Doctrine_Manager::connection();
    $query = "SELECT NOMOR_PERKARA,NAMA,JNS_PELIMPAHAN,JENIS_PUTUSAN,
            BIAYA_PERKARA_DIPUTUS,DENDA_DIPUTUS,BIAYA_PERKARA_DIBAYAR,DENDA_DIBAYAR,UANG_RAMPASAN,HASIL_LELANG,
            (NVL(BIAYA_PERKARA_DIPUTUS,0)+NVL(DENDA_DIPUTUS,0)) TOTAL_DIPUTUS,(NVL(BIAYA_PERKARA_DIBAYAR,0)+NVL(DENDA_DIBAYAR,0)) TOTAL_DIBAYAR
            FROM(
            SELECT NOMOR_PERKARA,NAMA,JNS_PELIMPAHAN,JENIS_PUTUSAN,
            CASE WHEN PUTUSAN_UPAYA_HUKUM=1 THEN PJ_BIAYA
                                   WHEN PUTUSAN_TETAP=2 THEN (SELECT PJ_BIAYA FROM PDM_UPAYA_BANDING WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                   WHEN PUTUSAN_TETAP=3 THEN (SELECT PJ_BIAYA FROM PDM_UPAYA_KASASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                   END BIAYA_PERKARA_DIPUTUS,
            CASE WHEN PUTUSAN_UPAYA_HUKUM=1 THEN PJ_DENDA_RP
                                   WHEN PUTUSAN_TETAP=2 THEN (SELECT PJ_DENDA_RP FROM PDM_UPAYA_BANDING WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                   WHEN PUTUSAN_TETAP=3 THEN (SELECT PJ_DENDA_RP FROM PDM_UPAYA_KASASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                   END DENDA_DIPUTUS,
             CASE WHEN PUTUSAN_UPAYA_HUKUM=1 THEN PDM_TERSANGKA.NO_PUTUSAN_PN||'#'||PDM_TERSANGKA.TGL_PUTUSAN_PN          
                                 WHEN PUTUSAN_TETAP=2 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_BANDING WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                 WHEN PUTUSAN_TETAP=3 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_KASASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                 END NO#TGL_PUTUSAN,
            (SELECT SUM(SETOR) FROM PDM_DETAIL_STR INNER JOIN PDM_SETOR_DNT ON PDM_DETAIL_STR.ID_STR_DNT=PDM_SETOR_DNT.ID
            WHERE PDM_SETOR_DNT.ID_PERKARA=PDM_PERKARA.ID GROUP BY ID_STR_DNT) DENDA_DIBAYAR,
            PJ_BIAYA BIAYA_PERKARA_DIBAYAR,
            (SELECT JUMLAH FROM PDM_BARBUK
            WHERE (ID_SATUAN=8 OR ID_SATUAN=9) AND PDM_BARBUK.ID_PERKARA=PDM_PERKARA.ID) AS UANG_RAMPASAN,
            (SELECT HASIL_LELANG FROM PDM_BARBUK_LELANG
            INNER JOIN PDM_BARBUK ON PDM_BARBUK.ID=PDM_BARBUK_LELANG.ID_BARBUK
            WHERE PDM_BARBUK.ID_PERKARA=PDM_PERKARA.ID) AS HASIL_LELANG
            FROM PDM_TERSANGKA
            INNER JOIN PDM_PERKARA ON PDM_TERSANGKA.ID_PERKARA=PDM_PERKARA.ID AND PDM_PERKARA.ID=9
            LEFT JOIN PDM_SETOR_DNT ON PDM_SETOR_DNT.ID_PERKARA=PDM_PERKARA.ID)A";
      
      $statement = $connection->execute($query);
      $statement->execute();
      $this->pdm = $statement->fetchAll();
      
      $phpExcel = new PHPExcel();
      
      $phpExcel->getProperties()->setTitle("export");
      
      $phpExcel->setActiveSheetIndex(0);
      
      $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nomor Perkara')
            ->setCellValue('C1', 'Nomor dan Tanggal putusan inkrah')
            ->setCellValue('D1', 'Terpidana')
            ->setCellValue('E1', 'Denda')
			->setCellValue('E2', 'APB')
			->setCellValue('F2', 'APS')
			->setCellValue('G1', 'Biaya Perkara')
            ->setCellValue('G2', 'PN/PT/MA')
			->setCellValue('H1', 'Uang rampasan / Temuan')
			->setCellValue('I1', 'Hasil lelang barang rampasan')
			->setCellValue('J1', 'Jumlah hasil dinas')
			->setCellValue('K1', 'Keterangan');
      
      $phpExcel->getActiveSheet()->setTitle('Simple');

      $phpExcel->getActiveSheet()->mergeCells('A1:A2');
      $phpExcel->getActiveSheet()->mergeCells('B1:B2');
      $phpExcel->getActiveSheet()->mergeCells('C1:C2');
      $phpExcel->getActiveSheet()->mergeCells('D1:D2');
      $phpExcel->getActiveSheet()->mergeCells('H1:H2');
      $phpExcel->getActiveSheet()->mergeCells('I1:I2');
      $phpExcel->getActiveSheet()->mergeCells('J1:J2');
      $phpExcel->getActiveSheet()->mergeCells('K1:K2');
      $phpExcel->getActiveSheet()->mergeCells('E1:F1');
      $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
      $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
      $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
      $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
      $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
      $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
      $phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
      $phpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
      $phpExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
      
      $phpExcel->getActiveSheet()->getStyle('E1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $phpExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('B1:B2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('C1:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('D1:D2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('E1:F1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('E2:F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('G1:G2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('H1:H2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('I1:I2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('J1:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      $phpExcel->getActiveSheet()->getStyle('K1:K2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
      // Set active sheet index to the first sheet, so Excel opens this as the first sheet
      //$phpExcel->setActiveSheetIndex(0);
      
      //wrap text header
      $phpExcel->getActiveSheet()->getStyle('C1:C2')->getAlignment()->setWrapText(true);
      $phpExcel->getActiveSheet()->getStyle('H1:H2')->getAlignment()->setWrapText(true);
      
      //set row height
      $phpExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(50);
      
      $row = 3;
      $i = 1;
      foreach($this->pdm as $pdm)
      {
        $phpExcel->getActiveSheet()->setCellValue('A' . $row, $i);
		$phpExcel->getActiveSheet()->setCellValue('B' . $row, $pdm['NOMOR_PERKARA']);
		$phpExcel->getActiveSheet()->setCellValue('C' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('D' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('E' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('F' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('G' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('H' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('I' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('J' . $row, $pdm['NAMA']);
		$phpExcel->getActiveSheet()->setCellValue('K' . $row, $pdm['NAMA']);
        
        
        $phpExcel->getActiveSheet()->getStyle('A' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('B' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('C' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('D' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('E'.$row.':F'.$row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        //$phpExcel->getActiveSheet()->getStyle('E2:F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('G' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('H' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('I' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('J' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        $phpExcel->getActiveSheet()->getStyle('K' . $row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
        
        $row++;
        $i++;
      }
      
      // Redirect output to a client’s web browser (Excel5)
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="01simple.xls"');
      header('Cache-Control: max-age=0');
      
      $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
      $objWriter->save('php://output');
      exit;
  }
}

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
    
    
  }
  
  public function executeDataKejati(sfWebRequest $request)
  {
    $this->idkejati = $request->getParameter("idkejati");
    $this->setLayout(false);
  }
  
  public function executeGetDataKejatiPidum(sfWebRequest $request) {
    sfConfig::set('sf_web_debug', false);
    //sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'Tag'));
    $this->getResponse()->setContentType('application/json');

    $pilihanSearchKejati = $request->getParameter('pilihanSearchKejati');
    $cariKejati = $request->getParameter('cariKejati');
    $pilihkejatitab = $request->getParameter('pilihkejatitab');


    if ($_COOKIE['kd_satker'] != '00') {
        if (strlen($_COOKIE['kd_satker']) == 5) {
            $id_kejati = $_COOKIE['kd_satker'];

          #  $id_kejatiexplode = explode('.', $_COOKIE['kd_satker']);
          #  $id_kejati = $id_kejatiexplode[0] . '.';
        } else if (strlen($_COOKIE['kd_satker']) == 2) {

            $id_kejati = $_COOKIE['kd_satker'];
        }
    }


    $query = "select INST_SATKERKD,INST_NAMA,INST_AKRONIM from KP_INST_SATKER  where IS_ACTIVE=1 and inst_satkerkd like '" . $id_kejati . "%'";
    if (!empty($cariKejati)) {

        if ($pilihanSearchKejati == "1") {
            $query .=" AND INST_SATKERKD like ('" . $cariKejati . "%')";
        } else if ($pilihanSearchKejati == "2") {
            $query .=" AND (upper(INST_NAMA) like upper('%" . $cariKejati . "%') OR upper(INST_AKRONIM) like upper('%" . $cariKejati . "%'))";
        }
    }
    $query .= "ORDER BY INST_SATKERKD";
    //echo $query; exit;
    $item_per_page = $request->getParameter('iDisplayLength', 10);
    // $item_per_page ="1";
    $page = ($request->getParameter('iDisplayStart', 0) / $item_per_page) + 1;
    $pager = $this->processDatadetil($page, $item_per_page, $query);

    $json = '{"iTotalRecords":' . count($pager) . ',
     "iTotalDisplayRecords":' . count($pager) . ',
     "aaData":[';
    $first = 0;
    foreach ($pager->getResults() as $v) {
        if ($first++)
            $json .= ',';
        $gabung = $v['INST_SATKERKD'] . "#" . $v['INST_NAMA'] . "#" . $v['INST_AKRONIM'] . "#";
        $json .= '[
            "' . $v['INST_SATKERKD'] . '",
            "' . $v['INST_NAMA'] . '",
            "<input type=\"button\" class=\"btn\" data-dismiss=\"modal\" value=\"Pilih\" name=\"pilih\" onClick=\"goPilihKejati(\'' . $gabung . ' \',\'' . $pilihkejatitab . '\')\">"]';

        //$json =']';
    }
    $json .= ']}';
    //echo $query;
    return $this->renderText($json);
  }
  
  public function processDatadetil($page = 1, $item_per_page = 10, $query) {
    $connection = Doctrine_Manager::connection();



    $statement = $connection->execute($query);
    $statement->execute();
    $this->resultsetKejati = $statement->fetchAll();
    //  $this->datakejati=$request->getParameter("id");

    $pager = (array) $this->resultsetKejati;

    $this->pager = new myArrayPager(null, $item_per_page);
    $this->pager->setResultArray($pager);
    $this->pager->setPage($page);
    $this->pager->init();
    return $this->pager;
  }
  
  public function executeReport(sfWebRequest $request)
  {
    $this->setLayout(false);
    
    $sub = $request->getParameter('semua_sub');
    $kd_satker = $request->getParameter('txt_kejaksaan_id');
    $tgl_awal = $request->getParameter('tgl_awal');
    $tgl_akhir = $request->getParameter('tgl_akhir');
    
    if ($request->isMethod('post')) {
      $connection = Doctrine_Manager::connection();
      $query = "SELECT * FROM(
                SELECT (SELECT INST_SATKERKD FROM PDM_PERKARA WHERE ID=PERKARA_ID) INST_SATKERKD,(SELECT INST_NAMA FROM PDM_PERKARA LEFT JOIN KP_INST_SATKER ON PDM_PERKARA.INST_SATKERKD=KP_INST_SATKER.INST_SATKERKD WHERE ID=PERKARA_ID) INST_NAMA,
                A.ID,PERKARA_ID,NAMA,JENIS_PUTUSAN,A.JNS_PELIMPAHAN,HUKUMAN_POKOK_BADAN,BIAYA_PERKARA_DIPUTUS,DENDA_DIPUTUS,NO#TGL_PUTUSAN,BIAYA_PERKARA_DIBAYAR, TANGGAL_SETOR,PJ_DENDA_RP_DIBAYAR,PJ_UPRP_DIBAYAR,PJ_UPLAIN_DIBAYAR,HASIL_LELANG,UANG_RAMPASAN,
                NVL(BIAYA_PERKARA_DIBAYAR,0)+NVL(PJ_DENDA_RP_DIBAYAR,0)+NVL(PJ_UPRP_DIBAYAR,0)+NVL(PJ_UPLAIN_DIBAYAR,0)+NVL(HASIL_LELANG,0)+NVL(UANG_RAMPASAN,0) TOTAL_BAYAR,
                CASE WHEN (DENDA_DIPUTUS IS NULL) THEN 'BELUM ADA PUTUSAN' 
                WHEN NVL(DENDA_DIPUTUS,0)>NVL(PJ_DENDA_RP_DIBAYAR,0) THEN 'BELUM LUNAS' 
                WHEN NVL(DENDA_DIPUTUS,0)=NVL(PJ_DENDA_RP_DIBAYAR,0) THEN 'LUNAS' END KETERANGAN
                 FROM(
                SELECT PDM_TERSANGKA.ID,PDM_TERSANGKA.ID_PERKARA PERKARA_ID,NAMA,JENIS_PUTUSAN,
                CASE WHEN PUTUSAN_UPAYA_HUKUM=1 THEN PJ_BADAN_TAHUN||' Tahun'||PJ_BADAN_BULAN||' Bulan '||PJ_BADAN_HARI||' Hari'
                                       WHEN PUTUSAN_TETAP=2 THEN (SELECT PJ_BADAN_TAHUN||' Tahun '||PJ_BADAN_BULAN||' Bulan '||PJ_BADAN_HARI||' Hari' FROM PDM_UPAYA_BANDING WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                       WHEN PUTUSAN_TETAP=3 THEN (SELECT PJ_BADAN_TAHUN||' Tahun '||PJ_BADAN_BULAN||' Bulan '||PJ_BADAN_HARI||' Hari' FROM PDM_UPAYA_KASASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                                       END HUKUMAN_POKOK_BADAN,
                CASE WHEN PUTUSAN_UPAYA_HUKUM=1 THEN PDM_TERSANGKA.PJ_BIAYA
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
                (SELECT JNS_PELIMPAHAN FROM PDM_PERKARA WHERE PDM_PERKARA.ID=PDM_TERSANGKA.ID_PERKARA) JNS_PELIMPAHAN,
                (SELECT SUM(SETOR) FROM PDM_DETAIL_STR WHERE ID_STR_DNT=PDM_SETOR_DNT.ID AND STATUS=1) BIAYA_PERKARA_DIBAYAR,
                (SELECT TGL_STR FROM PDM_DETAIL_STR WHERE ID_STR_DNT=PDM_SETOR_DNT.ID AND STATUS=1) TANGGAL_SETOR,
                (SELECT SUM(SETOR) FROM PDM_DETAIL_STR WHERE ID_STR_DNT=PDM_SETOR_DNT.ID AND STATUS=2) PJ_DENDA_RP_DIBAYAR,
                (SELECT SUM(SETOR) FROM PDM_DETAIL_STR WHERE ID_STR_DNT=PDM_SETOR_DNT.ID AND STATUS=3) PJ_UPRP_DIBAYAR,
                (SELECT SUM(SETOR) FROM PDM_DETAIL_STR WHERE ID_STR_DNT=PDM_SETOR_DNT.ID AND STATUS=4) PJ_UPLAIN_DIBAYAR,
                (SELECT SUM(HASIL_LELANG) FROM PDM_BARBUK_LELANG INNER JOIN PDM_BARBUK ON PDM_BARBUK.ID=PDM_BARBUK_LELANG.ID_BARBUK 
                WHERE PDM_BARBUK.ID_PERKARA=PDM_SETOR_DNT.ID_PERKARA GROUP BY PDM_SETOR_DNT.ID_PERKARA) HASIL_LELANG,
                (SELECT JUMLAH FROM PDM_BARBUK  
                WHERE (ID_SATUAN=8 OR ID_SATUAN=9) AND PDM_BARBUK.ID_PERKARA=PDM_SETOR_DNT.ID_PERKARA) UANG_RAMPASAN
                FROM PDM_TERSANGKA
                INNER JOIN PDM_SETOR_DNT ON PDM_SETOR_DNT.ID_TERSANGKA=PDM_TERSANGKA.ID
                )A LEFT JOIN PDM_PERKARA ON A.PERKARA_ID =PDM_PERKARA.ID_PERKARA) B
                where 1=1";
                
                if (!empty($sub)) { //jika semua sub dipilih
                  if ($kd_satker == '00') {
                      $query .="";
                  } else {
                      $query .=" AND (inst_satkerkd like '$kd_satker%')";
                  }
              }//end semuasub
              else {
                  if (!empty($kd_satker)) {
                      $query .=" AND (INST_SATKERKD='$kd_satker')";
                  }
              }
              if (!empty($tgl_awal) && !empty($tgl_akhir)) {
                  $query .="AND (TANGGAL_SETOR >= TO_DATE('$tgl_awal','dd-mm-yyyy') AND TANGGAL_SETOR <= TO_DATE('$tgl_akhir','dd-mm-yyyy'))";
              }
        
        $statement = $connection->execute($query);
        $statement->execute();
        $this->pdm = $statement->fetchAll();
    }//end post
      
      
      $phpExcel = PHPExcel_IOFactory::load(dirname(__FILE__).'/../../../lib/template/laporan_hasil_dinas_pidum.xls');
      $phpExcel->setActiveSheetIndex(0);
      
      $sheet = $phpExcel->getActiveSheet();
      
      
      
      $cellAwal = 7;
      $cellAkhir = $cellAwal;
      $no = 1;
      
      foreach($this->pdm as $pdm)
      {
        if($pdm['JNS_PELIMPAHAN'] == 1){
          $apb = $pdm['DENDA_DIPUTUS'];
          $aps = '';
        }elseif($pdm['JNS_PELIMPAHAN'] == 2){
          $apb = '';
          $aps = $pdm['DENDA_DIPUTUS'];
        }
        
        
        $sheet->setCellValue('A'.$cellAkhir, $no);
        $sheet->getStyle('A'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('B'.$cellAkhir, $pdm['NO#TGL_PUTUSAN']);
        $sheet->getStyle('B'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('C'.$cellAkhir, $pdm['NAMA']);
        $sheet->getStyle('C'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('D'.$cellAkhir, $apb);
        $sheet->getStyle('D'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('E'.$cellAkhir, $aps);
        $sheet->getStyle('E'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('F'.$cellAkhir, $pdm['BIAYA_PERKARA_DIPUTUS']);
        $sheet->getStyle('F'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('G'.$cellAkhir, $pdm['UANG_RAMPASAN']);
        $sheet->getStyle('G'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('H'.$cellAkhir, $pdm['HASIL_LELANG']);
        $sheet->getStyle('H'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('I'.$cellAkhir, $pdm['TOTAL_DIBAYAR']);
        $sheet->getStyle('I'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('J'.$cellAkhir, $pdm['KETERANGAN']);
        $sheet->getStyle('J'.$cellAkhir)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $cellAkhir++;
        $no++;
      }
      
      $sheet->setCellValue('A3', 'Wilayah / Unit: '.$pdm['INST_NAMA']);
      $sheet->mergeCells('A3:J3');
      $sheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      //exit;
      $styleArray1 = array('borders'=> array('allborders'=> 
					array('style'=> PHPExcel_Style_Border::BORDER_THIN)));
      $sheet->getStyle('A'.$cellAwal.':J'.($cellAkhir))->applyFromArray($styleArray1);
      
       unset($styleArray1);
  
      
      
      //prepare download
      $filename = 'Laporan Hasil Dinas Pidum'.mt_rand(1,100000).'.xls'; 
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
  
      //downloadable file is in Excel 2003 format (.xls)
      $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');  
      
      //send it to user, of course you can save it to disk also
      $objWriter->save('php://output');
      
      exit();
  }
}

<?php

/**
 * dntdatun actions.
 *
 * @package    dnt
 * @subpackage dntdatun
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dntdatunActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //
  }
  
  public function executeGetDataIndexDatun(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');
    
    $conn = Doctrine_Manager::connection();
    $query = "SELECT * FROM (
              SELECT PDS_PERKARA.ID AS ID,
              PDS_PERKARA.INST_SATKERKD AS INST_SATKERKD,
                NOMOR_PERKARA,
                WM_CONCAT(NO_TGL_PUTUSAN) as NO_TGL_PUTUSAN
              FROM PDS_PERKARA
              INNER JOIN
                (SELECT ID,
                  ID_PERKARA,
                  CASE
                    WHEN PUTUSAN_UPAYA_HUKUM=1
                    THEN
                      (SELECT TO_CHAR(''
                        ||'#'
                        ||TO_CHAR(TGL_PUTUSAN_PN, 'DD-MM-YYYY'))
                      FROM PDS_PERKARA
                      WHERE ID=PDS_TERSANGKA.ID_PERKARA
                      )
                    WHEN PUTUSAN_TETAP=2
                    THEN
                      (SELECT NO_PUTUSAN
                        ||'#'
                        ||TO_CHAR(TGL_PUTUSAN, 'DD-MM-YYYY')
                      FROM PDS_UPAYA_BANDING
                      WHERE ID_TERSANGKA=PDS_TERSANGKA.ID
                      )
                    WHEN PUTUSAN_TETAP=3
                    THEN
                      (SELECT NO_PUTUSAN
                        ||'#'
                        ||TO_CHAR(TGL_PUTUSAN, 'DD-MM-YYYY')
                      FROM PDS_UPAYA_KASASI
                      WHERE ID_TERSANGKA=PDS_TERSANGKA.ID AND TGL_PUTUSAN IS NOT NULL
                      )
                  END NO_TGL_PUTUSAN
                FROM PDS_TERSANGKA
                WHERE PUTUSAN_UPAYA_HUKUM = 1
                OR PUTUSAN_TETAP         IN (2,3,4,5)) A
                ON A.ID_PERKARA           =PDS_PERKARA.ID
                LEFT JOIN KP_INST_SATKER C
                ON PDS_PERKARA.INST_SATKERKD     =C.INST_SATKERKD
                WHERE C.INST_SATKERKD='00' AND PDS_PERKARA.ID IN(SELECT ID_PERKARA FROM PDS_SETOR_DNT WHERE STATUS_UP='2')
                GROUP BY PDS_PERKARA.ID, PDS_PERKARA.INST_SATKERKD, PDS_PERKARA.NOMOR_PERKARA ) A";
    
    $item_per_page = $request->getParameter('iDisplayLength', 10);

    $page = ($request->getParameter('iDisplayStart', 0) / $item_per_page) + 1;
    $pager = $this->processDatadetil($page, $item_per_page, $query);
    
    $json = '{"iTotalRecords":'.count($pager).',
              "iTotalDisplayRecords":'.count($pager).',
              "aaData":[';
    
    $first = 0;
    
    foreach($pager->getResults() as $v){
      $no_tgl_putusan = explode("#",$v['NO_TGL_PUTUSAN']);
      //echo $no_tgl_putusan[0];

      $query_tersangka = "select wm_concat(IDENTITAS) IDENTITAS from (
            SELECT ID AS ID_TERSANGKA,ID_PERKARA,NAMA||' #'|| 
            TO_CHAR (TGL_LAHIR, 'dd-mm-yyyy' )|| ' #'|| 
            DECODE (JKL, 2, 'Perempuan', 1, 'Laki-laki', '-')||' #'||ALAMAT IDENTITAS
            FROM PDS_TERSANGKA
            WHERE (PUTUSAN_UPAYA_HUKUM=1 OR PUTUSAN_TETAP IN(2,3,4,5)) and id_perkara = '".$v['ID']."'
            )
            GROUP BY ID_PERKARA"; 
        
        $statement_tersangka = $conn->execute($query_tersangka);
        $statement_tersangka->execute();
        $tersangka = $statement_tersangka->fetchAll();

      if($first++)
        $json .= ',';
        $json .= '[
          "'.$v['NOMOR_PERKARA'].'",
          "'.$tersangka[0]['IDENTITAS'].'",
          "'.$no_tgl_putusan[0].'",
          "'.$no_tgl_putusan[1].'",
          "'.$v['NOMOR_PERKARA'].'",';
        $json .= '"<center><a class=\"btn btn-info\" href=\"' . sfContext::getInstance()->getController()->genUrl('dntdatun/edit?id=' . $v['ID'] . '&kode_satker=' . $v['INST_SATKERKD'], true) . '\">Edit</a></center>"]';
        
        
    }
    $json .= ']}';
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
   
   public function executeEdit(sfWebRequest $request)
   {
      $connection = Doctrine_Manager::connection();
      $query_tersangka = "SELECT A.ID_TERSANGKA,A.ID_PERKARA,A.PJ_BIAYA,A.DENDA,A.UP_RUPIAH,UP_LAINNYA,B.NAMA,B.ID as ID_TERSANGKA,
              (SELECT TGL_STR FROM PDS_DETAIL_STR WHERE ID_STR_DNT=A.ID AND STATUS=1) AS TGL_STR,
              (SELECT SUM(SETOR) FROM PDS_DETAIL_STR WHERE ID_STR_DNT=A.ID AND STATUS=1 GROUP BY ID_STR_DNT) AS PJ_BIAYA_DIBAYAR,
              (SELECT SUM(SETOR) FROM PDS_DETAIL_STR WHERE ID_STR_DNT=A.ID AND STATUS=2 GROUP BY ID_STR_DNT) AS DENDA_DIBAYAR,
              (SELECT SUM(SETOR) FROM PDS_DETAIL_STR WHERE ID_STR_DNT=A.ID AND STATUS=3 GROUP BY ID_STR_DNT) AS UANG_PENGGANTI_DIBAYAR,
              (SELECT SUM(SETOR) FROM PDS_DETAIL_STR WHERE ID_STR_DNT=A.ID AND STATUS=4 GROUP BY ID_STR_DNT) AS UANG_PENGGANTI_LAIN_DIBAYAR
               FROM PDS_SETOR_DNT A 
              INNER JOIN PDS_TERSANGKA B ON A.ID_TERSANGKA=B.ID
              INNER JOIN PDS_PERKARA C ON A.ID_PERKARA=C.ID
              where (B.PUTUSAN_UPAYA_HUKUM=1 OR B.PUTUSAN_TETAP IN(2,3,4,5))  and A.id_perkara = '".$request->getParameter('id')."' order by B.ID asc";
              
          
      $statement_tersangka = $connection->execute($query_tersangka);
      $statement_tersangka->execute();
      $this->tersangka = $statement_tersangka->fetchAll();
      
      
   }
   
   public function executeUpdate(sfWebRequest $request)
   {
      sfContext::getInstance()->getConfiguration()->loadHelpers('Fungsi');
      if ($request->isMethod('post')) {
        $no_skk = $request->getParameter('no_skk');
        $tgl_skk = $request->getParameter('tgl_skk');
        $pup_rp = $request->getParameter('pup_diputus_rp');
        $pup_usd = $request->getParameter('pup_diputus_usd');
        $keterangan = $request->getParameter('keterangan');
        $id_tersangka = $request->getParameter('id_tersangka');
        $id_pup = $request->getParameter('id_pup');
        
        for($i=0;$i < count($no_skk); $i++){
          if($id_pup[$i] != ''){
            $updatePup = Doctrine_Query::create()
            ->update('DTN_PUP_PDS')
            ->set('NO_SKK', '?', $no_skk[$i])
            ->set('TGL_SKK', '?', setTanggal($tgl_skk[$i]))
            ->set('PUP_RUPIAH', '?', $pup_rp[$i])
            ->set('PUP_LAINNYA', '?', $pup_usd[$i])
            ->set('KETERANGAN', '?', $keterangan[$i])
            ->where('ID = '.$id_pup[$i]. ' AND ID_PERKARA = '.$request->getParameter('id_perkara').' AND ID_TERSANGKA = '.$id_tersangka[$i])
            ->execute();
          }else{
            $pup = new DTN_PUP_PDS();
            $pup->setNoSkk($no_skk[$i]);
            $pup->setTglSkk(setTanggal($tgl_skk[$i]));
            $pup->setPupRupiah($pup_rp[$i]);
            $pup->setPupLainnya($pup_usd[$i]);
            $pup->setKeterangan($keterangan[$i]);
            $pup->setIdPerkara($request->getParameter('id_perkara'));
            $pup->setIdTersangka($id_tersangka[$i]);
            $pup->save();
          }
          
          $a = $i + 1;
          
          $jml_byr_rp = $request->getParameter('jml_bayar_rp'.$a);
          $jml_byr_usd = $request->getParameter('jml_bayar_usd'.$a);
          $sisa_rp = $request->getParameter('sisa_rp'.$a);
          $sisa_usd = $request->getParameter('sisa_usd'.$a);
          $tgl_bayar = $request->getParameter('tgl_bayar'.$a);
          $id_dtn_pup = $request->getParameter('id_dtn_pup'. $a);
          
          $new_jml_byr_rp = $request->getParameter('new_jml_bayar_rp'.$a);
          $new_jml_byr_usd = $request->getParameter('new_jml_bayar_usd'.$a);
          $new_sisa_rp = $request->getParameter('new_sisa_rp'.$a);
          $new_sisa_usd = $request->getParameter('new_sisa_usd'.$a);
          $new_tgl_bayar = $request->getParameter('new_tgl_bayar'.$a);
          
          $id_pembayaran = $request->getParameter('id_pembayaran');
          
          for($b = 0; $b < count($new_jml_byr_rp); $b++){
            if($new_jml_byr_rp[$b] != ''){
              $pupDetail = new DTN_PUP_PEMBAYARAN_PDS();
              $pupDetail->setIdPup($id_dtn_pup[$b]);
              $pupDetail->setBayarRupiah($new_jml_byr_rp[$b]);
              $pupDetail->setBayarLainnya($new_jml_byr_usd[$b]);
              $pupDetail->setSisaRupiah($new_sisa_rp[$b]);
              $pupDetail->setSisaLainnya($new_sisa_usd[$b]);
              $pupDetail->setTglBuktiSetor(setTanggal($new_tgl_bayar[$b]));
              $pupDetail->save();
            }
           }
           
           for($c = 0; $c < count($jml_byr_rp); $c++){
			   if($jml_byr_rp[$c] != ''){
				  $updatePup = Doctrine_Query::create()
				  ->update('DTN_PUP_PEMBAYARAN_PDS')
				  ->set('BAYAR_RUPIAH', '?', $jml_byr_rp[$c])
				  ->set('BAYAR_LAINNYA', '?', $jml_byr_usd[$c])
				  ->set('SISA_RUPIAH', '?', $sisa_rp[$c])
				  ->set('SISA_LAINNYA', '?', $sisa_usd[$c])
				  ->set('TGL_BUKTI_SETOR', '?', setTanggal($tgl_bayar[$i]))
				  ->where('ID = '.$id_pembayaran[$c])
				  ->execute();
				}
           }
        }
      }
      //$this->redirect('dntdatun/edit?id='.$request->getParameter('id_perkara').'&kode_satker=00');
   }
}

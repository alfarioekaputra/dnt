<?php
/**
 * dntpidum actions.
 *
 * @package    dnt
 * @subpackage dntpidum
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dntpidumActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    //$this->kode_satker = $_COOKIE['kd_satker'];
    $this->kode_satker = '00';
  }
  
  public function executeKejati(sfWebRequest $request)
  {
    //
  }
  
  public function executeGetdataindexpidum(sfWebRequest $request){
    $this->getResponse()->setContentType('application/json');
    
    $searchnya = $request->getParameter('searchnya');
    $filter = $request->getParameter('filter');
    $kejati = $request->getParameter('kejati');
    $semuasub = $request->getParameter('semuasub');
    
    $conn = Doctrine_Manager::connection();
    $query = "SELECT C.INST_SATKERKD,ID_PERKARA ID_PERKARA, ID_INSTANSI,NOMOR_PERKARA,NO_TGL_PUTUSAN,
                CASE WHEN NVL(JUMLAH_DENDA,0)<NVL(DENDA,0) THEN 'KUNING'
                 WHEN NVL(JUMLAH_DENDA,0)=NVL(DENDA,0) AND JUMLAH_DENDA IS NOT NULL THEN 'HIJAU'
                 WHEN NVL(JUMLAH_DENDA,0)=0 THEN 'MERAH'
              END STATUS FROM (
            SELECT A.ID_PERKARA ID_PERKARA,NOMOR_PERKARA,NO_TGL_PUTUSAN,B.ID,INST_SATKERKD,
            (SELECT SUM(SETOR) FROM PDM_DETAIL_STR WHERE ID_STR_DNT=B.ID AND STATUS=2 GROUP BY ID_STR_DNT) JUMLAH_DENDA,B.DENDA,ID_INSTANSI
              FROM PDM_PERKARA
              INNER JOIN (SELECT ID_PERKARA, NAMA, WM_CONCAT(NO#TGL_PUTUSAN) NO_TGL_PUTUSAN FROM (
              SELECT ID_PERKARA,NAMA,
              CASE     WHEN PUTUSAN_UPAYA_HUKUM=1 THEN (SELECT TO_CHAR(TGL_PUTUSAN_PN) FROM PDM_PERKARA WHERE ID=PDM_TERSANGKA.ID_PERKARA)
                       WHEN PUTUSAN_TETAP=2 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_BANDING WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       WHEN PUTUSAN_TETAP=3 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_KASASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       WHEN PUTUSAN_TETAP=4 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_PK WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       WHEN PUTUSAN_TETAP=5 THEN (SELECT NO_GRASI||'#'||TGL_GRASI FROM PDM_UPAYA_GRASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       END NO#TGL_PUTUSAN
              FROM PDM_TERSANGKA
              WHERE PUTUSAN_UPAYA_HUKUM=1 OR PUTUSAN_TETAP IN(2,3,4,5)
              )B 
              GROUP BY ID_PERKARA,NAMA) A ON A.ID_PERKARA=PDM_PERKARA.ID
              LEFT JOIN PDM_SETOR_DNT B ON B.ID_PERKARA=PDM_PERKARA.ID)C
              LEFT JOIN KP_INST_SATKER D ON C.INST_SATKERKD=D.INST_SATKERKD
              WHERE 1=1";
    
    
    if (!empty($kejati)) {
      if ($semuasub == "1") {
          if ($kejati == "00") {
              $query .="";
          } else {
              $query .=" AND (C.inst_satkerkd like '" . $kejati . "%' OR id_instansi like '" . $kejati . "%')";
          }
      } else {
          $query .=" AND (C.inst_satkerkd = '" . $kejati . "' or id_instansi = '" . $kejati . "')";
      }
    } else {
        $query .=" AND (C.inst_satkerkd like '" . $_COOKIE['kd_satker'] . "' OR id_instansi like '" . $_COOKIE['kd_satker'] . "')";
    }
  
    if ($filter == "2") {
        if (!empty($searchnya)) {
            $query .=" AND NAMA like upper('%" . $searchnya . "%')";
        }
    }
    /*if ($filter == "1") {
        if (!empty($searchnya)) {
            $query .=" AND upper(a.NOMOR_PERKARA) LIKE upper('%" . $searchnya . "%')";
        }
    } else if ($filter == "2") {
        if (!empty($searchnya)) {
            $query .=" AND upper(a.PENYIDIK) LIKE upper('%" . $searchnya . "%')";
        }
    } else if ($filter == "3") {
        if (!empty($searchnya)) {
            $query .=" AND upper(a.identitas) LIKE upper('%" . $searchnya . "%')";
        }
    } else if ($filter == "5") {
  
         if (!empty($searchnya)) {
            $query .="  AND (
             (SELECT upper(WM_CONCAT(file_name)) FROM pdm_berkas_file WHERE pdm_berkas_file.ID_PERKARA = a.id)LIKE upper('%" . $searchnya . "%')                 
         )";
        } else {
            $query .=" and (SELECT upper(WM_CONCAT(file_name)) FROM pdm_berkas_file WHERE pdm_berkas_file.ID_PERKARA = a.id) IS NOT NULL";
        }
    } else if ($filter == "4") {
        if (!empty($searchnya)) {
            if (strlen($searchnya) == "4") {
                $query .=" AND TO_CHAR(A.CREATED_TIME,'YYYY')='" . $searchnya . "' ";
            } else if (strlen($searchnya) == "7") {
                $query .=" AND TO_CHAR(A.CREATED_TIME,'MM-YYYY')='" . $searchnya . "' ";
            }
        }
    }*/
    
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

      $query_tersangka = "select * from(
            select wm_concat(IDENTITAS) IDENTITAS from (
            SELECT ID_PERKARA,NAMA||' #'|| 
            TO_CHAR (TGL_LAHIR, 'dd-mm-yyyy' )|| ' #'|| 
            DECODE (JKL, 2, 'Perempuan', 1, 'Laki-laki', '-')||' #'||ALAMAT IDENTITAS
            FROM PDM_TERSANGKA
            WHERE (PUTUSAN_UPAYA_HUKUM=1 OR PUTUSAN_TETAP IN(2,3,4,5)) and id_perkara = '".$v['ID_PERKARA']."'
            )GROUP BY ID_PERKARA) where 1=1";
      
      
        
        $statement_tersangka = $conn->execute($query_tersangka);
        $statement_tersangka->execute();
        $tersangka = $statement_tersangka->fetchAll();
        
        if($v['STATUS'] == 'MERAH'){
          
        }
        
      if($first++)
        $json .= ',';
        $json .= '[
          "'.$v['NOMOR_PERKARA'].'",
          "'.$tersangka[0]['IDENTITAS'].'",
          "'.$no_tgl_putusan[0].'",
          "'.$no_tgl_putusan[1].'",
          "'.$v['STATUS'].'",';
        $json .= '"<center><a class=\"btn btn-info\" href=\"' . sfContext::getInstance()->getController()->genUrl('dntpidum/edit?id=' . $v['ID_PERKARA'] . '&kode_satker=' . $v['INST_SATKERKD'], true) . '\">Edit</a></center>"]';
        
        
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


  public function executeShow(sfWebRequest $request)
  {
    $this->pdm_perkara = Doctrine::getTable('PDM_PERKARA')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pdm_perkara);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PDM_TERSANGKAForm();
    $this->formTersangka = new PDM_PERKARAForm();
    
    $this->jkl_db = Doctrine::getTable('MS_JNSKELAMIN')
                    ->createQuery('a')
                    ->execute();
    
    $this->agama_db = Doctrine::getTable('MS_AGAMA')
                      ->createQuery('a')
                      ->execute();
    
    $this->pendidikan_db = Doctrine::getTable('MS_PENDIDIKAN')
                        ->createQuery('a')
                        ->execute();
    
  }

  public function executeCreate(sfWebRequest $request)
  {
      sfContext::getInstance()->getConfiguration()->loadHelpers('Fungsi');
      
      //$this->forward404Unless($request->isMethod(sfRequest::POST));
      
      $this->form = new PDM_TERSANGKAForm();
      //$this->formTersangka = new PDM_TERSANGKAForm();
      
      $this->setTemplate('new');
      
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($request->isMethod('post')) {
          
          $JnsPengadilanPutusan = $request->getParameter('jns_pengadilan_putusan');
          $NoPutusan = $request->getParameter('no_amar_putusan_inkrah');
          $TglPutusan = $request->getParameter('tgl_putusan_inkrah');
          $PosisiKasus = $request->getParameter('posisi_kasus');

          $nama_terdakwa = $request->getParameter('nama_terdakwa');
          $tempat_lahir = $request->getParameter('tempat_lahir');
          $tgl_lahir = $request->getParameter('tgl_lahir');
          $jkl = $request->getParameter('jkl');
          $umur = $request->getParameter('umur');
          $pendidikan = $request->getParameter('pendidikan');
          $id_agama = $request->getParameter('id_agama');
          $pekerjaan = $request->getParameter('pekerjaan');
          $kewarganegaraan = $request->getParameter('kewarganegaraan');
          $alamat = $request->getParameter('alamat');
          $jnsPutusan = $request->getParameter('jns_putusan');
          $PjBiayaPerkara = $request->getParameter('biaya_perkara');
          //$PjBIayaSeumurHidup = $request->getParameter('biaya_seumur_hidup');

          //pidana penjara
          $PjBadanThn = $request->getParameter('pj_badan_tahun');
          $PjBadanBln = $request->getParameter('pj_badan_bulan');
          $PjBadanHari = $request->getParameter('pj_badan_hari');
          $PjDenda = $request->getParameter('pj_denda');
          $PjSubThn = $request->getParameter('pj_subsidair_tahun');
          $PjSubBln = $request->getParameter('pj_subsidair_bulan');
          $PjSubHari = $request->getParameter('pj_subsidair_hari');
          $PjBiaya = $request->getParameter('pj_biaya_perkara');
          $PjPidanaTambahan = $request->getParameter('pj_pidana_tambahan');
          //end pidana penjara
          
          //pidana kurungan denda
          $PkKurunganThn = $request->getParameter('pk_kurungan_tahun');
          $PkKurunganBln = $request->getParameter('pk_kurungan_bulan');
          $PkKurunganHari = $request->getParameter('pk_kurungan_hari');
          $PkDenda = $request->getParameter('pk_denda');
          $PkBiayaPerkara = $request->getParameter('pk_biaya_perkara');
          $PkPidanaTambahan = $request->getParameter('pk_pidana_tambahan');
          //end pidana kurungan denda
          
          //pidana bersyarat/percobaan
          $PbBadanThn = $request->getParameter('pb_badan_tahun');
          $PbBadanBln = $request->getParameter('pb_badan_bulan');
          $PbBadanHari = $request->getParameter('pb_badan_hari');
          $PbPercobaanThn = $request->getParameter('pb_percobaan_tahun');
          $PbPercobaanBln = $request->getParameter('pb_percobaan_bulan');
          $PbPercobaanHari = $request->getParameter('pb_percobaan_hari');
          $PbDenda = $request->getParameter('pb_denda');
          $PbSubThn = $request->getParameter('pb_subsidair_tahun');
          $PbSubBln = $request->getParameter('pb_subsidair_bulan');
          $PbSubHari = $request->getParameter('pb_subsidair_hari');
          $PbBiayaPerkara = $request->getParameter('pb_biaya_perkara');
          $PbPidanaTambahan = $request->getParameter('pb_pidana_tambahan');
          //end pidana bersyarat/percobaan

          $PpCombo = $request->getParameter('pp_combo');
          $PpBiayaPerkara = $request->getParameter('pp_biaya_perkara');

          $TglP48 = $request->getParameter('tgl_p48');

          $JnsTahanan = $request->getParameter('jns_tahanan');
          $TglPenahananMulai = $request->getParameter('tgl_penahanan_mulai');
          $TglPenahananSelesai = $request->getParameter('tgl_penahanan_selesai');
          $KeteranganTahanan = $request->getParameter('keterangan_tahanan');

          $DendaHasilDinas = $request->getParameter('denda_hsl_dinas');
		  $BpAmarPutusan = $request->getParameter('bp_amar_putusan');
          $BpSetor = $request->getParameter('bp_setor');
          $BpNoSsbp = $request->getParameter('bp_no_ssbp');
          $BpTglSsbp = $request->getParameter('bp_tgl_ssbp');
          $BpNoBuktiStr = $request->getParameter('bp_no_bukti_setor');
          $BpTglBuktiStr = $request->getParameter('bp_tgl_setor');
          
          $perkara = new PDM_PERKARA();
          $perkara->setNomorPerkara($request->getParameter('nomor_perkara'));
          $perkara->setJnsPelimpahan($request->getParameter('apb_aps'));
          $perkara->setPosisiKasus($request->getParameter('posisi_kasus'));
          $perkara->setInstSatkerkd('00');
          $perkara->setIdInstansi('00');
          
          $perkara->save();
                    
          for($i = 0; $i < count($nama_terdakwa); $i++)
          {
            $terdakwa = new PDM_TERSANGKA();
            $terdakwa->setNama(strtoupper($nama_terdakwa[$i]));
            $terdakwa->setTempatLahir($tempat_lahir[$i]);
            $terdakwa->setTglLahir(setTanggal($tgl_lahir[$i]));
            $terdakwa->setJkl($jkl[$i]);
            $terdakwa->setUmur($umur[$i]);
            $terdakwa->setPendidikan($pendidikan[$i]);
            $terdakwa->setIdAgama($id_agama[$i]);
            $terdakwa->setPekerjaan($pekerjaan[$i]);
            $terdakwa->setKewarganegaraan($kewarganegaraan[$i]);
            $terdakwa->setAlamat($alamat[$i]);
            $terdakwa->setJenisPutusan($jnsPutusan[$i]);
            $terdakwa->setIdPerkara($perkara->getId());
            if($JnsPengadilanPutusan[$i] == 1){
              $terdakwa->setNoPutusanPn($NoPutusan[$i]);
              $terdakwa->setTglPutusanPn(setTanggal($TglPutusan[$i]));
              $terdakwa->setPutusanUpayaHukum(1);
            }elseif ($JnsPengadilanPutusan[$i] == 2) {
              $terdakwa->setPutusanTetap(2);
            }elseif ($JnsPengadilanPutusan[$i] == 3) {
              $terdakwa->setPutusanTetap(3);
            }
            
            if($jnsPutusan[$i] == 1){
              $terdakwa->setPjBiaya($PjBiayaPerkara[$i]);
            }elseif($jnsPutusan[$i] == 2){
              $terdakwa->setPjBiaya($PjBIayaPerkara[$i]);
            }elseif($jnsPutusan[$i] == 3){
              $terdakwa->setPjBadanTahun($PjBadanThn[$i]);
              $terdakwa->setPjBadanBulan($PjBadanBln[$i]);
              $terdakwa->setPjBadanHari($PjBadanHari[$i]);
              $terdakwa->setPjDendaRp($PjDenda[$i]);
              $terdakwa->setPjSubTahun($PjSubThn[$i]);
              $terdakwa->setPjSubBulan($PjSubBln[$i]);
              $terdakwa->setPjSubHari($PjSubHari[$i]);
              $terdakwa->setPjBiaya($PjBiaya[$i]);
              $terdakwa->setPutusanTambahan($PjPidanaTambahan[$i]);
            }elseif($jnsPutusan[$i] == 4){
              $terdakwa->setKurunganTahun($PkKurunganThn[$i]);
              $terdakwa->setKurunganBulan($PkKurunganBln[$i]);
              $terdakwa->setKurunganHari($PkKurunganHari[$i]);
              $terdakwa->setDenda($PkDenda[$i]);
              $terdakwa->setPjBiaya($PkBiayaPerkara[$i]);
              $terdakwa->setPutusanTambahan($PkPidanaTambahan[$i]);
            }elseif($jnsPutusan[$i] == 6){
              $terdakwa->setPjBadanTahun($PbBadanThn[$i]);
              $terdakwa->setPjBadanBulan($PbBadanBln[$i]);
              $terdakwa->setPjBadanHari($PbBadanHari[$i]);
              $terdakwa->setPjPidanaCobaThn($PbPercobaanThn[$i]);
              $terdakwa->setPjPidanaCobaBln($PbPercobaanBln[$i]);
              $terdakwa->setPjPidanaCobaHari($PbPercobaanHari[$i]);
              $terdakwa->setDenda($PbDenda[$i]);
              $terdakwa->setPjSubTahun($PbSubThn[$i]);
              $terdakwa->setPjSubBulan($PbSubBln[$i]);
              $terdakwa->setPjSubHari($PbSubHari[$i]);
              $terdakwa->setPjBiaya($PbBiayaPerkara[$i]);
              $terdakwa->setPutusanTambahan($PbPidanaTambahan[$i]);
            }elseif ($jnsPutusan[$i] == 7) {
              $terdakwa->setPdnPengawasan($PpCombo[$i]);
              $terdakwa->setPjBiaya($PpBiayaPerkara[$i]);
            }
            $terdakwa->setTglEksekusi(setTanggal($TglP48[$i]));
            $terdakwa->save();

            if($JnsPengadilanPutusan[$i] == 1){
              $penahanan = new PDM_PENAHANAN();
              $penahanan->setKetuapnIdloktahan($JnsTahanan[$i]);
              $penahanan->setKetuapnStart(setTanggal($TglPenahananMulai[$i]));
              $penahanan->setKetuapnEnd(setTanggal($TglPenahananSelesai[$i]));
              $penahanan->setIdTersangka($terdakwa->getId());
              $penahanan->save();
            }elseif($JnsPengadilanPutusan[$i] == 2){
              $penahanan = new PDM_PENAHANAN();
              $penahanan->setKetuaptIdloktahan($JnsTahanan[$i]);
              $penahanan->setKetuaptStart(setTanggal($TglPenahananMulai[$i]));
              $penahanan->setKetuaptEnd(setTanggal($TglPenahananSelesai[$i]));
              $penahanan->setIdTersangka($terdakwa->getId());
              $penahanan->save();

              $upayaBanding = new PDM_UPAYA_BANDING(); 
              $upayaBanding->setNoPutusan($NoPutusan[$i]);
              $upayaBanding->setTglPutusan(setTanggal($TglPutusan[$i]));
              $upayaBanding->setIdTersangka($terdakwa->getId());
              $upayaBanding->save();
            }elseif($JnsPengadilanPutusan[$i] == 3){
              $penahanan = new PDM_PENAHANAN();
              $penahanan->setHakim1Idloktahan($JnsTahanan[$i]);
              $penahanan->setHakim1Start(setTanggal($TglPenahananMulai[$i]));
              $penahanan->setHakim1End(setTanggal($TglPenahananSelesai[$i]));
              $penahanan->setIdTersangka($terdakwa->getId());
              $penahanan->save();

              $upayaKasasi = new PDM_UPAYA_KASASI();
              $upayaKasasi->setNoPutusan($NoPutusan[$i]);
              $upayaKasasi->setTglPutusan(setTanggal($TglPutusan[$i]));
              $upayaKasasi->setIdTersangka($terdakwa->getId());
              $upayaKasasi->save();
            }
			
			$d = $i + 1;
            //untuk pembayaran denda
            $setor      = $request->getParameter('denda_setor' .$d);
            $sisa       = $request->getParameter('denda_sisa' .$d);
            $ssbp       = $request->getParameter('denda_ssbp' .$d);
            $tglSsbp    = $request->getParameter('denda_tgl_ssbp' .$d);
            $buktiSetor = $request->getParameter('denda_bukti_setor' .$d);
            $tglSetor   = $request->getParameter('denda_tgl_setor' .$d);
            $keterangan = $request->getParameter('denda_keterangan' .$d);
            
            
			
            $SetorDnt = new PDM_SETOR_DNT();
            $SetorDnt->setIdPerkara($perkara->getId());
            $SetorDnt->setIdTersangka($terdakwa->getId());
			if($DendaHasilDinas[$i] != null and $BpAmarPutusan[$i] == null){
				$SetorDnt->setDenda($DendaHasilDinas[$i]);
				$SetorDnt->setStatus(1);
				for($c = 0; $c < count($setor); $c++){
					if($setor[$c] != null and $sisa[$c] != '0'){
						$SetorDnt->setStatus(2);
					}elseif($sisa[$c] == '0'){
						$SetorDnt->setStatus(3);
					}
				}
			}elseif($DendaHasilDinas[$i] == null and $BpAmarPutusan[$i] != null){
				$SetorDnt->setPjBiaya($BpAmarPutusan[$i]);
			}elseif($DendaHasilDinas[$i] != null and $BpAmarPutusan[$i] != null){
				$SetorDnt->setDenda($DendaHasilDinas[$i]);
				$SetorDnt->setPjBiaya($BpAmarPutusan[$i]);
			}
            
            $SetorDnt->save();
            if($DendaHasilDinas != ''){
              for($ds = 0; $ds < count($setor); $ds++){
                $SetorDetil = new PDM_DETAIL_STR();
                $SetorDetil->setIdStrDnt($SetorDnt->getId());
                $SetorDetil->setSetor($setor[$ds]);
                $SetorDetil->setSisa($sisa[$ds]);
                $SetorDetil->setNoSsbp($ssbp[$ds]);
                $SetorDetil->setTglSsbp(setTanggal($tglSsbp[$ds]));
                $SetorDetil->setNoBuktiStr($buktiSetor[$ds]);
                $SetorDetil->setTglStr(setTanggal($tglSetor[$ds]));
                $SetorDetil->setKeterangan($keterangan[$ds]);
                $SetorDetil->setStatus(2);
                $SetorDetil->save();
              }
            }
            //if($BpAmarPutusan !=''){
                $SetorDetil = new PDM_DETAIL_STR();
                $SetorDetil->setIdStrDnt($SetorDnt->getId());
                $SetorDetil->setSetor($BpSetor[$i]);
                $SetorDetil->setNoSsbp($BpNoSsbp[$i]);
                $SetorDetil->setTglSsbp(setTanggal($BpTglSsbp[$i]));
                $SetorDetil->setNoBuktiStr($BpNoBuktiStr[$i]);
                $SetorDetil->setTglStr(setTanggal($BpTglBuktiStr[$i]));
                $SetorDetil->setStatus(1);
                $SetorDetil->save();
            //}
            
            //
            $q = $i + 1;
            $nilaiNamaPasal = 'pasal_didakwakan' . $q;

            $namaPasal = $request->getParameter($nilaiNamaPasal);

            for ($s = 0; $s < count($namaPasal); $s++) {
                $pdm_pasal = new PDM_PASAL();
                $pdm_pasal->setIdTersangka($terdakwa->getId());
                $pdm_pasal->setPasal($namaPasal[$s]);
                $pdm_pasal->save();
            }
          }

          /*for ($j=0; $j < count($NoPutusan); $j++) { 
            if($JnsPengadilanPutusan[$j] == 2){
              $upayaBanding = new PDM_UPAYA_BANDING(); 
              $upayaBanding->setNoPutusan($NoPutusan[$j]);
              $upayaBanding->setTglPutusan(setTanggal($TglPutusan[$j]));
              $upayaBanding->setIdTersangka($terdakwa->getId());
              $upayaBanding->save();
            }
          }*/
          
        $jenis = $request->getParameter('jenis');
        $jumlah = $request->getParameter('jumlah');
        $satuan = $request->getParameter('satuan');
        $pemilik = $request->getParameter('pemilik');
        $petunjuk = $request->getParameter('petunjuk');
        
                
        for($a = 0; $a < count($jenis); $a++){
          $barangRampasan = new PDM_BARBUK();
          $barangRampasan->setIdPerkara($perkara->getId());
          $barangRampasan->setNama($jenis[$a]);
          $barangRampasan->setJumlah($jumlah[$a]);
          $barangRampasan->setIdSatuan($satuan[$a]);
          $barangRampasan->setPemilik($pemilik[$a]);
          $barangRampasan->save();
          
          $rampasan = $a + 1;
          
          //echo $rampasan;exit;
          
          $NoBaLelang = $request->getParameter('no_ba_lelang' .$rampasan);
          $TglLelang = $request->getParameter('tgl_lelang' .$rampasan);
          $Taksiran = $request->getParameter('taksiran' .$rampasan);
          $NilaiWajarLelang = $request->getParameter('nilai_wajar_hasil_lelang' .$rampasan);
          $TempatPenyimpanan = $request->getParameter('tempat_penyimpanan' .$rampasan);
          $Kondisi = $request->getParameter('kondisi' .$rampasan);
          $HasilLelang = $request->getParameter('hasil_lelang' .$rampasan);
          $Hambatan = $request->getParameter('hambatan' .$rampasan);
          $Catatan = $request->getParameter('catatan' .$rampasan);
          
          for($b = 0; $b < count($NoBaLelang); $b++){
            //echo count($NoBaLelang);exit;
            
            $lelang = new PDM_BARBUK_LELANG();
            $lelang->setIdBarbuk($barangRampasan->getId());
            $lelang->setNoBa($NoBaLelang[$b]);
            $lelang->setTglLelang(setTanggal($TglLelang[$b]));
            $lelang->setTaksiran($Taksiran[$b]);
            $lelang->setNilaiWajar($NilaiWajarLelang[$b]);
            $lelang->setPenyimpanan($TempatPenyimpanan[$b]);
            $lelang->setKondisi($Kondisi[$b]);
            $lelang->setHasilLelang($HasilLelang[$b]);
            $lelang->setHambatan($Hambatan[$b]);
            $lelang->setPetunjuk($Catatan[$b]);
            $lelang->save();
          }
        }
        
        
      }
      
      $this->redirect('dntpidum/edit?id='.$perkara->getId());
  }

  public function executeEdit(sfWebRequest $request)
  {
    
    $this->pdm_perkara = Doctrine::getTable('PDM_PERKARA')
                ->createQuery('a')
                ->where('id = ' . $request->getParameter('id'))
                ->orderby('id')
                ->execute();

    $this->pdm_tersangka = Doctrine::getTable('PDM_TERSANGKA')
                ->createQuery('b')
                ->where('id_perkara = ' . $request->getParameter('id'))
                ->orderby('id')
                ->execute();

    $connection = Doctrine_Manager::connection();
    $query_tersangka = "
            SELECT *
            FROM PDM_TERSANGKA
            WHERE (PUTUSAN_UPAYA_HUKUM=1 OR PUTUSAN_TETAP IN(2,3,4,5)) and id_perkara = '".$request->getParameter('id')."'";
            
        
    $statement_tersangka = $connection->execute($query_tersangka);
    $statement_tersangka->execute();
    $this->tersangka = $statement_tersangka->fetchAll();

                
    $this->form = new PDM_PERKARAForm();
    $this->formTersangka = new PDM_TERSANGKAForm();
    
    $this->jkl_db = Doctrine::getTable('MS_JNSKELAMIN')
                    ->createQuery('a')
                    ->execute();
    
    $this->agama_db = Doctrine::getTable('MS_AGAMA')
                      ->createQuery('a')
                      ->execute();
    
    $this->pendidikan_db = Doctrine::getTable('MS_PENDIDIKAN')
                        ->createQuery('a')
                        ->execute();

  }

  public function executeUpdate(sfWebRequest $request)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Fungsi');
      
    //$this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->form = new PDM_TERSANGKAForm();
    //$this->formTersangka = new PDM_TERSANGKAForm();
    
    $this->setTemplate('new');
    
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($request->isMethod('post')) {
      $JnsPengadilanPutusan = $request->getParameter('jns_pengadilan_putusan');
      $NoPutusan = $request->getParameter('no_amar_putusan');
      $TglPutusan = $request->getParameter('tgl_putusan');
      $PosisiKasus = $request->getParameter('posisi_kasus');

      $nama_terdakwa = $request->getParameter('nama_terdakwa');
      $tempat_lahir = $request->getParameter('tempat_lahir');
      $tgl_lahir = $request->getParameter('tgl_lahir');
      $jkl = $request->getParameter('jkl');
      $umur = $request->getParameter('umur');
      $pendidikan = $request->getParameter('pendidikan');
      $id_agama = $request->getParameter('id_agama');
      $pekerjaan = $request->getParameter('pekerjaan');
      $kewarganegaraan = $request->getParameter('kewarganegaraan');
      $alamat = $request->getParameter('alamat');
      $jnsPutusan = $request->getParameter('jns_putusan');
      $PjBiayaPerkara = $request->getParameter('biaya_perkara');
      //$PjBIayaSeumurHidup = $request->getParameter('biaya_seumur_hidup');

      //pidana penjara
      $PjBadanThn = $request->getParameter('pj_badan_tahun');
      $PjBadanBln = $request->getParameter('pj_badan_bulan');
      $PjBadanHari = $request->getParameter('pj_badan_hari');
      $PjDenda = $request->getParameter('pj_denda');
      $PjSubThn = $request->getParameter('pj_subsidair_tahun');
      $PjSubBln = $request->getParameter('pj_subsidair_bulan');
      $PjSubHari = $request->getParameter('pj_subsidair_hari');
      $PjBiaya = $request->getParameter('pj_biaya_perkara');
      $PjPidanaTambahan = $request->getParameter('pj_pidana_tambahan');
      //end pidana penjara
      
      //pidana kurungan denda
      $PkKurunganThn = $request->getParameter('pk_kurungan_tahun');
      $PkKurunganBln = $request->getParameter('pk_kurungan_bulan');
      $PkKurunganHari = $request->getParameter('pk_kurungan_hari');
      $PkDenda = $request->getParameter('pk_denda');
      $PkBiayaPerkara = $request->getParameter('pk_biaya_perkara');
      $PkPidanaTambahan = $request->getParameter('pk_pidana_tambahan');
      //end pidana kurungan denda
      
      //pidana bersyarat/percobaan
      $PbBadanThn = $request->getParameter('pb_badan_tahun');
      $PbBadanBln = $request->getParameter('pb_badan_bulan');
      $PbBadanHari = $request->getParameter('pb_badan_hari');
      $PbPercobaanThn = $request->getParameter('pb_percobaan_tahun');
      $PbPercobaanBln = $request->getParameter('pb_percobaan_bulan');
      $PbPercobaanHari = $request->getParameter('pb_percobaan_hari');
      $PbDenda = $request->getParameter('pb_denda');
      $PbSubThn = $request->getParameter('pb_subsidair_tahun');
      $PbSubBln = $request->getParameter('pb_subsidair_bulan');
      $PbSubHari = $request->getParameter('pb_subsidair_hari');
      $PbBiayaPerkara = $request->getParameter('pb_biaya_perkara');
      $PbPidanaTambahan = $request->getParameter('pb_pidana_tambahan');
      //end pidana bersyarat/percobaan

      $PpCombo = $request->getParameter('pp_combo');
      $PpBiayaPerkara = $request->getParameter('pp_biaya_perkara');

      $TglP48 = $request->getParameter('tgl_p48');

      $JnsTahanan = $request->getParameter('jns_tahanan');
      $TglPenahananMulai = $request->getParameter('tgl_penahanan_mulai');
      $TglPenahananSelesai = $request->getParameter('tgl_penahanan_selesai');
      $KeteranganTahanan = $request->getParameter('keterangan_tahanan');

      $DendaHasilDinas = $request->getParameter('denda_hsl_dinas');
      $BpAmarPutusan = $request->getParameter('bp_amar_putusan');
      $BpSetor = $request->getParameter('bp_setor');
      $BpNoSsbp = $request->getParameter('bp_no_ssbp');
      $BpTglSsbp = $request->getParameter('bp_tgl_ssbp');
      $BpNoBuktiStr = $request->getParameter('bp_no_bukti_setor');
      $BpTglBuktiStr = $request->getParameter('bp_tgl_setor');
      
      $updateIdTersangka = $request->getParameter('hidenIdTersangka');
      $updateIdPasal = $request->getParameter('idpasal');
      
      $idbanding = $request->getParameter('idbanding');
      $idkasasi = $request->getParameter('idkasasi');
      
      $conn = Doctrine_Manager::connection();
      $conn->beginTransaction();
           
      
        
        for ($j=0; $j < count($NoPutusan); $j++) {
            if($JnsPengadilanPutusan[$j] == 1){
              $updatePdmPerkaraLimpah = Doctrine_Query::create()
                ->update('PDM_PERKARA')
                ->set('NOMOR_PERKARA', '?', $request->getParameter('nomor_perkara'))
                ->set('JNS_PELIMPAHAN', '?', $request->getParameter('apb_aps'))
                ->set('POSISI_KASUS', '?', $request->getParameter('posisi_kasus'))
                ->set('NO_LIMPAH_PK', '?', $NoPutusan[$j])
                ->set('TGL_PUTUSAN_PN', '?', setTanggal($TglPutusan[$j]))
                ->where('ID = ?', $request->getParameter('idperkara'))
                ->execute();
              }else{
                $updatePdmPerkara = Doctrine_Query::create()
                ->update('PDM_PERKARA')
                ->set('NOMOR_PERKARA', '?', $request->getParameter('nomor_perkara'))
                ->set('JNS_PELIMPAHAN', '?', $request->getParameter('apb_aps'))
                ->set('POSISI_KASUS', '?', $request->getParameter('posisi_kasus'))
                ->where('ID = ?', $request->getParameter('idperkara'))
                ->execute();
              }
          }
      
      for ($z = 0; $z < count($updateIdTersangka); $z++) {
        $updateTersangka = Doctrine_Query::create()
          ->update('PDM_TERSANGKA')
          ->set('NAMA', '?', strtoupper($nama_terdakwa[$z]))
          ->set('TEMPAT_LAHIR', '?', $tempat_lahir[$z])
          ->set('TGL_LAHIR', '?', setTanggal($tgl_lahir[$z]))
          ->set('JKL', '?', $jkl[$z])
          ->set('KEWARGANEGARAAN', '?', $kewarganegaraan[$z])
          ->set('ALAMAT', '?', $alamat[$z])
          ->set('PEKERJAAN', '?', $pekerjaan[$z])
          ->set('UMUR', '?', $umur[$z])
          ->set('ID_AGAMA', '?', $id_agama[$z])
          ->set('PENDIDIKAN', '?', $pendidikan[$z])
          ->set('JENIS_PUTUSAN', '?', $jnsPutusan[$z])
          ->where('ID=' . $updateIdTersangka[$z] . 'AND ID_PERKARA=' . $request->getParameter('idperkara'))
          ->execute();
        
        if($JnsPengadilanPutusan[$z] == 1){
          $updateTersangka = Doctrine_Query::create()
          ->update('PDM_TERSANGKA')
          ->set('PUTUSAN_UPAYA_HUKUM', '?', 1)
          ->set('PUTUSAN_TETAP', '?', '')
          ->where('ID=' . $updateIdTersangka[$z] . ' AND ID_PERKARA=' . $request->getParameter('idperkara'))
          ->execute();
        }elseif ($JnsPengadilanPutusan[$z] == 2) {
          $updateTersangka = Doctrine_Query::create()
          ->update('PDM_TERSANGKA')
          ->set('PUTUSAN_TETAP', '?', 2)
          ->set('PUTUSAN_UPAYA_HUKUM', '?', 0)
          ->where('ID=' . $updateIdTersangka[$z] . ' AND ID_PERKARA=' . $request->getParameter('idperkara'))
          ->execute();
          
          if($idbanding[$z] == ''){
            //echo $idbanding[$z];
            $upayaBanding = new PDM_UPAYA_BANDING(); 
            $upayaBanding->setNoPutusan($NoPutusan[$z]);
            $upayaBanding->setTglPutusan(setTanggal($TglPutusan[$z]));
            $upayaBanding->setIdTersangka($updateIdTersangka[$z]);
            $upayaBanding->save();  
          }else{
            $updateBanding = Doctrine_Query::create()
            ->update("PDM_UPAYA_BANDING")
            ->set('NO_PUTUSAN', '?', $NoPutusan[$z])
            ->set('TGL_PUTUSAN', '?', setTanggal($TglPutusan[$z]))
            ->where('ID = '.$idbanding[$z]. ' AND ID_TERSANGKA = '.$updateIdTersangka[$z])
            ->execute();
          }
        }elseif ($JnsPengadilanPutusan[$z] == 3) {
          $updateTersangka = Doctrine_Query::create()
          ->update('PDM_TERSANGKA')
          ->set('PUTUSAN_TETAP', '?', 3)
          ->set('PUTUSAN_UPAYA_HUKUM', '?', 0)
          ->where('ID=' . $updateIdTersangka[$z] . ' AND ID_PERKARA=' . $request->getParameter('idperkara'))
          ->execute();
          
          if($idkasasi[$z] == ''){
            $upayaKasasi = new PDM_UPAYA_KASASI();
            $upayaKasasi->setNoPutusan($NoPutusan[$z]);
            $upayaKasasi->setTglPutusan(setTanggal($TglPutusan[$z]));
            $upayaKasasi->setIdTersangka($updateIdTersangka[$z]);
            $upayaKasasi->save();  
          }else{
            $updateKasasi = Doctrine_Query::create()
            ->update('PDM_UPAYA_KASASI')
            ->set('NO_PUTUSAN', '?', $NoPutusan[$z])
            ->set('TGL_PUTUSAN', '?', setTanggal($TglPutusan[$z]))
            ->where('ID = '.$idkasasi[$z]. ' AND ID_TERSANGKA = '.$updateIdTersangka[$z])
            ->execute();
          }
        }
        
        $qw = $z + 1;
        $updateNamaPasal = 'pasal_didakwakan' . $qw;
        $namaUpdatePasal = $request->getParameter($updateNamaPasal);
        $hidenIdPasal = 'idpasal' . $qw;
        $updateHidenIdPasal = $request->getParameter($hidenIdPasal);
        
        $nilaiNamaPasal = 'new_pasal_didakwakan' . $qw;

        $namaPasal = $request->getParameter($nilaiNamaPasal);
        
        if($namaPasal != ''){
          for ($s = 0; $s < count($namaPasal); $s++) {
              $pdm_pasal = new PDM_PASAL();
              $pdm_pasal->setIdTersangka($updateIdTersangka[$z]);
              $pdm_pasal->setPasal($namaPasal[$s]);
              $pdm_pasal->save();
          }
        }
        for ($s = 0; $s < count($namaUpdatePasal); $s++) {
          $updatePidumPasal = Doctrine_Query::create()
            ->update('PDM_PASAL')
            ->set('PASAL', '?', $namaUpdatePasal[$s])
            ->where('ID=' . $updateHidenIdPasal[$s] . 'AND ID_TERSANGKA=' . $updateIdTersangka[$z])
            ->execute();
        }
        
        $d = $z + 1;
        //untuk pembayaran denda
        $setor      = $request->getParameter('denda_setor' .$d);
        $sisa       = $request->getParameter('denda_sisa' .$d);
        $ssbp       = $request->getParameter('denda_ssbp' .$d);
        $tglSsbp    = $request->getParameter('denda_tgl_ssbp' .$d);
        $buktiSetor = $request->getParameter('denda_bukti_setor' .$d);
        $tglSetor   = $request->getParameter('denda_tgl_setor' .$d);
        $keterangan = $request->getParameter('denda_keterangan' .$d);
        
        $new_setor      = $request->getParameter('new_denda_setor' .$d);
        $new_sisa       = $request->getParameter('new_denda_sisa' .$d);
        $new_ssbp       = $request->getParameter('new_denda_ssbp' .$d);
        $new_tglSsbp    = $request->getParameter('new_denda_tgl_ssbp' .$d);
        $new_buktiSetor = $request->getParameter('new_denda_bukti_setor' .$d);
        $new_tglSetor   = $request->getParameter('new_denda_tgl_setor' .$d);
        $new_keterangan = $request->getParameter('new_denda_keterangan' .$d);
        
        $idSetorDnt = $request->getParameter('idsetordnt');
        $id_setor_dnt = $request->getParameter('id_setor_dnt');
        
        $idDetailSetor = $request->getParameter('iddetailsetor');
        
        $idBp = $request->getParameter('idBp');
        $statusHD = $request->getParameter('statusHD');
        $statusBP = $request->getParameter('statusBP');
        
        //print_r($setor[$z]);exit;
        //if($idSetorDnt[$z] == ''){
          
          if($DendaHasilDinas[$z] != null and $BpAmarPutusan[$z] == null){
            if($id_setor_dnt[$z] == ''){
              $SetorDnt = new PDM_SETOR_DNT();
              $SetorDnt->setIdPerkara($request->getParameter('idperkara'));
              $SetorDnt->setIdTersangka($updateIdTersangka[$z]);
              $SetorDnt->setDenda($DendaHasilDinas[$z]);
              $SetorDnt->setStatus(1);
              for($c = 0; $c < count($setor); $c++){
                  if($setor[$c] != null and $sisa[$c] != '0'){
                      $SetorDnt->setStatus(2);
                  }elseif($sisa[$c] == '0'){
                      $SetorDnt->setStatus(3);
                  }
              }
              $SetorDnt->save();
              
            }else{
              if($new_setor != ''){
                for($ds = 0; $ds < count($new_setor); $ds++){
                  $SetorDetil = new PDM_DETAIL_STR();
                  $SetorDetil->setIdStrDnt($id_setor_dnt[$ds]);
                  $SetorDetil->setSetor($new_setor[$ds]);
                  $SetorDetil->setSisa($new_sisa[$ds]);
                  $SetorDetil->setNoSsbp($new_ssbp[$ds]);
                  $SetorDetil->setTglSsbp(setTanggal($new_tglSsbp[$ds]));
                  $SetorDetil->setNoBuktiStr($new_buktiSetor[$ds]);
                  $SetorDetil->setTglStr(setTanggal($new_tglSetor[$ds]));
                  $SetorDetil->setKeterangan($new_keterangan[$ds]);
                  $SetorDetil->setStatus(2);
                  $SetorDetil->save();
                }
              }else{
                for($ds = 0; $ds < count($setor); $ds++){
                  $updateDetailsSetorHD = Doctrine_Query::create()
                    ->update('PDM_DETAIL_STR')
                    ->set('SETOR', '?', $setor[$ds])
                    ->set('SISA', '?', $sisa[$ds])
                    ->set('NO_SSBP', '?', $ssbp[$ds])
                    ->set('TGL_SSBP', '?', setTanggal($tglSsbp[$ds]))
                    ->set('NO_BUKTI_STR', '?', $buktiSetor[$ds])
                    ->set('TGL_STR', '?', setTanggal($tglSetor[$ds]))
                    ->set('KETERANGAN', '?', $keterangan[$ds])
                    ->where('ID = '.$idDetailSetor[$ds].' AND ID_STR_DNT = ' . $idSetorDnt[$ds] . ' AND STATUS = 2')
                    ->execute();
                }
              }
              $updateSetorDnt = Doctrine_Query::create()
              ->update('PDM_SETOR_DNT')
              ->set('DENDA', '?', $DendaHasilDinas[$z])
              ->set('STATUS', '?', 1)
              ->where('ID = '.$id_setor_dnt[$z])
              ->execute();
            
              for($c = 0; $c < count($setor); $c++){
                if($setor[$c] != null and $sisa[$c] != '0'){
                    $updateSetorDnt = Doctrine_Query::create()
                    ->update('PDM_SETOR_DNT')
                    ->set('STATUS', '?', 2)
                    ->where('ID = '.$id_setor_dnt[$c])
                    ->execute();
                }elseif($sisa[$c] == '0'){
                    $updateSetorDnt = Doctrine_Query::create()
                    ->update('PDM_SETOR_DNT')
                    ->set('STATUS', '?', 3)
                    ->where('ID = '.$id_setor_dnt[$c])
                    ->execute();
                }
              }
            }
          }elseif($DendaHasilDinas[$z] == null and $BpAmarPutusan[$z] != null){
            if($id_setor_dnt[$z] == ''){
              $SetorDnt = new PDM_SETOR_DNT();
              $SetorDnt->setPjBiaya($BpAmarPutusan[$z]);
              $SetorDnt->save();
              
              $SetorDetil = new PDM_DETAIL_STR();
              $SetorDetil->setIdStrDnt($SetorDnt->getId());
              $SetorDetil->setSetor($BpSetor[$z]);
              $SetorDetil->setNoSsbp($BpNoSsbp[$z]);
              $SetorDetil->setTglSsbp(setTanggal($BpTglSsbp[$z]));
              $SetorDetil->setNoBuktiStr($BpNoBuktiStr[$z]);
              $SetorDetil->setTglStr(setTanggal($BpTglBuktiStr[$z]));
              $SetorDetil->setStatus(1);
              $SetorDetil->save();
            }else{  
              $updateSetorDnt = Doctrine_Query::create()
              ->update('PDM_SETOR_DNT')
              ->set('PJ_BIAYA', '?', $BpAmarPutusan[$z])
              ->where('ID = '.$id_setor_dnt[$z])
              ->execute();
              
              for($ds = 0; $ds < count($BpSetor); $ds++){
                    $updateDetailsSetorHD = Doctrine_Query::create()
                      ->update('PDM_DETAIL_STR')
                      ->set('SETOR', '?', $BpSetor[$ds])
                      ->set('NO_SSBP', '?', $BpNoSsbp[$ds])
                      ->set('TGL_SSBP', '?', setTanggal($BpTglSsbp[$ds]))
                      ->set('NO_BUKTI_STR', '?', $BpNoBuktiStr[$ds])
                      ->set('TGL_STR', '?', setTanggal($BpTglBuktiStr[$ds]))
                      ->where('ID = '.$idBp[$ds].' AND ID_STR_DNT = ' . $id_setor_dnt[$ds] . ' AND STATUS = 1')
                      ->execute();
                  }
            }
          }elseif($DendaHasilDinas[$z] != null and $BpAmarPutusan[$z] != null){
            if($id_setor_dnt[$z] == ''){  
              $updateSetorDnt = Doctrine_Query::create()
              ->update('PDM_SETOR_DNT')
              ->set('DENDA', '?', $DendaHasilDinas[$z])
              ->set('PJ_BIAYA', '?', $BpAmarPutusan[$z])
              ->where('ID = '.$id_setor_dnt[$z])
              ->execute();
            }else{
              if($new_setor != ''){
                for($ds = 0; $ds < count($new_setor); $ds++){
                  $SetorDetil = new PDM_DETAIL_STR();
                  $SetorDetil->setIdStrDnt($id_setor_dnt[$ds]);
                  $SetorDetil->setSetor($new_setor[$ds]);
                  $SetorDetil->setSisa($new_sisa[$ds]);
                  $SetorDetil->setNoSsbp($new_ssbp[$ds]);
                  $SetorDetil->setTglSsbp(setTanggal($new_tglSsbp[$ds]));
                  $SetorDetil->setNoBuktiStr($new_buktiSetor[$ds]);
                  $SetorDetil->setTglStr(setTanggal($new_tglSetor[$ds]));
                  $SetorDetil->setKeterangan($new_keterangan[$ds]);
                  $SetorDetil->setStatus(2);
                  $SetorDetil->save();
                }
              }else{
                for($ds = 0; $ds < count($setor); $ds++){
                  $updateDetailsSetorHD = Doctrine_Query::create()
                    ->update('PDM_DETAIL_STR')
                    ->set('SETOR', '?', $setor[$ds])
                    ->set('SISA', '?', $sisa[$ds])
                    ->set('NO_SSBP', '?', $ssbp[$ds])
                    ->set('TGL_SSBP', '?', setTanggal($tglSsbp[$ds]))
                    ->set('NO_BUKTI_STR', '?', $buktiSetor[$ds])
                    ->set('TGL_STR', '?', setTanggal($tglSetor[$ds]))
                    ->set('KETERANGAN', '?', $keterangan[$ds])
                    ->where('ID = '.$idDetailSetor[$ds].' AND ID_STR_DNT = ' . $idSetorDnt[$ds] . ' AND STATUS = 2')
                    ->execute();
                }
              }
              
              if($statusBP[$z] == 1){
                if($id_setor_dnt[$z] == ''){
                  for($ds = 0; $ds < count($BpSetor); $ds++){
                    $SetorDetil = new PDM_DETAIL_STR();
                    $SetorDetil->setIdStrDnt($id_setor_dnt[$ds]);
                    $SetorDetil->setSetor($BpSetor[$ds]);
                    $SetorDetil->setNoSsbp($BpNoSsbp[$ds]);
                    $SetorDetil->setTglSsbp(setTanggal($BpTglSsbp[$ds]));
                    $SetorDetil->setNoBuktiStr($BpNoBuktiStr[$ds]);
                    $SetorDetil->setTglStr(setTanggal($BpTglBuktiStr[$ds]));
                    $SetorDetil->setStatus(1);
                    $SetorDetil->save();
                  }
                }else{
                  for($ds = 0; $ds < count($BpSetor); $ds++){
                    $updateDetailsSetorHD = Doctrine_Query::create()
                      ->update('PDM_DETAIL_STR')
                      ->set('SETOR', '?', $BpSetor[$ds])
                      ->set('NO_SSBP', '?', $BpNoSsbp[$ds])
                      ->set('TGL_SSBP', '?', setTanggal($BpTglSsbp[$ds]))
                      ->set('NO_BUKTI_STR', '?', $BpNoBuktiStr[$ds])
                      ->set('TGL_STR', '?', setTanggal($BpTglBuktiStr[$ds]))
                      ->where('ID = '.$idBp[$ds].' AND ID_STR_DNT = ' . $id_setor_dnt[$ds] . ' AND STATUS = 1')
                      ->execute();
                  }
                }
              }
              
              $updateSetorDnt = Doctrine_Query::create()
              ->update('PDM_SETOR_DNT')
              ->set('DENDA', '?', $DendaHasilDinas[$z])
              ->set('PJ_BIAYA', '?', $BpAmarPutusan[$z])
              ->where('ID = '.$id_setor_dnt[$z])
              ->execute();
            }
          }
         
        
      }
      
        
        
      
      $conn->commit();
    }
    $this->redirect('dntpidum/edit?id='.$request->getParameter('idperkara'));
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pdm_perkara = Doctrine::getTable('PDM_PERKARA')->find(array($request->getParameter('id'))), sprintf('Object pdm_perkara does not exist (%s).', $request->getParameter('id')));
    $pdm_perkara->delete();

    $this->redirect('dntpidum/index');
  }
}

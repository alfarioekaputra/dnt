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
    //
  }
  
  public function executeGetdataindexpidum(sfWebRequest $request){
    $this->getResponse()->setContentType('application/json');
    
    /*$query = Doctrine::getTable('PDM_PERKARA')
              ->createQuery('a')
              ->execute();*/
    
    $conn = Doctrine_Manager::connection();
    $query = "SELECT A.ID_PERKARA ID_PERKARA,NOMOR_PERKARA,NO_TGL_PUTUSAN FROM 
              PDM_PERKARA
              INNER JOIN (SELECT ID_PERKARA, WM_CONCAT(NO#TGL_PUTUSAN) NO_TGL_PUTUSAN FROM (
              SELECT ID_PERKARA,
              CASE     WHEN PUTUSAN_UPAYA_HUKUM=1 THEN (SELECT TO_CHAR(TGL_PUTUSAN_PN) FROM PDM_PERKARA WHERE ID=PDM_TERSANGKA.ID_PERKARA)
                       WHEN PUTUSAN_TETAP=2 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_BANDING WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       WHEN PUTUSAN_TETAP=3 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_KASASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       WHEN PUTUSAN_TETAP=4 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_PK WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       WHEN PUTUSAN_TETAP=5 THEN (SELECT NO_GRASI||'#'||TGL_GRASI FROM PDM_UPAYA_GRASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       END NO#TGL_PUTUSAN
              FROM PDM_TERSANGKA
              WHERE PUTUSAN_UPAYA_HUKUM=1 OR PUTUSAN_TETAP IN(2,3,4,5)
              )B 
              GROUP BY ID_PERKARA) A ON A.ID_PERKARA=PDM_PERKARA.ID
              LEFT JOIN KP_INST_SATKER C ON ID_INSTANSI=C.INST_SATKERKD
              WHERE INST_SATKERKD='00'";
    
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
            SELECT ID_PERKARA,NAMA||' #'|| 
            TO_CHAR (TGL_LAHIR, 'dd-mm-yyyy' )|| ' #'|| 
            DECODE (JKL, 2, 'Perempuan', 1, 'Laki-laki', '-')||' #'||ALAMAT IDENTITAS
            FROM PDM_TERSANGKA
            WHERE (PUTUSAN_UPAYA_HUKUM=1 OR PUTUSAN_TETAP IN(2,3,4,5)) and id_perkara = '".$v['ID_PERKARA']."'
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
          
          $perkara = new PDM_PERKARA();
          $perkara->setNomorPerkara($request->getParameter('nomor_perkara'));
          $perkara->setJnsPelimpahan($request->getParameter('apb_aps'));
          $perkara->setPosisiKasus($request->getParameter('posisi_kasus'));
          $perkara->setInstSatkerkd('00');
          for ($j=0; $j < count($NoPutusan); $j++) {
            if($JnsPengadilanPutusan[$j] == 1){
                $perkara->setNoLimpahPk($NoPutusan[$j]);
                $perkara->setTglPutusanPn(setTanggal($TglPutusan[$j]));
                //$perkara->save();
              }
          }
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
            $terdakwa->setTglEksekusi($TglP48[$i]);
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

            $SetorDnt = new PDM_SETOR_DNT();
            $SetorDnt->setIdPerkara($perkara->getId());
            $SetorDnt->setIdTersangka($terdakwa->getId());
            $SetorDnt->setPjBiaya($DendaHasilDinas[$i]);
            $SetorDnt->save();

            $d = $i + 1;
            //untuk pembayaran denda
            $setor      = $request->getParameter('denda_setor' .$d);
            $sisa       = $request->getParameter('denda_sisa' .$d);
            $ssbp       = $request->getParameter('denda_ssbp' .$d);
            $tglSsbp    = $request->getParameter('denda_tgl_ssbp' .$d);
            $buktiSetor = $request->getParameter('denda_bukti_setor' .$d);
            $tglSetor   = $request->getParameter('denda_tgl_setor' .$d);
            $keterangan = $request->getParameter('denda_keterangan' .$d);

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
              $SetorDetil->save();
            }
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
      }
      
      //$this->redirect('dntpidum/edit?id='.$perkara->getId());
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
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pdm_perkara = Doctrine::getTable('PDM_PERKARA')->find(array($request->getParameter('id'))), sprintf('Object pdm_perkara does not exist (%s).', $request->getParameter('id')));
    $this->form = new PDM_PERKARAForm($pdm_perkara);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pdm_perkara = Doctrine::getTable('PDM_PERKARA')->find(array($request->getParameter('id'))), sprintf('Object pdm_perkara does not exist (%s).', $request->getParameter('id')));
    $pdm_perkara->delete();

    $this->redirect('dntpidum/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form, sfForm $formTersangka)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    $formTersangka->bind($request->getParameter($formTersangka->getName()), $request->getFiles($formTersangka->getName()));
    if ($form->isValid() and $formTersangka->isValid())
    {
      $perkara = new PDM_PERKARA();
      $perkara->setNomorPerkara($this->form['PDM_PERKARA']['nomor_perkara']->getValue());
      $perkara->save();
      
      $terdakwa = new PDM_TERSANGKA();
      $terdakwa->setNama($this->formTersangka['PDM_TERSANGKA']['nama']->getValue());
      $terdakwa->setTempatLahir($this->formTersangka['PDM_TERSANGKA']['tempat_lahir']->getValue());
      $terdakwa->setTglLahir(setTanggal($this->form['PDM_TERSANGKA']['tgl_lahir']->getValue()));
      $terdakwa->setJkl($this->formTersangka['PDM_TERSANGKA']['jkl']->getValue());
      $terdakwa->setPendidikan($this->formTersangka['PDM_TERSANGKA']['pendidikan']->getValue());
      $terdakwa->setIdAgama($this->formTersangka['PDM_TERSANGKA']['id_agama']->getValue());
      $terdakwa->setPekerjaan($this->formTersangka['PDM_TERSANGKA']['pekerjaan']->getValue());
      $terdakwa->setAlamat($this->formTersangka['PDM_TERSANGKA']['alamat']->getValue());
      $terdakwa->setIdPerkara($perkara->getId());
      $terdakwa->save();
      
      $this->redirect('dntpidum/edit?id='.$pdm_perkara->getId());
    }
  }
}

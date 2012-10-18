<?php
//ini_set('memory_limit', '-1');

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
    $query = "SELECT A.ID,
              NOMOR_PERKARA,
              NAMA,
              NO_TGL_PUTUSAN
            FROM PDM_PERKARA
            LEFT JOIN
              (SELECT ID,
                ID_PERKARA,
                NAMA,
                CASE
                  WHEN PUTUSAN_UPAYA_HUKUM=1
                  THEN
                    (SELECT TO_CHAR(''
                      ||'#'
                      ||TO_CHAR(TGL_PUTUSAN_PN, 'DD-MM-YYYY'))
                    FROM PDM_PERKARA
                    WHERE ID=PDM_TERSANGKA.ID_PERKARA
                    )
                  WHEN PUTUSAN_TETAP=2
                  THEN
                    (SELECT NO_PUTUSAN
                      ||'#'
                      ||TO_CHAR(TGL_PUTUSAN, 'DD-MM-YYYY')
                    FROM PDM_UPAYA_BANDING
                    WHERE ID_TERSANGKA=PDM_TERSANGKA.ID
                    )
                  WHEN PUTUSAN_TETAP=3
                  THEN
                    (SELECT NO_PUTUSAN
                      ||'#'
                      ||TO_CHAR(TGL_PUTUSAN, 'DD-MM-YYYY')
                    FROM PDM_UPAYA_KASASI
                    WHERE ID_TERSANGKA=PDM_TERSANGKA.ID
                    )
                  WHEN PUTUSAN_TETAP=4
                  THEN
                    (SELECT NO_PUTUSAN
                      ||'#'
                      ||TO_CHAR(TGL_PUTUSAN, 'DD-MM-YYYY')
                    FROM PDM_UPAYA_PK
                    WHERE ID_TERSANGKA=PDM_TERSANGKA.ID
                    )
                  WHEN PUTUSAN_TETAP=5
                  THEN
                    (SELECT NO_GRASI
                      ||'#'
                      ||TO_CHAR(TGL_GRASI, 'DD-MM-YYYY')
                    FROM PDM_UPAYA_GRASI
                    WHERE ID_TERSANGKA=PDM_TERSANGKA.ID
                    )
                END NO_TGL_PUTUSAN
              FROM PDM_TERSANGKA
              WHERE PUTUSAN_UPAYA_HUKUM = 1
              OR PUTUSAN_TETAP         IN (2,3,4,5)) A
              ON A.ID_PERKARA           =PDM_PERKARA.ID
              LEFT JOIN KP_INST_SATKER C
              ON ID_INSTANSI     =C.INST_SATKERKD
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
      if($first++)
        $json .= ',';
        $json .= '[
          "'.$v['NOMOR_PERKARA'].'",
          "'.$v['NAMA'].'",
          "'.$no_tgl_putusan[0].'",
          "'.$no_tgl_putusan[1].'",
          "'.$v['NOMOR_PERKARA'].'",';
        $json .= '"<center><a class=\"btn btn-info\" href=\"' . sfContext::getInstance()->getController()->genUrl('dntpidum/edit?id=' . $v['ID'] . '&kode_satker=' . $v['INST_SATKERKD'], true) . '\">Edit</a></center>"]';
        
        
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
      
      $this->forward404Unless($request->isMethod(sfRequest::POST));
      
      $this->form = new PDM_TERSANGKAForm();
      //$this->formTersangka = new PDM_TERSANGKAForm();
      
      $this->setTemplate('new');
      
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if ($request->isMethod('post')) {
          $perkara = new PDM_PERKARA();
          $perkara->setNomorPerkara($this->form['PDM_PERKARA']['nomor_perkara']->getValue());
          $perkara->save();
          
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
          
          for($i = 0; $i < count($nama_terdakwa); $i++)
          {
           // $connection = Doctrine_Manager::connection();
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
            $terdakwa->setIdPerkara($perkara->getId());
            $terdakwa->save();
           // $connection->commit();
          }
          
      }
      
      $this->redirect('dntpidum/edit?id='.$perkara->getId());
  }

  public function executeEdit(sfWebRequest $request)
  {
    //$this->forward404Unless(
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
                //sprintf('Object pdm_tersangka does not exist (%s).', $request->getParameter('id'))
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

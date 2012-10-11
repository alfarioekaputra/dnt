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
    $query = "SELECT  PDM_PERKARA.ID,PDM_PERKARA.NOMOR_PERKARA,NAMA||' #'|| 
              TO_CHAR (TGL_LAHIR, 'dd-mm-yyyy' )|| ' #'|| 
               DECODE (JKL, 2, 'Perempuan', 1, 'Laki-laki', '-')||' #'||ALAMAT as NAMA_TERSANGKA, 
              CASE 
                       WHEN PUTUSAN_UPAYA_HUKUM=1 THEN (SELECT TO_CHAR(TGL_PUTUSAN_PN) FROM PDM_PERKARA WHERE ID=PDM_TERSANGKA.ID_PERKARA)
                        WHEN PUTUSAN_TETAP=2 THEN (SELECT TO_CHAR(''||'#'||TGL_PUTUSAN_PN) FROM PDM_PERKARA WHERE ID=PDM_TERSANGKA.ID_PERKARA)
                       WHEN PUTUSAN_TETAP=3 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_BANDING WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                        WHEN PUTUSAN_TETAP=4 THEN (SELECT NO_PUTUSAN||'#'||TGL_PUTUSAN FROM PDM_UPAYA_KASASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                       WHEN PUTUSAN_TETAP=5 THEN (SELECT NO_GRASI||'#'||TGL_GRASI FROM PDM_UPAYA_GRASI WHERE ID_TERSANGKA=PDM_TERSANGKA.ID)
                        END NO#TGL_PUTUSAN,
              CASE WHEN PDM_SETOR_DNT.ID_TERSANGKA IS NULL THEN 'MERAH'
              WHEN PDM_SETOR_DNT.ID_TERSANGKA IS NOT NULL THEN 'HIJAU'
              END STATUS
              FROM PDM_TERSANGKA 
              LEFT JOIN PDM_PERKARA ON PDM_PERKARA.ID =PDM_TERSANGKA.ID_PERKARA
               LEFT JOIN PDM_SETOR_DNT ON PDM_SETOR_DNT.ID_TERSANGKA=PDM_TERSANGKA.ID";
    
    $item_per_page = $request->getParameter('iDisplayLength', 10);

    $page = ($request->getParameter('iDisplayStart', 0) / $item_per_page) + 1;
    $pager = $this->processDatadetil($page, $item_per_page, $query);
    
    $json = '{"iTotalRecords":'.count($pager).',
              "iTotalDisplayRecords":'.count($pager).',
              "aaData":[';
    
    $first = 0;
    
    foreach($pager->getResults() as $v){
      $no_tgl_putusan = explode("#",$v['NO#TGL_PUTUSAN']);
      //echo $abc[0];
      if($first++)
        $json .= ',';
        $json .= '[
          "<center>'.$v['NOMOR_PERKARA'].'</center>",
          "<center>'.$v['NAMA_TERSANGKA'].'</center>",
          "<center>'.$no_tgl_putusan[0].'</center>",
          "<center>'.$no_tgl_putusan[1].'</center>",
          "<center>'.$v['STATUS'].'</center>",';
        $json .= '"<center><a class=\"btn\" href=\"' . sfContext::getInstance()->getController()->genUrl('penerimaanSpdp/edittambah?id_perkara=' . $v['ID'] . '&kode_satker=' . $v['INST_SATKERKD'], true) . '\">Edit</a></center>"]';
        $json .= ']}';
        return $this->renderText($json);
    }
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
				"<input type=\"button\" class=\"ncusbtn\" data-dismiss=\"modal\" value=\"Pilih\" name=\"pilih\" onClick=\"goPilihKejati(\'' . $gabung . ' \',\'' . $pilihkejatitab . '\')\">"]';

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
    $this->form = new PDM_PERKARAForm();
    $this->formTersangka = new PDM_TERSANGKAForm();
    
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PDM_PERKARAForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pdm_perkara = Doctrine::getTable('PDM_PERKARA')->find(array($request->getParameter('id'))), sprintf('Object pdm_perkara does not exist (%s).', $request->getParameter('id')));
    $this->form = new PDM_PERKARAForm($pdm_perkara);
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

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pdm_perkara = $form->save();

      $this->redirect('dntpidum/edit?id='.$pdm_perkara->getId());
    }
  }
}

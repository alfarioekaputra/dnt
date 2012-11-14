<?php

/**
 * barangRampasan actions.
 *
 * @package    dnt
 * @subpackage barangRampasan
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class barangRampasanActions extends sfActions
{
 public function executeIndex(sfWebRequest $request)
  {
    //
  }
  
  public function executeGetDataIndexRampasan(sfWebRequest $request)
  {
	$this->getResponse()->setContentType('application/json');
    
    /*$query = Doctrine::getTable('PDM_PERKARA')
              ->createQuery('a')
              ->execute();*/
    
    $conn = Doctrine_Manager::connection();
    $query = "select a.*, a.id as id_barbuk, b.*, b.id as id_lelang, c.satuan, d.nomor_perkara from pdm_barbuk a
                left join pdm_barbuk_lelang b on a.id = b.id_barbuk
				left join pdm_satuan_ref c on a.id_satuan = c.id
				left join pdm_perkara d on a.id_perkara = d.id
                order by a.id";
    
    $item_per_page = $request->getParameter('iDisplayLength', 10);

    $page = ($request->getParameter('iDisplayStart', 0) / $item_per_page) + 1;
    $pager = $this->processDatadetil($page, $item_per_page, $query);
    
    $json = '{"iTotalRecords":'.count($pager).',
              "iTotalDisplayRecords":'.count($pager).',
              "aaData":[';
    
    $first = 0;
    
    foreach($pager->getResults() as $v){
      
      if($first++)
        $json .= ',';
        $json .= '[
          "'.$v['NOMOR_PERKARA'].'",
          "'.$v['NOMOR_PERKARA'].'",
          "'.$v['PENYIMPANAN'].'",
          "'.$v['KONDISI'].'",
          "'.$v['STATUS'].'",';
        $json .= '"<center><a class=\"btn btn-info\" href=\"' . sfContext::getInstance()->getController()->genUrl('barangRampasan/edit?id=' . $v['ID_PERKARA'] . '&kode_satker=' . $v['INST_SATKERKD'], true) . '\">Edit</a></center>"]';
        
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
    $this->pdm_barbuk = Doctrine::getTable('PDM_BARBUK')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pdm_barbuk);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PDM_BARBUKForm();
	
	$conn = Doctrine_Manager::connection();
	
	$conn = Doctrine_Manager::connection();
    $satuan = "select * from pdm_satuan_ref order by id";
	
	$statement = $conn->execute($satuan);
    $statement->execute();
    
    $this->resultData = $statement->fetchAll();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PDM_BARBUKForm();

    //$this->processForm($request, $this->form);
	$request->getParameter('idperkara');exit;

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    
	$conn = Doctrine_Manager::connection();
    $barbuk = "select a.*, a.id as idbarbuk, b.*, b.id as id_lelang, c.satuan from pdm_barbuk a
                left join pdm_barbuk_lelang b on a.id = b.id_barbuk
				left join pdm_satuan_ref c on a.id_satuan = c.id
                where a.id_perkara = '".$request->getParameter('id')."' order by a.id";
	
	$statement = $conn->execute($barbuk);
    $statement->execute();
    
    $this->resultData = $statement->fetchAll();
	
    $satuan = "select * from pdm_satuan_ref order by id";
	
	$statement = $conn->execute($satuan);
    $statement->execute();
    
    $this->resultSatuan = $statement->fetchAll();
	
  }

  public function executeUpdate(sfWebRequest $request)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Fungsi');
    //$this->processForm($request, $this->form);
	
	    $jenis = $request->getParameter('jenis');
        $jumlah = $request->getParameter('jumlah');
        $satuan = $request->getParameter('satuan');
        $pemilik = $request->getParameter('pemilik');
        $petunjuk = $request->getParameter('petunjuk');
        
        $NoBaLelang = $request->getParameter('no_ba_lelang');
        $TglLelang = $request->getParameter('tgl_lelang');
        $Taksiran = $request->getParameter('taksiran');
        $NilaiWajarLelang = $request->getParameter('nilai_wajar_hasil_lelang');
        $TempatPenyimpanan = $request->getParameter('tempat_penyimpanan');
        $Kondisi = $request->getParameter('kondisi');
        $HasilLelang = $request->getParameter('hasil_lelang');
        $Hambatan = $request->getParameter('hambatan');
        $Catatan = $request->getParameter('catatan');
        $IdBarbuk = $request->getParameter('idBarbuk');
        $IdLelang = $request->getParameter('idLelang');
        
        for($a = 0; $a < count($jenis); $a++){
          $updateBarbuk = Doctrine_Query::create()
          ->update('PDM_BARBUK')
          ->set('NAMA', '?', $jenis[$a])
          ->set('JUMLAH', '?', $jumlah[$a])
          ->set('ID_SATUAN', '?', $satuan[$a])
          ->set('PEMILIK', '?', $pemilik[$a])
          ->where('ID = '.$IdBarbuk[$a]. ' AND ID_PERKARA = '.$request->getParameter('idPerkara'))
          ->execute();
          
        }
		

		for($b = 0; $b < count($NoBaLelang); $b++){
			if($NoBaLelang[$b] == NULL){
				//
			}else{
				$updateBarbukLelang = Doctrine_Query::create()
				->update('PDM_BARBUK_LELANG')
				->set('NO_BA', '?', $NoBaLelang[$b])
				->set('TGL_LELANG', '?', setTanggal($TglLelang[$b]))
				->set('TAKSIRAN', '?', $Taksiran[$b])
				->set('NILAI_WAJAR', '?', $NilaiWajarLelang[$b])
				->set('PENYIMPANAN', '?', $TempatPenyimpanan[$b])
				->set('KONDISI', '?', $Kondisi[$b])
				->set('HASIL_LELANG', '?', $HasilLelang[$b])
				->set('HAMBATAN', '?', $Hambatan[$b])
				->set('PETUNJUK', '?', $Catatan[$b])
				->where('ID = '.$IdLelang[$b])
				->execute();
			}
		}

    $this->redirect('dntpidum/edit?id='.$request->getParameter('idPerkara'));
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pdm_barbuk = Doctrine::getTable('PDM_BARBUK')->find(array($request->getParameter('id'))), sprintf('Object pdm_barbuk does not exist (%s).', $request->getParameter('id')));
    $pdm_barbuk->delete();

    $this->redirect('barangRampasan/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pdm_barbuk = $form->save();

      $this->redirect('barangRampasan/edit?id='.$pdm_barbuk->getId());
    }
  }
}

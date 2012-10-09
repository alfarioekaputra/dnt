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
    $query = "select * from pdm_perkara";
    
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
          "'.$v['ID'].'",
          "'.$v['NOMOR_PERKARA'].'",
          "'.$v['NOMOR_PERKARA'].'",
          "'.$v['NOMOR_PERKARA'].'",
          "'.$v['NOMOR_PERKARA'].'",
          "'.$v['NOMOR_PERKARA'].'"
        ]';
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

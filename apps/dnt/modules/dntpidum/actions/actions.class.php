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
    $this->pdm_perkar_as = Doctrine::getTable('KP_INST_SATKER')
      ->createQuery('a')
      ->select('a.inst_satkerkd, a.inst_satkerinduk, a.inst_nama')
      ->execute();
      
      foreach($this->pdm_perkar_as as $abc){
		 $response['inst_satkerkd'] = $abc->getInstSatkerkd();  
		 $response['inst_satkerinduk'] = $abc->getInstSatkerinduk();  
		 $response['inst_nama'] = $abc->getInstNama();  
	  }
	  echo json_encode($response);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pdm_perkara = Doctrine::getTable('PDM_PERKARA')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pdm_perkara);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PDM_PERKARAForm();
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

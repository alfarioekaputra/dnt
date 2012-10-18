<?php

/**
 * dnttest actions.
 *
 * @package    dnt
 * @subpackage dnttest
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dnttestActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->pdm_upaya_bandin_gs = Doctrine::getTable('PDM_TERSANGKA')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pdm_upaya_banding = Doctrine::getTable('PDM_UPAYA_BANDING')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pdm_upaya_banding);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PDM_UPAYA_BANDINGForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PDM_UPAYA_BANDINGForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pdm_upaya_banding = Doctrine::getTable('PDM_UPAYA_BANDING')->find(array($request->getParameter('id'))), sprintf('Object pdm_upaya_banding does not exist (%s).', $request->getParameter('id')));
    $this->form = new PDM_UPAYA_BANDINGForm($pdm_upaya_banding);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pdm_upaya_banding = Doctrine::getTable('PDM_UPAYA_BANDING')->find(array($request->getParameter('id'))), sprintf('Object pdm_upaya_banding does not exist (%s).', $request->getParameter('id')));
    $this->form = new PDM_UPAYA_BANDINGForm($pdm_upaya_banding);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($pdm_upaya_banding = Doctrine::getTable('PDM_UPAYA_BANDING')->find(array($request->getParameter('id'))), sprintf('Object pdm_upaya_banding does not exist (%s).', $request->getParameter('id')));
    $pdm_upaya_banding->delete();

    $this->redirect('dnttest/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pdm_upaya_banding = $form->save();

      $this->redirect('dnttest/edit?id='.$pdm_upaya_banding->getId());
    }
  }
}

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
    $this->pdm_barbu_ks = Doctrine::getTable('PDM_BARBUK')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pdm_barbuk = Doctrine::getTable('PDM_BARBUK')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pdm_barbuk);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PDM_BARBUKForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PDM_BARBUKForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pdm_barbuk = Doctrine::getTable('PDM_BARBUK')->find(array($request->getParameter('id'))), sprintf('Object pdm_barbuk does not exist (%s).', $request->getParameter('id')));
    $this->form = new PDM_BARBUKForm($pdm_barbuk);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pdm_barbuk = Doctrine::getTable('PDM_BARBUK')->find(array($request->getParameter('id'))), sprintf('Object pdm_barbuk does not exist (%s).', $request->getParameter('id')));
    $this->form = new PDM_BARBUKForm($pdm_barbuk);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
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

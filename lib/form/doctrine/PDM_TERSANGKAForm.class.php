<?php

/**
 * PDM_TERSANGKA form.
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PDM_TERSANGKAForm extends BasePDM_TERSANGKAForm
{
  public function configure()
  {
	$this->embedRelation('PDM_PERKARA');
	
	$this->setWidget('id_agama', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MS_AGAMA'), 'add_empty' => 'Pilih', 'method' => 'getNama')));
	$this->setWidget('pendidikan', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MS_PENDIDIKAN'), 'add_empty' => 'Pilih', 'method' => 'getNama')));
	$this->setWidget('jkl', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MS_JNSKELAMIN'), 'add_empty' => 'Pilih', 'method' => 'getNama')));
	$this->setWidget('tgl_lahir', new sfWidgetFormInputText());
	$this->setWidget('alamat', new sfWidgetFormTextArea());
  }
}

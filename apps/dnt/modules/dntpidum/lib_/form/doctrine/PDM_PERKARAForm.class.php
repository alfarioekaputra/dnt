<?php

/**
 * PDM_PERKARA form.
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PDM_PERKARAForm extends BasePDM_PERKARAForm
{
  public function configure()
  {
	$this->embedRelation('PDM_TERSANGKA');
	
	//unset ($this['id']);
  }
}

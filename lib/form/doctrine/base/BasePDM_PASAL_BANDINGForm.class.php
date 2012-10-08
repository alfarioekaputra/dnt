<?php

/**
 * PDM_PASAL_BANDING form base class.
 *
 * @method PDM_PASAL_BANDING getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_PASAL_BANDINGForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_banding' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_UPAYA_BANDING'), 'add_empty' => true)),
      'pasal'      => new sfWidgetFormTextarea(),
      'terbukti'   => new sfWidgetFormInputText(),
      'idoff'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_banding' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_UPAYA_BANDING'), 'required' => false)),
      'pasal'      => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'terbukti'   => new sfValidatorInteger(array('required' => false)),
      'idoff'      => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_pasal_banding[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_PASAL_BANDING';
  }

}

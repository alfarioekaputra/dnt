<?php

/**
 * PDM_PASAL form base class.
 *
 * @method PDM_PASAL getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_PASALForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_tersangka' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'add_empty' => true)),
      'pasal'        => new sfWidgetFormTextarea(),
      'disangkakan'  => new sfWidgetFormInputText(),
      'didakwakan'   => new sfWidgetFormInputText(),
      'terbukti'     => new sfWidgetFormInputText(),
      'idoff'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_tersangka' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'required' => false)),
      'pasal'        => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'disangkakan'  => new sfValidatorInteger(array('required' => false)),
      'didakwakan'   => new sfValidatorInteger(array('required' => false)),
      'terbukti'     => new sfValidatorInteger(array('required' => false)),
      'idoff'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_pasal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_PASAL';
  }

}

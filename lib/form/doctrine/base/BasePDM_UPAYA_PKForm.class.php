<?php

/**
 * PDM_UPAYA_PK form base class.
 *
 * @method PDM_UPAYA_PK getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_UPAYA_PKForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'no_pk'        => new sfWidgetFormInputText(),
      'tgl_pk'       => new sfWidgetFormDateTime(),
      'tgl_nota_pk'  => new sfWidgetFormDateTime(),
      'isi_nota_pk'  => new sfWidgetFormTextarea(),
      'no_putusan'   => new sfWidgetFormInputText(),
      'tgl_putusan'  => new sfWidgetFormDateTime(),
      'isi_putusan'  => new sfWidgetFormTextarea(),
      'id_tersangka' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'add_empty' => true)),
      'idoff'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'no_pk'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tgl_pk'       => new sfValidatorDateTime(array('required' => false)),
      'tgl_nota_pk'  => new sfValidatorDateTime(array('required' => false)),
      'isi_nota_pk'  => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'no_putusan'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tgl_putusan'  => new sfValidatorDateTime(array('required' => false)),
      'isi_putusan'  => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'id_tersangka' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'required' => false)),
      'idoff'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_upaya_pk[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_UPAYA_PK';
  }

}

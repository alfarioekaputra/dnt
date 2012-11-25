<?php

/**
 * PDM_UPAYA_GRASI form base class.
 *
 * @method PDM_UPAYA_GRASI getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_UPAYA_GRASIForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'no_grasi'          => new sfWidgetFormInputText(),
      'tgl_grasi'         => new sfWidgetFormDateTime(),
      'no_keppres'        => new sfWidgetFormInputText(),
      'tgl_keppres'       => new sfWidgetFormDateTime(),
      'isi_keppres'       => new sfWidgetFormTextarea(),
      'id_tersangka'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'add_empty' => true)),
      'tgl_timbang_grasi' => new sfWidgetFormDateTime(),
      'isi_timbang_grasi' => new sfWidgetFormTextarea(),
      'idoff'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'no_grasi'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tgl_grasi'         => new sfValidatorDateTime(array('required' => false)),
      'no_keppres'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tgl_keppres'       => new sfValidatorDateTime(array('required' => false)),
      'isi_keppres'       => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'id_tersangka'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'required' => false)),
      'tgl_timbang_grasi' => new sfValidatorDateTime(array('required' => false)),
      'isi_timbang_grasi' => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'idoff'             => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_upaya_grasi[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_UPAYA_GRASI';
  }

}

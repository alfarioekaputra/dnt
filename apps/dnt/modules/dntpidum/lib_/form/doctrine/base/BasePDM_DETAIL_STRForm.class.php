<?php

/**
 * PDM_DETAIL_STR form base class.
 *
 * @method PDM_DETAIL_STR getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_DETAIL_STRForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_str_dnt'      => new sfWidgetFormInputText(),
      'no_ssbp'         => new sfWidgetFormInputText(),
      'tgl_ssbp'        => new sfWidgetFormDateTime(),
      'no_bukti_str'    => new sfWidgetFormInputText(),
      'tgl_str'         => new sfWidgetFormDateTime(),
      'setor'           => new sfWidgetFormInputText(),
      'status'          => new sfWidgetFormInputText(),
      'keterangan'      => new sfWidgetFormInputText(),
      'created_by'      => new sfWidgetFormInputText(),
      'created_ip'      => new sfWidgetFormInputText(),
      'created_time'    => new sfWidgetFormDateTime(),
      'lastupdate_by'   => new sfWidgetFormInputText(),
      'lastupdate_ip'   => new sfWidgetFormInputText(),
      'lastupdate_time' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_str_dnt'      => new sfValidatorInteger(array('required' => false)),
      'no_ssbp'         => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'tgl_ssbp'        => new sfValidatorDateTime(array('required' => false)),
      'no_bukti_str'    => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'tgl_str'         => new sfValidatorDateTime(array('required' => false)),
      'setor'           => new sfValidatorNumber(array('required' => false)),
      'status'          => new sfValidatorInteger(array('required' => false)),
      'keterangan'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_by'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'created_ip'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'created_time'    => new sfValidatorDateTime(array('required' => false)),
      'lastupdate_by'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'lastupdate_ip'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'lastupdate_time' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_detail_str[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_DETAIL_STR';
  }

}

<?php

/**
 * PDM_SETOR_DNT form base class.
 *
 * @method PDM_SETOR_DNT getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_SETOR_DNTForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'id_perkara'        => new sfWidgetFormInputText(),
      'id_tersangka'      => new sfWidgetFormInputText(),
      'pj_biaya'          => new sfWidgetFormInputText(),
      'denda'             => new sfWidgetFormInputText(),
      'uang_lelang'       => new sfWidgetFormInputText(),
      'uang_rampasan'     => new sfWidgetFormInputText(),
      'str_pj_biaya'      => new sfWidgetFormInputText(),
      'str_denda'         => new sfWidgetFormInputText(),
      'str_uang_lelang'   => new sfWidgetFormInputText(),
      'str_uang_rampasan' => new sfWidgetFormInputText(),
      'created_by'        => new sfWidgetFormInputText(),
      'created_time'      => new sfWidgetFormDateTime(),
      'created_ip'        => new sfWidgetFormInputText(),
      'lastupdate_by'     => new sfWidgetFormInputText(),
      'lastupdate_time'   => new sfWidgetFormDateTime(),
      'lastupdate_ip'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_perkara'        => new sfValidatorInteger(),
      'id_tersangka'      => new sfValidatorInteger(),
      'pj_biaya'          => new sfValidatorNumber(array('required' => false)),
      'denda'             => new sfValidatorNumber(array('required' => false)),
      'uang_lelang'       => new sfValidatorNumber(array('required' => false)),
      'uang_rampasan'     => new sfValidatorNumber(array('required' => false)),
      'str_pj_biaya'      => new sfValidatorNumber(array('required' => false)),
      'str_denda'         => new sfValidatorNumber(array('required' => false)),
      'str_uang_lelang'   => new sfValidatorNumber(array('required' => false)),
      'str_uang_rampasan' => new sfValidatorNumber(array('required' => false)),
      'created_by'        => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'created_time'      => new sfValidatorDateTime(array('required' => false)),
      'created_ip'        => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'lastupdate_by'     => new sfValidatorString(array('max_length' => 32, 'required' => false)),
      'lastupdate_time'   => new sfValidatorDateTime(array('required' => false)),
      'lastupdate_ip'     => new sfValidatorString(array('max_length' => 32, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_setor_dnt[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_SETOR_DNT';
  }

}

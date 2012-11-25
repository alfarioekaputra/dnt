<?php

/**
 * PDM_BARBUK_LELANG form base class.
 *
 * @method PDM_BARBUK_LELANG getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_BARBUK_LELANGForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_str_dnt'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_SETOR_DNT'), 'add_empty' => true)),
      'no_ba'           => new sfWidgetFormInputText(),
      'tgl_lelang'      => new sfWidgetFormDateTime(),
      'taksiran'        => new sfWidgetFormInputText(),
      'nilai_wajar'     => new sfWidgetFormInputText(),
      'penyimpanan'     => new sfWidgetFormInputText(),
      'kondisi'         => new sfWidgetFormInputText(),
      'hambatan'        => new sfWidgetFormInputText(),
      'usulan'          => new sfWidgetFormInputText(),
      'petunjuk'        => new sfWidgetFormInputText(),
      'hasil_lelang'    => new sfWidgetFormInputText(),
      'no_bukti_str'    => new sfWidgetFormInputText(),
      'tgl_str'         => new sfWidgetFormDateTime(),
      'status'          => new sfWidgetFormInputText(),
      'created_by'      => new sfWidgetFormInputText(),
      'created_ip'      => new sfWidgetFormInputText(),
      'created_time'    => new sfWidgetFormDateTime(),
      'lastupdate_by'   => new sfWidgetFormInputText(),
      'lastupdate_ip'   => new sfWidgetFormInputText(),
      'lastupdate_time' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_str_dnt'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_SETOR_DNT'), 'required' => false)),
      'no_ba'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'tgl_lelang'      => new sfValidatorDateTime(array('required' => false)),
      'taksiran'        => new sfValidatorNumber(array('required' => false)),
      'nilai_wajar'     => new sfValidatorNumber(array('required' => false)),
      'penyimpanan'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'kondisi'         => new sfValidatorInteger(array('required' => false)),
      'hambatan'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'usulan'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'petunjuk'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'hasil_lelang'    => new sfValidatorNumber(array('required' => false)),
      'no_bukti_str'    => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'tgl_str'         => new sfValidatorDateTime(array('required' => false)),
      'status'          => new sfValidatorInteger(array('required' => false)),
      'created_by'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'created_ip'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'created_time'    => new sfValidatorDateTime(array('required' => false)),
      'lastupdate_by'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'lastupdate_ip'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'lastupdate_time' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_barbuk_lelang[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_BARBUK_LELANG';
  }

}

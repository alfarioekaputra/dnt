<?php

/**
 * KP_INST_SATKER form base class.
 *
 * @method KP_INST_SATKER getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseKP_INST_SATKERForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputText(),
      'inst_satkerkd'         => new sfWidgetFormInputText(),
      'inst_satkerinduk'      => new sfWidgetFormInputText(),
      'inst_nama'             => new sfWidgetFormInputText(),
      'inst_kepala'           => new sfWidgetFormInputText(),
      'inst_akronim'          => new sfWidgetFormInputText(),
      'inst_alamat'           => new sfWidgetFormInputText(),
      'inst_telepon'          => new sfWidgetFormInputText(),
      'inst_fax'              => new sfWidgetFormInputText(),
      'inst_jenis'            => new sfWidgetFormInputText(),
      'inst_level'            => new sfWidgetFormInputText(),
      'inst_indukpkpn'        => new sfWidgetFormInputText(),
      'inst_indukbkn'         => new sfWidgetFormInputText(),
      'inst_wilayahbayar'     => new sfWidgetFormInputText(),
      'inst_lokinst'          => new sfWidgetFormInputText(),
      'inst_jnslokasi'        => new sfWidgetFormInputText(),
      'inst_lokkec'           => new sfWidgetFormInputText(),
      'inst_lokkab'           => new sfWidgetFormInputText(),
      'inst_lokprov'          => new sfWidgetFormInputText(),
      'inst_kepala_nip'       => new sfWidgetFormInputText(),
      'id_cabang'             => new sfWidgetFormInputText(),
      'created_by'            => new sfWidgetFormInputText(),
      'created_time'          => new sfWidgetFormDateTime(),
      'created_ip'            => new sfWidgetFormInputText(),
      'lastupdate_by'         => new sfWidgetFormInputText(),
      'lastupdate_time'       => new sfWidgetFormDateTime(),
      'lastupdate_ip'         => new sfWidgetFormInputText(),
      'inst_intern'           => new sfWidgetFormInputText(),
      'inst_satkerinduk_temp' => new sfWidgetFormInputText(),
      'inst_satkerkd_temp'    => new sfWidgetFormInputText(),
      'is_active'             => new sfWidgetFormInputCheckbox(),
      'thn_kepja'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorInteger(array('required' => false)),
      'inst_satkerkd'         => new sfValidatorString(array('max_length' => 50)),
      'inst_satkerinduk'      => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'inst_nama'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'inst_kepala'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'inst_akronim'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'inst_alamat'           => new sfValidatorString(array('max_length' => 80, 'required' => false)),
      'inst_telepon'          => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'inst_fax'              => new sfValidatorString(array('max_length' => 11, 'required' => false)),
      'inst_jenis'            => new sfValidatorString(array('max_length' => 1, 'required' => false)),
      'inst_level'            => new sfValidatorInteger(array('required' => false)),
      'inst_indukpkpn'        => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'inst_indukbkn'         => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'inst_wilayahbayar'     => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'inst_lokinst'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'inst_jnslokasi'        => new sfValidatorInteger(array('required' => false)),
      'inst_lokkec'           => new sfValidatorInteger(array('required' => false)),
      'inst_lokkab'           => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'inst_lokprov'          => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'inst_kepala_nip'       => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'id_cabang'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_by'            => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'created_time'          => new sfValidatorDateTime(array('required' => false)),
      'created_ip'            => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'lastupdate_by'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'lastupdate_time'       => new sfValidatorDateTime(array('required' => false)),
      'lastupdate_ip'         => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'inst_intern'           => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'inst_satkerinduk_temp' => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'inst_satkerkd_temp'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'is_active'             => new sfValidatorBoolean(array('required' => false)),
      'thn_kepja'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kp_inst_satker[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'KP_INST_SATKER';
  }

}

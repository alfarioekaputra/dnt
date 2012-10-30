<?php

/**
 * PDM_UPAYA_BANDING form base class.
 *
 * @method PDM_UPAYA_BANDING getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_UPAYA_BANDINGForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'no_akta'             => new sfWidgetFormInputText(),
      'tgl_akta'            => new sfWidgetFormDateTime(),
      'no_memori'           => new sfWidgetFormInputText(),
      'tgl_memori'          => new sfWidgetFormDateTime(),
      'isi_memori'          => new sfWidgetFormTextarea(),
      'no_putusan'          => new sfWidgetFormInputText(),
      'tgl_putusan'         => new sfWidgetFormDateTime(),
      'isi_putusan'         => new sfWidgetFormTextarea(),
      'id_tersangka'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'add_empty' => true)),
      'jenis_putusan'       => new sfWidgetFormInputText(),
      'pj_pidana_coba'      => new sfWidgetFormInputText(),
      'pj_masa_coba'        => new sfWidgetFormInputText(),
      'pj_badan_tahun'      => new sfWidgetFormInputText(),
      'pj_badan_bulan'      => new sfWidgetFormInputText(),
      'pj_badan_hari'       => new sfWidgetFormInputText(),
      'pj_denda_rp'         => new sfWidgetFormInputText(),
      'pj_sub_tahun'        => new sfWidgetFormInputText(),
      'pj_sub_bulan'        => new sfWidgetFormInputText(),
      'pj_sub_hari'         => new sfWidgetFormInputText(),
      'pj_biaya'            => new sfWidgetFormInputText(),
      'kurungan_tahun'      => new sfWidgetFormInputText(),
      'kurungan_bulan'      => new sfWidgetFormInputText(),
      'kurungan_hari'       => new sfWidgetFormInputText(),
      'denda'               => new sfWidgetFormInputText(),
      'putusan_tambahan'    => new sfWidgetFormTextarea(),
      'sikap_jaksa'         => new sfWidgetFormInputText(),
      'sikap_terdakwa'      => new sfWidgetFormInputText(),
      'pj_pidana_coba_thn'  => new sfWidgetFormInputText(),
      'pj_pidana_coba_bln'  => new sfWidgetFormInputText(),
      'pj_pidana_coba_hari' => new sfWidgetFormInputText(),
      'idoff'               => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'no_akta'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tgl_akta'            => new sfValidatorDateTime(array('required' => false)),
      'no_memori'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tgl_memori'          => new sfValidatorDateTime(array('required' => false)),
      'isi_memori'          => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'no_putusan'          => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'tgl_putusan'         => new sfValidatorDateTime(array('required' => false)),
      'isi_putusan'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'id_tersangka'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_TERSANGKA'), 'required' => false)),
      'jenis_putusan'       => new sfValidatorInteger(array('required' => false)),
      'pj_pidana_coba'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'pj_masa_coba'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'pj_badan_tahun'      => new sfValidatorInteger(array('required' => false)),
      'pj_badan_bulan'      => new sfValidatorInteger(array('required' => false)),
      'pj_badan_hari'       => new sfValidatorInteger(array('required' => false)),
      'pj_denda_rp'         => new sfValidatorNumber(array('required' => false)),
      'pj_sub_tahun'        => new sfValidatorInteger(array('required' => false)),
      'pj_sub_bulan'        => new sfValidatorInteger(array('required' => false)),
      'pj_sub_hari'         => new sfValidatorInteger(array('required' => false)),
      'pj_biaya'            => new sfValidatorNumber(array('required' => false)),
      'kurungan_tahun'      => new sfValidatorInteger(array('required' => false)),
      'kurungan_bulan'      => new sfValidatorInteger(array('required' => false)),
      'kurungan_hari'       => new sfValidatorInteger(array('required' => false)),
      'denda'               => new sfValidatorNumber(array('required' => false)),
      'putusan_tambahan'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'sikap_jaksa'         => new sfValidatorInteger(array('required' => false)),
      'sikap_terdakwa'      => new sfValidatorInteger(array('required' => false)),
      'pj_pidana_coba_thn'  => new sfValidatorInteger(array('required' => false)),
      'pj_pidana_coba_bln'  => new sfValidatorInteger(array('required' => false)),
      'pj_pidana_coba_hari' => new sfValidatorInteger(array('required' => false)),
      'idoff'               => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_upaya_banding[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_UPAYA_BANDING';
  }

}

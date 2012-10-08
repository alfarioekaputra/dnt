<?php

/**
 * PDM_TERSANGKA form base class.
 *
 * @method PDM_TERSANGKA getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_TERSANGKAForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'nama'                   => new sfWidgetFormInputText(),
      'tempat_lahir'           => new sfWidgetFormInputText(),
      'tgl_lahir'              => new sfWidgetFormDateTime(),
      'jkl'                    => new sfWidgetFormInputText(),
      'kewarganegaraan'        => new sfWidgetFormInputText(),
      'alamat'                 => new sfWidgetFormInputText(),
      'pekerjaan'              => new sfWidgetFormInputText(),
      'id_perkara'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_PERKARA'), 'add_empty' => true)),
      'ph_jpu_mulai'           => new sfWidgetFormDateTime(),
      'ph_jpu_selesai'         => new sfWidgetFormDateTime(),
      'ph_jpu_lokasi'          => new sfWidgetFormInputText(),
      'ph_hakim1_mulai'        => new sfWidgetFormDateTime(),
      'ph_hakim1_selesai'      => new sfWidgetFormDateTime(),
      'ph_hakim1_lokasi'       => new sfWidgetFormInputText(),
      'ph_hakim2_mulai'        => new sfWidgetFormDateTime(),
      'ph_hakim2_selesai'      => new sfWidgetFormDateTime(),
      'ph_hakim2_lokasi'       => new sfWidgetFormInputText(),
      'ph_pengalihan_mulai'    => new sfWidgetFormDateTime(),
      'ph_pengalihan_selesai'  => new sfWidgetFormDateTime(),
      'ph_pengalihan_lokasi'   => new sfWidgetFormInputText(),
      'ph_pembantaran_mulai'   => new sfWidgetFormDateTime(),
      'ph_pembantaran_selesai' => new sfWidgetFormDateTime(),
      'ph_pembantaran_lokasi'  => new sfWidgetFormInputText(),
      'jenis_putusan'          => new sfWidgetFormInputText(),
      'pj_pidana_coba'         => new sfWidgetFormInputText(),
      'pj_masa_coba'           => new sfWidgetFormInputText(),
      'pj_badan_tahun'         => new sfWidgetFormInputText(),
      'pj_badan_bulan'         => new sfWidgetFormInputText(),
      'pj_badan_hari'          => new sfWidgetFormInputText(),
      'pj_denda_rp'            => new sfWidgetFormInputText(),
      'pj_sub_tahun'           => new sfWidgetFormInputText(),
      'pj_sub_bulan'           => new sfWidgetFormInputText(),
      'pj_sub_hari'            => new sfWidgetFormInputText(),
      'pj_biaya'               => new sfWidgetFormInputText(),
      'kurungan_tahun'         => new sfWidgetFormInputText(),
      'kurungan_bulan'         => new sfWidgetFormInputText(),
      'kurungan_hari'          => new sfWidgetFormInputText(),
      'denda'                  => new sfWidgetFormInputText(),
      'putusan_tambahan'       => new sfWidgetFormTextarea(),
      'sikap_jaksa'            => new sfWidgetFormInputText(),
      'sikap_terdakwa'         => new sfWidgetFormInputText(),
      'ph_penyidik_mulai'      => new sfWidgetFormDateTime(),
      'ph_penyidik_selesai'    => new sfWidgetFormDateTime(),
      'ph_penyidik_lokasi'     => new sfWidgetFormInputText(),
      'ph_kejari_mulai'        => new sfWidgetFormDateTime(),
      'ph_kejari_selesai'      => new sfWidgetFormDateTime(),
      'ph_kejari_lokasi'       => new sfWidgetFormInputText(),
      'ph_pn_mulai'            => new sfWidgetFormDateTime(),
      'ph_pn_selesai'          => new sfWidgetFormDateTime(),
      'ph_pn_lokasi'           => new sfWidgetFormInputText(),
      'umur'                   => new sfWidgetFormInputText(),
      'id_agama'               => new sfWidgetFormInputText(),
      'pendidikan'             => new sfWidgetFormInputText(),
      'putusan_tetap'          => new sfWidgetFormInputText(),
      'tgl_eksekusi'           => new sfWidgetFormDateTime(),
      'putusan_upaya_hukum'    => new sfWidgetFormInputText(),
      'tgl_ptsn_bndg_ksasi'    => new sfWidgetFormDateTime(),
      'tgl_ptsn_pk_grasi'      => new sfWidgetFormDateTime(),
      'tgl_eksekusi_pk_grasi'  => new sfWidgetFormDateTime(),
      'pj_pidana_coba_thn'     => new sfWidgetFormInputText(),
      'pj_pidana_coba_bln'     => new sfWidgetFormInputText(),
      'pj_pidana_coba_hari'    => new sfWidgetFormInputText(),
      'idoff'                  => new sfWidgetFormInputText(),
      'rentut_jaksajpu'        => new sfWidgetFormInputText(),
      'rentut_kasipidum'       => new sfWidgetFormInputText(),
      'rentut_kejari'          => new sfWidgetFormInputText(),
      'rentut_kejati'          => new sfWidgetFormInputText(),
      'rentut_kejagung'        => new sfWidgetFormInputText(),
      'pdn_pengawasan'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'nama'                   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'tempat_lahir'           => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'tgl_lahir'              => new sfValidatorDateTime(array('required' => false)),
      'jkl'                    => new sfValidatorInteger(array('required' => false)),
      'kewarganegaraan'        => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'alamat'                 => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'pekerjaan'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'id_perkara'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_PERKARA'), 'required' => false)),
      'ph_jpu_mulai'           => new sfValidatorDateTime(array('required' => false)),
      'ph_jpu_selesai'         => new sfValidatorDateTime(array('required' => false)),
      'ph_jpu_lokasi'          => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ph_hakim1_mulai'        => new sfValidatorDateTime(array('required' => false)),
      'ph_hakim1_selesai'      => new sfValidatorDateTime(array('required' => false)),
      'ph_hakim1_lokasi'       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ph_hakim2_mulai'        => new sfValidatorDateTime(array('required' => false)),
      'ph_hakim2_selesai'      => new sfValidatorDateTime(array('required' => false)),
      'ph_hakim2_lokasi'       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ph_pengalihan_mulai'    => new sfValidatorDateTime(array('required' => false)),
      'ph_pengalihan_selesai'  => new sfValidatorDateTime(array('required' => false)),
      'ph_pengalihan_lokasi'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'ph_pembantaran_mulai'   => new sfValidatorDateTime(array('required' => false)),
      'ph_pembantaran_selesai' => new sfValidatorDateTime(array('required' => false)),
      'ph_pembantaran_lokasi'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'jenis_putusan'          => new sfValidatorInteger(array('required' => false)),
      'pj_pidana_coba'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'pj_masa_coba'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'pj_badan_tahun'         => new sfValidatorInteger(array('required' => false)),
      'pj_badan_bulan'         => new sfValidatorInteger(array('required' => false)),
      'pj_badan_hari'          => new sfValidatorInteger(array('required' => false)),
      'pj_denda_rp'            => new sfValidatorNumber(array('required' => false)),
      'pj_sub_tahun'           => new sfValidatorInteger(array('required' => false)),
      'pj_sub_bulan'           => new sfValidatorInteger(array('required' => false)),
      'pj_sub_hari'            => new sfValidatorInteger(array('required' => false)),
      'pj_biaya'               => new sfValidatorNumber(array('required' => false)),
      'kurungan_tahun'         => new sfValidatorInteger(array('required' => false)),
      'kurungan_bulan'         => new sfValidatorInteger(array('required' => false)),
      'kurungan_hari'          => new sfValidatorInteger(array('required' => false)),
      'denda'                  => new sfValidatorNumber(array('required' => false)),
      'putusan_tambahan'       => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'sikap_jaksa'            => new sfValidatorInteger(array('required' => false)),
      'sikap_terdakwa'         => new sfValidatorInteger(array('required' => false)),
      'ph_penyidik_mulai'      => new sfValidatorDateTime(array('required' => false)),
      'ph_penyidik_selesai'    => new sfValidatorDateTime(array('required' => false)),
      'ph_penyidik_lokasi'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ph_kejari_mulai'        => new sfValidatorDateTime(array('required' => false)),
      'ph_kejari_selesai'      => new sfValidatorDateTime(array('required' => false)),
      'ph_kejari_lokasi'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'ph_pn_mulai'            => new sfValidatorDateTime(array('required' => false)),
      'ph_pn_selesai'          => new sfValidatorDateTime(array('required' => false)),
      'ph_pn_lokasi'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'umur'                   => new sfValidatorInteger(array('required' => false)),
      'id_agama'               => new sfValidatorInteger(array('required' => false)),
      'pendidikan'             => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'putusan_tetap'          => new sfValidatorInteger(array('required' => false)),
      'tgl_eksekusi'           => new sfValidatorDateTime(array('required' => false)),
      'putusan_upaya_hukum'    => new sfValidatorInteger(array('required' => false)),
      'tgl_ptsn_bndg_ksasi'    => new sfValidatorDateTime(array('required' => false)),
      'tgl_ptsn_pk_grasi'      => new sfValidatorDateTime(array('required' => false)),
      'tgl_eksekusi_pk_grasi'  => new sfValidatorDateTime(array('required' => false)),
      'pj_pidana_coba_thn'     => new sfValidatorInteger(array('required' => false)),
      'pj_pidana_coba_bln'     => new sfValidatorInteger(array('required' => false)),
      'pj_pidana_coba_hari'    => new sfValidatorInteger(array('required' => false)),
      'idoff'                  => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'rentut_jaksajpu'        => new sfValidatorInteger(array('required' => false)),
      'rentut_kasipidum'       => new sfValidatorInteger(array('required' => false)),
      'rentut_kejari'          => new sfValidatorInteger(array('required' => false)),
      'rentut_kejati'          => new sfValidatorInteger(array('required' => false)),
      'rentut_kejagung'        => new sfValidatorInteger(array('required' => false)),
      'pdn_pengawasan'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_tersangka[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_TERSANGKA';
  }

}

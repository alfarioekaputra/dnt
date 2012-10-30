<?php

/**
 * PDM_PENAHANAN form base class.
 *
 * @method PDM_PENAHANAN getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_PENAHANANForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputText(),
      'id_tersangka'           => new sfWidgetFormInputText(),
      'jpu_idloktahan'         => new sfWidgetFormInputText(),
      'tgljpu_start'           => new sfWidgetFormDateTime(),
      'tgljpu_end'             => new sfWidgetFormDateTime(),
      'hakim_idloktahan'       => new sfWidgetFormInputText(),
      'tglhakim_start'         => new sfWidgetFormDateTime(),
      'tglhakim_end'           => new sfWidgetFormDateTime(),
      'ketuapn_idloktahan'     => new sfWidgetFormInputText(),
      'ketuapn_start'          => new sfWidgetFormDateTime(),
      'ketuapn_end'            => new sfWidgetFormDateTime(),
      'ketuapt_idloktahan'     => new sfWidgetFormInputText(),
      'ketuapt_start'          => new sfWidgetFormDateTime(),
      'ketuapt_end'            => new sfWidgetFormDateTime(),
      'pengalihan_idloktahan'  => new sfWidgetFormInputText(),
      'pengalihan_start'       => new sfWidgetFormDateTime(),
      'pengalihan_end'         => new sfWidgetFormDateTime(),
      'pembataran_idloktahan'  => new sfWidgetFormInputText(),
      'pembataran_start'       => new sfWidgetFormDateTime(),
      'pembataran_end'         => new sfWidgetFormDateTime(),
      'hakim1_idloktahan'      => new sfWidgetFormInputText(),
      'tglhakim1_start'        => new sfWidgetFormDateTime(),
      'tglhakim1_end'          => new sfWidgetFormDateTime(),
      'hakim2_idloktahan'      => new sfWidgetFormInputText(),
      'tglhakim2_start'        => new sfWidgetFormDateTime(),
      'tglhakim2_end'          => new sfWidgetFormDateTime(),
      'sidik_idloktahan'       => new sfWidgetFormInputText(),
      'sidik_start'            => new sfWidgetFormDateTime(),
      'sidik_end'              => new sfWidgetFormDateTime(),
      'sidikkejari_idloktahan' => new sfWidgetFormInputText(),
      'sidikkejari_start'      => new sfWidgetFormDateTime(),
      'sidikkejari_end'        => new sfWidgetFormDateTime(),
      'sidikpn_idloktahan'     => new sfWidgetFormInputText(),
      'sidikpn_start'          => new sfWidgetFormDateTime(),
      'sidikpn_end'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorInteger(),
      'id_tersangka'           => new sfValidatorInteger(array('required' => false)),
      'jpu_idloktahan'         => new sfValidatorInteger(array('required' => false)),
      'tgljpu_start'           => new sfValidatorDateTime(array('required' => false)),
      'tgljpu_end'             => new sfValidatorDateTime(array('required' => false)),
      'hakim_idloktahan'       => new sfValidatorInteger(array('required' => false)),
      'tglhakim_start'         => new sfValidatorDateTime(array('required' => false)),
      'tglhakim_end'           => new sfValidatorDateTime(array('required' => false)),
      'ketuapn_idloktahan'     => new sfValidatorInteger(array('required' => false)),
      'ketuapn_start'          => new sfValidatorDateTime(array('required' => false)),
      'ketuapn_end'            => new sfValidatorDateTime(array('required' => false)),
      'ketuapt_idloktahan'     => new sfValidatorInteger(array('required' => false)),
      'ketuapt_start'          => new sfValidatorDateTime(array('required' => false)),
      'ketuapt_end'            => new sfValidatorDateTime(array('required' => false)),
      'pengalihan_idloktahan'  => new sfValidatorInteger(array('required' => false)),
      'pengalihan_start'       => new sfValidatorDateTime(array('required' => false)),
      'pengalihan_end'         => new sfValidatorDateTime(array('required' => false)),
      'pembataran_idloktahan'  => new sfValidatorInteger(array('required' => false)),
      'pembataran_start'       => new sfValidatorDateTime(array('required' => false)),
      'pembataran_end'         => new sfValidatorDateTime(array('required' => false)),
      'hakim1_idloktahan'      => new sfValidatorInteger(array('required' => false)),
      'tglhakim1_start'        => new sfValidatorDateTime(array('required' => false)),
      'tglhakim1_end'          => new sfValidatorDateTime(array('required' => false)),
      'hakim2_idloktahan'      => new sfValidatorInteger(array('required' => false)),
      'tglhakim2_start'        => new sfValidatorDateTime(array('required' => false)),
      'tglhakim2_end'          => new sfValidatorDateTime(array('required' => false)),
      'sidik_idloktahan'       => new sfValidatorInteger(array('required' => false)),
      'sidik_start'            => new sfValidatorDateTime(array('required' => false)),
      'sidik_end'              => new sfValidatorDateTime(array('required' => false)),
      'sidikkejari_idloktahan' => new sfValidatorInteger(array('required' => false)),
      'sidikkejari_start'      => new sfValidatorDateTime(array('required' => false)),
      'sidikkejari_end'        => new sfValidatorDateTime(array('required' => false)),
      'sidikpn_idloktahan'     => new sfValidatorInteger(array('required' => false)),
      'sidikpn_start'          => new sfValidatorDateTime(array('required' => false)),
      'sidikpn_end'            => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_penahanan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_PENAHANAN';
  }

}

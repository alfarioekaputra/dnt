<?php

/**
 * PDM_BARBUK form base class.
 *
 * @method PDM_BARBUK getObject() Returns the current form's model object
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasePDM_BARBUKForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'id_perkara'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_PERKARA'), 'add_empty' => true)),
      'nama'                      => new sfWidgetFormTextarea(),
      'jumlah'                    => new sfWidgetFormInputText(),
      'pemilik'                   => new sfWidgetFormInputText(),
      'eksekusi'                  => new sfWidgetFormInputText(),
      'id_satuan'                 => new sfWidgetFormInputText(),
      'tgl_eksekusi'              => new sfWidgetFormDateTime(),
      'idoff'                     => new sfWidgetFormInputText(),
      'eksekusi_rentut'           => new sfWidgetFormInputText(),
      'eksekusi_rentut_jaksapu'   => new sfWidgetFormInputText(),
      'eksekusi_rentut_kasipidum' => new sfWidgetFormInputText(),
      'eksekusi_rentut_kejari'    => new sfWidgetFormInputText(),
      'eksekusi_rentut_kejati'    => new sfWidgetFormInputText(),
      'eksekusi_rentut_kejagung'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'id_perkara'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PDM_PERKARA'), 'required' => false)),
      'nama'                      => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'jumlah'                    => new sfValidatorNumber(array('required' => false)),
      'pemilik'                   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'eksekusi'                  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'id_satuan'                 => new sfValidatorInteger(array('required' => false)),
      'tgl_eksekusi'              => new sfValidatorDateTime(array('required' => false)),
      'idoff'                     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'eksekusi_rentut'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'eksekusi_rentut_jaksapu'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'eksekusi_rentut_kasipidum' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'eksekusi_rentut_kejari'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'eksekusi_rentut_kejati'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'eksekusi_rentut_kejagung'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pdm_barbuk[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PDM_BARBUK';
  }

}

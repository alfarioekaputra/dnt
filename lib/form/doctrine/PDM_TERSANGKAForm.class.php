<?php

/**
 * PDM_TERSANGKA form.
 *
 * @package    dnt
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PDM_TERSANGKAForm extends BasePDM_TERSANGKAForm
{
  public function configure()
  {
	$this->setWidget('jkl', new sfWidgetFormChoice(array('choices' => array('0' => '--jenis kelamin--', '1' => 'Laki-laki', '2' => 'Perempuan'))));
	$this->setWidget('id_agama', new sfWidgetFormChoice(array('choices' => array('0' => '--Agama--', '1' => 'Islam', '2' => 'Kristen Protestan', '3' => 'Kristen Katolik', '4' => 'Hindu', '5' => 'Budha'))));
	$this->setWidget('pendidikan',
					 new sfWidgetFormChoice(
						  array('choices' =>
							array('0' => '--Pendidikan--',
								  '1' => 'Tidak Tamat SD',
								  '2' => 'SD / SR',
								  '3' => 'SMP / SLTP',
								  '4' => 'SMA / SLTA',
								  '5' => 'Diploma / Sarjana Muda',
								  '6' => 'Sarjana (S1)',
								  '7' => 'Pascasarjana (S2)',
								  '8' => 'Doktor (S3)',
								  '9' => 'Profesor'
								  )
							)
					  )
					);
	$this->setWidget('alamat', new sfWidgetFormTextArea());
  }
}

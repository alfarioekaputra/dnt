<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDM_BARBUK', 'doctrine');

/**
 * BasePDM_BARBUK
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_perkara
 * @property string $nama
 * @property decimal $jumlah
 * @property string $pemilik
 * @property string $eksekusi
 * @property integer $id_satuan
 * @property timestamp $tgl_eksekusi
 * @property string $idoff
 * @property string $eksekusi_rentut
 * @property string $eksekusi_rentut_jaksapu
 * @property string $eksekusi_rentut_kasipidum
 * @property string $eksekusi_rentut_kejari
 * @property string $eksekusi_rentut_kejati
 * @property string $eksekusi_rentut_kejagung
 * @property PDM_PERKARA $PDM_PERKARA
 * 
 * @method integer     getId()                        Returns the current record's "id" value
 * @method integer     getIdPerkara()                 Returns the current record's "id_perkara" value
 * @method string      getNama()                      Returns the current record's "nama" value
 * @method decimal     getJumlah()                    Returns the current record's "jumlah" value
 * @method string      getPemilik()                   Returns the current record's "pemilik" value
 * @method string      getEksekusi()                  Returns the current record's "eksekusi" value
 * @method integer     getIdSatuan()                  Returns the current record's "id_satuan" value
 * @method timestamp   getTglEksekusi()               Returns the current record's "tgl_eksekusi" value
 * @method string      getIdoff()                     Returns the current record's "idoff" value
 * @method string      getEksekusiRentut()            Returns the current record's "eksekusi_rentut" value
 * @method string      getEksekusiRentutJaksapu()     Returns the current record's "eksekusi_rentut_jaksapu" value
 * @method string      getEksekusiRentutKasipidum()   Returns the current record's "eksekusi_rentut_kasipidum" value
 * @method string      getEksekusiRentutKejari()      Returns the current record's "eksekusi_rentut_kejari" value
 * @method string      getEksekusiRentutKejati()      Returns the current record's "eksekusi_rentut_kejati" value
 * @method string      getEksekusiRentutKejagung()    Returns the current record's "eksekusi_rentut_kejagung" value
 * @method PDM_PERKARA getPDMPERKARA()                Returns the current record's "PDM_PERKARA" value
 * @method PDM_BARBUK  setId()                        Sets the current record's "id" value
 * @method PDM_BARBUK  setIdPerkara()                 Sets the current record's "id_perkara" value
 * @method PDM_BARBUK  setNama()                      Sets the current record's "nama" value
 * @method PDM_BARBUK  setJumlah()                    Sets the current record's "jumlah" value
 * @method PDM_BARBUK  setPemilik()                   Sets the current record's "pemilik" value
 * @method PDM_BARBUK  setEksekusi()                  Sets the current record's "eksekusi" value
 * @method PDM_BARBUK  setIdSatuan()                  Sets the current record's "id_satuan" value
 * @method PDM_BARBUK  setTglEksekusi()               Sets the current record's "tgl_eksekusi" value
 * @method PDM_BARBUK  setIdoff()                     Sets the current record's "idoff" value
 * @method PDM_BARBUK  setEksekusiRentut()            Sets the current record's "eksekusi_rentut" value
 * @method PDM_BARBUK  setEksekusiRentutJaksapu()     Sets the current record's "eksekusi_rentut_jaksapu" value
 * @method PDM_BARBUK  setEksekusiRentutKasipidum()   Sets the current record's "eksekusi_rentut_kasipidum" value
 * @method PDM_BARBUK  setEksekusiRentutKejari()      Sets the current record's "eksekusi_rentut_kejari" value
 * @method PDM_BARBUK  setEksekusiRentutKejati()      Sets the current record's "eksekusi_rentut_kejati" value
 * @method PDM_BARBUK  setEksekusiRentutKejagung()    Sets the current record's "eksekusi_rentut_kejagung" value
 * @method PDM_BARBUK  setPDMPERKARA()                Sets the current record's "PDM_PERKARA" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDM_BARBUK extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDM_BARBUK');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('id_perkara', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('nama', 'string', 500, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 500,
             ));
        $this->hasColumn('jumlah', 'decimal', 11, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 11,
             ));
        $this->hasColumn('pemilik', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('eksekusi', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('id_satuan', 'integer', 4, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('tgl_eksekusi', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('idoff', 'string', 25, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 25,
             ));
        $this->hasColumn('eksekusi_rentut', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('eksekusi_rentut_jaksapu', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('eksekusi_rentut_kasipidum', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('eksekusi_rentut_kejari', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('eksekusi_rentut_kejati', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('eksekusi_rentut_kejagung', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PDM_PERKARA', array(
             'local' => 'id_perkara',
             'foreign' => 'id'));
    }
}
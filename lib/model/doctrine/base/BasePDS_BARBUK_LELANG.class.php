<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDS_BARBUK_LELANG', 'doctrine');

/**
 * BasePDS_BARBUK_LELANG
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_barbuk
 * @property string $no_ba
 * @property timestamp $tgl_lelang
 * @property decimal $taksiran
 * @property decimal $nilai_wajar
 * @property string $penyimpanan
 * @property integer $kondisi
 * @property string $hambatan
 * @property string $usulan
 * @property string $petunjuk
 * @property decimal $hasil_lelang
 * @property string $no_bukti_str
 * @property timestamp $tgl_str
 * @property integer $status
 * @property string $created_by
 * @property string $created_ip
 * @property timestamp $created_time
 * @property string $lastupdate_by
 * @property string $lastupdate_ip
 * @property timestamp $lastupdate_time
 * @property PDS_BARBUK $PDS_BARBUK
 * 
 * @method integer           getId()              Returns the current record's "id" value
 * @method integer           getIdBarbuk()        Returns the current record's "id_barbuk" value
 * @method string            getNoBa()            Returns the current record's "no_ba" value
 * @method timestamp         getTglLelang()       Returns the current record's "tgl_lelang" value
 * @method decimal           getTaksiran()        Returns the current record's "taksiran" value
 * @method decimal           getNilaiWajar()      Returns the current record's "nilai_wajar" value
 * @method string            getPenyimpanan()     Returns the current record's "penyimpanan" value
 * @method integer           getKondisi()         Returns the current record's "kondisi" value
 * @method string            getHambatan()        Returns the current record's "hambatan" value
 * @method string            getUsulan()          Returns the current record's "usulan" value
 * @method string            getPetunjuk()        Returns the current record's "petunjuk" value
 * @method decimal           getHasilLelang()     Returns the current record's "hasil_lelang" value
 * @method string            getNoBuktiStr()      Returns the current record's "no_bukti_str" value
 * @method timestamp         getTglStr()          Returns the current record's "tgl_str" value
 * @method integer           getStatus()          Returns the current record's "status" value
 * @method string            getCreatedBy()       Returns the current record's "created_by" value
 * @method string            getCreatedIp()       Returns the current record's "created_ip" value
 * @method timestamp         getCreatedTime()     Returns the current record's "created_time" value
 * @method string            getLastupdateBy()    Returns the current record's "lastupdate_by" value
 * @method string            getLastupdateIp()    Returns the current record's "lastupdate_ip" value
 * @method timestamp         getLastupdateTime()  Returns the current record's "lastupdate_time" value
 * @method PDS_BARBUK        getPDSBARBUK()       Returns the current record's "PDS_BARBUK" value
 * @method PDS_BARBUK_LELANG setId()              Sets the current record's "id" value
 * @method PDS_BARBUK_LELANG setIdBarbuk()        Sets the current record's "id_barbuk" value
 * @method PDS_BARBUK_LELANG setNoBa()            Sets the current record's "no_ba" value
 * @method PDS_BARBUK_LELANG setTglLelang()       Sets the current record's "tgl_lelang" value
 * @method PDS_BARBUK_LELANG setTaksiran()        Sets the current record's "taksiran" value
 * @method PDS_BARBUK_LELANG setNilaiWajar()      Sets the current record's "nilai_wajar" value
 * @method PDS_BARBUK_LELANG setPenyimpanan()     Sets the current record's "penyimpanan" value
 * @method PDS_BARBUK_LELANG setKondisi()         Sets the current record's "kondisi" value
 * @method PDS_BARBUK_LELANG setHambatan()        Sets the current record's "hambatan" value
 * @method PDS_BARBUK_LELANG setUsulan()          Sets the current record's "usulan" value
 * @method PDS_BARBUK_LELANG setPetunjuk()        Sets the current record's "petunjuk" value
 * @method PDS_BARBUK_LELANG setHasilLelang()     Sets the current record's "hasil_lelang" value
 * @method PDS_BARBUK_LELANG setNoBuktiStr()      Sets the current record's "no_bukti_str" value
 * @method PDS_BARBUK_LELANG setTglStr()          Sets the current record's "tgl_str" value
 * @method PDS_BARBUK_LELANG setStatus()          Sets the current record's "status" value
 * @method PDS_BARBUK_LELANG setCreatedBy()       Sets the current record's "created_by" value
 * @method PDS_BARBUK_LELANG setCreatedIp()       Sets the current record's "created_ip" value
 * @method PDS_BARBUK_LELANG setCreatedTime()     Sets the current record's "created_time" value
 * @method PDS_BARBUK_LELANG setLastupdateBy()    Sets the current record's "lastupdate_by" value
 * @method PDS_BARBUK_LELANG setLastupdateIp()    Sets the current record's "lastupdate_ip" value
 * @method PDS_BARBUK_LELANG setLastupdateTime()  Sets the current record's "lastupdate_time" value
 * @method PDS_BARBUK_LELANG setPDSBARBUK()       Sets the current record's "PDS_BARBUK" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDS_BARBUK_LELANG extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDS_BARBUK_LELANG');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('id_barbuk', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('no_ba', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('tgl_lelang', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('taksiran', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('nilai_wajar', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('penyimpanan', 'string', 100, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 100,
             ));
        $this->hasColumn('kondisi', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('hambatan', 'string', 100, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 100,
             ));
        $this->hasColumn('usulan', 'string', 100, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 100,
             ));
        $this->hasColumn('petunjuk', 'string', 100, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 100,
             ));
        $this->hasColumn('hasil_lelang', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('no_bukti_str', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('tgl_str', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('status', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('created_by', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('created_ip', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('created_time', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('lastupdate_by', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('lastupdate_ip', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('lastupdate_time', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PDS_BARBUK', array(
             'local' => 'id_barbuk',
             'foreign' => 'id'));
    }
}
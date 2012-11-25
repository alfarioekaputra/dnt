<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDS_SETOR_DNT', 'doctrine');

/**
 * BasePDS_SETOR_DNT
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_perkara
 * @property integer $id_tersangka
 * @property decimal $pj_biaya
 * @property decimal $denda
 * @property decimal $hasil_lelang
 * @property decimal $uang_rampasan
 * @property decimal $up_rupiah
 * @property decimal $up_lainnya
 * @property decimal $str_pj_biaya
 * @property decimal $str_denda
 * @property decimal $str_hasil_lelang
 * @property decimal $str_up_rupiah
 * @property decimal $str_up_lainnya
 * @property integer $status
 * @property string $keterangan
 * @property string $created_by
 * @property string $created_ip
 * @property timestamp $created_time
 * @property string $lastupdate_by
 * @property string $lastupdate_ip
 * @property timestamp $lastupdate_time
 * @property PDS_PERKARA $PDS_PERKARA
 * @property PDS_TERSANGKA $PDS_TERSANGKA
 * @property Doctrine_Collection $PDS_DETAIL_STR
 * 
 * @method integer             getId()               Returns the current record's "id" value
 * @method integer             getIdPerkara()        Returns the current record's "id_perkara" value
 * @method integer             getIdTersangka()      Returns the current record's "id_tersangka" value
 * @method decimal             getPjBiaya()          Returns the current record's "pj_biaya" value
 * @method decimal             getDenda()            Returns the current record's "denda" value
 * @method decimal             getHasilLelang()      Returns the current record's "hasil_lelang" value
 * @method decimal             getUangRampasan()     Returns the current record's "uang_rampasan" value
 * @method decimal             getUpRupiah()         Returns the current record's "up_rupiah" value
 * @method decimal             getUpLainnya()        Returns the current record's "up_lainnya" value
 * @method decimal             getStrPjBiaya()       Returns the current record's "str_pj_biaya" value
 * @method decimal             getStrDenda()         Returns the current record's "str_denda" value
 * @method decimal             getStrHasilLelang()   Returns the current record's "str_hasil_lelang" value
 * @method decimal             getStrUpRupiah()      Returns the current record's "str_up_rupiah" value
 * @method decimal             getStrUpLainnya()     Returns the current record's "str_up_lainnya" value
 * @method integer             getStatus()           Returns the current record's "status" value
 * @method string              getKeterangan()       Returns the current record's "keterangan" value
 * @method string              getCreatedBy()        Returns the current record's "created_by" value
 * @method string              getCreatedIp()        Returns the current record's "created_ip" value
 * @method timestamp           getCreatedTime()      Returns the current record's "created_time" value
 * @method string              getLastupdateBy()     Returns the current record's "lastupdate_by" value
 * @method string              getLastupdateIp()     Returns the current record's "lastupdate_ip" value
 * @method timestamp           getLastupdateTime()   Returns the current record's "lastupdate_time" value
 * @method PDS_PERKARA         getPDSPERKARA()       Returns the current record's "PDS_PERKARA" value
 * @method PDS_TERSANGKA       getPDSTERSANGKA()     Returns the current record's "PDS_TERSANGKA" value
 * @method Doctrine_Collection getPDSDETAILSTR()     Returns the current record's "PDS_DETAIL_STR" collection
 * @method PDS_SETOR_DNT       setId()               Sets the current record's "id" value
 * @method PDS_SETOR_DNT       setIdPerkara()        Sets the current record's "id_perkara" value
 * @method PDS_SETOR_DNT       setIdTersangka()      Sets the current record's "id_tersangka" value
 * @method PDS_SETOR_DNT       setPjBiaya()          Sets the current record's "pj_biaya" value
 * @method PDS_SETOR_DNT       setDenda()            Sets the current record's "denda" value
 * @method PDS_SETOR_DNT       setHasilLelang()      Sets the current record's "hasil_lelang" value
 * @method PDS_SETOR_DNT       setUangRampasan()     Sets the current record's "uang_rampasan" value
 * @method PDS_SETOR_DNT       setUpRupiah()         Sets the current record's "up_rupiah" value
 * @method PDS_SETOR_DNT       setUpLainnya()        Sets the current record's "up_lainnya" value
 * @method PDS_SETOR_DNT       setStrPjBiaya()       Sets the current record's "str_pj_biaya" value
 * @method PDS_SETOR_DNT       setStrDenda()         Sets the current record's "str_denda" value
 * @method PDS_SETOR_DNT       setStrHasilLelang()   Sets the current record's "str_hasil_lelang" value
 * @method PDS_SETOR_DNT       setStrUpRupiah()      Sets the current record's "str_up_rupiah" value
 * @method PDS_SETOR_DNT       setStrUpLainnya()     Sets the current record's "str_up_lainnya" value
 * @method PDS_SETOR_DNT       setStatus()           Sets the current record's "status" value
 * @method PDS_SETOR_DNT       setKeterangan()       Sets the current record's "keterangan" value
 * @method PDS_SETOR_DNT       setCreatedBy()        Sets the current record's "created_by" value
 * @method PDS_SETOR_DNT       setCreatedIp()        Sets the current record's "created_ip" value
 * @method PDS_SETOR_DNT       setCreatedTime()      Sets the current record's "created_time" value
 * @method PDS_SETOR_DNT       setLastupdateBy()     Sets the current record's "lastupdate_by" value
 * @method PDS_SETOR_DNT       setLastupdateIp()     Sets the current record's "lastupdate_ip" value
 * @method PDS_SETOR_DNT       setLastupdateTime()   Sets the current record's "lastupdate_time" value
 * @method PDS_SETOR_DNT       setPDSPERKARA()       Sets the current record's "PDS_PERKARA" value
 * @method PDS_SETOR_DNT       setPDSTERSANGKA()     Sets the current record's "PDS_TERSANGKA" value
 * @method PDS_SETOR_DNT       setPDSDETAILSTR()     Sets the current record's "PDS_DETAIL_STR" collection
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDS_SETOR_DNT extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDS_SETOR_DNT');
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
        $this->hasColumn('id_tersangka', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('pj_biaya', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('denda', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('hasil_lelang', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('uang_rampasan', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('up_rupiah', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('up_lainnya', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('str_pj_biaya', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('str_denda', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('str_hasil_lelang', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('str_up_rupiah', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('str_up_lainnya', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('status', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('keterangan', 'string', 100, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 100,
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
        $this->hasOne('PDS_PERKARA', array(
             'local' => 'id_perkara',
             'foreign' => 'id'));

        $this->hasOne('PDS_TERSANGKA', array(
             'local' => 'id_tersangka',
             'foreign' => 'id'));

        $this->hasMany('PDS_DETAIL_STR', array(
             'local' => 'id',
             'foreign' => 'id_str_dnt'));
    }
}
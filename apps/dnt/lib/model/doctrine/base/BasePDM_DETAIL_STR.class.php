<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDM_DETAIL_STR', 'doctrine');

/**
 * BasePDM_DETAIL_STR
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_str_dnt
 * @property string $no_ssbp
 * @property timestamp $tgl_ssbp
 * @property string $no_bukti_str
 * @property timestamp $tgl_str
 * @property decimal $setor
 * @property integer $status
 * @property string $keterangan
 * @property string $created_by
 * @property string $created_ip
 * @property timestamp $created_time
 * @property string $lastupdate_by
 * @property string $lastupdate_ip
 * @property timestamp $lastupdate_time
 * @property PDM_SETOR_DNT $PDM_SETOR_DNT
 * 
 * @method integer        getId()              Returns the current record's "id" value
 * @method integer        getIdStrDnt()        Returns the current record's "id_str_dnt" value
 * @method string         getNoSsbp()          Returns the current record's "no_ssbp" value
 * @method timestamp      getTglSsbp()         Returns the current record's "tgl_ssbp" value
 * @method string         getNoBuktiStr()      Returns the current record's "no_bukti_str" value
 * @method timestamp      getTglStr()          Returns the current record's "tgl_str" value
 * @method decimal        getSetor()           Returns the current record's "setor" value
 * @method integer        getStatus()          Returns the current record's "status" value
 * @method string         getKeterangan()      Returns the current record's "keterangan" value
 * @method string         getCreatedBy()       Returns the current record's "created_by" value
 * @method string         getCreatedIp()       Returns the current record's "created_ip" value
 * @method timestamp      getCreatedTime()     Returns the current record's "created_time" value
 * @method string         getLastupdateBy()    Returns the current record's "lastupdate_by" value
 * @method string         getLastupdateIp()    Returns the current record's "lastupdate_ip" value
 * @method timestamp      getLastupdateTime()  Returns the current record's "lastupdate_time" value
 * @method PDM_SETOR_DNT  getPDMSETORDNT()     Returns the current record's "PDM_SETOR_DNT" value
 * @method PDM_DETAIL_STR setId()              Sets the current record's "id" value
 * @method PDM_DETAIL_STR setIdStrDnt()        Sets the current record's "id_str_dnt" value
 * @method PDM_DETAIL_STR setNoSsbp()          Sets the current record's "no_ssbp" value
 * @method PDM_DETAIL_STR setTglSsbp()         Sets the current record's "tgl_ssbp" value
 * @method PDM_DETAIL_STR setNoBuktiStr()      Sets the current record's "no_bukti_str" value
 * @method PDM_DETAIL_STR setTglStr()          Sets the current record's "tgl_str" value
 * @method PDM_DETAIL_STR setSetor()           Sets the current record's "setor" value
 * @method PDM_DETAIL_STR setStatus()          Sets the current record's "status" value
 * @method PDM_DETAIL_STR setKeterangan()      Sets the current record's "keterangan" value
 * @method PDM_DETAIL_STR setCreatedBy()       Sets the current record's "created_by" value
 * @method PDM_DETAIL_STR setCreatedIp()       Sets the current record's "created_ip" value
 * @method PDM_DETAIL_STR setCreatedTime()     Sets the current record's "created_time" value
 * @method PDM_DETAIL_STR setLastupdateBy()    Sets the current record's "lastupdate_by" value
 * @method PDM_DETAIL_STR setLastupdateIp()    Sets the current record's "lastupdate_ip" value
 * @method PDM_DETAIL_STR setLastupdateTime()  Sets the current record's "lastupdate_time" value
 * @method PDM_DETAIL_STR setPDMSETORDNT()     Sets the current record's "PDM_SETOR_DNT" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDM_DETAIL_STR extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDM_DETAIL_STR');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'PDM_DETAIL_STR',
             'length' => 8,
             ));
        $this->hasColumn('id_str_dnt', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('no_ssbp', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('tgl_ssbp', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
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
        $this->hasColumn('setor', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('sisa', 'decimal', 16, array(
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
        $this->hasOne('PDM_SETOR_DNT', array(
             'local' => 'id_str_dnt',
             'foreign' => 'id'));
    }
}
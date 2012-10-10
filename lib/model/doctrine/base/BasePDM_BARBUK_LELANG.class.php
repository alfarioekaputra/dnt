<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDM_BARBUK_LELANG', 'doctrine');

/**
 * BasePDM_BARBUK_LELANG
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_barbuk
 * @property decimal $taksiran
 * @property decimal $uang_lelang
 * @property string $created_by
 * @property timestamp $created_time
 * @property string $created_ip
 * @property string $lastupdate_by
 * @property timestamp $lastupdate_time
 * @property string $lastupdate_ip
 * 
 * @method integer           getId()              Returns the current record's "id" value
 * @method integer           getIdBarbuk()        Returns the current record's "id_barbuk" value
 * @method decimal           getTaksiran()        Returns the current record's "taksiran" value
 * @method decimal           getUangLelang()      Returns the current record's "uang_lelang" value
 * @method string            getCreatedBy()       Returns the current record's "created_by" value
 * @method timestamp         getCreatedTime()     Returns the current record's "created_time" value
 * @method string            getCreatedIp()       Returns the current record's "created_ip" value
 * @method string            getLastupdateBy()    Returns the current record's "lastupdate_by" value
 * @method timestamp         getLastupdateTime()  Returns the current record's "lastupdate_time" value
 * @method string            getLastupdateIp()    Returns the current record's "lastupdate_ip" value
 * @method PDM_BARBUK_LELANG setId()              Sets the current record's "id" value
 * @method PDM_BARBUK_LELANG setIdBarbuk()        Sets the current record's "id_barbuk" value
 * @method PDM_BARBUK_LELANG setTaksiran()        Sets the current record's "taksiran" value
 * @method PDM_BARBUK_LELANG setUangLelang()      Sets the current record's "uang_lelang" value
 * @method PDM_BARBUK_LELANG setCreatedBy()       Sets the current record's "created_by" value
 * @method PDM_BARBUK_LELANG setCreatedTime()     Sets the current record's "created_time" value
 * @method PDM_BARBUK_LELANG setCreatedIp()       Sets the current record's "created_ip" value
 * @method PDM_BARBUK_LELANG setLastupdateBy()    Sets the current record's "lastupdate_by" value
 * @method PDM_BARBUK_LELANG setLastupdateTime()  Sets the current record's "lastupdate_time" value
 * @method PDM_BARBUK_LELANG setLastupdateIp()    Sets the current record's "lastupdate_ip" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDM_BARBUK_LELANG extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDM_BARBUK_LELANG');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('id_barbuk', 'integer', 8, array(
             'notnull' => true,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('taksiran', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('uang_lelang', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('created_by', 'string', 32, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 32,
             ));
        $this->hasColumn('created_time', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('created_ip', 'string', 15, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 15,
             ));
        $this->hasColumn('lastupdate_by', 'string', 32, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 32,
             ));
        $this->hasColumn('lastupdate_time', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('lastupdate_ip', 'string', 15, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 15,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}
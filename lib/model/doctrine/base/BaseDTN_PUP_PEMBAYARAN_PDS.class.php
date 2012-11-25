<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DTN_PUP_PEMBAYARAN_PDS', 'doctrine');

/**
 * BaseDTN_PUP_PEMBAYARAN_PDS
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_pup
 * @property decimal $bayar_rupiah
 * @property decimal $sisa_rupiah
 * @property decimal $bayar_lainnya
 * @property decimal $sisa_lainnya
 * @property decimal $no_bukti_setor
 * @property timestamp $tgl_bukti_setor
 * @property string $created_by
 * @property string $created_ip
 * @property timestamp $created_time
 * @property string $lastupdate_by
 * @property string $lastupdate_ip
 * @property timestamp $lastupdate_time
 * @property DTN_PUP_PDS $DTN_PUP_PDS
 * 
 * @method integer                getId()              Returns the current record's "id" value
 * @method integer                getIdPup()           Returns the current record's "id_pup" value
 * @method decimal                getBayarRupiah()     Returns the current record's "bayar_rupiah" value
 * @method decimal                getSisaRupiah()      Returns the current record's "sisa_rupiah" value
 * @method decimal                getBayarLainnya()    Returns the current record's "bayar_lainnya" value
 * @method decimal                getSisaLainnya()     Returns the current record's "sisa_lainnya" value
 * @method decimal                getNoBuktiSetor()    Returns the current record's "no_bukti_setor" value
 * @method timestamp              getTglBuktiSetor()   Returns the current record's "tgl_bukti_setor" value
 * @method string                 getCreatedBy()       Returns the current record's "created_by" value
 * @method string                 getCreatedIp()       Returns the current record's "created_ip" value
 * @method timestamp              getCreatedTime()     Returns the current record's "created_time" value
 * @method string                 getLastupdateBy()    Returns the current record's "lastupdate_by" value
 * @method string                 getLastupdateIp()    Returns the current record's "lastupdate_ip" value
 * @method timestamp              getLastupdateTime()  Returns the current record's "lastupdate_time" value
 * @method DTN_PUP_PDS            getDTNPUPPDS()       Returns the current record's "DTN_PUP_PDS" value
 * @method DTN_PUP_PEMBAYARAN_PDS setId()              Sets the current record's "id" value
 * @method DTN_PUP_PEMBAYARAN_PDS setIdPup()           Sets the current record's "id_pup" value
 * @method DTN_PUP_PEMBAYARAN_PDS setBayarRupiah()     Sets the current record's "bayar_rupiah" value
 * @method DTN_PUP_PEMBAYARAN_PDS setSisaRupiah()      Sets the current record's "sisa_rupiah" value
 * @method DTN_PUP_PEMBAYARAN_PDS setBayarLainnya()    Sets the current record's "bayar_lainnya" value
 * @method DTN_PUP_PEMBAYARAN_PDS setSisaLainnya()     Sets the current record's "sisa_lainnya" value
 * @method DTN_PUP_PEMBAYARAN_PDS setNoBuktiSetor()    Sets the current record's "no_bukti_setor" value
 * @method DTN_PUP_PEMBAYARAN_PDS setTglBuktiSetor()   Sets the current record's "tgl_bukti_setor" value
 * @method DTN_PUP_PEMBAYARAN_PDS setCreatedBy()       Sets the current record's "created_by" value
 * @method DTN_PUP_PEMBAYARAN_PDS setCreatedIp()       Sets the current record's "created_ip" value
 * @method DTN_PUP_PEMBAYARAN_PDS setCreatedTime()     Sets the current record's "created_time" value
 * @method DTN_PUP_PEMBAYARAN_PDS setLastupdateBy()    Sets the current record's "lastupdate_by" value
 * @method DTN_PUP_PEMBAYARAN_PDS setLastupdateIp()    Sets the current record's "lastupdate_ip" value
 * @method DTN_PUP_PEMBAYARAN_PDS setLastupdateTime()  Sets the current record's "lastupdate_time" value
 * @method DTN_PUP_PEMBAYARAN_PDS setDTNPUPPDS()       Sets the current record's "DTN_PUP_PDS" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDTN_PUP_PEMBAYARAN_PDS extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('DTN_PUP_PEMBAYARAN_PDS');
        $this->hasColumn('id', 'integer', 10, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'sequence' => 'DTN_PUP_PEMBAYARAN_PDS',
             'length' => 10,
             ));
        $this->hasColumn('id_pup', 'integer', 10, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 10,
             ));
        $this->hasColumn('bayar_rupiah', 'decimal', 20, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('sisa_rupiah', 'decimal', 20, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('bayar_lainnya', 'decimal', 20, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('sisa_lainnya', 'decimal', 20, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('no_bukti_setor', 'decimal', 20, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('tgl_bukti_setor', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('created_by', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
        $this->hasColumn('created_ip', 'string', 20, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
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
        $this->hasOne('DTN_PUP_PDS', array(
             'local' => 'id_pup',
             'foreign' => 'id'));
    }
}
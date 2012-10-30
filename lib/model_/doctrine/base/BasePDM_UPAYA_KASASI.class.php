<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDM_UPAYA_KASASI', 'doctrine');

/**
 * BasePDM_UPAYA_KASASI
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $no_akta
 * @property timestamp $tgl_akta
 * @property string $no_memori
 * @property timestamp $tgl_memori
 * @property string $isi_memori
 * @property string $no_putusan
 * @property timestamp $tgl_putusan
 * @property string $isi_putusan
 * @property integer $id_tersangka
 * @property integer $jenis_putusan
 * @property string $pj_pidana_coba
 * @property string $pj_masa_coba
 * @property integer $pj_badan_tahun
 * @property integer $pj_badan_bulan
 * @property integer $pj_badan_hari
 * @property decimal $pj_denda_rp
 * @property integer $pj_sub_tahun
 * @property integer $pj_sub_bulan
 * @property integer $pj_sub_hari
 * @property decimal $pj_biaya
 * @property integer $kurungan_tahun
 * @property integer $kurungan_bulan
 * @property integer $kurungan_hari
 * @property decimal $denda
 * @property string $putusan_tambahan
 * @property integer $sikap_jaksa
 * @property integer $sikap_terdakwa
 * @property integer $pj_pidana_coba_thn
 * @property integer $pj_pidana_coba_bln
 * @property integer $pj_pidana_coba_hari
 * @property string $idoff
 * @property PDM_TERSANGKA $PDM_TERSANGKA
 * @property Doctrine_Collection $PDM_PASAL_KASASI
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method string              getNoAkta()              Returns the current record's "no_akta" value
 * @method timestamp           getTglAkta()             Returns the current record's "tgl_akta" value
 * @method string              getNoMemori()            Returns the current record's "no_memori" value
 * @method timestamp           getTglMemori()           Returns the current record's "tgl_memori" value
 * @method string              getIsiMemori()           Returns the current record's "isi_memori" value
 * @method string              getNoPutusan()           Returns the current record's "no_putusan" value
 * @method timestamp           getTglPutusan()          Returns the current record's "tgl_putusan" value
 * @method string              getIsiPutusan()          Returns the current record's "isi_putusan" value
 * @method integer             getIdTersangka()         Returns the current record's "id_tersangka" value
 * @method integer             getJenisPutusan()        Returns the current record's "jenis_putusan" value
 * @method string              getPjPidanaCoba()        Returns the current record's "pj_pidana_coba" value
 * @method string              getPjMasaCoba()          Returns the current record's "pj_masa_coba" value
 * @method integer             getPjBadanTahun()        Returns the current record's "pj_badan_tahun" value
 * @method integer             getPjBadanBulan()        Returns the current record's "pj_badan_bulan" value
 * @method integer             getPjBadanHari()         Returns the current record's "pj_badan_hari" value
 * @method decimal             getPjDendaRp()           Returns the current record's "pj_denda_rp" value
 * @method integer             getPjSubTahun()          Returns the current record's "pj_sub_tahun" value
 * @method integer             getPjSubBulan()          Returns the current record's "pj_sub_bulan" value
 * @method integer             getPjSubHari()           Returns the current record's "pj_sub_hari" value
 * @method decimal             getPjBiaya()             Returns the current record's "pj_biaya" value
 * @method integer             getKurunganTahun()       Returns the current record's "kurungan_tahun" value
 * @method integer             getKurunganBulan()       Returns the current record's "kurungan_bulan" value
 * @method integer             getKurunganHari()        Returns the current record's "kurungan_hari" value
 * @method decimal             getDenda()               Returns the current record's "denda" value
 * @method string              getPutusanTambahan()     Returns the current record's "putusan_tambahan" value
 * @method integer             getSikapJaksa()          Returns the current record's "sikap_jaksa" value
 * @method integer             getSikapTerdakwa()       Returns the current record's "sikap_terdakwa" value
 * @method integer             getPjPidanaCobaThn()     Returns the current record's "pj_pidana_coba_thn" value
 * @method integer             getPjPidanaCobaBln()     Returns the current record's "pj_pidana_coba_bln" value
 * @method integer             getPjPidanaCobaHari()    Returns the current record's "pj_pidana_coba_hari" value
 * @method string              getIdoff()               Returns the current record's "idoff" value
 * @method PDM_TERSANGKA       getPDMTERSANGKA()        Returns the current record's "PDM_TERSANGKA" value
 * @method Doctrine_Collection getPDMPASALKASASI()      Returns the current record's "PDM_PASAL_KASASI" collection
 * @method PDM_UPAYA_KASASI    setId()                  Sets the current record's "id" value
 * @method PDM_UPAYA_KASASI    setNoAkta()              Sets the current record's "no_akta" value
 * @method PDM_UPAYA_KASASI    setTglAkta()             Sets the current record's "tgl_akta" value
 * @method PDM_UPAYA_KASASI    setNoMemori()            Sets the current record's "no_memori" value
 * @method PDM_UPAYA_KASASI    setTglMemori()           Sets the current record's "tgl_memori" value
 * @method PDM_UPAYA_KASASI    setIsiMemori()           Sets the current record's "isi_memori" value
 * @method PDM_UPAYA_KASASI    setNoPutusan()           Sets the current record's "no_putusan" value
 * @method PDM_UPAYA_KASASI    setTglPutusan()          Sets the current record's "tgl_putusan" value
 * @method PDM_UPAYA_KASASI    setIsiPutusan()          Sets the current record's "isi_putusan" value
 * @method PDM_UPAYA_KASASI    setIdTersangka()         Sets the current record's "id_tersangka" value
 * @method PDM_UPAYA_KASASI    setJenisPutusan()        Sets the current record's "jenis_putusan" value
 * @method PDM_UPAYA_KASASI    setPjPidanaCoba()        Sets the current record's "pj_pidana_coba" value
 * @method PDM_UPAYA_KASASI    setPjMasaCoba()          Sets the current record's "pj_masa_coba" value
 * @method PDM_UPAYA_KASASI    setPjBadanTahun()        Sets the current record's "pj_badan_tahun" value
 * @method PDM_UPAYA_KASASI    setPjBadanBulan()        Sets the current record's "pj_badan_bulan" value
 * @method PDM_UPAYA_KASASI    setPjBadanHari()         Sets the current record's "pj_badan_hari" value
 * @method PDM_UPAYA_KASASI    setPjDendaRp()           Sets the current record's "pj_denda_rp" value
 * @method PDM_UPAYA_KASASI    setPjSubTahun()          Sets the current record's "pj_sub_tahun" value
 * @method PDM_UPAYA_KASASI    setPjSubBulan()          Sets the current record's "pj_sub_bulan" value
 * @method PDM_UPAYA_KASASI    setPjSubHari()           Sets the current record's "pj_sub_hari" value
 * @method PDM_UPAYA_KASASI    setPjBiaya()             Sets the current record's "pj_biaya" value
 * @method PDM_UPAYA_KASASI    setKurunganTahun()       Sets the current record's "kurungan_tahun" value
 * @method PDM_UPAYA_KASASI    setKurunganBulan()       Sets the current record's "kurungan_bulan" value
 * @method PDM_UPAYA_KASASI    setKurunganHari()        Sets the current record's "kurungan_hari" value
 * @method PDM_UPAYA_KASASI    setDenda()               Sets the current record's "denda" value
 * @method PDM_UPAYA_KASASI    setPutusanTambahan()     Sets the current record's "putusan_tambahan" value
 * @method PDM_UPAYA_KASASI    setSikapJaksa()          Sets the current record's "sikap_jaksa" value
 * @method PDM_UPAYA_KASASI    setSikapTerdakwa()       Sets the current record's "sikap_terdakwa" value
 * @method PDM_UPAYA_KASASI    setPjPidanaCobaThn()     Sets the current record's "pj_pidana_coba_thn" value
 * @method PDM_UPAYA_KASASI    setPjPidanaCobaBln()     Sets the current record's "pj_pidana_coba_bln" value
 * @method PDM_UPAYA_KASASI    setPjPidanaCobaHari()    Sets the current record's "pj_pidana_coba_hari" value
 * @method PDM_UPAYA_KASASI    setIdoff()               Sets the current record's "idoff" value
 * @method PDM_UPAYA_KASASI    setPDMTERSANGKA()        Sets the current record's "PDM_TERSANGKA" value
 * @method PDM_UPAYA_KASASI    setPDMPASALKASASI()      Sets the current record's "PDM_PASAL_KASASI" collection
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDM_UPAYA_KASASI extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDM_UPAYA_KASASI');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('no_akta', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('tgl_akta', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('no_memori', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('tgl_memori', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('isi_memori', 'string', 1000, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1000,
             ));
        $this->hasColumn('no_putusan', 'string', 50, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 50,
             ));
        $this->hasColumn('tgl_putusan', 'timestamp', 7, array(
             'notnull' => false,
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 7,
             ));
        $this->hasColumn('isi_putusan', 'string', 1000, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1000,
             ));
        $this->hasColumn('id_tersangka', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('jenis_putusan', 'integer', 1, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('pj_pidana_coba', 'string', 20, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('pj_masa_coba', 'string', 20, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 20,
             ));
        $this->hasColumn('pj_badan_tahun', 'integer', 4, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pj_badan_bulan', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('pj_badan_hari', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('pj_denda_rp', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('pj_sub_tahun', 'integer', 4, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pj_sub_bulan', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('pj_sub_hari', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('pj_biaya', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('kurungan_tahun', 'integer', 4, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('kurungan_bulan', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('kurungan_hari', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('denda', 'decimal', 16, array(
             'notnull' => false,
             'type' => 'decimal',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 16,
             ));
        $this->hasColumn('putusan_tambahan', 'string', 1000, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1000,
             ));
        $this->hasColumn('sikap_jaksa', 'integer', 1, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('sikap_terdakwa', 'integer', 1, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('pj_pidana_coba_thn', 'integer', 4, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 4,
             ));
        $this->hasColumn('pj_pidana_coba_bln', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('pj_pidana_coba_hari', 'integer', 2, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 2,
             ));
        $this->hasColumn('idoff', 'string', 25, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('PDM_TERSANGKA', array(
             'local' => 'id_tersangka',
             'foreign' => 'id'));

        $this->hasMany('PDM_PASAL_KASASI', array(
             'local' => 'id',
             'foreign' => 'id_kasasi'));
    }
}
<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDM_PASAL_BANDING', 'doctrine');

/**
 * BasePDM_PASAL_BANDING
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_banding
 * @property string $pasal
 * @property integer $terbukti
 * @property string $idoff
 * @property PDM_UPAYA_BANDING $PDM_UPAYA_BANDING
 * 
 * @method integer           getId()                Returns the current record's "id" value
 * @method integer           getIdBanding()         Returns the current record's "id_banding" value
 * @method string            getPasal()             Returns the current record's "pasal" value
 * @method integer           getTerbukti()          Returns the current record's "terbukti" value
 * @method string            getIdoff()             Returns the current record's "idoff" value
 * @method PDM_UPAYA_BANDING getPDMUPAYABANDING()   Returns the current record's "PDM_UPAYA_BANDING" value
 * @method PDM_PASAL_BANDING setId()                Sets the current record's "id" value
 * @method PDM_PASAL_BANDING setIdBanding()         Sets the current record's "id_banding" value
 * @method PDM_PASAL_BANDING setPasal()             Sets the current record's "pasal" value
 * @method PDM_PASAL_BANDING setTerbukti()          Sets the current record's "terbukti" value
 * @method PDM_PASAL_BANDING setIdoff()             Sets the current record's "idoff" value
 * @method PDM_PASAL_BANDING setPDMUPAYABANDING()   Sets the current record's "PDM_UPAYA_BANDING" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDM_PASAL_BANDING extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDM_PASAL_BANDING');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('id_banding', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
        $this->hasColumn('pasal', 'string', 500, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 500,
             ));
        $this->hasColumn('terbukti', 'integer', 1, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1,
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
        $this->hasOne('PDM_UPAYA_BANDING', array(
             'local' => 'id_banding',
             'foreign' => 'id'));
    }
}
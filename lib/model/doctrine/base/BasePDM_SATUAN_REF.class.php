<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDM_SATUAN_REF', 'doctrine');

/**
 * BasePDM_SATUAN_REF
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $satuan
 * 
 * @method integer        getId()     Returns the current record's "id" value
 * @method string         getSatuan() Returns the current record's "satuan" value
 * @method PDM_SATUAN_REF setId()     Sets the current record's "id" value
 * @method PDM_SATUAN_REF setSatuan() Sets the current record's "satuan" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDM_SATUAN_REF extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDM_SATUAN_REF');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 4,
             ));
        $this->hasColumn('satuan', 'string', 30, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 30,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}
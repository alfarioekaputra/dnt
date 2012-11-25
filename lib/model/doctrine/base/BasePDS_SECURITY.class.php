<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDS_SECURITY', 'doctrine');

/**
 * BasePDS_SECURITY
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $u_id
 * @property integer $id_pdsmjnspidana
 * 
 * @method integer      getId()               Returns the current record's "id" value
 * @method string       getUId()              Returns the current record's "u_id" value
 * @method integer      getIdPdsmjnspidana()  Returns the current record's "id_pdsmjnspidana" value
 * @method PDS_SECURITY setId()               Sets the current record's "id" value
 * @method PDS_SECURITY setUId()              Sets the current record's "u_id" value
 * @method PDS_SECURITY setIdPdsmjnspidana()  Sets the current record's "id_pdsmjnspidana" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDS_SECURITY extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDS_SECURITY');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('u_id', 'string', 32, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 32,
             ));
        $this->hasColumn('id_pdsmjnspidana', 'integer', 8, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 8,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}
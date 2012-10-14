<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('MS_JNSKELAMIN', 'doctrine');

/**
 * BaseMS_JNSKELAMIN
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $nama
 * @property Doctrine_Collection $PDM_TERSANGKA
 * 
 * @method integer             getId()            Returns the current record's "id" value
 * @method string              getNama()          Returns the current record's "nama" value
 * @method Doctrine_Collection getPDMTERSANGKA()  Returns the current record's "PDM_TERSANGKA" collection
 * @method MS_JNSKELAMIN       setId()            Sets the current record's "id" value
 * @method MS_JNSKELAMIN       setNama()          Sets the current record's "nama" value
 * @method MS_JNSKELAMIN       setPDMTERSANGKA()  Sets the current record's "PDM_TERSANGKA" collection
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMS_JNSKELAMIN extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('MS_JNSKELAMIN');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'length' => 8,
             ));
        $this->hasColumn('nama', 'string', 50, array(
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
        $this->hasMany('PDM_TERSANGKA', array(
             'local' => 'id',
             'foreign' => 'jkl'));
    }
}
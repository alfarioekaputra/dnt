<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PDM_PASAL', 'doctrine');

/**
 * BasePDM_PASAL
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $id_tersangka
 * @property string $pasal
 * @property integer $disangkakan
 * @property integer $didakwakan
 * @property integer $terbukti
 * @property string $idoff
 * @property PDM_TERSANGKA $PDM_TERSANGKA
 * 
 * @method integer       getId()            Returns the current record's "id" value
 * @method integer       getIdTersangka()   Returns the current record's "id_tersangka" value
 * @method string        getPasal()         Returns the current record's "pasal" value
 * @method integer       getDisangkakan()   Returns the current record's "disangkakan" value
 * @method integer       getDidakwakan()    Returns the current record's "didakwakan" value
 * @method integer       getTerbukti()      Returns the current record's "terbukti" value
 * @method string        getIdoff()         Returns the current record's "idoff" value
 * @method PDM_TERSANGKA getPDMTERSANGKA()  Returns the current record's "PDM_TERSANGKA" value
 * @method PDM_PASAL     setId()            Sets the current record's "id" value
 * @method PDM_PASAL     setIdTersangka()   Sets the current record's "id_tersangka" value
 * @method PDM_PASAL     setPasal()         Sets the current record's "pasal" value
 * @method PDM_PASAL     setDisangkakan()   Sets the current record's "disangkakan" value
 * @method PDM_PASAL     setDidakwakan()    Sets the current record's "didakwakan" value
 * @method PDM_PASAL     setTerbukti()      Sets the current record's "terbukti" value
 * @method PDM_PASAL     setIdoff()         Sets the current record's "idoff" value
 * @method PDM_PASAL     setPDMTERSANGKA()  Sets the current record's "PDM_TERSANGKA" value
 * 
 * @package    dnt
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePDM_PASAL extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('PDM_PASAL');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
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
        $this->hasColumn('pasal', 'string', 500, array(
             'notnull' => false,
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 500,
             ));
        $this->hasColumn('disangkakan', 'integer', 1, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1,
             ));
        $this->hasColumn('didakwakan', 'integer', 1, array(
             'notnull' => false,
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'length' => 1,
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
        $this->hasOne('PDM_TERSANGKA', array(
             'local' => 'id_tersangka',
             'foreign' => 'id'));
    }
}
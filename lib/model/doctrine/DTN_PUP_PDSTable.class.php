<?php


class DTN_PUP_PDSTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DTN_PUP_PDS');
    }
}
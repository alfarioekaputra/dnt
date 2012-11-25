<?php


class PDS_SITATable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_SITA');
    }
}
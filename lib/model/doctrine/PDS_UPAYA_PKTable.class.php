<?php


class PDS_UPAYA_PKTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_UPAYA_PK');
    }
}
<?php


class PDS_RENTUTTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_RENTUT');
    }
}
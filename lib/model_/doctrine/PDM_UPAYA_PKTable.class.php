<?php


class PDM_UPAYA_PKTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_UPAYA_PK');
    }
}
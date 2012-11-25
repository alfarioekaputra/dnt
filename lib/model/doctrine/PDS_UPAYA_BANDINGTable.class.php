<?php


class PDS_UPAYA_BANDINGTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_UPAYA_BANDING');
    }
}
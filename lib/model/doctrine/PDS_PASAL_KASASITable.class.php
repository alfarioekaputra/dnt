<?php


class PDS_PASAL_KASASITable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_PASAL_KASASI');
    }
}
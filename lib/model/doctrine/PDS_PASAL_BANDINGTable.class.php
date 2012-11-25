<?php


class PDS_PASAL_BANDINGTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_PASAL_BANDING');
    }
}
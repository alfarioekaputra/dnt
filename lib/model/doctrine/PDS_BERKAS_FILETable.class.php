<?php


class PDS_BERKAS_FILETable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_BERKAS_FILE');
    }
}
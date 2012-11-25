<?php


class PDS_BERKASTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_BERKAS');
    }
}
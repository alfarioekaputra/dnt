<?php


class PDS_SATUAN_REFTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_SATUAN_REF');
    }
}
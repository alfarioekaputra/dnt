<?php


class PDM_SATUAN_REFTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_SATUAN_REF');
    }
}
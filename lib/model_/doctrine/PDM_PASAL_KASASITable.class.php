<?php


class PDM_PASAL_KASASITable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_PASAL_KASASI');
    }
}
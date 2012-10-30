<?php


class PDM_UPAYA_KASASITable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_UPAYA_KASASI');
    }
}
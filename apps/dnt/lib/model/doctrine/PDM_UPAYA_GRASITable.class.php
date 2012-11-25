<?php


class PDM_UPAYA_GRASITable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_UPAYA_GRASI');
    }
}
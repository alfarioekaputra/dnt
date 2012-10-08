<?php


class PDM_PERKARATable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_PERKARA');
    }
}
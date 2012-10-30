<?php


class PDM_SETOR_DNTTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_SETOR_DNT');
    }
}
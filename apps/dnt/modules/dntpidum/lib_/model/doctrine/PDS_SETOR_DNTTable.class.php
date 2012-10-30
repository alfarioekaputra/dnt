<?php


class PDS_SETOR_DNTTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_SETOR_DNT');
    }
}
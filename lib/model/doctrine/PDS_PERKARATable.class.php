<?php


class PDS_PERKARATable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_PERKARA');
    }
}
<?php


class PDS_PASALTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_PASAL');
    }
}
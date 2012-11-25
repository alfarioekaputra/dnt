<?php


class PDS_PENAHANANTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_PENAHANAN');
    }
}
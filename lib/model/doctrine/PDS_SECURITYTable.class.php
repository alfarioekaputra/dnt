<?php


class PDS_SECURITYTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_SECURITY');
    }
}
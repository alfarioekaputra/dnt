<?php


class PDS_DETAIL_STRTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_DETAIL_STR');
    }
}
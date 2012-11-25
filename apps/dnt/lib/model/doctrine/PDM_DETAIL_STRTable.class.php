<?php


class PDM_DETAIL_STRTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_DETAIL_STR');
    }
}
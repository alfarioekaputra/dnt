<?php


class PDS_PK_TING_REFTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_PK_TING_REF');
    }
}
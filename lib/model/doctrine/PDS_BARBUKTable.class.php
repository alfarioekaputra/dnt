<?php


class PDS_BARBUKTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_BARBUK');
    }
}
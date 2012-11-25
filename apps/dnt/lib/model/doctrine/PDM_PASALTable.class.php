<?php


class PDM_PASALTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_PASAL');
    }
}
<?php


class PDM_PENAHANANTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_PENAHANAN');
    }
}
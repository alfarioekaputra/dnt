<?php


class PDM_TERSANGKATable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_TERSANGKA');
    }
}
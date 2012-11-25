<?php


class PDS_TERSANGKATable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_TERSANGKA');
    }
}
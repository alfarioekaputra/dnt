<?php


class MS_AGAMATable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MS_AGAMA');
    }
}
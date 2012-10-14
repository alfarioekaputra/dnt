<?php


class MS_PENDIDIKANTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MS_PENDIDIKAN');
    }
}
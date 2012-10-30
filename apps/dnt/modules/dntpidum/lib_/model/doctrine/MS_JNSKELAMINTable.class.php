<?php


class MS_JNSKELAMINTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('MS_JNSKELAMIN');
    }
}
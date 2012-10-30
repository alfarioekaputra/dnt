<?php


class PDS_BARBUK_LELANGTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_BARBUK_LELANG');
    }
}
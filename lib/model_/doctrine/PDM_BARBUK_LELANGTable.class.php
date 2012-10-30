<?php


class PDM_BARBUK_LELANGTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDM_BARBUK_LELANG');
    }
}
<?php


class DTN_PUP_PEMBAYARAN_PDSTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DTN_PUP_PEMBAYARAN_PDS');
    }
}
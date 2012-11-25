<?php


class PDS_EKS_MATITable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_EKS_MATI');
    }
}
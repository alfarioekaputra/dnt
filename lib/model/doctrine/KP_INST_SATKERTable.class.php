<?php


class KP_INST_SATKERTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('KP_INST_SATKER');
    }
}
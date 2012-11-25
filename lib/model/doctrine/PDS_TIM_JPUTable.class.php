<?php


class PDS_TIM_JPUTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PDS_TIM_JPU');
    }
}
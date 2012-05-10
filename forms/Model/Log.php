<?php

class History_Form_Model_Log extends Centurion_Form_Model_Abstract
{
    protected $_modelClassName = 'History_Model_DbTable_Log';

    public function __construct($options = array (), Centurion_Db_Table_Row_Abstract $instance = null)
    {
        $this->_exclude = array('id', 'created_at', 'updated_at');

        $this->_elementLabels = array(
            'name' => $this->_translate('Name'),
        );

        parent::__construct($options, $instance);
    }
}


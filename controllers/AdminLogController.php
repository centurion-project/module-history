<?php

class History_AdminLogController extends Centurion_Controller_CRUD
{
    protected $_formClassName = 'History_Form_Model_Log';

    protected $_useTicket = false;

    public function preDispatch()
    {
        $this->_helper->authCheck('/admin/login');
        $this->_helper->aclCheck();

        $this->_helper->layout->setLayout('admin');

        parent::preDispatch();
    }

    public function init()
    {
        $this->view->noAddButton = true;

        $this->_displays = array (
        );

        $this->_filters = array (
        );

        $this->view->placeholder('headling_1_content')->set($this->view->translate('Manage wall'));
        $this->view->placeholder('headling_1_add_button')->set($this->view->translate('wall'));

        parent::init();
    }
}


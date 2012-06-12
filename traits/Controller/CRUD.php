<?php

class History_Traits_Controller_CRUD extends Translation_Traits_Controller
{
    public function restoreAction()
    {
        $logRow = Centurion_Db::getSingleton('history/log')->findOneBy('id', $this->_controller->getRequest()->getParam('restoreId'));

        $data = unserialize($logRow->value);

        $this->_controller->getForm()->populate($data);

        $this->view->infos = array();
        $this->view->infos[] = $this->view->translate('You are currently seeing an old version of this row. <br />
                                                If you want to restore it, click on save.<br /> Date: %s', $logRow->getDateObjectBy('created_at')->toString(Zend_Date::DATETIME_MEDIUM), $logRow->name);

        $this->getAction();
    }

    public function _preRenderForm()
    {
        $this->view->formViewScript[] = $this->_formViewScript;
        $this->_controller->_formViewScript = 'history/form.phtml';
    }
}

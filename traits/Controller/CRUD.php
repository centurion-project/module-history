<?php
class History_Traits_Controller_CRUD extends Translation_Traits_Controller
{
    public function restoreAction()
    {
        $logRow = Centurion_Db::getSingleton('history/log')->findOneBy('id', $this->_controller->getRequest()->getParam('restoreId'));


        $data = unserialize($logRow->value);

        $this->_controller->getForm()->populate($data);

        $this->getAction();
    }

    public function _preRenderForm()
    {
        $this->view->formViewScript = $this->_formViewScript;
        $this->_controller->_formViewScript = 'history/form.phtml';
    }
}

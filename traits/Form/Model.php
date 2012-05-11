<?php
class History_Traits_Form_Model extends Centurion_Traits_Form_Model_Abstract
{
    public function init()
    {
        Centurion_Signal::factory('pre_generate')->connect(array($this, 'preGenerate'), $this->_form);
        Centurion_Signal::factory('on_populate_with_instance')->connect(array($this, 'populateWithInstance'), $this->_form);
        Centurion_Signal::factory('on_form_get_toolbar')->connect(array($this, 'onFormGetToolbar'), $this->_form);
    }

    public function onFormGetToolbar()
    {
    }

    public function preGenerate()
    {

    }

    public function populateWithInstance()
    {
        $this->_form->addElement('info', 'history');

        $row = $this->_form->getInstance();
        $id = $row->id;
        $contentTypeId = $row->getContentTypeId();

        $versionRowSet = Centurion_Db::getSingleton('history/log')->select(true)
            ->filter(
                array(
                     'proxy_pk' => $id,
                     'proxy_id' => $contentTypeId,
                )
            )
            ->order('created_at desc')->fetchAll();


        $str = '<ul>';

        $view = $this->_form->getView();

        $link = $view->url(array('action' => 'get', 'restoreId' => null));
        $str .= '<li><a href="' . $link . '">Original</a><br /><br /></li>';

        foreach ($versionRowSet as $version) {
            $link = $view->url(array('action' => 'restore', 'restoreId' => $version->id));
            $linkRemove = $view->url(array('module' => 'history', 'controller' => 'admin-log','action' => 'delete', 'id' => $version->id, '_next' => $view->url()));

            $linkEdit = $view->url(array('module' => 'history', 'controller' => 'admin-log', 'action' => 'get', 'id' => $version->id, '_next' => $view->url()));


            $name = $version->name;

            if ('' == trim($version->name)) {
                $name = $version->getDateObjectBy('created_at');
            }
            $str .= '<li><a href="' . $link . '">' . $name . '</a>';
            $str .= ' - (<a href="' . $linkEdit . '">E</a>) - ';
            $str .= ' (<a href="' . $linkRemove . '">X</a>)</li>';
        }

        $str .= '</ul>';

        $historyElement = $this->_form->getElement('history');

        $historyElement->setValue($str);
        $historyElement->setAttrib('escape', false);
        $historyElement->removeDecorator('Label');
        $historyElement->removeDecorator('Description');
    }
}

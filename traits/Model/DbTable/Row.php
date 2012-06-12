<?php
class History_Traits_Model_DbTable_Row extends Centurion_Traits_Model_DbTable_Row_Abstract
{
    public function init()
    {
        Centurion_Signal::factory('pre_save')->connect(array($this, 'preSave'), $this->_row);
    }

    /**
     * @param $signal
     * @param $row Centurion_Db_Table_Row_Abstract
     */
    public function preSave($signal, $row)
    {
        if ($row->id !== $this->_row->id) {
            throw new Centurion_Signal_Exception('This should never happend');
        }

        //If it's a new row, we have not old version to store
        if ($row->isNew()) {
            return;
        }
        $data = serialize($row->getCleanData());

        $logRow = Centurion_Db::getSingleton('history/log')->createRow();

        $logRow->proxy_id = $row->getContentTypeId();
        $logRow->proxy_pk = $row->id;

        //TODO: maybe we could compress data in DB to avoid big memory and big table.
        $logRow->value = $data;
        $logRow->created_at = new Zend_Db_Expr('NOW()');
        $logRow->name = '';
        $logRow->save();
    }
}

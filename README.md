Module History for Centurion Framework

# Description

This module store all modifications of a row, and allow to restore an old version.

# How to use it

You must implement the following trait for each model that you want to be versionned:

* History_Traits_Controller_CRUD_Interface
* History_Traits_Form_Model_Interface
* History_Traits_Model_DbTable_Interface
* History_Traits_Model_DbTable_Row_Interface

# How to show/restore

Edit your row, at the right you will see the different version of this row.
You can add tag to version if you want to find one quickly or delete some.

# TODO

* add test unit
* add pagination in version
* maybe allow mass delete with checkbox
* restore ticket to protect version
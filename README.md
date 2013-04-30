Simple CodeIgniter Layout Libray
================

To start using simply copy file to your application/libraries/ folder and load it. 

You can use it in controller like $this->layout->load(view_name, view_data, head_data, bottom_data);. Only the first parameter is required.

If needed, can set custom data before $this->layout->load method:

  * $this->layout->setDocumentHead('head') - sets head.php as head from /application/view
  * $this->layout->setHeadData(array('title' => 'Site Title')) - sets $title in head.php file
  * $this->layout->setGlobalData(array('some_var' => 'Some value') - now you can use $some_var in all views
  * $this->layout->setBeforeContent(array('header', 'top_nav' => array('some_var' => 'Some value')) - load custom views with data
  * $this->layout->setAfterContent('modal') - load one view

P.S.
In future will all load from files.

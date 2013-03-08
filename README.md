Simple CodeIgniter Layout Libray
================

To start using simply copy file to yours application/libraries/ folder. 

You can use it in controller like $this->layout->load(view_name, view_data, head_data, bottom_data);. Only the first parameter is required.

If needed, can set custom data before load method:

  * $this->layout->setDocumentHead('head'); sets head.php as head from /application/view
  * $this->layout->setHeadData(array('title' => 'Site Title')); sets $title in head file

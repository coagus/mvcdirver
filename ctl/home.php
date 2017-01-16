<?php
require_once __DIR__ . '/../lib/vcl/controller.php';

class HomeController extends Controller {
  public $error = '';

  public function __CONSTRUCT($action = 'index') {
    parent::__construct('home', $action);
  }

  public function index() {
    $this->view();
  }
}
?>

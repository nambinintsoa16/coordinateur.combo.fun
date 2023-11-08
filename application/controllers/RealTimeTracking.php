<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RealTimeTracking extends My_Controller
{
    public function __construct()
    {
      parent::__construct();
      date_default_timezone_set('Europe/Moscow');
      $this->load->helper('url');
      $this->load->library("pagination");
    }

    public function index()
    {
    }

    public function display() {
        $this->render_view('real-time-tracking/real_time_tracking');
    }

}
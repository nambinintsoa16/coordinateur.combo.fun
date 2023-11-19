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

    public function getSaleByPage() {
      $year = $this->input->get('year');
      $month = $this->input->get('month');
      $this->load->model('Real_time_tracking_model');
      $sale = $this->Real_time_tracking_model->getSaleByPage($month, $year);
      header('Content-Type: application/json');
      echo json_encode($sale);
    }

    public function getSaleByOperatrice() {
      $year = $this->input->get('year');
      $month = $this->input->get('month');
      $this->load->model('Real_time_tracking_model');
      $sale = $this->Real_time_tracking_model->getSaleByOperatrice($month, $year);
      header('Content-Type: application/json');
      echo json_encode($sale);
    }

    public function getSaleByOperatricePerYear() {
      $year = $this->input->get('year');
      $month = $this->input->get('month');
      $operatrice = $this->input->get('operatrice');
      $this->load->model('Real_time_tracking_model');
      $sale = $this->Real_time_tracking_model->getSaleByOperatricePerYear($month, $year, $operatrice);
      header('Content-Type: application/json');
      echo json_encode($sale);
    }

}
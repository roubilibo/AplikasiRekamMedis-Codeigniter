<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      check_not_login();
   }

   public function index()
   {
      $this->db->select('*');
      $this->db->from('pengaturan');
      $this->db->where('id_pengaturan', 1);
      $result = $this->db->get();
      $row = $result->row();
      $data = [
         'title' => $row->nama_aplikasi,
         'instansi' => $row->nama_instansi,
         'logo_instansi' => 'assets/dist/img/' . $row->logo_instansi,
         'logo_daerah' => 'assets/dist/img/' . $row->logo_daerah,
         'username' => $this->session->userdata('username'),
         'halaman' => 'Pengaturan',
      ];
      if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'user') {
         $this->load->view('page/v_pengaturan/pengaturan', $data);
      } else if ($this->session->userdata('level') == 'dokter') {
         $this->load->view('page/v_error/error', $data);
      }
   }

   public function show()
   {
      $draw = intval($this->input->post("draw"));
      $start = intval($this->input->post("start"));
      $length = intval($this->input->post("length"));
      $order = $this->input->post("order");
      $search = $this->input->post("search");
      $search = $search['value'];
      $col = 0;
      $dir = "";

      if (!empty($order)) {
         foreach ($order as $o) {
            $col = $o['column'];
            $dir = $o['dir'];
         }
      }

      if ($dir != "asc" && $dir != "desc") {
         $dir = "desc";
      }

      $valid_columns = array(
         1 => 'nama_aplikasi',
         2 => 'nama_instansi',
         3 => 'alamat_instansi',
         4 => 'telp_instansi',
         5 => 'nama_daerah',
      );

      if (!isset($valid_columns[$col])) {
         $order = null;
      } else {
         $order = $valid_columns[$col];
      }
      if ($order != null) {
         $this->db->order_by($order, $dir);
      }

      if (!empty($search)) {
         $x = 0;
         foreach ($valid_columns as $sterm) {
            if ($x == 0) {
               $this->db->like($sterm, $search);
            } else {
               $this->db->or_like($sterm, $search);
            }
            $x++;
         }
      }
      $this->db->limit($length, $start);
      $this->db->select("*");
      $this->db->from('pengaturan');
      $getData = $this->db->get();
      $data = array();
      $no = 1;
      foreach ($getData->result() as $rows) {

         $data[] = array(
            $no,
            htmlentities($rows->nama_aplikasi, ENT_QUOTES, 'UTF-8'),
            htmlentities($rows->nama_instansi, ENT_QUOTES, 'UTF-8'),
            htmlentities($rows->alamat_instansi, ENT_QUOTES, 'UTF-8'),
            htmlentities($rows->telp_instansi, ENT_QUOTES, 'UTF-8'),
            htmlentities($rows->nama_daerah, ENT_QUOTES, 'UTF-8'),
            '<img src="' . base_url('assets/dist/img/') . $rows->logo_instansi . '" width="100">',
            '<img src="' . base_url('assets/dist/img/') . $rows->logo_daerah . '" width="100">',
            '<div class="btn-group">
                <button aria-label="" data-id="' . $rows->id_pengaturan . '" data-nama_aplikasi="' . $rows->nama_aplikasi . '" data-nama_instansi="' . $rows->nama_instansi . '" data-alamat_instansi="' . $rows->alamat_instansi . '" data-telp_instansi="' . $rows->telp_instansi . '" data-telp_instansi="' . $rows->telp_instansi . '" data-nama_daerah="' . $rows->nama_daerah . '" data-logo_instansi="' . $rows->logo_instansi . '" data-logo_daerah="' . $rows->logo_daerah . '" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                </div>'
         );
         $no++;
      }

      $totalRow = $this->total_data();
      $output = array(
         "draw" => $draw,
         "recordsTotal" => $totalRow,
         "recordsFiltered" => $totalRow,
         "data" => $data
      );
      echo json_encode($output);
      exit();
   }

   public function total_data()
   {
      $query = $this->db->select("COUNT(*) as num")->get('user');
      $result = $query->row();
      if (isset($result)) return $result->num;
      return 0;
   }

   public function edit()
   {
      $this->db->select('*');
      $this->db->from('pengaturan');
      $this->db->where('id_pengaturan', 1);
      $result = $this->db->get();
      $row = $result->row();

      $edit_id = $this->input->post('edit_id');
      $nama_aplikasi = $this->input->post('nama_aplikasi');
      $nama_instansi = $this->input->post('nama_instansi');
      $alamat_instansi = $this->input->post('alamat_instansi');
      $telp_instansi = $this->input->post('telp_instansi');
      $nama_daerah = $this->input->post('nama_daerah');

      $config['upload_path'] = './assets/dist/img/';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';

      $this->load->library('upload', $config);

      $this->upload->do_upload('logo_instansi');
      $hasil_logo_instansi = $this->upload->data();
      $logo_instansi = $hasil_logo_instansi['file_name'];

      $this->upload->do_upload('logo_daerah');
      $hasil_logo_daerah = $this->upload->data();
      $logo_daerah = $hasil_logo_daerah['file_name'];

      if ($logo_instansi != '') {
         $a_logo_instansi = $logo_instansi;
      } else if ($logo_instansi == '') {
         $a_logo_instansi = $row->logo_instansi;
      }
      if ($logo_daerah != '') {
         $a_logo_daerah = $logo_daerah;
      } else if ($logo_daerah == '') {
         $a_logo_daerah = $row->logo_daerah;
      }
      $array = [
         'nama_aplikasi' => $nama_aplikasi,
         'nama_instansi' => $nama_instansi,
         'alamat_instansi' => $alamat_instansi,
         'telp_instansi' => $telp_instansi,
         'nama_daerah' => $nama_daerah,
         'logo_instansi' => $a_logo_instansi,
         'logo_daerah' => $a_logo_daerah,

      ];

      $where = "id_pengaturan = '$edit_id'";

      $data = $this->app_model->updatedata('pengaturan', $array, $where);
      echo json_encode($data);
   }

   public function hapus()
   {
      $hapus_id = $this->input->post('hapus_id');

      $where = "id_user = '$hapus_id'";

      $data = $this->app_model->deletedata('user', $where);
      echo json_encode($data);
   }
}

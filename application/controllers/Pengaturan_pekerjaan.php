<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_pekerjaan extends CI_Controller
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
        $this->db->where('id_pengaturan',1);
        $result = $this->db->get();
        $row = $result->row();
        $data = [
            'title' => $row->nama_aplikasi,
            'instansi' => $row->nama_instansi,
            'logo_instansi' => 'assets/dist/img/'.$row->logo_instansi,
            'logo_daerah' => 'assets/dist/img/'.$row->logo_daerah,
            'username' => $this->session->userdata('username'),
            'halaman' => 'Pengaturan Pekerjaan',
        ];
        if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='user') {
            $this->load->view('page/v_pengaturan/pengaturan_pekerjaan',$data);
        }
        else if ($this->session->userdata('level')=='dokter') {
            $this->load->view('page/v_error/error',$data);
        }
        
    }

    public function show()
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";

        if(!empty($order))
        {
                foreach($order as $o)
                {
                        $col = $o['column'];
                        $dir= $o['dir'];
                }
        }

        if($dir != "asc" && $dir != "desc")
        {
                $dir = "desc";
        }

        $valid_columns = array(
                1=>'id_pekerjaan',
                2=>'nama_pekerjaan',
                3=>'timestamp',
        );

        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }

        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        $this->db->limit($length,$start);
        $this->db->select("*");
        $this->db->from('pengaturan_pekerjaan');
        $this->db->order_by('id_pekerjaan', 'desc');
        $getData = $this->db->get();
        $data = array();
        $no=1;
        foreach($getData->result() as $rows)
        {

            $data[]= array(
                $no,
                htmlentities($rows->id_pekerjaan, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->nama_pekerjaan, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->timestamp, ENT_QUOTES, 'UTF-8'),
                '<div class="btn-group">
                <button aria-label="" data-id="'.$rows->id_pekerjaan.'" data-nama_pekerjaan="'.$rows->nama_pekerjaan.'" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                <button aria-label="" data-id="'.$rows->id_pekerjaan.'" class="hapusData btn btn-xs btn-danger btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data">
                    <i class="fa fa-trash"></i>
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
        $query = $this->db->select("COUNT(*) as num")->get('pengaturan_pekerjaan');
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    public function save()
    {
        $nama_pekerjaan = $this->input->post('nama_pekerjaan');

        $this->db->order_by('id_pekerjaan','desc');
        $result = $this->db->get('pengaturan_pekerjaan');
        $row = $result->row();

        if ($result->num_rows() > 0) {
            $id_pekerjaan = substr($row->id_pekerjaan,4);
            $value = 'PKJ-'.sprintf('%03d',$id_pekerjaan+1);
        }else{
            $value = 'PKJ-'.sprintf('%03d',1);
        }

        $array = [
            'id_pekerjaan' => $value,
            'nama_pekerjaan' => $nama_pekerjaan,
        ];

        $data = $this->app_model->insertdata('pengaturan_pekerjaan',$array);
        echo json_encode($data);
    }

    public function edit()
    {
        $edit_id = $this->input->post('edit_id');
        $nama_pekerjaan = $this->input->post('e_nama_pekerjaan');

        $array = [
            'nama_pekerjaan' => $nama_pekerjaan,
        ];

        $where = "id_pekerjaan = '$edit_id'";

        $data = $this->app_model->updatedata('pengaturan_pekerjaan',$array,$where);
        echo json_encode($data);
    }

    public function hapus()
    {
        $hapus_id = $this->input->post('hapus_id');

        $where = "id_pekerjaan = '$hapus_id'";

        $data = $this->app_model->deletedata('pengaturan_pekerjaan',$where);
        echo json_encode($data);
    }


}

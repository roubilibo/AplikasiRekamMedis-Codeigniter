<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_poli extends CI_Controller
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
            'halaman' => 'Pengaturan Poli',
        ];
        if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='user') {
            $this->load->view('page/v_pengaturan/pengaturan_poli',$data);
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
                1=>'id_poli',
                2=>'nama_poli',
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
        $this->db->from('pengaturan_poli');
        $this->db->order_by('id_poli', 'desc');
        $getData = $this->db->get();
        $data = array();
        $no=1;
        foreach($getData->result() as $rows)
        {

            $data[]= array(
                $no,
                htmlentities($rows->id_poli, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->nama_poli, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->timestamp, ENT_QUOTES, 'UTF-8'),
                '<div class="btn-group">
                <button aria-label="" data-id="'.$rows->id_poli.'" data-nama_poli="'.$rows->nama_poli.'" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                <button aria-label="" data-id="'.$rows->id_poli.'" class="hapusData btn btn-xs btn-danger btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data">
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
        $query = $this->db->select("COUNT(*) as num")->get('pengaturan_poli');
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    public function save()
    {
        $nama_poli = $this->input->post('nama_poli');

        $this->db->order_by('id_poli','desc');
        $result = $this->db->get('pengaturan_poli');
        $row = $result->row();

        if ($result->num_rows() > 0) {
            $id_poli = substr($row->id_poli,4);
            $value = 'POL-'.sprintf('%03d',$id_poli+1);
        }else{
            $value = 'POL-'.sprintf('%03d',1);
        }

        $array = [
            'id_poli' => $value,
            'nama_poli' => $nama_poli,
        ];

        $data = $this->app_model->insertdata('pengaturan_poli',$array);
        echo json_encode($data);
    }

    public function edit()
    {
        $edit_id = $this->input->post('edit_id');
        $nama_poli = $this->input->post('e_nama_poli');

        $array = [
            'nama_poli' => $nama_poli,
        ];

        $where = "id_poli = '$edit_id'";

        $data = $this->app_model->updatedata('pengaturan_poli',$array,$where);
        echo json_encode($data);
    }

    public function hapus()
    {
        $hapus_id = $this->input->post('hapus_id');

        $where = "id_poli = '$hapus_id'";

        $data = $this->app_model->deletedata('pengaturan_poli',$where);
        echo json_encode($data);
    }


}

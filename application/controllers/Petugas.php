<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
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
            'halaman' => 'Petugas',
        ];
        if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='user') {
            $this->load->view('page/v_dokter/dokter',$data);
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
                1=>'id_dokter',
                2=>'nama_dokter',
                3=>'spesialis',
                4=>'alamat',
                5=>'no_telp',
                6=>'date_created',
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
        $this->db->from('dokter');
        $this->db->order_by('date_created', 'desc');
        $getData = $this->db->get();
        $data = array();
        $no=1;
        foreach($getData->result() as $rows)
        {

            $data[]= array(
                $no,
                htmlentities($rows->id_dokter, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->nama_dokter, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->spesialis, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->alamat, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->no_telp, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->date_created, ENT_QUOTES, 'UTF-8'),
                '<div class="btn-group">
                <button aria-label="" data-id="'.$rows->id_dokter.'" data-nama_dokter="'.$rows->nama_dokter.'" data-spesialis="'.$rows->spesialis.'" data-alamat="'.$rows->alamat.'" data-no_telp="'.$rows->no_telp.'" data-date_created="'.$rows->date_created.'" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                <button aria-label="" data-id="'.$rows->id_dokter.'" class="hapusData btn btn-xs btn-danger btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data">
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
        $query = $this->db->select("COUNT(*) as num")->get('dokter');
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    public function save()
    {
        $alamat = $this->input->post('alamat');
        $nama_dokter = $this->input->post('nama_dokter');
        $spesialis = $this->input->post('spesialis');
        $no_telp = $this->input->post('no_telp');
        $date_created = date('Y-m-d H:i:s');

        $this->db->order_by('date_created','desc');
        $result = $this->db->get('dokter');
        $row = $result->row();

        if ($result->num_rows() > 0) {
            $id_dokter = substr($row->id_dokter,4);
            $value = 'DKR-'.sprintf('%03d',$id_dokter+1);
        }else{
            $value = 'DKR-'.sprintf('%03d',1);
        }

        $array = [
            'id_dokter' => $value,
            'alamat' => $alamat,
            'nama_dokter' => $nama_dokter,
            'spesialis' => $spesialis,
            'no_telp' => $no_telp,
            'date_created' => $date_created,
        ];

        $data = $this->app_model->insertdata('dokter',$array);
        echo json_encode($data);
    }

    public function edit()
    {
        $edit_id = $this->input->post('edit_id');
        $alamat = $this->input->post('e_alamat');
        $nama_dokter = $this->input->post('e_nama_dokter');
        $spesialis = $this->input->post('e_spesialis');
        $no_telp = $this->input->post('e_no_telp');

        $array = [
            'alamat' => $alamat,
            'nama_dokter' => $nama_dokter,
            'spesialis' => $spesialis,
            'no_telp' => $no_telp,
        ];

        $where = "id_dokter = '$edit_id'";

        $data = $this->app_model->updatedata('dokter',$array,$where);
        echo json_encode($data);
    }

    public function hapus()
    {
        $hapus_id = $this->input->post('hapus_id');

        $where = "id_dokter = '$hapus_id'";

        $data = $this->app_model->deletedata('dokter',$where);
        echo json_encode($data);
    }


}

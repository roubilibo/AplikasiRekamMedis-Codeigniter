<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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
            'halaman' => 'Pengguna',
        ];
        if ($this->session->userdata('level')=='admin' || $this->session->userdata('level')=='user') {
            $this->load->view('page/v_pengguna/pengguna',$data);
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
                1=>'id_user',
                2=>'nama_user',
                3=>'level',
                4=>'date_created',
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
        $this->db->from('user');
        $this->db->order_by('date_created', 'desc');
        $getData = $this->db->get();
        $data = array();
        $no=1;
        foreach($getData->result() as $rows)
        {
            if ($this->session->userdata('level') == 'user' && $rows->level == 'admin') {
                $aksi = '';
            }else if($this->session->userdata('level') == 'admin'){
                $aksi = '<button aria-label="" data-id="'.$rows->id_user.'" data-nama_user="'.$rows->nama_user.'" data-username="'.$rows->username.'" data-password="'.$rows->password.'" data-level="'.$rows->level.'" data-date_created="'.$rows->date_created.'" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                <button aria-label="" data-id="'.$rows->id_user.'" class="hapusData btn btn-xs btn-danger btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data">
                    <i class="fa fa-trash"></i>
                </button>';
            }else{
                $aksi = '
                <button aria-label="" data-id="'.$rows->id_user.'" data-nama_user="'.$rows->nama_user.'" data-username="'.$rows->username.'" data-password="'.$rows->password.'" data-level="'.$rows->level.'" data-date_created="'.$rows->date_created.'" class="editData btn btn-xs btn-info btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data">
                    <i class="fa fa-edit"></i>
                </button>
                <button aria-label="" data-id="'.$rows->id_user.'" class="hapusData btn btn-xs btn-danger btn-cons from-left" type="button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus Data">
                    <i class="fa fa-trash"></i>
                </button>';
            }

            $data[]= array(
                $no,
                htmlentities($rows->id_user, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->nama_user, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->level, ENT_QUOTES, 'UTF-8'),
                htmlentities($rows->date_created, ENT_QUOTES, 'UTF-8'),
                '<div class="btn-group">
                '.$aksi.'
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
        if(isset($result)) return $result->num;
        return 0;
    }

    public function save()
    {
        $username = $this->input->post('username');
        $nama_user = $this->input->post('nama_user');
        $level = $this->input->post('level');
        $password = md5($this->input->post('password'));
        $date_created = date('Y-m-d H:i:s');

        $this->db->order_by('date_created','desc');
        $result = $this->db->get('user');
        $row = $result->row();

        if ($result->num_rows() > 0) {
            $id_user = substr($row->id_user,4);
            $value = 'USR-'.sprintf('%03d',$id_user+1);
        }else{
            $value = 'USR-'.sprintf('%03d',1);
        }

        $array = [
            'id_user' => $value,
            'username' => $username,
            'nama_user' => $nama_user,
            'level' => $level,
            'password' => $password,
            'date_created' => $date_created,
        ];

        $data = $this->app_model->insertdata('user',$array);
        echo json_encode($data);
    }

    public function edit()
    {
        $edit_id = $this->input->post('edit_id');
        $username = $this->input->post('e_username');
        $nama_user = $this->input->post('e_nama_user');
        $level = $this->input->post('e_level');
        $password = md5($this->input->post('e_password'));

        $array = [
            'username' => $username,
            'nama_user' => $nama_user,
            'level' => $level,
            'password' => $password,
        ];

        $where = "id_user = '$edit_id'";

        $data = $this->app_model->updatedata('user',$array,$where);
        echo json_encode($data);
    }

    public function hapus()
    {
        $hapus_id = $this->input->post('hapus_id');

        $where = "id_user = '$hapus_id'";

        $data = $this->app_model->deletedata('user',$where);
        echo json_encode($data);
    }


}

<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Kriteria extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Kriteria_model');
			$this->load->library('M_db');

            if ($this->session->userdata('id_user_level') != "1") {
            ?>
				<script type="text/javascript">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url("Login/home"); ?>'
                </script>
            <?php
			}
        }

        public function index()
        {
            $data['page'] = "Kriteria";
			$data['list'] = $this->Kriteria_model->tampil();
            $this->load->view('kriteria/index', $data);
        }
		function gethtml()
		{
			$output=array();
			$outputs=array();
			$dKriteria=$this->Kriteria_model->tampil();
			foreach($dKriteria as $rK)
			{
				$output[$rK->id_kriteria]=$rK->nama_kriteria;
				$outputs[$rK->id_kriteria]=$rK->id_kriteria;
			}		
			$d['arr']=$output;
			$d['arrs']=$outputs;
			$this->load->view('Kriteria/matrikutama', $d);
		}
		
		function updateutama()
		{
			$error=FALSE;
			$msg="";
			$s=array(
				'id_kriteria_nilai !='=>''
			);
			$this->m_db->delete_row('kriteria_nilai',$s);
					
			$cr=$this->input->post('crvalue');
			if($cr > 0.01)
			{
				$msg="Gagal diupdate karena nilai CR kurang dari 0.01";
				$error=TRUE;
			}else{
				foreach($_POST as $k=>$v)
				{
					if($k!="crvalue" )
					{									
					foreach($v as $x=>$x2)
					{
						$d=array(
						'kriteria_id_dari'=>$k,
						'kriteria_id_tujuan'=>$x,
						'nilai'=>$x2,
						);
						$this->m_db->add_row('kriteria_nilai',$d);
					}
					}
				}
				$msg="Berhasil update nilai kriteria";
				$error=FALSE;
			}
					
			
			if($error==FALSE)
			{			
				echo json_encode(array('status'=>'ok','msg'=>$msg));
			}else{
				echo json_encode(array('status'=>'no','msg'=>$msg));
			}
			
		}
		
		public function simpan_prioritas()
        {
			$s=array(
				'id_kriteria_hasil !='=>''
			);
			$this->m_db->delete_row('kriteria_hasil',$s);
			
			$id_kriteria = $this->input->post('id_kriteria');
            $perioritas = $this->input->post('perioritas');
            $i = 0;
            echo var_dump($perioritas);
            foreach ($perioritas as $key) {
                $this->Kriteria_model->tambah_perioritas($id_kriteria[$i],$key);
                $i++;
            }
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('Kriteria');
        }
        
        //menampilkan view create
        public function create()
        {
			$data['page'] = "Kriteria";
            $this->load->view('kriteria/create', $data);
        }

        //menambahkan data ke database
        public function store()
        {
                $data = [
                    'nama_kriteria' => $this->input->post('nama_kriteria'),
                    'kode_kriteria' => $this->input->post('kode_kriteria')
                ];
                
                $this->form_validation->set_rules('nama_kriteria', 'Nama', 'required');
                $this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'required');

                
    
                if ($this->form_validation->run() != false) {
                    $result = $this->Kriteria_model->insert($data);
                    if ($result) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
						redirect('Kriteria');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
                    redirect('Kriteria/create');
                    
                }
            

        }

        public function edit($id_kriteria)
        {
            $data['page'] = "Kriteria";
			$data['kriteria'] = $this->Kriteria_model->show($id_kriteria);
            $this->load->view('kriteria/edit', $data);
        }
    
        public function update($id_kriteria)
        {
            // TODO: implementasi update data berdasarkan $id_kriteria
            $id_kriteria = $this->input->post('id_kriteria');
            $data = array(
                'nama_kriteria' => $this->input->post('nama_kriteria'),
                'kode_kriteria' => $this->input->post('kode_kriteria')
            );

            $this->Kriteria_model->update($id_kriteria, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('kriteria');
        }
    
        public function destroy($id_kriteria)
        {
            $this->Kriteria_model->delete($id_kriteria);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('kriteria');
        }
    
    }
    
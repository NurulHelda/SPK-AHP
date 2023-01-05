<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penilaian extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Penilaian_model');

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
            $data = [
				'page' => "Penilaian",
                'kriteria'=> $this->Penilaian_model->get_kriteria(),
                'alternatif'=> $this->Penilaian_model->get_alternatif()             
            ];
            $this->load->view('penilaian/index', $data);
        }
        
  
        public function tambah_penilaian()
        {
            $id_alternatif = $this->input->post('id_alternatif');
            $id_kriteria = $this->input->post('id_kriteria');
            $id_sub_kriteria = $this->input->post('id_sub_kriteria');
            $i = 0;
            echo var_dump($id_sub_kriteria);
            foreach ($id_sub_kriteria as $key) {
                $this->Penilaian_model->tambah_penilaian($id_alternatif,$id_kriteria[$i],$key);
                $i++;
            }
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('penilaian');
        }

        public function update_penilaian()
		{
			$id_alternatif = $this->input->post('id_alternatif');
			$id_kriteria = $this->input->post('id_kriteria');
			$id_sub_kriteria = $this->input->post('id_sub_kriteria');
			$i = 0;

			foreach ($id_sub_kriteria as $key) {
				$cek = $this->Penilaian_model->data_penilaian($id_alternatif,$id_kriteria[$i]);
				if ($cek==0) {
					$this->Penilaian_model->tambah_penilaian($id_alternatif,$id_kriteria[$i],$key);
				} else {
					$this->Penilaian_model->edit_penilaian($id_alternatif,$id_kriteria[$i],$key);	
				}
				$i++;
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('penilaian');
		}
    }
    
    
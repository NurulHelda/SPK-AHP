<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Perhitungan extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Perhitungan_model');
			$this->load->library('M_db');
        }

        public function index()
        {
            if ($this->session->userdata('id_user_level') != "1") {
            ?>
				<script type="text/javascript">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url("Login/home"); ?>'
                </script>
            <?php
			}			
			$data = [
                'page' => "Perhitungan",
				'kriteria'=> $this->Perhitungan_model->get_kriteria(),
				'nilai_kategori'=> $this->Perhitungan_model->get_nilai_kategori(),
                'alternatif'=> $this->Perhitungan_model->get_alternatif(),
            ];
			
            $this->load->view('Perhitungan/perhitungan', $data);
        }
	
		public function hasil()
        {
            $data = [
                'page' => "Hasil",
				'hasil'=> $this->Perhitungan_model->get_hasil()
            ];
			
            $this->load->view('Perhitungan/hasil', $data);
        }
    
    }
    
    
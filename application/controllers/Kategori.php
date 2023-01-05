<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Kategori extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Kategori_model');

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
                'page' => "Kategori",
				'list' => $this->Kategori_model->tampil(),
                
            ];
            $this->load->view('kategori/index', $data);
        }
        
        //menampilkan view create
        public function create()
        {
            $data['page'] = "Kategori";
            $this->load->view('kategori/create',$data);
        }

        //menambahkan data ke database
        public function store()
        {
                $data = [
                    'nama_nilai' => $this->input->post('nama_nilai')
                ];
                
                $this->form_validation->set_rules('nama_nilai', 'Nama', 'required');               
    
                if ($this->form_validation->run() != false) {
                    $result = $this->Kategori_model->insert($data);
                    if ($result) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
						redirect('kategori');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data gagal disimpan!</div>');
                    redirect('kategori/create');
                    
                }
            

        }

        public function edit($id_nilai)
        {
            $kategori = $this->Kategori_model->show($id_nilai);
            $data = [
                'page' => "Kategori",
				'kategori' => $kategori
            ];
            $this->load->view('kategori/edit', $data);
        }
    
        public function update($id_nilai)
        {
            $id_nilai = $this->input->post('id_nilai');
            $data = array(
                'nama_nilai' => $this->input->post('nama_nilai')
            );

            $this->Kategori_model->update($id_nilai, $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
            redirect('kategori');
        }
    
        public function destroy($id_nilai)
        {
            $this->Kategori_model->delete($id_nilai);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
            redirect('kategori');
        }
    
    }
    
    
<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Sub_kriteria extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Sub_Kriteria_model');
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
            $data = [
				'page' => "Sub Kriteria",
                'list' => $this->Sub_Kriteria_model->tampil(),
                'kriteria'=> $this->Sub_Kriteria_model->get_kriteria(),
                'count_kriteria'=> $this->Sub_Kriteria_model->count_kriteria(),
                'sub_kriteria' => $this->Sub_Kriteria_model->tampil(),
				'nilai' => $this->Sub_Kriteria_model->nilai(),
                
            ];
            $this->load->view('sub_kriteria/index', $data);
        }

        //menambahkan data ke database
        public function store()
        {
                $data = [
                    'id_kriteria' => $this->input->post('id_kriteria'),
                    'nama_sub_kriteria' => $this->input->post('nama_sub_kriteria'),
                    'id_nilai' => $this->input->post('id_nilai')
                ];
                
                $this->form_validation->set_rules('id_kriteria', 'ID Kriteria', 'required');
                $this->form_validation->set_rules('nama_sub_kriteria', 'Nama', 'required');
                $this->form_validation->set_rules('id_nilai', 'Nilai', 'required');

                if ($this->form_validation->run() != false) {
                    $result = $this->Sub_Kriteria_model->insert($data);
                    if ($result) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
						redirect('sub_kriteria');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
                    redirect('sub_kriteria/create');
                    
                }
            

        }
    
        public function update($id_sub_kriteria)
        {
            // TODO: implementasi update data berdasarkan $id_sub_kriteria
            $id_sub_kriteria = $this->input->post('id_sub_kriteria');
            $data = array(
                'id_kriteria' => $this->input->post('id_kriteria'),
				'nama_sub_kriteria' => $this->input->post('nama_sub_kriteria'),
				'id_nilai' => $this->input->post('id_nilai')
            );

            $this->Sub_Kriteria_model->update($id_sub_kriteria, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('sub_kriteria');
        }
    
        public function destroy($id_sub_kriteria)
        {
            $this->Sub_Kriteria_model->delete($id_sub_kriteria);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('sub_kriteria');
        }
		
		function getsubcontainer()
		{
			$d['kriteria']=$this->Sub_Kriteria_model->get_kriteria();
			$this->load->view('sub_kriteria/subcontainer',$d);
		}
		
		function getsub()
		{		
			$id_kriteria=$this->input->get('kriteria');
			$namaKriteria=$this->Sub_Kriteria_model->kriteria_info($id_kriteria);
			$dSub=$this->Sub_Kriteria_model->subkriteria_child($id_kriteria);
			$output=array();
			$outputs=array();
			if(!empty($dSub)){					
				foreach($dSub as $rK){
					$nama=field_value('nilai_kategori','id_nilai',$rK['id_nilai'],'nama_nilai');
					$output[$rK['id_sub_kriteria']]=$nama;
					$outputs[$rK['id_sub_kriteria']]['id_sub_kriteria']=$rK['id_sub_kriteria'];
					$outputs[$rK['id_sub_kriteria']]['id_kriteria']=$rK['id_kriteria'];
				}
			}
			$d['arr']=$output;
			$d['arrs']=$outputs;
			$d['kriteriaid']=$id_kriteria;
			$d['namakriteria']=$namaKriteria['nama_kriteria'];
			$this->load->view('sub_kriteria/matriksub', $d);
		}
		
		function updatesub()
		{
			$error=FALSE;
			$kriteriaid=$this->input->post('kriteriaid');
			if(!empty($kriteriaid))
			{
			$msg="";
			$s=array(
				'id_kriteria'=>$kriteriaid,
			);
			$this->m_db->delete_row('subkriteria_nilai',$s);
					
			$cr=$this->input->post('crvalue');
			if($cr > 0.01)
			{
				$msg="Gagal diupdate karena nilai CR kurang dari 0.01";
				$error=TRUE;
			}else{
				foreach($_POST as $k=>$v)
				{
					if($k!="crvalue" && $k!="kriteriaid")
					{									
					foreach($v as $x=>$x2)
					{
						$d=array(
						'id_kriteria'=>$kriteriaid,
						'subkriteria_id_dari'=>$k,
						'subkriteria_id_tujuan'=>$x,
						'nilai'=>$x2,
						);
						$this->m_db->add_row('subkriteria_nilai',$d);
					}
					}
				}
				$msg="Berhasil update nilai subkriteria";
				$error=FALSE;
			}
					
			
			if($error==FALSE)
			{			
				echo json_encode(array('status'=>'ok','msg'=>$msg));
			}else{
				echo json_encode(array('status'=>'no','msg'=>$msg));
			}
			
			}else{
				$msg="Gagal mengubah nilai subkriteria";
				echo json_encode(array('status'=>'no','msg'=>$msg));
			}
			
		}
		
		public function simpan_prioritas()
        {
			$id_krit = $this->input->post('id_krit');
			$this->Sub_Kriteria_model->hapus_perioritas($id_krit);
			
			$id_kriteria = $this->input->post('id_kriteria');
			$id_sub_kriteria = $this->input->post('id_sub_kriteria');
            $perioritas = $this->input->post('perioritas');
            $i = 0;
            echo var_dump($perioritas);
            foreach ($perioritas as $key) {
                $this->Sub_Kriteria_model->tambah_perioritas($id_kriteria[$i],$id_sub_kriteria[$i],$key);
                $i++;
            }
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('Sub_Kriteria');
        }
    
    }
    
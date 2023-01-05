<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Sub_Kriteria_model extends CI_Model {

        public function tampil()
        {
            $query = $this->db->get('sub_kriteria');
            return $query->result();
        }
		
		public function tambah_perioritas($id_kriteria,$id_sub_kriteria,$perioritas)
        {
            $query = $this->db->simple_query("INSERT INTO sub_kriteria_hasil VALUES (DEFAULT,'$id_kriteria','$id_sub_kriteria','$perioritas');");
            return $query;	
        }
		
		public function hapus_perioritas($id_kriteria)
        {
            $this->db->where('id_kriteria', $id_kriteria);
            $this->db->delete('sub_kriteria_hasil');
        }
		
		public function nilai()
        {
            $query = $this->db->get('nilai_kategori');
            return $query->result();
        }

        public function getTotal()
        {
            return $this->db->count_all('sub_kriteria');
        }

        public function insert($data = [])
        {
            $result = $this->db->insert('sub_kriteria', $data);
            return $result;
        }

        public function show($id_sub_kriteria)
        {
            $this->db->where('id_sub_kriteria', $id_sub_kriteria);
            $query = $this->db->get('sub_kriteria');
            return $query->row();
        }

        public function update($id_sub_kriteria, $data = [])
        {
            $ubah = array(
                'id_kriteria' => $data['id_kriteria'],
                'nama_sub_kriteria' => $data['nama_sub_kriteria'],
                'id_nilai'  => $data['id_nilai']
            );

            $this->db->where('id_sub_kriteria', $id_sub_kriteria);
            $this->db->update('sub_kriteria', $ubah);
        }

        public function delete($id_sub_kriteria)
        {
            $this->db->where('id_sub_kriteria', $id_sub_kriteria);
            $this->db->delete('sub_kriteria');
        }

        public function get_kriteria()
        {
            $query = $this->db->get('kriteria');
            return $query->result();
        }

        public function count_kriteria(){
            $query =  $this->db->query("SELECT id_kriteria,COUNT(nama_sub_kriteria) AS jml_setoran FROM sub_kriteria GROUP BY id_kriteria")->result();
            return $query;
        }

        public function data_sub_kriteria($id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai WHERE sub_kriteria.id_kriteria='$id_kriteria' ORDER BY sub_kriteria.id_nilai ASC;");
			return $query->result_array();
		}
		
		public function kriteria_info($id_kriteria)
		{
			$query = $this->db->query("SELECT nama_kriteria FROM kriteria WHERE id_kriteria='$id_kriteria';");
			return $query->row_array();
		}
		
		public function subkriteria_child($id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY id_nilai ASC;");
			return $query->result_array();
		}
    }
    
    /* End of file Kategori_model.php */
    
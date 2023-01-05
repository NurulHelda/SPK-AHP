<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Penilaian_model extends CI_Model {
      
        public function tambah_penilaian($id_alternatif,$id_kriteria,$id_sub_kriteria)
        {
            $query = $this->db->simple_query("INSERT INTO penilaian VALUES (DEFAULT,'$id_alternatif','$id_kriteria',$id_sub_kriteria);");
            return $query;	
        }
       
        public function edit_penilaian($id_alternatif,$id_kriteria,$id_sub_kriteria)
        {
            $query = $this->db->simple_query("UPDATE penilaian SET id_sub_kriteria=$id_sub_kriteria WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            return $query;	
        }

        public function delete($id_penilaian)
        {
            $this->db->where('id_penilaian', $id_penilaian);
            $this->db->delete('penilaian');
        }
       
        public function get_kriteria()
        {
            $query = $this->db->get('kriteria');
            return $query->result();
        }
		
        public function get_alternatif()
        {
            $query = $this->db->query("SELECT * FROM alternatif");
            return $query->result();
        }

        public function data_penilaian($id_alternatif,$id_kriteria)
        {
            $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            return $query->row_array();
        }
		
        public function untuk_tombol($id_alternatif)
		{
			$query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif';");
			return $query->num_rows();
		}
		
		public function data_sub_kriteria($id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai WHERE sub_kriteria.id_kriteria='$id_kriteria' ORDER BY sub_kriteria.id_nilai ASC;");
			return $query->result_array();
		}
    
    }
    
    
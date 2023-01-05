<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Perhitungan_model extends CI_Model {
		
		function __construct()
		{
			parent::__construct();
			
		}
		
		public function get_kriteria()
		{
			$query = $this->db->query("SELECT * FROM kriteria JOIN kriteria_hasil ON kriteria.id_kriteria=kriteria_hasil.id_kriteria;");
			return $query->result();
		}
		
        public function get_alternatif()
        {
            $query = $this->db->get('alternatif');
            return $query->result();
        }
		
		public function get_sub_kriteria($id_kriteria)
        {
            $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria';");
            return $query->result();
        }
		
		public function get_nilai_kategori()
        {
            $query = $this->db->get('nilai_kategori');
            return $query->result();
        }
		
		public function prioritas_subkrit($id_nilai,$id_kriteria,$id_sub_kriteria)
        {
            $query = $this->db->query("SELECT * FROM sub_kriteria_hasil JOIN sub_kriteria ON sub_kriteria_hasil.id_sub_kriteria=sub_kriteria.id_sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai WHERE sub_kriteria_hasil.id_kriteria='$id_kriteria' AND sub_kriteria_hasil.id_sub_kriteria='$id_sub_kriteria' AND nilai_kategori.id_nilai='$id_nilai'");
            return $query->row_array();
        }
		
		public function data_nilai($id_alternatif,$id_kriteria)
		{
			$query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria ON penilaian.id_sub_kriteria=sub_kriteria.id_sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai JOIN sub_kriteria_hasil ON penilaian.id_sub_kriteria=sub_kriteria_hasil.id_sub_kriteria WHERE penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria';");
			return $query->row_array();
		}
		
		public function nilai_subkrit($id_kriteria,$id_sub_kriteria)
        {
            $query = $this->db->query("SELECT * FROM sub_kriteria_hasil JOIN sub_kriteria ON sub_kriteria_hasil.id_sub_kriteria=sub_kriteria.id_sub_kriteria  WHERE sub_kriteria_hasil.id_kriteria='$id_kriteria' AND sub_kriteria_hasil.id_sub_kriteria='$id_sub_kriteria'");
            return $query->row_array();
        }
		
		public function insert_hasil($hasil_akhir = [])
        {
            $result = $this->db->insert('hasil', $hasil_akhir);
            return $result;
        }
		
		public function hapus_hasil()
        {
            $query = $this->db->query("TRUNCATE TABLE hasil;");
			return $query;
        }
		
		public function get_hasil()
        {
			$query = $this->db->query("SELECT * FROM hasil ORDER BY nilai DESC;");
            return $query->result();
        }
		
		public function get_hasil_alternatif($id_alternatif)
		{
			$query = $this->db->query("SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif';");
			return $query->row_array();		
		}
		
    }
    
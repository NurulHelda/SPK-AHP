<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Kriteria_model extends CI_Model {

        public function tampil()
        {
            $query = $this->db->get('kriteria');
            return $query->result();
        }
		
		public function tambah_perioritas($id_kriteria,$perioritas)
        {
            $query = $this->db->simple_query("INSERT INTO kriteria_hasil VALUES (DEFAULT,'$id_kriteria','$perioritas');");
            return $query;	
        }

        public function getTotal()
        {
            return $this->db->count_all('kriteria');
        }

        public function insert($data = [])
        {
            $result = $this->db->insert('kriteria', $data);
            return $result;
        }

        public function show($id_kriteria)
        {
            $this->db->where('id_kriteria', $id_kriteria);
            $query = $this->db->get('kriteria');
            return $query->row();
        }

        public function update($id_kriteria, $data = [])
        {
            $ubah = array(
                'nama_kriteria' => $data['nama_kriteria'],
                'kode_kriteria' => $data['kode_kriteria']
            );

            $this->db->where('id_kriteria', $id_kriteria);
            $this->db->update('kriteria', $ubah);
        }

        public function delete($id_kriteria)
        {
            $this->db->where('id_kriteria', $id_kriteria);
            $this->db->delete('kriteria');
        }
    }
    
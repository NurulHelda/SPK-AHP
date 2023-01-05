<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Kategori_model extends CI_Model {

        public function tampil()
        {
            $query = $this->db->get('nilai_kategori');
            return $query->result();
        }

        public function insert($data = [])
        {
            $result = $this->db->insert('nilai_kategori', $data);
            return $result;
        }

        public function show($id_nilai)
        {
            $this->db->where('id_nilai', $id_nilai);
            $query = $this->db->get('nilai_kategori');
            return $query->row();
        }

        public function update($id_nilai, $data = [])
        {
            $ubah = array(
                'nama_nilai'  => $data['nama_nilai']
            );

            $this->db->where('id_nilai', $id_nilai);
            $this->db->update('nilai_kategori', $ubah);
        }


        public function delete($id_nilai)
        {
            $this->db->where('id_nilai', $id_nilai);
            $this->db->delete('nilai_kategori');
        }
    }
    
    
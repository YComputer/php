
<?php
class Test_model extends CI_Model {

        public function getTestData(){
                # return  array("Volvo","BMW","SAAB");
                # $this->load->database();
                $name = "xiaobing11";
                $id = 11;

                $sql = "INSERT INTO TEST (ID, NAME) VALUES (".$this->db->escape($id).", ".$this->db->escape($name).")";
                $this->db->query($sql);
                echo $this->db->affected_rows();

		return  $this->db->get('TEST')->result();
        }
}

<?php
class Product_model extends CI_Model {

    public function get_all() {
        return $this->db->select('products.*, categories.name as category_name')
                        ->from('products')
                        ->join('categories', 'categories.id = products.category_id')
                        ->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('products', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('products', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('products', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete('products');
    }

    public function get_categories() {
        return $this->db->get('categories')->result();
    }


    private function _get_query()
{
    $this->db->select('p.*, c.name as category_name');
    $this->db->from('products p');
    $this->db->join('categories c', 'c.id = p.category_id', 'left');

    if ($_POST['search']['value']) {
        $this->db->like('p.name', $_POST['search']['value']);
        $this->db->or_like('p.price', $_POST['search']['value']);
        $this->db->or_like('c.name', $_POST['search']['value']);
    }

    if (isset($_POST['order'])) {
        $columns = ['p.name', 'p.price', 'c.name', 'p.image'];
        $this->db->order_by($columns[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
    } else {
        $this->db->order_by('p.id', 'DESC');
    }
}

function get_datatables()
{
    $this->_get_query();
    if ($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
    return $this->db->get()->result();
}

function count_filtered()
{
    $this->_get_query();
    return $this->db->get()->num_rows();
}

function count_all()
{
    $this->db->from('products');
    return $this->db->count_all_results();
}

}

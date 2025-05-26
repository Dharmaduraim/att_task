<?php
class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->helper('url');
        $this->load->library('image_lib');
        if (!$this->session->userdata('user')) {
            redirect('auth/login');
        }
          }

    public function index() {
        $data['products'] = $this->Product_model->get_all();
                $data['categories'] = $this->Product_model->get_categories();

        $this->load->view('product/list', $data);
    }

    public function create() {
        $data['categories'] = $this->Product_model->get_categories();
        $this->load->view('product/create', $data);
    }

    public function store() {
    $this->form_validation->set_rules('name', 'Product Name', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
        $data['categories'] = $this->Product_model->get_categories();
        $this->load->view('product/create', $data);
        return;
    }

    $image_name = null;

    // Upload configuration
    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size']      = 2048; // 2MB
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!empty($_FILES['image']['name'])) {
        if (!$this->upload->do_upload('image')) {
            $data['upload_error'] = $this->upload->display_errors();
            $data['categories'] = $this->Product_model->get_categories();
            $this->load->view('product/create', $data);
            return;
        } else {
            $upload_data = $this->upload->data();
            $image_name = $upload_data['file_name'];

            // Resize Image
            $resize_config = [
                'image_library'  => 'gd2',
                'source_image'   => $upload_data['full_path'],
                'maintain_ratio' => TRUE,
                'width'          => 500,
                'height'         => 500
            ];

            $this->load->library('image_lib', $resize_config);
            $this->image_lib->initialize($resize_config);
            $this->image_lib->resize();
        }
    }

    // Save data to DB
    $data = [
        'name'        => $this->input->post('name'),
        'description' => $this->input->post('description'),
        'price'       => $this->input->post('price'),
        'category_id' => $this->input->post('category_id'),
        'image'       => $image_name
    ];

    $this->Product_model->insert($data);
    redirect('product');
}

    public function edit($id) {
        $data['product'] = $this->Product_model->get_by_id($id);
        // print_r($data['product']);exit();
        $data['categories'] = $this->Product_model->get_categories();
        $this->load->view('product/edit', $data);
    }

    public function update($id) {
    $this->form_validation->set_rules('name', 'Product Name', 'required');
    $this->form_validation->set_rules('price', 'Price', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
        $this->edit($id);
        return;
    }

    $product = $this->Product_model->get_by_id($id);
    $image_name = $product->image;

    // Upload config
    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif';
    $config['max_size']      = 2048;
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!empty($_FILES['image']['name'])) {
        if (!$this->upload->do_upload('image')) {
            $data['upload_error'] = $this->upload->display_errors();
            $data['categories'] = $this->Product_model->get_categories();
            $data['product'] = $product;
            $this->load->view('product/edit', $data);
            return;
        } else {
            $upload_data = $this->upload->data();
            $image_name = $upload_data['file_name'];

            // Resize image using CodeIgniter's image library
            $resize_config = [
                'image_library'  => 'gd2',
                'source_image'   => $upload_data['full_path'],
                'maintain_ratio' => TRUE,
                'width'          => 500,
                'height'         => 500
            ];

            $this->load->library('image_lib', $resize_config);
            $this->image_lib->initialize($resize_config);

            if (!$this->image_lib->resize()) {
                $data['upload_error'] = $this->image_lib->display_errors();
                $data['categories'] = $this->Product_model->get_categories();
                $data['product'] = $product;
                $this->load->view('product/edit', $data);
                return;
            }
        }
    }

    $data = [
        'name'        => $this->input->post('name'),
        'description' => $this->input->post('description'),
        'price'       => $this->input->post('price'),
        'category_id' => $this->input->post('category_id'),
        'image'       => $image_name
    ];

    $this->Product_model->update($id, $data);
    redirect('product');
}



    public function delete($id) {
        $this->Product_model->delete($id);
        redirect('product');
    }
    public function get_products()
{
    $this->load->model('Product_model');
    $products = $this->Product_model->get_datatables();
    $data = [];
    foreach ($products as $p) {
        $data[] = [
            'id' => $p->id,
            'name' => $p->name,
            'price' => $p->price,
            'category_name' => $p->category_name,
             'description' => $p->description,
            'image' => $p->image,
        ];
    }

    $output = [
        "draw" => intval($this->input->post("draw")),
        "recordsTotal" => $this->Product_model->count_all(),
        "recordsFiltered" => $this->Product_model->count_filtered(),
        "data" => $data,
    ];

    echo json_encode($output);
}

public function make_upload_dir() {
    $path = './uploads';
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
        echo "Upload folder created.";
    } else {
        echo "Upload folder already exists.";
    }
}


}

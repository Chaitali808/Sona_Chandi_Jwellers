<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public $rates = [
        'gold' => [
            '24' => 6000,
            '22' => 5800,
            '21' => 5600,
            '20' => 5400,
            '18' => 4500,
            '14' => 3500,
            '10' => 3000,
            '9' => 2800
        ],
        'silver' => [
            '99.9' => 80,
            '92.5' => 75,
            '90.0' => 72
        ],
        'platinum' => [
            '99.9' => 5200,
            '95.0' => 5100,
            '90.0' => 4800
        ],
        'diamond' => [
            'fl' => 20000,
            'if' => 18000,
            'vvs1' => 16000,
            'vs1' => 14000,
            'si1' => 12000,
            'i1' => 8000
        ]
    ];
    public function __construct()
    {
        parent::__construct();

        $this->load->model('UserModel');       // Load your model

    }

    public function products()
    {
        // Get query parameters from URL
        $type = $this->input->get('type');
        $category = $this->input->get('category');
        $lowest = $this->input->get('lowest');
        $highest = $this->input->get('highest');
        $tags = $this->input->get('tags');


        $data['products'] = $this->UserModel->getFilteredProducts($this->rates, $type, $category, $lowest, $highest, $tags);
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['FilterCategory'] = $this->UserModel->getAllCategoryForFilter();
        $data['rates'] = $this->rates;
        $data['customer_id'] = "1";

        // Initialize defaults
        $likeCount = 0;
        $cartCount = 0;

        // Check if user is logged in
        if ($this->session->userdata('customer_id')) {
            $customerId = $this->session->userdata('customer_id');

            // Call UserModel functions
            $likeCount = $this->UserModel->getLikeCountByCustomer($customerId);
            $cartCount = $this->UserModel->getCartCountByCustomer($customerId);
        }

        // Pass to view
        $data['likeCount'] = $likeCount;
        $data['cartCount'] = $cartCount;

        // Load the view with data
        $this->load->view('User/products', $data);

    }
    public function view($main, $sub, $actual)
    {
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        // Pass route parameters to the view
        $data['type'] = $main;
        $data['categories'] = $sub;
        $data['tags'] = $actual;
        $data['products'] = $this->UserModel->getAllProductsByURL($main, $sub, $actual);
        $data['rates'] = $this->rates;
        $data['FilterCategory'] = $this->UserModel->getAllCategoryForFilter();

        // Initialize defaults
        $likeCount = 0;
        $cartCount = 0;

        // Check if user is logged in
        if ($this->session->userdata('customer_id')) {
            $customerId = $this->session->userdata('customer_id');

            // Call UserModel functions
            $likeCount = $this->UserModel->getLikeCountByCustomer($customerId);
            $cartCount = $this->UserModel->getCartCountByCustomer($customerId);
        }

        // Pass to view
        $data['likeCount'] = $likeCount;
        $data['cartCount'] = $cartCount;
        $this->load->view('User/products', $data);
    }

    //to show the filtered products by with all or with any one also : vivek


    public function Search()
    {
        $search = $this->input->get('search');

        $data['products'] = $this->UserModel->getSearchProducts($search);
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['FilterCategory'] = $this->UserModel->getAllCategoryForFilter();
        $data['rates'] = $this->rates;
        $data['customer_id'] = "1";

        // Initialize defaults
        $likeCount = 0;
        $cartCount = 0;

        // Check if user is logged in
        if ($this->session->userdata('customer_id')) {
            $customerId = $this->session->userdata('customer_id');

            // Call UserModel functions
            $likeCount = $this->UserModel->getLikeCountByCustomer($customerId);
            $cartCount = $this->UserModel->getCartCountByCustomer($customerId);
        }

        // Pass to view
        $data['likeCount'] = $likeCount;
        $data['cartCount'] = $cartCount;

        // Load the view with data
        $this->load->view('User/products', $data);

    }
}
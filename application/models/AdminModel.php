<?php
defined("BASEPATH") or exit("No direct script access allowed");

class AdminModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();


    }
    public function insertProduct($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id(); // return newly inserted product ID
    }

    public function insertProductImage($data)
    {
        return $this->db->insert('product_images', $data);
    }
    public function getAllProducts()
    {
        return $this->db->get('products')->result();
    }

    // Fetch multiple images for a product
    public function getProductImages($product_id)
    {
        return $this->db->get_where('product_images', ['product_id' => $product_id])->result();
    }
    public function getProduct($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row();
    }

    public function updateProduct($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function deleteProductById($id)
    {
        // Delete gallery images
        $this->db->where('product_id', $id);
        $this->db->delete('product_images');

        // Delete product
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }


    public function getAllCategories()
    {
        return $this->db->get('categories')->result();
    }
    public function getCategoryByName($name)
    {
        return $this->db->get_where('categories', ['name' => $name])->row();
    }

    public function insertCategory($name)
    {
        $this->db->insert('categories', ['name' => $name]);
        return $this->db->insert_id();
    }

    public function deleteCategoryById($id)
    {
        $this->db->delete('categories', ['id' => $id]);
    }
    public function getFilteredProducts($product_code = null, $type = null, $category = null)
    {
        $this->db->select('*');
        $this->db->from('products');

        // Search by product_code
        if (!empty($product_code)) {
            $this->db->like('product_code', $product_code);
        }

        // Type filter
        if (!empty($type) && $type !== 'All') {
            $this->db->like('type', '"' . $type . '"'); // type is stored as JSON array
        }

        // Category filter
        if (!empty($category) && $category !== 'All') {
            $this->db->like('categories', '"' . $category . '"'); // categories is stored as JSON array
        }

        $query = $this->db->get();
        return $query->result();
    }



    public function deleteProductImage($image_id)
    {
        return $this->db->where('id', $image_id)
            ->delete('product_images');
    }


    public function deleteProductImages($imageIds)
    {
        // First get the image paths
        $this->db->select('image_path');
        $this->db->where_in('id', $imageIds);
        $images = $this->db->get('product_images')->result();

        // Delete from filesystem
        foreach ($images as $image) {
            if (file_exists($image->image_path)) {
                unlink($image->image_path);
            }
        }

        // Delete from database
        $this->db->where_in('id', $imageIds);
        return $this->db->delete('product_images');
    }

    public function getProductImagePath($product_id)
    {
        $this->db->select('image');
        $this->db->where('id', $product_id);
        $product = $this->db->get('products')->row();
        return $product ? $product->image : null;
    }

    public function getAllBanners()
    {
        return $this->db->get('hearo_banners')->result();
    }

    public function insertBanner($filename)
    {
        $data = ['image' => $filename];
        $this->db->insert('hearo_banners', $data);
        return $this->db->insert_id();
    }

    public function getBanner($id)
    {
        return $this->db->get_where('hearo_banners', ['id' => $id])->row();
    }

    public function deleteBanner($id)
    {
        $this->db->delete('hearo_banners', ['id' => $id]);
    }


    // // vivek model
    // public function addCustomerFeedback($feedback)
    // {
    //     $affectedRows = $this->db->insert('customer_feedback', $feedback);
    //     if ($affectedRows > 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function getAllOrders()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->join('customers', 'customers.id = orders.customer_id');
        return $this->db->get()->result();
    }

    public function getAdminProfile()
    {
        return $this->db->select('*')->from('admins')->get()->row();
    }

    public function updateAdminProfile($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('admins', $data);
    }

    public function checkLogin($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('admins');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if ($user->password === $password) {
                return $user;
            }
        }
        return false;
    }

    public function getAllCustomers()
    {
        $this->db->select('customers.*, COUNT(orders.id) AS order_count, COALESCE(SUM(orders.total), 0) AS total_sum');
        $this->db->from('customers');
        $this->db->join('orders', 'orders.customer_id = customers.id', 'left');
        $this->db->group_by('customers.id');
        $this->db->order_by('customers.id', 'DESC'); // Sort by customer ID in descending order
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteCustomerById($id)
    {
        return $this->db->where('id', $id)->delete('customers');
    }


    public function getReviewsWithCustomerNames()
    {
        $this->db->select('*');
        $this->db->from('shopfeedback');
        $this->db->order_by('id', 'DESC'); // Latest first
        return $this->db->get()->result();
    }


    public function getReviewsByProduct()
    {
        $this->db->select('pr.*, p.product_code AS productcode, p.product_name AS productname');
        $this->db->from('productreview pr');
        $this->db->join('products p', 'p.id = pr.product_id');
        $this->db->order_by('pr.id', 'DESC');
        return $this->db->get()->result();
    }

    public function updateReviewStatus($id, $status)
    {
        if ($id && in_array($status, ['approved', 'rejected'])) {
            $this->db->where('id', $id);
            return $this->db->update('shopfeedback', ['status' => $status]);
        }
        return false;
    }

    public function addCustomerFeedback($feedback)
    {
        $affectedRows = $this->db->insert('customer_feedback', $feedback);
        if ($affectedRows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllFeedbackCustomers()
    {
        $this->db->select('*');
        $this->db->from('customer_feedback');
        return $this->db->get()->result();
    }

    public function deletFeedbackById($id)
    {
        return $this->db->delete('customer_feedback', ['id' => $id]);
    }


    public function getAllPiercingAppointment()
    {
        $this->db->select('*');
        $this->db->from('piercingappointment');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }

    public function getAllReparingAppointment()
    {
        $this->db->select('*');
        $this->db->from('reparingappointment');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->result();
    }


    public function deletAppointmentById($id)
    {
        return $this->db->delete('piercingappointment', ['id' => $id]);
    }
    public function deletReparingAppointmentById($id)
    {
        return $this->db->delete('reparingappointment', ['id' => $id]);
    }



    public function getAllCategoriesAndSubCategories()
    {
        $this->db->select('c.name, c.type, s.group_type, s.name AS subName');
        $this->db->from('categories c');
        $this->db->join('subcategories s', 'c.id = s.category_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllMeetSchedulesWithCustomer()
    {
        $this->db->select('astrogems_meet_schedule.*, customers.*');
        $this->db->from('astrogems_meet_schedule');
        $this->db->join('customers', 'customers.id = astrogems_meet_schedule.customer_id', 'left');
        $this->db->order_by('astrogems_meet_schedule.id', 'DESC');

        return $this->db->get()->result();
    }

    public function getSchemesBy11_1()
    {
        $this->db->select('c.email, c.name, s.mobile, s.amount, s.category, s.type, s.created_at');
        $this->db->from('schemes s');
        $this->db->join('customers c', 's.customer_id = c.id');
        $this->db->where('s.type', '11+1');
        $this->db->order_by('s.created_at', 'DESC'); // Newest first
        $query = $this->db->get();
        return $query->result();
    }

    public function getSchemesBy12_0()
    {
        $this->db->select('c.email, c.name, s.mobile, s.amount, s.category, s.type, s.created_at');
        $this->db->from('schemes s');
        $this->db->join('customers c', 's.customer_id = c.id');
        $this->db->where('s.type', '12+0');
        $this->db->order_by('s.created_at', 'DESC'); // Newest first
        $query = $this->db->get();
        return $query->result();
    }

    public function getSchemesBy10_2()
    {
        $this->db->select('c.email, c.name, s.mobile, s.amount, s.category, s.type, s.created_at');
        $this->db->from('schemes s');
        $this->db->join('customers c', 's.customer_id = c.id');
        $this->db->where('s.type', '10+2');
        $this->db->order_by('s.created_at', 'DESC'); // Newest first
        $query = $this->db->get();
        return $query->result();
    }

    public function updateReparingStatus($id, $status)
    {
        return $this->db->where('id', $id)->update('reparingappointment', ['status' => $status]);
    }

    public function updatePiercingStatus($id, $status)
    {
        return $this->db->where('id', $id)->update('piercingappointment', ['status' => $status]);
    }

    public function getAstrologer()
    {
        return $this->db->get('astrologer')->row_array();
    }

    public function insertAstrologer($data)
    {
        return $this->db->insert('astrologer', $data);
    }

    public function updateAstrologer($id, $data)
    {
        return $this->db->where('id', $id)->update('astrologer', $data);
    }

    public function deleteAstrologer($id)
    {
        return $this->db->where('id', $id)->delete('astrologer');
    }

    public function getAllNotifications()
    {
        return $this->db->order_by('id', 'DESC')->get('notification')->result();
    }


    public function markNotificationAsRead($id)
    {
        if (!empty($id)) {
            $this->db->where('id', $id);
            return $this->db->update('notification', ['status' => 'read']);
        }
        return false;
    }
    public function markAllAsRead()
    {
        $this->db->where('status', 'unread');
        return $this->db->update('notification', ['status' => 'read']);
    }

    public function getNotificationsCount()
    {
        $this->db->where('status !=', 'read');
        return $this->db->count_all_results('notification');
    }

}

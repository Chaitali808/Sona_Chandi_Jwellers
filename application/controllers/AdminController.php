<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
{
	private $rates = [
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
		$this->load->model('AdminModel'); // ✅ Load AdminModel here
		$this->load->helper(array('url', 'form'));
	}

	public function index()
	{

		$this->load->view('Admin/welcome_message');
	}
	public function dashboard()
	{
		$data['banners'] = $this->AdminModel->getAllBanners();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/dashboard', $data);
	}

	public function product()
	{
		$this->load->model('AdminModel'); // ensure model is loaded
		$data['categories'] = $this->AdminModel->getAllCategories();

		$data['products'] = $this->AdminModel->getAllProducts();

		foreach ($data['products'] as &$product) {
			// Decode JSON fields
			$product->type = !empty($product->type) ? json_decode($product->type) : [];
			$product->categories = !empty($product->categories) ? json_decode($product->categories) : [];

			// Load multiple images for each product
			$product->images = $this->AdminModel->getProductImages($product->id);
		}

		$data['rates'] = $this->rates;


		$data['subcategory'] = $this->AdminModel->getAllCategoriesAndSubCategories();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/product', $data);
	}

	public function addProduct()
	{
		// Initialize
		$this->load->library('form_validation');
		$this->form_validation->set_rules('product_name', 'Product Name', 'required');
		$this->form_validation->set_rules('product_code', 'Product ID', 'required|is_unique[products.product_code]');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'status' => 'error',
				'message' => validation_errors()
			]);
			return;
		}

		// Weight handling
		$weights = [];
		$types = ["Gold", "Silver", "Diamond", "Astrogems", "Platinum"];
		$hasWeight = false;

		foreach ($types as $type) {
			// Check both suffixed and non-suffixed versions
			$weightKey = 'weight_' . strtolower($type);
			$weight = $this->input->post($weightKey);

			// If no suffixed version found, check non-suffixed version for single type
			if (empty($weight) && count($this->input->post('type')) === 1) {
				$weight = $this->input->post('weight');
			}

			if (!empty($weight) && is_numeric($weight)) {
				$weights[$type] = (float) $weight;
				$hasWeight = true;
			}
		}

		if (!$hasWeight) {
			echo json_encode([
				'status' => 'error',
				'message' => 'At least one weight value is required'
			]);
			return;
		}

		// Carat Handling
		$carats = [];
		foreach ($types as $type) {
			$caratKey = 'carat_' . strtolower($type);
			$carat = $this->input->post($caratKey);

			// Allow carat for types like Diamond and Astrogems
			if (!empty($carat) && is_numeric($carat)) {
				$carats[$type] = (float) $carat;
			}
		}

		$making_charges = (float) $this->input->post('making_charges') ?? 0;
		$gst = (float) $this->input->post('gst') ?? 0;
		$discount = (float) $this->input->post('discount_percentage') ?? 0;
		$other_charges = (float) $this->input->post('other_charges') ?? 0;

		// Prepare data
		$data = [
			'product_name' => $this->input->post('product_name'),
			'product_code' => $this->input->post('product_code'),
			'description' => $this->input->post('description'),
			'size' => $this->input->post('size'),
			'length' => $this->input->post('length'),
			'height' => $this->input->post('height'),
			'width' => $this->input->post('width'),
			'making_charges' => $making_charges,
			'gst' => $gst,
			'discount_percentage' => $discount,
			'other_charges' => $other_charges,
			'weight' => json_encode($weights),
			'carat' => json_encode($carats),
			'categories' => json_encode($this->input->post('categories') ?? []),
			'subcategories' => json_encode(
				array_map(function ($val) {
					return str_replace(' ', '-', $val);
				}, $this->input->post('subcategories') ?? [])
			),
			'type' => json_encode($this->input->post('type') ?? []),
			'tags' => $this->input->post('tags'),
			'seo_title' => $this->input->post('seo_title'),
			'seo_description' => $this->input->post('seo_description'),
			'created_at' => date('Y-m-d H:i:s')
		];

		// Handle image upload (from your original code)
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);

		if (!empty($_FILES['main_image']['name'])) {
			if ($this->upload->do_upload('main_image')) {
				$img = $this->upload->data();
				$data['image'] = 'uploads/' . $img['file_name'];
			} else {
				echo json_encode([
					'status' => 'error',
					'message' => $this->upload->display_errors()
				]);
				return;
			}
		}

		// Insert product
		$product_id = $this->AdminModel->insertProduct($data);

		if (!$product_id) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to save product'
			]);
			return;
		}

		// Handle gallery images
		if (!empty($_FILES['images']['name'][0])) {
			foreach ($_FILES['images']['name'] as $key => $val) {
				$_FILES['file']['name'] = $_FILES['images']['name'][$key];
				$_FILES['file']['type'] = $_FILES['images']['type'][$key];
				$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
				$_FILES['file']['error'] = $_FILES['images']['error'][$key];
				$_FILES['file']['size'] = $_FILES['images']['size'][$key];

				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$imgData = $this->upload->data();
					$this->AdminModel->insertProductImage([
						'product_id' => $product_id,
						'image_path' => 'uploads/' . $imgData['file_name'],
						'created_at' => date('Y-m-d H:i:s')
					]);
				}
			}
		}

		echo json_encode([
			'status' => 'success',
			'product_id' => $product_id
		]);
	}

	public function getProductById()
	{
		$id = $this->input->post('id');
		$product = $this->AdminModel->getProduct($id);

		// Ensure type is properly formatted as an array
		if (!empty($product->type)) {
			if (!is_array($product->type)) {
				$product->type = json_decode($product->type, true);
			}
		} else {
			$product->type = [];
		}

		echo json_encode($product);
	}

	public function updateProduct()
	{
		$product_id = $this->input->post('product_id');
		$removed_images = json_decode($this->input->post('removed_images'), true);

		// Remove images if marked
		if (!empty($removed_images)) {
			$this->AdminModel->deleteProductImages($removed_images);
		}

		// ✅ Prepare weight JSON
		$types = ["Gold", "Silver", "Diamond", "Astrogems", "Platinum"];
		$weights = [];

		foreach ($types as $type) {
			$key = 'weight_' . strtolower($type);
			$weight = $this->input->post($key);
			if (!empty($weight) && is_numeric($weight)) {
				$weights[$type] = (float) $weight;
			}
		}
		$carats = [];
		foreach ($types as $type) {
			$caratKey = 'carat_' . strtolower($type);
			$carat = $this->input->post($caratKey);

			if (!empty($carat) && is_numeric($carat)) {
				$carats[$type] = (float) $carat;
			}
		}

		// ✅ Collect form data
		$data = [
			'product_name' => $this->input->post('product_name'),
			'product_code' => $this->input->post('product_code'),
			'description' => $this->input->post('description'),
			'size' => $this->input->post('size'),
			'length' => $this->input->post('length'),
			'height' => $this->input->post('height'),
			'width' => $this->input->post('width'),
			'making_charges' => (float) $this->input->post('making_charges') ?: 0,
			'gst' => (float) $this->input->post('gst') ?: 0,
			'discount_percentage' => (float) $this->input->post('discount_percentage') ?: 0,
			'other_charges' => (float) $this->input->post('other_charges') ?: 0,
			// 'categories' => json_encode($this->input->post('categories') ?: []),
			// 'type' => json_encode($this->input->post('type') ?: []),
			'tags' => $this->input->post('tags'),
			'seo_title' => $this->input->post('seo_title'),
			'seo_description' => $this->input->post('seo_description'),
			'weight' => json_encode($weights),
			'carat' => json_encode($carats),

			'updated_at' => date('Y-m-d H:i:s')
		];

		// ✅ Handle main image update
		if (!empty($_FILES['main_image']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('main_image')) {
				$img = $this->upload->data();
				$data['image'] = 'uploads/' . $img['file_name'];

				// Optional: remove old image from disk
				$old_image = $this->AdminModel->getProductImagePath($product_id);
				if ($old_image && file_exists($old_image)) {
					unlink($old_image);
				}
			}
		}

		// ✅ Update product
		$this->AdminModel->updateProduct($product_id, $data);

		// ✅ Handle new gallery uploads
		if (!empty($_FILES['images']['name'][0])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
			$config['max_size'] = 2048;
			$this->load->library('upload', $config);

			foreach ($_FILES['images']['name'] as $key => $val) {
				$_FILES['file']['name'] = $_FILES['images']['name'][$key];
				$_FILES['file']['type'] = $_FILES['images']['type'][$key];
				$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$key];
				$_FILES['file']['error'] = $_FILES['images']['error'][$key];
				$_FILES['file']['size'] = $_FILES['images']['size'][$key];

				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$imgData = $this->upload->data();
					$this->AdminModel->insertProductImage([
						'product_id' => $product_id,
						'image_path' => 'uploads/' . $imgData['file_name'],
						'created_at' => date('Y-m-d H:i:s')
					]);
				}
			}
		}

		echo json_encode(['status' => 'success']);
	}

	public function removeImages()
	{
		$imageIds = json_decode($this->input->post('image_ids'), true);
		if (!empty($imageIds)) {
			$deleted = $this->AdminModel->deleteProductImages($imageIds);
			echo json_encode(['status' => $deleted ? 'success' : 'error']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No images selected']);
		}
	}
	public function toggleCategory()
	{
		$name = trim($this->input->post('name'));
		$this->load->model('AdminModel');

		if ($name == '') {
			echo json_encode(['success' => false, 'message' => 'Category name is required']);
			return;
		}

		$existing = $this->AdminModel->getCategoryByName($name);

		if ($existing) {
			$this->AdminModel->deleteCategoryById($existing->id);
			echo json_encode(['success' => true, 'action' => 'deleted', 'id' => $existing->id]);
		} else {
			$id = $this->AdminModel->insertCategory($name);
			echo json_encode(['success' => true, 'action' => 'added', 'id' => $id]);
		}
	}


	public function deleteProduct()
	{
		$id = $this->input->post('id');
		$deleted = $this->AdminModel->deleteProductById($id);

		if ($deleted) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Delete failed.']);
		}
	}
	public function filterProducts()
	{
		$this->load->model('AdminModel');

		// Get filter parameters
		$product_code = $this->input->post('product_code');  // updated key name
		$type = $this->input->post('type');
		$category = $this->input->post('category');

		// Filter products
		$filteredProducts = $this->AdminModel->getFilteredProducts($product_code, $type, $category);

		// Process the data for display
		foreach ($filteredProducts as &$product) {
			$product->type = !empty($product->type) ? json_decode($product->type) : [];
			$product->categories = !empty($product->categories) ? json_decode($product->categories) : [];
			$product->images = $this->AdminModel->getProductImages($product->id);
		}

		// Return JSON response
		echo json_encode([
			'status' => 'success',
			'products' => $filteredProducts
		]);
	}

	public function getProductImages()
	{
		$product_id = $this->input->post('product_id');
		$images = $this->AdminModel->getProductImages($product_id);
		echo json_encode($images);
	}


	public function profile()
	{
		$data['profile'] = $this->AdminModel->getAdminProfile();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/profile', $data);
	}

	//to update the admin profile
	public function updateAdminProfile($id)
	{
		$data = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'dob' => $this->input->post('dob'),
			'email' => $this->input->post('email'),
			'phone_number' => $this->input->post('phone_number'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'country' => $this->input->post('country'),
			'city' => $this->input->post('city'),
		];

		if (!empty($_FILES['profile_img']['name'])) {
			$fileName = $_FILES['profile_img']['name'];
			$uploadPath = FCPATH . 'uploads/' . $fileName;

			if (move_uploaded_file($_FILES['profile_img']['tmp_name'], $uploadPath)) {
				$data['profile_img'] = $fileName;
			} else {
				echo json_encode(['success' => false, 'message' => 'Image upload failed.']);
				return;
			}
		}

		if ($this->AdminModel->updateAdminProfile($id, $data)) {
			echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to update profile.']);
		}
	}


	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$admin = $this->AdminModel->checkLogin($email, $password);

			if ($admin) {
				$this->session->set_userdata([
					'email' => $admin->email,
				]);
				redirect('AdminController/dashboard');
			} else {
				$this->session->set_flashdata('error', 'Username and password do not match');
				redirect('AdminController/login'); // Redirect to show flash message
			}
		} else {
			$this->load->view('Admin/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		redirect('AdminController/login');
	}

	public function uploadBannerAjax()
	{
		if (!empty($_FILES['banner_image']['name'])) {
			$config['upload_path'] = './uploads/hearo_banners/';
			$config['allowed_types'] = 'jpg|jpeg|png|webp';
			$config['file_name'] = time() . '_' . $_FILES['banner_image']['name'];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('banner_image')) {
				$uploadData = $this->upload->data();
				$fileName = $uploadData['file_name'];

				$banner_id = $this->AdminModel->insertBanner($fileName);

				echo '<div class="col-md-3 p-2 banner-card" data-id="' . $banner_id . '">
                        <div class="card">

                          <img src="' . base_url('uploads/hearo_banners/' . $fileName) . '" class="card-img-top" height="200" width="100%">
							 <div class="card-footer text-center">

                                <button type="button" class="btn btn-sm mx-1 btn-danger" onclick="deleteBanner(' . $banner_id . ')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
					
					';
			} else {
				http_response_code(400);
				echo "Upload failed";
			}
		}
	}

	public function deleteBannerAjax($id)
	{
		$banner = $this->AdminModel->getBanner($id);
		if ($banner && file_exists('./uploads/hearo_banners/' . $banner->image)) {
			unlink('./uploads/hearo_banners/' . $banner->image);
		}

		$this->AdminModel->deleteBanner($id);
		echo 'deleted';
	}

	//to show the all orders
	public function orders()
	{
		$data['orders'] = $this->db->select('orders.*, customers.name as customer_name')
			->from('orders')
			->join('customers', 'customers.id = orders.customer_id')
			->order_by('orders.id', 'DESC')
			->get()
			->result();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();

    $this->load->view('Admin/orders', $data);
}
// public function viewOrder($orderId)
// {
//     $order = $this->db->get_where('orders', ['id' => $orderId])->row();
//     $order->customer = $this->db->get_where('customers', ['id' => $order->customer_id])->row();
//     $order->items = $this->db->get_where('order_items', ['order_id' => $orderId])->result();

	//     $data['order'] = $order;
//     $this->load->view('admin/order_details', $data);
// }

	public function updateOrderStatus()
	{
		$orderId = $this->input->post('order_id');
		$status = $this->input->post('status');

		if ($orderId && $status) {
			$this->db->where('id', $orderId)->update('orders', ['status' => $status]);
			echo json_encode(['status' => 'success', 'message' => 'Order status updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Invalid data provided.']);
		}
	}

	public function OrderDetails()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/orderDetails');
	}

	public function custPlanDetails()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/custPlanDetails');
	}


	public function CustGoldCoin()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/custgoldcoin');
	}
	public function cust()
	{
		$data['customers'] = $this->AdminModel->getAllCustomers();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/customer', $data);
	}


	public function deleteCustomerById()
	{
		$id = $this->input->post('id'); // ✅ Fetch from POST

		if ($id === null) {
			echo json_encode(['status' => 'error', 'message' => 'ID is missing']);
			return;
		}

		$deleted = $this->AdminModel->deleteCustomer($id);

		if ($deleted) {
			echo json_encode(['success' => true, 'message' => 'Customer deleted']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Delete failed']);
		}
	}



	public function rating()
	{
		$data['reviews'] = $this->AdminModel->getReviewsWithCustomerNames();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/rating2', $data);
	}

	public function updateReviewStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		if ($this->AdminModel->updateReviewStatus($id, $status)) {
			echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Update failed']);
		}
	}
	public function j()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/j');
	}
	public function k()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/k');
	}

	//load the customer feedback entry page 
	public function feedback()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/feedback', $data);
	}
	//For Submiting the customer feedback entry
	public function addFeedbackForm()
	{
		$date = $this->input->post('date');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$purpose = $this->input->post('purpose');
		$feedback = $this->input->post('feedback');
		$in_time = $this->input->post('in_time');
		$out_time = $this->input->post('out_time');
		$dob = $this->input->post('dob');

		$feedbackData = array(
			'customer_name' => $name,
			'email' => $email,
			'mobile' => $phone,
			'feedback_date' => $date,
			'dob' => $dob,
			'in_time' => $in_time,
			'out_time' => $out_time,
			'purpose' => $purpose,
			'feedback' => $feedback
		);

		$this->load->model('AdminModel');
		$inserted = $this->AdminModel->addCustomerFeedback($feedbackData);

		if ($inserted) {
			$response['success'] = true;
			$response['message'] = "Feedback Entry Added!";
		} else {
			$response['message'] = "Failed to add feedback. Please try again.";
		}

		echo json_encode($response);
	}

	public function AllFeedback()
	{
		$data['customers'] = $this->AdminModel->getAllFeedbackCustomers();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/AllFeedback', $data);
	}

	public function deletFeedbackById()
	{
		$id = $this->input->post('id');
		if ($id) {
			$deleted = $this->AdminModel->deletFeedbackById($id);

			if ($deleted) {
				echo json_encode([
					'success' => true,
					'message' => 'Feedback deleted successfully.'
				]);
			} else {
				echo json_encode([
					'success' => false,
					'message' => 'Failed to delete Feedback.'
				]);
			}
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Invalid feedback ID.'
			]);
		}
	}
	public function base()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/base');
	}

	public function Scheme11_1()
	{
		$data['schemes'] = $this->AdminModel->getSchemesBy11_1();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/scheme1', $data);
	}
	public function Scheme10_2()
	{
		$data['schemes'] = $this->AdminModel->getSchemesBy10_2();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/scheme2', $data);
	}
	public function Scheme12_0()
	{

		$data['schemes'] = $this->AdminModel->getSchemesBy12_0();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/scheme3', $data);
	}


	public function Piercing()
	{
		$data['piercings'] = $this->AdminModel->getAllPiercingAppointment();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/AllPiercing', $data);
	}

	public function AstrlogerAppointment()
	{
		$data['appointment'] = $this->AdminModel->getAllMeetSchedulesWithCustomer();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/AstrlogerAppointment', $data);
	}

	public function Repairing()
	{
		$data['piercings'] = $this->AdminModel->getAllReparingAppointment();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/AllReparing', $data);
	}

	public function deletAppointmentById()
	{
		$id = $this->input->post('id');
		if ($id) {
			$deleted = $this->AdminModel->deletAppointmentById($id);

			if ($deleted) {
				echo json_encode([
					'success' => true,
					'message' => 'Appointment deleted successfully.'
				]);
			} else {
				echo json_encode([
					'success' => false,
					'message' => 'Failed to delete Appointment.'
				]);
			}
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Invalid feedback ID.'
			]);
		}
	}

	public function deletReparingAppointmentById()
	{
		$id = $this->input->post('id');
		if ($id) {
			$deleted = $this->AdminModel->deletReparingAppointmentById($id);

			if ($deleted) {
				echo json_encode([
					'success' => true,
					'message' => 'Appointment deleted successfully.'
				]);
			} else {
				echo json_encode([
					'success' => false,
					'message' => 'Failed to delete Appointment.'
				]);
			}
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Invalid feedback ID.'
			]);
		}
	}
	public function category()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/Category');
	}

	// Get all categories & subcategories
	public function ManageCategories()
	{
		$data['categories'] = $this->db->get('categories')->result();
		$data['subcategories'] = $this->db->get('subcategories')->result();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/managecat', $data);
	}

	// Add category
	public function addCategory()
	{
		$name = $this->input->post('name');
		$type = $this->input->post('type'); // 👈 new

		if ($name && $type) {
			$this->db->insert('categories', [
				'name' => $name,
				'type' => $type
			]);
			echo json_encode(['success' => true, 'message' => 'Category added']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Name and type required']);
		}
	}


	// Delete category
	public function deleteCategory()
	{
		$id = $this->input->post('id');
		if ($id) {
			$this->db->delete('categories', ['id' => $id]);
			$this->db->delete('subcategories', ['category_id' => $id]); // cascade delete
			echo json_encode(['success' => true]);
		}
	}

	// Add subcategory
	public function addSubcategory()
	{
		$category_id = $this->input->post('category_id');
		$name = $this->input->post('name');
		$group_type = $this->input->post('group_type');

		if ($category_id && $name && $group_type) {
			$this->db->insert('subcategories', [
				'category_id' => $category_id,
				'name' => $name,
				'group_type' => $group_type
			]);
			echo json_encode(['success' => true, 'message' => 'Subcategory added']);
		} else {
			echo json_encode(['success' => false, 'message' => 'All fields required']);
		}
	}

	// Delete subcategory
	public function deleteSubcategory()
	{
		$id = $this->input->post('id');
		if ($id) {
			$this->db->delete('subcategories', ['id' => $id]);
			echo json_encode(['success' => true]);
		}
	}

	public function Productrating()
	{
		$data['reviews'] = $this->AdminModel->getReviewsByProduct();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/Productrating', $data);

	}

	public function updateReparingStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		if (!$id || !$status) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
			return;
		}

		$result = $this->AdminModel->updateReparingStatus($id, $status);

		if ($result) {
			echo json_encode(['status' => 'success', 'message' => 'Status updated successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update status.']);
		}
	}

	public function updatePiercingStatus()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		if ($this->AdminModel->updatePiercingStatus($id, $status)) {
			echo json_encode(['status' => 'success', 'message' => 'Status updated successfully!']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to update status.']);
		}
	}

	public function Astrologer()
	{
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/Astrologer', $data);
	}

	public function getAstrologer()
	{
		$data = $this->AdminModel->getAstrologer();
		echo json_encode($data);
	}

	public function addAstrologer()
	{
		$data = [
			'name' => $this->input->post('name'),
			'experience' => $this->input->post('experience'),
			'expertise' => $this->input->post('expertise'),
			'mobile' => $this->input->post('mobile'),
			'whatsapp' => $this->input->post('whatsapp'),
			'email' => $this->input->post('email'),
			'charges' => $this->input->post('charges'),
		];
		$this->AdminModel->insertAstrologer($data);
		echo json_encode(['message' => 'Astrologer added successfully']);
	}

	public function updateAstrologer()
	{
		$id = $this->input->post('id');
		$data = [
			'name' => $this->input->post('name'),
			'experience' => $this->input->post('experience'),
			'expertise' => $this->input->post('expertise'),
			'mobile' => $this->input->post('mobile'),
			'whatsapp' => $this->input->post('whatsapp'),
			'email' => $this->input->post('email'),
			'charges' => $this->input->post('charges'),
		];
		$this->AdminModel->updateAstrologer($id, $data);
		echo json_encode(['message' => 'Astrologer updated successfully']);
	}

	public function deleteAstrologer()
	{
		$id = $this->input->post('id');
		$this->AdminModel->deleteAstrologer($id);
		echo json_encode(['message' => 'Astrologer deleted successfully']);
	}

	public function ManageAstrogames()
	{
		$data['astrogames'] = $this->db->get('birthstones')->result_array();
		$data['notifications'] = $this->AdminModel->getAllNotifications();
		$data['notificationsCount'] = $this->AdminModel->getNotificationsCount();
		$this->load->view('Admin/manageastro', $data);
	}
	public function save_astrogame()
	{
		$id = $this->input->post('id');

		// Prepare descriptions array as JSON
		$descriptionArray = $this->input->post('description');
		$descriptionJSON = json_encode($descriptionArray, JSON_UNESCAPED_UNICODE); // safer encoding

		$data = [
			'month' => $this->input->post('month'),
			'gemstone_name' => $this->input->post('gemstone_name'),
			'description' => $descriptionJSON,
		];

		// Handle image upload
		if (!empty($_FILES['image']['name'])) {
			$uploadPath = './uploads/Astrogames';
			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0755, true); // create folder if not exists
			}

			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('image')) {
				$imgData = $this->upload->data();
				$data['image_path'] = 'uploads/Astrogames/' . $imgData['file_name'];
			} else {
				// Optional: flash error message
				$this->session->set_flashdata('upload_error', $this->upload->display_errors());
				redirect('AdminController/ManageAstrogames');
				return;
			}
		} else {
			$data['image_path'] = $this->input->post('old_image');
		}

		// Insert or update
		if ($id) {
			$this->db->where('id', $id)->update('birthstones', $data);
		} else {
			$this->db->insert('birthstones', $data);
		}

		redirect('AdminController/ManageAstrogames');
	}

	public function delete_astrogame($id)
	{
		$this->db->delete('birthstones', ['id' => $id]);
		redirect('AdminController/ManageAstrogames');
	}

	public function updateCategory()
	{
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$type = $this->input->post('type');

		if (!$id || !$name || !$type) {
			echo json_encode(['success' => false, 'message' => 'Invalid input']);
			return;
		}

		$data = [
			'name' => $name,
			'type' => $type
		];

		$this->db->where('id', $id)->update('categories', $data);

		echo json_encode(['success' => true]);
	}



	public function NotificationMarkAsRead()
	{
		$id = $this->input->post('id');

		if ($this->AdminModel->markNotificationAsRead($id)) {
			echo 'success';
		} else {
			echo 'error';
		}
	}



	public function markAllNotificationsRead()
	{
		$this->load->model('AdminModel');

		// Call model method to update statuses
		$updated = $this->AdminModel->markAllAsRead();

		if ($updated) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error']);
		}
	}

}

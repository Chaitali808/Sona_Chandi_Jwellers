<?php

defined("BASEPATH") or exit("No Direct Script Access Aloowed");

class UserController extends CI_Controller
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

    // private $rates = [
    //     'gold' => [
    //         '24k' => 6000,
    //         '22k' => 5800,
    //         '18k' => 4500
    //     ],
    //     'platinum' => 5100,
    //     'silver' => 80,
    //     'diamond' => 12000
    // ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');       // Load your model
        $this->load->library(['session', 'email', 'form_validation']);
        $this->load->helper(['url', 'form']);

        $this->load->library('Razorpay_lib');
    }


    public function checkEmailUnique()
    {
        $email = $this->input->post('email');

        $exists = $this->db->where('email', $email)->get('customers')->num_rows();

        echo json_encode(['unique' => $exists === 0]);
    }


    public function send_registration_otp()
    {
        $email = $this->input->post('email');
        $contact = $this->input->post('contact');



        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Configure email
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'someshwarkanthale0@gmail.com',
            'smtp_pass' => 'pdbl innz vshk flod',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'smtp_crypto' => 'tls'
        ];
        $this->email->initialize($config);

        // Send OTP email
        $this->email->from('someshwarkanthale0@gmail.com', 'SonaChandi');
        $this->email->to($email);
        $this->email->subject('Your Registration OTP');
        $this->email->message("Your OTP for registration is: <strong>$otp</strong>");

        if ($this->email->send()) {
            // Store OTP and data in session for verification
            $this->session->set_userdata([
                'reg_otp_' . $email => $otp,
                'reg_otp_time_' . $email => time(),
                'reg_temp_email' => $email,
                'reg_temp_contact' => $contact
            ]);

            echo json_encode([
                'status' => 'success',
                'message' => 'OTP sent successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again.'
            ]);
        }
    }
    public function verify_registration_otp()
    {
        $email = $this->session->userdata('reg_temp_email');
        $otp = $this->input->post('otp');
        $storedOtp = $this->session->userdata('reg_otp_' . $email);

        if (!$email || !$storedOtp) {
            echo json_encode([
                'status' => 'error',
                'message' => 'OTP session expired. Please request a new OTP.'
            ]);
            return;
        }

        if ($storedOtp != $otp) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid OTP. Please try again.'
            ]);
            return;
        }

        // All validations passed - register the user
        $loyaltyPoints = 50;
        $userData = [
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'dob' => $this->input->post('dob'),
            'email' => $email,
            'contact' => $this->session->userdata('reg_temp_contact'),
            'loyalty_points' => $loyaltyPoints,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($this->UserModel->register_user($userData)) {
            // ✅ Send welcome email with loyalty points
            $this->email->from('someshwarkanthale0@gmail.com', 'SonaChandi');
            $this->email->to($email);
            $this->email->subject('Welcome to SonaChandi - Registration Successful!');
            $this->email->message("
            <h2>Welcome to SonaChandi!</h2>
            <p>Hi <strong>{$userData['name']}</strong>,</p>
            <p>Thank you for registering with us.</p>
            <p>You have earned <strong>$loyaltyPoints Loyalty Points</strong> as a welcome gift! 🎉</p>
            <p>Use them on your next purchase and enjoy shopping!</p>
            <br>
            <p>Regards,<br>SonaChandi Team</p>
        ");
            $this->email->send();

            // ✅ Clear session data
            $this->session->unset_userdata([
                'reg_otp_' . $email,
                'reg_otp_time_' . $email,
                'reg_temp_email',
                'reg_temp_contact'
            ]);

            // ✅ Auto-login
            $this->db->where('email', $email);
            $customer = $this->db->get('customers')->row();

            if ($customer) {
                $this->session->set_userdata([
                    'user_email' => $customer->email,
                    'customer_id' => $customer->id
                ]);
            }

            // ✅ Response with redirect and loyalty info for SweetAlert
            echo json_encode([
                'status' => 'success',
                'message' => 'Registration successful!',
                'loyalty_points' => $loyaltyPoints,
                'redirect' => base_url('UserController/home')
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Registration failed. Please try again.'
            ]);
        }
    }




    // ✅ Send OTP for registration
    public function send_otp()
    {
        $email = $this->input->post('email');

        // Load user model and check if email is registered
        $this->load->model('UserModel');
        $user = $this->UserModel->get_user_by_email($email);

        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'Email not registered. Please register first.']);
            return;
        }



        // Generate OTP
        $otp = rand(100000, 999999);

        // Load and configure email
        $this->load->library('email');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'someshwarkanthale0@gmail.com',
            'smtp_pass' => 'pdbl innz vshk flod', // ⚠️ Use App Password, not your Gmail password
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'smtp_crypto' => 'tls'
        ];
        $this->email->initialize($config);

        // Set email content
        $this->email->from('someshwarkanthale0@gmail.com', 'SonaChandi');
        $this->email->to($email);
        $this->email->subject('Your Login OTP');
        $this->email->message("Your OTP is: <strong>$otp</strong>");

        // Send email
        if ($this->email->send()) {
            $this->session->set_userdata('otp_' . $email, $otp);
            $this->session->set_userdata('otp_time_' . $email, time());
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode([
                'status' => 'fail',
                'message' => 'Failed to send OTP. Try again.',
                'debug' => $this->email->print_debugger() // Optional: Remove in production
            ]);
        }
    }



    public function verify_otp()
    {
        $email = $this->input->post('email', true);
        $otp = $this->input->post('otp', true);
        $storedOtp = $this->session->userdata('otp_' . $email);

        // Check if OTP matches
        if ($storedOtp && $storedOtp == $otp) {
            $customer = $this->db->get_where('customers', ['email' => $email])->row();

            if ($customer) {
                // Set session data
                $this->session->set_userdata([
                    'user_email' => $customer->email,
                    'customer_id' => $customer->id
                ]);

                // ✅ Return success and redirect path to home
                echo json_encode([
                    'status' => 'success',
                    'redirect_url' => base_url('UserController/home')
                ]);
                return;
            } else {
                echo json_encode([
                    'status' => 'fail',
                    'message' => 'Customer not found'
                ]);
                return;
            }
        } else {
            echo json_encode([
                'status' => 'fail',
                'message' => 'Invalid or expired OTP'
            ]);
            return;
        }
    }

    // ✅ Logout
    public function logout()
    {
        $this->session->unset_userdata('user_email');
        $this->session->sess_destroy();
        redirect(base_url('UserController/home'));
    }


    // ✅ Profile View (session protected)
    public function profile()
    {
        if (!$this->session->userdata('user_email')) {
            redirect(base_url('UserController/home'));
        }

        $email = $this->session->userdata('user_email');
        $data['user'] = $this->db->get_where('customers', ['email' => $email])->row();
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();

        // Initialize defaults
        $likeCount = 0;
        $cartCount = 0;

        if ($this->session->userdata('customer_id')) {
            $customerId = $this->session->userdata('customer_id');

            // Fetch like/cart counts
            $likeCount = $this->UserModel->getLikeCountByCustomer($customerId);
            $cartCount = $this->UserModel->getCartCountByCustomer($customerId);

            // Fetch orders for the customer
            $data['orders'] = $this->db->where('customer_id', $customerId)
                ->order_by('order_date', 'desc')
                ->get('orders')
                ->result();
        } else {
            $data['orders'] = []; // Empty if not logged in as customer
        }

        $data['likeCount'] = $likeCount;
        $data['cartCount'] = $cartCount;

        $this->load->view("user/userprofile", $data);
    }

    // $email = $this->session->userdata('user_email');
    // $data['user'] = $this->db->get_where('customers', ['email' => $email])->row();
    // $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();

    // // Initialize defaults
    // $likeCount = 0;
    // $cartCount = 0;

    // if ($this->session->userdata('customer_id')) {
    //     $customerId = $this->session->userdata('customer_id');

    //     // Fetch like/cart counts
    //     $likeCount = $this->UserModel->getLikeCountByCustomer($customerId);
    //     $cartCount = $this->UserModel->getCartCountByCustomer($customerId);

    //     // Fetch orders for the customer
    //     $data['orders'] = $this->db->where('customer_id', $customerId)
    //                                ->order_by('order_date', 'desc')
    //                                ->get('orders')
    //                                ->result();
    // } else {
    //     $data['orders'] = []; // Empty if not logged in as customer
    // }

    // $data['likeCount'] = $likeCount;
    // $data['cartCount'] = $cartCount;

    // $this->load->view("User/userprofile", $data);
// }

    public function updateProfile()
    {
        // Check login
        $email = $this->session->userdata('user_email');
        if (!$email) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }

        // Get data from POST
        $name = $this->input->post('name');
        $contact = $this->input->post('contact');
        $address = $this->input->post('address');

        // Basic validation (optional)
        if (!$name || !$contact || !$address) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            return;
        }

        // Update DB
        $this->db->where('email', $email);
        $this->db->update('customers', [
            'name' => $name,
            'contact' => $contact,
            'address' => $address,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
    }


    function demo()
    {
        $this->load->view("common/demo");
    }
    function navbar()
    {
        $this->load->view("common/navbar");
    }
    function popup()
    {
        $this->load->view("common/popup");
    }

    function footer()
    {
        $this->load->view("common/footer");
    }

    function Home()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['heroBanner'] = $this->UserModel->getAllHeroBanner();
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
        $this->load->view("User/home", $data);
    }
    function login()
    {
        $this->load->view("User/userlogin");
    }

    //to show the all gold and silver coin : by Vivek
    function goldcoins()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['goldCoinProducts'] = $this->UserModel->getAllGoldCoinProducts();
        $data['rates'] = $this->rates;
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
        $this->load->view("User/goldcoins", $data);
        //$this->load->view("User/ProductDemo", $data);
    }

    //to show the details of add to cart gold and silver cart : by vivek
    function goldcoincart($id)
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['product'] = $this->UserModel->getProductById($id);
        $data['rates'] = $this->rates;
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
        $this->load->view("User/goldcoincart", $data);
    }

    // Product Cart Page
    public function productcart($id = null)
    {
        $customer_id = $this->session->userdata('customer_id') ?? 0;

        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['product'] = $this->UserModel->getProductById($id);
        $data['rates'] = $this->rates;

        $data['rating'] = $this->UserModel->getProductRatingById($id);
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

        // Check wishlist only if customer is logged in
        $data['isInWishlist'] = $customer_id ? $this->UserModel->isProductInWishlist($customer_id, $id) : false;
        $data['similarProducts'] = $this->UserModel->getRelatedProductForProductCart($id);
        $this->load->view("User/productcart", $data);
    }




    // Add to Wishlist
    public function addToWishlist()
    {
        $product_id = $this->input->post('product_id');
        $customer_id = $this->session->userdata('customer_id');

        if (!$customer_id) {
            echo json_encode(['status' => 'error', 'message' => 'Login first to add items to wishlist.']);
            return;
        }

        $this->UserModel->addToWishlist($customer_id, $product_id);
        echo json_encode(['status' => 'added', 'message' => 'Product added to your wishlist.']);
    }

    // Remove from Wishlist
    public function removeFromWishlist()
    {
        $product_id = $this->input->post('product_id');
        $customer_id = $this->session->userdata('customer_id');

        if (!$customer_id) {
            echo json_encode(['status' => 'error', 'message' => 'Login required.']);
            return;
        }

        $this->UserModel->removeFromWishlist($customer_id, $product_id);
        echo json_encode(['status' => 'removed', 'message' => 'Product removed from your wishlist.']);
    }


    function services()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("User/services", $data);
    }
    function scheme()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("User/scheme", $data);
    }
    public function submitSchemeForm()
    {
        // Check session for customer_id
        if (!$this->session->userdata('customer_id')) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Login required to submit subscription.'
            ]);
            return;
        }

        $json = json_decode(file_get_contents('php://input'), true);

        if (!$json) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
            return;
        }

        $data = [
            'customer_id' => $this->session->userdata('customer_id'),
            'mobile' => $json['mobileNumber'],
            'amount' => $json['monthlyAmount'],
            'category' => $json['category'],
            'type' => $json['schemeType'],
            'customer_id' => $json['customer_id'] = $this->session->userdata('customer_id')
        ];

        $inserted = $this->UserModel->saveSchemeForm($data);

        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Subscription saved successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to save subscription.']);
        }
    }

    function collections()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("User/collections", $data);
    }
    function Commonlinks()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("common/Commonlinks", $data);
    }

    public function submitAstroGemsMeetingAppointment()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || empty($input['meetingDate']) || empty($input['meetingTime'])) {
            echo json_encode(['status' => 'error', 'message' => 'Date and Time are required.']);
            return;
        }

        $data = [
            'customer_id' => $this->session->userdata('customer_id'),
            'date' => $input['meetingDate'],
            'time' => $input['meetingTime'],
            'description' => $input['description'] ?? '',
        ];

        $inserted = $this->UserModel->saveAstroGemsMeetingAppointment($data);

        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Meeting scheduled successfully.<br>Astrologer will contact you shortly.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to schedule meeting.']);
        }
    }

    function PiercingService()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("User/PiercingService", $data);
    }
    //to submit the form  Piercing Reparing Appointment : By Vivek
    public function submitPiercingAppointmentForm()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!$data) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid input data.'
            ]);
            return;
        }
        $inserted = $this->UserModel->savePiercingAppointment($data);
        if ($inserted) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Appointment request submitted! We will contact you shortly to confirm.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to submit appointment. Try again later.'
            ]);
        }
    }
    function RepairingService()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("User/RepairingService", $data);
    }

    public function submitReparingAppointmentForm()
    {
        // Get data from POST
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $jewelryType = $this->input->post('jewelry_type');
        $repairType = $this->input->post('repair_type');
        $description = $this->input->post('description');

        // Create data array for model
        $data = [
            'full_name' => $name,
            'mobile' => $phone,
            'jweleryType' => $jewelryType,
            'repairNeed' => $repairType,
            'description' => $description,
        ];

        $insertedId = $this->UserModel->saveReparingAppointment($data);

        // Set header and return JSON
        header('Content-Type: application/json');
        if ($insertedId) {
            echo json_encode([
                'status' => 'success',
                'tracking_id' => $insertedId
            ]);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    function ExchangeProgram()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("User/ExchangeProgram", $data);
    }
    function PaymentGateway()
    {
        $this->load->view("User/paymentgateway");
    }

    function finalcart()
    {
        $customer_id = $this->session->userdata('customer_id');
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['products'] = $this->UserModel->getFinalCartPagaData($customer_id);
        $data['rates'] = $this->rates;
        $data['customer_id'] = $customer_id;
        // Initialize defaults
        $likeCount = 0;
        $cartCount = 0;

        $likeCount = 0;
        $cartCount = 0;

        if ($customer_id) {
            $likeCount = $this->UserModel->getLikeCountByCustomer($customer_id);
            $cartCount = $this->UserModel->getCartCountByCustomer($customer_id);
            $data['loyaltyPoints'] = $this->UserModel->getLoyaltyPoints($customer_id); // ⭐ Added here
        } else {
            $data['loyaltyPoints'] = 0;
        }

        $data['likeCount'] = $likeCount;
        $data['cartCount'] = $cartCount;

        $this->load->view("User/finalcart", $data);
    }

    public function removeFromCart()
    {
        $product_id = $this->input->post('product_id');
        $customer_id = $this->input->post('customer_id');

        if ($product_id && $customer_id) {
            $this->db->where('product_id', $product_id);
            $this->db->where('customer_id', $customer_id);
            $deleted = $this->db->delete('add_to_cart');

            if ($deleted) {
                echo json_encode(['status' => 'success', 'message' => 'Product removed from cart.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to remove the product.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
        }
    }




    function wishlist()
    {
        $customer_id = $this->session->userdata('customer_id') ?? 0;

        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $data['rates'] = $this->rates;
        $data['products'] = $this->UserModel->getAllWishListProductsByCustomer($customer_id);
        $this->load->view("User/wishlist", $data);
    }

    function products()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
        $data['rates'] = $this->rates;
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
        $this->load->view("User/products", $data);
    }
    function gallery()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $data['testimonals'] = $this->UserModel->getApprovedTestimonal();
        $this->load->view("User/gallery", $data);
    }
    function LoyalityPoints()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view("User/LoyalityPoints", $data);
    }

    function feedback()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $this->load->view('User/feedback', $data);
    }



    // ✅ Registration form view
    public function registration()
    {
        $this->load->view("user/userlogin");
    }

    // ✅ Register new customer
    public function register_customer()
    {
        $email = $this->input->post('email');
        $exists = $this->db->where('email', $email)->get('customers')->row();
        $loyalty_points = $exists ? $exists->loyalty_points : 100;

        $data = [
            'name' => $this->input->post('name'),
            'address' => $this->input->post('address'),
            'email' => $email,
            'contact' => $this->input->post('contact'),
            'loyalty_points' => $loyalty_points,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!$exists) {
            if ($this->db->insert('customers', $data)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'fail']);
            }
        } else {
            echo json_encode(['status' => 'fail', 'message' => 'Already registered']);
        }
    }




    public function addToCart()
    {
        $product_id = $this->input->post('product_id');

        $customer_id = $this->session->userdata('customer_id');

        if (!$customer_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Login required to add product to wishlist.'
            ]);
            return;
        }
        if ($product_id) {
            $result = $this->UserModel->insertIntoCart($product_id, $customer_id);

            if ($result === 1) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Product successfully added to cart!"
                ]);
            } elseif ($result === 0) {
                echo json_encode([
                    "status" => "warning",
                    "message" => "Product is already in your cart."
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Something went wrong while adding to cart."
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid product ID"
            ]);
        }
    }

    public function dopayment()
    {

        // Read raw input and decode JSON
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Extract amount from decoded data
        $amount = isset($data['amount']) ? (int) $data['amount'] : 0;

        try {
            $razorpay_order = $this->razorpay_lib->create_order($amount * 100, 'ORD_' . rand(1000, 9999));
            if (!$razorpay_order) {
                throw new Exception('Failed to create Razorpay order');
            }

            echo json_encode([
                'status' => 'success',

                'amount' => $amount * 100, // Convert to paisa

                'key' => 'rzp_test_YcEtdZa9f7N8R6',

                // 'name'           => $user->username,
                // 'email'          => $user->email,
                // 'payment_type'   => $payment_method,
                // 'is_direct'      => $is_direct_purchase ? 'yes' : 'no' // Identify purchase type in response
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function dopaymentcheck()
    {
    }

    public function submitFeedback()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $rating = $this->input->post('rating');
        $message = $this->input->post('message');

        $data = [
            'name' => $name,
            'email' => $email,
            'rating' => $rating,
            'message' => $message,
            'submitted_at' => date('Y-m-d H:i:s')
        ];

        $result = $this->UserModel->insertFeedback($data);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function submitProductReview()
    {
        $name = $this->input->post('productFeedbackName', true);
        $rating = $this->input->post('productFeedbackExperienceRating', true);
        $review = $this->input->post('productFeedbackReview', true);
        $product_id = $this->input->post('product_id', true);

        $imageName = null;

        if (!empty($_FILES['productFeedbackImage']['name'])) {
            $uploadPath = './uploads/productReviewImages/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true); // Create the directory if not exists
            }

            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . preg_replace('/\s+/', '_', $_FILES['productFeedbackImage']['name']);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('productFeedbackImage')) {
                $uploadedData = $this->upload->data();
                $imageName = 'uploads/productReviewImages/' . $uploadedData['file_name'];
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Image upload failed: ' . $this->upload->display_errors('', '')]);
                return;
            }
        }

        $saved = $this->UserModel->saveProductReview($product_id, $name, $rating, $review, $imageName);

        if ($saved) {
            echo json_encode(['status' => 'success', 'message' => 'Thanks for your review!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to submit review.']);
        }
    }

    function astrogems()
    {
        $data['rates'] = $this->rates;
        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();
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
        $data['birthstones'] = $this->UserModel->get_all_birthstones();

        $data['likeCount'] = $likeCount;
        $data['cartCount'] = $cartCount;
        $data['astrolgerData'] = $this->UserModel->getAstrolgerData();
        $this->load->view("User/astrogems", $data);
    }

    public function PlaceOrder()
    {
        if (!$this->session->userdata('customer_id')) {
            $this->session->set_flashdata('error', 'Please login to proceed to checkout');
            redirect('UserController/login');
        }

        $customerId = $this->session->userdata('customer_id');

        try {
            $cartItems = $this->UserModel->getFinalCartPagaData($customerId);
            if (empty($cartItems)) {
                $this->session->set_flashdata('error', 'Your cart is empty');
                redirect('UserController/home');
            }

            $totalAmount = 0;
            $totalDiscount = 0;

            foreach ($cartItems as $item) {
                $quantity = (int) $item->qty;
                $weightData = json_decode($item->weight, true);
                $caratData = json_decode($item->carat, true);
                $basePrice = 0;

                foreach ($weightData as $metal => $weightGram) {
                    $metalLower = strtolower($metal);
                    $rate = 0;

                    // Determine rate based on metal type
                    if (isset($this->rates[$metalLower])) {
                        if ($metalLower === 'gold' && isset($caratData['Gold'])) {
                            $carat = $caratData['Gold']; // e.g., '22'
                            $rate = $this->rates['gold'][(string) $carat] ?? 0;
                        } elseif ($metalLower === 'silver' && isset($caratData['Silver'])) {
                            $purity = $caratData['Silver']; // e.g., '92.5'
                            $rate = $this->rates['silver'][(string) $purity] ?? 0;
                        } elseif ($metalLower === 'platinum' && isset($caratData['Platinum'])) {
                            $purity = $caratData['Platinum']; // e.g., '95.0'
                            $rate = $this->rates['platinum'][(string) $purity] ?? 0;
                        } elseif ($metalLower === 'diamond' && isset($caratData['Diamond'])) {
                            $grade = strtolower($caratData['Diamond']); // e.g., 'vvs1'
                            $rate = $this->rates['diamond'][$grade] ?? 0;
                        }
                    }

                    $basePrice += $weightGram * $rate;
                }

                $makingCharges = (float) $item->making_charges;
                $discountPercentage = (float) $item->discount_percentage;
                $gstPercentage = (float) $item->gst;
                $otherCharges = (float) $item->other_charges;
                $discountAmount = $makingCharges * $discountPercentage / 100;
                $discountedMaking = $makingCharges - $discountAmount;
                $subtotalWithDiscount = ($basePrice + $discountedMaking) * $quantity;
                $gstWithDiscount = $subtotalWithDiscount * $gstPercentage / 100;
                $finalWithDiscount = $subtotalWithDiscount + $gstWithDiscount;

                $totalAmount += $finalWithDiscount + $otherCharges;
                $totalDiscount += $discountAmount * $quantity;
            }

            $platformFee = 4;
            $totalAmount += $platformFee;

            $customer = $this->db->get_where('customers', ['id' => $customerId])->row();
            $loyaltyPoints = (int) $customer->loyalty_points;

            $usedLoyaltyPoints = $this->session->userdata('used_loyalty_points') ?? 0;
            $useLoyalty = $this->session->userdata('use_loyalty') ?? false;

            $loyaltyDiscount = $useLoyalty ? min($usedLoyaltyPoints, $totalAmount) : 0;
            $totalAmountAfterLoyalty = $totalAmount - $loyaltyDiscount;

            $data = [
                'navbarData' => $this->UserModel->getCategoryWithSubcategories(),
                'rates' => $this->rates,
                'likeCount' => $this->UserModel->getLikeCountByCustomer($customerId),
                'cartCount' => $this->UserModel->getCartCountByCustomer($customerId),
                'cartItems' => $cartItems,
                'totalAmount' => $totalAmount,
                'totalAmountAfterLoyalty' => $totalAmountAfterLoyalty,
                'totalDiscount' => $totalDiscount,
                'customer' => $customer,
                'loyaltyPoints' => $loyaltyPoints,
                'usedLoyaltyPoints' => $usedLoyaltyPoints,
                'loyaltyDiscount' => $loyaltyDiscount,
                'platformFee' => $platformFee,
            ];

            $this->load->view("User/PlaceOrder", $data);
        } catch (Exception $e) {
            log_message('error', 'Checkout Error: ' . $e->getMessage());
            $this->session->set_flashdata('error', 'An error occurred while processing your order');
            redirect('UserController/cart');
        }
    }



    public function createCodOrder()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if (
            empty($data->customer_id) ||
            empty($data->fullname) ||
            empty($data->contact) ||
            empty($data->address) ||
            empty($data->payment_method) ||
            empty($data->total_amount) ||
            empty($data->items) ||
            !is_array($data->items)
        ) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        $this->db->trans_start();

        $order_number = 'ORD' . time();

        $order = [
            'customer_id' => $data->customer_id,
            'order_number' => $order_number,
            'order_date' => date('Y-m-d H:i:s'),
            'total' => $data->total_amount,
            'status' => 'pending',
            'payment_method' => $data->payment_method,
            'shipping_name' => $data->fullname,
            'shipping_phone' => $data->contact,
            'shipping_address' => $data->address,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('orders', $order);
        $order_id = $this->db->insert_id();

        foreach ($data->items as $item) {
            $order_item = [
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name ?? '',
                'product_image' => $item->product_image ?? '',
                // 'quantity' => $item->quantity ?? 1,
                'unit_price' => $item->unit_price ?? 0,
                'final_price' => $item->final_price ?? 0,
                'metal_type' => $item->metal_type ?? '',
                'carat' => json_encode($item->carat ?? []),
                'weight' => json_encode($item->weight ?? []),
                'making_charges' => $item->making_charges ?? 0,
                'discount_percentage' => $item->discount_percentage ?? 0,
                'gst_percentage' => $item->gst_percentage ?? 0,
            ];
            $this->db->insert('order_items', $order_item);
        }

        $status = [
            'order_id' => $order_id,
            'status' => 'pending',
            'notes' => 'Order placed via COD',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('order_status_history', $status);

        // Remove from cart after successful order
        $this->db->where('customer_id', $data->customer_id)->delete('add_to_cart');

        // Check if loyalty points were used
        $used_loyalty_points = isset($data->used_loyalty_points) ? (int) $data->used_loyalty_points : 0;

        // Earned points from this order
        $earned_points = floor($data->total_amount * 0.01); // 1%

        if ($used_loyalty_points > 0) {
            // If loyalty points were used: reset to earned points only
            $this->db->set('loyalty_points', $earned_points);
        } else {
            // If not used: just add to existing
            $this->db->set('loyalty_points', 'loyalty_points + ' . $earned_points, false);
        }

        $this->db->where('id', $data->customer_id);
        $this->db->update('customers');


        // Fetch user email
        $user = $this->db->get_where('customers', ['id' => $data->customer_id])->row();

        if ($user && !empty($user->email)) {
            $this->load->library('email');
            $this->email->from('someshwarkanthale0@sonachandi.com', 'Sona Chandi Jewellers');
            $this->email->to($user->email);
            $this->email->subject('Order Confirmation - ' . $order_number);

            $message = "<p>Dear {$user->name},</p>";
            $message .= "<p>Thank you for your order <strong>{$order_number}</strong>.</p>";
            $message .= "<p>Total Amount: ₹{$data->total_amount}</p>";
            $message .= "<p>You have earned <strong>{$earned_points} loyalty points</strong> on this order.</p>";
            $message .= "<br><p>Regards,<br>Sona Chandi Jewellers</p>";

            $this->email->message($message);
            @$this->email->send(); // suppress errors
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Something went wrong while saving the order']);
        } else {
            echo json_encode(['status' => 'success', 'order_id' => $order_id]);
        }
    }
    public function orderSuccess($orderId)
    {
        // Clear loyalty points session data
        $this->session->unset_userdata(['use_loyalty', 'used_loyalty_points']);

        $data['navbarData'] = $this->UserModel->getCategoryWithSubcategories();

        // Initialize counts
        $likeCount = 0;
        $cartCount = 0;

        // Check if user is logged in
        if ($this->session->userdata('customer_id')) {
            $customerId = $this->session->userdata('customer_id');

            // Get user counts
            $likeCount = $this->UserModel->getLikeCountByCustomer($customerId);
            $cartCount = $this->UserModel->getCartCountByCustomer($customerId);

            // Verify order belongs to customer with complete details
            $order = $this->db->select('o.*, c.name as customer_name, c.email as customer_email')
                ->from('orders o')
                ->join('customers c', 'c.id = o.customer_id')
                ->where([
                    'o.id' => $orderId,
                    'o.customer_id' => $customerId
                ])
                ->get()
                ->row();

            if (!$order) {
                show_404();
            }

            // Get complete order items with product details
            $order->items = $this->db->select('
        oi.*, 
       p.*
    ')
                ->from('order_items oi')
                ->join('products p', 'p.id = oi.product_id')
                ->where('oi.order_id', $orderId)
                ->get()
                ->result();


            // Process item details for display
            foreach ($order->items as $item) {
                // Decode weight and carat data
                $weightData = json_decode($item->weight, true);
                $caratData = json_decode($item->carat, true);

                $item->metalType = !empty($weightData) ? array_keys($weightData)[0] : '';
                $item->metalWeight = !empty($weightData) ? $weightData[$item->metalType] : 0;
                $item->caratLabel = ($item->metalType == 'Gold' && !empty($caratData) && isset($caratData['Gold'])) ?
                    $caratData['Gold'] . 'K' : '';


                // Calculate discount amount if needed
                if ($item->discount_percentage > 0) {
                    $item->discount = ($item->making_charges * $item->discount_percentage / 100) * $item->quantity;
                }
            }

            $data['order'] = $order;
        } else {
            show_404();
        }

        $data['likeCount'] = $likeCount;
        $data['cartCount'] = $cartCount;

        $this->load->view('User/order_success', $data);
    }
    public function updateCartQuantity()
    {
        $product_id = $this->input->post('product_id');
        $customer_id = $this->input->post('customer_id');
        $quantity = $this->input->post('quantity');

        if (!$product_id || !$customer_id || !$quantity) {
            echo json_encode(['status' => 'error', 'message' => 'Missing data']);
            return;
        }

        $this->db->where(['product_id' => $product_id, 'customer_id' => $customer_id]);
        $updated = $this->db->update('add_to_cart', ['quantity' => $quantity]);

        if ($updated) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Update failed']);
        }
    }
    public function setLoyaltyUsage()
    {
        $this->session->set_userdata([
            'use_loyalty' => $this->input->post('use_loyalty'),
            'used_loyalty_points' => $this->input->post('points')
        ]);
        echo json_encode(['status' => 'success']);
    }
    // Add these methods to your UserController

    public function createOrderRecord()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if (empty($data->customer_id) || empty($data->items)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        $this->db->trans_start();

        $order_number = 'ORD' . time();

        $order = [
            'customer_id' => $data->customer_id,
            'order_number' => $order_number,
            'order_date' => date('Y-m-d H:i:s'),
            'total' => $data->total_amount,
            'status' => 'pending_payment',
            'payment_method' => $data->payment_method,
            'shipping_name' => $data->fullname,
            'shipping_phone' => $data->contact,
            'shipping_address' => $data->address,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('orders', $order);
        $order_id = $this->db->insert_id();

        foreach ($data->items as $item) {
            $order_item = [
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name ?? '',
                'product_image' => $item->product_image ?? '',
                'quantity' => $item->quantity ?? 1,
                'unit_price' => $item->unit_price ?? 0,
                'final_price' => $item->final_price ?? 0,
                'metal_type' => $item->metal_type ?? '',
                'carat' => json_encode($item->carat ?? []),
                'weight' => json_encode($item->weight ?? []),
                'making_charges' => $item->making_charges ?? 0,
                'discount_percentage' => $item->discount_percentage ?? 0,
                'gst_percentage' => $item->gst_percentage ?? 0,
            ];
            $this->db->insert('order_items', $order_item);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create order record']);
        } else {
            echo json_encode([
                'status' => 'success',
                'order_id' => $order_id,
                'order_amount' => $data->total_amount
            ]);
        }
    }

    public function createRazorpayOrder()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if (empty($data->amount) || empty($data->order_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            return;
        }

        try {
            // Create Razorpay order
            $razorpay_order = $this->razorpay_lib->create_order(
                $data->amount * 100, // Convert to paise
                'ORD_' . $data->order_id
            );

            if (!$razorpay_order) {
                throw new Exception('Failed to create Razorpay order');
            }

            // Update our order record with Razorpay order ID
            $this->db->where('id', $data->order_id)
                ->update('orders', [
                    'razorpay_order_id' => $razorpay_order->id,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            echo json_encode([
                'status' => 'success',
                'razorpay_order_id' => $razorpay_order->id
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function verifyPayment()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if (empty($data->razorpay_payment_id) || empty($data->razorpay_order_id) || empty($data->order_id)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing payment verification data']);
            return;
        }

        $this->db->trans_start();

        try {
            // Verify the payment signature
            $is_valid = $this->razorpay_lib->verify_payment_signature(
                $data->razorpay_order_id,
                $data->razorpay_payment_id,
                $data->razorpay_signature
            );

            if (!$is_valid) {
                throw new Exception('Invalid payment signature');
            }

            // Update order status
            $this->db->where('id', $data->order_id)
                ->update('orders', [
                    'status' => 'processing',
                    'payment_id' => $data->razorpay_payment_id,
                    'payment_status' => 'captured',
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            // Add status history
            $this->db->insert('order_status_history', [
                'order_id' => $data->order_id,
                'status' => 'processing',
                'notes' => 'Payment received via Razorpay',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Clear cart
            $customer_id = $this->db->select('customer_id')
                ->where('id', $data->order_id)
                ->get('orders')
                ->row()
                ->customer_id;
            $this->db->where('customer_id', $customer_id)
                ->delete('add_to_cart');

            // Handle loyalty points
            $used_loyalty_points = $this->input->post('used_loyalty_points') ?? 0;
            $earned_points = floor($data->amount * 0.01); // 1% of order value

            if ($used_loyalty_points > 0) {
                $this->db->set('loyalty_points', $earned_points)
                    ->where('id', $customer_id)
                    ->update('customers');
            } else {
                $this->db->set('loyalty_points', 'loyalty_points + ' . $earned_points, false)
                    ->where('id', $customer_id)
                    ->update('customers');
            }

            // Send confirmation email
            $this->sendOrderConfirmationEmail($data->order_id);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Failed to update order status');
            }

            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    private function sendOrderConfirmationEmail($order_id)
    {
        $order = $this->db->select('orders.*, customers.email, customers.name')
            ->join('customers', 'customers.id = orders.customer_id')
            ->where('orders.id', $order_id)
            ->get('orders')
            ->row();

        if ($order && !empty($order->email)) {
            $this->load->library('email');

            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 587,
                'smtp_user' => 'someshwarkanthale0@gmail.com',
                'smtp_pass' => 'pdbl innz vshk flod',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'smtp_crypto' => 'tls'
            ];
            $this->email->initialize($config);

            $this->email->from('someshwarkanthale0@gmail.com', 'Sona Chandi Jewellers');
            $this->email->to($order->email);
            $this->email->subject('Order Confirmation - ' . $order->order_number);

            $message = "<p>Dear {$order->name},</p>";
            $message .= "<p>Thank you for your order <strong>{$order->order_number}</strong>.</p>";
            $message .= "<p>Payment Method: " . ucfirst(str_replace('_', ' ', $order->payment_method)) . "</p>";
            $message .= "<p>Total Amount Paid: ₹" . number_format($order->total, 2) . "</p>";
            $message .= "<p>We'll notify you once your order is shipped.</p>";
            $message .= "<br><p>Regards,<br>Sona Chandi Jewellers</p>";

            $this->email->message($message);
            @$this->email->send();
        }
    }



    public function trackRepair()
    {
        $repair_id = $this->input->post('repair_id');

        // Sample query
        $repair = $this->db->where('id', $repair_id)->get('reparingappointment')->row();

        if ($repair) {
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'repair_code' => $repair->id,
                    'customer_name' => $repair->full_name,
                    'item_type' => $repair->repairNeed,
                    'repair_type' => $repair->jweleryType,
                    'status' => $repair->status,
                    'date' => $repair->created_at,
                ]
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Repair ID not found.'
            ]);
        }
    }
}

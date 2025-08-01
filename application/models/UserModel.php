<?php

defined("BASEPATH") or exit("No Direct Script Access Aloowed");

class UserModel extends CI_Model
{
    function __construct()
    {
        $this->load->database();
    }

    function createUser($data)
    {
        return $this->db->insert("user", $data);
    }

    function getData()
    {
        $data = $this->db->get("user")->result_array();
        if ($data != null) {
            return $data;
        }
        return null;
    }

    function getDataById($id)
    {
        // $this->db->where("id",$id);
        // $data=$this->db->get("user")->row_array();

        $data = $this->db->get_where("user", array("id" => $id))->row_array();
        if ($data != null) {
            return $data;
        }
        return null;
    }


    function deleteDataById($id)
    {
        $this->db->where("id", $id);
        return $this->db->delete("user");
    }

    function updateData($id, $toupdatdata)
    {
        $this->db->where("id", $id);
        $this->db->update("user", $toupdatdata);
    }

    function updateSpecificData($id, $name)
    {
        $this->db->set("name", "Shubham");
        $this->db->where("id", 1);
        $this->db->update("user");
    }

    public function savePiercingAppointment($data)
    {
        $insertData = [
            'full_name' => $data['name'],
            'mobile' => $data['mobile'],
            'type' => $data['piercingType'],
            'ageGroup' => $data['ageGroup'],
            'subType' => $data['selectedPiercingType'],
            'preferedDate' => $data['appointmentDate'],
            'preferedTime' => $data['appointmentTime'],
            'location' => $data['location'],
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];


        return $this->db->insert('piercingappointment', $insertData);
    }

    public function saveReparingAppointment($data)
    {
        $this->db->insert('reparingappointment', $data);
        return $this->db->insert_id(); // returns the inserted row's ID
    }

    public function getAllHeroBanner()
    {
        return $this->db->get('hearo_banners')->result();
    }

    public function getAllGoldCoinProducts()
    {
        // $keywords = ['coin', 'gold coin', 'silver', 'silver coin'];

        // $this->db->from('products');

        // $this->db->group_start(); // Start where group

        // foreach ($keywords as $word) {
        //     $this->db->or_like('LOWER(description)', strtolower($word), 'both', false);
        //     $this->db->or_like('LOWER(categories)', strtolower($word), 'both', false);
        //     $this->db->or_like('LOWER(tags)', strtolower($word), 'both', false);
        //     $this->db->or_like('LOWER(seo_title)', strtolower($word), 'both', false);
        //     $this->db->or_like('LOWER(seo_description)', strtolower($word), 'both', false);
        // }

        // $this->db->group_end(); // End where group

        // $query = $this->db->get();
        // return $query->result();

        $keywords = ['coin', 'gold coin', 'silver', 'silver coin'];

        $this->db->from('products');

        $this->db->group_start(); // Start where group

        foreach ($keywords as $word) {
            $this->db->or_like('LOWER(categories)', strtolower($word), 'both', false);
        }

        $this->db->group_end(); // End where group

        $query = $this->db->get();
        return $query->result();

    }

    public function getProductById($id)
    {
        // Step 1: Get the main product (single row)
        $this->db->where('id', $id);
        $product = $this->db->get('products')->row();

        // Step 2: Get all images with the same id
        $this->db->where('product_id', $id);
        $images = $this->db->get('product_images')->result();

        // Step 3: Attach images to product object
        if ($product) {
            $product->images = $images;
        }

        return $product;
    }

    public function getAllProductsByURL($main, $sub, $actual)
    {
        $main = strtolower(trim($main));
        $sub = strtolower(trim($sub));
        $actual = strtolower(trim($actual));

        $this->db->like('LOWER(type)', '"' . $main . '"');
        $this->db->like('LOWER(categories)', '"' . $sub . '"');

        // Match 'actual' tag inside the JSON array (e.g., ["gold", "silver"])
        $this->db->like('LOWER(subcategories)', '"' . $actual . '"');  // Match as "gold" inside JSON

        return $this->db->get('products')->result();

    }

    public function getFilteredProducts($rates, $type = null, $category = null, $lowest = null, $highest = null, $tags = null)
    {
        $this->db->select('*');
        $this->db->from('products');

        // Match multiple types (from comma-separated values)
        if (!empty($type)) {
            $types = explode(',', $type);
            $this->db->group_start();
            foreach ($types as $t) {
                $this->db->or_like('type', '"' . trim($t) . '"');
            }
            $this->db->group_end();
        }

        // Match multiple categories (from comma-separated values)
        if (!empty($category)) {
            $categories = explode(',', $category);
            $this->db->group_start();
            foreach ($categories as $cat) {
                $this->db->or_like('categories', '"' . trim($cat) . '"');
            }
            $this->db->group_end();
        }

        // Match multiple tags (if both type and tags are not null)
        if (!empty($type) && !empty($tags)) {
            $tagsArray = explode(',', $tags);
            $this->db->group_start();
            foreach ($tagsArray as $tag) {
                $this->db->or_like('tags', '"' . trim($tag) . '"');
            }
            $this->db->group_end();
        }

        $query = $this->db->get();
        $allProducts = $query->result();


        $filteredProducts = [];

        foreach ($allProducts as $product) {
            $weightData = json_decode($product->weight, true); // e.g., {"Gold":10,"platinum":15}
            $caratData = json_decode($product->carat, true);   // e.g., {"Gold":24,"platinum":0}
            $basePrice = 0;

            if (is_array($weightData)) {
                foreach ($weightData as $metal => $grams) {
                    $metalLower = strtolower($metal);
                    $grams = floatval($grams); // Weight in grams

                    $carat = $caratData[$metal] ?? null;

                    // Gold handled separately
                    if ($metalLower === 'gold') {
                        $caratKey = $carat ? strval($carat) : '24';
                        if (isset($rates['gold'][$caratKey])) {
                            $basePrice += $rates['gold'][$caratKey] * $grams;
                        }
                    }
                    // Silver, Platinum, Diamond (carat/grade key required)
                    elseif (in_array($metalLower, ['silver', 'platinum', 'diamond'])) {
                        $caratKey = $carat ? strval($carat) : null;
                        if ($caratKey && isset($rates[$metalLower][$caratKey])) {
                            $basePrice += $rates[$metalLower][$caratKey] * $grams;
                        }
                    }
                }
            }

            // Apply making charges and discount
            $makingCharges = floatval($product->making_charges);
            $discountPercent = floatval($product->discount_percentage);
            $discountAmount = ($discountPercent / 100) * $makingCharges;
            $discountedMakingCharges = $makingCharges - $discountAmount;

            // Add optional other_charges if present
            $otherCharges = isset($product->other_charges) && floatval($product->other_charges) > 0
                ? floatval($product->other_charges)
                : 0;

            // Calculate GST and final price
            $subtotal = $basePrice + $discountedMakingCharges + $otherCharges;
            $gstPercent = floatval($product->gst);
            $gstAmount = ($gstPercent / 100) * $subtotal;
            $finalPrice = round($subtotal + $gstAmount, 2);

            // Filter by price range
            if (!is_null($lowest) && !is_null($highest)) {
                if ($finalPrice >= $lowest && $finalPrice <= $highest) {
                    $product->final_price = $finalPrice;
                    $filteredProducts[] = $product;
                }
            } elseif (!is_null($lowest)) {
                if ($finalPrice >= $lowest) {
                    $product->final_price = $finalPrice;
                    $filteredProducts[] = $product;
                }
            } else {
                $product->final_price = $finalPrice;
                $filteredProducts[] = $product;
            }
        }




        return $filteredProducts;
    }



    //save schemes Subscription data
    public function saveSchemeForm($data)
    {
        return $this->db->insert('schemes', $data);
    }

    public function saveAstroGemsMeetingAppointment($data)
    {
        return $this->db->insert('astrogems_meet_schedule', $data);
    }

    public function getCategoryWithSubcategories()
    {
        $query = $this->db->query("
        SELECT 
            c.type AS type,
            c.name AS category_name,

            -- Subcategory names for group_type = 'Shop by Style'
            GROUP_CONCAT(DISTINCT 
                CASE 
                    WHEN sc.group_type = 'Shop by Style' THEN sc.name 
                    ELSE NULL 
                END 
                ORDER BY sc.name
            ) AS style_subcategories,

            -- Subcategory names for group_type = 'Shop by Occasion'
            GROUP_CONCAT(DISTINCT 
                CASE 
                    WHEN sc.group_type = 'Shop by Occasion' THEN sc.name 
                    ELSE NULL 
                END 
                ORDER BY sc.name
            ) AS occasion_subcategories

        FROM categories c
        LEFT JOIN subcategories sc ON sc.category_id = c.id AND sc.is_active = 1
        WHERE c.is_active = 1 AND c.type != ''
        GROUP BY c.type, c.name
        ORDER BY c.type, c.name
    ");

        return $query->result(); // returns the result as an array
    }


    public function getAllCategoryForFilter()
    {
        $this->db->distinct();
        $this->db->select('name');
        $this->db->from('categories');
        $query = $this->db->get();
        return $query->result(); // returns array of objects

    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('customers', ['email' => $email])->row();
    }

    public function insertIntoCart($product_id, $customer_id)
    {
        // Check if product already in cart for same customer
        $this->db->where('product_id', $product_id);
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get('add_to_cart');

        if ($query->num_rows() > 0) {
            return 0; // Already exists
        }

        // Prepare data for insert
        $data = [
            'product_id' => $product_id,
            'customer_id' => $customer_id,
        ];

        if ($this->db->insert('add_to_cart', $data)) {
            return 1; // Success
        } else {
            return -1; // Insert failed
        }
    }





    public function isProductInWishlist($customer_id, $product_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('wishlist');
        return $query->num_rows() > 0;
    }

    public function addToWishlist($customer_id, $product_id)
    {
        $this->db->insert('wishlist', [
            'customer_id' => $customer_id,
            'product_id' => $product_id
        ]);
    }

    public function removeFromWishlist($customer_id, $product_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('product_id', $product_id);
        $this->db->delete('wishlist');
    }

    public function getAllWishListProductsByCustomer($customer_id)
    {
        if (!$customer_id) {
            return []; // Return empty array if not logged in
        }

        $this->db->select('p.*');
        $this->db->from('wishlist w');
        $this->db->join('products p', 'p.id = w.product_id');
        $this->db->where('w.customer_id', $customer_id);
        $query = $this->db->get();

        return $query->result();
    }
    public function register_user($data)
    {
        // Double check email doesn't exist
        $exists = $this->db->where('email', $data['email'])->get('customers')->row();
        if ($exists) {
            return false;
        }

        return $this->db->insert('customers', $data);
    }

    public function getLikeCountByCustomer($customerId)
    {
        return $this->db->where('customer_id', $customerId)
            ->from('wishlist')
            ->count_all_results();
    }

    public function getCartCountByCustomer($customerId)
    {
        return $this->db->where('customer_id', $customerId)
            ->from('add_to_cart')
            ->count_all_results();
    }


    public function insertFeedback($data)
    {
        return $this->db->insert('shopFeedback', $data);
    }

    public function saveProductReview($product_id, $name, $rating, $review, $image = null)
    {
        $data = [
            'product_id' => $product_id,
            'name' => $name,
            'rating' => $rating,
            'review' => $review,
            'image' => $image, // already includes full path like "uploads/productReviewImages/xyz.png"
        ];

        return $this->db->insert('productReview', $data);
    }

    public function getProductRatingById($productId)
    {
        $this->db->select_avg('rating');
        $this->db->from('productreview');
        $this->db->where('product_id', $productId);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $rating = $query->row()->rating;

            // Handle null rating by defaulting to 0
            return round($rating ?? 0, 1);
        } else {
            return 0;
        }
    }


    public function getAstrolgerData()
    {
        $this->db->select('name, experience, expertise, mobile, whatsapp, email, charges');
        $this->db->from('astrologer');
        $this->db->limit(1); // ensure only one row
        $query = $this->db->get();
        return $query->row(); // return one row
    }

    public function get_all_birthstones()
    {
        return $this->db->get('birthstones')->result();
    }
    // public function getFinalCartPagaData($customer_id)
    // {
    //     return $this->db
    //         ->select('p.*')
    //         ->from('add_to_cart c')
    //         ->join('products p', 'c.product_id = p.id')
    //         ->where('c.customer_id', $customer_id)
    //         ->get()
    //         ->result();
    // }
    public function getFinalCartPagaData($customerId)
    {
        $this->db->select('add_to_cart.*, products.*, add_to_cart.quantity as qty'); // Make sure quantity is included
        $this->db->from('add_to_cart');
        $this->db->join('products', 'products.id = add_to_cart.product_id');
        $this->db->where('add_to_cart.customer_id', $customerId);
        return $this->db->get()->result();
    }
    public function getOrdersByUserId($userId)
    {
        return $this->db->where('user_id', $userId)->order_by('order_date', 'DESC')->get('orders')->result();
    }


    public function getRelatedProductForProductCart($id)
    {
        // Get the product name for the given ID
        $this->db->select('product_name');
        $this->db->where('id', $id);
        $product = $this->db->get('products')->row();

        if ($product) {
            $words = explode(' ', $product->product_name);

            // Columns to match against
            $columns = [
                'product_name',
                'description',
                'tags',
                'categories',
                'subcategories',
                'seo_title',
                'seo_description',
                'type'
            ];

            // Start SQL string
            $sql = "SELECT * FROM products WHERE id != $id AND (";
            $conditions = [];

            foreach ($words as $word) {
                foreach ($columns as $column) {
                    $safeWord = $this->db->escape_like_str($word);
                    $conditions[] = "$column LIKE '%$safeWord%'";
                }
            }

            $sql .= implode(' OR ', $conditions);
            $sql .= ") ORDER BY created_at DESC LIMIT 4";

            // Run the query and return the result as array
            $query = $this->db->query($sql);
            return $query->result();
        }

        return []; // Return empty array if no product found
    }

    public function getApprovedTestimonal()
    {
        return $this->db->select('*')
            ->from('shopfeedback')
            ->where('status', 'approved')
            ->get()
            ->result();
    }

    public function getSearchProducts($search)
    {
        $this->db->from('products');
        $this->db->group_start();
        $this->db->like('product_name', $search);
        $this->db->or_like('description', $search);
        $this->db->or_like('weight', $search);
        $this->db->or_like('product_code', $search);
        $this->db->or_like('categories', $search);
        $this->db->or_like('subcategories', $search);
        $this->db->or_like('tags', $search);
        $this->db->or_like('seo_title', $search);
        $this->db->or_like('seo_description', $search);
        $this->db->or_like('type', $search);
        $this->db->or_like('carat', $search);
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();

    }

    public function getLoyaltyPoints($customer_id)
    {
        $this->db->select('loyalty_points');
        $this->db->from('customers');
        $this->db->where('id', $customer_id);
        $query = $this->db->get();
        return $query->row('loyalty_points');
    }
}
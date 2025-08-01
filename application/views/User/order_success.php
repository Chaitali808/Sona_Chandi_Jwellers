<!DOCTYPE html>
<html>

<head>
    <title>Order Confirmation - Sona Chandi</title>
    <?php $this->load->view('common/Commonlinks'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .success-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .order-details {
            border-top: 1px solid #eee;
            margin-top: 1rem;
            padding-top: 1rem;
        }

        .order-item {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f5f5f5;
        }

        .order-item-img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-right: 1rem;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .price-summary {
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 6px;
            margin-top: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
        }

        .loyalty-points {
            color: #28a745;
            font-weight: 500;
        }

        .badge {
            padding: 0.35rem 0.65rem;
            font-weight: 500;
            border-radius: 0.25rem;
        }

        .text-warning {
            color: #ffc107 !important;
        }
    </style>
</head>

<body>
    <?php $this->load->view('common/navbar'); ?>

    <div class="container success-container">
        <div class="text-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            <h2 class="mt-3">Thank You for Your Order!</h2>
            <p>Your order #<?= htmlspecialchars($order->id ?? '') ?> has been placed successfully.</p>
            <p class="text-muted">A confirmation has been sent to your registered email.</p>
        </div>

        <div id="printable-content" class="order-details">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Order Details</h5>
                    <p><strong>Order Number:</strong> #<?= htmlspecialchars($order->id ?? '') ?></p>
                    <p><strong>Date:</strong> <?= date('d M Y, h:i A', strtotime($order->order_date ?? 'now')) ?></p>
                    <p><strong>Payment Method:</strong> <?= ucfirst($order->payment_method ?? 'cod') ?></p>
                    <p><strong>Payment Status:</strong>
                        <span
                            class="badge <?= ($order->payment_status ?? 'pending') == 'paid' ? 'bg-success' : 'bg-warning' ?>">
                            <?= ucfirst($order->payment_status ?? 'pending') ?>
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Delivery Info</h5>
                    <p><strong>Name:</strong> <?= htmlspecialchars($order->shipping_name ?? '') ?></p>
                    <p><strong>Contact:</strong>
                        <?= htmlspecialchars($order->shipping_phone ?? $order->shipping_contact ?? '') ?></p>
                    <p><strong>Address:</strong></p>
                    <p><?= nl2br(htmlspecialchars($order->shipping_address ?? '')) ?></p>
                </div>
            </div>

            <h5>Order Items</h5>
            <?php foreach ($order->items as $product): ?>
                <?php
                $rates = [
                    'gold' => ['24' => 6000, '22' => 5800, '21' => 5600, '20' => 5400, '18' => 4500, '14' => 3500, '10' => 3000, '9' => 2800],
                    'silver' => ['99.9' => 80, '92.5' => 75, '90.0' => 72],
                    'platinum' => ['99.9' => 5200, '95.0' => 5100, '90.0' => 4800],
                    'diamond' => ['fl' => 20000, 'if' => 18000, 'vvs1' => 16000, 'vs1' => 14000, 'si1' => 12000, 'i1' => 8000]
                ];

                // Decode product attributes
                $weightData = json_decode($product->weight, true) ?: [];
                $caratData = json_decode($product->carat, true) ?: [];
                $quantity = (int) ($product->quantity ?? 1);

                // Charges from database
                $making_charges = (float) $product->making_charges;
                $other_charges = (float) ($product->other_charges ?? 0);
                $discount_percentage = (float) $product->discount_percentage;
                $gst_percentage = (float) $product->gst;

                $material_price = 0;

                // Calculate material price
                foreach ($weightData as $material => $weight_gram) {
                    $material_lower = strtolower($material);
                    $carat = isset($caratData[$material]) ? strtolower(trim($caratData[$material])) : '';
                    $rate = $rates[$material_lower][$carat] ?? 0;
                    $material_price += floatval($weight_gram) * $rate;
                }

                // Apply discount on making charges
                $discounted_making = $making_charges - ($making_charges * $discount_percentage / 100);

                // Subtotal before GST
                $subtotal = $material_price + $discounted_making;

                // GST calculation
                $gst_amount = $subtotal * $gst_percentage / 100;

                // Final price per unit
                $final_price = $subtotal + $gst_amount + $other_charges;

                // Total for quantity
                $total_price = $final_price * $quantity;
                ?>
                <div class="order-item">
                    <img src="<?= base_url($product->image ?? '') ?>" class="order-item-img"
                        alt="<?= htmlspecialchars($product->product_name ?? '') ?>">
                    <div class="flex-grow-1">
                        <h6 class="mb-1"><?= htmlspecialchars($product->product_name ?? '') ?></h6>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <?php foreach ($weightData as $metal => $weightGram): ?>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-weight-hanging me-1"></i>
                                    <?= $weightGram ?>g <?= ucfirst($metal) ?>
                                    <?php if (!empty($caratData[$metal])): ?>
                                        <span class="text-warning"><?= $caratData[$metal] ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endforeach; ?>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-box-open me-1"></i>
                                Qty: <?= $quantity ?>
                            </span>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="text-success fw-bold">₹<?= number_format($total_price, 2) ?></span>
                                <?php if ($discount_percentage > 0 && $making_charges > 0): ?>
                                    <small class="text-muted ms-2">(<?= $discount_percentage ?>% off on making)</small>
                                <?php endif; ?>
                            </div>
                            <div class="fw-bold">
                                ₹<?= number_format($total_price, 2) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>




            <div class="price-summary">
                <h5 class="mb-3">Order Summary</h5>
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>₹<?= number_format($order->subtotal ?? $order->total, 2) ?></span>
                </div>

                <?php if (isset($order->discount) && $order->discount > 0): ?>
                    <div class="summary-row text-success">
                        <span>Discount:</span>
                        <span>-₹<?= number_format($order->discount, 2) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (isset($order->loyalty_points_used) && $order->loyalty_points_used > 0): ?>
                    <div class="summary-row loyalty-points">
                        <span>Loyalty Points Used (<?= $order->loyalty_points_used ?> pts):</span>
                        <span>-₹<?= number_format($order->loyalty_points_used, 2) ?></span>
                    </div>
                <?php endif; ?>

                <div class="summary-row">
                    <span>Delivery Charges:</span>
                    <span><?= ($order->shipping_charges ?? 0) > 0 ? '₹' . number_format($order->shipping_charges, 2) : 'FREE' ?></span>
                </div>

                <div class="summary-row" style="border-top: 1px solid #ddd; padding-top: 0.75rem; font-size: 1.1rem;">
                    <span class="fw-bold">Total Amount:</span>
                    <span class="fw-bold">₹<?= number_format($order->total ?? 0, 2) ?></span>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="<?= base_url('UserController/home') ?>" class="btn btn-primary">
                <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
            </a>
            <a href="<?= base_url('UserController/profile/') ?>" class="btn btn-outline-secondary ms-2">
                <i class="fas fa-receipt me-2"></i>View Order Details
            </a>
            <button class="btn btn-secondary ms-2" onclick="printOrder()">
                <i class="fas fa-print me-2"></i>Print Invoice
            </button>
        </div>
    </div>

    <?php $this->load->view('common/footer'); ?>

    <script>
        function printOrder() {
            const printContent = document.getElementById('printable-content').innerHTML;
            const original = document.body.innerHTML;
            const shopName = `
                <div class="text-center mb-4">
                    <h2 class="mb-1">Sona Chandi Jewellers</h2>
                    <p class="text-muted">Invoice #<?= $order->id ?></p>
                    <p class="text-muted"><?= date('d M Y, h:i A') ?></p>
                </div>
            `;
            const thankYou = `
                <div class="text-center mt-4">
                    <p class="fw-bold">Thank you for your purchase!</p>
                    <p class="text-muted">For any queries, please contact our customer support</p>
                </div>
            `;

            const styles = `
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; color: #333; }
                    h2, h3, h4, h5, h6 { color: #2d1a47; }
                    .order-details { margin-top: 0; padding-top: 0; }
                    .order-item { margin-bottom: 15px; padding-bottom: 10px; }
                    .price-summary { background: #f5f5f5; padding: 15px; }
                    .summary-row { padding: 8px 0; }
                    .loyalty-points { color: #28a745; }
                    .badge { padding: 3px 8px; font-size: 12px; }
                    @page { size: auto; margin: 10mm; }
                    @media print {
                        .no-print { display: none !important; }
                        body { padding: 0; }
                    }
                </style>
            `;

            document.body.innerHTML = styles + shopName + printContent + thankYou;
            window.print();
            document.body.innerHTML = original;
        }
    </script>
</body>

</html>
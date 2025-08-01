<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <?php $this->load->view('common/Commonlinks'); ?>
   <title>Jwellar Loyalty Program</title>
    <style>
        :root {
            --purple-primary: rgba(94, 53, 142, 1);
            --purple-secondary: rgba(197, 115, 191, 1);
            --purple-light: rgba(178, 142, 202, 1);
            --purple-dark: #4a148c;
            --text-light: #f8f9fa;
            --bg: #f8f9fa;
        }

        body {
            background: var(--bg);
            color: var(--purple-dark);
            font-family: 'Segoe UI', sans-serif;
        }

        h1,
        h3 {
            font-family: 'Cormorant Garamond', serif;
        }

        p {
            font-family: 'Garet', sans-serif;
        }

        .hero {
            position: relative;
            overflow: hidden;
            text-align: center;
            color: var(--text-light);
        }

        .hero img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            filter: brightness(50%);
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .jwellar-btn {
            background: linear-gradient(90deg, var(--purple-primary), var(--purple-secondary));
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 12px 35px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .jwellar-btn:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        .section-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 600;
            color: var(--purple-primary);
            position: relative;
            margin-bottom: 50px;
        }

        .section-title::after {
            content: "";
            display: block;
            width: 60px;
            height: 4px;
            background-color: var(--purple-dark);
            margin: 12px auto 0;
            border-radius: 5px;
        }

        .step-box {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.07);
            padding: 30px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 2px solid transparent;
        }

        .step-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
            border-color: var(--purple-light);
        }

        .step-number {
            font-size: 2.4rem;
            font-weight: bold;
            color: var(--purple-primary);
            margin-bottom: 15px;
        }

        .points {
            font-size: 2.2rem;
            color: var(--purple-dark);
            font-weight: bold;
        }

        .faq {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
        }
.accordion-button {
  background-color: var(--purple-light);
  color: var(--purple-dark);
  font-weight: 600;
  font-size: 1.05rem;
  transition: background-color 0.3s ease;
  border-radius: 10px !important;
}

.accordion-button:not(.collapsed) {
  background-color: var(--purple-secondary);
  color: #fff;
  box-shadow: none;
}

.accordion-item {
  border: none;
  border-radius: 12px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
  margin-bottom: 15px;
}

.accordion-body {
  background-color: #fdfcff;
  border-radius: 0 0 10px 10px;
  padding: 1.2rem;
  font-size: 0.95rem;
  color: var(--purple-dark);
}


        .footer {
            background: linear-gradient(90deg, var(--purple-primary), var(--purple-dark));
            color: var(--text-light);
            text-align: center;
            padding: 1rem 0;
            font-weight: 500;
            letter-spacing: 1px;
        }

        @media (max-width: 767px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero img {
                height: 300px;
            }

            .step-box {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php $this->load->view('common/navbar'); ?>
    <!-- Hero Section -->
    <header class="hero">
        <img src="<?php echo base_url('assets/LoyaltyProgram/loyal1.png'); ?>" alt="Loyalty Banner" />
        <div class="hero-content text-white">
            <h1>Jwellar Loyalty Program</h1>
            <p>Gain points and turn them into rewards every time you shop</p>
           <button class="jwellar-btn" onclick="window.location.href='<?php echo base_url('UserController/home'); ?>'">Become a Member</button>

        </div>
    </header>

    <main class="container py-5">

        <!-- Steps Section -->
        <section class="steps">
            <div class="section-title">
                <h1>How It Works</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-box">
                        <div class="step-number">01</div>
                        <h3>Sign Up</h3>
                        <p>Sign up as a member to start enjoying the loyalty program</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-box">
                        <div class="step-number">02</div>
                        <h3>Earn Points</h3>
                        <p>On new Registration<br>Get 50 points</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-box">
                        <div class="step-number">03</div>
                        <h3>Redeem Rewards</h3>
                        <p>On Purchase of ₹1000 <br>Get 10 Points</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Points System Section -->
        <section class="text-center my-5">
            <div class="section-title">
                <h1>Points System</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="step-box">
                        <div class="points">+50</div>
                        <p>Register an account</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-box">
                        <div class="points">₹10</div>
                        <p>Shop ₹1000</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
    <section class="faq">
  <div class="section-title">Frequently Asked Questions</div>
  <div class="accordion" id="faqAccordion">
    
    <div class="accordion-item">
      <h2 class="accordion-header" id="faqOne">
        <button class="accordion-button d-flex align-items-center gap-2" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="bi bi-person-check-fill"></i> How do I join the loyalty program?
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne"
        data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Simply register an account and you're automatically enrolled.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="faqTwo">
        <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="bi bi-gift-fill"></i> How do I earn points?
        </button>
      </h2>
      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo"
        data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Register and earn 50 points. Get ₹10 back for every ₹1000 spent.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="faqThree">
        <button class="accordion-button collapsed d-flex align-items-center gap-2" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <i class="bi bi-wallet2"></i> How do I redeem points?
        </button>
      </h2>
      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree"
        data-bs-parent="#faqAccordion">
        <div class="accordion-body">
          Use points at checkout to get discounts instantly.
        </div>
      </div>
    </div>

  </div>
</section>

    </main>

    <?php $this->load->view('common/footer'); ?>
       <!-- SweetAlert2 -->
</body>

</html>
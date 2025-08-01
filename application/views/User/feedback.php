<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback | Astrogems</title>

    <!-- Optional: Google Fonts (Garet alternative if not available) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap (required for classes like btn, form-control) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --purple-primary: #5e358e;
            --purple-secondary: #c573bf;
            --purple-light: #b28eca;
            --text-light: #f8f9fa;
            --font-family: 'Nunito', sans-serif;
        }

        body {
            background-color: #faf5ff;
            font-family: var(--font-family);
        }

        .feedback-card {
            background: #fff;
            border-radius: 1rem;
            max-width: 600px;
            margin: 50px auto;
            border: 1px solid rgba(94, 53, 142, 0.15);
            box-shadow: 0 6px 20px rgba(94, 53, 142, 0.1);
            padding: 2rem;
        }

        .feedback-title {
            color: var(--purple-primary);
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        #feedbackForm .form-control,
        #feedbackForm .form-select {
            border-radius: 0.5rem;
            border: 1px solid #ccc;
            font-size: 0.95rem;
        }

        #feedbackForm .form-control:focus,
        #feedbackForm .form-select:focus {
            border-color: var(--purple-primary);
            box-shadow: 0 0 0 0.2rem rgba(94, 53, 142, 0.15);
        }

        .btn-elegant {
            background: linear-gradient(135deg, var(--purple-secondary), var(--purple-primary));
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(197, 115, 191, 0.3);
        }

        .btn-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(197, 115, 191, 0.4);
            background: linear-gradient(135deg, var(--purple-primary), var(--purple-secondary));
        }
    </style>
</head>

<body>

    <!-- Feedback Form Section -->
    <div class="container">
        <div class="feedback-card">
            <h3 class="feedback-title">We Value Your Feedback ✨</h3>
            <form id="feedbackForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">How do you rate your experience?</label>
                    <select class="form-select" id="rating" required>
                        <option value="">Select rating</option>
                        <option>🌟 Poor</option>
                        <option>⭐⭐ Fair</option>
                        <option>⭐⭐⭐ Good</option>
                        <option>⭐⭐⭐⭐ Very Good</option>
                        <option>⭐⭐⭐⭐⭐ Excellent</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Share your thoughts..."
                        required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-elegant">Submit Feedback</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional JS Alert on Submit -->
    <script>
        document.getElementById("feedbackForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const name = document.getElementById("name").value.trim();
            alert("Thank you for your feedback, " + name + "! 💜");
            this.reset();
        });
    </script>
</body>

</html>
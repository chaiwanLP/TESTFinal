<?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center">
        <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .card-custom {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .card-custom h2 {
            color: #333;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .input-group-text {
            background-color: #6c757d;
            border: none;
            color: white;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 5px rgba(108, 117, 125, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-center a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        .alert-danger {
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <div class="container d-flex flex-column justify-content-center align-items-center mt-5">
        <div class="row w-100 mt-5">
            <div class="col-md-6 col-lg-4 mx-auto">
                <div class="card-custom"style="background-color: #c4ea89;">
                    <h2 class="text-center mb-4">Login</h2>

                    <form action="login" method="post">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </div>

                        <p class="text-center mt-3">
                            Don't have an account? <a href="register">Register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

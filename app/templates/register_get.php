
</head>
<body>
<div class="container d-flex flex-column justify-content-center align-items-center mb-5">
    <div class="register-container mt-5">
        <h2 class="mb-4">Register</h2>

        <form id="register" action="/register" method="post" enctype="multipart/form-data">
        <label for="username">Username</label>
            <input type="text" class="form-control mb-3" name="username" id="username" placeholder="ชื่อผู้ใช้" required>


        <div class="d-flex gap-3">
                <div class="w-50">
                    <label for="prefix">Prefix</label>
                    <select class="form-control" name="prefix" id="prefix" required>
                        <option value="" disabled selected>เลือกคำนำหน้า</option>
                        <option value="นาย">นาย</option>
                        <option value="นางสาว">นางสาว</option>
                        <option value="นาย">นาง</option>
                    </select>
                </div>
                <div class="w-50">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender" id="gender" required>
                        <option value="" disabled selected>เลือกเพศ</option>
                        <option value="Female">หญิง</option>
                        <option value="Male">ชาย</option>
                        <option value="Other">อื่นๆ</option>
                    </select>
                </div>
            </div>

            <label for="first_name">First Name</label>
            <input type="text" class="form-control mb-3" name="first_name" id="first_name" placeholder="ชื่อจริง" required>

            <label for="last_name">Last Name</label>
            <input type="text" class="form-control mb-3" name="last_name" id="last_name" placeholder="นามสกุล" required>

            <label for="password">Password</label>
            <input type="password" class="form-control mb-3" name="password" id="password" placeholder="รหัสผ่าน" required>

            <label for="password_confirm">Confirm Password</label>
            <input type="password" class="form-control mb-3" name="password_confirm" id="password_confirm" placeholder="ยืนยันรหัสผ่าน" required>
            <div id="passwordError" class="error-message">รหัสผ่านไม่ตรงกัน</div>

            <label for="email">Email</label>
            <input type="email" class="form-control mb-3" name="email" id="email" placeholder="อีเมล" required>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="เบอร์โทรศัพท์" required>
                </div>
                <div class="col-6">
                    <label for="dob">Date of Birth</label>
                    <input type="date"  class="form-control" name="birthday" id="birthday" required>
                </div>
            </div>
            <div class="col-md-6 form-group">
                    <label for="profile-picture">เลือกรูปโปรไฟล์:</label>
                    <input type="file" class="form-control" id="profile-image" name="profile-image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        <div class="text-center mt-3">
            <p>Already have an account? <a href="/login" class="text-primary">Login</a></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('register').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirm').value;
        const passwordError = document.getElementById('passwordError');

        if (password !== passwordConfirm) {
            passwordError.style.display = 'block';
            event.preventDefault(); 
        } else {
            passwordError.style.display = 'none';
        }
    });

    document.getElementById('password_confirm').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const passwordConfirm = this.value;
        const passwordError = document.getElementById('passwordError');

        if (password !== passwordConfirm) {
            passwordError.style.display = 'block';
        } else {
            passwordError.style.display = 'none';
        }
    });
</script>
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Arial', sans-serif;
    }
    .register-container {
        background-color: #c4ea89; 
        padding: 40px;
        border-radius: 20px;
        margin: auto;
        max-width: 500px;
        text-align: center;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }
    .register-container h2 {
        color: #333;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .register-container .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 15px;
    }
    .register-container .form-control:focus {
        border-color: #28a745; 
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.5);
    }
    .register-container .btn-success {
        background-color: #28a745;
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .register-container .btn-success:hover {
        background-color: #218838; 
    }
    .register-container a {
        color: #28a745;
        text-decoration: none;
        font-weight: bold;
    }
    .register-container a:hover {
        text-decoration: underline;
    }
    .register-container .d-flex.gap-3 {
        gap: 15px;
    }
    .register-container .row {
        margin-bottom: 15px;
    }
    .register-container .text-center {
        margin-top: 20px;
    }
    .register-container label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        text-align: left;
    }
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: none;
    }
</style>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 500px;
            width: 100%;
            margin: auto;
        }
        .profile-picture {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .profile-picture img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-field {
            margin-bottom: 1.5rem;
        }
        .btn-submit, .btn-reset {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit { background: #28a745; color: white; }
        .btn-submit:hover { background: #218838; }
        .btn-reset { background: #dc3545; color: white; margin-top: 10px; }
        .btn-reset:hover { background: #c82333; }
    </style>
</head>
<body>
   
    

    <div class="profile-card">
            
            <form action="edit_profile" method="POST" enctype="multipart/form-data">
                <div class="profile-picture">
                    <img class = "mt-4" id="profile-img" src = "<?php echo $data['user_info']->profile_image?>"; alt="Profile Picture">
                    <input type="file" name="profile-img" id="profile-img" class="form-control mt-2" accept="image/*">
                </div>
                <div class="form-field">
                <label for="username">ชื่อผู้ใช้</label>
                <input type="text" id="username" name="username" class="form-control" value=" <?php echo $data['user_info']->username;?> " required>
            </div>
            
            <div class="row">
                <div class="col-md-6 form-field">
                    <label for="first_name">ชื่อ</label>
                    <input type="text" id="first_name" name="first_name" class="form-control"  value=" <?php echo $data['user_info']->firstname;?> "required>
                </div>
                <div class="col-md-6 form-field">
                    <label for="last_name">นามสกุล</label>
                    <input type="text" id="last_name" name="last_name" class="form-control"  value=" <?php echo $data['user_info']->lastname;?>" required>
                </div>
            </div>
            <div class="form-field">
                <label for="email">อีเมล</label>
                <input type="email" id="email" name="email" class="form-control" value=" <?php echo $data['user_info']->email;?> "required>
            </div>
            <div class="form-field">
                <label for="phone">เบอร์โทรศัพท์</label>
                <input type="tel" id="phone" name="phone" class="form-control"  value=" <?php echo $data['user_info']->phone;?> " required>
            </div>
            <div class="form-field">
                <label for="birthday">วันเกิด</label>
                <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo trim($data['user_info']->birthday); ?>" required>


            </div>
           <div class="justify-content-center gap-3 mt-4">
               <button type="button" class="btn btn-danger" style="width: 200px;" onclick="window.location.href='/profile';">ยกเลิก</button>
               <button type="submit" class="btn btn-success" style="width: 200px;" onclick="return confirm('คุณแน่ใจหรือไม่?')">บันทึกข้อมูล</button>
           </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
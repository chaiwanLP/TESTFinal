
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profilesty.css">

<div class="center-container">
    <div class="custom-container">
    <div class="profile-section">
            <div class="profile-picture">
    <img src="<?php echo IMAGE_DIR . '/' . $data['user']->profile_image; ?>" alt="Profile">
    
</div>

<div class="personal-info">
    <div class="profile-username">คุณ ... <?php echo $data['user']->username ?></div>
    <div class="personal-info-grid">
        <span class="font-medium">Prefix</span>
        <span><?php echo $data['user']->prefix ?></span>
        <span class="font-medium">Gender</span>
        <span><?php echo $data['user']->gender ?></span>
        <span class="font-medium">First Name</span>
        <span><?php echo $data['user']->firstname ?></span>
        <span class="font-medium">Last Name</span>
        <span><?php echo $data['user']->lastname ?></span>
        <span class="font-medium">Email</span>
        <span><?php echo $data['user']->email?></span>
        <span class="font-medium">Phone</span>
        <span><?php echo $data['user']->phone ?></span>
        <span class="font-medium">Birthday</span>
        <span><?php echo $data['user']->birthday ?></span>
    </div>
    <a href="/edit_profile?user_id=<?php echo urlencode($data['user']->user_id); ?>" class="btn btn-warning mt-4 ">แก้ไขโปรไฟล์</a>

</div>
</div>

        <!-- Activity Stats -->
        <div class="activity-stats">
            <h3>ข้อมูลการทำกิจกรรม</h3>
            <div class="stat-item">
                <span>เข้าร่วม</span>
                <span>1</span>
            </div>
            <div class="stat-item">
                <span>สร้างกิจกรรม</span>
                <span>0</span>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="recent-activities">
            <h3>กิจกรรมล่าสุด</h3>
            <div class="recent-activities-grid">
                <div class="activity-card">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Animals/Baby%20Chick.png" alt="Activity 1">
                    <p>กิจกรรมที่ 1</p>
                    <div class="buttons">
                        <button>ส่งเวลาล่วง</button>
                        <button>รายละเอียด</button>
                    </div>
                </div>
                <div class="activity-card">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Animals/Baby%20Chick.png" alt="Activity 2">
                    <p>กิจกรรมที่ 2</p>
                    <div class="buttons">
                        <button>ส่งเวลาล่วง</button>
                        <button>รายละเอียด</button>
                    </div>
                </div>
                <div class="activity-card">
                    <img src="https://raw.githubusercontent.com/Tarikul-Islam-Anik/Animated-Fluent-Emojis/master/Emojis/Animals/Baby%20Chick.png" alt="Activity 3">
                    <p>กิจกรรมที่ 3</p>
                    <div class="buttons">
                        <button>ส่งเวลาล่วง</button>
                        <button>รายละเอียด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <style>

        .custom-container {
    max-width: 800px;
    margin-top: 10%;
    width: 100%;
    padding: 2rem;
    background-color: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* จัดให้อยู่ตรงกลาง */
.center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

        .profile-section {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
        }
        .profile-picture {
            width: 8rem;
            height: 8rem;
            background-color: #FFF8E7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .profile-picture img {
            width: 6rem;
            height: 6rem;
        }
        .profile-username {
            background-color: #FFF8E7;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        .personal-info {
            flex-grow: 1;
        }
        .personal-info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 0.75rem 1rem;
        }
        .personal-info-grid span {
            background-color: #e9ecef;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
        }
        .activity-stats {
            background-color: #FFF8E7;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1.5rem;
        }
        .activity-stats h3 {
            font-size: 1.125rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        .activity-stats .stat-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
        }
        .activity-stats .stat-item img {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            object-fit: cover;
        }
        .activity-stats .stat-item span {
            flex-grow: 1;
        }
        .recent-activities h3 {
            background-color: #DEFF9E;
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 1.125rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }
        .recent-activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        .activity-card {
            background-color: #F5FFE2;
            padding: 1rem;
            border-radius: 0.5rem;
        }
        .activity-card img {
            width: 100%;
            height: 8rem;
            object-fit: cover;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .activity-card p {
            text-align: center;
            margin-bottom: 1rem;
        }
        .activity-card .buttons {
            display: flex;
            justify-content: space-between;
            gap: 0.5rem;
        }
        .activity-card .buttons button {
            background-color: white;
            border: none;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            color: #6c757d;
        }
        .profile-picture {
            width: 150px; 
            height: 150px;
            border-radius: 50%; 
            overflow: hidden; 
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid #ddd; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover; 
        }

    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

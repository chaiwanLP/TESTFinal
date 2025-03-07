
    <div class="container container-custom mt-4 mb-3">
        <div class="row">
        <div class="text-center mt-3"> 
        <?php if (isset($data['recommend'])): ?>
                <div class="activity-recommendation p-4 rounded">
                    <div class="badge">กิจกรรมแนะนำ</div>
                    <a href="/activity_detail?event_id=<?php echo $data['recommend']->event_id; ?>">
                        <img src="<?php echo IMAGE_DIR . '/' . $data['recommend']->image; ?>" alt="Event Image" class="image-cover">
                    </a>
                    <div class="mt-4">
                        <span class="text-muted">
                            <p>
                                <span style="font-size: 1.2em; font-weight: bold;"><?php echo $data['recommend']->title; ?></span>
                                มีคนเข้าร่วมกิจกรรมสูงที่สุด และยอดฮิต
                            </p>
                        </span>
                    </div>
                </div>
                <div class="mt-2">
                    <span>⬤</span>
                    <span>⬤</span>
                    <span>⬤</span>
                </div>
                <?php else: ?>
                <p>ยังไม่มีกิจกรรมแนะนำให้เห็น</p>
            <?php endif; ?>
</div>


        </div>

        <div class="text-center mt-5 mb-4">
            <h2>ร่วมสร้างกิจกรรมวันนี้ ...</h2>
            <a href="/create_activity" class="btn btn-warning px-4 py-2 mt-2">สร้างกิจกรรมของคุณ</a>

        </div>
        <div class="search-box mb-4">
            <h2 class="text-center">ค้นหากิจกรรมที่ใช่ สำหรับคุณ...</h2>
            <div class="container mt-4">
            <form action="/search_result" method="GET">
    <div class="row g-2 mt-3">
        <!-- Name input field -->
        <div class="col-md-2 d-flex align-items-center">
            <input type="text" class="form-control" name="title" placeholder="ชื่อ...">
        </div>

        <!-- Start Date input field with label -->
        <div class="col-md-3 d-flex align-items-center">
            <label for="start_date" class="form-label ml-2 mb-0 me-3 w-100">ระยะเวลาจาก</label>
            <input type="date" class="form-control" name="start_date" id="start_date">
        </div>

        <!-- End Date input field with label -->
        <div class="col-md-3 d-flex align-items-center">
            <label for="end_date" class="form-label mb-0 me-3 w-100">ถึง</label>
            <input type="date" class="form-control" name="end_date" id="end_date">
        </div>

        <!-- Category dropdown -->
        <div class="col-md-2 d-flex align-items-center">
            <select class="form-select" name="event_types">
                <option value="">หมวดหมู่</option>
                <option value="กีฬา">กีฬา</option>
                <option value="ดนตรี">ดนตรี</option>
                <option value="เรียนรู้">เรียนรู้</option>
                <option value="สร้างสรรค์">สร้างสรรค์</option>
                <option value="วัฒนธรรม">วัฒนธรรม</option>
                <option value="สุขภาพ">สุขภาพ</option>
                <option value="พัฒนาอาชีพ">พัฒนาอาชีพ</option>
            </select>
        </div>

        <!-- Search button -->
        <div class="col-md-2 d-flex align-items-center">
            <button type="submit" class="btn btn-warning w-100">ค้นหา</button>
        </div>
    </div>
</form>


</div>

        </div>
        <div class="row text-center justify-content-center" style="background-color: #c4ea89;">
            <h4 class="activity-title col-md-3 mt-4 mb-4">กิจกรรม</h4>
        </div>
        <div class="row"style="background-color:  #c4ea89;">
            <?php
            if (isset($data['events']) && $data['events']->num_rows > 0) {
                while ($row = $data['events']->fetch_object()) {
            ?>
                <div class="col-md-4 mb-3">
                    <div class="card card-custom border-0">
                        <div class="card-body text-center">
                        <div class="bg-light p-4 rounded mb-2">
                            <?php
                            echo '<img src="'.IMAGE_DIR."/".$row->image.'" alt="Event Image" class="image-item" width="300" height="250">';
                            ?>
                        </div>
                            <h5><?= $row->title ?></h5>
                            <p class="card-text">
                                <span class="badge bg-success">🏷️ <?= $row->event_types ?></span>
                                <span class="badge bg-info">📅 <?= date('d-m-Y', strtotime($row->start_date)) ?></span>

                            </p>
                            <a href="/activity_detail?event_id=<?php echo $row->event_id; ?>" class="btn btn-outline-success w-100">รายละเอียด</a>


                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
            ?>
                <tr><td colspan="5" class="text-center">ไม่มีกิจกรรม</td></tr>
            <?php
            }
            ?>
            
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-outline-secondary">◀</button>
            <span class="mx-2">หน้า <strong>1</strong> 🟢 2</span>
            <button class="btn btn-outline-secondary">▶</button>
        </div>
    </div>
    <style>
        
        .resized-image { width: 50px; height: auto; }
        .content { flex: 1; }
        footer { background-color: #c4ea89; padding: 10px 0; text-align: center; }
        .container-custom { border-radius: 0.5rem; padding: 20px; }
        .activity-recommendation { background-color: #c4ea89; border-radius: 0.5rem; padding: 20px; position: relative; height: 100%; }
        .activity-recommendation .badge { position: absolute; top: 0; left: 0; background-color: #28a745; color: white; padding: 5px 10px; border-radius: 0.5rem 0 0.5rem 0; }
        .create-activity-section { background-color: #e5f4bb; border-radius: 0.5rem; padding: 20px; margin-top: 20px; }
        .search-box { background-color: #e5f4bb; border-radius: 0.5rem; padding: 20px; margin-top: 20px; }
        .card-custom { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.2s; }
        .card-custom:hover { transform: translateY(-5px); }
        .square-white{
            background-color: white;
            height: 250px;
            width: 400px;
            border-radius: 30px;
        }
        .square-detail{
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 20px;
            height: 500px;
        }
        .bt-detail {
        background-color: rgba(255, 255, 255, 0.4);
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        color: black;
        font-weight: bold;
        border: transparent;
      }
      .bt-detail.active {
        background-color: rgba(255, 255, 255, 0.9);
        border: transparent;
      }

    .image-item {
    width: 100%; 
    max-width: 300px;
    border-radius: 15px;
    overflow: hidden; 
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);  
    transition: transform 0.3s ease; 
    height: 250px; 
    object-fit: cover; 
    border-radius: 10px;  
}
.image-cover {
    margin-top: 2%;
    width: 100%; 
    max-width: 90%;  
    border-radius: 15px;  
    overflow: hidden;  
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
    transition: transform 0.3s ease; 
    height: 500px;          
    object-fit: cover;      
    border-radius: 10px;   
}
.image-item:hover {
    transform: scale(1.05);    
}
.event-image {
    width: 100%;       
    height: 250px;  
    object-fit: cover;    
    border-radius: 10px;  
}
.activity-recommendation .image-item {
    width: 100%; 
    height: auto; 
}

    </style>
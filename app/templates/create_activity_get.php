
    <div class="container mt-5">
        <div class="form-container shadow">
            <h2 class="text-center mb-4">สร้างกิจกรรม</h2>
            <form action="create_activity" method="post" enctype="multipart/form-data" >

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="activity-image">เลือกรูปกิจกรรม:</label>
                        <input type="file" class="form-control" id="activity-image" name="activity-image[]" accept="image/*" required multiple>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="activity-name">ชื่อกิจกรรม:</label>
                        <input type="text" class="form-control" id="activity-title" name="activity-title" placeholder="เขียนชื่อกิจกรรม..." required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="activity-details">รายละเอียด:</label>
                    <textarea class="form-control" id="activity_description" name="activity_description" rows="4" placeholder="เขียนรายละเอียดของกิจกรรม..." required></textarea>
                </div>
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="start-date">วันที่เริ่ม:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="end-date">วันที่จบ:</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                     
                    <div class="col-md-3 form-group">
                        <label for="time-period">ช่วงเวลา:</label>
                        <input type="time" class="form-control" id="activity_time" name="activity_time" required>
                    </div>
    
                    <div class="col-md-3 form-group">
                        <label for="participant-limit">จำนวนที่รับ:</label>
                        <input type="number" class="form-control" id="participant_amount" name="participant_amount" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">สถานที่:</label>
                    <textarea class="form-control" id="location" name="location" rows="4" placeholder="เขียนสถานที่จัด..." required></textarea>
                </div>
                
                <div class="d-flex justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="activity-type">ประเภทกิจกรรม:</label>
                        <select class="form-control" id="event_type" name="event_type" required>
                        <option value="">เลือก...</option>
                        <option value="กีฬา">กีฬา</option>
                        <option value="ดนตรี">ดนตรี</option>
                        <option value="เรียนรู้">เรียนรู้</option>
                        <option value="สร้างสรรค์">สร้างสรรค์</option>
                        <option value="วัฒนธรรม">วัฒนธรรม</option>
                        <option value="สุขภาพ">สุขภาพ</option>
                        <option value="พัฒนาอาชีพ">พัฒนาอาชีพ</option>
                        <option value="other">อื่นๆ</option>
                        </select>
                    </div>
                </div>

                <div class="form-group button-group d-flex justify-content-center gap-3 mt-4">
                    <button type="button" class="btn btn-danger" style="width: 200px;" onclick="window.location.href='/'">ยกเลิก</button>
                    <button type="submit" class="btn btn-success" style="width: 200px;">สร้าง</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .resized-image { width: 50px; height: auto; }

        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-container .form-group {
            margin-bottom: 15px;
        }
        .form-container .form-control {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 5px; 
            padding: 10px; 
        }
        .form-container .form-control:focus {
            background-color: #e0e0e0;
            border-color: #999; 
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        .button-group .btn {
            flex: 1; 
        }

        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
    
        .content {
            flex: 1;
        }
    
        footer {
            background-color: #c4ea89; 
            padding: 10px 0; 
            text-align: center;
        }
    </style>
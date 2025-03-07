
    <style>
        .square-white{
            background-color: white;
            height: 700px;
        }
        .resized-image-test {
            width: 50px;
            height: auto;
        }

.btn-green {
    background-color: green;
    color: white;
    border: none;
}

.btn-green:hover {
    background-color: darkgreen;
}

/* ปุ่มแดง */
.btn-red {
    background-color: red;
    color: white;
    border: none;
}

.btn-red:hover {
    background-color: darkred;
}

    </style>

        <div class="col-12 square-white">
            <div class="container">
            <form action="/edit_activity" method="POST">
    <div class="row mx-3">

        <div class="col-5 offset-3 mt-3">
            <label for="name" class="form-label">ชื่อกิจกรรม</label>
            <input type="text" class="form-control" name="activity-title" id="activity-title" value="<?php echo $data['events']->title; ?>">
        </div>
    </div>
    <div class="row mx-3 mt-3">
        <div>
            <label for="detail" class="form-label">รายละเอียด</label>
            <textarea class="form-control" name="activity_description" id="activity_description" rows="4"><?php echo $data['events']->description; ?></textarea>
        </div>
    </div>
    <div class="row mx-3 mt-3">
    <?php
$start_date = isset($data['events']->start_date) ? date('Y-m-d', strtotime($data['events']->start_date)) : '';
$end_date = isset($data['events']->end_date) ? date('Y-m-d', strtotime($data['events']->end_date)) : '';
?>

<div class="col-3">
    <label for="start_date" class="form-label">วันที่เริ่ม</label>
    <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $start_date; ?>">
</div>
<input type="hidden" name="event_id" id="event_id" value="<?php echo $data['events']->event_id; ?>">

<div class="col-3">
    <label for="end_date" class="form-label">วันที่จบ</label>
    <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo $end_date; ?>">
</div>

        <div class="col-3">
            <label for="" class="form-label">ช่วงเวลา</label>
            <input type="time" name="activity_time" id="activity_time" class="form-control" value="<?php echo $data['events']->time; ?>">
        </div>
        <div class="col-3">
            <label for="" class="form-label">จำนวนที่รับ</label>
            <input type="text" name="participant_amount" id="participant_amount" class="form-control" value="<?php echo $data['events']->participant_amount; ?>">
        </div>
    </div>
    <div class="row mx-3 mt-3">
        <div>
            <label for="location" class="form-label">สถานที่</label>
            <textarea class="form-control" name="location" id="location" rows="4"><?php echo $data['events']->location; ?></textarea>
        </div>
    </div>
    <div class="row mx-3 mt-3">
        <div class="d-flex justify-content-center align-items-center">
            <label for="event_types" class="m-4">ประเภทกิจกรรม</label>
            <select name="event_types" id="event_types" class="form-control">
                <option value="">เลือก...</option>
                <option value="กีฬา" <?php if ($data['events']->event_types == 'กีฬา') echo 'selected'; ?>>กีฬา</option>
                <option value="ดนตรี" <?php if ($data['events']->event_types == 'ดนตรี') echo 'selected'; ?>>ดนตรี</option>
                <option value="เรียนรู้" <?php if ($data['events']->event_types == 'เรียนรู้') echo 'selected'; ?>>เรียนรู้</option>
                <option value="สร้างสรรค์" <?php if ($data['events']->event_types == 'สร้างสรรค์') echo 'selected'; ?>>สร้างสรรค์</option>
                <option value="วัฒนธรรม" <?php if ($data['events']->event_types == 'วัฒนธรรม') echo 'selected'; ?>>วัฒนธรรม</option>
                <option value="สุขภาพ" <?php if ($data['events']->event_types == 'สุขภาพ') echo 'selected'; ?>>สุขภาพ</option>
                <option value="พัฒนาอาชีพ" <?php if ($data['events']->event_types == 'พัฒนาอาชีพ') echo 'selected'; ?>>พัฒนาอาชีพ</option>
                <option value="other" <?php if ($data['events']->event_types == 'other') echo 'selected'; ?>>อื่นๆ</option>
            </select>

        </div>
    </div>
    <div class="row mx-3 mt-3">
        <div class="d-flex justify-content-center gap-2">
            <button onclick="return confirm('คุณแน่ใจหรือไม่?')" class="btn btn-green rounded-4 " >แก้ไขกิจกรรม</button>
            <button type="button" class="btn btn-red rounded-4" onclick="window.location.href='/activity_detail?event_id=<?php echo urlencode($data['events']->event_id); ?>';">ยกเลิก</button>
        </div>
    </div>
</form>

            </div>
        </div>
    </div>
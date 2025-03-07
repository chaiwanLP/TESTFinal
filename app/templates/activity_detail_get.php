
    <style>
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
      .background-green{
    margin: 0;
    height: 100vh;
    background: linear-gradient(30deg, #CCEE88, #F5F391, #CCEE88, #CCEE88, #F5F391, #CCEE88);
    background-size: 200% 200%;
}
.btn-yellow{
    background-color: #F5F391;
}
.btn-yellow:hover{
    background-color:rgba(245, 243, 145, 0.6);
}
.btn-red{
    background-color: #FDC1B2;
}
.btn-red:hover{
    background-color: rgba(253, 193, 178, 0.6);
}
.btn-green{
    background-color: #CCEE88;
}
.btn-green:hover{
    background-color: rgba(204, 238, 136, 0.6);
}
.resized-image {
    width: 120px;
    height: auto;
}
.search-input {
    background-color: rgba(255, 255, 255, 0.5);
    border: 1px solid #ccc;
}
.image-gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);  /* จัดให้มี 3 คอลัมน์ในแต่ละแถว */
    gap: 20px;                             /* ระยะห่างระหว่างรูปภาพ */
    justify-items: center;                 /* จัดรูปภาพให้กึ่งกลางในแต่ละคอลัมน์ */
    padding: 20px 0;                       /* การเพิ่มช่องว่างรอบๆ */
}

.image-item {
    width: 100%;                           /* ให้รูปภาพยืดเต็มความกว้างของแต่ละคอลัมน์ */
    max-width: 300px;                      /* จำกัดขนาดสูงสุดของรูปภาพ */
    border-radius: 15px;                   /* ขอบมนให้กับรูปภาพ */
    overflow: hidden;                      /* ซ่อนส่วนที่เกินออกจากขอบ */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);  /* เพิ่มเงาให้กับรูปภาพ */
    transition: transform 0.3s ease;       /* เพิ่มเอฟเฟคขยายเมื่อ hover */
}

.image-item:hover {
    transform: scale(1.05);                /* ขยายขนาดรูปภาพเล็กน้อยเมื่อ hover */
}

.event-image {
    width: 100%;                            /* ให้รูปภาพยืดเต็มพื้นที่ใน .image-item */
    height: 250px;                          /* กำหนดความสูงของรูปภาพ */
    object-fit: cover;                      /* ทำให้รูปภาพไม่บิดเบี้ยว */
    border-radius: 10px;                    /* ปรับขอบให้มน */
}


    </style>
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center ">
                <button id="id-bt-1" class="bt-detail mx-2">รายละเอียด</button>
                <button id="id-bt-2" class="bt-detail mx-2">สมาชิก</button>
            </div>
            </div>
        </div>
        
        <div class="container " id="content-box">
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        

        <script>
    document.addEventListener("DOMContentLoaded", function() {
        const defaultButton = document.getElementById('id-bt-1');
    defaultButton.classList.add('active');  
        
        document.querySelectorAll('.bt-detail').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.bt-detail').forEach(btn => btn.classList.remove('active'));
                
                this.classList.add('active');

                const buttonId = this.id;
                localStorage.setItem('bt', buttonId); 
                const contentBox = document.getElementById('content-box');

                if (buttonId === "id-bt-1") {
                    contentBox.innerHTML = `
                    <div class="row m-4" ">
                <div  class="col-6 d-flex justify-content-center align-items-center ">
                    <div class="image-item">
                        <?php
                            echo '<img src="'.IMAGE_DIR."/".$data['event_image']->image.'" alt="Event Image" class="event-image" width="300" height="250">';
                        ?>
                    </div>
                </div>
                <div class="col-6">
                    <div>
                        <div class="mx-2" style="height:30px">

                        <h4><?php echo $data['event']->title; ?></h4>

                        </div>
                        <div style="height:140px">
                            <p> <?php echo $data['event']->description; ?> 
                            </p>
                        </div>
                        <div style="height:140px">
                            <label class="form-label mt-3" for="">สถานที่</label>
                            <p><?php echo $data['event']->location; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <div class="form-group d-flex align-items-center gap-2 mx-3">
                        <label class="form-label m-0" for="">วันที่:</label>
                        <input type="text" class="form-control mt-1 text-center" name="name" id="name" value="<?php
                            $start_date = new DateTime($data['event']->start_date);
                            $end_date = new DateTime($data['event']->end_date);

                            $thai_start_date = $start_date->format('j F Y'); 
                            $thai_end_date = $end_date->format('j F Y'); 


                            echo $thai_start_date . " ถึง " . $thai_end_date;
                            ?>
                            " disabled style="width: 260px;">
                    </div>
                    <div class="form-group d-flex align-items-center gap-2 mx-3">
                        <label class="form-label m-0" for="">เวลา</label>
                        <input type="text" class="form-control mt-1 text-center" name="name" id="name" value="<?php echo $data['event']->time; ?>" disabled style="width: 150px;">
                    </div>
                    <div class="form-group d-flex align-items-center gap-2 mx-3">
                        <label class="form-label m-0" for="">จำนวนที่รับ</label>
                        <input type="text" class="form-control mt-1 text-center" name="name" id="name" value="<?php echo $data['event']->participant_amount; ?>" disabled style="width: 150px;">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="d-flex justify-content-center gap-2">
                <?php 
                    if($data['isMember']) {
                        ?>
                        <a href="/checkin_by_code?event_id=<?php echo $data['event']->event_id; ?>" class="btn btn-light rounded-4">เช็คชื่อ</a>
                        <?php
                    } else{?>
                    <a href="/join_event?event_id=<?php echo $data['event']->event_id; ?>" class="btn btn-light rounded-4">สมัครเข้าร่วม</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div>
            <div>
            <h3 style="text-align: center;margin-top:5%">รูปภาพกิจกรรม</h3> 

        <?php 
            if ($data['images']->num_rows > 0) {
                echo '<div class="image-gallery">'; 
                while ($row = $data["images"]->fetch_object()) {
                    echo '<div class="image-item">'; 
                    echo '<img src="' . IMAGE_DIR . '/' . htmlspecialchars($row->image) . '" alt="Event Image" class="event-image">';
                    echo '</div>';
                }
                echo '</div>'; 
            } else {
                echo '<p class="text-center">ไม่มีกิจกรรม</p>'; 
            }
        ?>




            </div>
                    `;
                } else if (buttonId === "id-bt-2") {
                    contentBox.innerHTML = `
                    <div class="row m-4">  
                        <div class="square-detail p-4" style="overflow-y: auto;">
                            <h5 class="text-end p-3">สมาชิกทั้งหมด <?= $data['count_participants'] ?> คน</h5>
                            <div class="text-start">
                                <p class="fs-5 mx-4">ผู้สร้างกิจกรรม</p>
                            </div>
                            <div class="row m-4 d-flex justify-content-center">
                                <div class="d-flex align-items-center">
                                    <img src="<?= IMAGE_DIR . '/' . $data['organizer']->profile_image ?>" alt="Organizer Image" class="user-image rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                    <p class="fs-5"><?= $data['organizer']->username ?></p>
                                </div>
                            </div>
                            <p class="fs-5 mx-4">สมาชิก</p>
                            <div class="row m-4 d-flex justify-content-center">
                                <?php
                                    if (isset($data['participant']) && $data['participant']->num_rows > 0) {
                                        while ($row = $data['participant']->fetch_object()) {
                                ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="<?= IMAGE_DIR . '/' . $row->profile_image ?>" alt="User Image" class="user-image rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                        <p class="fs-5"><?= $row->username ?></p>
                                    </div>
                                <?php
                                        }
                                    } else {
                                ?>
                                    <div class="text-start">
                                        <p class="fs-5">ไม่มีสมาชิก</p>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    `;
                }
            });
        });
        defaultButton.click();

    });
</script>

    </body>
</html>


    <style>
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
      .square-detail{
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 20px;

        height: 200%;
      }
      .user-box {
        display: flex;
        align-items: center; 
        justify-content: center;
        height: 100%;
      }
      .background-green{
        background-color: #c4ea89; 
    margin: 0;
    height: 100vh;
    /* background: linear-gradient(30deg, #CCEE88, #F5F391, #CCEE88, #CCEE88, #F5F391, #CCEE88); */
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
.user-image {
    width: 40px; 
    height: 40px;
    object-fit: cover; 
    border-radius: 50%; 
}
.image-gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr); 
    gap: 20px;   
    justify-items: center;   
    padding: 20px 0;       
}

.image-item {
    width: 100%;                
    max-width: 300px;             
    border-radius: 15px;       
    overflow: hidden;            
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
    transition: transform 0.3s ease;
    position: relative;       
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

.delete-button {
    position: absolute;
    bottom: 10px;    
    left: 50%;
    transform: translateX(-50%);  
    background-color: #FDC1B2;    
    color: white;      
    border: none;    
    border-radius: 5px;          
    padding: 8px 16px;                     
    cursor: pointer;                     
    font-weight: bold;                
    transition: background-color 0.3s ease; 
}

.delete-button:hover {
    background-color: #F5A5A0;      
}
.image-item {
    width: 100%;              
    max-width: 300px;             
    border-radius: 15px;              
    overflow: hidden;                    
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);  
    transition: transform 0.3s ease;      
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





    </style>

      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <button id="id-bt-1" class="bt-detail mx-2">รายละเอียด</button>
            <button id="id-bt-2" class="bt-detail mx-2">สมาชิก</button>
            <button id="id-bt-3" class="bt-detail mx-2">คำขอเข้าร่วม</button>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row m-4">
          <div id="content-box" class="square-detail">
          </div>
        </div>
      </div>
      
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
                        <div class="mx-2 mb-2" style="height:30px">

                        <h4><?php echo $data['event']->title; ?></h4>

                        </div>
                        <div style="height:140px ">
                            <p> <?php echo $data['event']->description; ?> 
                            </p>
                        </div>
                        <div style="height:200px">
                          <label class="form-label mt-3" for="">สถานที่</label>
                          <p><?php echo $data['event']->location; ?>
                          </p>
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
                            " disabled style="width: 270px;">
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
                <a href="/statistics?event_id=<?php echo $data['event']->event_id; ?>" class="btn btn-light rounded-4">สถิติ</a>
                <a href="/edit_activity?event_id=<?php echo $data['event']->event_id; ?>" class="btn btn-light rounded-4"
                  onclick="return confirm('คุณต้องการแก้ไขกิจกรรมนี้?')"
                >แก้ไขกิจกรรม</a>
                <a href="/att_code?event_id=<?php echo $data['event']->event_id; ?>"  class="btn btn-light rounded-4">ดูรหัสเช็คชื่อ</a>
                <a href="/delete_event?event_id=<?php echo $data['event']->event_id; ?>" 
                  class="btn btn-danger rounded-4" 
                  onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรมนี้?')">
                  ลบกิจกรรม
              </a>

                </div>
            </div>
            <div>
            <h3 style="text-align: center;margin-top:5%">รูปภาพกิจกรรม</h3> 
            <p>รูปแรกจะเป็นรูปปกเสมอ</p>
            <?php 
                if ($data['images']->num_rows > 0) {

                    echo '<div class="image-gallery">';
                    while ($row = $data["images"]->fetch_object()) {
                        echo '<div class="image-item">';
                        echo '<img src="' . IMAGE_DIR . '/' . htmlspecialchars($row->image) . '" alt="Event Image" class="event-image">';
                        echo '<a onclick="return confirm(\'คุณต้องการลบรูปนี้?\')" href="delete_image?image_id=' . urlencode($row->image_id) . '&event_id=' . urlencode($row->event_id) . '" class="delete-button  ">ลบรูปภาพ</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<tr><td colspan="5" class="text-center ">ไม่มีกิจกรรม</td></tr>';
                }
            ?>
              <form action="/add_image" method="POST" enctype="multipart/form-data">
                <div class="row mx-3 d-flex align-items-center w-50 mx-auto">
                    <div class="col-8 mt-1 d-flex align-items-center"></div> 
                    <div class="col-8 mt-8 d-flex align-items-center">
                        <label for="activity-image" class="form-label me-3 w-50" >เพิ่มรูปกิจกรรม</label>
                        <input type="file" class="form-control" name="activity-image[]" id="activity-image" multiple required> <!-- ใส่ [] หลังชื่อ input -->
                    </div>
                    <!-- Input hidden สำหรับส่ง event_id -->
                    <input type="hidden" name="event_id" id="event_id" value="<?php echo $data['event']->event_id; ?>">

                    <div class="col-4 mt-8 d-flex justify-content-center "> <!-- ใช้ col-4 เพื่อให้ปุ่ม submit อยู่ในแถวเดียวกัน -->
                        <button onclick="return confirm(\'คุณต้องการที่จะเพิ่มรูปภาพ?\')" type="submit" class="btn btn-warning w-100">เพิ่มรูปภาพ</button> <!-- ปุ่ม submit -->
                    </div>
                </div>
          </form>





            </div>
          `;
        } else if (buttonId === "id-bt-2") {
          contentBox.innerHTML = `
            <div class="row m-4">
              <div class="square-detail p-4" style="overflow-y: auto; background-color: transparent;">
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
        } else if (buttonId === "id-bt-3") {
          contentBox.innerHTML = `
            <h5 class="text-end p-3">คำขอทั้งหมด <?= $data['count_requeted']; ?> คน</h5>
            <div class="row m-4 d-flex justify-content-center">
              <?php
              if (isset($data['requeted']) && $data['requeted']->num_rows > 0) {
                  while ($row = $data['requeted']->fetch_object()) {
              ?>
                  <div class="row d-flex justify-content-center align-items-center mb-3">
                      <div class="col-1 text-center">
                          <img src="<?= IMAGE_DIR . "/" . $row->profile_image ?>" alt="User Image" class="user-image rounded-circle" />
                      </div>
                      <div class="col-7 text-start">
                          <p class="fs-5"><?= $row->username ?></p>
                      </div>
                      <div class="col-4 d-flex justify-content-end gap-4 align-items-center">
                          <a href="approve_participant?event_id=<?php echo $data['event']->event_id; ?>&user_id=<?php echo $row->user_id; ?>" class="btn btn-yellow rounded-4">ยอมรับ</a>
                          <a href="reject_request?event_id=<?php echo $data['event']->event_id; ?>&user_id=<?php echo $row->user_id; ?>" class="btn btn-red rounded-4">ปฎิเสธ</a>
                          
                      </div>
                  </div>
              <?php
                  }
              } else {
              ?>
                  <div class="col-12 text-center">ไม่มีคำขอ</div>
              <?php
              }
              ?>
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
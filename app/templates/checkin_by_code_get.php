
    <div class="container">
        <div class="row mt-5 d-flex align-items-center justify-content-center">
            <div class="col-12 text-center">
                <p class="m-0">ชื่อกิจกรรม</p>
            </div>
        </div>
        <div class="row mt-2 d-flex align-items-center justify-content-center">
            <div class="col-12 text-center square_check">
                <p class="m-0">เช็คชื่อผ่านรหัส</p>
            </div>
        </div>
        <form action="/check_in" method="GET"> 

    <div class="row mt-2 d-flex align-items-center justify-content-center">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <input type="text" class="form-control mt-1 text-center" name="text_code_att" id="text_code_att" placeholder="ใส่รหัสผ่าน" style="width: 350px; border-radius: 20px;">
        </div>
    </div>

    <input type="hidden" name="event_id" value="<?php echo $data['event_id']; ?>">

    <!-- ปุ่มยอมรับ -->
    <div class="row mt-4 d-flex align-items-center justify-content-center">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <button type="submit" class="btn btn-warning rounded-4" style="width: 150px;">ยอมรับ</button>
        </div>
    </div>
</form>


        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        .square_check {
            background-color: rgb(255, 255, 255);
            height: 30px;
            border-radius: 20px;
            width: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</body>
</html>

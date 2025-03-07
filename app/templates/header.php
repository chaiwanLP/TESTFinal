<!doctype html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoEventive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav {
            background-color: #c4ea89;
            height: 10vh;
            padding: 10px;
        }

        .more-nav {
            background-color: #c4ea89;
            padding: 15px;
            /* border-radius: 10px; */
        }

        .nav-link {
            color: black;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #FFD700;
        }

        .btn-auth {
            /* border-radius: 20px; */
            font-weight: bold;
        }

        .resized-image {
            width: 100px;
            height: auto;
        }

        .search-input {
            border-radius: 20px;
        }
    </style>
</head>
<body class="background-green">
    <div class="container-fluid mb-1"> 
        <div class="all-nav">
            <ul class="nav justify-content-end ">
                <li class="nav-item mt-1">
                    <a class="nav-link text-black mx-1" href="/">หน้าแรก</a>
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link text-black mx-1" href="/create_activity">สร้างกิจกรรม</a>
                </li>
                <li class="nav-item mt-1">
                    <a class="nav-link text-black mx-1" href="/profile">โปรไฟล์</a>
                </li>
                <?php
                if(isset($_SESSION['timestamp'])){
                    echo '<li class="nav-item mt-1">
                        <a class="btn btn-danger mx-1" href="/logout" 
                        onclick="return confirm(\'คุณแน่ใจหรือไม่ว่าต้องการออกจากระบบ?\')">
                        ออกจากระบบ?</a>
                    </li>';

                } else{
                    echo '<li class="nav-item mt-1">
                    <a class="btn btn-success mx-1" href="/login">เข้าสู่ระบบ</a>
                </li>';
                }
                ?>

            </ul>
            <div class="more-nav">
                <div class="row">
                    <div class="col-1 d-flex align-items-center">
                        <img class="resized-image" src="https://static.vecteezy.com/system/resources/thumbnails/008/508/310/small/bath-yellow-rubber-duck-on-isolate-background-png.png" alt="">
                    </div>
                    <div class="col-9 d-flex align-items-center">
                        <h4 class="inter-font">GoEventive</h4>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <form class="d-flex" action="/search_result" role="search" method="GET">
                            <input class="form-control me-2 search-input" type="search" placeholder="ค้นหากิจกรรม" name="title">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

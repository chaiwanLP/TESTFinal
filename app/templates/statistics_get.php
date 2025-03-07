
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom Colors */
    .bg-custom-light-green {
      background-color:  #E4F5C8;
    }
    .bg-custom-green {
      background-color: #c4ea89;
    }

    /* Custom Shadows */
    .shadow-custom {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Hover Effects */
    .hover-scale {
      transition: transform 0.2s ease-in-out;
    }
    .hover-scale:hover {
      transform: scale(1.02);
    }

    /* Custom Spacing */
    .space-y-8 > * + * {
      margin-top: 2rem;
    }
    .space-y-6 > * + * {
      margin-top: 1.5rem;
    }

    /* Layout Adjustments */
    .stats-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
    }

    .stats-box {
      min-width: 250px;
      padding: 20px;
      text-align: center;
      border-radius: 15px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .flex-responsive {
        flex-direction: column;
      }
      .flex-responsive > div {
        margin-bottom: 1rem;
      }
    }

    .center-content {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
  </style>
</head>
<body class="bg-gray-100">
  <div class="container py-5 center-content mt-4">
    <div class="max-w-3xl w-100 space-y-8">
      <!-- Title -->
      <h1 class="text-center text-3xl fw-bold text-gray-800 mb-4">ชื่อกิจกรรม <?php echo $data['event']->title; ?></h1>
      <p></p>
      <!-- Top Stats -->
      <div class="stats-container">
        <div class="bg-custom-light-green stats-box shadow-custom hover-scale">
          <div class="text-lg fw-semibold mb-2">จำนวนผู้สมัครเพศหญิง</div>
          <div class="fs-1 fw-bold mb-2"><?php echo $data['get_female']; ?> คน</div>
          <div class="text-sm text-gray-600">คิดเป็น <?php echo number_format(($data['get_female'] / $data['get_total']) * 100, 2); ?> %</div>
        </div>
        <div class="bg-custom-green stats-box shadow-custom hover-scale">
          <div class="text-lg fw-semibold mb-2">จำนวนผู้สมัคร</div>
          <div class="fs-1 fw-bold mb-2"><?php echo $data['get_total']; ?> คน</div>
          <div class="d-flex justify-content-center text-sm gap-5">
            <div>
              <div>ปฏิเสธ</div>
              <div class="fw-medium"><?php echo $data['get_rejected']; ?> คน</div>
            </div>
            <div>
              <div>อนุมัติ</div>
              <div class="fw-medium"><?php
              echo $data['get_approved']; ?> คน</div>
            </div>
          </div>
        </div>
        <div class="bg-custom-light-green stats-box shadow-custom hover-scale">
          <div class="text-lg fw-semibold mb-2">จำนวนผู้สมัครเพศชาย</div>
          <div class="fs-1 fw-bold mb-2"><?php echo $data['get_male']; ?> คน</div>
          <div class="text-sm text-gray-600">คิดเป็น <?php echo number_format(($data['get_male'] / $data['get_total']) * 100, 2); ?> %</div>
        </div>
      </div>

      <!-- Middle Stats -->
      <div class="stats-container">
        <div class="bg-custom-light-green stats-box shadow-custom hover-scale">
          <div class="text-lg fw-semibold mb-2">จำนวนผู้เข้าร่วมเพศหญิง</div>
          <div class="fs-1 fw-bold mb-2"><?php echo $data['getFemaleParticipantscount']; ?> คน</div>
          <div class="text-sm text-gray-600">คิดเป็น <?php echo number_format(($data['getFemaleParticipantscount'] / $data['getParticipantCount']) * 100, 2); ?>%</div>
        </div>
        <div class="bg-custom-green stats-box shadow-custom hover-scale">
          <div class="text-lg fw-semibold mb-2">จำนวนผู้เข้าร่วม</div>
          <div class="fs-1 fw-bold mb-2">คิดเป็น <?php echo $data['getParticipantCount']; ?> คน</div>
          <div class="d-flex justify-content-center gap-5  text-sm">
            <div>
              <div>เช็คชื่อ</div>
              <div class="fw-medium"><?php echo $data['getCheckedInCount']; ?> คน</div>
            </div>
            <div>
              <div>ไม่เช็คชื่อ</div>
              <div class="fw-medium"><?php echo $data['getNotCheckedInCount']; ?> คน</div>
            </div>
          </div>
        </div>
        <div class="bg-custom-light-green stats-box shadow-custom hover-scale">
          <div class="text-lg fw-semibold mb-2">จำนวนผู้เข้าร่วมเพศชาย</div>
          <div class="fs-1 fw-bold mb-2"><?php echo $data['getMaleParticipantscount']; ?> คน</div>
          <div class="text-sm text-gray-600">คิดเป็น <?php echo number_format(($data['getMaleParticipantscount'] / $data['getParticipantCount']) * 100, 2); ?>%</div>
        </div>
      </div>

      <!-- Age Distribution Table -->
      <div class="bg-white rounded-xl shadow-custom  mt-4">
        <h2 class="text-1xl fw-bold text-gray-800 mb-5 text-center">ช่วงอายุของผู้สมัครเข้าร่วมกิจกรรม</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
    <thead class="table-success">
        <tr>
            <th>วัย</th>
            <th>ช่วงอายุ</th>
            <th>จำนวน (คน)</th>
            <th>คิดเป็นเปอร์เซ็นต์</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['get_age'] as $ageGroup): ?>
            <tr>
                <td>
                    <?php
                    switch ($ageGroup['age_group']) {
                        case '6 - 12 ปี':
                            echo 'วัยเด็ก';
                            break;
                        case '13 - 19 ปี':
                            echo 'วัยรุ่น';
                            break;
                        case '20 - 35 ปี':
                            echo 'วัยผู้ใหญ่ตอนต้น';
                            break;
                        case '36 - 55 ปี':
                            echo 'วัยกลางคน';
                            break;
                        case '56 ปีขึ้นไป':
                            echo 'วัยสูงอายุ';
                            break;
                        default:
                            echo $ageGroup['age_group'];
                    }
                    ?>
                </td>
                <td><?php echo $ageGroup['age_group']; ?></td>
                <td><?php echo $ageGroup['count']; ?> คน</td>
                <td><?php echo number_format(($ageGroup['count'] / $data['getParticipantCount']) * 100, 2); ?>%</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-custom  mt-4">
    <h2 class="text-1xl fw-bold text-gray-800 mb-5 text-center">ช่วงอายุของผู้เข้าร่วมกิจกรรม</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>วัย</th>
                    <th>ช่วงอายุ</th>
                    <th>จำนวน (คน)</th>
                    <th>คิดเป็นเปอร์เซ็นต์</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['getParticipantAgecount'] as $ageRange => $count): ?>
                    <?php if ($count > 0):?>
                        <tr>
                            <td>
                                <?php
                                switch ($ageRange) {
                                    case '6-12':
                                        echo 'วัยเด็ก';
                                        break;
                                    case '13-19':
                                        echo 'วัยรุ่น';
                                        break;
                                    case '20-35':
                                        echo 'วัยผู้ใหญ่ตอนต้น';
                                        break;
                                    case '36-55':
                                        echo 'วัยกลางคน';
                                        break;
                                    case '56+':
                                        echo 'วัยสูงอายุ';
                                        break;
                                    default:
                                        echo 'ไม่ระบุ';
                                }
                                ?>
                            </td>
                            <td><?php echo $ageRange; ?> ปี</td>
                            <td><?php echo $count; ?> คน</td>
                            <td><?php echo number_format(($count / $data['getParticipantCount']) * 100, 2); ?>%</td>

                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


            <div class="mt-5 text-center">
        <a href="/activity_detail?event_id=<?php echo urlencode($data['event']->event_id); ?>" class="btn btn-danger">กลับหน้าหลัก</a>
            </div>
    </div>
  </div>

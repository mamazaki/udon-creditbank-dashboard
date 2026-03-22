<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก | <?php echo $appName; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $appFavicon; ?>">
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <div id="dashboard" class="row mb-4 g-3 align-items-stretch text-center"></div>

    <div class="main-card">
        <h1>ข้อมูลการดำเนินงานธนาคารหน่วยกิตจังหวัดอุดรธานี</h1>
        
        <div class="filter-panel bg-light p-4 rounded-3 mb-4 border shadow-sm">
            <div class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="small fw-bold mb-1"><i class="bi bi-calendar3"></i> ปีการศึกษา</label>
                    <select id="filterYear" class="form-select border-primary"></select>
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold mb-1"><i class="bi bi-diagram-3-fill"></i> สถานศึกษาคู่พัฒนา</label>
                    <select id="filterPartner" class="form-select border-primary">
                        <option value="">--- แสดงทั้งหมด ---</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="small fw-bold mb-1"><i class="bi bi-search"></i> ค้นหาชื่อสถานศึกษา</label>
                    <input type="text" id="searchSchool" class="form-control border-primary" placeholder="พิมพ์ชื่อโรงเรียน...">
                </div>
                <div class="col-md-2 d-grid">
                    <button id="btnReset" class="btn btn-outline-danger"><i class="bi bi-arrow-counterclockwise"></i> ล้างตัวกรอง</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="myDataTable" class="table table-hover w-100">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;" class="text-center"></th>
                        <th>ชื่อสถานศึกษา</th>
                        <th>สถานศึกษาคู่พัฒนา</th>
                        <th>ชื่อหลักสูตร</th>
                        <th class="text-center">นักเรียนรวม</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    <div class="container text-center">
        <p class="mb-2 fw-bold" style="color: #fff; letter-spacing: 1px;"><?php echo $appName; ?></p>
        <p class="mb-1">ออกแบบ และพัฒนาโดย นายสุทธิชัย ชมชื่น</p>
        <p class="mb-3 opacity-75">นักวิชาการคอมพิวเตอร์ชำนาญการ กลุ่มนโยบายและแผน สำนักงานศึกษาธิการจังหวัดอุดรธานี</p>
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
            <p class="mb-0 small opacity-50">&copy; 2026 Udon Thani Provincial Education Office</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>

<script>
    const googleSheetUrl = "<?php echo $googleSheetUrl; ?>";
</script>

<script src="script.js"></script>

</body>
</html>
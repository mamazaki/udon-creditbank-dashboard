<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าแรก | <?php echo $appName; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $appFavicon; ?>">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root { --primary: #2c3e50; --accent: #3498db; --bg-light: #f4f7f6; }
        body { font-family: 'Sarabun', sans-serif; background-color: var(--bg-light); color: #333; }
        .main-card { background: #fff; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); padding: 25px; margin-bottom: 30px; }
        h1 { color: var(--primary); font-weight: 600; font-size: 1.4rem; border-left: 6px solid var(--accent); padding-left: 15px; margin-bottom: 25px; }
        .stat-card { background: #fff; border-radius: 12px; border: 1px solid #eee; border-top: 4px solid var(--accent); transition: 0.3s; height: 100%; padding: 20px; text-align: center; cursor: pointer; display: flex; flex-direction: column; justify-content: center; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(52, 152, 219, 0.2); }
        .stat-card.active-filter { border: 2px solid var(--accent); background-color: rgba(52, 152, 219, 0.05); }
        .expand-icon { cursor: pointer; color: var(--accent); font-size: 1.3rem; }
        .dataTables_filter { display: none; }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container">
    <div id="dashboard" class="row mb-4 g-3 d-flex align-items-stretch text-center"></div>

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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.4.1/papaparse.min.js"></script>

<script>
$(document).ready(function() {
    let rawData = [];
    let latestYear = "";
    // ดึง URL จาก PHP config
    const googleSheetUrl = "<?php echo $googleSheetUrl; ?>";

    const table = $('#myDataTable').DataTable({
        columns: [
            { className: 'dt-control text-center', orderable: false, data: null, defaultContent: '<i class="bi bi-plus-circle-fill expand-icon text-primary"></i>' },
            { data: 'ชื่อสถานศึกษา' }, 
            { data: 'สถานศึกษาคู่พัฒนา' }, 
            { data: 'ชื่อหลักสูตร' }, 
            { data: 'จำนวนนักเรียน', className: 'text-center fw-bold' }
        ],
        order: [[1, 'asc']], dom: 'rtip',
        language: { url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Thai.json" }
    });

    function formatDetails(d) {
        return `<div class="p-4 border rounded-3 bg-light shadow-sm small">
            <div class="fw-bold text-primary mb-3 border-bottom pb-2">รายละเอียดเชิงลึก</div>
            <div class="row g-2 text-center mb-3">
                ${['ม.1','ม.2','ม.3','ม.4','ม.5','ม.6'].map(m => `
                    <div class="col-4 col-md-2">
                        <div class="p-2 border bg-white rounded shadow-sm">
                            <span class="text-muted" style="font-size: 0.7rem;">${m}</span><br>
                            <b>${d[m] || 0}</b>
                        </div>
                    </div>`).join('')}
            </div>
            <div class="p-2 bg-white rounded border">
                <strong>การจัดการเรียนรู้:</strong> ${d["การจัดการเรียนรู้"]} | <strong>ระดับ:</strong> ${d["ระดับการเชื่อมโยง"]} | <strong>ชั้นปี:</strong> ${d["ชั้นปี"]}
            </div>
        </div>`;
    }

    $('#myDataTable tbody').on('click', 'td.dt-control', function () {
        const tr = $(this).closest('tr'), row = table.row(tr), icon = $(this).find('i');
        if (row.child.isShown()) { row.child.hide(); tr.removeClass('shown'); icon.removeClass('bi-dash-circle-fill text-danger').addClass('bi-plus-circle-fill text-primary'); }
        else { row.child(formatDetails(row.data()), 'details-row').show(); tr.addClass('shown'); icon.removeClass('bi-plus-circle-fill text-primary').addClass('bi-dash-circle-fill text-danger'); }
    });

    Papa.parse(googleSheetUrl, {
        download: true, header: true, skipEmptyLines: true,
        complete: function(results) {
            rawData = results.data;
            const years = [...new Set(rawData.map(d => d["ปีการศึกษา"]))].filter(y => y).sort().reverse();
            latestYear = years[0];
            years.forEach(y => $('#filterYear').append(`<option value="${y}">${y}</option>`));
            resetAllFilters();
        }
    });

    function applyFilters() {
        const selYear = $('#filterYear').val(), selPartner = $('#filterPartner').val(), searchTerm = $('#searchSchool').val();
        let filtered = rawData.filter(d => d["ปีการศึกษา"] == selYear);
        const partnerSelect = $('#filterPartner'), currentPartnerVal = partnerSelect.val();
        const availablePartners = [...new Set(filtered.map(d => d["สถานศึกษาคู่พัฒนา"]))].filter(p => p).sort();
        partnerSelect.find('option:not(:first)').remove();
        availablePartners.forEach(p => partnerSelect.append(`<option value="${p}">${p}</option>`));
        partnerSelect.val(currentPartnerVal);
        if (selPartner) filtered = filtered.filter(d => d["สถานศึกษาคู่พัฒนา"] == selPartner);
        updateDashboard(rawData.filter(d => d["ปีการศึกษา"] == selYear), selPartner);
        table.clear().rows.add(filtered).draw();
        table.column(1).search(searchTerm).draw();
    }

    function resetAllFilters() { $('#filterYear').val(latestYear); $('#filterPartner').val(""); $('#searchSchool').val(""); applyFilters(); }

    function updateDashboard(data, activePartner) {
        const summary = data.reduce((acc, curr) => { const p = curr["สถานศึกษาคู่พัฒนา"] || "ไม่ระบุ"; acc[p] = (acc[p] || 0) + 1; return acc; }, {});
        let html = '';
        Object.entries(summary).forEach(([name, count]) => {
            const isActive = (name === activePartner) ? 'active-filter' : '';
            html += `<div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch"><div class="card stat-card border-0 shadow-sm mb-3 ${isActive}" onclick="filterByCard('${name}')"><div class="stat-title text-truncate">${name}</div><div class="stat-value text-primary">${count} <small style="font-size: 12px; font-weight:normal; color:#999;">แห่ง</small></div></div></div>`;
        });
        $('#dashboard').html(html);
    }

    window.filterByCard = function(n) { const s = $('#filterPartner'); s.val(s.val() === n ? "" : n); applyFilters(); };
    $('#filterYear, #filterPartner').on('change', applyFilters);
    $('#searchSchool').on('keyup', applyFilters);
    $('#btnReset').on('click', resetAllFilters);
});
</script>
</body>
</html>
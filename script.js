$(document).ready(function() {
    let rawData = [];
    let latestYear = "";

    const table = $('#myDataTable').DataTable({
        columns: [
            { className: 'dt-control text-center', orderable: false, data: null, defaultContent: '<i class="bi bi-plus-circle-fill text-primary"></i>' },
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
                        <div class="grade-box">
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

    window.resetAllFilters = function() { 
        $('#filterYear').val(latestYear); 
        $('#filterPartner').val(""); 
        $('#searchSchool').val(""); 
        applyFilters(); 
    }

    function updateDashboard(data, activePartner) {
        const summary = data.reduce((acc, curr) => { const p = curr["สถานศึกษาคู่พัฒนา"] || "ไม่ระบุ"; acc[p] = (acc[p] || 0) + 1; return acc; }, {});
        let html = '';
        Object.entries(summary).forEach(([name, count]) => {
            const isActive = (name === activePartner) ? 'active-filter' : '';
            html += `<div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch"><div class="card stat-card border-0 shadow-sm mb-3 ${isActive}" onclick="filterByCard('${name}')"><div class="stat-title">${name}</div><div class="stat-value text-primary">${count} <small style="font-size: 12px; font-weight:normal; color:#999;">แห่ง</small></div></div></div>`;
        });
        $('#dashboard').html(html);
    }

    window.filterByCard = function(n) { const s = $('#filterPartner'); s.val(s.val() === n ? "" : n); applyFilters(); };
    $('#filterYear, #filterPartner').on('change', applyFilters);
    $('#searchSchool').on('keyup', applyFilters);
    $('#btnReset').on('click', resetAllFilters);
});
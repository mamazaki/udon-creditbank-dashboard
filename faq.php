<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำถามที่พบบ่อย | UDON THANI CREDIT BANK CENTER</title>
    <link rel="icon" type="image/png" href="https://pmss.udonpeo.go.th/images/favicons/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sarabun', sans-serif; background-color: #f4f7f6; }
        .faq-card { border-radius: 15px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .accordion-button:not(.collapsed) { background-color: #3498db; color: white; }
    </style>
</head>
<body>

<?php include 'menu.php'; ?>

<div class="container py-4">
    <div class="card faq-card p-4">
        <h1 class="mb-4 fs-3 fw-bold text-primary border-bottom pb-2">คำถามที่พบบ่อย (FAQ)</h1>
        <div class="accordion" id="faqAccordion">
            <?php
            $faqs = [
                ["ธนาคารหน่วยกิต (Credit Bank) คืออะไร?", "คือระบบที่เปิดโอกาสให้ผู้เรียนสะสมผลการเรียนจากหลักสูตรต่างๆ เพื่อเทียบโอนหน่วยกิตในการศึกษาต่อได้"],
                ["ใครคือกลุ่มเป้าหมายของระบบนี้?", "นักเรียนในสถานศึกษาที่เชื่อมโยงหลักสูตรอาชีวศึกษาและอุดมศึกษาในจังหวัดอุดรธานี"],
                ["สถานศึกษาคู่พัฒนาคือหน่วยงานใด?", "หน่วยงานทางการศึกษาที่ทำความร่วมมือ (MOU) เช่น มรภ.อุดรธานี วิทยาลัยอาชีวศึกษา ฯลฯ"],
                ["การเข้าถึงข้อมูล Dashboard ทำได้อย่างไร?", "สามารถเรียกดูได้ผ่านเว็บไซต์สำนักงานศึกษาธิการจังหวัดอุดรธานี"],
                ["ทำไมต้องมีระบบรายงานผลออนไลน์?", "เพื่อความโปร่งใสและเป็นข้อมูลสนับสนุนการตัดสินใจเชิงนโยบายแก่ผู้บริหาร"],
                ["ข้อมูลในตารางมาจากแหล่งใด?", "มาจากการจัดเก็บผลการดำเนินงานของสถานศึกษาคู่พัฒนาในจังหวัดอุดรธานี"],
                ["หากพบข้อมูลไม่ถูกต้องต้องติดต่อใคร?", "ติดต่อกลุ่มนิเทศ ติดตาม และประเมินผล สำนักงานศึกษาธิการจังหวัดอุดรธานี"],
                ["หลักสูตรใดบ้างที่สามารถสะสมหน่วยกิตได้?", "หลักสูตรที่มีการจัดการเรียนรู้ร่วมกันและผ่านการรับรองจากคณะกรรมการธนาคารหน่วยกิต"],
                ["ผู้บริหารสามารถใช้ประโยชน์จากระบบนี้ได้อย่างไร?", "ใช้ติดตามความคืบหน้า จำนวนผู้เรียน และสถานะการดำเนินงานรายภาคเรียน"],
                ["อนาคตระบบจะมีการเพิ่มฟีเจอร์ใดบ้าง?", "การจัดทำระบบติดตามผู้เรียนรายบุคคล (Tracking System) และแผนที่การศึกษา"]
            ];
            foreach ($faqs as $i => $faq) {
                echo '<div class="accordion-item mb-2 border-0 shadow-sm">
                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$i.'">'.$faq[0].'</button></h2>
                    <div id="collapse'.$i.'" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted">'.$faq[1].'</div></div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
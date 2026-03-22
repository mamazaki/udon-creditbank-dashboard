# UDON THANI CREDIT BANK CENTER 🏦
**ระบบบริหารจัดการและรายงานข้อมูลการดำเนินงานธนาคารหน่วยกิต จังหวัดอุดรธานี**

## 📝 เกี่ยวกับโปรเจกต์ (About)
โปรเจกต์นี้พัฒนาขึ้นเพื่อเป็นเครื่องมือสำหรับผู้บริหารและเจ้าหน้าที่ในการติดตามผลการดำเนินงานโครงการธนาคารหน่วยกิต (Credit Bank) ในพื้นที่จังหวัดอุดรธานี โดยมุ่งเน้นการเปลี่ยนผ่านจากการเก็บข้อมูลแบบเอกสารหรือไฟล์ Static สู่ระบบ **Digital Dashboard** ที่มีความเป็นปัจจุบันและเข้าถึงง่าย

## ✨ คุณสมบัติเด่น (Features)
- **Cloud-Based Data Synchronization:** เชื่อมต่อฐานข้อมูลผ่าน Google Sheets API ทำให้การอัปเดตข้อมูลทำได้ง่ายและทันที (Real-time update)
- **Interactive Analytics Dashboard:** สรุปยอดสถานศึกษาคู่พัฒนาในรูปแบบ Card ที่สามารถคลิกเพื่อกรองข้อมูล (Filter) ได้ทันที
- **Multi-Level Filtering:** ระบบกรองข้อมูล 3 ชั้น (ปีการศึกษา > หน่วยงานคู่พัฒนา > ค้นหาชื่อโรงเรียน)
- **Responsive & Accessible:** ออกแบบตามหลัก UX/UX รองรับการใช้งานผ่านสมาร์ทโฟนและแท็บเล็ต
- **Government Standard:** ใช้ฟอนต์ TH Sarabun และโครงสร้างเมนูตามมาตรฐานงานราชการ

## 🛠️ เทคโนโลยีที่ใช้ (Tech Stack)
- **Frontend:** HTML5, CSS3 (Bootstrap 5), JavaScript (jQuery)
- **Data Engine:** DataTables.js, PapaParse.js
- **Backend:** PHP (Environment-based Configuration)
- **Database:** Google Sheets (Published as CSV)

## 📂 โครงสร้างโปรเจกต์
- `index.php` - หน้าจอหลัก Dashboard และตารางข้อมูล
- `menu.php` - ส่วนแถบเมนูนำทาง (Modular Component)
- `config.php` - ระบบจัดการค่าตัวแปรสภาพแวดล้อม (Environment Handler)
- `faq.php` - หน้าข้อมูลคำถามที่พบบ่อย
- `.env.example` - แม่แบบการตั้งค่า URL และ Assets ของระบบ
- `template.csv` - โครงสร้างฐานข้อมูลตัวอย่างสำหรับผู้ใช้งานใหม่

## 🚀 การติดตั้ง (Installation)
1. Clone repository นี้ไปยัง Web Server ของคุณ
2. คัดลอกไฟล์ `.env.example` เป็น `.env`
3. ตั้งค่า `GOOGLE_SHEET_URL` และ URL ของโลโก้ในไฟล์ `.env`
4. ตรวจสอบให้แน่ใจว่า Web Server รองรับ PHP 7.4 ขึ้นไป

---
👨‍💻 **พัฒนาโดย:** นายสุทธิชัย ชมชื่น
นักวิชาการคอมพิวเตอร์ชำนาญการ | กลุ่มนโยบายและแผน สำนักงานศึกษาธิการจังหวัดอุดรธานี

# UDON THANI CREDIT BANK CENTER 🏦
**ระบบบริหารจัดการและรายงานข้อมูลการดำเนินงานธนาคารหน่วยกิต จังหวัดอุดรธานี**

โปรเจกต์นี้พัฒนาขึ้นเพื่อเปลี่ยนผ่านการจัดเก็บข้อมูลการดำเนินงานธนาคารหน่วยกิต จากระบบเอกสารสู่ Digital Dashboard ที่แสดงผลแบบ Real-time รองรับการวิเคราะห์ข้อมูลเชิงนโยบายสำหรับผู้บริหารและเจ้าหน้าที่

## ✨ คุณสมบัติเด่น (Features)
- **Interactive Analytics:** สรุปจำนวนสถานศึกษาแยกตามหน่วยงานคู่พัฒนาผ่าน Dashboard Card
- **Real-time Synchronization:** เชื่อมโยงฐานข้อมูลจาก Google Sheets (CSV) โดยตรง
- **Multi-Level Filtering:** ระบบกรองข้อมูลตามปีการศึกษา, หน่วยงานคู่พัฒนา และค้นหาชื่อโรงเรียน
- **Responsive Layout:** แสดงผลสมบูรณ์ทุกอุปกรณ์ (Mobile, Tablet, Desktop)
- **Clean URL:** พัฒนาด้วยไฟล์ .htaccess เพื่อความสวยงามของ URL (เช่น `/faq` แทน `faq.php`)

## 🛠️ เทคโนโลยีที่ใช้ (Tech Stack)
- **Frontend:** HTML5, CSS3 (Bootstrap 5), JavaScript (jQuery)
- **Data Engine:** DataTables.js, PapaParse.js
- **Backend:** PHP (Environment-based Configuration)
- **Data Source:** Google Sheets (Published as CSV)

---

## 📊 โครงสร้างข้อมูล (Data Structure)
เพื่อให้ระบบแสดงผลได้อย่างถูกต้อง ข้อมูลใน Google Sheets หรือไฟล์ CSV ต้องมีโครงสร้าง Header ดังนี้:

| ที่ | ปีการศึกษา | ชื่อสถานศึกษา | สถานศึกษาคู่พัฒนา | ชั้นปี | ม.1 | ม.2 | ม.3 | ม.4 | ม.5 | ม.6 | จำนวนนักเรียน | ชื่อหลักสูตร | ระดับการเชื่อมโยง | การจัดการเรียนรู้ |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| 1 | 2567 | มัธยมเทศบาล ๖ นครอุดรธานี | วิทยาลัยอาชีวศึกษาอุดรธานี | ม.3 | 0 | 0 | 15 | 0 | 0 | 0 | 15 | ตัดเย็บ 5 | 2 | วิชาเพิ่มเติม |

---

## 🌐 วิธีการตั้งค่า Google Sheets เป็นฐานข้อมูล
1. **เตรียมข้อมูล:** สร้าง Google Sheets และกรอกข้อมูลตามหัวตารางข้างต้น
2. **Publish to Web:** - ไปที่ **ไฟล์ (File)** > **แชร์ (Share)** > **เผยแพร่ไปยังเว็บ (Publish to web)**
   - เลือก **"ค่าที่คั่นด้วยจุลภาค (.csv)"** แทนเว็บเพจ
   - กดปุ่ม **เผยแพร่ (Publish)** และคัดลอก URL ที่ได้
3. **เชื่อมต่อ:** นำ URL ไปวางในไฟล์ `.env` ที่ตัวแปร `GOOGLE_SHEET_URL`

---

## 🚀 การติดตั้ง (Installation)
1. Clone Repository นี้ไปยัง Web Server
2. สร้างไฟล์ `.env` โดยคัดลอกต้นแบบจาก `.env.example`
3. ตั้งค่าข้อมูลใน `.env` ให้ครบถ้วน:
   - `GOOGLE_SHEET_URL`: ลิงก์ CSV จาก Google Sheets
   - `APP_LOGO_URL`: ลิงก์รูปโลโก้หน่วยงาน
4. ตรวจสอบว่า Server รองรับ `mod_rewrite` (สำหรับ Clean URL)
5. หากใช้งานบน Local (เช่น XAMPP) ให้ตั้งค่า `AllowOverride All` ในคอนฟิกของ Apache

---

## 📂 โครงสร้างไฟล์ในโปรเจกต์
- `index.php` - หน้า Dashboard หลัก
- `menu.php` - ส่วนแถบเมนูนำทาง (Modular Component)
- `config.php` - ระบบจัดการค่าสภาพแวดล้อม (Environment Handler)
- `faq.php` - หน้าคำถามที่พบบ่อย
- `style.css` - ไฟล์กำหนดรูปแบบการแสดงผล (External Stylesheet)
- `script.js` - ไฟล์จัดการ Logic และการดึงข้อมูล (External JavaScript)
- `.htaccess` - ไฟล์กำหนดกฎการแสดงผล URL (Clean URL)

---

## 👨‍💻 ออกแบบและพัฒนาโดย
**นายสุทธิชัย ชมชื่น** นักวิชาการคอมพิวเตอร์ชำนาญการ  
กลุ่มนโยบายและแผน สำนักงานศึกษาธิการจังหวัดอุดรธานี

---
© 2026 Udon Thani Provincial Education Office - All Rights Reserved

Đây là bản rút gọn, tập trung vào tính chuyên nghiệp và đúng các yêu cầu kỹ thuật của bạn:

🚀 Filament Admin - Quản lý Sản phẩm
Sinh viên: Nguyễn Trọng An

MSSV: 23810310263

✨ Tính năng nổi bật
Database: Các bảng bắt đầu bằng sv23810310263\_.

Giao diện: Đã đổi Primary Color (AdminPanelProvider) sang màu riêng biệt.

Category: Tự động tạo Slug, lọc trạng thái hiển thị.

Product:

Sử dụng Grid Layout, Rich Editor, Upload ảnh.

Giá tiền định dạng VNĐ, Validation không âm.

Trường sáng tạo: discount_percent (Phần trăm giảm giá) kèm logic kiểm tra giá trị 0-100%.

🛠 Cài đặt nhanh
git clone [link-repo]

composer install

Cấu hình .env (Database prefix sv23810310263\_)

php artisan migrate

php artisan make:filament-user

📈 Lịch sử Commit
Init: Khởi tạo Project & Database prefix MSSV

Config: Cài đặt Filament & tùy chỉnh Theme color

Feat: Hoàn thiện CategoryResource & Auto-slug

Feat: Hoàn thiện ProductResource (Grid, RichEditor, VNĐ)

Logic: Thêm trường sáng tạo discount_percent & Validation

# Phầm mềm quản lý sinh viên!

Student Management System (SMS) là phần mềm quản lý sinh viên được lập trình bằng ngôn ngữ PHP (không sử dụng framework có sẵn) sử dụng cơ sở dữ liệu MySQL.


## Các chức năng

- Giáo viên có thể thêm, sửa, xóa các thông tin của sinh viên. Thông tin có
các trường cơ bản gồm: tên đăng nhập, mật khẩu, họ tên, email, số điện
thoại
- Sinh viên sau khi đăng nhập được phép thay đổi các thông tin của mình,
cho phép upload avatar từ file hoặc url; sinh viên không được phép thay
đổi tên đăng nhập và họ tên
- Một người dùng (giáo viên hoặc sinh viên) bất kỳ đc phép xem danh
sách các người dùng trên website và xem thông tin chi tiết của một
người dùng khác. Tại trang xem thông tin chi tiết của một người dùng có
mục để lại tin nhắn cho người dùng đó, có thể sửa/xóa tin nhắn đã gửi.
- Chức năng giao bài, trả bài:
     - Giáo viên có thể upload file bài tập lên. Các sinh viên có thể xem
danh sách bài tập và tải file bài tập về.
    - Sinh viên có thể upload bài làm tương ứng với bài tập được giao.
Chỉ giáo viên mới nhìn thấy danh sách bài làm này
- Tạo chức năng cho phép giáo viên tổ chức 1 trò chơi giải đố như sau:
    - Giáo viên tạo challenge, trong đó cần thực hiện: upload lên 1 file
txt có nội dung là 1 bài thơ, văn,…, tên file được viết dưới định
dạng không dấu và các từ cách nhau bởi 1 khoảng trắng. Sau đó
nhập gợi ý về challenge và submit. (Đáp án chính là tên file mà
giáo viên upload lên. Không lưu đáp án ra file, DB,…)
    - Sinh viên xem gợi ý và nhập đáp án. Khi sinh viên nhập đúng thì
trả về nội dung bài thơ, văn,… lưu trong file đáp án
## Demo
Website có thể hoạt động tốt trên localhost, tuy nhiên gặp lỗi khi deploy online. Hiện tại mình chưa rõ nguyên nhân sinh ra lỗi dù đã loay hoay khá lâu. Do bản thân mình chưa có đủ kinh nghiệm, kiến thức trong việc deploy một trang web. Mình xin phép được demo qua video và hình ảnh, các bạn có thể tải source code về máy để chạy thử.  Nếu bạn nào đã deploy thành công, có thể liên hệ mình để cập nhật lại thông tin trên repo, mình cũng mong có thể giải quyết được lỗi trên.\
**Video demo**
\Demo Student Using System
\https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/videos/demo_student_using_system_part1.mp4

1. Quảng lý người dùng
Mỗi người dùng đều có một trang cá nhân chứa các thông tin cơ bản và một hộp thoại bên dưới để người dùng khác có thể tương tác.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-32-14%20Dashboard%20-%20Student%20Management%20System.png)
Mỗi người dùng có thể thay đổi thông tin cá nhân của mình trên hệ thống
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-34-04%20User%20Detail%20-%20Student%20Management%20System.png)
2. Giao diện trang chủ

![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/1.png)

 2. Giao diện trang đăng nhập

![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2001-17-00%20Login%20-%20Student%20Management%20System.png)
 3. Giao diện trang đăng ký
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2001-22-29%20Sign%20up%20-%20Student%20Management%20System.png)
 4. Sau khi đăng nhập vào hệ thống, người dùng có thể truy cập vào trang quản trị (sinh viên và giảng viên sẽ có nội dung hiển thị khác nhau).
 - Sinh viên chỉ có thể xem được các nội dung sau: Danh sách bài thi, danh sách các câu đố, danh sách người dùng trong hệ thống và hộp thư chứa tin nhắn của sinh viên này.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2001-24-51%20Dashboard%20-%20Student%20Management%20System.png)
 - Giáo viên có thể thực hiện thêm các chức năng sau:
   - Xem danh sách sinh viên, thêm, sửa, xóa thông tin sinh viên.
   - Xem danh sách giáo viên, thêm, sửa, xóa thông tin giáo viên
   - Xem danh sách các bài thi, thêm, sửa, xóa thông tin bài thi, xem danh sách nộp bài và chấm điểm bài của sinh viên
   - Xem danh sách các câu đố, thêm, sửa, xóa thông tin câu đố, xem danh sách và kết quả của các sinh viên tham gia giải đố.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2001-31-24%20Dashboard%20-%20Student%20Management%20System.png)
5. Giao diện phần quản lý bài kiểm tra
Giáo viên quản lý danh sách bài thi, có thêm các quyền tạo mới, chỉnh sửa và xóa các bài thi.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2001-48-14%20Manage%20Exams%20-%20Student%20Management%20System.png)
Khi người dùng thực hiện thao tác xóa bài kiểm tra, bảng xác định lại yêu cầu được hiển thị.
![Trang xóa bài kiểm tra](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2001-53-23%20Manage%20Exams%20-%20Student%20Management%20System.png)
Thêm bài kiểm tra mới
![Trang thêm mới bài kiểm tra](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2001-55-42%20Add%20Exams%20-%20Student%20Management%20System.png)
Giáo viên có thể xem chi tiết của từng bài kiểm tra
![Hiển thị các thông tin liên quan đến bài kiểm tra và danh sách sinh viên nộp bài](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2008-53-39%20Exam%20Detail%20-%20Student%20Management%20System.png)
Đôi với sinh viên, khi vào trang quản lý bài thi, chỉ có thể xem thông tin về danh sách các bài thi đang mở, xem chi tiết một bài thi và nộp bài thi đó.
![Sinh viên xem danh sách các bài thi đang mở](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2008-58-18%20Exam%20List%20-%20Student%20Management%20System.png)
Trang xem chi tiết và nộp bài thi
![Sinh viên xem thi tiết bài thi và nộp bài](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2008-59-53%20Exam%20Detail%20-%20Student%20Management%20System.png)
6. Giao diện quản lý các câu đố
Cũng tương tự như phần quản lý bài thi, quản lý câu đố cũng bao gồm các tác vụ: thêm câu đó, xem danh sách câu đố đã được tạo, chỉnh sửa và xóa. Đối với sinh viên, chỉ có thêm xem danh sách câu đố và nộp đáp án. Ở đây, sinh viên không nộp file mà chỉ nhập đáp án qua form.
Giáo viên thêm câu đố mới
![Giáo viên thêm câu đố mới](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-11-20%20Add%20Challenges%20-%20Student%20Management%20System.png)
Giao diện trang quản lý danh sách câu đố của giáo viên
![Giao diện trang quản lý danh sách câu đố của giáo viên](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-13-32%20Manage%20Challenges%20-%20Student%20Management%20System.png)
Trang nội dung chi tiết của câu đố
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-16-44%20Challenge%20Detail%20-%20Student%20Management%20System.png)
Trang nộp đáp án của sinh viên
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-22-51%20Challenge%20Detail%20-%20Student%20Management%20System.png)
7. Quản lý sinh viên (Chỉ có giáo viên có quyền truy cập)
Bao gồm các trang danh sách sinh viên có thể thêm, sửa, xóa thông tin của sinh viên.
Chức năng thêm sinh viên mới
![Giáo viên thêm sinh viên mới](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-26-15%20Add%20Students%20-%20Student%20Management%20System.png)
Chức năng quản lý, thêm, sửa, xóa thông tin sinh viên
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2009-28-30%20Manage%20Students%20-%20Student%20Management%20System.png)
8. Quản lý lớp học (Chỉ giáo viên có quyền truy cập)
Danh sách thông tin các lớp học
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2011-07-54%20Manage%20Classes%20-%20Student%20Management%20System.png)
Thêm lớp học mới
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2011-12-00%20Add%20Classes%20-%20Student%20Management%20System.png)
Cập nhật thông tin lớp học
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2011-13-32%20Class%20Detail%20-%20Student%20Management%20System.png)
9. Quản lý giáo viên (Chỉ giáo viên có quyền truy cập)
 Danh sách giáo viên
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2011-14-42%20Manage%20Teachers%20-%20Student%20Management%20System.png)
Thêm giáo viên mới vào hệ thống
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2011-17-13%20Add%20Teachers%20-%20Student%20Management%20System.png)
10. Danh sách người dùng trong hệ thống 
Bao gồm tất cả giáo viên và sinh viên trong hệ thống. Tại đây người dùng có thể xem các thông tin và liên hệ với người dùng khác.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2011-18-40%20All%20Users%20-%20Student%20Management%20System.png)
11. Hộp thoại 
Trang hộp thoại chứa tin nhắn của người dùng. Lưu lịch sử cuộc trò chuyện của người dùng trong hệ thống. Các tin nhắn được gửi từ trang cá nhân cũng sẽ được hiển thị tại đây.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2014-32-13%20Message%20Section%20-%20Student%20Management%20System.png)
Khi chọn vào cuộc hội thoại bất kì, sẽ hiện lên trang tin nhắn chi tiết.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2014-35-40%20Messenger%20-%20Student%20Management%20System.png)
## Công nghệ
- HTML: Thiết kế giao diện web
- CSS: Thiết kế giao diện web
- Javascript: Thiết kế giao diện web
- PHP: Thiết kế backend
- MySQL: Quản trị cơ sở dữ liệu
## Cài đặt
1. Đầu tiên, bạn cần tải phần mềm XAMPP hoặc các phần mềm có chức năng tương tự XAMPP.
2. Vào thư mục cài đặt XAMPP, tìm thư mục có tên htdocs. Sau đấy copy toàn bộ source code này vào. Bạn có thể xóa đi các file mặc định của XAMPP và thay thế bằng source code trên. Khi đấy, bạn chỉ cần truy cập vào địa chỉ localhost, website sẽ được hiển thị. Còn nếu bạn tạo một thư mục mới và copy source code vào đấy, ví dụ tạo sms trong thư mục htdocs, thì để có thể truy cập website, bạn phải truy nhập vào đường dẫn localhost/sms.
3. Khởi chạy các ứng dụng Apache và MySQL trên XAMPP. Nếu bạn sử dụng Windows, có thể thao tác thông qua giao diện đồ họa.
![enter image description here](https://a.fsdn.com/con/app/proj/xampp/screenshots/Screen%20Shot%202016-02-19%20at%2016.png/max/max/1)
Nếu bạn sử dụng Linux hoặc bản phân phối Debian, chạy lệnh sau trên terminal
```
sudo /opt/lampp/lampp start
``` 
4. Bây giờ nếu ta truy cập vào website, sẽ có lỗi xảy ra do hệ thống chưa thể tương tác được với cơ sở dữ liệu.
Để có thể kết nối được với cơ sở dữ liệu, ta khai báo các thông tin cần thiết liên quan đến cơ sở dữ liệu tại file config.php
```
<?php
    // Database Configuration
    $db_servername = "localhost";
    $db_username = "root";
    $db_port = 3306;
    $db_password = "";
    $db_name = "test";
?>
```
Nếu bạn sử dụng cơ sở dữ liệu MySQL trên XAMPP thì để mặc định cấu hình trên.
5. Sau đấy tiến hành xây dựng cơ sở dữ liệu bằng cách import file sql vào trong cơ sở dữ liệu MySQL. File dùng để import được mình để trên source code với tiêu đề studentmsdb.sql.
- Đăng nhập vào phpMyAdmin tại đường dẫn localhost/phpmyadmin
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/Screenshot%202022-06-15%20at%2015-04-55%20localhost%20_%20localhost%20phpMyAdmin%205.2.0.png)
- Sau đấy vào tab Import và thực hiện chọn file từ máy tính, bấm Go để tiến hành tạo cơ sở dữ liệu.
![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/importsql.png)
6. Bây giờ, ta truy nhập vào địa chỉ website để sử dụng
 ![enter image description here](https://github.com/minhmannh2001/studentmanagementsystem/blob/main/demo/images/1.png)
## Đóng góp
Tác giả: Nguyễn Minh Mạnh | [Facebook profile](https://www.facebook.com/minhmannh2001/)

﻿# Phầm mềm quản lý sinh viên!

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
Website có thể hoạt động tốt trên localhost, tuy nhiên gặp lỗi khi deploy online. Hiện tại mình chưa rõ nguyên nhân sinh ra lỗi dù đã loay hoay khá lâu. Do bản thân mình chưa có đủ kinh nghiệm, kiến thức trong việc deploy một trang web. Mình xin phép được demo qua video và hình ảnh, các bạn có thể tải source code về máy để chạy thử.  Nếu bạn nào đã deploy thành công, có thể liên hệ mình để cập nhật lại thông tin trên repo, mình cũng mong có thể giải quyết được lỗi trên.
1. Quảng lý người dùng
Mỗi người dùng đều có một trang cá nhân chứa các thông tin cơ bản và một hộp thoại bên dưới để người dùng khác có thể tương tác.
![enter image description here](https://lh3.googleusercontent.com/1gecNWsdDX-xnEG9YPS2QJUY5De63yZVscAWAdYgIbf30vp7Jrcs6TKPE6m8aGr3X3Sd_W2bHgIMccncDCc7uJlZ0JmLV0SQ1-c36Yb-96OvzXRcZBJLwuvp7M06qFiiatwbZT2PRhTqjeY9xekI2OWqQUSYsYbFrW_GD3pciTOM1AYeqv4634YxypEivouF7EbNk11m_hyY7wfcjXKy9rk29T_JEB5aYvNrfMPZ2v3ZTQRFgGwOoiKMeNBEmoVGy2VVud5Or2yW1krfoJGsc2utqr0X2DenRVhIF61ySOe_T2xNq5aTLe4mRXpA5z1I9SwbFw4qDgcSGMVohsyI_ohs1H6UXRCgsPuTKmg_T8P_hwHm6GDjy887uCx0gi5JICTCrrZbjZSp-LtfHWQXKBeNbnhEuazpmnaG96_s3Zdh0cQtBJ6Tgt84iixrtdvgaBTqkvBp4mE2KM0s-LoGsLLyJdZyVHhcLFE2VFiXUFdEgqlEzLEtcFAA_wZ78ebMeH35f6L-I2XQ4STYMpWQJsGNwDkTomvp58_NuNOMZEPyaQetCYT7VFd-LkB4VSHuh73H0MWcOY86Ttwfs6ot6T1dTwEuD87Hgsty4iIhcE9muhStf5UELZBWg5AVhdshF7h8Tuw7g4BsW4U3hW02c9Sriuy9ydmqavRbl_CFJUPpanW74lTpx2s5O1b6_qSSWM3DyRBZNaFIE1ljRDzTP2nMyXQBZcJhagQdistBmVgQDDFRbZ34VM4KGVx7IQ=w663-h349-no?authuser=0)
Mỗi người dùng có thể thay đổi thông tin cá nhân của mình trên hệ thống
![enter image description here](https://lh3.googleusercontent.com/oFEEe2X-48DAQJv15mpye2PW3Ck3g_5gY_2tgrf17lNQWWH97NTkJK_zQ6_F7wYIHHfpLi_WucIZ9qWwUYyYwaeGynL5y_70AbuurN21CdyYejqeS7kwnPRtBwiC-q20I7g7TZS7MSCn8LCdRqu4RbKmVLwRB45GWrqUFTflFkRvIz-dDn6MJCDyXkbIeTy_FA3iO8aeHAVv92sN51ZwsJgfrrE9YUbrRIXY6RisFOB9jtkusMsUmdRpHf4IpsDzpegS1f07TAoinPJOFetjw4zNTqaMvsY5I8J2XC-ez6j7STeVGiDve3h3Cj6thL0rijDfCwEeEfZKsnORTt-4T4q-gGUn3OqzeKxMsMBicK61y3xh5fY8W9FFdb3zph5Dkmb8XrjaNIg1Y6VqWhKn4zS-ZCOfXVJOYyuEg1Y-m9qdQFp5Voc6CbPAiTV3QclHpYXULD5APMi4gGdddFqNljnWSXg7CuVcCWSKAux-DlyIwffwq-cfeuygZ2HGJxHpqDazhLpiollbLtK1YwwaxSQFG12BUm4BmzR9Mf2hrQqKMVDZeLAQotv3IzUi_r2r4Z4uWB7b-FOki_K8oS40N8-RkQ1EnYqKIVFNaSjdVid8hY_v8tJu9PeUClBlm9BBHfVXDqiAU2MQsapRvzisT4ZkoPEho0GSCZ-_jWLn7AWUtqMafW7hlCMFxmQIFw9UfE95K-Cf8xFmXniXSywArQrSfZYjfkgpzy14oPHrSIXmaUnyzTrfOQlp4uw=w1086-h838-no?authuser=0)
2. Giao diện trang chủ

![enter image description here](https://lh3.googleusercontent.com/pw/AM-JKLXFW2UfAdKTfwJqpBfgPhfLWd9sXA8RQoiO4FWpJZ3XBIGAH8FaQO-sM441APeJ7qNllggGuUN73LTP_ctNl2YiLghfQ2sBHrcVeIIXtEeVBz24vt4iC4FxKvo6FQ9clxQX_yLZprc0fy6b_PebL-Nj=w998-h903-no?authuser=0)

 2. Giao diện trang đăng nhập

![enter image description here](https://lh3.googleusercontent.com/2NpnRrw8TlHDcw9K4TdRImeMdvnZsRZtgnWS21MpKTU9Z8RK8sqT5A-e5Se3YpQ2tKeTM6cQ_nMxw1SgD_X9viUHHtMribWHtDfWKJeDaUK7lsxjA2yU9q-ygUeHZCKtTEz4gdzZ4zNQl84hFYl6LVLt7HNOU_9uBuIE5TpqHG4cmysONLpSGOVdCZ4K3f_exE2bYikeRNkNYljTJ8DDoQnzUaPiOdcFjWUy4RGXZLGIXh3ODeWncHYUaNh31u01u-XaifP0S4NdT3fLZH3IKuL_mDMwcTryt2sgvJy5iXpQXm11xKzPgGdxxuy1NT8ZfySlVMwfCi3_vGJKK9G7g_mjNk3wKqrHCBV4bxb93Zb8MTIQPOc6EhbhrmB16YgnPWrBHWqtuTqBA3VBUG-QoPD2rT558-Lg_-AW8qluqyxliNUCIjG-4gnE2IjH-XsHMcuDEZ8G9snDFyG7K2ePadqtxXNAC8met0rpcBEjZ_AUhqU7uwrsK5zhyxo810EQdq_33dc-V7mKVkYBObcFW1MvaTIOrj0YocHjoPL8UIu6Tg7RqSOc1ATm0iG3AMO20o_ZrZdaNqcGkvf2tbWIorrgXQDLpgwCqZrly4_Ewhk3R63kXg_4SG1TOnjSqti35XfLNzPfoM7jFf4X-SZSod074-m2nm-Vp578nm_8fOYAdhCtb0kCvejfpM2VK_aqc30jA_VwwJ85dbCHRC4c1opne80hMoMuJ2kScJOnK9Osah2Aew23F0DVdklKew=w1848-h832-no?authuser=0)
 3. Giao diện trang đăng ký
![enter image description here](https://lh3.googleusercontent.com/92mM8bNVA0zIjaayqBfrEEetKnA1VcKzsnqhHu55379yeXUK3Prw_eohpCik25G7K2hYn4VxybNvkvAz369WoM7rfFr4ijd5QN-W-XA90kMSZNEqWK0HmlRfF0DM0PUqiHyd6uf_9XLpdn2qgbL9KtMRAuiByfK4IT6q-7k4SN49nOz-Z3GcdXYBZ8UXBhEhd_xRSL-jtJngUJTfpusRD6YBwGFKb700lz0FnzKT3T1SMzRtyZr8CIyRyrvMFT5-hh5rESJ2RvEw-SHDBNdMmErxz9zdALqJTlnlOdwcPXoxHFeOIiS8WPg88nH9E8apQBWRyU5XMPNRPpatXz1vYCI81WR0tWpA7wfX844N3GY-_2-gGi6PseehXSmgHI0CPrFne7RPRB7_QZ13UgvVk-glil54CbcRDTeJtf_RaxOjY-qD-MdVBCc9tl79z_Bv5iQ1tDqLiQzAmCEXSGgcFCrfqhca01CBl6VM_y_1DeVBBQkLQEt36t6YrXyKU_Zf9rjgLXhBOGeiOieCVEgdCiqPAecu7D9nz1qAYFW8KmlghB56YPvYlZZHjzu29ZRdI-i58LE38PoPxDIMaTKuGyhXph5eTBSWxeK2mNwZHBzhvxg5wjvfquoF-KQmzmRNnz0l_EMcn-ICVIKS1wad5ERPKrteaY5OdWfAeQN4A9DRwe9QnSswtWtPgyEkdmrQbzVCwJm-Ba7-2MqfkfvKSxDLcSs84_8bSc7BnjTSE_4D829xz09WHd-3oxBVXw=w1848-h835-no?authuser=0)
 4. Sau khi đăng nhập vào hệ thống, người dùng có thể truy cập vào trang quản trị (sinh viên và giảng viên sẽ có nội dung hiển thị khác nhau).
 - Sinh viên chỉ có thể xem được các nội dung sau: Danh sách bài thi, danh sách các câu đố, danh sách người dùng trong hệ thống và hộp thư chứa tin nhắn của sinh viên này.
![enter image description here](https://lh3.googleusercontent.com/UxxBR3dyWAN6cO44go_0F87Att3ZMkFcq1ANnb5DmDeiO8yx2_5rfAPyuaZcdvllQpp66AXl5sVNc7Lw5njp4neI2dejvjjIz95r3RgBz_qu47tVU0A04jwaoo3RXVzPQ40-LxUyDDlvFPmX1CPCxY8GMAIVraDPkwN5JZaiY4-N9bBquBo8hmiNNyt0DAwEK2ufvCGXvJSGtC9efAecRv6ePJP8XUXSrtNlxd3qqSR7XU6pDxB_ruO8ax-9aLQRS57hBeC8UIdYuT2vBdfyGpSMCURGtFps_uwvK5SQeJguqS--NN83TSKnr2lQyiXjHc_ZmlCi-hIjLwz4ZtH9d9O_KuzEpjYZJkeYaeSIbNxdMd2DJcsd-SWin7xeOXgDIe01f20uWmXgSUvSUcADuzTuvLv26RPUjCWI3mkblFChCxkuA7B00dy6hfbWP9jyOxPuB7glyaA1kVSKaRRa6lt39L661vJJEBPil11_BXw8ieBhW0fsg-051pQTlm28vuoNM8ZbziiR4gsz9Ahvk27DlRpqDGcqQ4IKOuPArIcZF3WIZ0E7DaIUejw5UREx_kHJhwo-7_ZdC486dSgx9VfsA_ZuBpg2HUqQLuKuTS-glpnG7eLsPHOJ0DJnSldiOY1M7Pq_Y-LHPI5RJFDxCnzqk0TS1A02lFIhXWa7h2fT_oYW-l3wXkOdQB6U6xTnCjFzxbkEnGNfRsCAj_GDkkRcBXSgTMIZ4D86_yKl4Sw9un1ubJe38IKy5Mq2GQ=w1848-h835-no?authuser=0)
 - Giáo viên có thể thực hiện thêm các chức năng sau:
   - Xem danh sách sinh viên, thêm, sửa, xóa thông tin sinh viên.
   - Xem danh sách giáo viên, thêm, sửa, xóa thông tin giáo viên
   - Xem danh sách các bài thi, thêm, sửa, xóa thông tin bài thi, xem danh sách nộp bài và chấm điểm bài của sinh viên
   - Xem danh sách các câu đố, thêm, sửa, xóa thông tin câu đố, xem danh sách và kết quả của các sinh viên tham gia giải đố.
![enter image description here](https://lh3.googleusercontent.com/XsXodt_x4Veq4Kr-ZzuTiK-3fpk6o0Oj_4fRMBjGVakZLG-TZea2l5ArbRBTPvY-_1VfOIEMRPjAYMyfqx0SC8KgJCQ_NK8rCoGq9lm2tuyYEQYN0Vxfvd-BwDMV32oSTgQvkK11Bw9vVT0whG4IdyGe3d9im0rRaUDKVHUmfIdyh1wXfv52uxxBaYcBjnI9ol6y6B7akcszzbBPDBtrZQ7g-FEY9uTb3oteQl9TKRrH7hEQIIRIlTsBc7hLKjPHYz53YcrzCSX5trWcNuF2E1fZkKiTcMy2BpjYWDUOlKQaVvwWea90-wt-TB5CBQ0KLf3b8i6IwT7EBowTHDLW-0FJoMDn11WtL0AcS4oyfcL29JR8l73B3QCLPRQ0DN2QIrVngBq6ilYvd55xB8RRW_HttuB_KxXmsZiue_-_GpfZRZiEhzCcaEQhoAlHKE5LPo0FsiV1rmwb3xxLMGNCLVtsm6jZ93gwoZgTp6YfEbGXFPTlzllUxMRNGCg63Q6SgJghTRy0NGHdg63Da2KwUbQfFdXG7Gj_9zGCzACBT8u1KSX33cXdqeWDkDmREAeLBVhA9-_02UqhtlDvW7U_r5NPW-87fU3vtPgGpYrSyB1HR7Z-UdgiwSwT_p39pBkAhcgWsGXjzFagyiVhj6RFfuvSUKfBho57lyVbMnsrwAjsC-UQmD0au9cFwp_P-qNUhZv-cucGr2cDDCVqk47GTULVvsI3zs8PkUczJ_ULtkWOdGmoo_mgEUb7D1Q=w1848-h836-no?authuser=0)
5. Giao diện phần quản lý bài kiểm tra
Giáo viên quản lý danh sách bài thi, có thêm các quyền tạo mới, chỉnh sửa và xóa các bài thi.
![enter image description here](https://lh3.googleusercontent.com/MTmnFH7AwO9TNyx0R3UNkhzMwiiSSF65ONNKKsBqF-aFeHY9nnCyPYnKfZklhNknNwrjnG0QOCL4TXU6hl4smz4WDKz7KxnhbJVmB-keY8qRNMhhlKoZg7S8kn1hAKkM4aK5xpV6vcrQ-iY6ktZaR3SjqSdSZ7jxj7-5GYGRTEK_iJnZlDtzOOK_pukFfSmKhtmtoWpxZB08Qz0Ujszc2u5TtJlIOvtuyp-HymXPL6KUCx5scfdxW_Ri-kS9FfyDHedDa2565gfcylsKKcr0XIxHdzgfnpjOn9SX6lOxJ4pqVW52Lh-rw09YfSXpzUf6i5NuOydgI4WuJWQ-RXtpXmtuNsSJTEh4rZZeJh85VhWBsfU07E0EKcdrej7x8ABv5h5lqSZpWPAJTkc6ywfNrkYqn2xadSRc3qMyf0lz3Ho0MvNxOuW3UFFx_8hABWK90iAARl5Ba2hfaZmwtRPo_TFMLRlXxsPMrYNf6XhcfvYqx1SqUQkqYUXa1tFnNnPd9hPjHZAmDnKGwN2s0ehH7w0tAQmAXgbAclyzGxYhugbR69SjEhyfV1ficnm3sCwvyO20euS1C3cdzQmi05CBW67fg2mmSekZEfy3NHLyr4HxvKh_uG5F-SvSujqxhFXfNqgzqy55sU7nFN1C6OIiRP90UvYnTwvOfRtyBxxImY3aWNTnuM4wXg2awB6IFhmUlnJDtM4B57LuK03KHVwKla_stjEqa5cSV06IUlZ8lQOR_D26NE_P2Dbjyug=w1848-h835-no?authuser=0)
Khi người dùng thực hiện thao tác xóa bài kiểm tra, bảng xác định lại yêu cầu được hiển thị.
![Trang xóa bài kiểm tra](https://lh3.googleusercontent.com/32a8EKXpR9-GvYWeT-lwmY1gUnumU466rL4XkOq7wPRgA37zSjtU7hiEtz5T19rVq61KTQUY-yM3R5zRBHN8EK0xa4YRK1lfSzN59GknG5CzZyMKqfQKh7FeIoLaspEwrtVgzxoSPum2OyMhAt8RZ9edtEJLGlHanhc7yRoX7FnjZ_xGlkr7b-mwPkxjK77ctMZwVAwY-otl5yq5wzz6hF73V2XYDkHfqyuUIn0sB-JTnmyBXxuSKTL6R59hY8t7yjJ3Rsk2OIeBqM0xZChKLkU4cFvosdQRhFSDj0QYAvS4MSuWt467VtjV92ejiOhYcHoEjXfBjN0dMYef0r5loVKVUJGzWFCtT0FsOOi9fChJFzoD6osWyRnekLAkP4ajVj0I2SjSPsO3xCLgMDBTAy3TTrGoD4Rz8dcFEGV5imGb_2xmXeGy9BGvu7M50ZE38-OOKhliNfiMW30HfwhUyc-bEcd8RgZ7xhMNzb44_2HkQQgQFA8k5RWr9oIPFttkqa_9gTDfI-gHhb0mOwnPOnqznDIWGSvuneBtfUXjcT4AUHFyf2j4lgOyIDFIpFig2vLx7zD6cTyy_G06bwKZkdrXcFBt7lXqqH5vhCJyGHiYqbrVXM9pfP749lKuD_kfEgmfx23du9DZD_C9Ud9LxBm190EL3UFf2cD58E-VqLRG8UdASHBdN0JBrdKOq1exwWwoS9AHsFLGsvGJ_ko4k8zEXSyalr_jKPhG1qFVHT1AO6xlUYvlrwLzxTU=w447-h202-no?authuser=0)
Thêm bài kiểm tra mới
![Trang thêm mới bài kiểm tra](https://lh3.googleusercontent.com/fXt7SqDYlNitC3atu7mgp62lEBwOaOTrNLA1eBbQwxHtwbGu9fM_YdI3ZrwPCyL9jImHMpMZ9rNWPZDiXvMeBoWrFWUrTVPIzANIGYeRrEJZX6eQ2jhz8E6zPX1dRUavM50XVBxvrTD3uuXs6B8-VYXGmfPIMKEdmCVSDj_kAUunsgdseZ18dCsm5G66aAu-FNZZ5mF1NKeqqoQaXSamRYKcWtA5hW13ZvIv0YCCByuA_2n8mDHG95npuYGyzOVW2WHvkD009XW5Gkz1URtJvPVrvkHNgux24USX-1EOeihvUlrXBwr6uamGuqrjERY1DKTjHWdfHR8jmRo8k5RqKpbk5O3vZRkE_KD0_EsZhfOUshlqDyExIKvM2cPCuaxzpL8NQIhTT-7FlIIOaa_lz6W1oNMOQEAexc3y9LlC4usnArkUohC0FLyrWVnTvlgPOHMhv7bZpNdoDabwxlYj5eukm8QD3-cyGqULNKQzDGnuJrted1-0nV7btKEElLrDWhB39ONr8ahFl2WEX6UL5-NJ2DOfb1u4cb4DFoQA8UtBcf__BKcNtHO5HEEuz7e6F78QlbAcU--iboOlk6bFX62pz-9jrC-s8nNHr0P_TjV_m7hdAPRh9CAHb21NzOy2AG64y-Lbu6n9--s5yA_WBU5liySO4DhyZqGbVV0WUzKfkEdO8P93vUPVR1rQAOiVUAnDWeY93oWDsJTcB54GgLgz7ULJRYMWs6cMFT82Cmc9XuWRnFxnFJpk38Q=w1848-h833-no?authuser=0)
Giáo viên có thể xem chi tiết của từng bài kiểm tra
![Hiển thị các thông tin liên quan đến bài kiểm tra và danh sách sinh viên nộp bài](https://lh3.googleusercontent.com/4AN4muLnxtwsZQCJQ0lXT2xITCqBYL524CYsf1iT4N2PIhRPZY3FeQbHenTWh9E87XgY5mtgkq2cGT4pDnekocL3_9axM6KxKqpZUUr6Vo-ND6XhiMfm_k0W1m6TSuFjUlfjiletaXBPSZMs7dmFV5p_QLKfDB-EqPbofncQG8fvOBZmTPOkjiB07L8dmN4XwZEb6mb2k20Z1vnQ94x9fsR9dVuQILdI-u60M3efz9pkiMfb-96B_N0GxDnvGYOe4EsdKeFwNvbezZZTwcMr9p77qHgqUFpz0Rtmft0A6FOQBWYivY-_VxVO9hZ8lHG5rAcW1GyrSE2YdwPUaKJ7eKR-t69pX2I1tuCqRV_6pcUgltdPwAR4hnncX7-4R3AN8Ak1euQYRVpN0I2D6kYaSCSE6b7fhLjQ8XH6sxo3DCF-zLvpaeIuC3ik9VKvcExQo78aD4chNqpooBx5cQOUvSbInbKM0ictMsNm5E__Qe8X_3sSEDXf-2C9i9L6lgfJmaVJG0vnjNQzlT1b1WGzT1b1xhmtKqwCFMeeaSIHdRYw3Qt1onYwr1kTFf5jv2K9374V4NIl1cM1XW2j30vq78X61GzfEeqlsAEHWWqndU0gAVuPyuoxvGCLzAsT6k3ruclxt4_UbGnkKYTwDMw3IrsuvK9fob1QTDPVtpC8hyvuhxPVnHOUjkMhOUKxVkUQ8QSWHxCnvUc8XVL-6NIkCgsci0oziuhKEmUWXF6bl3Pzj1YGtlcvP0XIjh8=w1848-h835-no?authuser=0)
Đôi với sinh viên, khi vào trang quản lý bài thi, chỉ có thể xem thông tin về danh sách các bài thi đang mở, xem chi tiết một bài thi và nộp bài thi đó.
![Sinh viên xem danh sách các bài thi đang mở](https://lh3.googleusercontent.com/_6_g8gPzLX1n_rShVJ02wu61rG6QDhGhrXzZrh0ZYhrA4u7LoFkgKjsYMyZAN7Q3xlbSBqjvRow3sIm7Po81bxHz0CAYm3aEVHYZoqmnv_6eRZSZG2Sffxg5NIHJCfKQRBTd0sRKINByemc2-Q7UwKF92n7JATGKUf1ywXyTBT_BcgbB52FxAT_ZueHqxrj6M23UTx8XoY6wM7tfKsm0s0RMISsdRdH0_DjEhyIxvXkk120np_fT91dDXr76b7kDd3JbuGFkniv634-LbJ5MEeHLMzGGdLoBS-XDDkWXeAE9850Vjvwz2S1EseGqeMbQ_egtLGMp6EYMfQL3-m3qtJUDDKtUM-32M5_ykIv7F3BZCKRguhkZ22UGthx9jSFOln2BPNRYIE0LUpIhuu4z4JX3BNL5U8pKT1_wKCbA3My0uUg3j0IttIqCh5xpRw-YO16qgvWNX7lhkEz5C-Rg1v1g6q33daeAKTELupz3dgq89I2SAQY5nDyXkdk8k9EIKKKKenbrjAMss4vBqA8kwjwCHVXYqs1Yow52w6_8ZQA1rQku5SjWCv5Hw8JS_CSYMAnl8L6Tk3kisMZIyokBP9_-ouXjhsrHI8Pco-t0GUMVaTlgSL4RzobCDu9hWhpwMFoCT2uJ6aY-G1-bArpiSjg-YjPWOMzpYac15dDTqx4CoGqCunN_KHMTUTag0gV-htar2foRHItu1-IzglOE8tZel4UXDPRKfgCvwWaoypOU62MqreMR3bgM7A4=w1848-h834-no?authuser=0)
Trang xem chi tiết và nộp bài thi
![Sinh viên xem thi tiết bài thi và nộp bài](https://lh3.googleusercontent.com/x0dJ5dBLrQwpbfCKSXYBseCvQgpxEs2R4k8W014u0u8LUPukhssUdk1i-sgW5CvgQrE6Evnc7pLJWEwitAfoJ8VOsXD8ADME8RAFcu0qns6yQGYeiBPMTY0so7JjFxb0v7D9ecJMq871kmMbXaOITWLxBXTjni88RWbFtMNqHYkSSEvzXIo3LKaxL07pm79eTYIR9Zhkv4CZ7teJZZPtT-ixUHdRsaTlj3ziEQPxpYQ_pOCU2ecgR3QXdkMiqeI9WF71Rc2ACLKfqe-CR1lcK9jebPWwc6x2DuhUXs2CuX1aOMKblPL9ZHYT6wbUcC3hkJnCjq-uYnAwgwTu5ePrHFe6vc-bGlDq0IRoh9bh-0WMd2Gca0euuzJnhS7hroY_sJrqFpKkEfJhufAhsajqpsVluwP2TKcFPtxB-YbUQBogZXXc_PK7fd8pKJoaItNftFP1EI41lrLz21V92_3EvyQq__YSZHdJy2WvOUymV4uvxZeVELQGE6G5M9YEY326Teu1c8LymHSNC8-Vu2U4yHJkZL9NigNL19Ixq9UrkD-xEmmI0wqE3n063ZkLoVm3edTqIscmSg25oBXGMFbOmmG36MssPPRW2OejJp_Nbk0_kfhj4gyJGHhBNQ3cOKUYmzbvmGn8Cz0CwMPSCq2IIYnBYsTlHkRZb7dFMAGqz7Y2vZMnsfn3rUpnF4NN3AtXjNNCAkMX9oKw8EAjqd2f2kYCZrUEExVsAEOh3D2qaxwo7iLdlOPf5IkOo6o=w596-h270-no?authuser=0)
6. Giao diện quản lý các câu đố
Cũng tương tự như phần quản lý bài thi, quản lý câu đố cũng bao gồm các tác vụ: thêm câu đó, xem danh sách câu đố đã được tạo, chỉnh sửa và xóa. Đối với sinh viên, chỉ có thêm xem danh sách câu đố và nộp đáp án. Ở đây, sinh viên không nộp file mà chỉ nhập đáp án qua form.
Giáo viên thêm câu đố mới
![Giáo viên thêm câu đố mới](https://lh3.googleusercontent.com/zwptiQ3QKXuUAjPQ0gTK-glMH3wP6CBPJsq2h3JofAS5NTzQIy8GIeRrr4HwSBFDC1Xsv6ArMBDyYEpooNgeHwsS-oa8tOW8tpmYEhMNPbX9jBZOHsO5aHQuYmrdy0XZvhHw7CD8K2MW5v6gzxJCXRpvtAIcWdw6iyNHrO_Bcu7D-4KCAGfUalCju87HPUOmu0bQAgdAGjOXlwVq0tEMSB8612ZMMIBb-QhPZkJFQw8YY0d7CC9ijulf7Pcr8YC_xyGAs5MqPi43in8FA2NJcq9CFk-o63sgqyb7FFrRu-RB2-LvQNaAbUONezaAaSe8V7WQtvsa0PRG5GYbDpOenjQrHOjyfoI8JPov2KwzM1DDzjd1Yo7ExBE3jgCkTv_NFWl_suRE39k_WVIxEtPi_YAfTaVPKZyoNHjN5suVjQVk7lzmsyh0m9BNMEYd_YwYUeMXd9HGzVD4dq4CPcdTWJbHvSYDKVfEbLbCTP6BRgVoC2OPAz5a_XKdH3nPBiAr_SLUDKWnU1AwLriuSBaQNcK-0uYA2RzWQ101QVg_QYQXRNakNbMWJa3FnB_zzE2f96Cm4jzUyMUwoVXgR7JwJpDou7_kKM-RXyORA7YgfEGYLfI6MTMP7pTvyOIaVwL_wR4KOZE3-iCm3j9hveaFeX8Lwov4uru0OiLT1Urvlm_ZzzxCwd3CbqFieDb3gotGlex7L5vv-H7QfD52cCmgHamZKEwbNpZG21gAhj_34pu5FU_k9xL0mHFjKzk=w1848-h836-no?authuser=0)
Giao diện trang quản lý danh sách câu đố của giáo viên
![Giao diện trang quản lý danh sách câu đố của giáo viên](https://lh3.googleusercontent.com/YclQqkaKmsDAv5jQqO5uGmPaWJYphY0RcmlS2QJ9ho5GbxH6kUDRDAM4sCU3UsBNTWykf01GrI9IzePgqu7zw6Z3HYYFItlJWijcMdAN0VeqlPrXZnLw6qhk3oF8_nH4_rN7zm6fSQvBv021lbT_g2nGpYcq8dFb3Z6UIfJGNk6pL5_kGo3kD8FYDaW4TqumxN6cAZKHG5DTtDT6n8NtOAA1MhfhPSArQAtqkgCZgQHA71r72zWazA3i7FzRxWZt8m0IqPgDCW8j90-Bvur3kma2uUPNtQoe6kFkBsFQzx2b6vSdawhxwGm4xFQmoVJay2EBuYsw8DhrE-Kxf9qUdhTQi-dC89GHE5HjVV2d7AxJAV06xpsPmIprYgB6xFexGOTvn4egngwOozdPmQqs_ydAnbQE3BvPh7lhnQKN4QICk50pcqycNFgxoUOtLLSfYQ_jwaldCp-r_99lBFCDmTyRIPyk3UR1rtsqdN9uqZ1oeXG2cLAK_9d0101vrDYutkTRsZPzgNo30OMxyyVlHEhTCEIiECISdHOfiwrYwQBXfGqMNAn6pOCw0_ek0zdnqcfle-D-iie8rgGUNaLomSlXBjhOW1UUQm7OU9t_QUOoavvOinv5ccdI8y-1v0xhaHakSWK6E5mJunPy0ezgrk9O3tlKLd7N6aqUuBk68UxyxsSUjmoV1OZXrwR274zWSpolAnvzloxXfgezCsmkIDwudp4DZUbbG6COgHPUEBri0nAOU1FEhEnp0Yw=w1801-h838-no?authuser=0)
Trang nội dung chi tiết của câu đố
![enter image description here](https://lh3.googleusercontent.com/9yQdJgfBB_kQ30aOjPXsyvd0YsSjY5xdEMaK2wTVbltMgBahCblhJ75rLLyJXQSFkVd2AJ7HNX5F-_fPOtsbQFfd7KdQEG7wl9dgSlhQdIUB75Y_v_39gfzPIJbjEQzQteV2UO5bKOOnjxj1c5CD4iRsvGo86sY5LpRSOQjOcuJWlEPYqzCoS92mhtbMAQYzFKVst2LAf-0_xwQ8V7S8Lwnogzzm-v4NBD6-tgOH974sC9MrSzqY_mPXUrK6ltT1nKiJn3pOIE1u192dZZvN_oH0AB2SInNhJZjndJFSXgILE0H3Neo2ymGhhs751E12WPXH6d_ok5-CbfTdmLZh9kEkc-yxFaZmnKuRZuDP3o87ekB3BpbtHjH3qEUYgnLSTFiD-_UkTEBdkcr4-Tq_ZLQ3rs1D6PObXlRaonZBwfiSrkdzYx0gj177gG3O468CT0CWWF8E1t1jIyzaB593SCg7LIW4-z0YQj2hOtfYOi-frjgaftbW7WP7bnInZSoFH4LCP5iG8LcYLoTTH9aiysRm4VM1tMMhOE5vQoJXzpNUdzBkXB9Rix8gC3nplDG6XfmBEex2WmrcjHhKcR7wgDmZlZGqnQqI8OY7mNJIM8nNjV7fhxxiaOC3DetaW4wZSQdBUXO13y7Rl0YttIY1uOa98K-SI6mpNNltQHy9nNAgf780Ug9FjwRNI9cDbnoqpo6yPVExRy0fwDhhek_KbduTkY0w8yAWl_mQ8wQavUZ--nU9XPzNh1cabxU=w1848-h836-no?authuser=0)
Trang nộp đáp án của sinh viên
![enter image description here](https://lh3.googleusercontent.com/P_9A1T88FKQSoF3m2kTrppScBLdPU7Ra3RfQ2pq5PY_IibuHIegSfU6Lj_HjWPuFZ22J5fl8YYsf79074dfld5rWW3vWljqU4uZ5YPVdVv8FCQUk_hzxlUuacO66gQtMPEDwr0CsxvJxnqwQn1DWIa5BXovd5SZLARgXkd4i340-yaBf1Ngrom-DDrvlPDJZHpT1MN-L6YrfQ6m58Ew88aasgqAfVYlRAQquuNZqVwYr4e3vhJs9RPVDqocpB-hFSZpM5NC2NJWqfP-zPg8CN239FEx3TQdNx_GBa7n9I2Ax49Nkabo88N18snvl8bCC5Z2YmHIOkYW3J7lhuw9KDxziv99kKL6X37UfG4YD_81VxTZ2ss3Jh2Z5bmxZHky1Jz2NuGFQheGXhVBomoBb2805Yvm_HHWZhRcQZOQ59JCfgCCfpIhNPraJAxBxF6etISDofwZC2_vmGAXNgO7eI79rAeQMzI7GHMun6m25O41HLdEP3a0jwMihlTZAetVHK-loHn5-sDs0Ul1NrkNR8dYMHHW1cyf0ynb81bJSvp5OtxRsMnguEezBXHLCaS1Fkgbo4ivyiOjVZCJ0_ZnG7fQgvD7LG4I8lAxo_QYKyINGDpTXIcfy9XKMjIjsk9EYhBBAx_AmSrF7FK_T1XzEDC-ZXPUz3UdtBwij8TlN_90G6_o4LGzX1n2awG91qs9uIz8baTVA3i4JQWcm-4FkWyH0zcW3m1u3KmxgmXj-1fF5m2m03ChcCfYIOKk=w1848-h838-no?authuser=0)
7. Quản lý sinh viên (Chỉ có giáo viên có quyền truy cập)
Bao gồm các trang danh sách sinh viên có thể thêm, sửa, xóa thông tin của sinh viên.
Chức năng thêm sinh viên mới
![Giáo viên thêm sinh viên mới](https://lh3.googleusercontent.com/kP3EeiMsoxK0Qx3QuoAQu8UQx1d-HdtNmInn39qrKE2Cq_9VSlJ8d4spalC2nuQumpe3yj45ZSGhAeiBas5sphNmkGyiCwRny-vTr2WJj97TJ77OT-7mJrtNxknmWMhpZiDg-JDZIIrhOJmH3sOYDGwx70jqdWxs3AvoKZhi8jveJ80VULaOxJUeXiqO8uXAattMt8CESVA_vR6tPaWUywDPK1uE1yhhk1z1zKcXLSy5zYtFTmuDT08EyUkqy--17MDMdBNbVWt9VT6eH-Ky-rS8jTmDnTDvOjs0f9zhtaJdYFHZP629vp7HJeIfzlqsJIEKTwnSCL_qbJyZ6QPZPCu4GikMqcx-xjz8fu7Lr5BYueDVNyIgZ6r3_M9baRvESCANMMy3kwCNVyYsIDWdgtj9fJNwJb6T1NuCxv4HLyzJ1Cn3lpQvYF-LJ9MpXUjgv1DCWIRYBMRcgu-I_NY-Rutqa1JKb6XSiXPQ0z2IAlWZbFrnpNmaX4e-75SIbSbfkD9HNibKnFRbTjFSd4wQgpUE8z0U2X08wijkeZP7RFQly52x8o4Gxrom0gdNX9nTWm8FSL0TthIMu6IQIJ2P-MBtXSFFYxbf2CAt4s-heSof6gxiSG6RoRFaiFlyn5E3ttABfFqkxKMg80_CnWN0G5P89fTxHBDHTRoSBDsA5LAqKyp_JxnjoSr3lrp7JpBHatF8wpIBkcZ2-8Bg9GX9_WaowFBzkI4UzcEep51jy3LZ4Qb_n_0GROE8YyI=w555-h400-no?authuser=0)
Chức năng quản lý, thêm, sửa, xóa thông tin sinh viên
![enter image description here](https://lh3.googleusercontent.com/9Wj4aTuD5qsRtib1k3ofHpBevP7e2Cp2wYbk39ylEOs1GntqGqMNvJMaJCTfyaL3NQn7kqy69IUqf6VmHboI9nhjNsqvKDcde8Ayz9OxfYvap6GCOKvHLFJFvclL_wVOMPFBsg8_iR5QGh2OJV_537K_v52npBeQlCA_gcZJ8_BmUiXvlGGKtO9Q5TGim4ySXwv2E2lAeIf8IFS-2fWvBA6ywNB0CbNQGJtakBFfw3w_94zRMCBIyTvagPVuo8tSXpWqJpKNMIKkBN2E7yKkvHKP_6a1VIGS3zqqonjbi_CAp6yX9r_pIw7r1hjf1599N9lXxxdeH9R_QyfWxKuXi17eVMCGc_gYZ9EJ2Ys4oF01Z36-ACq49FA7Y62-pccib68rJdFnzmOKXbGR1I83D5bYmDBS6B0aH_j1dnFS1mf3fNJyKaBCYvoTl8apej-YZN0oO7Jn43G1Zaau4545fSjVP8He45aAoideTe1L4e4tHS1VeYbxHvRc_CEgyw600aS9sP-te9EMu7XPW-x0Rz7SoxSii9rm0vJXtqGhxVcjyrnL98bfVmy4jHfLHYsXSokkrE_np1GlE_t9n7-md5z_N-s_Y4Zp6Mss6R-UyVwOAqVlSKFFdrTx-LI1Th3uuek7ZdTNPMydrrUA3z-9rrHOwfxKEsyXezhyWlJhWE8ZGttnzoW5OuFJPZWy_2PMNvtWIq_9XTpAoHevPCXxfavxzat6CuVB3NCT9loEYM2oMK1s64-dqeJqMkE=w1848-h835-no?authuser=0)
8. Quản lý lớp học (Chỉ giáo viên có quyền truy cập)
Danh sách thông tin các lớp học
![enter image description here](https://lh3.googleusercontent.com/z5T0VbFtfUBrW5PjiG1SNwOPW36BYSTGTPecG4bT_VgkvLZGV2zGKr7DPfO0nXKzC2VVXWJMlBmow40MvJfzOzC7zxsphdqzE0fYxLzA2H23RF4MXElK2yZE3bjEvEwpFlxRQYSTok75f4Z980A2CldApWCfPrLIEWS2j3E5zV9En8fZ7GY6hm8FAbOBVbxVZymQvSSkWGRPnoTwKnbyieulMU_0BAjfBeX7LtXWfP1UQCOi-aNyHXkShyp39Dk-Myxy7mPBnrCmygEQD13JBrY9aYZCvj06K2hWHk0C9P-oVZPR8ETZk6NOeymKNHXTPfIkPmsNuFi8jKgR2b5Ch3Y0qCexSQ0AKUwxaqFrzQID92zXJyaF4vx5aCRZx75y4xb387KVYcruf373_JoBMLuYhPkFEs0ck8RFFRrWhU8XrtingWBLc3NBhOLLLs-TZJGL7S-mYRpPdRScQ3AiDVk_e7cXoljQp9okeGWwX-vJHJFnUudahCcaRIfOlIb_qVgB7snL1R-Ryejsyay1apAjVXQYcr00dBm4RHkYjJcGkKCgec-aHK2RFReIABhRxSBKNkFRFhnsyBnjQ1yVBWRsnKV0hUMUIMSMW7d32aaaIX72VPXNcMo82kmGjh63vMSVr9FZMqxygSvTe9GnPel2cDeM4t2arGGvq8tE3GsjWA2y9a_7rTJuA8Fz0vV1MEMMEHquaHEvkmQdXqk5vaJeNQLIpXfUKGp7OiaLFHsyl3yg6pz6_wHN8sM=w906-h410-no?authuser=0)
Thêm lớp học mới
![enter image description here](https://lh3.googleusercontent.com/rw_jyFA4vyfCe9S78g3SGTSleaYjj2KiDRFCf6zs1vvhFd7qVyPrnbW3XPWbFZyIlxH7Ha2diV8VwFRy7CpjfqYzmU3V7sbK-17oh-UVxAamZyo5wRMoFkAzP78F-zaLOMR75osLSOpdUupnR_E51j1GQKfpYm3t0ZJPwnyp9ARB2VBqCyLZjb9-iKlHIPye_xVhzaUv1aVjSWfq_fiuRZRMOSVu9MFoaPNPd5CojHiMmHAfM0LxuY_B6_e85-mI5M8itoDgoespF2d9LA0qjy_zdkjDJuU7o9qeg3LPpKGyIoQmYx3oLV6TLjyznEqE9n74AfmHnPGUvBnMVhhAUTVzGUsW3hWd7cnyiRcF-L6By1mN54ykX0_qJGK-jm6QRpb-J_9u9VthidPediezWuOO3CcMC6WF0VRefqLAY3j31V_w0D5WFdjXEog8RJE3QhFtsVOJPbAemGv58Cp6ZCBOTDQgs1wP-rHL5ySG8cxlUvUG0h03QeJ6507Euta4Dbj9RWcw6kEHTfXFYetq8oukdNwnsl8bwDtpXVvaZtO65F-3IpzKoKmfOXzbGVPoIxw7zJJiOJYKxzzHM1wY3nI0zIIfUaA7XEufh7i2HeyniENTFAQ4Gotgcelhy2QeyssI5Rujwmift6-c0asvdgyrRLD_Vp0LQE54fKv5y0K10g2qXG4VVkA3RZAMy1HrilLd1_75qVhHPTQe_MdX9nrxPYC7O0ofCjPzivaFboU9prDa8pXA_FywzyM=w1848-h838-no?authuser=0)
Cập nhật thông tin lớp học
![enter image description here](https://lh3.googleusercontent.com/GNSoXafHEN-UBBM1cGcEenNRkjttLpGVO2s7Pb6d00tbkVWf7bbzg0bR5zMbPdF62b5m627PabkscdONtpkuWoFgprQpX1D5FkOTnJTBqcfO_XZ2xprNzziyoMISXtOIap6i6j4wVY0EX_wwGcMm4QeyJkNzo9LUthjXNXFQPYBFi-D5ToHSD0ufY9jWmJ2eg23jthHQkSl6UNJ7NjtAim5bF_wZhoQSuS3ZAfNkLpduwj_xC7EYCIP2n27u0lEu7Pg42_sdr-6sRMWkl4Yz4biR6jj74FqksXBEPfstdg81rpCTC-cYk6hT86wy3U5Wfmz6hQ8SRfVGT8_EBKly7i0WYhW-8wHRwHRD3kc-1t6egASWokHUVMSCuyt9kQivcwTHPRZnd8gVTt2Rrjj-bMVb8J_u4lKY7IECnVU84gJhIww0sL8z_PWBARRoRqNruYRX3oBrTYL-SSeuFbOQ9YnKxqbsvCUmwMHbU-tdklMS1jnriW8T2U2fJ9Ts4TyHSqQRaBqI-Jn8WRGrf6kShy7tDa9a9rTfaazCqAWXaB__xiPbD4ChbrzG5ZxdE880t1fN05_Y3PLLgNwoXqpuYTcpzAIIToYUHxgHY0sCy76szxz9dEj7prnhTyhlC-1D47UHXbXe9gcXvzJUiQ66EReJxabmZ7bP6XyQ30KpbpDgikqn7siZ8-zVzJ-aR83teQZduVpTJH9BiWi9erdxi3429kBS5vVc4QZhQ_XNAs2QDObwXuujmjQgj9M=w1848-h838-no?authuser=0)
9. Quản lý giáo viên (Chỉ giáo viên có quyền truy cập)
 Danh sách giáo viên
![enter image description here](https://lh3.googleusercontent.com/8r3GoFK0r3wr9F3VDpesW0iF0bYdKJlyksYochFSv_5pVGyDWnqxRIy-LCvYcKOCX1kAiKcsk8jqFCbC3fFzLhEY96atJgw0ogV6ncPh1tqePeKuplTpxdAPiIPcEDJ9BpBB4NagSVrVNHzNWENASJmi5LTlije4VzHcmGfyfMz9UTkSatX44pOrhYKbjVwNya8rYtCigbVut9_4olKJk6DEV41ZCWEm7tsJFslGqn6j6iRov5AbV9JEfXkFNhYuCGPKTuDvK3RfPNILSxaV1BR5KIlS4XeLkokzg3XXFvJqYNSeF98KXXLqxXKgVhT3EdmKiBOOCdcatT32QOdxTsk-rHWiq033rZq2CLmdBJuGi5yBVbkE3nibCvgEQ100sPXSvJaHzYfa882rJpr_BFuPrFH_4MHDMjxQrqU-7Y_sja8Apta55JzSSUn9p0ZvFOsyrtJjZUYxTLOsGdAsd-d7vtZB0xEKWU-pH4pXS04tMcZuiHDFRn7jPFqGwr1umToVk4kZX0-5UUqMNwwYa2VWZ-XKuFfxlUN7isZA5IPm0F1QaaFYGYCaqsaJ47YJzY1_zeWR8qUvEKWQgdulj0j_lfUZyE6gmnmco070XlUBhvT-nTU8lxn5a1zToMLfEugtM3_5zsXPBmb8qAugxD3ajUE3qN3uHU7KLsTS63m_9Y-bU65eVlgY_RiXSlgMPRLpJ0O0RvPykTqVOukT7TMXTDGSPFmhCGAwx0MTTiLbWCLrU_DucYS_rpE=w720-h325-no?authuser=0)
Thêm giáo viên mới vào hệ thống
![enter image description here](https://lh3.googleusercontent.com/fWxUzpJ556WSyiX9ZmyHpWZxscjNOOjqwXX11O7yMKDH6n2T6kP28sQRU8-xiq5mhJIrH2k_QUf3i30Kmr6fKA9xjDB2uVMJ898rP_yjtm6g0FprU_RyYSb4vgPPIH8aMtEX5qrb4WGmPZ9gHCT5oMCljKfOVAnuibhAYJPwLA8siASOlHXRdMd9bnuyy3V89vkmBQcsNp52EdxPdXFCi4J-INj8masSQC1cdaXDt8M6i_kW7zY7nsTk5vMC5aHjujOccAUyrlSSgDcKjgJj67pIkYNSbSLn5fN9y5vZ7DxYVEgYaprwU1reu0Mfqu5xDKZrlA4TgDFWTNCx0RTlD4ZWlL0t9EawibCbmwq4-CA2rNLLbpGWWFf4R5yrm7Khox1aGicaTojzaxLm84awFFXCAoO1noYDXpK5aAGSVWmZpRNsLmYjqgj3lwYObIwwx4zonHnYNcANoyGa5kJ1GhUkHIp-LTnXeGgdbs2j3Ihb4zeNoYUOIlt6fte2U9FwvcqPs4biouLO4eDebGesECXJft5r6e8wyibfnuvvSmb3KN-qUi09K43lSeQwWPPR6V9LNVKouiA74Sa1asx8rsgKJlYQYTl2PnVdrrBPA4TqLqmnaNWJAB0AOyDmydoQ3GlP-DJ596kNatpHCb4S7mL2V0Q7-ZRt11sYKYIm85Rxgr5AvKe8T7eXBP0lM_ToEFaKwF7ClW2zxwTlrcbGxDU6zgu9r0Mqazf7qmD3NEjDsInjyHrPdfFn3qw=w553-h398-no?authuser=0)
10. Danh sách người dùng trong hệ thống 
Bao gồm tất cả giáo viên và sinh viên trong hệ thống. Tại đây người dùng có thể xem các thông tin và liên hệ với người dùng khác.
![enter image description here](https://lh3.googleusercontent.com/ZG3U80EV9OIhYCXKJp-cA8nRsZwJfpQ_YXHCgsd6bsZFlOjeQRF_0cYSboKr4BnHCf6qXUBe9kInfUuz_L0yssb-uFL78aDzjQqBaTAReQjv66c3c13qkVTwI8m_LJ1qCHIehugFawX7zdcwhtVQHbPLs8bisnv0xA3NU6PcaNSgko77C1A0kntt7gav5b5DdP8CIRbinLCyi92_PnFehz16i6ueM5nb9bZqtBxeNBQNxa-KtlTuHvoYptB0Li59ODOYzKdxMuaUKyWwXQTiDE--0zUnB1HZvz-dJ2FYYwAJaKDISLOgvsoEmzuv3G7z49XyX2rtckCgahRK1FyCwfTWrHVgjgKOM-sJxmio0XNuFbSj7kK5NwgBSpj7e00HdwM8aGVBWGHKmvFyme29ZBeWaTE2-BR7_Lmi-63Oo_ULyijjMto-r9vyV3OJhigOj0H3ER6EBceqfdzQpmyHiOfLwQN6lKCSkZjFaH3aXGVJgblWsmZLUt4NT3bhcABl4kl5B-oML7ITqlxZnoxm4a1ruL07YacaSg7siE9u5kITdgVtzFCYFugr3evrs5jbPFL1F7aztG34GAr01U91ksJeUHJ3pYugIRQ3MUrhABpFLjtfSeACYK6bCUlvENejELAbRRLz5sRPnCKD4jt2j-UrCJpgwNvvyU_vcqyImCpJGMM5zX4R_U5tDltkMPFygHNK4pncuMnUdy0-ILT-5RN_QGqU-0NOQASfeTQOJROblwNasfYy3R0uRM8=w867-h410-no?authuser=0)
11. Hộp thoại 
Trang hộp thoại chứa tin nhắn của người dùng. Lưu lịch sử cuộc trò chuyện của người dùng trong hệ thống. Các tin nhắn được gửi từ trang cá nhân cũng sẽ được hiển thị tại đây.
![enter image description here](https://lh3.googleusercontent.com/fNl-PtL9yRtwDeG-mkY-xI_lKJWWuc-uyMs9fdbm6k8SWU27dCTW_PC9fAwiGyd31nr3288GBc89ZSEJGv8UwaqkeKkTeR4rJe2SSBcMIBuubocAMxLZ4iPkLd9hg6gjqrYfhFqbjy6y2JO0td6EYpkEz4dMyaSHPY46Q-T5jf0qOzS_fbwPa8E4JNKF8dQ5m4AKDJyaFsoAbbAVb6-0DtYc0zfIjDlhN0doeJ0y01UVS91DeHk-H15Hd3y9I6sg0awvjqmldwjhjxCam0VwAWIwVFQBhKFyYmG7UrRYkMljcKbr-KPCqmX1XgmM6igTIkFbnIs6AASo4JB0BrrwnFKplezavc9JGqCAs6CXaQnMAKuYcQSzjpYGIbQDzrQpQxwLKk6179N1pos_LMapnPChKNMva1TTA6qMlxTW4f_XEjrbsUKozAXv5fGSOdPAnZ5vCeRmhJz4rDXP5cQIHQOsEMdDNMnTLffRYMwuWYSKC-evbVRGQaGLzcGxlSFEj5bELiHuMPWhhaMkwjoZrmQ_aSuh1WykV0k0tq7oGQeRzeYeqltozz1qEni5kq_m6Jw-9KsUtPuqmfLOvnktLhYsGpJ2NOq3dm3WIE3zGLT9LmqrMw19Q4S-MKPIJoZPeEyw9qay5_8DIAs2Fxk5vF3eJJr4SdnQDpmgWIizMQXEs9RPWFs6soouwp_zsjRsjeghRRJz2_e7tPvTWGuJYwdhPM96g19A0SC9-41ybQhEQlOURdkW2lq2IMAUSg=w635-h288-no?authuser=0)
Khi chọn vào cuộc hội thoại bất kì, sẽ hiện lên trang tin nhắn chi tiết.
![enter image description here](https://lh3.googleusercontent.com/KEd9ufzRbpDKTVOdT5LUUVg4eVmrkzf8tP6XzuavcVDD-JqMuSM1ZfyXcVckbuIUXzpVCDuR3LYSLMs8GRRNzE3zW8BqjxDVWSBhFmv7Rc2wyGp85CRolX90IWxUvoSc-4QIEVLCwtP5ph0H_GbODYf0R9lD_pqzIUKq9Y_0Uojt1M3rAWZ7317qdaY_DhCYuGBzX_HgzJB1qxbpAl0GmlYPbssuoAErUpATHjUINoNDCLhdG51LEUW-ok_osGXZAXdgabcPZZiYAbkBCkckhwP0QCIvCSxB1VGy_Nng5mtMhR65BoQfUastUaMAPYPY13kshfL95bI7ShBicmuNP-szoGdd3wMl2mFkCkWWifuHBnTfULYtx3uhOHf3iiXab1tli5c8z9JyipHndlRMfIjKBmTDQHeGnI8Zpxfy-ojY1rAuTBz7fygkXHyWRKVxjxYrGytvNQGok17G0C3GcOwsi-SOGCuIl6F0LiXcKoByaFUlxUWFBwDD3zHm1czjQ5fPaLLWbvnChNP5iWj4Nr1zNklkNttMz1od3-ZLMlylGTtmM7nOJYRnM5Ix3P2wmPmyBeQWHJrx8zFNInKI6qlg3lLgAZI5QOv_TtPxi7qWybbGulm5DvRvcLRzBJ3eoE-ZkJNcrA4-GkWMO-gVRLk5VVi5L-FNCrSkFJTjd4C7yC0jrKgj9vs5JX5hx_rcSkOa0p3At8CR7sslX0597tVX9XX99VaPdqfMH3IQNZXWxHotF4fwb4ff9lCREQ=w392-h288-no?authuser=0)
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
![enter image description here](https://lh3.googleusercontent.com/Gxkr6utp2kGaXgg3RTDKsKnwqxlnD9wxQhf0vdvV9Hr8-ThfXo8RHOhf2V4F2rz6Cw3Uq_RasReIHrKSwWbOLRg0Z_tWUI44DKrx05yaZhqjcVHM6xoCLpIwslcGu8V2E5ea5vh1kDBFMrxxx2FDdeK_BmobgQvyCQl26Savc8vO5fgfeDTvVtKNIi3zeNfp9CEmuIl8AaLOmKJZyuaUaQrwbPPK5sFXvKiJ9U89odp0pGFD_ZG2qp2IjLq5G7SgsNB_7LflH5hHtb4bgLaRRj0KMgu0Ul-Qaxi0jvfdAYiwGsIFSRBHcEUQR_8JxanR1UMUDtfOaVsiSfxZl2MvsKMY7ct5_1utGwo9kR_IYD8gOuoByBPF55nyxTVMFlpBEsa1CR7VU_qkH6IwqdpJx2cs_5CY-8JouxDt90UCb0ImdGspqs3RTjeLyFFDRzslV93huBJCOINI8dHUtR4R8Rppff1hQpEHqjREeBHXir9VX-J_kB3N8qbJ5-9AOLRWXNBzBPDQSVwJPUb-BA873rdI51x_WNHBBgN7vy4_KM_HatTW18q2-edwzexMKPGayVSkgBLS_iCyasnI3ht_Ynp0kdZZnsMhMgeNVLxsLFCPNa1Yct24F-nhcJZjPdhul0hyp45IJ8VyCXicFSpvi9QhO_V6peiwChB7flNfJtpy-d68Ioig-epkMzu435uxNh8iqGQmaKecIaAON787Pmz4vQi7MzsUZOQaM4C-_mSDVseRZ94VN8JdYwDfkw=w635-h288-no?authuser=0)
- Sau đấy vào tab Import và thực hiện chọn file từ máy tính, bấm Go để tiến hành tạo cơ sở dữ liệu.
![enter image description here](https://lh3.googleusercontent.com/g7cgVyqC1dttE2AaFdaUB4ork9CriRoc3FB3HMXpA1yw7HBYjOqkEKv7EI7_Gwj4Ig1nrMc_uEkUxzQJUE3ecTDGdMBowh4g86oGgZ5b6MN0XrQevC8Mesj4-zFBufeb-iu0sDrK-PCuhopALGrtUoyfl609lRcj-ztMAPtcvqImhNI7fMsYY8Q03eIMmrAPQcktsziPRr7FEYPiY-eyOVSOfTn2MIvvIustsIOHY2041i6W_wi6DnSd4U-zstVucBOLkL3xyWTiYld-OMuDuWTRCS3jIEcTo0rSpkUjcgbSMSEHaNktyZG4zJJTddwrl44abu09J89klP-7NjXr2bWxSsiQS4g87qb0Wbx_aShCRz6su17HM7S39InTdPMY1y46hgwWpYNq9_AoGE2Wkyes5m5ZMjMlq5GnWLs2pjmI47prtoTL0x4W9TYWPuWakkvi05J8XSzm_yCaOT1ZmkTBXxNWgZJxBQgkTsSHgzNW2gKKSmYBnnRSgv6PXtqmp4_O__dVox0q7ypeHZpOnkHrPMBHjLSEr3moyP78kGmEYNKgKJqMARHv0XqTvWs5NiZOxxnHHc3yFu493TbNTTkPfAeESgCOrwD55t1JoUVc9F1VRX--DqqorMnQjzcjmL0e50W0CAuboX6HDx5oopojmK8jI6aQO7NeWiRSQ13wiZdN7qH6fg_DtNv1SihhT3I5fwyaSgRJxZjdFs9wYYeLRVln9jd5vb9idwozosuAqp9de6hxv9arhnjvGw=w381-h295-no?authuser=0)
6. Bây giờ, ta truy nhập vào địa chỉ website để sử dụng
 ![enter image description here](https://lh3.googleusercontent.com/pw/AM-JKLXFW2UfAdKTfwJqpBfgPhfLWd9sXA8RQoiO4FWpJZ3XBIGAH8FaQO-sM441APeJ7qNllggGuUN73LTP_ctNl2YiLghfQ2sBHrcVeIIXtEeVBz24vt4iC4FxKvo6FQ9clxQX_yLZprc0fy6b_PebL-Nj=w998-h903-no?authuser=0)
## Đóng góp
Tác giả: Nguyễn Minh Mạnh | [Facebook profile](https://www.facebook.com/minhmannh2001/)

-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th3 05, 2023 lúc 11:35 AM
-- Phiên bản máy phục vụ: 10.3.38-MariaDB-0ubuntu0.20.04.1
-- Phiên bản PHP: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `rpagroup_vn_db2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affilate_condition`
--

CREATE TABLE `affilate_condition` (
  `id` bigint(11) NOT NULL,
  `level_id` bigint(11) UNSIGNED DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `commission` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `affilate_condition`
--

INSERT INTO `affilate_condition` (`id`, `level_id`, `depth`, `commission`) VALUES
(1, 2, 0, 5),
(2, 1, 0, 10),
(3, 1, 1, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affilate_level`
--

CREATE TABLE `affilate_level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(256) DEFAULT NULL,
  `sort` varchar(255) NOT NULL,
  `auto_update` varchar(256) DEFAULT '0',
  `is_default` varchar(256) DEFAULT '0',
  `commission` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `affilate_level`
--

INSERT INTO `affilate_level` (`id`, `name`, `slug`, `sort`, `auto_update`, `is_default`, `commission`, `created_at`, `updated_at`) VALUES
(1, 'Đại sứ tri thức 3 sao', '3sao', '1', '0', '0', 40, NULL, NULL),
(2, 'Đại sứ tri thức 2 sao', '2sao', '2', '0', '0', 35, NULL, NULL),
(3, 'Đại sứ tri thức 1 sao', '1sao', '3', '1', '0', 30, NULL, NULL),
(4, 'Đại sứ tri thức', 'daisu', '4', '1', '1', 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `affilate_setting`
--

CREATE TABLE `affilate_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `commission` int(11) DEFAULT NULL,
  `commission_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `level_group` varchar(255) DEFAULT NULL,
  `number_direct` int(11) DEFAULT NULL,
  `personal_balance` int(11) DEFAULT NULL,
  `group_balance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `indirect_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `affilate_setting`
--

INSERT INTO `affilate_setting` (`id`, `name`, `commission`, `commission_type`, `description`, `type`, `level_group`, `number_direct`, `personal_balance`, `group_balance`, `created_at`, `updated_at`, `indirect_level_id`, `level_id`) VALUES
(1, 'Doanh thu cá nhân trực tiếp', 40, 'direct', NULL, 'personal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'Doanh thu cá nhân gián tiếp (từ Đại sứ tri thức 2 sao )', 5, 'indirect', NULL, 'personal', NULL, NULL, NULL, NULL, NULL, NULL, 2, 1),
(3, 'Doanh thu cá nhân gián tiếp (từ Đại sứ tri thức 1 sao)', 10, 'indirect', NULL, 'personal', NULL, NULL, NULL, NULL, NULL, NULL, 3, 1),
(5, 'Doanh thu Nhóm kinh doanh', 2, 'indirect', NULL, 'group', '1,2,3,4', 6, 75000000, 75000000, NULL, NULL, NULL, 1),
(6, 'Doanh thu cá nhân trực tiếp', 35, 'direct', NULL, 'personal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
(7, 'Doanh thu cá nhân gián tiếp (từ Đại sứ tri thức 1 sao )', 5, 'indirect', NULL, 'personal', NULL, NULL, NULL, NULL, NULL, NULL, 3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `combo`
--

CREATE TABLE `combo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sale` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `combo`
--

INSERT INTO `combo` (`id`, `title`, `code`, `thumbnail`, `price`, `price_sale`, `description`, `content`, `created_at`, `updated_at`, `slug`) VALUES
(1, 'Đột Phá Để Dẫn Đầu', NULL, 'https://rpagroup.vn/public/uploads/images/ouQq2R4GQ3.jpg', 5000000, NULL, NULL, NULL, '2023-02-08 04:04:07', NULL, 'dot-pha-de-dan-dau'),
(2, 'Combo 2', NULL, 'https://rpagroup.vn/public/uploads/images/BVm9Zet1oj.jpg', 10000000, NULL, NULL, NULL, '2023-02-08 00:15:48', NULL, 'combo-2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `combo_course`
--

CREATE TABLE `combo_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `combo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `combo_course`
--

INSERT INTO `combo_course` (`id`, `course_id`, `combo_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, NULL),
(4, 10, 1, NULL, NULL),
(5, 7, 1, NULL, NULL),
(6, 9, 1, NULL, NULL),
(7, 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sale` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `is_best_seller` varchar(255) DEFAULT NULL,
  `is_certificate` varchar(255) DEFAULT NULL,
  `video_intro` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `is_published` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course`
--

INSERT INTO `course` (`id`, `title`, `slug`, `thumbnail`, `code`, `point`, `price`, `price_sale`, `description`, `content`, `is_best_seller`, `is_certificate`, `video_intro`, `time`, `is_published`, `created_at`, `updated_at`, `level_id`, `teacher_id`, `sort`) VALUES
(5, 'Tư duy đột phá', 'tu-duy-dot-pha', 'https://rpagroup.vn/public/uploads/images/Tuzd5lMHvX.jpg', NULL, NULL, 999000, NULL, NULL, NULL, '1', '0', 'https://iframe.mediadelivery.net/embed/87177/b7d9e329-0d34-4e9a-8412-2fced9e82a45?autoplay=false', 3, 1, '2023-02-08 02:10:37', NULL, 1, 3, 1),
(6, 'Kỹ năng quản trị cảm xúc', 'ky-nang-quan-tri-cam-xuc', 'https://rpagroup.vn/public/uploads/images/sVGneen01J.jpg', NULL, NULL, 999000, NULL, '<p>Mô tả khóa học</p>', '<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">N</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">gười ta nói rằng cảm xúc là kẻ thù của thành công</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">, </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ngoài ra người ta cũng nói rằng cảm xúc chính là nhân tố quan trọng để con người đi đến thành công nói như thế nào thì cũng đúng miễn là bạn cần phải hiểu và làm như thế nào để dùng những cảm xúc tốt đẹp để tạo nên thành công mà thôi</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">N</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">hững gì chúng ta làm trong lúc tức giận có thể sẽ không khiến chúng ta hài lòng và đôi khi có những điều chúng ta làm trong lúc tức giận còn khiến chúng ta vô cùng hối hậ</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">n! </span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Vậy nên</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> chúng ta cần phải học cái cách để trở thành người có khả năng quản trị cảm xúc</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> khiến cho cuộc sống của chúng ta trở nên tốt đẹp hơn và với nội dung về quản trị cảm xúc</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> bạn</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> sẽ được tìm hiểu về 3 não về tất cả nhữn</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">g</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> chức năng của não bộ trên phương diện tâm lý và chúng ta sẽ biết cách ứng dụng làm như thế nào để chúng ta có thể thành công hơn trong cuộc đời này chúng ta có thể hành động chúng ta có thể hạnh phúc và đi đến một tương lai trên con đường ngắn nhất và nếu bạn đã sãn sàng thì c</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">hào mừng bạn đến với khóa học! Thu Chung và RPA xin trân trọng cảm ơn!</span></span></span></span></span></span></p>', '1', '0', 'https://iframe.mediadelivery.net/embed/87177/c5954269-f422-4a4a-b6b2-777c48d5191e?autoplay=false', 3, 1, '2023-02-09 00:27:02', NULL, 3, 3, 2),
(7, 'Nghệ thuật giao tiếp kết nối bậc thầy', 'nghe-thuat-giao-tiep-ket-noi-bac-thay', 'https://rpagroup.vn/public/uploads/images/KHVhh7ppm4.jpg', NULL, NULL, 999000, NULL, NULL, '<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">B</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ài học số 6 của chúng ta mang tựa đề các cách kết nối hiệu quả</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">. Bạn </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">biết không một cách học nhanh nhất đó chính là chúng ta sẽ mô phỏng những người thành công vậy những người thành công họ đã ngay lập tức tạo ra những kết nối đặc biệt</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> bằng </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">cách nào</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">?</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Một trong các</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> cách kết nối cách đầu tiên</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">, </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">nhanh nhất</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> hiệu quả nhất và cả thế giới này đam mê với nó đó chính là</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> tặng quà!</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Tôi</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> luôn muốn tặng một món quà nào </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">đó cho bất kỳ ai tôi gặp </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">và tôi tặng rất là nhiều quà trong cuộc đời của mình cho nên hãy nhớ rằng người ta có niềm đam mê đặc biệt với quà vậy thì lúc nào bạn cũng phải có quà tặng và đừng tặng món quà nào mà khiến bạn</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> thủng ví</span></span></span> <span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">nhé!</span></span></span> <span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">C</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ó muôn vàn quà tặng </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ý nghĩa </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">trong cuộc đời này</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">…</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Và còn rất nhiều bí mật sẽ được bật mí trong khóa học đang chờ đón bạn nhanh tay nhé!</span></span></span></span></span></span></p>', '1', '0', NULL, 3, 1, '2023-02-09 00:27:34', NULL, 4, 3, 3),
(8, 'Kỹ năng thuyết trình', 'ky-nang-thuyet-trinh', 'https://rpagroup.vn/public/uploads/images/Rjbd9JrS49.jpg', NULL, NULL, 999000, NULL, NULL, '<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Tôi tặng các bạn một câu nói thế này:</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> “Kỹ năng thuyết trình thực sự là một tài sản nếu bạn có nó, còn nếu bạn không có nó thì đấy chính là gánh nặng với bạn” và người ta nói rằng</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">: </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">“</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">K</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">héo ăn khéo nói thì sẽ có cả thiên hạ”. </span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Vậy thì chúng ta bắt đầu gia tăng tài sản của mình cùng với khóa học nhé</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">!</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> Trong chương trình</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> này tôi</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> sẽ mang đến cho bạn những kỹ năng</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> những điều tuyệt vời</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">, </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">những bí mật mà tất cả những chuyên gia thuyết trình ở trên thế giới đang nắm giữ</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> và các bạn</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> ạ không có công thức nào để giúp ai đó thành công</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> trừ khi bạn bắt tay vào làm thực sự nhưng thành công luôn để lại dấu vết! </span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">T</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">rong chương trình này chúng tôi sẽ chia sẻ với bạn những nội dung đặc biệt như sau</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">:</span></span></span> </span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">T</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">hứ nhất </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">đó là</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> cấu trúc của một bài thuyết trình</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> bất kỳ.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Thứ 2 là những cấu trúc đặc biệt giúp bạn tự tin và thu hút đám dông ở bất kỳ nơi nào! </span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Thứ 3 tôi sẽ chia sẻ cho bạn về bí mật giao tiếp phi ngôn từ vô cùng quan trọng.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Thứ 4 tôi sẽ hướng dẫn bạn cách làm thế nào để thuyết trình bằng một giọng nói đầy uy lực thu hút mọi đám đông và cực kỳ truyền cảm hứng.</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Trong khóa học này bạn sẽ phát hiện ra bí mật thuyết trình chưa bao giờ lại dễ dàng và dễ thực hành đến vậy! Và tôi sẽ chỉ nói sau khi bạn tiếp tục hành trình đầy ý nghĩa này với tôi! Xin chào và hẹn gặp lại bạn thân mến!</span></span></span></p>', '1', '0', 'https://iframe.mediadelivery.net/embed/87177/d315846e-c029-45ae-aa14-a4123710e6d0?autoplay=false', 3, 1, '2023-02-09 00:26:00', NULL, 4, 3, 4),
(9, 'Bán hàng đỉnh cao', 'ban-hang-dinh-cao', 'https://rpagroup.vn/public/uploads/images/yAild02FIq.jpg', NULL, NULL, 999000, NULL, NULL, '<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Trong module số </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">5 mang tựa đề </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">“Bán hàng đỉnh cao”</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> và khi tôi nhắc đến 4 từ </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">này </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">rất nhiều người mong muốn kỹ năng này và </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">bạn</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> biết đấy</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> bán hàng chính là cách duy nhất để chúng ta có thể sống một cuộc đời </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ngoại hạng, </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">khác biệt</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> sống cuộc đời như</span></span></span> <span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">cách mà bạn mong muốn</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">. </span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">V</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">à đặc biệt bán hàng là cách mà rất nhiều người thành công trên thế giới họ đã thành công</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> đặc biệt nữa là họ đã để lại một dấu ấn không thể phai mờ và tạo ra khối tài sản khổng lồ </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">đáng ngưỡng mộ.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Rất ít ai</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> giàu có mà lại không bắt đầu từ kỹ năng bán hàng</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">, vì</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> vậy không có lý do gì bạn và tôi lại không bắt đầu với kỹ năng này </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ngay</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> trong chương trình này của R</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">P</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">A</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> chúng tôi sẽ cung cấp cho anh chị một vài bí quyết </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">r</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ất đặc biệt của những người bán hàng thành công nhất trên thế giới</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">! Xin chào và hẹn gặp lại bạn trong khóa học nhé! </span></span></span></span></span></span></p>', '1', '0', 'https://iframe.mediadelivery.net/embed/87177/08d1bc11-36ba-4257-a849-2c43d121d9e9?autoplay=false', 3, 1, '2023-02-09 00:27:50', NULL, 4, 3, 5),
(10, 'Nghệ thuật lãnh đạo', 'nghe-thuat-lanh-dao', 'https://rpagroup.vn/public/uploads/images/bWl7NeMFy0.jpg', NULL, NULL, 999000, NULL, NULL, '<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;<span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">“N</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ghệ thuật lãnh đạo</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> bậc thầy”</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> và đây chính là điều mà chúng tôi muốn gửi gắm </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">đến bạn</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> trên hành trình cuộc đời nhất định chúng ta cần phải định vị mình trở thành nhà lãnh đạo đắc nhân tâm</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> thu phục lòng người và đạt được mục tiêu cao nhất</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Trong khóa học này tôi xin gửi đến các bạn những bí mật tôi được học tập và rèn luyện từ những người thầy vĩ đại,</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"> họ đã huấn luyện những nhà lãnh đạo cao nhất trên thế giới</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">!</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Và </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">chúng ta sẽ biết các cấp độ lãnh đạo để chúng ta có thể vươn tới cấp độ cao nhất ngoài ra có một điều đối với nhà lãnh đạo mà họ cần phải biết đó là họ cần biết về các cấp độ giá trị và giá trị thực sự mà bạn tạo ra cho cuộc đời này đó chính là gì</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">?</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">M</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">ột điều đặc </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">nữa </span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">đó là chúng ta sẽ nghiên cứu về nghệ thuật hay nguyên tắc vàng trong nghệ thuật lãnh đạo</span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"margin:0cm 0cm 8pt\"><span style=\"font-size:11pt\"><span style=\"line-height:107%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">C</span></span></span><span lang=\"VI\" style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">uối cùng chúng ta sẽ học hỏi và làm như thế nào để chúng ta có thể đặt ra những mục tiêu cao hơn và làm thế nào để đạt mục tiêu </span></span></span><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">đó cùng đội nhóm chinh phục ước mơ cuộc đời họ!</span></span></span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:14.0pt\"><span style=\"line-height:107%\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Hẹn gặp bạn trong khóa học đầy mê hoặc này nhé!</span></span></span></p>', '1', '0', 'https://iframe.mediadelivery.net/embed/87177/90f982f2-3034-47b8-b9bb-0e8a6f637fcc?autoplay=false', 3, 1, '2023-02-09 00:26:32', NULL, 4, 3, 6),
(11, 'Khóa học chuyên gia đào tạo 10 buổi qua Zoom Online', 'khoa-hoc-chuyen-gia-dao-tao-10-buoi-qua-zoom-online', 'https://rpagroup.vn/public/uploads/images/0kqcBWsmIe.jpg', NULL, NULL, 0, NULL, NULL, NULL, '0', '0', NULL, 10, 1, '2023-02-05 23:52:00', NULL, 4, 3, NULL),
(13, 'Đột phá bản thân cùng NLP', 'dot-pha-ban-than-cung-nlp', 'https://rpagroup.vn/public/uploads/images/cQBlmLVhcj.jpg', NULL, NULL, 0, NULL, NULL, NULL, '0', '0', NULL, 3, 1, '2023-02-06 02:50:52', NULL, 4, 3, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_lession_document`
--

CREATE TABLE `course_lession_document` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `document_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_teacher_lession_question`
--

CREATE TABLE `course_teacher_lession_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `document`
--

CREATE TABLE `document` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lesson`
--

CREATE TABLE `lesson` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `_lft` int(10) UNSIGNED DEFAULT NULL,
  `_rgt` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_try` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `video_youtube` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lesson`
--

INSERT INTO `lesson` (`id`, `title`, `video`, `content`, `parent_id`, `_lft`, `_rgt`, `created_at`, `updated_at`, `is_try`, `course_id`, `video_youtube`) VALUES
(45, 'Bài 1', 'cb086087-39eb-400c-9079-075b5c4e7be7', NULL, NULL, 1, 4, '2023-01-18 19:14:43', NULL, '1', 6, NULL),
(46, 'Bài 2', '2d2f4227-7682-45ea-953e-d71accb09435', NULL, NULL, 5, 8, '2023-01-15 20:21:27', NULL, '0', 6, NULL),
(47, 'Bài 3', '5ffe6ff1-dfa8-4fdf-b4e9-17d8fb605b4d', NULL, NULL, 9, 10, '2023-01-15 19:59:39', NULL, '0', 6, NULL),
(48, 'Bài 4', '3372529f-f4f9-4872-a563-06badd58ec27', NULL, NULL, 11, 12, '2023-01-15 19:59:55', NULL, '0', 6, NULL),
(49, 'Bài 5', 'b9ca6d2e-6f6a-4588-b384-31d3255bff59', NULL, NULL, 13, 14, '2023-01-15 20:00:06', NULL, '0', 6, NULL),
(50, 'Bài 6', 'd92f4549-6c54-4229-bcc7-c46f8ab96190', NULL, NULL, 15, 16, '2023-01-15 20:00:21', NULL, '0', 6, NULL),
(51, 'Bài 7', '3db6b1fe-59e8-4cad-a5dd-57550d9a57f1', NULL, NULL, 17, 18, '2023-01-15 20:00:33', NULL, '0', 6, NULL),
(52, 'Bài 8', '730f71da-15af-4a35-816b-5a413940bb84', NULL, NULL, 19, 20, '2023-01-15 20:00:50', NULL, '0', 6, NULL),
(53, 'Bài 9', 'ccd1cc87-f888-4d75-b2da-39188ce5e82c', NULL, NULL, 21, 22, '2023-01-15 20:01:01', NULL, '0', 6, NULL),
(54, 'Bài 10', '10c6a24c-fd9c-451b-83fc-8bb7eaffeff3', '<p>Nội dung bài học 123</p>', NULL, 23, 26, '2023-01-18 17:38:45', NULL, '0', 6, NULL),
(58, 'Bài 1', 'a97ccf3f-ced7-496c-864f-7246fde7a817', NULL, NULL, 27, 28, '2023-01-18 20:44:38', NULL, '1', 9, NULL),
(59, 'Bài 2', '10ec424f-76ac-448b-897a-51d3b9c35a5c', NULL, NULL, 29, 30, '2023-01-18 20:45:27', NULL, '0', 9, NULL),
(60, 'Bài 3', 'd550767e-55f7-4172-bb3e-2315e78ae80c', NULL, NULL, 31, 32, '2023-01-18 20:45:44', NULL, '0', 9, NULL),
(61, 'Bài 4', '455590f2-a051-42bb-b0d4-c97bfd24a492', NULL, NULL, 33, 34, '2023-01-18 20:45:57', NULL, '0', 9, NULL),
(62, 'Bài 5', '91cc5d25-1a2d-434d-a6d2-c7dde20ec275', NULL, NULL, 35, 36, '2023-01-18 20:46:18', NULL, '0', 9, NULL),
(63, 'Bài 6', '9b89e3cb-f56d-43f3-a868-c2bfbc1b71ae', NULL, NULL, 37, 38, '2023-01-18 20:46:33', NULL, '0', 9, NULL),
(64, 'Bài 7', 'a4499954-7ad7-4aee-be15-511a174d19bf', NULL, NULL, 39, 40, '2023-01-18 20:46:58', NULL, '0', 9, NULL),
(65, 'Bài 8', 'f9490c9d-8af1-4d09-80d3-5a508fa2ed5e', NULL, NULL, 41, 42, '2023-01-18 20:47:16', NULL, '0', 9, NULL),
(66, 'Bài 9', 'f6dbf195-2cd4-407f-bc9b-4a868590d19b', NULL, NULL, 43, 44, '2023-01-18 20:47:31', NULL, '0', 9, NULL),
(67, 'Bài 10', 'e1ad5c5d-555e-4fa7-9d04-39d3c2ac6af8', NULL, NULL, 45, 46, '2023-01-18 20:47:41', NULL, '0', 9, NULL),
(68, 'Bài 11', 'f3bf2f6d-8a1c-4bd4-b398-d830acc9043c', NULL, NULL, 47, 48, '2023-01-18 20:48:13', NULL, '0', 9, NULL),
(69, 'Bài 12', '5655b95a-98ed-4bb8-a4cc-cd8817eaf65e', NULL, NULL, 49, 50, '2023-01-18 20:48:24', NULL, '0', 9, NULL),
(70, 'Bài 13', '83da24b2-481f-4eff-96fd-66581ba68324', NULL, NULL, 51, 52, '2023-01-18 20:48:39', NULL, '0', 9, NULL),
(71, 'Bài 14', '0bd055bc-5f67-451d-8465-31b791bb8492', NULL, NULL, 53, 54, '2023-01-18 20:48:51', NULL, '0', 9, NULL),
(72, 'Bài 1', '775e5e77-26d6-4a20-8203-bd73d560a0f8', NULL, NULL, 55, 56, '2023-01-18 20:53:06', NULL, '1', 8, NULL),
(73, 'Bài 2', '4504f340-36e9-4e49-9647-5ecc30f7abe1', NULL, NULL, 57, 58, '2023-01-18 21:05:53', NULL, '1', 8, NULL),
(74, 'Bài 3', '33d15bb0-eda5-438e-b8f0-382a5ce8c4ed', NULL, NULL, 59, 60, '2023-01-18 20:53:48', NULL, '0', 8, NULL),
(75, 'Bài 4', 'c6e4c778-3e43-47e3-9548-443290538074', NULL, NULL, 61, 62, '2023-01-18 20:54:12', NULL, '0', 8, NULL),
(76, 'Bài 5', '1c3f9acf-2ec8-4a75-a720-9c105cec4d91', NULL, NULL, 63, 64, '2023-01-18 20:54:34', NULL, '0', 8, NULL),
(77, 'Bài 6', '0f7825c6-f8bf-440f-8970-aae149b622b2', NULL, NULL, 65, 66, '2023-01-18 20:55:55', NULL, '0', 8, NULL),
(78, 'Bài 7', 'd082aa97-54f9-4fda-bad5-dda8a4b70f54', NULL, NULL, 67, 68, '2023-01-18 20:56:06', NULL, '0', 8, NULL),
(79, 'Bài 8', 'a335d27a-8bde-489c-ac33-28b227ada97e', NULL, NULL, 69, 70, '2023-01-18 20:56:35', NULL, '0', 8, NULL),
(80, 'Bài 9 - Giảng Đứng', '203e37bb-86f2-4da5-a75d-a94824f2e9c3', NULL, NULL, 71, 72, '2023-01-18 20:57:14', NULL, '0', 8, NULL),
(81, 'Bài 9 - Đối mặt', 'ac37cf77-c670-4af9-91a5-fdd6b5f0e9ab', NULL, NULL, 73, 74, '2023-01-18 20:57:29', NULL, '0', 8, NULL),
(82, 'Bài 10', '630ae775-c739-4c08-978b-28cf9b36448b', NULL, NULL, 75, 76, '2023-01-18 20:57:47', NULL, '0', 8, NULL),
(83, 'Bài 1', '20cbbfef-1be3-4741-ae3a-8264b59e1a32', NULL, NULL, 77, 78, '2023-01-18 21:00:35', NULL, '1', 10, NULL),
(84, 'Bài 2', 'f11b05e8-9f64-45d9-8789-2681efdebd56', NULL, NULL, 79, 80, '2023-01-18 21:00:55', NULL, '0', 10, NULL),
(85, 'Bài 3', 'f0a83822-db2c-4cd2-817e-ab9e613511f0', NULL, NULL, 81, 82, '2023-01-18 21:01:04', NULL, '0', 10, NULL),
(86, 'Bài 4', 'f294f11f-9774-4849-8f8b-049d265d0136', NULL, NULL, 83, 84, '2023-01-18 21:01:16', NULL, '0', 10, NULL),
(87, 'Bài 5', NULL, NULL, NULL, 85, 86, '2023-01-18 21:01:36', NULL, '0', 10, NULL),
(88, 'Bài 6', 'fd1cc328-6a7f-491c-8f88-29b6c02677a8', NULL, NULL, 87, 88, '2023-01-18 21:01:50', NULL, '0', 10, NULL),
(89, 'Buổi 1', NULL, NULL, NULL, 89, 90, '2023-02-07 02:43:33', NULL, '1', 11, 'https://www.youtube.com/watch?v=eCOIGuQV_KI'),
(90, 'Buổi 2', NULL, NULL, NULL, 91, 92, '2023-02-06 00:23:19', NULL, '0', 11, 'https://www.youtube.com/watch?v=VsMtIZOUWDE'),
(91, 'Buổi 3', NULL, NULL, NULL, 93, 94, '2023-02-06 02:15:07', NULL, '0', 11, 'https://www.youtube.com/watch?v=4ybffg1hpP0'),
(92, 'Buổi 4', NULL, NULL, NULL, 95, 96, '2023-02-06 02:16:26', NULL, '0', 11, 'https://www.youtube.com/watch?v=4ybffg1hpP0'),
(93, 'Buổi 5', NULL, NULL, NULL, 97, 98, '2023-02-06 02:16:37', NULL, '0', 11, 'https://www.youtube.com/watch?v=jlweCAJqNmQ'),
(94, 'Buổi 6', NULL, NULL, NULL, 99, 100, '2023-02-06 02:41:37', NULL, '0', 11, 'https://www.youtube.com/watch?v=G5e9mZ6E9Mo'),
(95, 'Buổi 7', NULL, NULL, NULL, 101, 102, '2023-02-06 02:42:50', NULL, '0', 11, 'https://www.youtube.com/watch?v=dFN9klo_BRY'),
(96, 'Buổi 8', NULL, NULL, NULL, 103, 104, '2023-02-06 02:43:01', NULL, '0', 11, 'https://www.youtube.com/watch?v=E1xs9XEDRH0'),
(97, 'Buổi 9', NULL, NULL, NULL, 105, 106, '2023-02-06 02:43:30', NULL, '0', 11, 'https://www.youtube.com/watch?v=pfuTICHAKLE'),
(98, 'Buổi 10', NULL, NULL, NULL, 107, 108, '2023-02-06 02:43:58', NULL, '0', 11, 'https://www.youtube.com/watch?v=9kNzQQ1VocE'),
(99, 'Phần 1', NULL, NULL, NULL, 109, 110, '2023-02-07 02:43:56', NULL, '1', 13, 'https://youtu.be/8OeTCBSWwys'),
(100, 'Phần 2', NULL, NULL, NULL, 111, 112, '2023-02-07 20:48:42', NULL, '0', 13, 'https://youtu.be/wYAvxLzx8Dg'),
(101, 'Bài 1', '3ffa1f92-c59c-4406-9602-47609be235d7', NULL, NULL, 113, 114, '2023-02-07 21:34:47', NULL, '1', 5, NULL),
(102, 'Bài 2', 'edf7f4c0-b511-48bc-8f19-dd4468396d50', NULL, NULL, 115, 116, '2023-02-07 21:36:01', NULL, '1', 5, NULL),
(103, 'Bài 3', 'd26fc7e3-811f-42e6-a8db-8b1eafe561ae', NULL, NULL, 117, 118, '2023-02-07 21:36:17', NULL, '0', 5, NULL),
(104, 'Bài 4', '26ee06ae-8f19-42b8-a545-2d3d0ab54f59', NULL, NULL, 119, 120, '2023-02-07 21:36:40', NULL, '0', 5, NULL),
(105, 'Bài 5', '55a529b4-c79b-4089-b1a1-a3f50011765c', NULL, NULL, 121, 122, '2023-02-07 21:36:51', NULL, '0', 5, NULL),
(106, 'Bài 6', '4684b57f-571f-451a-9d29-2ea81403a335', NULL, NULL, 123, 124, '2023-02-07 21:37:09', NULL, '0', 5, NULL),
(107, 'Bài 7', '783e371e-4452-4b25-b199-24d8ae96542b', NULL, NULL, 125, 126, '2023-02-07 21:37:20', NULL, '0', 5, NULL),
(108, 'Bài 8', '9e8f06e6-93ca-4338-a7ea-917cbbfd3730', NULL, NULL, 127, 128, '2023-02-07 21:37:35', NULL, '0', 5, NULL),
(109, 'Bài 9', '1cd8b45c-6084-400e-8cd8-899a5021ae8c', NULL, NULL, 129, 130, '2023-02-07 21:37:46', NULL, '0', 5, NULL),
(110, 'Bài 10', 'df4333dd-20e7-494e-89e7-195f505df0ff', NULL, NULL, 131, 132, '2023-02-07 21:38:02', NULL, '0', 5, NULL),
(111, 'Bài 11', 'a86037d4-6f73-4edf-a83b-6dc35fdca2be', NULL, NULL, 133, 134, '2023-02-07 21:39:05', NULL, '0', 5, NULL),
(112, 'Bài 12', '4b4bc79b-b6d3-44de-ac3e-65ca22ee3df2', NULL, NULL, 135, 136, '2023-02-07 21:39:59', NULL, '0', 5, NULL),
(113, 'Bài 13', 'bb6c4f6c-fdd6-46f0-8799-f42df230e2fa', NULL, NULL, 137, 138, '2023-02-07 21:40:16', NULL, '0', 5, NULL),
(114, 'Bài 14', 'b6037fba-4747-4519-8193-b05f21abc1a0', NULL, NULL, 139, 140, '2023-02-07 21:45:19', NULL, '0', 5, NULL),
(115, 'Bài 15', '954b6b35-0316-42c4-bdc2-0935d3d2baac', NULL, NULL, 141, 142, '2023-02-07 21:45:34', NULL, '0', 5, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `level`
--

CREATE TABLE `level` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `level`
--

INSERT INTO `level` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Cơ bản', '2023-01-09 21:50:23', NULL),
(2, 'Nâng cao', '2023-01-09 21:50:36', NULL),
(3, 'Chuyên nghiệp', '2023-01-09 21:50:42', NULL),
(4, 'Mọi trình độ', '2023-01-12 03:00:27', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_12_20_074311_create_user_table', 1),
(3, '2022_12_20_074630_create_user_group_table', 1),
(4, '2022_12_20_075017_add_group_id_to_user_table', 1),
(5, '2022_12_20_150405_add_is_default_to_user_group', 1),
(6, '2022_12_26_150001_create_taxonomy_table', 1),
(7, '2022_12_26_161122_add_thumbnail_to_taxonomy_table', 1),
(8, '2022_12_27_033251_add_sortorder_to_taxonomy_table', 1),
(9, '2022_12_27_035742_add_slug_to_taxonomy_table', 1),
(10, '2022_12_27_041333_add_seo_to_taxonomy_table', 1),
(11, '2022_12_27_063442_create_supplier_table', 1),
(12, '2022_12_27_070144_create_product_table', 1),
(13, '2022_12_27_070814_create_product_meta_table', 1),
(14, '2022_12_27_084508_add_supplier_id_to_product_table', 1),
(15, '2022_12_27_090836_create_taxonomy_relationship_table', 1),
(16, '2022_12_27_091131_add_taxonomy_type_to_taxonomy_relationship_table', 1),
(17, '2022_12_27_091555_add_percent_to_product_table', 1),
(18, '2022_12_28_081115_add_is_show_to_user_group_table', 1),
(19, '2022_12_29_043029_create_order_table', 1),
(20, '2022_12_29_061144_add_code_to_order_table', 1),
(21, '2022_12_29_062530_add_status_to_order_table', 1),
(22, '2022_12_29_071517_add_total_point_to_order_table', 1),
(23, '2022_12_29_075909_add_total_commission_to_order_table', 1),
(24, '2022_12_29_081456_create_payment_history_table', 1),
(25, '2022_12_30_043330_create_upload_table', 1),
(26, '2022_12_30_083557_add_aff_number_to_user_table', 1),
(27, '2022_12_30_135310_create_product_group_table', 1),
(28, '2022_12_30_140235_add_group_id_to_product_table', 1),
(29, '2022_12_31_064043_add_lft_rgt_to_user_table', 1),
(30, '2022_12_31_080944_create_ticket_table', 1),
(31, '2022_12_31_082002_add_parent_id_to_ticket_table', 1),
(32, '2022_12_31_083639_add_code_status_to_ticket_table', 1),
(33, '2022_12_31_090553_add_lft_rgt_to_ticket_table', 1),
(34, '2023_01_06_072020_create_course_table', 1),
(35, '2023_01_06_072330_create_level_table', 1),
(36, '2023_01_06_072409_add_level_id_to_course_id', 1),
(37, '2023_01_06_072536_create_teacher_table', 1),
(38, '2023_01_06_072624_add_teacher_id_to_course_id', 1),
(39, '2023_01_06_073100_create_lesson_table', 2),
(40, '2023_01_06_073346_create_document_table', 3),
(41, '2023_01_06_073503_create_course_lession_document_table', 4),
(42, '2023_01_06_074457_create_question_table', 5),
(43, '2023_01_06_074835_create_course_teacher_lession_question_table', 5),
(44, '2023_01_06_075025_create_order_course_user_table', 5),
(45, '2023_01_09_135810_add_course_id_to_taxonomy_relationship_table', 6),
(46, '2023_01_10_090727_add_is_try_to_lesson_table', 7),
(47, '2023_01_11_080009_add_course_id_to_lesson_table', 8),
(51, '2023_01_12_080946_create_affilate_setting_table', 9),
(52, '2023_01_12_081001_create_affilate_level_table', 9),
(53, '2023_01_12_081059_add_indirect_level_id_to_affilate_setting', 9),
(54, '2023_01_12_081948_add_level_id_to_affilate_setting', 10),
(55, '2023_01_12_083330_add_level_id_to_user_table', 11),
(58, '2023_01_12_110921_create_course_combo_table', 12),
(59, '2023_01_12_111301_create_combo_course_table', 13),
(60, '2023_01_16_014906_add_sort_to_course_table', 14),
(61, '2023_01_16_063910_add_slug_to_teacher_table', 15),
(62, '2023_01_16_073002_add_slug_to_combo_table', 16),
(64, '2023_01_17_073049_create_setting_table', 17),
(65, '2023_01_18_041948_add_is_affilate_to_order_table', 18),
(67, '2023_01_18_073107_add_is_affilate_to_order_table', 19),
(68, '2023_01_18_231113_add_created_by_to_order_table', 20),
(69, '2023_01_19_073132_add_is_course_active_to_order_table', 21),
(71, '2023_02_06_072040_add_video_youtube_to_lesson_table', 22),
(72, '2023_02_08_065557_create_post_table', 23);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `info_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`info_order`)),
  `info_shipping` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`info_shipping`)),
  `note` text DEFAULT NULL,
  `payment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment`)),
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`products`)),
  `shipping` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shipping`)),
  `subtotal` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `total_weight` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `total_point` int(11) DEFAULT NULL,
  `total_commission` int(11) DEFAULT NULL,
  `is_affiliate` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `is_course_active` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `code`, `discount`, `info_order`, `info_shipping`, `note`, `payment`, `products`, `shipping`, `subtotal`, `total`, `total_weight`, `user_id`, `parent_id`, `created_at`, `updated_at`, `status`, `total_point`, `total_commission`, `is_affiliate`, `created_by`, `is_course_active`) VALUES
(130, 'RPA434759', 0, '{\"phone\":\"0932730394\",\"email\":\"anhnnd.hotro@gmail.com\",\"fullname\":\"Duy Anh\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":2000000,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 41, 5, '2023-02-28 11:46:27', NULL, 'complete', NULL, 2000000, '0', 41, NULL),
(132, 'RPA583869', 0, '{\"phone\":\"0932730395\",\"email\":\"gianghnt@gmail.com\",\"fullname\":\"Giang\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 113, 41, '2023-02-28 11:56:51', NULL, 'complete', NULL, 0, '0', 113, NULL),
(133, 'RPA499222', 0, '{\"phone\":\"0932730396\",\"email\":\"handnt@gmail.com\",\"fullname\":\"\\u0110o\\u00e0n Ng\\u1ecdc Th\\u00fay H\\u00e2n\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 114, 41, '2023-02-28 12:05:34', NULL, 'complete', NULL, 0, '0', 114, NULL),
(135, 'RPA672565', 0, '{\"phone\":\"0932730396\",\"email\":\"handnt@gmail.com\",\"fullname\":\"\\u0110o\\u00e0n Ng\\u1ecdc Th\\u00fay H\\u00e2n\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 114, 41, '2023-02-28 12:11:36', NULL, 'complete', NULL, 0, '0', 114, NULL),
(136, 'RPA852823', 0, '{\"phone\":\"0932730397\",\"email\":\"bao@gmail.com\",\"fullname\":\"B\\u1ea3o\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 115, 41, '2023-02-28 12:24:41', NULL, 'complete', NULL, 0, '0', 115, NULL),
(137, 'RPA511085', 0, '{\"phone\":\"0932630397\",\"email\":\"trung@gmail.com\",\"fullname\":\"Trung\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 116, 41, '2023-02-28 12:27:15', NULL, 'complete', NULL, 0, '0', 116, NULL),
(140, 'RPA484155', 0, '{\"phone\":\"09327125125\",\"email\":\"hailt@gmail.com\",\"fullname\":\"L\\u00ea Trung H\\u1ea3i\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 119, 41, '2023-02-28 13:06:19', NULL, 'complete', NULL, 0, '0', 119, NULL),
(141, 'RPA234662', 0, '{\"phone\":\"09327125125\",\"email\":\"hailt@gmail.com\",\"fullname\":\"L\\u00ea Trung H\\u1ea3i\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 119, 41, '2023-02-28 13:11:24', NULL, 'complete', NULL, 0, '0', 119, NULL),
(142, 'RPA602587', 0, '{\"phone\":\"09831251251\",\"email\":\"beem@gmail.com\",\"fullname\":\"B\\u00e9 Em\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 120, 114, '2023-02-28 13:37:12', NULL, 'complete', NULL, 0, '0', 120, NULL),
(143, 'RPA987104', 0, '{\"phone\":\"09831251251\",\"email\":\"beem@gmail.com\",\"fullname\":\"B\\u00e9 Em\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 120, 114, '2023-02-28 13:56:11', NULL, 'complete', NULL, 0, '0', 120, NULL),
(144, 'RPA802159', 0, '{\"phone\":\"0932730396\",\"email\":\"handnt@gmail.com\",\"fullname\":\"\\u0110o\\u00e0n Ng\\u1ecdc Th\\u00fay H\\u00e2n\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 114, 41, '2023-02-28 13:57:43', NULL, 'complete', NULL, 0, '0', 114, NULL),
(145, 'RPA954835', 0, '{\"phone\":\"0932730394\",\"email\":\"anhnnd.hotro@gmail.com\",\"fullname\":\"Duy Anh\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":2000000,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 41, 5, '2023-02-28 15:09:42', NULL, 'complete', NULL, 2000000, '0', 41, NULL),
(146, 'RPA765759', 0, '{\"phone\":\"09831251251\",\"email\":\"beem@gmail.com\",\"fullname\":\"B\\u00e9 Em\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 120, 114, '2023-02-28 15:12:45', NULL, 'complete', NULL, 0, '0', 120, NULL),
(147, 'RPA598565', 0, '{\"phone\":\"09831251251\",\"email\":\"beem@gmail.com\",\"fullname\":\"B\\u00e9 Em\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 120, 114, '2023-02-28 15:18:36', NULL, 'pending', NULL, 0, '0', 120, NULL),
(148, 'RPA301470', 0, '{\"phone\":\"0352781356\",\"email\":\"levanhoan0412@gmail.com\",\"fullname\":\"L\\u00ea V\\u0103n Ho\\u00e0n\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 121, 5, '2023-03-02 02:53:43', NULL, 'complete', NULL, 0, '0', 121, NULL),
(149, 'RPA269170', 0, '{\"phone\":\"0352781357\",\"email\":\"lehoantb94@gmail.com\",\"fullname\":\"Ho\\u00e0n L\\u00ea\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 122, 121, '2023-03-02 02:56:44', NULL, 'complete', NULL, 0, '0', 122, NULL),
(150, 'RPA214450', 0, '{\"phone\":\"0352781358\",\"email\":\"hoanle.c2c@gmail.com\",\"fullname\":\"L\\u00ea Ho\\u00e0n\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 123, 122, '2023-03-02 03:05:21', NULL, 'complete', NULL, 0, '0', 123, NULL),
(151, 'RPA853811', 0, '{\"phone\":\"0352781359\",\"email\":\"dstt01@mail1s.edu.vn\",\"fullname\":\"DS01\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 126, 121, '2023-03-02 04:32:18', NULL, 'complete', NULL, 0, '0', 126, NULL),
(152, 'RPA755855', 0, '{\"phone\":\"0352781310\",\"email\":\"dstt02@mail1s.edu.vn\",\"fullname\":\"DS02\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 127, 121, '2023-03-02 04:34:19', NULL, 'complete', NULL, 0, '0', 127, NULL),
(153, 'RPA798659', 0, '{\"phone\":\"0352781311\",\"email\":\"dstt03@mail1s.edu.vn\",\"fullname\":\"DS03\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 128, 121, '2023-03-02 04:38:32', NULL, 'complete', NULL, 0, '0', 128, NULL),
(154, 'RPA532169', 0, '{\"phone\":\"0352781312\",\"email\":\"dstt04@mail1s.edu.vn\",\"fullname\":\"DS04\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 129, 121, '2023-03-02 04:41:17', NULL, 'complete', NULL, 0, '0', 129, NULL),
(155, 'RPA581845', 0, '{\"phone\":\"0352781313\",\"email\":\"dstt05@mail1s.edu.vn\",\"fullname\":\"DS05\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 130, 121, '2023-03-02 04:44:57', NULL, 'complete', NULL, 0, '0', 130, NULL),
(167, 'RPA714307', 0, '{\"phone\":\"125125125125\",\"email\":\"test123@gmail.com\",\"fullname\":\"test 12\",\"address\":\"test\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 131, 121, '2023-03-02 05:16:51', NULL, 'complete', NULL, 0, '0', 131, NULL),
(169, 'RPA399337', 0, '{\"phone\":\"1234567890\",\"email\":\"dstt10@mail1s.edu.vn\",\"fullname\":\"DS10\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 132, 122, '2023-03-02 06:59:53', NULL, 'complete', NULL, 0, '0', 132, NULL),
(170, 'RPA897160', 0, '{\"phone\":\"1234567778\",\"email\":\"dstt11@gmail.com\",\"fullname\":\"DS11\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 133, 122, '2023-03-02 07:03:49', NULL, 'complete', NULL, 0, '0', 133, NULL),
(171, 'RPA351252', 0, '{\"phone\":\"1234544345\",\"email\":\"dstt12@gmail.com\",\"fullname\":\"DS12\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 134, 122, '2023-03-02 07:05:02', NULL, 'complete', NULL, 0, '0', 134, NULL),
(172, 'RPA992511', 0, '{\"phone\":\"1242343242\",\"email\":\"dstt13@gmail.com\",\"fullname\":\"DS13\",\"address\":\"3\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 135, 122, '2023-03-02 07:06:34', NULL, 'complete', NULL, 0, '0', 135, NULL),
(173, 'RPA787310', 0, '{\"phone\":\"31248274232\",\"email\":\"dstt14@gmail.com\",\"fullname\":\"DS14\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 136, 122, '2023-03-02 07:31:41', NULL, 'complete', NULL, 0, '0', 136, NULL),
(174, 'RPA869028', 0, '{\"phone\":\"0344568974\",\"email\":\"minhphong@gmail.com\",\"fullname\":\"Minh Phong\",\"address\":\"T\\u1ed1 H\\u1eefu, H\\u00e0 \\u0110\\u00d4ng\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"aab3cab6ff0c958924826ce609aad477\":{\"rowId\":\"aab3cab6ff0c958924826ce609aad477\",\"id\":\"8\",\"name\":\"K\\u1ef9 n\\u0103ng thuy\\u1ebft tr\\u00ecnh\",\"qty\":\"1\",\"price\":999000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/Rjbd9JrS49.jpg\",\"type\":\"course\",\"slug\":\"ky-nang-thuyet-trinh\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"999000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/Rjbd9JrS49.jpg\",\"type\":\"course\"}}', NULL, 999000, 999000, NULL, 125, 53, '2023-03-02 08:04:49', NULL, 'complete', NULL, 0, '1', 125, NULL),
(175, 'RPA457468', 0, '{\"phone\":\"0344568974\",\"email\":\"minhphong@gmail.com\",\"fullname\":\"Minh Phong\",\"address\":\"cau giay ha noi\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 125, 53, '2023-03-02 08:05:21', NULL, 'complete', NULL, 0, '1', 125, NULL),
(176, 'RPA128508', 0, '{\"phone\":\"0912345678\",\"email\":\"app1@gmail.com\",\"fullname\":\"H1\",\"address\":\"H\\u00e0 N\\u1ed9i\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 137, 125, '2023-03-02 08:38:52', NULL, 'pending', NULL, 0, '1', 137, NULL),
(177, 'RPA687348', 0, '{\"phone\":\"0912345678\",\"email\":\"app1@gmail.com\",\"fullname\":\"H1\",\"address\":\"HN\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"9bd579e259f753bc3df88fdbcbf353be\":{\"rowId\":\"9bd579e259f753bc3df88fdbcbf353be\",\"id\":\"2\",\"name\":\"Combo 2\",\"qty\":\"1\",\"price\":10000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/BVm9Zet1oj.jpg\",\"type\":\"combo\",\"slug\":\"combo-2\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"10000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/BVm9Zet1oj.jpg\",\"type\":\"combo\"}}', NULL, 10000000, 10000000, NULL, 137, 125, '2023-03-02 08:39:26', NULL, 'pending', NULL, 0, '1', 137, NULL),
(178, 'RPA378224', 0, '{\"phone\":\"2491242198\",\"email\":\"ds20@gmail.com\",\"fullname\":\"DS20\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 142, 121, '2023-03-03 03:55:11', NULL, 'complete', NULL, 0, '0', 142, NULL),
(179, 'RPA477554', 0, '{\"phone\":\"23124323242\",\"email\":\"ds21@gmail.com\",\"fullname\":\"ds21\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 143, 121, '2023-03-03 03:56:12', NULL, 'complete', NULL, 0, '0', 143, NULL),
(180, 'RPA772266', 0, '{\"phone\":\"1232434644\",\"email\":\"ds23@gmail.com\",\"fullname\":\"ds23\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 145, 121, '2023-03-03 03:58:08', NULL, 'complete', NULL, 0, '0', 145, NULL),
(181, 'RPA561139', 0, '{\"phone\":\"3213123233\",\"email\":\"ds22@gmail.com\",\"fullname\":\"ds22\",\"address\":\"81\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 144, 121, '2023-03-03 03:58:46', NULL, 'complete', NULL, 0, '0', 144, NULL),
(182, 'RPA511418', 0, '{\"phone\":\"132434324324\",\"email\":\"ds24@gmail.com\",\"fullname\":\"ds24\",\"address\":\"32\"}', NULL, NULL, '{\"method_title\":\"Chuy\\u1ec3n kho\\u1ea3n ng\\u00e2n h\\u00e0ng\",\"method_id\":\"bank-transfer\",\"status\":\"0\"}', '{\"3379fad1426e325c4a29c712aad25369\":{\"rowId\":\"3379fad1426e325c4a29c712aad25369\",\"id\":\"1\",\"name\":\"\\u0110\\u1ed9t Ph\\u00e1 \\u0110\\u1ec3 D\\u1eabn \\u0110\\u1ea7u\",\"qty\":\"1\",\"price\":5000000,\"options\":{\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\",\"slug\":\"dot-pha-de-dan-dau\"},\"tax\":\"0.00\",\"isSaved\":false,\"subtotal\":\"5000000.00\",\"commision\":0,\"quantity\":\"1\",\"thumbnail\":\"https:\\/\\/rpagroup.vn\\/public\\/uploads\\/images\\/ouQq2R4GQ3.jpg\",\"type\":\"combo\"}}', NULL, 5000000, 5000000, NULL, 146, 121, '2023-03-03 04:01:28', NULL, 'complete', NULL, 0, '0', 146, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_course_user`
--

CREATE TABLE `order_course_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_course_user`
--

INSERT INTO `order_course_user` (`id`, `course_id`, `user_id`, `order_id`, `status`, `created_at`, `updated_at`) VALUES
(443, 5, 41, 130, NULL, NULL, NULL),
(444, 10, 41, 130, NULL, NULL, NULL),
(445, 7, 41, 130, NULL, NULL, NULL),
(446, 9, 41, 130, NULL, NULL, NULL),
(447, 6, 41, 130, NULL, NULL, NULL),
(453, 5, 113, 132, NULL, NULL, NULL),
(454, 10, 113, 132, NULL, NULL, NULL),
(455, 7, 113, 132, NULL, NULL, NULL),
(456, 9, 113, 132, NULL, NULL, NULL),
(457, 6, 113, 132, NULL, NULL, NULL),
(458, 5, 114, 133, NULL, NULL, NULL),
(459, 10, 114, 133, NULL, NULL, NULL),
(460, 7, 114, 133, NULL, NULL, NULL),
(461, 9, 114, 133, NULL, NULL, NULL),
(462, 6, 114, 133, NULL, NULL, NULL),
(473, 5, 114, 135, NULL, NULL, NULL),
(474, 10, 114, 135, NULL, NULL, NULL),
(475, 7, 114, 135, NULL, NULL, NULL),
(476, 9, 114, 135, NULL, NULL, NULL),
(477, 6, 114, 135, NULL, NULL, NULL),
(478, 5, 115, 136, NULL, NULL, NULL),
(479, 10, 115, 136, NULL, NULL, NULL),
(480, 7, 115, 136, NULL, NULL, NULL),
(481, 9, 115, 136, NULL, NULL, NULL),
(482, 6, 115, 136, NULL, NULL, NULL),
(483, 5, 116, 137, NULL, NULL, NULL),
(484, 10, 116, 137, NULL, NULL, NULL),
(485, 7, 116, 137, NULL, NULL, NULL),
(486, 9, 116, 137, NULL, NULL, NULL),
(487, 6, 116, 137, NULL, NULL, NULL),
(538, 5, 119, 140, NULL, NULL, NULL),
(539, 10, 119, 140, NULL, NULL, NULL),
(540, 7, 119, 140, NULL, NULL, NULL),
(541, 9, 119, 140, NULL, NULL, NULL),
(542, 6, 119, 140, NULL, NULL, NULL),
(543, 5, 119, 141, NULL, NULL, NULL),
(544, 10, 119, 141, NULL, NULL, NULL),
(545, 7, 119, 141, NULL, NULL, NULL),
(546, 9, 119, 141, NULL, NULL, NULL),
(547, 6, 119, 141, NULL, NULL, NULL),
(548, 5, 120, 142, NULL, NULL, NULL),
(549, 10, 120, 142, NULL, NULL, NULL),
(550, 7, 120, 142, NULL, NULL, NULL),
(551, 9, 120, 142, NULL, NULL, NULL),
(552, 6, 120, 142, NULL, NULL, NULL),
(553, 5, 120, 143, NULL, NULL, NULL),
(554, 10, 120, 143, NULL, NULL, NULL),
(555, 7, 120, 143, NULL, NULL, NULL),
(556, 9, 120, 143, NULL, NULL, NULL),
(557, 6, 120, 143, NULL, NULL, NULL),
(558, 5, 114, 144, NULL, NULL, NULL),
(559, 10, 114, 144, NULL, NULL, NULL),
(560, 7, 114, 144, NULL, NULL, NULL),
(561, 9, 114, 144, NULL, NULL, NULL),
(562, 6, 114, 144, NULL, NULL, NULL),
(563, 5, 41, 145, NULL, NULL, NULL),
(564, 10, 41, 145, NULL, NULL, NULL),
(565, 7, 41, 145, NULL, NULL, NULL),
(566, 9, 41, 145, NULL, NULL, NULL),
(567, 6, 41, 145, NULL, NULL, NULL),
(568, 5, 120, 146, NULL, NULL, NULL),
(569, 10, 120, 146, NULL, NULL, NULL),
(570, 7, 120, 146, NULL, NULL, NULL),
(571, 9, 120, 146, NULL, NULL, NULL),
(572, 6, 120, 146, NULL, NULL, NULL),
(573, 5, 121, 148, NULL, NULL, NULL),
(574, 10, 121, 148, NULL, NULL, NULL),
(575, 7, 121, 148, NULL, NULL, NULL),
(576, 9, 121, 148, NULL, NULL, NULL),
(577, 6, 121, 148, NULL, NULL, NULL),
(578, 5, 122, 149, NULL, NULL, NULL),
(579, 10, 122, 149, NULL, NULL, NULL),
(580, 7, 122, 149, NULL, NULL, NULL),
(581, 9, 122, 149, NULL, NULL, NULL),
(582, 6, 122, 149, NULL, NULL, NULL),
(583, 5, 123, 150, NULL, NULL, NULL),
(584, 10, 123, 150, NULL, NULL, NULL),
(585, 7, 123, 150, NULL, NULL, NULL),
(586, 9, 123, 150, NULL, NULL, NULL),
(587, 6, 123, 150, NULL, NULL, NULL),
(588, 5, 126, 151, NULL, NULL, NULL),
(589, 10, 126, 151, NULL, NULL, NULL),
(590, 7, 126, 151, NULL, NULL, NULL),
(591, 9, 126, 151, NULL, NULL, NULL),
(592, 6, 126, 151, NULL, NULL, NULL),
(593, 5, 127, 152, NULL, NULL, NULL),
(594, 10, 127, 152, NULL, NULL, NULL),
(595, 7, 127, 152, NULL, NULL, NULL),
(596, 9, 127, 152, NULL, NULL, NULL),
(597, 6, 127, 152, NULL, NULL, NULL),
(598, 5, 128, 153, NULL, NULL, NULL),
(599, 10, 128, 153, NULL, NULL, NULL),
(600, 7, 128, 153, NULL, NULL, NULL),
(601, 9, 128, 153, NULL, NULL, NULL),
(602, 6, 128, 153, NULL, NULL, NULL),
(603, 5, 129, 154, NULL, NULL, NULL),
(604, 10, 129, 154, NULL, NULL, NULL),
(605, 7, 129, 154, NULL, NULL, NULL),
(606, 9, 129, 154, NULL, NULL, NULL),
(607, 6, 129, 154, NULL, NULL, NULL),
(608, 5, 130, 155, NULL, NULL, NULL),
(609, 10, 130, 155, NULL, NULL, NULL),
(610, 7, 130, 155, NULL, NULL, NULL),
(611, 9, 130, 155, NULL, NULL, NULL),
(612, 6, 130, 155, NULL, NULL, NULL),
(668, 5, 131, 167, NULL, NULL, NULL),
(669, 10, 131, 167, NULL, NULL, NULL),
(670, 7, 131, 167, NULL, NULL, NULL),
(671, 9, 131, 167, NULL, NULL, NULL),
(672, 6, 131, 167, NULL, NULL, NULL),
(678, 5, 132, 169, NULL, NULL, NULL),
(679, 10, 132, 169, NULL, NULL, NULL),
(680, 7, 132, 169, NULL, NULL, NULL),
(681, 9, 132, 169, NULL, NULL, NULL),
(682, 6, 132, 169, NULL, NULL, NULL),
(683, 5, 133, 170, NULL, NULL, NULL),
(684, 10, 133, 170, NULL, NULL, NULL),
(685, 7, 133, 170, NULL, NULL, NULL),
(686, 9, 133, 170, NULL, NULL, NULL),
(687, 6, 133, 170, NULL, NULL, NULL),
(688, 5, 134, 171, NULL, NULL, NULL),
(689, 10, 134, 171, NULL, NULL, NULL),
(690, 7, 134, 171, NULL, NULL, NULL),
(691, 9, 134, 171, NULL, NULL, NULL),
(692, 6, 134, 171, NULL, NULL, NULL),
(693, 5, 135, 172, NULL, NULL, NULL),
(694, 10, 135, 172, NULL, NULL, NULL),
(695, 7, 135, 172, NULL, NULL, NULL),
(696, 9, 135, 172, NULL, NULL, NULL),
(697, 6, 135, 172, NULL, NULL, NULL),
(698, 5, 136, 173, NULL, NULL, NULL),
(699, 10, 136, 173, NULL, NULL, NULL),
(700, 7, 136, 173, NULL, NULL, NULL),
(701, 9, 136, 173, NULL, NULL, NULL),
(702, 6, 136, 173, NULL, NULL, NULL),
(703, 5, 125, 175, NULL, NULL, NULL),
(704, 10, 125, 175, NULL, NULL, NULL),
(705, 7, 125, 175, NULL, NULL, NULL),
(706, 9, 125, 175, NULL, NULL, NULL),
(707, 6, 125, 175, NULL, NULL, NULL),
(708, 8, 125, 174, NULL, NULL, NULL),
(709, 5, 142, 178, NULL, NULL, NULL),
(710, 10, 142, 178, NULL, NULL, NULL),
(711, 7, 142, 178, NULL, NULL, NULL),
(712, 9, 142, 178, NULL, NULL, NULL),
(713, 6, 142, 178, NULL, NULL, NULL),
(714, 5, 143, 179, NULL, NULL, NULL),
(715, 10, 143, 179, NULL, NULL, NULL),
(716, 7, 143, 179, NULL, NULL, NULL),
(717, 9, 143, 179, NULL, NULL, NULL),
(718, 6, 143, 179, NULL, NULL, NULL),
(719, 5, 145, 180, NULL, NULL, NULL),
(720, 10, 145, 180, NULL, NULL, NULL),
(721, 7, 145, 180, NULL, NULL, NULL),
(722, 9, 145, 180, NULL, NULL, NULL),
(723, 6, 145, 180, NULL, NULL, NULL),
(724, 5, 144, 181, NULL, NULL, NULL),
(725, 10, 144, 181, NULL, NULL, NULL),
(726, 7, 144, 181, NULL, NULL, NULL),
(727, 9, 144, 181, NULL, NULL, NULL),
(728, 6, 144, 181, NULL, NULL, NULL),
(729, 5, 146, 182, NULL, NULL, NULL),
(730, 10, 146, 182, NULL, NULL, NULL),
(731, 7, 146, 182, NULL, NULL, NULL),
(732, 9, 146, 182, NULL, NULL, NULL),
(733, 6, 146, 182, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_history`
--

CREATE TABLE `payment_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `total_commission` int(11) DEFAULT NULL,
  `total_point` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `title`, `slug`, `thumbnail`, `description`, `content`, `created_at`, `updated_at`) VALUES
(6, 'Chính sách bảo mật thông tin', 'chinh-sach-bao-mat-thong-tin', NULL, NULL, '<h2 style=\"text-align: center;\">CHÍNH SÁCH BẢO VỆ THÔNG TIN CÁ NHÂN KHÁCH HÀNG</h2>\r\n\r\n<p><u><strong>Mục đích và phạm vi thu thập thông tin</strong></u></p>\r\n\r\n<p>Việc thu thập dữ liệu trên website Rpagroup.vn bao gồm: email, điện thoại, tên đăng nhập, mật khẩu đăng nhập. Đây là các thông tin mà Rpagroup.vn cần thành viên cung cấp bắt buộc khi đăng ký sử dụng dịch vụ và để Rpagroup.vn liên hệ xác nhận khi khách hàng đăng ký sử dụng dịch vụ trên website nhằm đảm bảo quyền lợi cho cho người tiêu dùng.</p>\r\n\r\n<p>Các thành viên sẽ tự chịu trách nhiệm về bảo mật và lưu giữ mọi hoạt động sử dụng dịch vụ dưới tên đăng ký, mật khẩu và hộp thư điện tử của mình. Ngoài ra, thành viên có trách nhiệm thông báo kịp thời cho Rpagroup.vn về những hành vi sử dụng trái phép, lạm dụng, vi phạm bảo mật, lưu giữ tên đăng ký và mật khẩu của bên thứ ba để có biện pháp giải quyết phù hợp.</p>\r\n\r\n<p><u><strong>Phạm vi sử dụng thông tin</strong></u></p>\r\n\r\n<ul>\r\n	<li>Website Rpagroup.vn sử dụng thông tin thành viên cung cấp để:</li>\r\n	<li>Cung cấp các dịch vụ đến Thành viên;</li>\r\n	<li>Gửi các thông báo về các hoạt động trao đổi thông tin giữa thành viên và Rpagroup.vn;</li>\r\n	<li>Ngăn ngừa các hoạt động phá hủy tài khoản người dùng của thành viên hoặc các hoạt động giả mạo Thành viên;</li>\r\n	<li>Liên lạc và giải quyết với thành viên trong những trường hợp đặc biệt.</li>\r\n	<li>Không sử dụng thông tin cá nhân của thành viên ngoài mục đích xác nhận và liên hệ có liên quan đến giao dịch tại Rpagroup.vn.</li>\r\n	<li>Trong trường hợp có yêu cầu của pháp luật: Rpagroup.vn có trách nhiệm hợp tác cung cấp thông tin cá nhân thành viên khi có yêu cầu từ cơ quan tư pháp bao gồm: Viện kiểm sát, tòa án, cơ quan công an điều tra liên quan đến hành vi vi phạm pháp luật nào đó của khách hàng. Ngoài ra, không ai có quyền xâm phạm vào thông tin cá nhân của thành viên.</li>\r\n</ul>\r\n\r\n<p><u><strong>Những người hoặc tổ chức có thể được tiếp cận với thông tin đó:</strong></u></p>\r\n\r\n<ul>\r\n	<li>Đối tượng được tiếp cận với thông tin cá nhân của khách hàng/ thành viên thuộc một trong những trường hợp sau:</li>\r\n	<li><u><strong>Công ty TNHH Tư vấn và đào tạo RPA</strong></u></li>\r\n	<li>Các đối tác có ký hợp động thực hiện 1 phần dịch vụ do <strong>Công ty TNHH Tư vấn và đào tạo RPA</strong> cung cấp. Các đối tác này sẽ nhận được những thông tin theo thỏa thuận hợp đồng (có thể 1 phần hoặc toàn bộ thông tin tùy theo điều khoản hợp đồng) để tiến hành hỗ trợ người dùng sử dụng dịch vụ.</li>\r\n	<li>Cơ quan nhà nước khi có yêu cầu <strong>Công ty TNHH Tư vấn và đào tạo RPA </strong>cung cấp thông tin người dùng để phục vụ quá trình điều tra.</li>\r\n</ul>\r\n\r\n<p><u><strong>Thời gian lưu trữ thông tin</strong></u></p>\r\n\r\n<p>Dữ liệu cá nhân của Thành viên sẽ được lưu trữ cho đến khi có yêu cầu hủy bỏ hoặc tự thành viên đăng nhập và thực hiện hủy bỏ. Còn lại trong mọi trường hợp thông tin cá nhân thành viên sẽ được bảo mật trên máy chủ của Rpagroup.vn.</p>\r\n\r\n<p><u><strong>Địa chỉ của đơn vị thu thập và quản lý thông tin cá nhân Công ty TNHH Tư vấn và đào tạo RPA</strong></u></p>\r\n\r\n<p>+ Trụ sở chính: Sàn kinh doanh ô số 321, Tầng 3 Chung cư Học viện Quốc Phòng, Phường Xuân La, Quận Tây Hồ, Thành phố Hà Nội, Việt Nam.</p>\r\n\r\n<p><u><strong>Phương tiện và công cụ để người dùng tiếp cận và chỉnh sửa dữ liệu cá nhân của mình.</strong></u></p>\r\n\r\n<ul>\r\n	<li>Thành viên có quyền tự kiểm tra, cập nhật, điều chỉnh hoặc hủy bỏ thông tin cá nhân của mình bằng cách đăng nhập vào tài khoản và chỉnh sửa thông tin cá nhân hoặc yêu cầu ban quản trị website Rpagroup.vn thực hiện việc này.</li>\r\n	<li>Thành viên có quyền gửi khiếu nại về việc lộ thông tin cá nhân cho bên thứ 3 đến Ban quản trị của website Rpagroup.vn. Khi tiếp nhận những phản hồi này, Rpagroup.vn sẽ xác nhận lại thông tin, phải có trách nhiệm trả lời lý do và hướng dẫn thành viên khôi phục và bảo mật lại thông tin.</li>\r\n</ul>\r\n\r\n<p><u><strong>Cam kết bảo mật thông tin cá nhân khách hàng</strong></u></p>\r\n\r\n<p>- Thông tin cá nhân của thành viên trên website Rpagroup.vn được Rpagroup.vn cam kết bảo mật tuyệt đối theo chính sách bảo vệ thông tin cá nhân của Rpagroup.vn. Việc thu thập và sử dụng thông tin của mỗi thành viên chỉ được thực hiện khi có sự đồng ý của khách hàng đó trừ những trường hợp pháp luật có quy định khác.</p>\r\n\r\n<ul>\r\n	<li>Không sử dụng, không chuyển giao, cung cấp hay tiết lộ cho bên thứ 3 nào về thông tin cá nhân của thành viên khi không có sự cho phép đồng ý từ thành viên.</li>\r\n	<li>Trong trường hợp máy chủ lưu trữ thông tin bị hacker tấn công dẫn đến mất mát dữ liệu cá nhân thành viên, website Rpagroup.vn sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng điều tra xử lý kịp thời và thông báo cho thành viên được biết.</li>\r\n	<li>Bảo mật tuyệt đối mọi thông tin giao dịch trực tuyến của Thành viên bao gồm thông tin hóa đơn kế toán chứng từ số hóa tại khu vực dữ liệu trung tâm an toàn cấp 1 của Rpagroup.vn.</li>\r\n	<li>Ban quản lý website Rpagroup.vn yêu cầu các cá nhân khi đăng ký/mua hàng là thành viên, phải cung cấp đầy đủ thông tin cá nhân có liên quan như: Họ và tên, địa chỉ liên lạc, email, số chứng minh nhân dân, điện thoại, số tài khoản, số thẻ thanh toán …., và chịu trách nhiệm về tính pháp lý của những thông tin trên. Ban quản lý website Rpagroup.vn không chịu trách nhiệm cũng như không giải quyết mọi khiếu nại có liên quan đến quyền lợi của Thành viên đó nếu xét thấy tất cả thông tin cá nhân của thành viên đó cung cấp khi đăng ký ban đầu là không chính xác.</li>\r\n</ul>', '2023-02-13 19:09:10', NULL),
(7, 'Chính sách đổi trả hàng và hoàn tiền', 'chinh-sach-doi-tra-hang-va-hoan-tien', NULL, NULL, '<h2 style=\"text-align: center;\">CHÍNH SÁCH ĐỔI TRẢ HÀNG</h2>\r\n\r\n<p>Khi mua hàng tại <strong>Rpagroup.vn</strong>, trong thời gian 12h kể từ khi nhận hàng, bạn được chấp nhận đổi lại sản phẩm hoặc đổi lấy sản phẩm giá trị cao hơn (trả thêm phần tiền chênh lệch). Tuy nhiên, trước khi tiến hành đổi, bạn cần lưu ý những yêu cầu cụ thể sau:</p>\r\n\r\n<ul>\r\n	<li>Điều kiện đổi hàng.</li>\r\n	<li>Cách thức đổi hàng</li>\r\n	<li>Các chi phí liên quan đến việc đổi hàng.</li>\r\n	<li>Thời gian đổi hàng.</li>\r\n</ul>\r\n\r\n<p><strong>Bước 1: Kiểm tra điều kiện đổi hàng</strong></p>\r\n\r\n<p>Sản phẩm đủ điều kiện đổi trả là sản phẩm thỏa mãn các điều kiện sau và không thuộc danh sách sản phẩm không được đổi trả</p>\r\n\r\n<p><strong>Điều kiện:</strong></p>\r\n\r\n<ul>\r\n	<li>Sản phẩm đổi trả trong vòng 12h kể từ ngày thanh toán gói dịch vụ.</li>\r\n	<li>Quà khuyến mãi có giá trị (nếu có).</li>\r\n	<li>Sản phẩm không bị chia sẻ hay sử dụng chung với người dùng khác.</li>\r\n	<li>Sản phẩm chưa qua sử dụng.</li>\r\n	<li>Sản phẩm bị sai nội dung so với phần thuyết minh về sản phẩm.</li>\r\n	<li>Sản phẩm lỗi kỹ thuật do quá trình tải dữ liệu lên website của RPA.</li>\r\n	<li>Hàng đổi lại phải có giá trị lớn hơn hoặc bằng sản phẩm cần đổi. Trong trường hợp lỗi phát sinh là từ phía công ty, <strong>Rpagroup.vn</strong> sẽ tiến hành đổi trả miễn phí.</li>\r\n	<li>Mỗi sản phẩm chỉ có thể đổi trả hàng 1 lần.</li>\r\n</ul>\r\n\r\n<p><strong>Bước 2: Hình thức đổi hàng</strong></p>\r\n\r\n<ul>\r\n	<li>Để tiến hành đổi sản phẩm, bạn vui lòng thực hiện 2 bước đơn giản sau:</li>\r\n	<li>Liên hệ với <strong>Rpagroup.vn</strong> qua Hotline <strong>0917304188 </strong>hoặc qua trực tiếp trụ sở của <strong>Rpagroup.vn</strong> để kiểm tra điều kiện sản phẩm và điều kiện đổi để đảm bảo sản phẩm đáp ứng các điều kiện này.</li>\r\n	<li>Lựa chọn hình thức đổi hàng: Liên hệ Hotline <strong>0917304188 </strong>hoặc đến trực tiếp trụ sở công ty</li>\r\n	<li>Nếu sản phẩm đổi thỏa các điều kiện đổi hàng, trong thời gian 01 ngày, chúng tôi sẽ gửi cho bạn qua email hoặc liên lạc đến số điện thoại bạn đã cung cấp .</li>\r\n</ul>\r\n\r\n<p><strong>Bước 3: Các chi phí liên quan đến việc đổi hàng: </strong>Miễn phí</p>\r\n\r\n<p><strong>A. CHÍNH SÁCH HOÀN TIỀN:</strong></p>\r\n\r\n<p>Thời hạn hoàn trả tiền: Chậm nhất 24 giờ tính từ thời điểm phản hồi lại cho khách hàng.</p>\r\n\r\n<p>Hình thức đổi trả, hoàn trả: Gói sản phẩm mới cùng loại, nếu không còn sản phẩm thì bằng tiền mặt.</p>\r\n\r\n<p>Chi phí hoàn trả, đổi trả: Khách hàng sẽ không phải chịu bất kỳ chi phí nào.</p>', '2023-02-13 19:26:07', NULL),
(8, 'Chính sách kiểm hàng', 'chinh-sach-kiem-hang', NULL, NULL, '<h2 style=\"text-align: center;\">CHÍNH SÁCH KIỂM HÀNG</h2>\r\n\r\n<p>Do Rpagroup.vn không cung cấp các sản phẩm, hàng hoá hữu hình mà chúng tôi cung cấp các gói đào tạo trực tuyến vì vậy sau khi thanh toán gói sản phẩm trong trường hợp quý khách hàng cần khiếu nại, góp ý vui lòng liên hệ:</p>\r\n\r\n<p><strong>Công ty TNHH Tư vấn và đào tạo RPA&nbsp;</strong></p>\r\n\r\n<p>Địa chỉ: Sàn kinh doanh ô số 321, Tầng 3 Chung cư Học viện Quốc Phòng, Phường Xuân La, Quận Tây Hồ, Thành phố Hà Nội, Việt Nam.</p>\r\n\r\n<p>Điện thoại: 0917304188</p>\r\n\r\n<p>Email: support@rpagroup.vn<br />\r\n&nbsp;</p>', '2023-02-13 19:28:09', NULL),
(9, 'Hình thức thanh toán', 'hinh-thuc-thanh-toan', NULL, NULL, '<h2 style=\"text-align: center;\">CÁCH THỨC THANH TOÁN</h2>\r\n\r\n<p><strong>Khóa học sẽ được kích hoạt sau khi RPA kiểm tra tài khoản và xác nhận việc thanh toán của bạn thành công. (Thời gian kiểm tra và xác nhận tài khoản ít nhất là 12 giờ)</strong></p>\r\n\r\n<p><strong>* Chuyển khoản ngân hàng</strong></p>\r\n\r\n<p>Bạn có thể đến bất kỳ ngân hàng nào ở Việt Nam (hoặc sử dụng Internet Banking) để chuyển tiền theo thông tin bên dưới:</p>\r\n\r\n<ul>\r\n	<li><strong>Số tài khoản:</strong> 99999166166</li>\r\n	<li><strong>Chủ tài khoản:</strong> CÔNG TY TNHH TƯ VẤN VÀ ĐÀO TẠO RPA</li>\r\n	<li><strong>Ngân hàng:</strong> Ngân hàng Thương mại cổ phần Á châu (ACB) - PGD KIM ĐỒNG - Chi nhánh Hà Nội</li>\r\n</ul>\r\n\r\n<p><em><strong>Nội dung chuyển khoản:</strong></em></p>\r\n\r\n<ul>\r\n	<li>Tại mục \"Nội dung\" khi chuyển khoản, bạn ghi rõ: Số điện thoại + Họ và tên + Email đăng ký học (thay \"@\" thành \".\") + Mã đơn hàng</li>\r\n	<li>Ví dụ: SDT 0968686868 Nguyen Thi Huong Lan nguyenthihuonglan.gmail.com DH 2313123<br />\r\n	&nbsp;</li>\r\n</ul>', '2023-02-13 19:31:20', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `orgin` varchar(255) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `sale_price` int(11) DEFAULT NULL,
  `regular_price` int(11) DEFAULT NULL,
  `in_stock` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `is_published` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `percent` int(11) DEFAULT NULL,
  `product_group_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_group`
--

CREATE TABLE `product_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_show` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_meta`
--

CREATE TABLE `product_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `gallery` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `question`
--

CREATE TABLE `question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `meta_key`, `meta_value`) VALUES
(24, 'logo', 'https://rpagroup.vn/public/uploads/images/JstDpFm8gU.png'),
(25, 'icon', 'https://rpagroup.vn/public/uploads/images/JstDpFm8gU.png'),
(26, 'seo_default', '{\"meta_title\":\"Rpagroup.vn - H\\u1ecdc online c\\u00f9ng chuy\\u00ean gia\",\"meta_description\":\"Rpagroup h\\u1ecdc online v\\u1edbi h\\u01a1n 700 kh\\u00f3a h\\u1ecdc tr\\u1ef1c tuy\\u1ebfn thu\\u1ed9c nhi\\u1ec1u l\\u0129nh v\\u1ef1c nh\\u01b0 k\\u1ef9 n\\u0103ng qu\\u1ea3n tr\\u1ecb, ngo\\u1ea1i ng\\u1eef, t\\u00e0i ch\\u00ednh, b\\u1ea5t \\u0111\\u1ed9ng s\\u1ea3n, ti\\u1ebfp th\\u1ecb b\\u00e1n h\\u00e0ng\",\"meta_keyword\":\"Rpa, Rpagroup\",\"robots\":\"0\"}'),
(27, 'social', '{\"facebook\":\"https:\\/\\/www.facebook.com\\/DamthuchungRPA99\",\"youtube\":\"https:\\/\\/www.youtube.com\\/@rpagroupvn\"}'),
(28, 'other_social_icon', '[null]'),
(29, 'other_social_link', '[null]'),
(30, 'payment_method', '[\"paypal\",\"master_card\",\"visa\",\"jcb\",\"cash\",\"internet-banking\",\"installment\"]'),
(31, 'payment_icon', '{\"paypal\":null,\"master_card\":null,\"visa\":null,\"jcb\":null,\"cash\":null,\"internet-banking\":null,\"installment\":null}'),
(32, 'other_payment_icon', '[null]'),
(33, 'datetime_format', 'd/m/Y'),
(34, 'website_name', 'Rpagroup.vn - Học online cùng chuyên gia'),
(35, 'email', 'support@rpagroup.vn'),
(36, 'phone', '0917304188'),
(37, 'address', '<p>Công ty TNHH Tư Vấn và Đào tạo RPA - GCNĐKDN số 0108300471 do Sở Kế hoạch và Đầu tư thành phố Hà Nội cấp lần đầu ngày 30/05/2018. Hotline: <strong>0917.304.188</strong></p>'),
(38, 'send_customer_contact_to_admin_email', '1'),
(39, 'contact_captcha', '0'),
(40, 'contact_required_email', '0'),
(41, 'contact_required_phone', '1'),
(42, 'contact_thankyou_link', NULL),
(43, 'maps', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3686.244368572698!2d103.9651236!3d22.4950129!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x36cd139cb873ae31%3A0x33def7866a7c16f1!2zMzYgxJDhurduZyBUcuG6p24gQ8O0biwgQ-G7kWMgTOG6v3UsIFRYLkzDoG8gQ2FpLCBMw6BvIENhaQ!5e0!3m2!1svi!2s!4v1663940152285!5m2!1svi!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(44, 'payment_info', '<p>Bạn có thể đến bất kỳ ngân hàng nào ở Việt Nam (hoặc sử dụng Internet Banking) để chuyển tiền theo thông tin bên dưới:</p>\r\n\r\n<ul>\r\n	<li><strong>Số tài khoản</strong>:<b>&nbsp;</b>99999166166</li>\r\n	<li><strong>Chủ tài khoản</strong>: CÔNG TY TNHH TƯ VẤN VÀ ĐÀO TẠO RPA</li>\r\n	<li><strong>Ngân hàng</strong>:&nbsp;Ngân hàng Thương mại cổ phần Á châu (ACB) - PGD KIM ĐỒNG - Chi nhánh Hà Nội</li>\r\n</ul>\r\n\r\n<p><strong><i>Nội dung chuyển khoản:</i></strong></p>\r\n\r\n<ul>\r\n	<li>Tại mục \"Nội dung\" khi chuyển khoản, bạn ghi rõ: Số điện thoại +&nbsp;Họ và tên + Email đăng ký học (thay \"@\" thành \".\") +&nbsp;Mã đơn hàng</li>\r\n	<li>Ví dụ: SDT 0968686868&nbsp;Nguyen Thi Huong Lan&nbsp;nguyenthihuonglan.gmail.com DH&nbsp;2313123</li>\r\n</ul>'),
(45, 'office', '<p>Văn phòng giao dịch: số 81, Lê Đức Thọ, Phường Mỹ Đình II, Quận Nam Từ Liêm, TP Hà Nội</p>\r\n\r\n<p>MST: 0108300471&nbsp;</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taxonomy`
--

CREATE TABLE `taxonomy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `taxonomy` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `h1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taxonomy`
--

INSERT INTO `taxonomy` (`id`, `name`, `taxonomy`, `description`, `_lft`, `_rgt`, `parent_id`, `created_at`, `updated_at`, `thumbnail`, `sort_order`, `slug`, `meta_keyword`, `h1`) VALUES
(3, 'Sale - CSKH', 'course_cat', NULL, 1, 8, NULL, '2023-01-12 02:26:40', NULL, NULL, NULL, 'sale-cskh', 'Sale - CSKH', 'Sale - CSKH'),
(4, 'Bán hàng', 'course_cat', NULL, 2, 3, 3, '2023-01-12 02:26:51', NULL, NULL, NULL, 'ban-hang', 'Bán hàng', 'Bán hàng'),
(5, 'Chăm sóc khách hàng', 'course_cat', NULL, 4, 5, 3, '2023-01-12 02:27:03', NULL, NULL, NULL, 'cham-soc-khach-hang', 'Chăm sóc khách hàng', 'Chăm sóc khách hàng'),
(6, 'Telesale', 'course_cat', NULL, 6, 7, 3, '2023-01-12 02:27:15', NULL, NULL, NULL, 'telesale', 'Telesale', 'Telesale'),
(7, 'Kỹ năng công việc', 'course_cat', NULL, 9, 14, NULL, '2023-01-12 02:27:25', NULL, NULL, NULL, 'ky-nang-cong-viec', 'Kỹ năng công việc', 'Kỹ năng công việc'),
(8, 'Thuyết trình', 'course_cat', NULL, 10, 11, 7, '2023-01-12 02:27:37', NULL, NULL, NULL, 'thuyet-trinh', 'Thuyết trình', 'Thuyết trình'),
(9, 'Nâng cao hiệu suất', 'course_cat', NULL, 12, 13, 7, '2023-01-12 02:27:51', NULL, NULL, NULL, 'nang-cao-hieu-suat', 'Nâng cao hiệu suất', 'Nâng cao hiệu suất'),
(10, 'Kỹ năng con người', 'course_cat', NULL, 15, 16, NULL, '2023-01-12 02:28:08', NULL, NULL, NULL, 'ky-nang-con-nguoi', 'Kỹ năng con người', 'Kỹ năng con người'),
(11, 'Kỹ năng quản trị', 'course_cat', NULL, 17, 18, NULL, '2023-01-12 02:28:18', NULL, NULL, NULL, 'ky-nang-quan-tri', 'Kỹ năng quản trị', 'Kỹ năng quản trị'),
(12, 'Ngoại ngữ', 'course_cat', NULL, 19, 20, NULL, '2023-01-12 02:28:28', NULL, NULL, NULL, 'ngoai-ngu', 'Ngoại ngữ', 'Ngoại ngữ'),
(13, 'Thiết kế đồ họa', 'course_cat', NULL, 21, 22, NULL, '2023-01-12 02:28:41', NULL, NULL, NULL, 'thiet-ke-do-hoa', 'Thiết kế đồ họa', 'Thiết kế đồ họa'),
(14, 'Ứng dụng phần mềm', 'course_cat', NULL, 23, 24, NULL, '2023-01-12 02:28:50', NULL, NULL, NULL, 'ung-dung-phan-mem', 'Ứng dụng phần mềm', 'Ứng dụng phần mềm'),
(15, 'Marketing và truyền thông', 'course_cat', NULL, 25, 26, NULL, '2023-01-12 02:29:03', NULL, NULL, NULL, 'marketing-va-truyen-thong', 'Marketing và truyền thông', 'Marketing và truyền thông'),
(16, 'IT và lập trình', 'course_cat', NULL, 27, 28, NULL, '2023-01-12 02:29:17', NULL, NULL, NULL, 'it-va-lap-trinh', 'IT và lập trình', 'IT và lập trình'),
(17, 'Hành chính nhân sự', 'course_cat', NULL, 29, 30, NULL, '2023-01-12 02:29:34', NULL, NULL, NULL, 'hanh-chinh-nhan-su', 'Hành chính nhân sự', 'Hành chính nhân sự');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taxonomy_relationship`
--

CREATE TABLE `taxonomy_relationship` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `taxonomy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `taxonomy_type` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taxonomy_relationship`
--

INSERT INTO `taxonomy_relationship` (`id`, `product_id`, `taxonomy_id`, `sort_order`, `created_at`, `updated_at`, `taxonomy_type`, `course_id`) VALUES
(4, NULL, 3, NULL, NULL, NULL, 'main', 5),
(5, NULL, 3, NULL, NULL, NULL, 'main', 6),
(6, NULL, 3, NULL, NULL, NULL, 'main', 7),
(7, NULL, 3, NULL, NULL, NULL, 'main', 8),
(8, NULL, 3, NULL, NULL, NULL, 'main', 9),
(9, NULL, 3, NULL, NULL, NULL, 'main', 10),
(10, NULL, 3, NULL, NULL, NULL, 'main', 11),
(12, NULL, 3, NULL, NULL, NULL, 'main', 13);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher`
--

CREATE TABLE `teacher` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher`
--

INSERT INTO `teacher` (`id`, `title`, `position`, `thumbnail`, `description`, `content`, `created_at`, `updated_at`, `slug`) VALUES
(2, 'Lê Trọng Nghĩa', 'Giam Doc', 'http://localhost/rpa/public/uploads/images/hNkTAhA92h.jpg', NULL, '<p>Vị trí</p>\r\n\r\n<p>CEO - 1LINE</p>\r\n\r\n<p>Planning Manager - Hung Thinh Agency</p>\r\n\r\n<p>Account Executive - Ureka Media</p>', '2023-01-12 03:00:46', NULL, NULL),
(3, 'Đàm Thu Chung', 'NLP Trainer - Master Coach', 'https://rpagroup.vn/public/uploads/images/CNoMDQqdhr.jpg', NULL, '<h2>Đàm Thu Chung – Người Truyền Cảm Hứng Cho Những Điều Tốt Đẹp</h2>\r\n\r\n<p>Được xem là người truyền cảm hứng, động lực để tư duy và hành động, nữ doanh nhân Đàm Thu Chung có nhiều lợi thế để trở thành “sứ giả yêu thương”. Đó có thể là tài năng, tâm sáng của một người nhiều năm công tác trong ngành giáo dục, đó còn là vẻ đẹp cả về nội tâm lẫn ngoại hình cực kỳ sắc sảo, quý phái của chị.</p>\r\n\r\n<p>Từ nhỏ, Đàm Thu Chung đặc biệt yêu thích hát, múa, nghệ thuật và thích thể hiện bản thân là người cá tính, khá năng động và yêu đời. Tốt nghiệp cấp 3, chị thi đậu vào trường ĐH Sư phạm Thái nguyên và có hơn 4 năm giảng dạy tại Cao Bằng. Trong khoảng thời gian này, chị học cao học, lấy học vị thạc sĩ và chuyển công tác đến Sở GD&amp;ĐT Cao Bằng.</p>\r\n\r\n<p>Mẹ chị vốn là giáo viên toán học nên cũng ủng hộ chị theo nghề giáo và hoạt động trong ngành giáo dục. Đây chính là động lực để chị nhiều năm liền gắn bó với công tác giảng dạy.</p>\r\n\r\n<p>Tuy nhiên, một sự kiện nhỏ đã diễn ra và nó ảnh hưởng quyết định đến suy nghĩ và cuộc đời của chị sau này. Vô tình nhìn thấy video quay cảnh 2 đứa trẻ đánh nhau, xung quanh có nhiều đứa trẻ con khác nhưng chúng nó không làm gì cả, cầm điện thoại livetream. Chị suy nghĩ cảm tưởngdường như &nbsp;tất cả những gì mình giảng dạy bọn trẻ không tiếp thu, không dùng trong cuộc sống. Giá trị niềm tin của một bộ phận thanh thiếu niên không có. Chính vì vậy Đàm Thu Chung quyết tâm trở thành người truyền động lực.</p>\r\n\r\n<p>Vì thế, nhiều người gọi chị là &nbsp;“Sứ Giả yêu Thương” &nbsp;với mong muốn dùng tình yêu thương của mình để đóng góp nhiều điều tốt đẹp cho cuộc sống. Bởi lẽ một khi tình yêu thương được lan truyền thì cuộc sống mới thêm vạn phần ý nghĩa.</p>\r\n\r\n<p>Nghĩ là làm, chị quyết định xuống Hà Nội học các lớp tư duy, lớp kỹ năng mềm với những người thầy như Mr Why – Phạm Ngọc Anh, Mr Vas… 3 năm làm việc tại thủ đô, chị trở thành giảng viên, người truyền cảm hứng, đã đàotạo cho các doanh nghiệp về tư duy và kỹ năng bán hàng, kỹ năng thuyết trình đỉnh cao, tạo cách trẻ hơn, khỏe hơn đẹp hơn, sử dụng tư duy để hạnh phúc.</p>\r\n\r\n<p>Đầu năm 2018, chị thành lập doanh nghiệp và trở thành PGĐ Công ty TNHH Tư vấn và Đào tạo RPA. Dù mới thành lập nhưng RPA hoạt động độc lập, quyết đoán và đã thực hiện các chương trình: tạo động lực sách, đọc sách, yêu sách dành cho các em học sinh trường Phú Bình, Thái Nguyên; Tạo động lực về sách cho trẻ em ở ở các cơ sở tôn giáo…</p>\r\n\r\n<p><i></i></p>', '2023-02-08 02:17:41', NULL, 'dam-thu-chung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ticket`
--

CREATE TABLE `ticket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `_lft` int(10) UNSIGNED DEFAULT NULL,
  `_rgt` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(11) NOT NULL,
  `code` varchar(256) DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `type` varchar(256) DEFAULT NULL,
  `user_id` bigint(11) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category` varchar(256) DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `status` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `transaction`
--

INSERT INTO `transaction` (`id`, `code`, `total`, `type`, `user_id`, `order_id`, `category`, `note`, `status`, `created`) VALUES
(84, 'RPA945981', 1000000, 'in', 41, 132, NULL, NULL, 'active', '2023-02-28 19:03:03'),
(85, 'RPA891903', 1000000, 'in', 41, 133, NULL, NULL, 'active', '2023-02-28 19:06:00'),
(91, 'RPA768619', 1000000, 'in', 114, 135, NULL, NULL, 'active', '2023-02-28 19:21:48'),
(92, 'RPA768619', 1000000, 'in', 41, 135, NULL, NULL, 'active', '2023-02-28 19:21:48'),
(93, 'RPA727135', 1000000, 'in', 41, 136, NULL, NULL, 'active', '2023-02-28 19:24:48'),
(94, 'RPA303059', 1000000, 'in', 41, 137, NULL, NULL, 'active', '2023-02-28 19:27:23'),
(100, 'RPA941361', 50000000, 'in', 41, 140, NULL, NULL, 'active', '2023-02-28 20:06:53'),
(101, 'RPA968337', 1000000, 'in', 119, 141, NULL, NULL, 'active', '2023-02-28 20:11:32'),
(102, 'RPA968337', 1500000, 'in', 41, 141, NULL, NULL, 'active', '2023-02-28 20:11:32'),
(103, 'RPA230048', 1000000, 'in', 114, 142, NULL, NULL, 'active', '2023-02-28 20:51:14'),
(104, 'RPA230048', 750000, 'in', 41, 142, NULL, NULL, 'active', '2023-02-28 20:51:14'),
(105, 'RPA226212', 1000000, 'in', 120, 143, NULL, NULL, 'active', '2023-02-28 20:56:21'),
(106, 'RPA226212', 1000000, 'in', 114, 143, NULL, NULL, 'active', '2023-02-28 20:56:21'),
(107, 'RPA226212', 750000, 'in', 41, 143, NULL, NULL, 'active', '2023-02-28 20:56:21'),
(108, 'RPA808053', 1000000, 'in', 114, 144, NULL, NULL, 'active', '2023-02-28 20:58:03'),
(109, 'RPA808053', 1750000, 'in', 41, 144, NULL, NULL, 'active', '2023-02-28 20:58:03'),
(110, 'RPA302986', 250000000, 'in', 41, 145, NULL, NULL, 'active', '2023-02-28 22:09:56'),
(111, 'RPA820267', 1000000, 'in', 120, 146, NULL, NULL, 'active', '2023-02-28 22:13:53'),
(112, 'RPA820267', 1000000, 'in', 114, 146, NULL, NULL, 'active', '2023-02-28 22:13:53'),
(113, 'RPA820267', 750000, 'in', 41, 146, NULL, NULL, 'active', '2023-02-28 22:13:53'),
(114, 'RPA517687', 1000000, 'in', 121, 149, NULL, NULL, 'active', '2023-03-02 09:57:27'),
(115, 'RPA434137', 1000000, 'in', 122, 150, NULL, NULL, 'active', '2023-03-02 11:18:03'),
(116, 'RPA871130', 1000000, 'in', 121, 151, NULL, NULL, 'active', '2023-03-02 11:35:54'),
(117, 'RPA768635', 1000000, 'in', 121, 152, NULL, NULL, 'active', '2023-03-02 11:36:01'),
(118, 'RPA178242', 1000000, 'in', 121, 153, NULL, NULL, 'active', '2023-03-02 11:38:46'),
(119, 'RPA252724', 1000000, 'in', 121, 154, NULL, NULL, 'active', '2023-03-02 11:41:29'),
(120, 'RPA432287', 1000000, 'in', 121, 155, NULL, NULL, 'active', '2023-03-02 11:45:08'),
(129, 'RPA383307', 1000000, 'in', 121, 167, NULL, NULL, 'active', '2023-03-02 12:17:16'),
(132, 'RPA455408', 1000000, 'in', 122, 169, NULL, NULL, 'active', '2023-03-02 14:00:09'),
(133, 'RPA812117', 1000000, 'in', 122, 170, NULL, NULL, 'active', '2023-03-02 14:08:48'),
(134, 'RPA812117', 500000, 'in', 121, 170, NULL, NULL, 'active', '2023-03-02 14:08:48'),
(135, 'RPA589480', 1000000, 'in', 122, 171, NULL, NULL, 'active', '2023-03-02 14:08:55'),
(136, 'RPA589480', 500000, 'in', 121, 171, NULL, NULL, 'active', '2023-03-02 14:08:55'),
(137, 'RPA821933', 1000000, 'in', 122, 172, NULL, NULL, 'active', '2023-03-02 14:09:06'),
(138, 'RPA821933', 500000, 'in', 121, 172, NULL, NULL, 'active', '2023-03-02 14:09:06'),
(139, 'RPA761561', 1500000, 'in', 122, 173, NULL, NULL, 'active', '2023-03-02 14:32:22'),
(140, 'RPA761561', 500000, 'in', 121, 173, NULL, NULL, 'active', '2023-03-02 14:32:22'),
(141, 'RPA710502', 1000000, 'in', 125, 175, NULL, NULL, 'active', '2023-03-02 15:07:08'),
(142, 'RPA655761', 199800, 'in', 53, 174, NULL, NULL, 'active', '2023-03-02 15:07:37'),
(143, 'RPA168055', 1500000, 'in', 121, 178, NULL, NULL, 'pending', '2023-03-03 10:59:06'),
(144, 'RPA730745', 1500000, 'in', 121, 179, NULL, NULL, 'pending', '2023-03-03 10:59:17'),
(145, 'RPA263636', 1500000, 'in', 121, 180, NULL, NULL, 'pending', '2023-03-03 10:59:24'),
(146, 'RPA483426', 1500000, 'in', 121, 181, NULL, NULL, 'pending', '2023-03-03 10:59:31'),
(147, 'RPA875250', 1500000, 'in', 121, 182, NULL, NULL, 'pending', '2023-03-03 11:01:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `upload`
--

CREATE TABLE `upload` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `disk` varchar(255) DEFAULT NULL,
  `folder_id` varchar(255) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `newtime` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `upload`
--

INSERT INTO `upload` (`id`, `type`, `title`, `caption`, `url`, `thumb`, `time`, `size`, `disk`, `folder_id`, `folder`, `newtime`, `created_at`, `updated_at`) VALUES
(1, 'jpg', 'zWaAc8SFaO.jpg', 'zWaAc8SFaO.jpg', 'http://localhost/rpa/public/uploads/images/zWaAc8SFaO.jpg', 'http://localhost/rpa/public/uploads/images/zWaAc8SFaO.jpg', '1673326273', 345184, 'public', '0', NULL, '2023-01-10 04:51:13', NULL, NULL),
(2, 'jpg', 'hNkTAhA92h.jpg', 'hNkTAhA92h.jpg', 'http://localhost/rpa/public/uploads/images/hNkTAhA92h.jpg', 'http://localhost/rpa/public/uploads/images/hNkTAhA92h.jpg', '1673515976', 49673, 'public', '0', NULL, '2023-01-12 09:32:56', NULL, NULL),
(3, 'jpg', 'tRpthHPFf2.jpg', 'tRpthHPFf2.jpg', 'http://localhost/rpa/public/uploads/images/tRpthHPFf2.jpg', 'http://localhost/rpa/public/uploads/images/tRpthHPFf2.jpg', '1673516036', 41587, 'public', '0', NULL, '2023-01-12 09:33:56', NULL, NULL),
(4, 'jpg', 'OMCRcEehKh.jpg', 'OMCRcEehKh.jpg', 'http://localhost/rpa/public/uploads/images/OMCRcEehKh.jpg', 'http://localhost/rpa/public/uploads/images/OMCRcEehKh.jpg', '1673834621', 39944, 'public', '0', NULL, '2023-01-16 02:03:41', NULL, NULL),
(5, 'jpg', 'BVm9Zet1oj.jpg', 'BVm9Zet1oj.jpg', 'http://localhost/rpa/public/uploads/images/BVm9Zet1oj.jpg', 'http://localhost/rpa/public/uploads/images/BVm9Zet1oj.jpg', '1673834706', 208370, 'public', '0', NULL, '2023-01-16 02:05:06', NULL, NULL),
(6, 'png', 'S8dXvKcdTh.png', 'S8dXvKcdTh.png', 'http://localhost/rpa/public/uploads/images/S8dXvKcdTh.png', 'http://localhost/rpa/public/uploads/images/S8dXvKcdTh.png', '1673834885', 180164, 'public', '0', NULL, '2023-01-16 02:08:05', NULL, NULL),
(7, 'jpg', 'fXBJYmftAi.jpg', 'fXBJYmftAi.jpg', 'http://localhost/rpa/public/uploads/images/fXBJYmftAi.jpg', 'http://localhost/rpa/public/uploads/images/fXBJYmftAi.jpg', '1673834962', 117114, 'public', '0', NULL, '2023-01-16 02:09:22', NULL, NULL),
(8, 'jpg', 'RMLgvi7Dss.jpg', 'RMLgvi7Dss.jpg', 'http://localhost/rpa/public/uploads/images/RMLgvi7Dss.jpg', 'http://localhost/rpa/public/uploads/images/RMLgvi7Dss.jpg', '1673835001', 83503, 'public', '0', NULL, '2023-01-16 02:10:01', NULL, NULL),
(9, 'jpg', 'VXbCzzLrIz.jpg', 'VXbCzzLrIz.jpg', 'http://localhost/rpa/public/uploads/images/VXbCzzLrIz.jpg', 'http://localhost/rpa/public/uploads/images/VXbCzzLrIz.jpg', '1673835101', 101015, 'public', '0', NULL, '2023-01-16 02:11:41', NULL, NULL),
(10, 'jpg', 'DuEQHjjO77.jpg', 'DuEQHjjO77.jpg', 'http://localhost/rpa/public/uploads/images/DuEQHjjO77.jpg', 'http://localhost/rpa/public/uploads/images/DuEQHjjO77.jpg', '1673835724', 258729, 'public', '0', NULL, '2023-01-16 02:22:04', NULL, NULL),
(11, 'jpg', 'OZA4GBSqkN.jpg', 'OZA4GBSqkN.jpg', 'http://localhost/rpa/public/uploads/images/OZA4GBSqkN.jpg', 'http://localhost/rpa/public/uploads/images/OZA4GBSqkN.jpg', '1673835770', 322623, 'public', '0', NULL, '2023-01-16 02:22:50', NULL, NULL),
(12, 'png', 'JstDpFm8gU.png', 'JstDpFm8gU.png', 'http://localhost/rpa/public/uploads/images/JstDpFm8gU.png', 'http://localhost/rpa/public/uploads/images/JstDpFm8gU.png', '1673945100', 77495, 'public', '0', NULL, '2023-01-17 08:45:00', NULL, NULL),
(13, 'jpg', 'OANwgHGzt6.jpg', 'OANwgHGzt6.jpg', 'http://localhost/rpa/public/uploads/images/OANwgHGzt6.jpg', 'http://localhost/rpa/public/uploads/images/OANwgHGzt6.jpg', '1674056747', 330679, 'public', '0', NULL, '2023-01-18 15:45:47', NULL, NULL),
(14, 'jpg', '0kqcBWsmIe.jpg', '0kqcBWsmIe.jpg', 'http://localhost/rpa2/public/uploads/images/0kqcBWsmIe.jpg', 'http://localhost/rpa2/public/uploads/images/0kqcBWsmIe.jpg', '1675666315', 481910, 'public', '0', NULL, '2023-02-06 06:51:55', NULL, NULL),
(15, 'jpg', 'Tuzd5lMHvX.jpg', 'Tuzd5lMHvX.jpg', 'http://localhost/rpa2/public/uploads/images/Tuzd5lMHvX.jpg', 'http://localhost/rpa2/public/uploads/images/Tuzd5lMHvX.jpg', '1675666704', 417091, 'public', '0', NULL, '2023-02-06 06:58:24', NULL, NULL),
(16, 'jpg', 'yAild02FIq.jpg', 'yAild02FIq.jpg', 'http://localhost/rpa2/public/uploads/images/yAild02FIq.jpg', 'http://localhost/rpa2/public/uploads/images/yAild02FIq.jpg', '1675666744', 425501, 'public', '0', NULL, '2023-02-06 06:59:04', NULL, NULL),
(17, 'jpg', 'bWl7NeMFy0.jpg', 'bWl7NeMFy0.jpg', 'http://localhost/rpa2/public/uploads/images/bWl7NeMFy0.jpg', 'http://localhost/rpa2/public/uploads/images/bWl7NeMFy0.jpg', '1675666778', 363647, 'public', '0', NULL, '2023-02-06 06:59:38', NULL, NULL),
(18, 'jpg', 'Rjbd9JrS49.jpg', 'Rjbd9JrS49.jpg', 'http://localhost/rpa2/public/uploads/images/Rjbd9JrS49.jpg', 'http://localhost/rpa2/public/uploads/images/Rjbd9JrS49.jpg', '1675666809', 353828, 'public', '0', NULL, '2023-02-06 07:00:09', NULL, NULL),
(19, 'jpg', 'sVGneen01J.jpg', 'sVGneen01J.jpg', 'http://localhost/rpa2/public/uploads/images/sVGneen01J.jpg', 'http://localhost/rpa2/public/uploads/images/sVGneen01J.jpg', '1675666835', 317923, 'public', '0', NULL, '2023-02-06 07:00:35', NULL, NULL),
(20, 'jpg', 'KHVhh7ppm4.jpg', 'KHVhh7ppm4.jpg', 'http://localhost/rpa2/public/uploads/images/KHVhh7ppm4.jpg', 'http://localhost/rpa2/public/uploads/images/KHVhh7ppm4.jpg', '1675666906', 379327, 'public', '0', NULL, '2023-02-06 07:01:46', NULL, NULL),
(21, 'jpg', 'vPv5dSH5Uo.jpg', 'vPv5dSH5Uo.jpg', 'http://localhost/rpa2/public/uploads/images/vPv5dSH5Uo.jpg', 'http://localhost/rpa2/public/uploads/images/vPv5dSH5Uo.jpg', '1675667403', 1671722, 'public', '0', NULL, '2023-02-06 07:10:03', NULL, NULL),
(22, 'jpg', 'cQBlmLVhcj.jpg', 'cQBlmLVhcj.jpg', 'http://localhost/rpa2/public/uploads/images/cQBlmLVhcj.jpg', 'http://localhost/rpa2/public/uploads/images/cQBlmLVhcj.jpg', '1675677038', 1671722, 'public', '0', NULL, '2023-02-06 09:50:38', NULL, NULL),
(23, 'jpg', 'CNoMDQqdhr.jpg', 'CNoMDQqdhr.jpg', 'https://rpagroup.vn/public/uploads/images/CNoMDQqdhr.jpg', 'https://rpagroup.vn/public/uploads/images/CNoMDQqdhr.jpg', '1675847859', 322623, 'public', '0', NULL, '2023-02-08 09:17:39', NULL, NULL),
(24, 'jpg', 'ouQq2R4GQ3.jpg', 'ouQq2R4GQ3.jpg', 'https://rpagroup.vn/public/uploads/images/ouQq2R4GQ3.jpg', 'https://rpagroup.vn/public/uploads/images/ouQq2R4GQ3.jpg', '1675854156', 621858, 'public', '0', NULL, '2023-02-08 11:02:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `level` varchar(256) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `aff_number` int(11) DEFAULT NULL,
  `_lft` int(10) UNSIGNED DEFAULT NULL,
  `_rgt` int(10) UNSIGNED DEFAULT NULL,
  `level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_affiliate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `level`, `avatar`, `password`, `email`, `birthday`, `gender`, `address`, `phone`, `code`, `token`, `secret`, `parent_id`, `role`, `status`, `created_at`, `group_id`, `aff_number`, `_lft`, `_rgt`, `level_id`, `is_affiliate`) VALUES
(1, 'admin', 'admin', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, '2023-01-10 05:49:29', NULL, NULL, 1, 2, NULL, NULL),
(5, 'root', 'root', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'root@gmail.com', NULL, NULL, NULL, NULL, 'RPA785435', NULL, NULL, NULL, 'root', 'active', '2023-01-10 05:49:29', NULL, NULL, 3, 128, 1, '1'),
(21, 'Duy Anh Nguyễn Ngọc', 'web.rpagroup@gmail.com', NULL, NULL, '6da2fe06a5c31f0e46643381206c4689', 'web.rpagroup@gmail.com', NULL, NULL, NULL, '09327321521521', 'NS366580', 'P6jeAw8KfKuudT3WS2MQxffs4k6ABRbR7QNoYHX1', NULL, NULL, 'user', 'active', '2023-01-19 08:29:41', NULL, 1, 129, 130, NULL, '1'),
(25, 'Trần Nhung', 'Trần Nhung', NULL, NULL, '441ed0394bac6d2ed8f0c6fef4b15ba9', 'balanke1983@gmail.com', NULL, NULL, NULL, '0961472081', 'RPA636202', 'P8CynWk1UGaTE2GM0qr2h5lLVNG2qgM1jl01qtYE', NULL, NULL, 'user', 'active', '2023-02-09 07:10:51', NULL, 1, 131, 132, NULL, NULL),
(41, 'Duy Anh', 'anhnnd', 'dstt_3sao', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'anhnnd.hotro@gmail.com', NULL, NULL, NULL, '0932730394', 'RPA462058', 'NWhzbSBv7spoAxFME4xBmy8ZnTKDcCQ6OP3eGFv8', NULL, '5', 'user', 'active', '2023-02-19 12:17:23', NULL, 2, 133, 172, 1, NULL),
(53, 'Phạm Ngân', 'phamngan22', 'dstt', NULL, '79001c4b8526b870f648f795655377b0', 'phamnganpa@gmail.com', NULL, NULL, NULL, '0916389933', 'RPA720664', 'sYRT8XECr914iziQhWuxXBWDQJb8F0nXOTtsm67r', NULL, NULL, 'user', 'active', '2023-02-22 09:22:16', NULL, 5, 173, 190, 2, NULL),
(113, 'Giang', 'gianghnt', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'gianghnt@gmail.com', NULL, NULL, NULL, '0932730395', 'RPA978349', 'Pqq8YefzVQAOvOtiHMP8VsWoNiCEtWnQWWpHhHV1', NULL, '41', 'user', 'active', '2023-02-28 18:56:13', NULL, NULL, 156, 157, NULL, NULL),
(114, 'Đoàn Ngọc Thúy Hân', 'handnt', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'handnt@gmail.com', NULL, NULL, NULL, '0932730396', 'RPA272387', 'Pqq8YefzVQAOvOtiHMP8VsWoNiCEtWnQWWpHhHV1', NULL, '41', 'user', 'active', '2023-02-28 19:04:53', NULL, NULL, 158, 161, NULL, NULL),
(115, 'Bảo', 'bao', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'bao@gmail.com', NULL, NULL, NULL, '0932730397', 'RPA380846', 'kzVEPS8F4OYd1QSXfrqO0xrj9xKYLhxacW7gSu72', NULL, '41', 'user', 'active', '2023-02-28 19:24:05', NULL, NULL, 162, 163, NULL, NULL),
(116, 'Trung', 'trung', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'trung@gmail.com', NULL, NULL, NULL, '0932630397', 'RPA840532', 'kzVEPS8F4OYd1QSXfrqO0xrj9xKYLhxacW7gSu72', NULL, '41', 'user', 'active', '2023-02-28 19:26:26', NULL, NULL, 164, 165, NULL, NULL),
(119, 'Lê Trung Hải', 'hailt', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'hailt@gmail.com', NULL, NULL, NULL, '09327125125', 'RPA727489', 'daadfb4626770c02708d27e699b94036', NULL, '41', 'user', 'active', '2023-02-28 20:05:58', NULL, NULL, 170, 171, NULL, NULL),
(120, 'Bé Em', 'beem', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'beem@gmail.com', NULL, NULL, NULL, '09831251251', 'RPA388128', 'f8d1a8cbb1f8dbe4aa2435da0a34ab7f', NULL, '114', 'user', 'active', '2023-02-28 20:34:55', NULL, NULL, 159, 160, NULL, NULL),
(121, 'Lê Văn Hoàn', 'levanhoan0412@gmail.com', 'dstt_1sao', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'levanhoan0412@gmail.com', NULL, NULL, NULL, '0352781356', 'RPA832598', '991a2b8c970e4b67b410260bf2d2fb30', NULL, '5', 'user', 'active', '2023-03-02 09:52:27', NULL, 17, 90, 127, NULL, NULL),
(122, 'Hoàn Lê', 'lehoantb94@gmail.com', 'dstt_1sao', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'lehoantb94@gmail.com', NULL, NULL, NULL, '0352781357', 'RPA170565', 'a4358735382142da28e95bc4bdc8650a', NULL, '121', 'user', 'active', '2023-03-02 09:55:25', NULL, 6, 91, 104, NULL, NULL),
(123, 'Lê Hoàn', 'hoanle.c2c@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'hoanle.c2c@gmail.com', NULL, NULL, NULL, '0352781358', 'RPA137139', '856bbf766c18d5443ae576f563d6cd85', NULL, '122', 'user', 'active', '2023-03-02 10:03:11', NULL, NULL, 92, 93, NULL, NULL),
(124, 'Diu do', 'dodiu123', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'diudo81@yahoo.com.vn', NULL, NULL, NULL, '0314567892', NULL, 'd4f29188f183dd586f8b6d0056090c70', NULL, '53', 'user', 'active', '2023-03-02 11:27:59', NULL, NULL, 176, 177, NULL, NULL),
(125, 'Minh Phong', 'minhphong19', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'minhphong@gmail.com', NULL, NULL, NULL, '0344568974', 'RPA141983', '9ee26f7a3bc83d2c662e389181a81910', NULL, '53', 'user', 'active', '2023-03-02 11:29:48', NULL, 2, 178, 189, NULL, NULL),
(126, 'DS01', 'dstt01@mail1s.edu.vn', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt01@mail1s.edu.vn', NULL, NULL, NULL, '0352781359', 'RPA733825', 'aea7ed445bc5d6bf2191e4e36c496940', NULL, '121', 'user', 'active', '2023-03-02 11:31:41', NULL, NULL, 105, 106, NULL, NULL),
(127, 'DS02', 'dstt02@mail1s.edu.vn', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt02@mail1s.edu.vn', NULL, NULL, NULL, '0352781310', 'RPA526704', '31d14d40b4ac1a7a137ab675a1e7faa3', NULL, '121', 'user', 'active', '2023-03-02 11:33:45', NULL, NULL, 107, 108, NULL, NULL),
(128, 'DS03', 'dstt03@mail1s.edu.vn', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt03@mail1s.edu.vn', NULL, NULL, NULL, '0352781311', 'RPA500791', '8f3ead70ef9c36463140db9b9b672152', NULL, '121', 'user', 'active', '2023-03-02 11:38:06', NULL, NULL, 109, 110, NULL, NULL),
(129, 'DS04', 'dstt04@mail1s.edu.vn', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt04@mail1s.edu.vn', NULL, NULL, NULL, '0352781312', 'RPA273901', '6f178b5ca2f8ffcfae84291207c26743', NULL, '121', 'user', 'active', '2023-03-02 11:40:33', NULL, NULL, 111, 112, NULL, NULL),
(130, 'DS05', 'dstt05@mail1s.edu.vn', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt05@mail1s.edu.vn', NULL, NULL, NULL, '0352781313', 'RPA292947', 'cc814ca5d2edf9d8cf3b9ebb215beeb7', NULL, '121', 'user', 'active', '2023-03-02 11:44:34', NULL, NULL, 113, 114, NULL, NULL),
(131, 'test 12', 'test123', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'test123@gmail.com', NULL, NULL, NULL, '125125125125', 'RPA172480', '0c983752e3238019762d2bd1b036b475', NULL, '121', 'user', 'active', '2023-03-02 11:53:31', NULL, NULL, 115, 116, NULL, NULL),
(132, 'DS10', 'dstt10@mail1s.edu.vn', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt10@mail1s.edu.vn', NULL, NULL, NULL, '1234567890', 'RPA790154', '2444f53a9550296f70d05414ee4edc07', NULL, '122', 'user', 'active', '2023-03-02 13:59:23', NULL, NULL, 94, 95, NULL, NULL),
(133, 'DS11', 'dstt11@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt11@gmail.com', NULL, NULL, NULL, '1234567778', 'RPA245674', '728de6b8be31674ffe15f4c87162944f', NULL, '122', 'user', 'active', '2023-03-02 14:03:17', NULL, NULL, 96, 97, NULL, NULL),
(134, 'DS12', 'dstt12@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt12@gmail.com', NULL, NULL, NULL, '1234544345', 'RPA954523', '264f9b3c6c56e2c89daabc399c8ac481', NULL, '122', 'user', 'active', '2023-03-02 14:04:31', NULL, NULL, 98, 99, NULL, NULL),
(135, 'DS13', 'dstt13@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt13@gmail.com', NULL, NULL, NULL, '1242343242', 'RPA762794', 'ce92c260c2e40b41ca298c046f86e22b', NULL, '122', 'user', 'active', '2023-03-02 14:06:01', NULL, NULL, 100, 101, NULL, NULL),
(136, 'DS14', 'dstt14@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'dstt14@gmail.com', NULL, NULL, NULL, '31248274232', 'RPA923646', '83a18e59cc8850a5065aea6f44d43d5e', NULL, '122', 'user', 'active', '2023-03-02 14:07:11', NULL, NULL, 102, 103, NULL, NULL),
(137, 'H1', 'app1', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'app1@gmail.com', NULL, NULL, NULL, '0912345678', NULL, 'b28c5e6bd3b643ecaa989874910155b9', NULL, '125', 'user', 'active', '2023-03-02 15:17:32', NULL, NULL, 179, 180, NULL, NULL),
(138, 'H2', 'app2', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'App2@gmai.com', NULL, NULL, NULL, '0333333333', NULL, 'fa5a7290a18bb6d188294b6b27ee1e8a', NULL, '125', 'user', 'active', '2023-03-02 15:19:09', NULL, NULL, 181, 182, NULL, NULL),
(139, 'H3', 'app3', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'App3@gmail.com', NULL, NULL, NULL, '0344444444', NULL, '5e0851495ba5bd3a396118bc1b4f7b3c', NULL, '125', 'user', 'active', '2023-03-02 15:22:33', NULL, NULL, 183, 184, NULL, NULL),
(140, 'h4', 'app4', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'app4@gmail.com', NULL, NULL, NULL, '0467333333', NULL, '1c04057dcb18ddc59cd0ecda66583487', NULL, '125', 'user', 'active', '2023-03-02 15:23:31', NULL, NULL, 185, 186, NULL, NULL),
(141, 'h5', 'App5', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', 'app5@gmail.com', NULL, NULL, NULL, '0356111111', NULL, 'fbf3430fbdfbce3b8d31dc7bae4c3a60', NULL, '125', 'user', 'active', '2023-03-02 15:24:21', NULL, NULL, 187, 188, NULL, NULL),
(142, 'DS20', 'ds20@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'ds20@gmail.com', NULL, NULL, NULL, '2491242198', 'RPA751238', 'c83713b6b5cb7bde6bc3a6e619d2c6f2', NULL, '121', 'user', 'active', '2023-03-03 10:54:36', NULL, NULL, 117, 118, NULL, NULL),
(143, 'ds21', 'ds21@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'ds21@gmail.com', NULL, NULL, NULL, '23124323242', 'RPA747399', '32c801dbb95808750b53fb3c8076d5a3', NULL, '121', 'user', 'active', '2023-03-03 10:55:44', NULL, NULL, 119, 120, NULL, NULL),
(144, 'ds22', 'ds22@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'ds22@gmail.com', NULL, NULL, NULL, '3213123233', 'RPA922261', '3cec53e3b9115d075ffe219bf86da538', NULL, '121', 'user', 'active', '2023-03-03 10:57:01', NULL, NULL, 121, 122, NULL, NULL),
(145, 'ds23', 'ds23@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'ds23@gmail.com', NULL, NULL, NULL, '1232434644', 'RPA514727', 'c313c2602736388f00f261ceef1847f2', NULL, '121', 'user', 'active', '2023-03-03 10:57:35', NULL, NULL, 123, 124, NULL, NULL),
(146, 'ds24', 'ds24@gmail.com', 'dstt', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'ds24@gmail.com', NULL, NULL, NULL, '132434324324', 'RPA417914', '56a485bc49cbb9f93e00eef13fe78add', NULL, '121', 'user', 'active', '2023-03-03 11:00:53', NULL, NULL, 125, 126, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_group`
--

CREATE TABLE `user_group` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_default` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `monthly_income` int(11) DEFAULT NULL,
  `group_commission` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_show` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `affilate_condition`
--
ALTER TABLE `affilate_condition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affilate_condition_level_id` (`level_id`);

--
-- Chỉ mục cho bảng `affilate_level`
--
ALTER TABLE `affilate_level`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `affilate_setting`
--
ALTER TABLE `affilate_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `affilate_setting_indirect_level_id_foreign` (`indirect_level_id`),
  ADD KEY `affilate_setting_level_id_foreign` (`level_id`);

--
-- Chỉ mục cho bảng `combo`
--
ALTER TABLE `combo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `combo_course`
--
ALTER TABLE `combo_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `combo_course_course_id_foreign` (`course_id`),
  ADD KEY `combo_course_combo_id_foreign` (`combo_id`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_level_id_foreign` (`level_id`),
  ADD KEY `course_teacher_id_foreign` (`teacher_id`);

--
-- Chỉ mục cho bảng `course_lession_document`
--
ALTER TABLE `course_lession_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_lession_document_lesson_id_foreign` (`lesson_id`),
  ADD KEY `course_lession_document_document_id_foreign` (`document_id`),
  ADD KEY `course_lession_document_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `course_teacher_lession_question`
--
ALTER TABLE `course_teacher_lession_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_teacher_lession_question_lesson_id_foreign` (`lesson_id`),
  ADD KEY `course_teacher_lession_question_teacher_id_foreign` (`teacher_id`),
  ADD KEY `course_teacher_lession_question_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user_id_foreign` (`user_id`),
  ADD KEY `order_created_by_foreign` (`created_by`),
  ADD KEY `order_parent_id_foreign` (`parent_id`);

--
-- Chỉ mục cho bảng `order_course_user`
--
ALTER TABLE `order_course_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_course_user_course_id_foreign` (`course_id`),
  ADD KEY `order_course_user_user_id_foreign` (`user_id`),
  ADD KEY `order_course_user_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_history_order_id_foreign` (`order_id`),
  ADD KEY `payment_history_user_id_foreign` (`user_id`),
  ADD KEY `payment_history_approved_by_foreign` (`approved_by`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_supplier_id_foreign` (`supplier_id`),
  ADD KEY `product_product_group_id_foreign` (`product_group_id`);

--
-- Chỉ mục cho bảng `product_group`
--
ALTER TABLE `product_group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_meta`
--
ALTER TABLE `product_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_meta_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taxonomy`
--
ALTER TABLE `taxonomy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomy__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`);

--
-- Chỉ mục cho bảng `taxonomy_relationship`
--
ALTER TABLE `taxonomy_relationship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taxonomy_relationship_product_id_foreign` (`product_id`),
  ADD KEY `taxonomy_relationship_taxonomy_id_foreign` (`taxonomy_id`),
  ADD KEY `taxonomy_relationship_course_id_foreign` (`course_id`);

--
-- Chỉ mục cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_user_id` (`user_id`),
  ADD KEY `transaction_order_id` (`order_id`);

--
-- Chỉ mục cho bảng `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_group_id_foreign` (`group_id`),
  ADD KEY `user_level_id_foreign` (`level_id`);

--
-- Chỉ mục cho bảng `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `affilate_condition`
--
ALTER TABLE `affilate_condition`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `affilate_level`
--
ALTER TABLE `affilate_level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `affilate_setting`
--
ALTER TABLE `affilate_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `combo`
--
ALTER TABLE `combo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `combo_course`
--
ALTER TABLE `combo_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `course_lession_document`
--
ALTER TABLE `course_lession_document`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `course_teacher_lession_question`
--
ALTER TABLE `course_teacher_lession_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `document`
--
ALTER TABLE `document`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT cho bảng `level`
--
ALTER TABLE `level`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT cho bảng `order_course_user`
--
ALTER TABLE `order_course_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=734;

--
-- AUTO_INCREMENT cho bảng `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_group`
--
ALTER TABLE `product_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product_meta`
--
ALTER TABLE `product_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `question`
--
ALTER TABLE `question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taxonomy`
--
ALTER TABLE `taxonomy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `taxonomy_relationship`
--
ALTER TABLE `taxonomy_relationship`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT cho bảng `upload`
--
ALTER TABLE `upload`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT cho bảng `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `affilate_condition`
--
ALTER TABLE `affilate_condition`
  ADD CONSTRAINT `affilate_condition_level_id` FOREIGN KEY (`level_id`) REFERENCES `affilate_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `affilate_setting`
--
ALTER TABLE `affilate_setting`
  ADD CONSTRAINT `affilate_setting_indirect_level_id_foreign` FOREIGN KEY (`indirect_level_id`) REFERENCES `affilate_level` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `affilate_setting_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `affilate_level` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `combo_course`
--
ALTER TABLE `combo_course`
  ADD CONSTRAINT `combo_course_combo_id_foreign` FOREIGN KEY (`combo_id`) REFERENCES `combo` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `combo_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `level` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `course_lession_document`
--
ALTER TABLE `course_lession_document`
  ADD CONSTRAINT `course_lession_document_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_lession_document_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_lession_document_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `course_teacher_lession_question`
--
ALTER TABLE `course_teacher_lession_question`
  ADD CONSTRAINT `course_teacher_lession_question_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_teacher_lession_question_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lesson` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_teacher_lession_question_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `order_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Các ràng buộc cho bảng `order_course_user`
--
ALTER TABLE `order_course_user`
  ADD CONSTRAINT `order_course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_course_user_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_history_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_product_group_id_foreign` FOREIGN KEY (`product_group_id`) REFERENCES `product_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_meta`
--
ALTER TABLE `product_meta`
  ADD CONSTRAINT `product_meta_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `taxonomy_relationship`
--
ALTER TABLE `taxonomy_relationship`
  ADD CONSTRAINT `taxonomy_relationship_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `taxonomy_relationship_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `taxonomy_relationship_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomy` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `user_group` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `affilate_level` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-19 11:54:58
-- サーバのバージョン： 10.4.18-MariaDB
-- PHP のバージョン: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `fukushisystem`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `activityrecord`
--

CREATE TABLE `activityrecord` (
  `Activity_record_id` int(11) NOT NULL,
  `Recipient_number` int(11) NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Month_year` varchar(6) NOT NULL,
  `Day_week` varchar(2) NOT NULL,
  `Day` varchar(255) NOT NULL,
  `Tsusho` varchar(255) NOT NULL,
  `Start_time` varchar(10) NOT NULL,
  `End_time` varchar(10) NOT NULL,
  `Meal_addition` varchar(255) NOT NULL,
  `Pick_drop` varchar(255) NOT NULL,
  `Experience_use` varchar(255) NOT NULL,
  `Visit_support` varchar(255) NOT NULL,
  `Work_out_facility` varchar(255) NOT NULL,
  `Social_life` varchar(255) NOT NULL,
  `Life_home` varchar(255) NOT NULL,
  `Medical_cooperation` varchar(255) NOT NULL,
  `Remark` varchar(255) NOT NULL,
  `Actual_cost1` varchar(255) NOT NULL,
  `Actual_cost2` varchar(255) NOT NULL,
  `Prepare_migration` varchar(255) NOT NULL,
  `Work_training` varchar(255) NOT NULL,
  `Mental_institution` varchar(255) NOT NULL,
  `Medical_alignment_number` varchar(255) NOT NULL,
  `ActiveRecord_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `activityrecord`
--

INSERT INTO `activityrecord` (`Activity_record_id`, `Recipient_number`, `Date`, `Month_year`, `Day_week`, `Day`, `Tsusho`, `Start_time`, `End_time`, `Meal_addition`, `Pick_drop`, `Experience_use`, `Visit_support`, `Work_out_facility`, `Social_life`, `Life_home`, `Medical_cooperation`, `Remark`, `Actual_cost1`, `Actual_cost2`, `Prepare_migration`, `Work_training`, `Mental_institution`, `Medical_alignment_number`, `ActiveRecord_type`) VALUES
(52, 1234567891, '2021-12-28', '202112', '28', '火曜日', '1', '9２', '14', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(53, 1234567891, '2022-01-01', '202201', '01', '土曜日', '1', '9', '14', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(54, 1234567891, '2022-01-02', '202201', '02', '日曜日', '1', '7', '11', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(57, 2147483647, '2022-01-06', '202201', '06', '木曜日', '1', '1', '15', '10月', '2', '3', 'thánh', 'ｗ1', 'ｄ3', 'ｂｄｆｓだｓだｄ', 'asd', 'adsad', '123123', '', '', '', '', '', 1),
(58, 2147483647, '2022-01-05', '202201', '05', '水曜日', '1', '1', '9', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(59, 2147483647, '2022-01-10', '202201', '10', '月曜日', '1', '10', '16', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(60, 2147483647, '2022-01-10', '202201', '10', '月曜日', '1', '1', '10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(62, 221060027, '2022-01-07', '202201', '07', '金曜日', '1', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(64, 2147483647, '2021-12-28', '202112', '28', '火曜日', '1', '9', '14', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(65, 2147483647, '2022-01-01', '202201', '01', '土曜日', '1', '9', '14', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(66, 2147483647, '2022-01-02', '202201', '02', '日曜日', '1', '7', '11', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(67, 2147483647, '2022-01-06', '202201', '06', '木曜日', '1', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(68, 2147483647, '2022-01-05', '202201', '05', '水曜日', '1', '1', '9', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(69, 2147483647, '2022-01-10', '202201', '10', '月曜日', '1', '10', '16', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(70, 2147483647, '2022-01-10', '202201', '10', '月曜日', '1', '1', '10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(73, 2147483647, '2022-01-06', '202201', '06', '木曜日', '1', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(74, 2147483647, '2022-01-05', '202201', '05', '水曜日', '1', '1', '9', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(75, 2147483647, '2022-01-10', '202201', '10', '月曜日', '1', '10', '16', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `business`
--

CREATE TABLE `business` (
  `Business_id` int(11) NOT NULL,
  `Model_number` int(11) NOT NULL,
  `Model_symbol` varchar(100) NOT NULL,
  `Service_offer_date` varchar(50) NOT NULL,
  `Corporate_name` varchar(10) NOT NULL,
  `Representative` varchar(100) NOT NULL,
  `Businesser_name` varchar(100) NOT NULL,
  `Abbreviation` varchar(100) NOT NULL,
  `Administrator` varchar(100) NOT NULL,
  `Businesser_number` varchar(10) NOT NULL,
  `Businesser_postal_code` varchar(10) NOT NULL,
  `Businesser_address` varchar(150) NOT NULL,
  `Businesser_phone` varchar(50) NOT NULL,
  `Kind` varchar(10) NOT NULL,
  `Evaluation_point_type` varchar(100) NOT NULL,
  `Public` varchar(100) NOT NULL,
  `Area_type` varchar(10) NOT NULL,
  `Capacity` varchar(10) NOT NULL,
  `Capacity_type` varchar(50) NOT NULL,
  `Work_migration_support` varchar(50) NOT NULL,
  `Work_settle_number` varchar(50) NOT NULL,
  `Vison_hear_support` varchar(50) NOT NULL,
  `Welfare_pro_staff_add` varchar(50) NOT NULL,
  `Severe_support_add1` varchar(50) NOT NULL,
  `Severe_support_add2` varchar(50) NOT NULL,
  `Care_link_nurse_staff` varchar(50) NOT NULL,
  `Exemption_measures` varchar(10) NOT NULL,
  `Pick_drop_kind_add` int(2) NOT NULL,
  `Self_result_unpulic` varchar(50) NOT NULL,
  `Body_not_abolition` varchar(50) NOT NULL,
  `Wage_improve` varchar(50) NOT NULL,
  `Area_life_support` varchar(50) NOT NULL,
  `Overcapacity` int(2) NOT NULL,
  `Employee_vacancy` varchar(50) NOT NULL,
  `Service_admin_vacancy` varchar(50) NOT NULL,
  `Treatment_improve` varchar(255) NOT NULL,
  `Treatment_improve_num` varchar(255) NOT NULL,
  `Treatment_career_improve` varchar(255) NOT NULL,
  `Special_treatment_improve_add` varchar(255) NOT NULL,
  `Treatment_improve_add` varchar(255) NOT NULL,
  `Invoice_title` varchar(255) NOT NULL,
  `Invoice_name` varchar(255) NOT NULL,
  `User_invoice_remark` varchar(255) NOT NULL,
  `Actual_cost1` int(6) NOT NULL,
  `Actual_cost2` int(6) NOT NULL,
  `Work_settlement_type` varchar(100) NOT NULL,
  `Work_support_add` varchar(50) NOT NULL,
  `Standard_use_time` varchar(50) NOT NULL,
  `Average_wages_type` varchar(50) NOT NULL,
  `Standard_calculation` varchar(50) NOT NULL,
  `Goal_wages_achievement_add1` varchar(50) NOT NULL,
  `Goal_wages_achievement_add2` varchar(50) NOT NULL,
  `Goal_wages_achievement_add3` varchar(50) NOT NULL,
  `Goal_wages_placement_add` int(50) NOT NULL,
  `Business_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `business`
--

INSERT INTO `business` (`Business_id`, `Model_number`, `Model_symbol`, `Service_offer_date`, `Corporate_name`, `Representative`, `Businesser_name`, `Abbreviation`, `Administrator`, `Businesser_number`, `Businesser_postal_code`, `Businesser_address`, `Businesser_phone`, `Kind`, `Evaluation_point_type`, `Public`, `Area_type`, `Capacity`, `Capacity_type`, `Work_migration_support`, `Work_settle_number`, `Vison_hear_support`, `Welfare_pro_staff_add`, `Severe_support_add1`, `Severe_support_add2`, `Care_link_nurse_staff`, `Exemption_measures`, `Pick_drop_kind_add`, `Self_result_unpulic`, `Body_not_abolition`, `Wage_improve`, `Area_life_support`, `Overcapacity`, `Employee_vacancy`, `Service_admin_vacancy`, `Treatment_improve`, `Treatment_improve_num`, `Treatment_career_improve`, `Special_treatment_improve_add`, `Treatment_improve_add`, `Invoice_title`, `Invoice_name`, `User_invoice_remark`, `Actual_cost1`, `Actual_cost2`, `Work_settlement_type`, `Work_support_add`, `Standard_use_time`, `Average_wages_type`, `Standard_calculation`, `Goal_wages_achievement_add1`, `Goal_wages_achievement_add2`, `Goal_wages_achievement_add3`, `Goal_wages_placement_add`, `Business_type`) VALUES
(24, 3, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園', 'ハートの園', '田中　花子', '3212345678', '857-0034', '長崎県佐世保市万徳町1-20', '0120-76-7299', '就継ＡⅠ', '4', '', 'その他', '40', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '管理者', '田中　花子', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(25, 3, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'エンジニアリング', 'ハートの園', '田中　花子', '1212345678', '857-0034', '長崎県佐世保市万徳町1-20', '0120-76-7299', '就継ＡⅠ', '4', '', 'その他', '40', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '管理者', '田中　花子', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(26, 3, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'オリンピック', 'ハートの園', '田中　花子', '2212345678', '857-0034', '長崎県佐世保市万徳町1-20', '0120-76-7299', '就継ＡⅠ', '4', '', 'その他', '40', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '管理者', '田中　花子', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(27, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '7654312324', '857-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(28, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '8654312324', '857-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(29, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '8654312324', '957-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(30, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '8654312324', '957-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(31, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '1254312324', '957-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(32, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '1354312324', '957-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(33, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '2354312324', '957-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(34, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '3354312324', '957-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1),
(35, 0, '', '2022-04', '社会福祉法人ハート会', '山田　太郎', 'ハートの園２', 'ハートの園２', '田中　花子', '4354312324', '957-0034', '長崎県佐世保市万徳町1-20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `historyex`
--

CREATE TABLE `historyex` (
  `HistoryEX_id` int(11) NOT NULL,
  `FileNameEX` varchar(255) NOT NULL,
  `DateEX` datetime NOT NULL,
  `Comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `historyex`
--

INSERT INTO `historyex` (`HistoryEX_id`, `FileNameEX`, `DateEX`, `Comment`) VALUES
(1, 'SE エクスポート', '2022-01-13 00:00:00', ''),
(2, 'SE エクスポート', '2022-01-13 00:00:00', ''),
(3, 'SE エクスポート', '2022-01-13 00:00:00', ''),
(4, 'SE エクスポート', '2022-01-13 08:04:16', ''),
(5, 'SE エクスポート', '2022-01-13 08:09:17', ''),
(6, 'SE エクスポート', '2022-01-13 08:09:38', ''),
(7, 'SE エクスポート', '2022-01-13 08:10:18', ''),
(8, 'SE エクスポート', '2022-01-13 16:11:17', ''),
(9, 'SE エクスポート', '2022-01-13 16:13:30', ''),
(10, 'SE エクスポート', '2022-01-13 16:32:53', ''),
(11, 'SV エクスポート', '2022-01-13 16:33:11', ''),
(12, 'SV エクスポート', '2022-01-13 16:40:09', '成功'),
(13, 'SV エクスポート', '2022-01-14 08:58:33', '成功'),
(14, 'SV エクスポート', '2022-01-14 09:18:15', '成功'),
(15, 'SV20220114', '2022-01-14 09:29:20', '成功'),
(16, 'SE20220114', '2022-01-14 09:31:17', '成功'),
(17, 'SV20220114', '2022-01-14 09:31:43', '成功'),
(18, 'SV20220114', '2022-01-14 09:37:31', '成功'),
(19, 'SV20220101', '2022-01-14 09:41:23', '成功'),
(20, 'SV20220101', '2022-01-14 10:08:00', '成功'),
(21, 'SV20220101', '2022-01-14 10:08:30', '成功'),
(22, 'SE20220101', '2022-01-14 16:26:22', '成功'),
(23, 'SE20220101', '2022-01-14 16:28:30', '成功'),
(24, 'SE20220101', '2022-01-14 16:30:34', '成功'),
(25, 'SE20220101', '2022-01-14 16:44:45', '成功'),
(26, 'SE20220101', '2022-01-14 16:47:07', '成功'),
(27, 'SE20220101', '2022-01-14 16:47:35', '成功'),
(28, 'SE20220101', '2022-01-14 16:48:59', '成功'),
(29, 'SE20220101', '2022-01-14 16:57:02', '成功'),
(30, 'SV20220101', '2022-01-18 10:53:52', '成功'),
(31, 'SV20220101', '2022-01-18 20:44:20', '成功');

-- --------------------------------------------------------

--
-- テーブルの構造 `membermaster`
--

CREATE TABLE `membermaster` (
  `MemberMaster_Id` int(11) NOT NULL,
  `CompanyName` varchar(100) NOT NULL,
  `PostCode` varchar(50) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `TelephoneNumber` varchar(50) NOT NULL,
  `PersonChargeName` varchar(100) NOT NULL,
  `PersonChargeInformation` varchar(255) NOT NULL,
  `EmailAddress` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `membermaster`
--

INSERT INTO `membermaster` (`MemberMaster_Id`, `CompanyName`, `PostCode`, `Address`, `TelephoneNumber`, `PersonChargeName`, `PersonChargeInformation`, `EmailAddress`) VALUES
(1, 'OSADAD', '2344234', '2434', '123', 'asfasd', 'dasd', 'asdasd');

-- --------------------------------------------------------

--
-- テーブルの構造 `municipality`
--

CREATE TABLE `municipality` (
  `Municipality_id` int(11) NOT NULL,
  `Municipality` varchar(255) NOT NULL,
  `Municipality_number` varchar(6) NOT NULL,
  `Coment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `municipality`
--

INSERT INTO `municipality` (`Municipality_id`, `Municipality`, `Municipality_number`, `Coment`) VALUES
(3, '三島市南町', '999999', ''),
(4, '熱海市南町', '123123', '');

-- --------------------------------------------------------

--
-- テーブルの構造 `unit`
--

CREATE TABLE `unit` (
  `Unit_id` int(11) NOT NULL,
  `Unit_code` varchar(20) NOT NULL,
  `Service_content` varchar(255) NOT NULL,
  `Number_unit` int(11) NOT NULL,
  `Unit_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `unit`
--

INSERT INTO `unit` (`Unit_id`, `Unit_code`, `Service_content`, `Number_unit`, `Unit_price`) VALUES
(11, '455050', '就継A初期加算', 10, 10.17),
(12, '455290', '就継A賃金向上加算1', 70, 10.17),
(13, '456036', '就継A専門員加算3', 6, 10.17),
(14, '456040', '就継A欠対加算', 94, 10.17),
(15, '456591', '就継A送迎加算2', 10, 10.17),
(16, '456715', '就継A処遇改善加算1', 57, 10.17),
(17, '45ZZ01', '令和3年9月30日までの上乗せ分', 1, 10.17),
(18, '452037', '就継A1-14', 655, 10.17),
(19, '455050', '就継A初期加算', 10, 10.17),
(20, '455290', '就継A賃金向上加算1', 70, 10.17),
(21, '456036', '就継A専門員加算3', 6, 10.17),
(22, '456040', '就継A欠対加算', 94, 10.17),
(23, '456591', '就継A送迎加算2', 10, 10.17),
(24, '456715', '就継A処遇改善加算1', 57, 10.17),
(25, '45ZZ01', '令和3年9月30日までの上乗せ分', 1, 10.17),
(26, '452037', '就継A1-14', 655, 10.17),
(27, '455050', '就継A初期加算', 10, 10.17),
(28, '455290', '就継A賃金向上加算1', 70, 10.17),
(29, '456036', '就継A専門員加算3', 6, 10.17),
(30, '456040', '就継A欠対加算', 94, 10.17),
(31, '456591', '就継A送迎加算2', 10, 10.17),
(32, '456715', '就継A処遇改善加算1', 57, 10.17),
(33, '45ZZ01', '令和3年9月30日までの上乗せ分', 1, 10.17),
(34, '452037', '就継A1-14', 655, 10.17),
(35, '455050', '就継A初期加算', 10, 10.17),
(36, '455290', '就継A賃金向上加算1', 70, 10.17),
(37, '456036', '就継A専門員加算3', 6, 10.17),
(38, '456040', '就継A欠対加算', 94, 10.17),
(39, '456591', '就継A送迎加算2', 10, 10.17);

-- --------------------------------------------------------

--
-- テーブルの構造 `unitprice`
--

CREATE TABLE `unitprice` (
  `Unit_price_id` int(11) NOT NULL,
  `Service_content` varchar(255) NOT NULL,
  `Number_unit` varchar(255) NOT NULL,
  `Number_time` varchar(255) NOT NULL,
  `Service_unit` varchar(255) NOT NULL,
  `Pick` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `usermanagement`
--

CREATE TABLE `usermanagement` (
  `Usermanagement_id` int(11) NOT NULL,
  `Businesser_number` varchar(10) NOT NULL,
  `Name_hira` varchar(255) NOT NULL,
  `Name_kana` varchar(255) NOT NULL,
  `Recipient_number` varchar(10) NOT NULL,
  `Supply_municipalitie` varchar(255) NOT NULL,
  `Disability_support_type` varchar(255) NOT NULL,
  `Business_up_limit` varchar(255) NOT NULL,
  `Business_exemption_amount` varchar(255) NOT NULL,
  `Service_start_date` date NOT NULL,
  `Service_end_date` date NOT NULL,
  `Contract_field_number` varchar(50) NOT NULL,
  `Contract_date` date NOT NULL,
  `Contract_end_date` date NOT NULL,
  `Contract_payment_amount` int(5) NOT NULL,
  `Initial_addition` varchar(255) NOT NULL,
  `Nursing_plan_notcreated` varchar(255) NOT NULL,
  `Pick_drop_same_site` int(2) NOT NULL,
  `Max_mgmt_office_number` varchar(10) NOT NULL,
  `Max_mgmt_office_name` varchar(10) NOT NULL,
  `Max_mgmt_result` varchar(255) NOT NULL,
  `Max_mgmt_after_user_burden` varchar(6) NOT NULL,
  `Max_mgmt_addition` varchar(2) NOT NULL,
  `Special_use_start_date` date NOT NULL,
  `Special_use_end_date` date NOT NULL,
  `Special_use_year_principle` varchar(10) NOT NULL,
  `Special_use_month_day` varchar(10) NOT NULL,
  `Special_use_each_month` varchar(10) NOT NULL,
  `Structout_support_cumulative` varchar(255) NOT NULL,
  `Rechargeable` varchar(255) NOT NULL,
  `Other_compay_use_status` varchar(255) NOT NULL,
  `Office_name` varchar(255) NOT NULL,
  `User_burden_limit_start` varchar(255) NOT NULL,
  `User_burden_limit_end` varchar(255) NOT NULL,
  `Transition_support` varchar(255) NOT NULL,
  `Facility_support` varchar(255) NOT NULL,
  `Usermanagement_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `usermanagement`
--

INSERT INTO `usermanagement` (`Usermanagement_id`, `Businesser_number`, `Name_hira`, `Name_kana`, `Recipient_number`, `Supply_municipalitie`, `Disability_support_type`, `Business_up_limit`, `Business_exemption_amount`, `Service_start_date`, `Service_end_date`, `Contract_field_number`, `Contract_date`, `Contract_end_date`, `Contract_payment_amount`, `Initial_addition`, `Nursing_plan_notcreated`, `Pick_drop_same_site`, `Max_mgmt_office_number`, `Max_mgmt_office_name`, `Max_mgmt_result`, `Max_mgmt_after_user_burden`, `Max_mgmt_addition`, `Special_use_start_date`, `Special_use_end_date`, `Special_use_year_principle`, `Special_use_month_day`, `Special_use_each_month`, `Structout_support_cumulative`, `Rechargeable`, `Other_compay_use_status`, `Office_name`, `User_burden_limit_start`, `User_burden_limit_end`, `Transition_support`, `Facility_support`, `Usermanagement_type`) VALUES
(127, '2212345678', '榊原郁恵', 'サカキバライクエ', '0000000003', '平戸市', '区分１', '37200', '', '2022-01-01', '0000-00-00', '', '2022-01-01', '0000-00-00', 22, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(128, '2212345678', '林様', 'はやしさま', '2210600272', '三島市南大門', '', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', 0, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(129, '2212345678', '榊原郁恵', 'サカキバライクエ', '0000000003', '平戸市', '区分１', '37200', '', '2022-01-01', '0000-00-00', '', '2022-01-01', '0000-00-00', 22, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(130, '2212345678', '林様', 'はやしさま', '2210600272', '三島市南大門', '', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', 0, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(131, '2212345678', '榊原郁恵', 'サカキバライクエ', '0000000003', '平戸市', '区分１', '37200', '', '2022-01-01', '0000-00-00', '', '2022-01-01', '0000-00-00', 22, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(132, '2212345678', '榊原郁恵', 'サカキバライクエ', '0000000003', '平戸市', '区分１', '37200', '', '2022-01-01', '0000-00-00', '', '2022-01-01', '0000-00-00', 22, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(133, '2212345678', '林様', 'はやしさま', '2210600272', '三島市南大門', '', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', 0, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(135, '2212345678', '榊原郁恵', 'サカキバライクエ', '0000000003', '平戸市', '区分１', '37200', '', '2022-01-01', '0000-00-00', '', '2022-01-01', '0000-00-00', 22, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(136, '2212345678', '林様', 'はやしさま', '2210600272', '三島市南大門', '', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', 0, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1),
(137, '2212345678', '林様', 'はやしさま', '2210600272', '三島市南大門', '', '', '', '0000-00-00', '0000-00-00', '', '0000-00-00', '0000-00-00', 0, '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sex` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `sex`, `role`) VALUES
(2, 'fukushisystem-office', '2bfAidMQXNea', 0, 1),
(3, 'fukushisystem-operation', '2bfAidMQXNea', 0, 0),
(15, 'fukushisystem-office1', '2bfAidMQXNea', 1, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `activityrecord`
--
ALTER TABLE `activityrecord`
  ADD PRIMARY KEY (`Activity_record_id`);

--
-- テーブルのインデックス `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`Business_id`);

--
-- テーブルのインデックス `historyex`
--
ALTER TABLE `historyex`
  ADD PRIMARY KEY (`HistoryEX_id`);

--
-- テーブルのインデックス `membermaster`
--
ALTER TABLE `membermaster`
  ADD PRIMARY KEY (`MemberMaster_Id`);

--
-- テーブルのインデックス `municipality`
--
ALTER TABLE `municipality`
  ADD PRIMARY KEY (`Municipality_id`);

--
-- テーブルのインデックス `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`Unit_id`);

--
-- テーブルのインデックス `unitprice`
--
ALTER TABLE `unitprice`
  ADD PRIMARY KEY (`Unit_price_id`);

--
-- テーブルのインデックス `usermanagement`
--
ALTER TABLE `usermanagement`
  ADD PRIMARY KEY (`Usermanagement_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `activityrecord`
--
ALTER TABLE `activityrecord`
  MODIFY `Activity_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- テーブルの AUTO_INCREMENT `business`
--
ALTER TABLE `business`
  MODIFY `Business_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- テーブルの AUTO_INCREMENT `historyex`
--
ALTER TABLE `historyex`
  MODIFY `HistoryEX_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- テーブルの AUTO_INCREMENT `membermaster`
--
ALTER TABLE `membermaster`
  MODIFY `MemberMaster_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- テーブルの AUTO_INCREMENT `municipality`
--
ALTER TABLE `municipality`
  MODIFY `Municipality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `unit`
--
ALTER TABLE `unit`
  MODIFY `Unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- テーブルの AUTO_INCREMENT `unitprice`
--
ALTER TABLE `unitprice`
  MODIFY `Unit_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `usermanagement`
--
ALTER TABLE `usermanagement`
  MODIFY `Usermanagement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

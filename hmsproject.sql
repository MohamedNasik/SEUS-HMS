-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2021 at 01:20 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmsproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `No` int(11) NOT NULL,
  `apt_id` bigint(20) NOT NULL,
  `specilization` varchar(20) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `apt_date` date NOT NULL,
  `type` text NOT NULL,
  `patient_status` varchar(5) NOT NULL COMMENT '3-Un Attended, 1-Active, 0- Cancel',
  `admin_status` varchar(5) NOT NULL COMMENT '3-Un Attended, 1-Active, 0- Cancel',
  `doctor_status` text NOT NULL COMMENT '3-Un Attended, 1-Active, 0- Cancel'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`No`, `apt_id`, `specilization`, `user_id`, `p_id`, `patient_name`, `apt_date`, `type`, `patient_status`, `admin_status`, `doctor_status`) VALUES
(1, 1, 'Nephrologists', 'DOC-0001', 'PAT-0001', 'Mohamed Nasik', '2021-11-10', 'Consultation', '1', '1', '1'),
(2, 1, 'Nephrologists', 'DOC-0001', 'PAT-0001', 'Mohamed Nasik', '2021-11-11', 'Check Report', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL,
  `user_id` varchar(700) DEFAULT NULL,
  `publisher` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` text NOT NULL,
  `blog_category` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `body` text NOT NULL,
  `published` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `user_id`, `publisher`, `title`, `sub_title`, `blog_category`, `image`, `body`, `published`, `created_at`, `status`) VALUES
(1, 'DOC-0001', 'Mohamed Thaheed', 'WHAT CAN I DO TO PROTECT MYSELF AND PREVENT THE SPREAD OF DISEASE?', 'WHAT CAN I DO TO PROTECT MYSELF AND PREVENT THE SPREAD OF DISEASE? What Is COVID-19?', 'Health Care', '1636628572.png', '<p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">A&nbsp;</span><a href=\"https://www.webmd.com/lung/coronavirus\"><span style=\"font-size: 12pt; line-height: 107%; color: windowtext;\">coronavirus</span></a><span style=\"font-size:12.0pt;line-height:107%\">&nbsp;is a kind of common virus that\ncauses an infection in your nose,&nbsp;</span><a href=\"https://www.webmd.com/allergies/picture-of-the-sinuses\"><span style=\"font-size: 12pt; line-height: 107%; color: windowtext;\">sinuses</span></a><span style=\"font-size:12.0pt;\nline-height:107%\">, or upper throat. Most coronaviruses aren\'t dangerous.<o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">Regularly\nand thoroughly clean your hands with an alcohol based hand rub or wash them\nwith soap and water, because these actions kill viruses that may be on your\nhands. <o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">Keep a safe\ndistance of at least 1 metre (3 feet) from people. The virus is contained in\nsaliva droplets and can be transmitted by breathing at close range,\nparticularly when they cough, sneeze or have a fever.<o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">Avoid\ntouching eyes, nose and mouth, because hands touch many surfaces and can pick\nup viruses. Once contaminated, hands can transfer the virus to your eyes, nose\nor mouth. From there, the virus can enter your body and can make you sick.<o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">Make sure\nyou, and the people around you, follow good respiratory hygiene. This means\ncovering your mouth and nose with your bent elbow or tissue when you cough or\nsneeze. Then dispose of the used tissue immediately. Why? Droplets spread\nvirus. By following good respiratory hygiene you protect the people around you\nfrom viruses such as cold, flu and COVID-19. <o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">&nbsp;</span></p><p style=\"margin: 0in 0in 9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><strong><span style=\"font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;;\ncolor:#444444;letter-spacing:-.2pt\">How long will the coronavirus last?</span></strong><span style=\"font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;;color:#444444;letter-spacing:-.2pt\"><o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:\nminor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;\nmso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">There\'s no way to tell how long the pandemic\nwill continue. There are many factors, including the public’s efforts to slow\nthe spread, researchers’ work to learn more about the virus, their search for a\ntreatment, and the success of the&nbsp;vaccines.<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-ascii-theme-font:\nminor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:minor-latin;\nmso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">&nbsp;</span></p><p style=\"margin: 0in 0in 9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><strong><span style=\"font-family:&quot;Verdana&quot;,&quot;sans-serif&quot;;\ncolor:#444444;letter-spacing:-.2pt\">Symptoms of COVID-19<o:p></o:p></span></strong></p><p style=\"margin: 0in 0in 9pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><strong>The main symptoms include:<o:p></o:p></strong></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Fever&nbsp;<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Coughing<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Shortness of breath<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Trouble breathing<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Fatigue<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Chills, sometimes with shaking<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Body aches<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Headache<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Sore throat<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Congestion/runny nose<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Loss of smell or taste<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Nausea<o:p></o:p></span></p><p style=\"margin: 0in 0in 9pt 0.5in; text-indent: -0.25in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><!--[if !supportLists]--><span style=\"font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:\nSymbol\">·<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span style=\"font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;\nmso-ascii-theme-font:minor-latin;mso-fareast-font-family:Calibri;mso-fareast-theme-font:\nminor-latin;mso-hansi-theme-font:minor-latin;mso-bidi-font-family:&quot;Times New Roman&quot;;\nmso-bidi-theme-font:minor-bidi\">Diarrhea<o:p></o:p></span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">&nbsp;</span></p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">Avoid\nshaking hands and hugging, for the reasons mentioned above. Stay at home as\nmuch as possible, following the rules indicated by the authorities. If you have\na fever, cough and difficulty breathing, seek medical attention and call in\nadvance. <o:p></o:p></span></p><p>\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n</p><p class=\"MsoNormal\"><span style=\"font-size:12.0pt;line-height:107%\">This will\nallow your health care provider to quickly direct you to the right health\nfacility. This will also protect you and help prevent spread of viruses and\nother infections<o:p></o:p></span></p>', '2021-11-11 06:32:52', '2021-11-11 06:32:52', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `sent_by` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `p_id`, `message`, `date`, `sent_by`) VALUES
(1, 'DOC-0001', 'PAT-0001', 'Hello, Sir, I need an help', '2021-11-11', 'PAT-0001'),
(2, 'DOC-0001', 'PAT-0001', 'Yes. Tell me..', '2021-11-11', 'DOC-0001');

-- --------------------------------------------------------

--
-- Table structure for table `check_report`
--

CREATE TABLE `check_report` (
  `check_report_id` int(11) NOT NULL,
  `apt_id` bigint(11) UNSIGNED NOT NULL,
  `pres_id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `check_date` date NOT NULL,
  `submitted_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `check_report`
--

INSERT INTO `check_report` (`check_report_id`, `apt_id`, `pres_id`, `user_id`, `p_id`, `check_date`, `submitted_date`) VALUES
(1, 1, 1, 'DOC-0001', 'PAT-0001', '2021-11-11', '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `deceases`
--

CREATE TABLE `deceases` (
  `deseace_id` int(11) NOT NULL,
  `deseace_name` varchar(20) NOT NULL,
  `deseace_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deceases`
--

INSERT INTO `deceases` (`deseace_id`, `deseace_name`, `deseace_description`) VALUES
(1, 'Diabeties', 'It is very danger sick'),
(2, 'Sick', 'Not danger'),
(3, 'Dengue', 'Dengue is a dangerous fever'),
(4, 'Gastrities', 'Gastroenterologists also perform procedures such as endoscopy, sigmoidoscopy, and colonoscopy');

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `doc_spec_id` smallint(8) UNSIGNED NOT NULL,
  `specilization` varchar(20) NOT NULL,
  `fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`doc_spec_id`, `specilization`, `fees`) VALUES
(5, 'Nephrologists', 1500),
(6, 'Dentist', 1500),
(7, 'Neorology', 2000),
(8, 'Gastroenterologists', 1000),
(9, 'Physiology', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_recommend`
--

CREATE TABLE `doctor_recommend` (
  `doctor_recommend_id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `specilization` varchar(20) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `description` text NOT NULL,
  `recommended_by` varchar(20) NOT NULL,
  `submit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE `doctor_schedule` (
  `doctor_schedule_id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `start_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`doctor_schedule_id`, `user_id`, `start_time`, `end_time`) VALUES
(1, 'DOC-0001', '2021-11-10 15:00:00', '2021-11-10 18:00:00'),
(4, 'DOC-0001', '2021-11-11 15:00:00', '2021-11-11 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specialist`
--

CREATE TABLE `doctor_specialist` (
  `doctor_specialist_id` int(11) NOT NULL,
  `doc_spec_id` smallint(8) UNSIGNED NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `doctor_name` varchar(20) NOT NULL,
  `specilization` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_specialist`
--

INSERT INTO `doctor_specialist` (`doctor_specialist_id`, `doc_spec_id`, `user_id`, `doctor_name`, `specilization`) VALUES
(19, 5, 'DOC-0001', 'Mohamed Thaheed', 'Nephrologists'),
(20, 9, 'DOC-0002', 'Ajith Samarasinghe', 'Physiology'),
(21, 7, 'DOC-0003', 'Rizve Sherif', 'Neorology');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `med_id` bigint(20) NOT NULL,
  `medicine_name` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`med_id`, `medicine_name`, `type`, `description`) VALUES
(1, 'Panadol (500mg)', 'Tablet', '  Panadol tablets provide effective and suitable relief of pain associated with headaches'),
(2, 'Paracitamol (125mg)', 'Tablet', '   Paracitamol tablets provide effective and suitable relief of pain associated with headaches'),
(3, 'Panadine (100mg)', 'Tablet', '   Panadine  is used to treat pain or inflammation caused by conditions such as arthritis, ankylosing spondylitis, tendinitis, bursitis, gout, or menstrual cramps. It can also be used to treat acute pain caused by other conditions not listed in this medication guide.'),
(4, 'Amoxicillin (100ml)', 'Syrup', '  Treatments\nBacterial Infection\nAmoxicillin\nPrint\nSave\nAmoxicillin \nGeneric name: amoxicillin (am OX i sil in)\nBrand name: Amoxil, Trimox, Moxatag\nDrug class: Aminopenicillins\n\n\nMedically reviewed by Kaci Durbin, MD. Last updated on Jan 12, 2020.\n\n\nUses\nWarnings\nDosage\nWhat to avoid\nSide effects\nInteractions\nFAQ\nWhat is amoxicillin?\nAmoxicillin is a penicillin antibiotic that fights bacteria.'),
(5, 'Acetaminophen (100ml', 'Syrup', '   cetaminophen is a pain reliever and a fever reducer.\n\nAcetaminophen is used to treat mild to moderate and pain, to treat moderate to severe pain in conjunction with opiates, or to reduce fever. Common conditions that acetaminophen treats include headache, muscle aches, arthritis, backache, toothaches, sore throat, colds, flu, and fevers.'),
(6, 'Naproxen (100mg)', 'Tablet', '  Naproxen is a nonsteroidal anti-inflammatory drug (NSAID). It works by reducing hormones that cause inflammation and pain in the body.'),
(7, 'Aspirin (10mg)', 'Tablet', ' Aspirin works as a pain reliever for adults, but it’s also important to have on hand in case of emergencies'),
(8, 'Panadol Syrup (200ml', 'Syrup', ' Panadol syrup provide effective and suitable relief of pain associated with headaches');

-- --------------------------------------------------------

--
-- Table structure for table `opd_payments`
--

CREATE TABLE `opd_payments` (
  `opd_payment_id` varchar(700) NOT NULL,
  `No` int(11) NOT NULL,
  `apt_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `doc_spec_id` smallint(8) UNSIGNED NOT NULL,
  `charge` double NOT NULL,
  `apt_date` date NOT NULL,
  `date` date NOT NULL,
  `status` text NOT NULL COMMENT '1- Paid, 2-Refunded, 4-Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opd_payments`
--

INSERT INTO `opd_payments` (`opd_payment_id`, `No`, `apt_id`, `user_id`, `p_id`, `doc_spec_id`, `charge`, `apt_date`, `date`, `status`) VALUES
('OPD-0001', 1, 1, 'DOC-0001', 'PAT-0001', 5, 1500, '2021-11-10', '2021-11-10', '1'),
('OPD-0002', 2, 1, 'DOC-0001', 'PAT-0001', 5, 0, '2021-11-11', '2021-11-10', '4');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp_id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `expiry` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`otp_id`, `user_id`, `p_id`, `otp`, `expiry`, `created`) VALUES
(1, 'DOC-0001', 'PAT-0002', '767882', 1, '2021-11-11 13:47:23'),
(2, 'DOC-0001', 'PAT-0002', '954554', 0, '2021-11-11 13:47:23'),
(3, 'DOC-0001', 'PAT-0002', '555063', 1, '2021-11-11 13:50:44'),
(4, 'DOC-0001', 'PAT-0002', '766499', 1, '2021-11-11 13:51:11'),
(5, 'DOC-0001', 'PAT-0002', '684879', 0, '2021-11-11 13:51:41'),
(6, 'DOC-0001', 'PAT-0002', '648564', 0, '2021-11-11 14:06:07'),
(7, 'DOC-0003', 'PAT-0002', '978808', 0, '2021-11-10 15:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `p_id` varchar(700) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  `p_fname` varchar(20) NOT NULL,
  `p_lname` varchar(20) NOT NULL,
  `p_address` varchar(50) NOT NULL,
  `p_gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `p_contact` int(11) NOT NULL,
  `p_state` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nic` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `prefix`, `p_fname`, `p_lname`, `p_address`, `p_gender`, `dob`, `p_contact`, `p_state`, `email`, `password`, `nic`) VALUES
('PAT-0001', 'Mr.', 'Mohamed', 'Nasik', 'No.22, kahagolla Diyatalawa', 'Male', '1998-12-09', 876545432, 'Haputale', 'nasik@gmail.com', '217b8d440ed8f7febf67961797864a48', '930152030v'),
('PAT-0002', 'Mr.', 'Mohamed', 'Mubeen', 'No.22, Kahagolla Diyatalawa', 'Male', '1998-12-04', 765434564, 'Badulla', 'mubeen@gmail.com', '599566a487b26892d56112af2630cd5c', '987656787v');

-- --------------------------------------------------------

--
-- Table structure for table `patient_schedule`
--

CREATE TABLE `patient_schedule` (
  `id` int(11) NOT NULL,
  `apt_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(700) CHARACTER SET latin1 NOT NULL,
  `p_id` varchar(700) CHARACTER SET latin1 NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `color` varchar(191) DEFAULT NULL,
  `text_color` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_schedule`
--

INSERT INTO `patient_schedule` (`id`, `apt_id`, `user_id`, `p_id`, `start_time`, `end_time`, `color`, `text_color`) VALUES
(1, 1, 'DOC-0001', 'PAT-0001', '2021-11-10 15:00:00', '2021-11-10 15:15:00', '#6453e9', '##ffffff'),
(2, 1, 'DOC-0001', 'PAT-0001', '2021-11-11 15:00:00', '2021-11-11 15:15:00', '#6453e9', '##ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `patient_verification`
--

CREATE TABLE `patient_verification` (
  `opt_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `activation_code` varchar(20) NOT NULL,
  `expire` int(11) NOT NULL COMMENT '1-Active, 0-Expire',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_verification`
--

INSERT INTO `patient_verification` (`opt_id`, `email`, `activation_code`, `expire`, `created`) VALUES
(1, 'nasik@gmail.com', '524097', 0, '2021-11-10 12:54:42'),
(2, 'mubeen@gmail.com', '829702', 0, '2021-11-10 13:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `pres_id` int(11) NOT NULL,
  `apt_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `investigations` text NOT NULL,
  `med_records` text NOT NULL,
  `decease_name` text NOT NULL,
  `remark` text NOT NULL,
  `testing_details` text NOT NULL,
  `reconsult_date` date NOT NULL,
  `date` date NOT NULL,
  `testing_status` text NOT NULL COMMENT '1-Active, 3- Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`pres_id`, `apt_id`, `user_id`, `p_id`, `investigations`, `med_records`, `decease_name`, `remark`, `testing_details`, `reconsult_date`, `date`, `testing_status`) VALUES
(1, 1, 'DOC-0001', 'PAT-0001', '[{\"complaints\":\"<ul><li>Sudden, high fever</li><li>Severe headaches</li><li>Pain behind the eyes</li><li>Severe joint and muscle pain</li><li>Fatigue</li><li>Nausea</li><li>Vomiting</li><li>Skin rash, which appears two to five days after the onset of fever</li><li>Mild bleeding (such a nose bleed, bleeding gums, or easy bruising)</li></ul>\",\"history\":\"<p>The person has been working in Colombo.&nbsp; &nbsp;</p><p>Does not take any unneeded foods.</p><div><br></div>\",\"investigations\":\"<ul><li>The diagnosis of this deceaes shows the symptoms of dengue deceaes.&nbsp;</li><li>Rest as much as possible.</li><li>Take acetaminophen to control fever and relieve pain.</li><li>Do not take aspirin or ibuprofen!</li><li>Drink plenty of fluids to stay hydrated. Drink water or drinks with added electrolytes.</li><li>For mild symptoms, care for a sick infant, child, or family member at home.</li></ul>\",\"hidden\":\"<p>Patient has symstoms of dengue deceases. But can\'t accurately say.&nbsp;<br></p>\"}]', '[{\"medname\":\"Paracitamol (125mg)\",\"morning\":\"2\",\"noon\":\"2\",\"night\":\"2\",\"period\":\"3\"},{\"medname\":\"Amoxicillin (100ml)\",\"morning\":\"1\",\"noon\":\"0\",\"night\":\"1\",\"period\":\"3\"},{\"medname\":\"Panadine (100mg)\",\"morning\":\"2\",\"noon\":\"2\",\"night\":\"2\",\"period\":\"2\"}]', 'Reconsultation Need', '<p><br></p><ul><li>Do not drink cool water.</li><li>Eat healthy food well.</li></ul><div><br></div>', '[{\"testingremark\":\"<p>Test should be carried out based on the symtoms found. Need to check the bloodcount and Urine tests.<br></p>\",\"testings\":[\"Blood Count\",\"Urine\"]}]', '2021-11-17', '2021-11-10', '1'),
(2, 1, 'DOC-0001', 'PAT-0001', '[{\"past_history\":\"<p>The patient has not much blood in the body. Most of the blood becomes dirty.&nbsp;</p><p>The blood count tests shows the low level of blood.</p><p>Urine test shows some cell were already damaged.</p>\",\"complaints\":\"<p>Nausea, vomiting</p><p>Rash</p><p>Aches and pains (eye pain, typically behind the eyes, muscle, joint, or bone pain)</p>\",\"special_investigations\":\"<p>Supportive care in a hospital</p><p>Intravenous (IV) fluid and electrolyte replacement</p><p>Blood pressure monitoring</p><p>Transfusion to replace blood loss</p>\",\"prescription_id\":\"1\",\"hidden\":\"No hidden remarks found\"}]', '[{\"medical\":\"No need Medicines\"}]', 'Dengue', '<p><br></p><p>Diet Restrictions:&nbsp;</p><p><br></p><p>Food Items To Limit In Dengue Fever</p><p><br></p><p>A high fibre foods such as whole grain cereals, green leafy vegetables, thick skin fruits, etc</p><p>Fried foods, processed foods, junk foods, oily and spicy foods, pickle, etc</p><p>Excess intake of tea, coffee, cocoa and other caffeinated beverages, etc.</p><p><br></p><p>Food Items You Can Easily Consume to Prevent Dengue Fever. Such foods are:</p><p><br></p><p>Orange</p><p>Papaya</p><p>Avoid Oily Food</p><p>Porridge</p><p>Herbal Tea</p><p>Coconut Water</p><div><br></div>', '[{\"testingremark\":\"<p>Low blood count.</p><p>Urine test has some critical symtoms found.</p><div><br></div>\",\"testings\":\"No need testings\"}]', '0000-00-00', '2021-11-11', '3');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_otp`
--

CREATE TABLE `prescription_otp` (
  `otp_id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `pres_id` int(11) NOT NULL,
  `expiry` int(11) NOT NULL COMMENT '1-Active, 0-Expire',
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_otp`
--

INSERT INTO `prescription_otp` (`otp_id`, `user_id`, `p_id`, `otp`, `pres_id`, `expiry`, `created`) VALUES
(1, 'DOC-0001', 'PAT-0002', '180296', 2, 0, '2021-11-11'),
(2, 'DOC-0001', 'PAT-0002', '618484', 3, 0, '2021-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'doctor'),
(3, 'laboratorist'),
(4, 'receptionist');

-- --------------------------------------------------------

--
-- Table structure for table `temp_password`
--

CREATE TABLE `temp_password` (
  `temp_password_id` int(11) NOT NULL,
  `person_id` varchar(700) NOT NULL,
  `email` text NOT NULL,
  `active_code` text NOT NULL,
  `expire` int(11) NOT NULL COMMENT '1-Active, 0-Expire',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testings`
--

CREATE TABLE `testings` (
  `test_id` int(11) NOT NULL,
  `testing_name` varchar(20) NOT NULL,
  `testing_description` text NOT NULL,
  `testing_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testings`
--

INSERT INTO `testings` (`test_id`, `testing_name`, `testing_description`, `testing_charge`) VALUES
(1, 'Blood Count', 'Blood count test consists of several elements', 1500),
(2, 'Urine', 'This test consists of several elements', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `testing_report`
--

CREATE TABLE `testing_report` (
  `testing_report_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `pres_id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `testing_results` text NOT NULL,
  `remark` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testing_report`
--

INSERT INTO `testing_report` (`testing_report_id`, `test_id`, `pres_id`, `user_id`, `p_id`, `testing_results`, `remark`, `date`) VALUES
(1, 1, 1, 'LAB-0001', 'PAT-0001', '[{\"WBC\":\"5\"},{\"lymph\":\"2\"},{\"Mid\":\"2\"},{\"Gran\":\"2\"},{\"Limp\":\"2\"},{\"Mids\":\"2\"},{\"RBCB\":\"2\"},{\"HGB\":\"2\"},{\"HCT\":\"2\"},{\"MCV\":\"2\"},{\"MCH\":\"2\"},{\"MCHC\":\"2\"},{\"RDW\":\"2\"}]', '\nBlood count has low infections.', '2021-11-10'),
(2, 2, 1, 'LAB-0001', 'PAT-0001', '[{\"colour\":\"Yellow\"},{\"apprearance\":\"Nil\"},{\"sg\":\"3\"},{\"ph\":\"4\"},{\"protien\":\"Occational\"},{\"glucose\":\"Occational\"},{\"ketone\":\"Occational\"},{\"bilirubin\":\"Occational\"},{\"uro\":\"Occational\"},{},{\"pus\":\"Occational\"},{\"red\":\"Occational\"},{\"epith\":\"+\"},{\"casts\":\"Occational\"},{\"crystal\":\"Occational\"}]', 'Urine test such critical symtoms ', '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `testing_schedule`
--

CREATE TABLE `testing_schedule` (
  `testing_schedule_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `pres_id` int(11) NOT NULL,
  `testing_perform` text NOT NULL,
  `submit_date` date NOT NULL,
  `lab_status` int(11) NOT NULL COMMENT '0-Incomplete, 1- Completed',
  `patient_status` int(11) NOT NULL COMMENT '1- Not Active, 3- Active',
  `update_status` text NOT NULL COMMENT '0-Not finalized, 1- Finalized',
  `payment_status` text NOT NULL COMMENT '0-Paid Later, 1- paid now, 2-Paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testing_schedule`
--

INSERT INTO `testing_schedule` (`testing_schedule_id`, `test_id`, `p_id`, `pres_id`, `testing_perform`, `submit_date`, `lab_status`, `patient_status`, `update_status`, `payment_status`) VALUES
(1, 1, 'PAT-0001', 1, 'Blood Count ', '2021-11-10', 1, 3, '1', '2'),
(2, 2, 'PAT-0001', 1, 'Urine ', '2021-11-10', 1, 3, '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `test_invoices`
--

CREATE TABLE `test_invoices` (
  `test_invoice_id` int(11) NOT NULL,
  `test_payment_id` varchar(700) NOT NULL,
  `pres_id` int(11) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `test_id` int(11) NOT NULL,
  `charge` int(11) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_invoices`
--

INSERT INTO `test_invoices` (`test_invoice_id`, `test_payment_id`, `pres_id`, `user_id`, `p_id`, `test_id`, `charge`, `payment_date`) VALUES
(1, 'TEST-0001', 1, 'ADM-0001', 'PAT-0001', 1, 1500, '2021-11-10'),
(2, 'TEST-0001', 1, 'ADM-0001', 'PAT-0001', 2, 1500, '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `test_payments`
--

CREATE TABLE `test_payments` (
  `test_payment_id` varchar(700) NOT NULL,
  `user_id` varchar(700) NOT NULL,
  `p_id` varchar(700) NOT NULL,
  `invoice_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_payments`
--

INSERT INTO `test_payments` (`test_payment_id`, `user_id`, `p_id`, `invoice_date`) VALUES
('TEST-0001', 'ADM-0001', 'PAT-0001', '2021-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(700) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `state` varchar(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `contact` int(11) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `prefix`, `fname`, `lname`, `address`, `state`, `gender`, `dob`, `contact`, `nic`, `email`, `password`, `image`, `role_id`) VALUES
('ADM-0001', 'Mr.', 'Nasik', 'Thaheed', 'SEUS Hospital Bandarawela', 'Haputala', 'Male', '1993-01-15', 753351090, '987654535v', 'nasikthaheed@gmail.com', 'c8ae279897059486e6f85932357d81dd', 'user.jpg', 1),
('ADM-0002', 'Mr.', 'Admin', '123', 'SEUS Hospital Bandarawela', 'Badulla', 'Male', '1998-07-10', 876543245, '987654323c', 'admin@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', 'user.jpg', 1),
('DOC-0001', 'Dr.', 'Mohamed', 'Thaheed', 'SEUS Hospital Bandarawela', 'Bandarawel', 'Male', '1987-12-15', 675456788, '652345678c', 'thaheed@gmail.com', '71dbf231b8235b033fe4ffa515ff6a70', 'user.jpg', 2),
('DOC-0002', 'Dr.', 'Ajith', 'Samarasinghe', 'SEUS Hospital Bandarawela', 'Badulla', 'Male', '1955-12-21', 765434564, '987645678v', 'ajith@gmail.com', '1e4184801956d2eb58defc593e12b049', 'user.jpg', 2),
('DOC-0003', 'Dr.', 'Rizve', 'Sherif', 'SEUS Hospital Bandarawela', 'Badulla', 'Male', '1950-05-04', 784567653, '765676545v', 'rizvi@gmail.com', 'f22fb6c117ffbb0479a194a1d3bdb404', 'user.jpg', 2),
('LAB-0001', 'Mr.', 'Nifras', 'Thaheed', 'SEUS Hospital Bandarawela', 'Badulla', 'Male', '1994-12-04', 763456786, '987654545v', 'nifras@gmail.com', '690b19317c6a6da2807b643bb5d9c62b', 'user.jpg', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`No`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `check_report`
--
ALTER TABLE `check_report`
  ADD PRIMARY KEY (`check_report_id`),
  ADD KEY `pres_id` (`pres_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `deceases`
--
ALTER TABLE `deceases`
  ADD PRIMARY KEY (`deseace_id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`doc_spec_id`);

--
-- Indexes for table `doctor_recommend`
--
ALTER TABLE `doctor_recommend`
  ADD PRIMARY KEY (`doctor_recommend_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `p_id_2` (`p_id`);

--
-- Indexes for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD PRIMARY KEY (`doctor_schedule_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `doctor_specialist`
--
ALTER TABLE `doctor_specialist`
  ADD PRIMARY KEY (`doctor_specialist_id`),
  ADD KEY `doctor_spec_id` (`doc_spec_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`med_id`);

--
-- Indexes for table `opd_payments`
--
ALTER TABLE `opd_payments`
  ADD PRIMARY KEY (`opd_payment_id`),
  ADD KEY `for_key2` (`user_id`),
  ADD KEY `for_key` (`doc_spec_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `patient_schedule`
--
ALTER TABLE `patient_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`(191)),
  ADD KEY `p_id` (`p_id`(191)),
  ADD KEY `apt_id` (`apt_id`),
  ADD KEY `for_key30` (`p_id`),
  ADD KEY `for_key29` (`user_id`);

--
-- Indexes for table `patient_verification`
--
ALTER TABLE `patient_verification`
  ADD PRIMARY KEY (`opt_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`pres_id`),
  ADD KEY `foreign_key8` (`apt_id`),
  ADD KEY `foreign_key9` (`user_id`),
  ADD KEY `foreign_key0` (`p_id`);

--
-- Indexes for table `prescription_otp`
--
ALTER TABLE `prescription_otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `temp_password`
--
ALTER TABLE `temp_password`
  ADD PRIMARY KEY (`temp_password_id`);

--
-- Indexes for table `testings`
--
ALTER TABLE `testings`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `testing_report`
--
ALTER TABLE `testing_report`
  ADD PRIMARY KEY (`testing_report_id`),
  ADD KEY `user_id` (`user_id`,`p_id`),
  ADD KEY `forkey2` (`p_id`),
  ADD KEY `pres_id` (`pres_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `testing_schedule`
--
ALTER TABLE `testing_schedule`
  ADD PRIMARY KEY (`testing_schedule_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `pres_id` (`pres_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `test_invoices`
--
ALTER TABLE `test_invoices`
  ADD PRIMARY KEY (`test_invoice_id`),
  ADD KEY `pres_id` (`pres_id`,`p_id`,`test_id`),
  ADD KEY `for1` (`test_id`),
  ADD KEY `test_payment_id` (`test_payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `for2` (`p_id`);

--
-- Indexes for table `test_payments`
--
ALTER TABLE `test_payments`
  ADD PRIMARY KEY (`test_payment_id`),
  ADD KEY `test_payments_id` (`p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `check_report`
--
ALTER TABLE `check_report`
  MODIFY `check_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deceases`
--
ALTER TABLE `deceases`
  MODIFY `deseace_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `doc_spec_id` smallint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctor_recommend`
--
ALTER TABLE `doctor_recommend`
  MODIFY `doctor_recommend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  MODIFY `doctor_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor_specialist`
--
ALTER TABLE `doctor_specialist`
  MODIFY `doctor_specialist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `med_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient_schedule`
--
ALTER TABLE `patient_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_verification`
--
ALTER TABLE `patient_verification`
  MODIFY `opt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `pres_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescription_otp`
--
ALTER TABLE `prescription_otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temp_password`
--
ALTER TABLE `temp_password`
  MODIFY `temp_password_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testings`
--
ALTER TABLE `testings`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testing_report`
--
ALTER TABLE `testing_report`
  MODIFY `testing_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testing_schedule`
--
ALTER TABLE `testing_schedule`
  MODIFY `testing_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_invoices`
--
ALTER TABLE `test_invoices`
  MODIFY `test_invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `foreign_key2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key3` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `userids` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `p_id` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `check_report`
--
ALTER TABLE `check_report`
  ADD CONSTRAINT `for_key14` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key15` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key35` FOREIGN KEY (`pres_id`) REFERENCES `prescription` (`pres_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_recommend`
--
ALTER TABLE `doctor_recommend`
  ADD CONSTRAINT `for_key21` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key22` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD CONSTRAINT `keys` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_specialist`
--
ALTER TABLE `doctor_specialist`
  ADD CONSTRAINT `for_key19` FOREIGN KEY (`doc_spec_id`) REFERENCES `doctorspecilization` (`doc_spec_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key20` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `opd_payments`
--
ALTER TABLE `opd_payments`
  ADD CONSTRAINT `for_key` FOREIGN KEY (`doc_spec_id`) REFERENCES `doctorspecilization` (`doc_spec_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key3` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_schedule`
--
ALTER TABLE `patient_schedule`
  ADD CONSTRAINT `for_key29` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key30` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `foreign_key10` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key9` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testing_report`
--
ALTER TABLE `testing_report`
  ADD CONSTRAINT `for_key333` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forkey10` FOREIGN KEY (`test_id`) REFERENCES `testings` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forkey100` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forkey8` FOREIGN KEY (`pres_id`) REFERENCES `prescription` (`pres_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testing_schedule`
--
ALTER TABLE `testing_schedule`
  ADD CONSTRAINT `forkey1` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forkey20` FOREIGN KEY (`pres_id`) REFERENCES `prescription` (`pres_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forkey22` FOREIGN KEY (`test_id`) REFERENCES `testings` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_invoices`
--
ALTER TABLE `test_invoices`
  ADD CONSTRAINT `for1` FOREIGN KEY (`test_id`) REFERENCES `testings` (`test_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for10` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for2` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for3` FOREIGN KEY (`pres_id`) REFERENCES `prescription` (`pres_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for8` FOREIGN KEY (`test_payment_id`) REFERENCES `test_payments` (`test_payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test_payments`
--
ALTER TABLE `test_payments`
  ADD CONSTRAINT `for9` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `for_key7` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2019 at 10:31 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practicalforensic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `caseprocess`
--

DROP TABLE IF EXISTS `caseprocess`;
CREATE TABLE IF NOT EXISTS `caseprocess` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `caseid` varchar(600) NOT NULL,
  `uid` varchar(600) NOT NULL,
  `status` varchar(300) NOT NULL,
  `timer` varchar(300) NOT NULL,
  `date` varchar(100) NOT NULL,
  `type` varchar(80) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

DROP TABLE IF EXISTS `cases`;
CREATE TABLE IF NOT EXISTS `cases` (
  `caseid` int(11) NOT NULL,
  `casetype` varchar(80) NOT NULL,
  `casename` varchar(5000) NOT NULL,
  `scenario` text NOT NULL,
  `finding` text NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`caseid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`caseid`, `casetype`, `casename`, `scenario`, `finding`, `time`, `date`) VALUES
(101, 'For Practice', 'Email Forensics', 'Mr. Rajesh is the CFO of MiniTech Pvt. Ltd. One day, he received an email from his Managing Director of the Mumbai branch requesting the transfer of Rs 6.2 lakhs in each of the three accounts mentioned in the email. Rajesh routinely performs such transfers, as MiniTech purchases software licenses and other technologies frequently for various MiniTech branches across the world. Rajesh transferred the money. Upon asking the MD for the receipts for auditing purposes, the MD replied saying he had not made any such request. Can you prove that this was a fraud? Find out whether the email was actually sent by the MD or if heâ€™s lying!</br>\r\n\r\n<b>Background Information:</b>\r\nMiniTech Pvt. Ltd. is a software solutions company offering comprehensive hardware maintenance services, asset management, software distribution and data backup services. For this, they regularly purchase various network devices, hardware and software. Rajesh, being the CFO, performs wire transfers when the executives of his company request for it. This is a common occurrence in the day to day transactions of the company, and therefore when such an email was received, no suspicions were raised.', 'none ', '30', '2019-02-19'),
(102, 'For Practice', 'System Information', 'An employee A of AppleSoft suddenly handed in his resignation letter to the company. Upon his resignation, the company owned devices that he possessed were checked by an audit team, which mainly included his desktop computer. There were suspicions regarding his resignation and subsequent employment with a competitor, leading to a controversial situation. Digital Investigators were immediately dispatched and sent in to arrange for the formal investigation of the system to search for corroborating evidence in support of the audit teamâ€™s suspicions and findings.\r\nBackground Information: \r\nAppleSoft is a software product development and consulting company with experience in developing software, mobile, web, cloud, and analytics solutions. \r\nThe following is one of the clauses of their Acceptable Use Policy:\r\nData Breach Notifications:\r\nIf employees have downloaded sensitive information to a device that is no longer in their possession, the company may have a legal responsibility to publicly disclose a potential data breach.\r\nFor this reason, employees would not be allowed to download sensitive company information into their personal devices at all. Instead, they will be given access to the information online through a browser or company-defined portal. Due to this policy, there are frequent audits of devices owned by employees to check for any company sensitive information.\r\nEmployee A is a sales executive in AppleSoft. During one such audit, Employee A was found to have a personal pendrive which contained confidential information of AppleSofts clients.\r\n', 'none ', '30', '2019-02-19'),
(103, 'For Practice', 'Network Case', 'Company Dharma Pvt Limited is hosting an e-commerce website since 2010. This website has turned into a massive clothing brand, â€œDharmaâ€. The business has grown exponentially all over the world\r\nSince past few months, the team at Dharma has developed an innovative marketing strategy that focuses on maximum profit potential in the clothing business and was due in two monthsâ€™ time.\r\nLast week, the rival company, Sharma Pvt Limited announced that they are developing a unique, innovative marketing strategy for their clothing business and would be in-effect the following month. \r\nThis announcement made CEO Mr. Dharmesh Bhatia, of Dharma suspicious.\r\nThe two employees of the team have access to the documents and the current plans relating to the strategy.\r\nCEO contacts the IT department at Dharma and the traffic of two employees for the following days is analyzed.\r\n', 'none', '30', '2019-03-02');

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

DROP TABLE IF EXISTS `evidence`;
CREATE TABLE IF NOT EXISTS `evidence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caseid` varchar(500) NOT NULL,
  `file` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evidence`
--

INSERT INTO `evidence` (`id`, `caseid`, `file`) VALUES
(1, '101', 'casefile.doc'),
(2, '102', 'sample.doc'),
(3, '103', 'Ultimate Case Study Example Template Free Download.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `caseid` varchar(400) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `hint` text NOT NULL,
  `qinfo` text NOT NULL,
  `step1` text NOT NULL,
  `step2` text NOT NULL,
  `step3` text NOT NULL,
  `step4` text NOT NULL,
  `step5` text NOT NULL,
  `step6` text NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `caseid`, `question`, `answer`, `hint`, `qinfo`, `step1`, `step2`, `step3`, `step4`, `step5`, `step6`) VALUES
(1, '101', 'Enter the message ID of the message sent by MD Akshar Shah', '20181021084020.CB290D64ED@emkei.cz', 'none', 'Message ID: used to identify each mail, denotes a unique identity of an email. It is a unique string assigned by the mail system when the message is first created and can easily be forged.Further information on message-ID can be found here: https://ro.ecu.edu.au/cgi/viewcontent.cgi?article=1048&amp;context=adf', '', '', '', '', '', ''),
(2, '101', 'Enter the SMTP ID of the received message', 'd12-v6sp1353502pjs', 'none', 'SMTP ID: is a unique identification number by each intermediate relay or gateway server. Important during log file analysis, can help cross verify when an email was present on a server.', '', '', '', '', '', ''),
(3, '101', 'Enter the trace of the mail', 'from emkei.cz (emkei.cz. [46.167.245.206])', 'Trace: When an email is sent to a recipient, it goes through a number of mail servers to reach the final destination. Each time it passes through a mail server, the server\'s IP address and name are added to the Received field of the header. Hence, the first server listed in the trace is the last server the email was at before being delivered to the recipient. This is the trace. Reading it from top to bottom will trace the email from the destination to the source, hence to find the sender server and IP, one must start to read from the bottom.', '', '', '', '', '', '', ''),
(4, '101', 'What does the Received SPF field say?', 'neutral', 'none', 'The Received-SPF field is a trace field which uses SPF email validation protocol. SPF stands for Sender Policy Framework. It is an authentication check on the envelope sender. It authenticates the server, on whether it is allowed to send mail from that address. \'Pass\' means the address is authorized and hence comes from an authorized user. \'Neutral\' indicates that the domain owner has explicitly stated that he cannot or does not want to assert whether or not the IP address is authorized. This means no records were published by that domain and user cannot be authorized. \'Fail\' means the address is not authorized and must be rejected.', '', '', '', '', '', ''),
(5, '101', 'Is the server valid and trustworthy?', 'No', 'Even though the value in the Received-SPF field is Neutral, it means the protocol cannot authorise the user. If the email had been received from the MD&acirc;&euro;&trade;s company website, this server&acirc;&euro;&trade;s domain could have been found to be authorised. Therefore, no, the server is not trustworthy.', '', '', '', '', '', '', ''),
(6, '101', 'What is the name of the source server?', 'emkei.cz', 'Can be found in the trace in the Received field', '', '', '', '', '', '', ''),
(7, '101', 'Hence, was the email actually sent by the MD of MiniTech?', 'No', 'No, the name of the server is emkei.cz, which upon investigation, which is a spoofing email service. This proves that the email did not come from the MD of MiniTech, and was a spoofed email sent by an adversary.', '', '', '', '', '', '', ''),
(8, '101', 'What is the source IP address?', 'IP Address: 46.167.245.206', 'The easiest way for finding the original sender is by looking for the X-Originating-IP header. However, source IP is also identifiable from the email trace. The last IP with server name will be the originating IP.', '', '', '', '', '', '', ''),
(9, '102', 'Enter the MD5 calculated checksum of the USB drive image', 'MD5 - 261d8d42e4ec0e8c2bcd350cf55bf12b', 'Add the USB image as an evidence item, and then explore the options available', '', 'Add the USB image provided to you as an Evidence item, as an Image file.', 'Enter the path where the image is stored.', 'Check the Evidence Tree panel of the screen.', 'Right click on the image and select the option Verify drive image.', 'A dialog box will open that shows the computed hash and verified hash values. Check the field &ldquo;Verify Result&rdquo;. A &ldquo;match&rdquo; means that there was no modification and the integrity of the image (Evidence) is intact.', ''),
(10, '102', 'Enter the SHA1 calculated checksum of the USB drive image', 'SHA1 - b5f14fe86f39044b781b4cfe1eb116866a717cd4', 'Add the USB image as an evidence item, and then explore the options available', '', 'Add the USB image provided to you as an Evidence item, as an Image file.', 'Add the USB image provided to you as an Evidence item, as an Image file.', 'Check the Evidence Tree panel of the screen.', 'Right click on the image and select the option Verify drive image.', 'A dialog box will open that shows the computed hash and verified hash values. Check the field &amp;ldquo;Verify Result&amp;rdquo;. A &amp;ldquo;match&amp;rdquo; means that there was no modification and the integrity of the image (Evidence) is intact.', ''),
(11, '102', 'Enter the files that reveal violation of policy of the company with respect to personal belongings', '1) WA_Sales_Products_2012-14 2) data 3) !s-500', 'Check for files containing company data or file names that reveal any sensitive information', '', 'Click on File. Add the USB drive image as an Evidence Item.', 'Expand the image contents in the Evidence Tree panel. There would be a small + on it&rsquo;s left hand side.', 'Click on root directory. You will now see all files that were present on the USB drive.', 'A red x indicates that the files had been previously deleted.', 'Now click on files that indicate any company sensitive information. The file WA_Sales _Products_2012-14.csv when clicked, shows all the sales information of the company.', 'To recover these files, just right click on the file you want to recover and select the &ldquo;Export&rdquo; option. Export the file to any location on your computer.'),
(12, '102', 'Identify the partition information of USB image', 'Starting Sector: 32 Sector Count: 15,633,376', 'Check properties of Partition', '', '', '', '', '', '', ''),
(13, '103', 'How many IPv4 protocols were captured?', '4 UDP ARP NetBIOS Datagram Service TCP', 'Check for protocol hierarchies of IPv4 in the statistics tab', '', 'Since the sniffer can collect data for hours, we need to know what protocols were captured. In order to know what protocols were captured:</br> 1. Click on Statistics in the menu bar', '2.Click on Protocol Hierarchies', '', '', '', ''),
(14, '103', 'What service/protocol, if present, is used for communicating?', 'SIP', 'Look for a completed SIP Flow and find RTP packets within that flow.', '', '1.When analysing the protocol hierarchy, you will notice that a Session Initiation Protocol was used during the communication. ', '2.Session Initiation Protocol (SIP) is basically an internet telephone call.  RFC &ndash; 3261 [1][2]', '', '', '', ''),
(16, '103', 'Where is ftp .log file stored in Unix systems?', '/var/log/vsftpd.log', 'Find /var/log.', '', 'All the log files are stored in /var/log folder in the Unix systems. The location of ftp log file : /var/log/vsftpd.log In order to view the log file, type in the terminal: cat /var/log/vsftpd.log (or) cat /var/log/vsftpd.log  ftp.log  Above command will copy the contents of the original log file to the a new log file.', '', '', '', '', ''),
(17, '103', 'What fields does the log file contain?', '1)	The timestamp 2)	Process ID 3)	FTP status 4)	Client Operation', 'No hint required for this question.', '', '1)	Open ftp.log file in a text editor  &lt;/br&gt;  The fields of the log file contains: 1)	The timestamp 2)	Process ID 3)	FTP status 4)	Client Operation', '', '', '', '', ''),
(18, '103', 'Names of the users accessing the ftp server?', 'Check Bob and Bob1\'s login state times. ', 'Check Client Field of log file.', '', 'When the log files are analysed the Client field indicates the names of the User&rsquo;s operating the server. Two user&rsquo;s are accessing the server &ndash; Bob and Bob1', '', '', '', '', ''),
(19, '103', 'What is the time difference between the two logins?', '3:35:00', 'Check Bob and Bob1&rsquo;s login state times.', 'Since the time format is hh:mm:ss yyyy, Bob login states : 14:37:23 2018 Where as Bob1 login states 17:12:23 2018 on the same day that is Tuesday October 23, the time difference between the two is 3:35:00', '', '', '', '', '', ''),
(20, '103', 'What is the name of the file that was uploaded and downloaded?', 'todownload.torrent', 'Check the file uploaded between two logins.', 'Between the two logins, we notice that Bob uploads a file called &ldquo;todownload.torrent&rdquo; When Bob1 logs in, he downloads the same file onto his machine. The name of the file was mentioned in the RTP stream above. Since the time between the two is less and the operation performed is on the same day it can be concluded as the second evidence.', '', '', '', '', '', ''),
(15, '103', 'What information was exchanged?', 'RTDump File contents (?)', 'Check RTP Streams that you found in the SIP flow and export the correct stream.', '', '1. Click on Telephony in the menu bar', '2. In the menu, click on SIP Flow', '3. Click on the Flow Sequence button at the bottom', 'Note I have highlighted the second stream because the status of the second stream was COMPLETED.', 'Once the flow is known, it is observed that some RTP packets were exchanged after the call was picked up. In order to find out the RTP payload sent/received:&lt;/br&gt; 1)	 When SIP Flows tab is open, Click on Play Stream&lt;/br&gt;   1)	Since they are RTP packets, click on Telephony in the menu bar 2)	Click on RTP 3)	Click RTP streams  4)	Note I have selected the first stream because it has some value of Payload 5)	Once you select the stream, Click on Export     &lt;/br&gt;  The selected RTP payload will be exported as RTPdump file   &lt;/br&gt;     1)	 When SIP Flows tab is open, Click on Play Stream   &lt;/br&gt;    In order to Export this payload:1)	Since they are RTP packets, click on Telephony in the menu bar 2)	Click on RTP 3)	Click RTP streams 4)	Note I have selected the first stream because it has some value of Payload 5)	Once you select the stream, Click on Export&lt;/br&gt;The selected RTP payload will be exported as RTPdump file', '');

-- --------------------------------------------------------

--
-- Table structure for table `useranswer`
--

DROP TABLE IF EXISTS `useranswer`;
CREATE TABLE IF NOT EXISTS `useranswer` (
  `qid` varchar(300) NOT NULL,
  `pid` varchar(300) NOT NULL,
  `uid` varchar(300) NOT NULL,
  `useranswer` varchar(300) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userregister`
--

DROP TABLE IF EXISTS `userregister`;
CREATE TABLE IF NOT EXISTS `userregister` (
  `uid` int(11) NOT NULL,
  `name` varchar(600) NOT NULL,
  `gender` varchar(80) NOT NULL,
  `age` varchar(100) NOT NULL,
  `contactno` varchar(500) NOT NULL,
  `emailid` varchar(600) NOT NULL,
  `password` varchar(600) NOT NULL,
  `address` varchar(800) NOT NULL,
  `city` varchar(600) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userregister`
--

INSERT INTO `userregister` (`uid`, `name`, `gender`, `age`, `contactno`, `emailid`, `password`, `address`, `city`) VALUES
(1001, 'Ram Mehta', 'Male', '25', '987899909', 'ram@gmail.com', '123', 'Goregaon West', 'Mumbai'),
(1002, 'Sam', 'Male', '25', '55777', 'sam@gmail.com', '123', 'Andheri', 'Mumbai');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

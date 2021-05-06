-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2021 at 11:55 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminid` varchar(11) NOT NULL DEFAULT '',
  `name` varchar(60) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `mobile` int(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `name`, `gender`, `email`, `mobile`, `password`, `creationDate`, `updationDate`) VALUES
('KAUSHIKJR', 'KAUSHIK', 'MALE', 'test@gmail.com', 2147483647, '123', '2020-11-10 10:26:28', '10/11/20 16:05:26 PM');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `userid` varchar(11) NOT NULL DEFAULT '',
  `productid` varchar(11) NOT NULL DEFAULT '',
  `productName` varchar(500) DEFAULT NULL,
  `productQuantity` int(3) DEFAULT NULL,
  `coupon` varchar(3) DEFAULT NULL,
  `couponTag` varchar(10) DEFAULT NULL,
  `productPrice` int(8) DEFAULT NULL,
  `discountPercent` int(4) DEFAULT NULL,
  `discountPrice` int(8) DEFAULT NULL,
  `couponDiscount` int(8) DEFAULT NULL,
  `shippingCharge` int(4) DEFAULT NULL,
  `productFinalPrice` int(8) DEFAULT NULL,
  `productTotalPrice` int(8) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryid` varchar(11) NOT NULL DEFAULT '',
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
('3', 'Books', 'Test anuj', '2017-01-24 19:17:37', '30-01-2017 12:22:24 AM'),
('4', 'Electronics', 'Electronic Products', '2017-01-24 19:19:32', ''),
('5', 'Furniture', 'test', '2017-01-24 19:19:54', ''),
('6', 'Fashion', 'Fashion', '2017-02-20 19:18:52', '');

-- --------------------------------------------------------

--
-- Table structure for table `customerorders`
--

CREATE TABLE IF NOT EXISTS `customerorders` (
  `orderid` varchar(11) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `mobileNo` int(10) DEFAULT NULL,
  `productid` varchar(700) NOT NULL,
  `productName` longtext,
  `quantity` varchar(255) DEFAULT NULL,
  `productPrice` varchar(700) DEFAULT NULL,
  `productDiscountedPrice` varchar(700) DEFAULT NULL,
  `productTotalPrice` varchar(700) DEFAULT NULL,
  `shippingCharge` int(6) DEFAULT NULL,
  `productDiscount` varchar(700) DEFAULT NULL,
  `coupon` varchar(3) DEFAULT NULL,
  `couponTag` varchar(10) DEFAULT NULL,
  `couponDiscount` int(8) DEFAULT NULL,
  `totalPrice` int(8) DEFAULT NULL,
  `shippingAddress` mediumtext,
  `shippingAddressAdditional` mediumtext,
  `shippingCountry` varchar(50) DEFAULT NULL,
  `shippingState` varchar(50) DEFAULT NULL,
  `shippingCity` varchar(50) DEFAULT NULL,
  `shippingPincode` int(6) DEFAULT NULL,
  `billingAddress` mediumtext,
  `billingAddressAdditional` mediumtext,
  `billingCountry` varchar(50) DEFAULT NULL,
  `billingState` varchar(50) DEFAULT NULL,
  `billingCity` varchar(50) DEFAULT NULL,
  `billingPincode` int(6) DEFAULT NULL,
  `orderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateorder` varchar(12) DEFAULT NULL,
  `deliveryDate` varchar(12) DEFAULT NULL,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `paymentStatus` varchar(20) DEFAULT NULL,
  `orderStatus` int(5) DEFAULT NULL,
  `cancelReason` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerorders`
--

INSERT INTO `customerorders` (`orderid`, `userid`, `userName`, `mobileNo`, `productid`, `productName`, `quantity`, `productPrice`, `productDiscountedPrice`, `productTotalPrice`, `shippingCharge`, `productDiscount`, `coupon`, `couponTag`, `couponDiscount`, `totalPrice`, `shippingAddress`, `shippingAddressAdditional`, `shippingCountry`, `shippingState`, `shippingCity`, `shippingPincode`, `billingAddress`, `billingAddressAdditional`, `billingCountry`, `billingState`, `billingCity`, `billingPincode`, `orderDate`, `dateorder`, `deliveryDate`, `paymentMethod`, `paymentStatus`, `orderStatus`, `cancelReason`) VALUES
('ORD_1', 'SP_1', 'kb', 2147483647, 'a:4:{i:0;s:2:"11";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}', 'a:4:{i:0;s:28:"ACER ES 15 PENTIUM QUAD CORE";i:1;s:30:"APPLE IPHONE 6 (SILVER, 16 GB)";i:2;s:43:"REDMI NOTE 4 (GOLD, 32 GB)  (WITH 3 GB RAM)";i:3;s:32:"LENOVO K6 POWER (SILVER, 32 GB) ";}', 'a:4:{i:0;s:1:"1";i:1;s:1:"1";i:2;s:1:"1";i:3;s:1:"1";}', 'a:4:{i:0;s:5:"19990";i:1;s:5:"36990";i:2;s:5:"10999";i:3;s:4:"9999";}', 'a:4:{i:0;s:5:"19990";i:1;s:5:"35140";i:2;s:5:"10449";i:3;s:4:"8999";}', 'a:4:{i:0;s:5:"19990";i:1;s:5:"35140";i:2;s:5:"10449";i:3;s:4:"8999";}', 0, 'a:4:{i:0;s:1:"0";i:1;s:4:"1850";i:2;s:3:"550";i:3;s:4:"1000";}', 'NO', 'NULL', 0, 74578, '123, CANNING STREET', 'OPPOSITE RIFLE ROAD', 'INDIA', 'WEST BENGAL', 'KOLKATA', 700001, '123, CANNING STREET', 'OPPOSITE RIFLE ROAD', 'INDIA', 'WEST BENGAL', 'KOLKATA', 700001, '2020-12-15 15:21:38', '15-12-2020', NULL, 'COD', '0', 7, 'I DONT WANT TO ORDER'),
('ORD_2', 'SP_1', 'kb', 2147483647, 'a:1:{i:0;s:2:"11";}', 'a:1:{i:0;s:28:"ACER ES 15 PENTIUM QUAD CORE";}', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:5:"19990";}', 'a:1:{i:0;s:5:"19990";}', 'a:1:{i:0;s:5:"19990";}', 0, 'a:1:{i:0;s:1:"0";}', 'YES', 'HF100', 100, 19890, '123, CANNING STREET', 'OPPOSITE RIFLE ROAD', 'INDIA', 'WEST BENGAL', 'KOLKATA', 700001, 'E/12C, TAGORE PARK', 'ANURADHA SMRITI BHAVAN', 'INDIA', 'WEST BENGAL', 'KOLKATA', 700039, '2020-12-15 15:21:38', '15-12-2020', NULL, 'COD', '0', 6, 'I DNT WANT'),
('ORD_3', 'SP_1', 'kb', 2147483647, 'a:1:{i:0;s:1:"2";}', 'a:1:{i:0;s:30:"APPLE IPHONE 6 (SILVER, 16 GB)";}', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:5:"36990";}', 'a:1:{i:0;s:5:"35140";}', 'a:1:{i:0;s:5:"35140";}', 0, 'a:1:{i:0;s:4:"1850";}', 'NO', 'NULL', 0, 35140, 'HUBLI', 'ANURADHA SMRITI BHAVAN', 'INDIA', 'ANDAMAN UND NICO.IN.', 'NANDAPUR', 485312, 'SIKAR ROAD NH-11', 'UDAIPURIA MOD', 'INDIA', 'RAJASTHAN', 'JAIPUR', 303807, '2020-12-22 08:30:55', '15-12-2020', NULL, 'DEBIT CARD', '0', 4, 'NULL'),
('ORD_4', 'SP_1', 'kb', 2147483647, 'a:1:{i:0;s:2:"11";}', 'a:1:{i:0;s:28:"ACER ES 15 PENTIUM QUAD CORE";}', 'a:1:{i:0;s:1:"1";}', 'a:1:{i:0;s:5:"19990";}', 'a:1:{i:0;s:5:"19990";}', 'a:1:{i:0;s:5:"19990";}', 0, 'a:1:{i:0;s:1:"0";}', 'YES', 'HFG55', 100, 19890, '123, CANNING STREET', 'ANURADHA SMRITI BHAVAN', 'INDIA', 'WEST BENGAL', 'KOLKATA', 700001, 'E/12C, TAGORE PARK', 'ANURADHA SMRITI BHAVAN', '', 'WEST BENGAL', 'KOLKATA', 700039, '2020-12-22 08:30:55', '15-12-2020', NULL, 'CREDIT CARD', '0', 4, 'I DNT WANT');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE IF NOT EXISTS `enquiry` (
  `enquiryid` varchar(8) NOT NULL,
  `userid` varchar(8) DEFAULT NULL,
  `assignedAdminId` varchar(8) DEFAULT NULL,
  `assignedAdminName` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `subject` mediumtext,
  `message` mediumtext,
  `adminEnquiryFeedback` mediumtext,
  `customerEnquiryFeedback` mediumtext,
  `rating` int(2) DEFAULT NULL,
  `enquiryStatus` int(2) DEFAULT NULL,
  `enquiryOpenDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `openDate` varchar(12) DEFAULT NULL,
  `enquiryAssignedDate` varchar(50) DEFAULT NULL,
  `enquiryClosedDate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiryid`, `userid`, `assignedAdminId`, `assignedAdminName`, `name`, `email`, `mobile`, `subject`, `message`, `adminEnquiryFeedback`, `customerEnquiryFeedback`, `rating`, `enquiryStatus`, `enquiryOpenDate`, `openDate`, `enquiryAssignedDate`, `enquiryClosedDate`) VALUES
('ENQ_1', 'SP_1', 'KAUSHIKJ', 'KAUSHIK', 'JKJKJ', 'kk@kk.com', '5454545455', 'jadkjakj', 'sdddsds', NULL, NULL, NULL, 1, '2020-12-19 10:22:03', NULL, '19-12-2020 14:12:54', NULL),
('ENQ_2', 'SP_1', NULL, NULL, 'JKJKJ', 'kk@kk.com', '5454545455', 'jadkjakj', 'edfefsf', 'issue closed by customer', NULL, NULL, 2, '2020-12-19 10:22:03', NULL, NULL, '19-12-2020 14:12:21'),
('ENQ_3', 'SP_1', '', '', 'JKJKJ', 'kk@kk.com', '5454545455', 'jadkjakj', 'ffffffffffss', NULL, NULL, NULL, 0, '2020-12-19 10:22:03', NULL, '19-12-2020 14:12:54', NULL),
('ENQ_4', 'SP_1', NULL, NULL, 'JKJKJ', 'kk@kk.com', '5454545455', 'jadkjakj', 'hhhhhfff', NULL, NULL, NULL, 0, '2020-12-19 10:22:03', NULL, NULL, NULL),
('ENQ_5', 'SP_1', NULL, NULL, 'JKJKJ', 'kk@kk.com', '5454545455', 'jadkjakj', 'ddfdffdf', NULL, NULL, NULL, 0, '2020-12-19 10:22:03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail_enquiry`
--

CREATE TABLE IF NOT EXISTS `mail_enquiry` (
  `enquiryid` varchar(8) NOT NULL,
  `assignedAdminId` varchar(8) DEFAULT NULL,
  `assignedAdminName` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `subject` mediumtext,
  `message` mediumtext,
  `adminEnquiryFeedback` mediumtext,
  `customerEnquiryFeedback` mediumtext,
  `rating` int(2) DEFAULT NULL,
  `enquiryStatus` int(2) DEFAULT NULL,
  `enquiryOpenDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `openDate` varchar(12) DEFAULT NULL,
  `enquiryAssignedDate` varchar(50) DEFAULT NULL,
  `enquiryClosedDate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mobileverify`
--

CREATE TABLE IF NOT EXISTS `mobileverify` (
  `mobileNo` varchar(10) NOT NULL DEFAULT '',
  `otp` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE IF NOT EXISTS `offers` (
  `offerid` varchar(10) NOT NULL DEFAULT '',
  `offerDetails` mediumtext,
  `offerImage` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offerid`, `offerDetails`, `offerImage`) VALUES
('NOF121', 'Lorem Ipsum', 'banner1.png'),
('NOF122', 'Lorem Ipsum', 'banner2.png'),
('NOF123', 'Lorem Ipsum', 'banner3.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `userid` varchar(10) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `mobileNo` int(10) DEFAULT NULL,
  `productid` varchar(700) NOT NULL,
  `productName` longtext,
  `quantity` varchar(255) DEFAULT NULL,
  `productPrice` varchar(700) DEFAULT NULL,
  `productDiscountedPrice` varchar(700) DEFAULT NULL,
  `productTotalPrice` varchar(700) DEFAULT NULL,
  `shippingCharge` int(6) DEFAULT NULL,
  `productDiscount` varchar(700) DEFAULT NULL,
  `coupon` varchar(3) DEFAULT NULL,
  `couponTag` varchar(10) DEFAULT NULL,
  `couponDiscount` int(8) DEFAULT NULL,
  `totalPrice` int(8) DEFAULT NULL,
  `shippingAddress` mediumtext,
  `shippingAddressAdditional` mediumtext,
  `shippingCountry` varchar(50) DEFAULT NULL,
  `shippingState` varchar(50) DEFAULT NULL,
  `shippingCity` varchar(50) DEFAULT NULL,
  `shippingPincode` int(6) DEFAULT NULL,
  `billingAddress` mediumtext,
  `billingAddressAdditional` mediumtext,
  `billingCountry` varchar(50) DEFAULT NULL,
  `billingState` varchar(50) DEFAULT NULL,
  `billingCity` varchar(50) DEFAULT NULL,
  `billingPincode` int(6) DEFAULT NULL,
  `orderDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paymentMethod` varchar(50) DEFAULT NULL,
  `paymentStatus` varchar(20) DEFAULT NULL,
  `orderStatus` varchar(20) DEFAULT NULL,
  `cancelReason` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `productreviews`
--

CREATE TABLE IF NOT EXISTS `productreviews` (
  `reviewid` varchar(11) DEFAULT NULL,
  `userid` varchar(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `quality` varchar(4) DEFAULT NULL,
  `price` varchar(4) DEFAULT NULL,
  `value` varchar(4) DEFAULT NULL,
  `review` longtext,
  `status` int(1) DEFAULT NULL,
  `reviewDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productreviews`
--

INSERT INTO `productreviews` (`reviewid`, `userid`, `productid`, `productName`, `productImage`, `quality`, `price`, `value`, `review`, `status`, `reviewDate`) VALUES
('REV_1', 'SP_1', 2, 'APPLE IPHONE 6 (SILVER, 16 GB)', 'apple-iphone-6-1.jpeg', '4', '3.5', '2.5', 'awesome service and product', 1, '2020-12-23 07:45:02'),
('REV_2', 'SP_1', 11, 'ACER ES 15 PENTIUM QUAD CORE', 'acer-aspire-notebook-original-1.jpeg', NULL, NULL, NULL, NULL, 0, '2020-12-23 07:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productid` varchar(11) NOT NULL,
  `parentcategoryid` varchar(11) DEFAULT NULL,
  `subcategoryid` varchar(11) DEFAULT NULL,
  `productName` varchar(255) DEFAULT NULL,
  `productCompany` varchar(255) DEFAULT NULL,
  `productDescription` longtext,
  `productImage1` varchar(255) DEFAULT NULL,
  `productImage2` varchar(255) DEFAULT NULL,
  `productImage3` varchar(255) DEFAULT NULL,
  `productPrice` int(11) DEFAULT NULL,
  `discountPercent` int(4) DEFAULT '0',
  `discountPrice` int(8) DEFAULT '0',
  `productFinalPrice` int(11) DEFAULT NULL,
  `shippingCharge` int(11) DEFAULT NULL,
  `productAvailability` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productid`, `parentcategoryid`, `subcategoryid`, `productName`, `productCompany`, `productDescription`, `productImage1`, `productImage2`, `productImage3`, `productPrice`, `discountPercent`, `discountPrice`, `productFinalPrice`, `shippingCharge`, `productAvailability`, `creationDate`, `updationDate`) VALUES
('1', '4', '3', 'MICROMAX 81CM (32) HD READY LED TV  (32T6175MHD, 2 X HDMI, 2 X USB)', 'MICROMAX TEST', '<DIV CLASS="HOUSOY" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; FONT-SIZE: 18PX; WHITE-SPACE: NOWRAP; LINE-HEIGHT: 1.4; COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF;">GENERAL</DIV><UL STYLE="BOX-SIZING: BORDER-BOX; MARGIN-BOTTOM: 0PX; MARGIN-LEFT: 0PX; COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 14PX;"><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);">SALES PACKAGE</DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;">1 TV UNIT, REMOTE CONTROLLER, BATTERY (FOR REMOTE CONTROLLER), QUICK INSTALLATION GUIDE AND USER MANUAL: ALL IN ONE, WALL MOUNT SUPPORT</LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);">MODEL NAME</DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;">32T6175MHD</LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);">DISPLAY SIZE</DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;">81 CM (32)</LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);">SCREEN TYPE</DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;">LED</LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);">HD TECHNOLOGY & RESOLUTIONTEST</DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;">HD READY, 1366 X 768</LI></UL></LI></UL>', 'micromax1.jpeg', 'micromax main image.jpg', 'micromax main image.jpg', 23000, 10, 2300, 20700, 0, 'IN STOCK', '2017-01-30 16:54:35', '0000-00-00 00:00:00'),
('11', '4', '6', 'ACER ES 15 PENTIUM QUAD CORE', 'ACER', '<UL><LI>INTEL PENTIUM QUAD CORE PROCESSOR ( )<BR></LI><LI>4 GB DDR3 RAM<BR></LI><LI>LINUX/UBUNTU OPERATING SYSTEM<BR></LI><LI>1 TB HDD<BR></LI><LI>15.6 INCH DISPLAY<BR></LI></UL>', 'acer-aspire-notebook-original-1.jpeg', 'acer-aspire-notebook-original-2.jpeg', 'acer-aspire-notebook-original-3.jpeg', 19990, 0, 0, 19990, 0, 'IN STOCK', '2017-02-04 04:26:17', '0000-00-00 00:00:00'),
('12', '4', '6', 'MICROMAX CANVAS LAPTAB II (WIFI) ATOM 4TH GEN', 'MICROMAX', '<UL><LI>INTEL ATOM PROCESSOR ( 4TH GEN )<BR></LI><LI>2 GB DDR3 RAM<BR></LI><LI>32 BIT WINDOWS 10 OPERATING SYSTEM<BR></LI><LI>11.6 INCH TOUCHSCREEN DISPLAY<BR></LI></UL>', 'micromax-lt777w-2-in-1-laptop-original-1.jpeg', 'micromax-lt777w-2-in-1-laptop-original-2.jpeg', 'micromax-lt777w-2-in-1-laptop-original-3.jpeg', 10999, 0, 0, 10999, 0, 'IN STOCK', '2017-02-04 04:28:17', '0000-00-00 00:00:00'),
('13', '4', '6', 'HP CORE I5 5TH GEN', 'HP', '<SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">HP CORE I5 5TH GEN - (4 GB/1 TB HDD/WINDOWS 10 HOME/2 GB GRAPHICS) N8M28PA 15-AC123TX NOTEBOOK</SPAN><SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">  (15.6 INCH, TURBO SILVER, 2.19 KG)</SPAN><BR><DIV><UL><LI>INTEL CORE I5 PROCESSOR ( 5TH GEN )<BR></LI><LI>4 GB DDR3 RAM<BR></LI><LI>64 BIT WINDOWS 10 OPERATING SYSTEM<BR></LI><LI>1 TB HDD<BR></LI><LI>15.6 INCH DISPLAY<BR></LI></UL></DIV>', 'hp-notebook-original-1.jpeg', 'hp-notebook-original-2.jpeg', 'hp-notebook-original-3.jpeg', 41990, 0, 0, 41990, 0, 'IN STOCK', '2017-02-04 04:30:24', '0000-00-00 00:00:00'),
('14', '4', '6', 'LENOVO IDEAPAD 110 APU QUAD CORE A6 6TH GEN', 'LENOVO', '<SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">LENOVO IDEAPAD 110 APU QUAD CORE A6 6TH GEN - (4 GB/500 GB HDD/WINDOWS 10 HOME) 80TJ00D2IH IP110 15ACL NOTEBOOK</SPAN><SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">  (15.6 INCH, BLACK, 2.2 KG)</SPAN><BR><DIV><UL><LI>AMD APU QUAD CORE A6 PROCESSOR ( 6TH GEN )<BR></LI><LI>4 GB DDR3 RAM<BR></LI><LI>64 BIT WINDOWS 10 OPERATING SYSTEM<BR></LI><LI>500 GB HDD<BR></LI><LI>15.6 INCH DISPLAY<BR></LI></UL></DIV>', 'lenovo-ideapad-notebook-original-1.jpeg', 'lenovo-ideapad-notebook-original-2.jpeg', 'lenovo-ideapad-notebook-3.jpeg', 22990, 0, 0, 22990, 0, 'IN STOCK', '2017-02-04 04:32:15', '0000-00-00 00:00:00'),
('15', '3', '8', 'THE WIMPY KID DO -IT- YOURSELF BOOK', 'ABC', '<SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">THE WIMPY KID DO -IT- YOURSELF BOOK</SPAN><SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">  (ENGLISH, PAPERBACK, JEFF KINNEY)</SPAN><BR><DIV><UL><LI>LANGUAGE: ENGLISH<BR></LI><LI>BINDING: PAPERBACK<BR></LI><LI>PUBLISHER: PENGUIN BOOKS LTD<BR></LI><LI>ISBN: 9780141339665, 0141339667<BR></LI><LI>EDITION: 1<BR></LI></UL></DIV>', 'diary-of-a-wimpy-kid-do-it-yourself-book-original-1.jpeg', 'diary-of-a-wimpy-kid-do-it-yourself-book-original-1.jpeg', 'diary-of-a-wimpy-kid-do-it-yourself-book-original-1.jpeg', 205, 0, 0, 250, 50, 'IN STOCK', '2017-02-04 04:35:13', '0000-00-00 00:00:00'),
('16', '3', '8', 'THEA STILTON AND THE TROPICAL TREASURE ', 'XYZ', '<UL><LI>LANGUAGE: ENGLISH<BR></LI><LI>BINDING: PAPERBACK<BR></LI><LI>PUBLISHER: SCHOLASTIC<BR></LI><LI>ISBN: 9789351032083, 9351032086<BR></LI><LI>EDITION: 2015<BR></LI><LI>PAGES: 176<BR></LI></UL>', '22-thea-stilton-and-the-tropical-treasure-original-1.jpeg', '22-thea-stilton-and-the-tropical-treasure-original-1.jpeg', '22-thea-stilton-and-the-tropical-treasure-original-1.jpeg', 240, 0, 0, 240, 30, 'IN STOCK', '2017-02-04 04:36:23', '0000-00-00 00:00:00'),
('17', '5', '9', 'INDUSCRAFT SOLID WOOD KING BED WITH STORAGE', 'INDUSCRAFT', '<SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">INDUSCRAFT SOLID WOOD KING BED WITH STORAGE</SPAN><SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">  (FINISH COLOR - HONEY BROWN)</SPAN><BR><DIV><UL><LI>MATERIAL SUBTYPE: ROSEWOOD (SHEESHAM)<BR></LI><LI>W X H X D: 1850 MM X 875 MM X 2057.5 MM<BR></LI><LI>FLOOR CLEARANCE: 8 MM<BR></LI><LI>DELIVERY CONDITION: KNOCK DOWN<BR></LI></UL></DIV>', 'inaf245-queen-rosewood-sheesham-induscraft-na-honey-brown-original-1.jpeg', 'inaf245-queen-rosewood-sheesham-induscraft-na-honey-brown-original-2.jpeg', 'inaf245-queen-rosewood-sheesham-induscraft-na-honey-brown-original-3.jpeg', 32566, 0, 0, 32566, 0, 'IN STOCK', '2017-02-04 04:40:37', '0000-00-00 00:00:00'),
('18', '5', '10', 'NILKAMAL URSA METAL QUEEN BED', 'NILKAMAL', '<SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">@HOME BY NILKAMAL URSA METAL QUEEN BED</SPAN><SPAN STYLE="COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 18PX;">  (FINISH COLOR - NA)</SPAN><BR><DIV><UL><LI>MATERIAL SUBTYPE: CARBON STEEL<BR></LI><LI>W X H X D: 1590 MM X 910 MM X 2070 MM<BR></LI><LI>FLOOR CLEARANCE: 341 MM<BR></LI><LI>DELIVERY CONDITION: KNOCK DOWN<BR></LI></UL></DIV>', 'flbdorsabrqbblk-queen-carbon-steel-home-by-nilkamal-na-na-original-1.jpeg', 'flbdorsabrqbblk-queen-carbon-steel-home-by-nilkamal-na-na-original-2.jpeg', 'flbdorsabrqbblk-queen-carbon-steel-home-by-nilkamal-na-na-original-3.jpeg', 6523, 0, 0, 6523, 0, 'IN STOCK', '2017-02-04 04:42:27', '0000-00-00 00:00:00'),
('19', '6', '12', 'ASIAN CASUALS  (WHITE, WHITE)', 'ASIAN', '<UL STYLE="BOX-SIZING: BORDER-BOX; MARGIN-BOTTOM: 0PX; MARGIN-LEFT: 0PX; COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 14PX;"><LI CLASS="_2-RINZ" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 8PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">COLOUR: WHITE, WHITE</LI><LI CLASS="_2-RINZ" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 0PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">OUTER MATERIAL: DENIM</LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);"><BR></DIV></LI></UL>', '1.jpeg', '2.jpeg', '3.jpeg', 379, 0, 0, 379, 45, 'IN STOCK', '2017-03-10 20:16:03', '0000-00-00 00:00:00'),
('2', '4', '4', 'APPLE IPHONE 6 (SILVER, 16 GB)', 'APPLE INC', '<DIV CLASS="_2PF8IO" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX 0PX 0PX 110PX; PADDING: 0PX; FLEX: 1 1 0%; COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 14PX;"><UL STYLE="BOX-SIZING: BORDER-BOX; MARGIN-BOTTOM: 0PX; MARGIN-LEFT: 0PX;"><LI CLASS="_1TMFKH" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 8PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">1 GB RAM | 16 GB ROM |</LI><LI CLASS="_1TMFKH" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 8PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">4.7 INCH RETINA HD DISPLAY</LI><LI CLASS="_1TMFKH" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 8PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">8MP PRIMARY CAMERA | 1.2MP FRONT</LI><LI CLASS="_1TMFKH" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 8PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">LI-ION BATTERY</LI><LI CLASS="_1TMFKH" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 8PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">A8 CHIP WITH 64-BIT ARCHITECTURE AND M8 MOTION CO-PROCESSOR PROCESSOR</LI></UL></DIV>', 'apple-iphone-6-1.jpeg', 'apple-iphone-6-2.jpeg', 'apple-iphone-6-3.jpeg', 36990, 5, 1850, 35140, 0, 'IN STOCK', '2017-01-30 16:59:00', '0000-00-00 00:00:00'),
('20', '6', '12', 'ADIDAS MESSI 16.3 TF FOOTBALL TURF SHOES  (BLUE)', 'ADIDAS', '<UL STYLE="BOX-SIZING: BORDER-BOX; MARGIN-BOTTOM: 0PX; MARGIN-LEFT: 0PX; COLOR: RGB(33, 33, 33); FONT-FAMILY: ROBOTO, ARIAL, SANS-SERIF; FONT-SIZE: 14PX;"><LI CLASS="_2-RINZ" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 8PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">COLOUR: BLUE</LI><LI CLASS="_2-RINZ" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 0PX 16PX; LIST-STYLE: NONE; POSITION: RELATIVE;">CLOSURE: LACED</LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);"><B>WEIGHT</B></DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;"><B>200 G (PER SINGLE SHOE) - WEIGHT OF THE PRODUCT MAY VARY DEPENDING ON SIZE.</B></LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);"><B>STYLE</B></DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;"><B>PANEL AND STITCH DETAIL, TEXTURED DETAIL</B></LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);"><B>TIP SHAPE</B></DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;"><B>ROUND</B></LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 0PX 16PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);"><B>SEASON</B></DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;"><B>AW16</B></LI></UL></LI><LI CLASS="_1KUY3T ROW" STYLE="BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE; DISPLAY: FLEX; FLEX-FLOW: ROW WRAP; WIDTH: 731PX;"><DIV CLASS="VMXPRI COL COL-3-12" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX 8PX 0PX 0PX; WIDTH: 182.75PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; COLOR: RGB(135, 135, 135);"><B>CLOSURE</B></DIV><UL CLASS="_3DG3IX COL COL-9-12" STYLE="BOX-SIZING: BORDER-BOX; MARGIN-LEFT: 0PX; WIDTH: 548.25PX; DISPLAY: INLINE-BLOCK; VERTICAL-ALIGN: TOP; LINE-HEIGHT: 1.4;"><LI CLASS="SNQDOG" STYLE="TEXT-ALIGN: LEFT; BOX-SIZING: BORDER-BOX; MARGIN: 0PX; PADDING: 0PX; LIST-STYLE: NONE;"><B>LACED</B></LI></UL></LI></UL>', '1.jpeg', '2.jpeg', '3.jpeg', 4129, 0, 0, 4129, 0, 'IN STOCK', '2017-03-10 20:19:22', '0000-00-00 00:00:00'),
('3', '4', '4', 'REDMI NOTE 4 (GOLD, 32 GB)  (WITH 3 GB RAM)', 'REDMI', '<BR><DIV><OL><LI>3 GB RAM | 32 GB ROM | EXPANDABLE UPTO 128 GB<BR></LI><LI>5.5 INCH FULL HD DISPLAY<BR></LI><LI>13MP PRIMARY CAMERA | 5MP FRONT<BR></LI><LI>4100 MAH LI-POLYMER BATTERY<BR></LI><LI>QUALCOMM SNAPDRAGON 625 64-BIT PROCESSOR<BR></LI></OL></DIV>', 'mi-redmi-note-4-1.jpeg', 'mi-redmi-note-4-2.jpeg', 'mi-redmi-note-4-3.jpeg', 10999, 5, 550, 10449, 0, 'IN STOCK', '2017-02-04 04:03:15', '0000-00-00 00:00:00'),
('4', '4', '4', 'LENOVO K6 POWER (SILVER, 32 GB) ', 'LENOVO', '<UL><LI>3 GB RAM | 32 GB ROM | EXPANDABLE UPTO 128 GB<BR></LI><LI>5 INCH FULL HD DISPLAY<BR></LI><LI>13MP PRIMARY CAMERA | 8MP FRONT<BR></LI><LI>4000 MAH LI-POLYMER BATTERY<BR></LI><LI>QUALCOMM SNAPDRAGON 430 PROCESSOR<BR></LI></UL>', 'lenovo-k6-power-k33a42-1.jpeg', 'lenovo-k6-power-k33a42-2.jpeg', 'lenovo-k6-power-k33a42-3.jpeg', 9999, 10, 1000, 8999, 0, 'IN STOCK', '2017-02-04 04:04:43', '0000-00-00 00:00:00'),
('5', '4', '4', 'LENOVO VIBE K5 NOTE (GOLD, 32 GB)  ', 'LENOVO', '<UL><LI>3 GB RAM | 32 GB ROM | EXPANDABLE UPTO 128 GB<BR></LI><LI>5.5 INCH FULL HD DISPLAY<BR></LI><LI>13MP PRIMARY CAMERA | 8MP FRONT<BR></LI><LI>3500 MAH LI-ION POLYMER BATTERY<BR></LI><LI>HELIO P10 64-BIT PROCESSOR<BR></LI></UL>', 'lenovo-k5-note-pa330010in-1.jpeg', 'lenovo-k5-note-pa330116in-2.jpeg', 'lenovo-k5-note-pa330116in-3.jpeg', 11999, 0, 0, 11999, 0, 'IN STOCK', '2017-02-04 04:06:17', '0000-00-00 00:00:00'),
('6', '4', '4', 'MICROMAX CANVAS MEGA 4G', 'MICROMAX', '<UL><LI>3 GB RAM | 16 GB ROM |<BR></LI><LI>5.5 INCH HD DISPLAY<BR></LI><LI>13MP PRIMARY CAMERA | 5MP FRONT<BR></LI><LI>2500 MAH BATTERY<BR></LI><LI>MT6735 PROCESSOR<BR></LI></UL>', 'micromax-canvas-mega-4g-1.jpeg', 'micromax-canvas-mega-4g-2.jpeg', 'micromax-canvas-mega-4g-3.jpeg', 6999, 0, 0, 6999, 35, 'IN STOCK', '2017-02-04 04:08:07', '0000-00-00 00:00:00'),
('7', '4', '4', 'SAMSUNG GALAXY ON5', 'SAMSUNG', '<UL><LI>1.5 GB RAM | 8 GB ROM | EXPANDABLE UPTO 128 GB<BR></LI><LI>5 INCH HD DISPLAY<BR></LI><LI>8MP PRIMARY CAMERA | 5MP FRONT<BR></LI><LI>2600 MAH LI-ION BATTERY<BR></LI><LI>EXYNOS 3475 PROCESSOR<BR></LI></UL>', 'samsung-galaxy-on7-sm-1.jpeg', 'samsung-galaxy-on5-sm-2.jpeg', 'samsung-galaxy-on5-sm-3.jpeg', 7490, 6, 449, 7041, 20, 'IN STOCK', '2017-02-04 04:10:17', '0000-00-00 00:00:00'),
('8', '4', '4', 'OPPO A57', 'OPPO', '<UL><LI>3 GB RAM | 32 GB ROM | EXPANDABLE UPTO 256 GB<BR></LI><LI>5.2 INCH HD DISPLAY<BR></LI><LI>13MP PRIMARY CAMERA | 16MP FRONT<BR></LI><LI>2900 MAH BATTERY<BR></LI><LI>QUALCOMM MSM8940 64-BIT PROCESSOR<BR></LI></UL>', 'oppo-a57-na-original-1.jpeg', 'oppo-a57-na-original-2.jpeg', 'oppo-a57-na-original-3.jpeg', 14990, 0, 0, 14990, 0, 'IN STOCK', '2017-02-04 04:11:54', '0000-00-00 00:00:00'),
('9', '4', '5', 'AFFIX BACK COVER FOR MI REDMI NOTE 4', 'TECHGURU', '<UL><LI>SUITABLE FOR: MOBILE<BR></LI><LI>MATERIAL: POLYURETHANE<BR></LI><LI>THEME: NO THEME<BR></LI><LI>TYPE: BACK COVER<BR></LI><LI>WATERPROOF<BR></LI></UL>', 'amzer-amz98947-original-1.jpeg', 'amzer-amz98947-original-2.jpeg', 'amzer-amz98947-original-3.jpeg', 259, 2, 5, 254, 40, 'IN STOCK', '2017-02-04 04:17:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `subcategoryid` varchar(11) NOT NULL,
  `parentcategoryid` int(11) DEFAULT NULL,
  `parentcategoryName` varchar(50) DEFAULT NULL,
  `subcategoryName` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategoryid`, `parentcategoryid`, `parentcategoryName`, `subcategoryName`, `creationDate`, `updationDate`) VALUES
('10', 5, NULL, 'Sofas', '2017-02-04 04:37:02', ''),
('11', 5, NULL, 'Dining Tables', '2017-02-04 04:37:51', ''),
('12', 6, NULL, 'Men Footwears', '2017-03-10 20:12:59', ''),
('2', 4, NULL, 'Led Television', '2017-01-26 16:24:52', '26-01-2017 11:03:40 PM'),
('3', 4, NULL, 'Television', '2017-01-26 16:29:09', ''),
('4', 4, NULL, 'Mobiles', '2017-01-30 16:55:48', ''),
('5', 4, NULL, 'Mobile Accessories', '2017-02-04 04:12:40', ''),
('6', 4, NULL, 'Laptops', '2017-02-04 04:13:00', ''),
('7', 4, NULL, 'Computers', '2017-02-04 04:13:27', ''),
('8', 3, NULL, 'Comics', '2017-02-04 04:13:54', ''),
('9', 5, NULL, 'Beds', '2017-02-04 04:36:45', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `userid` varchar(8) DEFAULT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `userEmail` varchar(50) DEFAULT NULL,
  `userIp` varchar(16) DEFAULT NULL,
  `loginTime` varchar(10) DEFAULT NULL,
  `logoutTime` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`userid`, `userName`, `userEmail`, `userIp`, `loginTime`, `logoutTime`, `status`) VALUES
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '14:31:37', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '15:29:27', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '13:57:24', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '14:35:48', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '14:47:32', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '16:03:44', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '10:23:40', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '11:16:21', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '13:52:47', NULL, 1),
('SP_1', 'kb', 'kk@kk.com', '10.129.7.157', '12:20:35', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `emailVerified` int(1) DEFAULT '0',
  `contactno` varchar(10) DEFAULT NULL,
  `verifiedMobile` int(1) DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `shippingAddress` varchar(500) DEFAULT NULL,
  `shippingCountry` varchar(20) DEFAULT NULL,
  `shippingState` varchar(50) DEFAULT NULL,
  `shippingCity` varchar(20) DEFAULT NULL,
  `shippingPincode` int(11) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `emailVerified`, `contactno`, `verifiedMobile`, `password`, `shippingAddress`, `shippingCountry`, `shippingState`, `shippingCity`, `shippingPincode`, `regDate`, `updationDate`) VALUES
('SP_1', 'kb', 'kk@kk.com', 0, '8583882749', 0, '123', '123, CANNING STREET', 'INDIA', 'WEST BENGAL', 'KOLKATA', 700001, '2020-11-05 09:52:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `userid` varchar(11) NOT NULL,
  `productid` varchar(11) NOT NULL,
  `productName` varchar(500) DEFAULT NULL,
  `productPrice` int(8) DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`userid`, `productid`, `productName`, `productPrice`, `postingDate`) VALUES
('SP_1', '11', 'ACER ES 15 PENTIUM QUAD CORE', 19990, '2020-12-11 07:15:39'),
('SP_1', '2', 'APPLE IPHONE 6 (SILVER, 16 GB)', 36990, '2020-12-11 07:13:36'),
('SP_1', '3', 'REDMI NOTE 4 (GOLD, 32 GB)  (WITH 3 GB RAM)', 10999, '2020-12-11 07:15:29'),
('SP_1', '4', 'LENOVO K6 POWER (SILVER, 32 GB) ', 9999, '2020-12-11 07:15:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`userid`,`productid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `customerorders`
--
ALTER TABLE `customerorders`
 ADD PRIMARY KEY (`orderid`,`userid`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
 ADD PRIMARY KEY (`enquiryid`);

--
-- Indexes for table `mail_enquiry`
--
ALTER TABLE `mail_enquiry`
 ADD PRIMARY KEY (`enquiryid`);

--
-- Indexes for table `mobileverify`
--
ALTER TABLE `mobileverify`
 ADD PRIMARY KEY (`mobileNo`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
 ADD PRIMARY KEY (`offerid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `productreviews`
--
ALTER TABLE `productreviews`
 ADD PRIMARY KEY (`productid`,`userid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
 ADD PRIMARY KEY (`subcategoryid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
 ADD PRIMARY KEY (`userid`,`productid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

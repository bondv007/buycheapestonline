-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2015 at 02:16 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `buychea1_buychea1`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE IF NOT EXISTS `Admins` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `AdminEmail` varchar(100) DEFAULT NULL,
  `IsSite_Manage` tinyint(1) DEFAULT '1',
  `IsCoupon_Manage` tinyint(1) DEFAULT '1',
  `IsWebsite_Manage` tinyint(1) DEFAULT '1',
  `IsTag_Manage` tinyint(1) DEFAULT '1',
  `IsComment_Manage` tinyint(1) DEFAULT '1',
  `IsAccount_Manage` tinyint(1) DEFAULT '1',
  `IsPage_Manage` tinyint(1) DEFAULT '1',
  `AdminPassword` varchar(50) DEFAULT NULL,
  `IsEnable` tinyint(1) DEFAULT '1',
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AdminID`),
  UNIQUE KEY `AdminEmail` (`AdminEmail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Admins`
--

INSERT INTO `Admins` (`AdminID`, `AdminEmail`, `IsSite_Manage`, `IsCoupon_Manage`, `IsWebsite_Manage`, `IsTag_Manage`, `IsComment_Manage`, `IsAccount_Manage`, `IsPage_Manage`, `AdminPassword`, `IsEnable`, `DateAdded`) VALUES
(1, 'admin', 1, 1, 1, 1, 1, 1, 1, 'fdcaa0f9b47d9e42f5a43b9a527dd45f', 1, '2010-02-22 14:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) DEFAULT NULL,
  `EmailAddress` varchar(150) DEFAULT NULL,
  `Comments` text,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IsApproved` tinyint(1) DEFAULT '0',
  `CouponID` int(11) DEFAULT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `CouponID` (`CouponID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Coupon`
--

CREATE TABLE IF NOT EXISTS `Coupon` (
  `CouponID` int(11) NOT NULL AUTO_INCREMENT,
  `CouponCode` varchar(100) DEFAULT NULL,
  `CountSuccess` int(11) DEFAULT '0',
  `CountFail` int(11) DEFAULT '0',
  `Hits` int(11) DEFAULT '0',
  `IsApproved` tinyint(1) DEFAULT '1',
  `IsFeatured` tinyint(1) DEFAULT '0',
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Discount` decimal(10,2) DEFAULT NULL,
  `Description` text,
  `WebsiteID` int(11) DEFAULT NULL,
  `Expiry` int(11) DEFAULT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `CouponLink` varchar(255) NOT NULL,
  PRIMARY KEY (`CouponID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Coupon`
--

INSERT INTO `Coupon` (`CouponID`, `CouponCode`, `CountSuccess`, `CountFail`, `Hits`, `IsApproved`, `IsFeatured`, `DateAdded`, `Discount`, `Description`, `WebsiteID`, `Expiry`, `StartDate`, `EndDate`, `CouponLink`) VALUES
(2, 'W20', 1, 0, 0, 1, 1, '2015-04-06 21:29:12', NULL, '20% Off All Costumes $25+', 637, NULL, '0000-00-00', '0000-00-00', ''),
(3, 'X15', 0, 0, 0, 1, 1, '2015-04-07 19:25:07', NULL, '15% off costumes priced $20 or more', 637, NULL, '0000-00-00', '0000-00-00', ''),
(4, 'PSC25', 0, 0, 0, 1, 1, '2015-04-07 19:25:39', NULL, '25% OFF PERSONALIZED ITEMS', 637, NULL, '0000-00-00', '0000-00-00', ''),
(5, 'PSC5', 0, 0, 0, 1, 1, '2015-04-07 19:26:13', NULL, '5% OFF AND FREE SHIPPING ON ORDERS $100 OR MORE', 637, NULL, '0000-00-00', '0000-00-00', ''),
(6, 'FIRST10', 0, 0, 0, 1, 1, '2015-04-07 19:44:17', NULL, 'FIRST ORDER 10% OFF', 639, 60, '2015-04-07', '2015-06-30', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=280480.369&type=3&subid=0'),
(7, 'SALE15', 0, 0, 0, 1, 1, '2015-04-07 19:52:41', NULL, '15% OFF $25+ COSTUMES', 640, NULL, '0000-00-00', '0000-00-00', ''),
(8, 'PARTYTEN', 0, 0, 0, 1, 1, '2015-04-07 20:21:42', NULL, '10% OFF ALL PARTY SUPPLIES', 642, NULL, '0000-00-00', '0000-00-00', ''),
(9, 'BDAY20', 0, 0, 0, 1, 1, '2015-04-07 20:22:08', NULL, '20% off all personalized orders', 642, NULL, '0000-00-00', '0000-00-00', ''),
(10, 'BDAY60', 0, 0, 0, 1, 1, '2015-04-07 20:22:31', NULL, 'Free Shipping on orders over $60', 642, NULL, '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `Link_Footer`
--

CREATE TABLE IF NOT EXISTS `Link_Footer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Link` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Link_Footer`
--

INSERT INTO `Link_Footer` (`ID`, `Link`, `Name`) VALUES
(11, 'http://www.moneysaving.deals', 'Terms Of Use'),
(12, 'http://www.moneysaving.deals', 'Disclaimer');

-- --------------------------------------------------------

--
-- Table structure for table `MarketingAdManager`
--

CREATE TABLE IF NOT EXISTS `MarketingAdManager` (
  `MarketingAdID` int(11) NOT NULL AUTO_INCREMENT,
  `MarketingScript` text,
  `MarketingPlacing` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`MarketingAdID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Newsletter`
--

CREATE TABLE IF NOT EXISTS `Newsletter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `date_aplic` datetime NOT NULL,
  `date_register` datetime NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Newsletter`
--

INSERT INTO `Newsletter` (`ID`, `email`, `ip`, `date_aplic`, `date_register`, `code`) VALUES
(1, 'sgilbertson80@gmail.com', '67.83.58.146', '2015-04-06 19:06:53', '2015-04-07 09:32:28', '228941089');

-- --------------------------------------------------------

--
-- Table structure for table `PageManager`
--

CREATE TABLE IF NOT EXISTS `PageManager` (
  `PageManagerID` int(11) NOT NULL AUTO_INCREMENT,
  `PageName` varchar(100) DEFAULT NULL,
  `PageContents` text,
  `IncludeFooter` tinyint(1) DEFAULT NULL,
  `IncludeHeader` tinyint(1) DEFAULT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PageManagerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `PageManager`
--

INSERT INTO `PageManager` (`PageManagerID`, `PageName`, `PageContents`, `IncludeFooter`, `IncludeHeader`, `DateAdded`) VALUES
(1, 'How To Do It', '<p>This 2 minute reading will teach you how to use <strong>Coupon Site Script</strong>. The fact that you know how to use it will save and money you time in the future.<br /><br /><strong>A fact about shopping</strong><br />When you are buying items or services online you can make 2 steps in only one:<br />-&nbsp;&nbsp;&nbsp; Get what you want;<br />-&nbsp;&nbsp;&nbsp; Save money in the same time.<br />In the checkout process many online stores will have a field where you can enter a coupon or a discount code. This means that you&rsquo;ll get something in exchange:<br />-&nbsp;&nbsp;&nbsp; Free shipping<br />-&nbsp;&nbsp;&nbsp; Save money<br />-&nbsp;&nbsp;&nbsp; Get something else for free.<br /><br />At <strong>Coupon Site Script</strong> we even simplified the process and included sites that sustain:<br />&ldquo;... promotion are rare because we give you the lowest prices available everyday&ldquo;.<br />That is why we include websites, with no coupon or discount offers, only because they have the lowest price on the market.<br />An example what the means:<br />If a website has a coupon that saves you 10$ and the product is 99$ that means you will get the product with 89$.<br />A site with no coupon but with the lowest price on the market has the same product at the price of 85$.<br /><br /><strong>Instructions</strong><br />Step1: You want to buy from videowhisper.com or simply videowhisper<br />Step2: You visit <a href=\\"\\\\\\"><strong>http://www.couponsitescript.com</strong></a><br />Step3: In the search section you enter the title website from step1<br />Step4: Any coupon available for this store will now be shown.<br />Step5: Choose the coupon code that best fit you and click on it. Just paste the code ( that already copied ) in the payment process.<br />Following the five steps will save you money and get you great discount or bonus!<br /><br /></p>', 0, 1, '2010-11-02 16:33:45'),
(2, 'Contact', '<p>For any ideas and suggestions<em><strong> </strong></em>contact us at</p>\r\n<p>&nbsp;</p>\r\n<p><strong><a title=\\"Contact us on Facebook\\" href=\\"https://www.facebook.com/moneysaving.deals.online\\" target=\\"_self\\">Facebook </a>or <a title=\\"Contact us on Twitter\\" href=\\"https://twitter.com/@MoneysavingDs\\" target=\\"_self\\">Twitter</a></strong></p>', 0, 1, '2015-04-06 21:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `SEF_URL`
--

CREATE TABLE IF NOT EXISTS `SEF_URL` (
  `SEF_URL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(200) DEFAULT NULL,
  `EntityType` varchar(50) DEFAULT NULL,
  `EntityID` int(11) DEFAULT NULL,
  PRIMARY KEY (`SEF_URL_ID`),
  UNIQUE KEY `URL` (`URL`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=667 ;

--
-- Dumping data for table `SEF_URL`
--

INSERT INTO `SEF_URL` (`SEF_URL_ID`, `URL`, `EntityType`, `EntityID`) VALUES
(2, 'Contact', 'StaticPage', 2),
(1, 'How-To-Do-It', 'StaticPage', 1),
(255, 'TechDepot.com', 'Website', 253),
(256, 'InviteHealth.com', 'Website', 254),
(257, 'HonestFlorist.com', 'Website', 255),
(258, 'MagicKitchen.com', 'Website', 256),
(259, 'CurrentLabels.com', 'Website', 257),
(260, 'TextBookX.com', 'Website', 258),
(261, 'SierraClub.org', 'Website', 259),
(262, 'SmartHome.com', 'Website', 260),
(263, 'Fye.com', 'Website', 261),
(264, 'IonizerOasis.com', 'Website', 262),
(265, 'MusicNotes.com', 'Website', 263),
(266, 'TheKaraokeChannel.com', 'Website', 264),
(267, 'PhysicalAddictions.com', 'Website', 265),
(268, 'CurrentCatalog.com', 'Website', 266),
(269, 'ArtisticLabels.com', 'Website', 267),
(270, 'StarsTruck.com', 'Website', 268),
(271, 'HostelBookers.com', 'Website', 269),
(272, 'WorldSoccerShop.com', 'Website', 270),
(273, 'HomeRunMonkey.com', 'Website', 271),
(274, 'Gowfb.com', 'Website', 272),
(275, 'HotelsCombined.com', 'Website', 273),
(276, 'BathAndBed.com', 'Website', 274),
(277, 'SimpleFloors.com', 'Website', 275),
(278, 'TotalPetSupply.com', 'Website', 276),
(279, 'VitaminMenu.com', 'Website', 277),
(280, 'PremiumSeatsUsa.com', 'Website', 278),
(281, 'Mate1.com', 'Website', 279),
(282, 'OnlyNaturalPet.com', 'Website', 280),
(283, 'MyChelle.com', 'Website', 281),
(284, 'HotelClub.com', 'Website', 282),
(285, 'GolfEtail.com', 'Website', 283),
(286, '300dpi.com', 'Website', 284),
(287, 'SkinCubed.com', 'Website', 285),
(288, 'PetSmart.com', 'Website', 286),
(289, 'GourmetGiftBaskets.com', 'Website', 287),
(290, 'WindAndWeather.com', 'Website', 288),
(291, 'EqualExchange.com', 'Website', 289),
(292, 'CheapOStay.com', 'Website', 290),
(293, 'CwiMedical.com', 'Website', 291),
(294, '525America.com', 'Website', 292),
(295, 'GiftsForYouNow.com', 'Website', 293),
(599, 'Beauty.com', 'Website', 597),
(639, 'coffee', 'Tag', 1),
(640, 'gourmet-coffee', 'Tag', 2),
(641, 'fresh-roasted-coffee', 'Tag', 3),
(642, 'CostumeSuperCenter.com', 'Website', 637),
(643, 'GIRLS', 'Tag', 4),
(644, 'POPULAR', 'Tag', 5),
(645, 'COSTUMES', 'Tag', 6),
(647, 'Satellite-Internet', 'Tag', 7),
(648, 'Broadband-Satellite', 'Tag', 8),
(649, 'abhair.com', 'Website', 639),
(650, 'hair', 'Tag', 9),
(651, 'extensions', 'Tag', 10),
(652, 'hair-extensions', 'Tag', 11),
(653, 'AnytimeCostumes.com', 'Website', 640),
(654, 'halloween', 'Tag', 12),
(655, 'kids-costumes', 'Tag', 13),
(656, 'ChemicalGuys.com', 'Website', 641),
(657, 'Auto', 'Tag', 14),
(658, 'detailing', 'Tag', 15),
(659, 'buffing-supplies', 'Tag', 16),
(660, 'beauty-supplies', 'Tag', 17),
(661, 'shopping-Cosmetics', 'Tag', 18),
(662, 'beauty-products', 'Tag', 19),
(663, 'BirthdayinaBox.com', 'Website', 642),
(664, 'party-supplies', 'Tag', 20),
(665, 'birthday', 'Tag', 21),
(666, 'kids-party', 'Tag', 22);

-- --------------------------------------------------------

--
-- Table structure for table `SiteManager`
--

CREATE TABLE IF NOT EXISTS `SiteManager` (
  `SiteVariable` varchar(50) NOT NULL,
  `SiteValue` varchar(500) DEFAULT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SiteVariable`),
  UNIQUE KEY `SiteVariable` (`SiteVariable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SiteManager`
--

INSERT INTO `SiteManager` (`SiteVariable`, `SiteValue`, `DateAdded`) VALUES
('SiteName', 'Welcome to MoneySaving.Deals', '2015-04-06 20:11:48'),
('SiteTitle', 'Welcome to MoneySaving.Deals', '2015-04-06 20:05:45'),
('SiteKeyword', 'code, coupon, discount, free, sale, get, save, off', '2010-02-22 14:36:02'),
('SiteDescription', 'Find great money saving deals today.', '2015-04-06 20:05:45'),
('CurrentSkin', 'NewLook', '2010-08-25 11:07:09'),
('OwnerEmail', 'sgilbertson80@gmail.com', '2015-04-06 20:05:45'),
('IsEditorAllow', '0', '2010-02-22 14:23:30'),
('DefaultStatus', '0', '2010-02-22 14:36:02'),
('DefaultStatusComments', '0', '2010-02-22 14:36:02'),
('RSS', '', '2010-02-22 14:23:30'),
('SignupAuthentication', '1', '2010-02-22 14:23:30'),
('GoogleAnalytics', '<script>\r\n  (function(i,s,o,g,r,a,m){i[\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\''GoogleAnalyticsObject\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\', '2015-04-06 23:18:40'),
('SiteVersion', '1.0', '2010-10-25 12:49:34'),
('TagDescription', '', '2010-11-02 11:34:41'),
('DaysToExpire', '10', '2010-02-22 14:23:30'),
('PopularStoresHome', '15', '2010-07-26 14:52:15'),
('FeaturedStoresHome', '10', '2010-02-22 14:23:30'),
('FeaturedCouponsHome', '10', '2010-02-22 14:23:30'),
('NewCouponsHome', '5', '2010-09-10 09:21:10'),
('RegistrationEmail', '', '2010-02-22 14:23:30'),
('ADConfirmationEmail', '', '2010-02-22 14:23:30'),
('SendToFriendEmail', 'Hello {Friend_Name} \n Your friend {Sender_Name} wants you to visit {URL} \n He has requested from {Sender_Email} to your email {Friend_Email}', '2010-02-22 14:23:30'),
('IsSiteClose', '0', '2015-04-06 23:05:36'),
('SocialNet_Twitter', 'https://twitter.com/@MoneysavingDs', '2015-04-06 20:07:48'),
('SocialNet_FaceBook', 'https://www.facebook.com/moneysaving.deals.online', '2015-04-06 20:07:48'),
('SocialNet_Delicious', NULL, '2010-11-04 20:37:32'),
('SocialNet_Digg', NULL, '2010-03-31 22:20:52'),
('SocialNet_Linkedin', NULL, '2010-03-04 18:25:31'),
('SocialNet_Reddit', NULL, '2010-03-04 18:25:31'),
('SocialNet_Stumbleupon', NULL, '2010-03-04 18:25:31'),
('SocialNet_Newsvine', NULL, '2010-03-04 18:25:31'),
('SocialNet_Googlebookmarks', NULL, '2010-03-04 18:25:31'),
('SocialNet_Technorati', NULL, '2010-03-04 18:25:31'),
('DelayCPost', '30', '2010-06-23 16:42:52'),
('DelayOPost', '30', '2010-06-23 16:42:52'),
('DelayTPost', '30', '2010-06-24 10:21:20'),
('DelayTUpdate', '720', '2010-06-24 10:21:36'),
('TwitterText', 'Code Coupon', '2010-10-25 12:49:34'),
('TagSEOTitle', '', '2010-11-02 11:35:29'),
('TagSEOKeyword', '', '2010-11-02 11:35:29'),
('RssMaxStoreRecords', '25', '2011-03-17 10:06:59'),
('RssTitle', '', '2011-03-17 14:47:55'),
('RssDescription', 'Rss feed for coupons and offers', '2011-03-17 10:09:38'),
('RssMaxGeneralRecords', '50', '2011-03-17 10:08:04'),
('RssTextLink', 'Offer taken from ', '2011-03-18 10:47:25'),
('DelayBPost', '30', '2011-05-27 10:06:59'),
('BloggerEmail', 'xyz@blogger.com', '2011-04-27 14:47:55'),
('RecordsPerPage', '100', '2015-04-27 17:20:55'),
('DelayB1Post', NULL, '2011-06-07 10:37:38'),
('Blog1Email', NULL, '2011-06-07 10:37:09'),
('Blog1Link', NULL, '2011-07-06 10:59:01'),
('DelayB2Post', NULL, '2011-06-11 09:23:31'),
('Blog2Email', NULL, '2011-06-11 09:23:25'),
('Blog2Link', NULL, '2011-07-06 10:59:26'),
('DelayB3Post', NULL, '2011-06-11 09:18:40'),
('Blog3Email', NULL, '2011-06-11 09:18:40'),
('Blog3Link', NULL, '2011-07-06 10:59:26'),
('BloggerEmail1', NULL, '2011-06-07 09:40:24'),
('BloggerEmail2', NULL, '2011-06-07 09:35:24'),
('BloggerEmail3', NULL, '2011-06-07 09:35:24'),
('BloggerLink1', NULL, '2011-07-06 10:50:58'),
('BloggerLink2', NULL, '2011-07-06 10:50:58'),
('BloggerLink3', NULL, '2011-07-06 10:50:58'),
('DelayWPost', NULL, '2011-07-09 21:10:36'),
('WordpressEmail', NULL, '2011-07-09 21:05:32'),
('WordpressLink', NULL, '2011-07-09 21:05:32'),
('DelayPPost', NULL, '2011-07-11 10:16:47'),
('PosterousEmailTo', NULL, '2011-07-06 12:03:35'),
('PosterousEmailFrom', NULL, '2011-07-06 12:03:00'),
('PosterousLink', NULL, '2011-07-06 12:03:11'),
('DelayTumblrPost', NULL, '2011-07-12 08:13:49'),
('TumblrEmail', NULL, '2011-07-12 08:13:49'),
('TumblrLink', NULL, '2011-07-12 08:14:01'),
('LinkshareToken', 'asdfsdfkl', '2015-04-07 20:44:27'),
('DelayYPost', '60', '2012-07-31 19:32:05'),
('DelayFlPost', '60', '2012-07-01 19:32:05'),
('FlickrEmailFrom', '', '2012-06-27 17:21:46'),
('FlickrEmailTo1', '', '2012-07-07 00:12:12'),
('FlickrLink1', '', '2012-07-06 23:18:20'),
('FlickrEmailTo2', '  ', '2012-06-28 16:28:24'),
('FlickrLink2', '', '2012-06-28 16:28:39'),
('FlickrEmailTo3', '  ', '2012-06-28 16:28:24'),
('FlickrLink3', '', '2012-06-28 16:28:39'),
('FlickrEmailTo4', '  ', '2012-06-28 16:28:24'),
('FlickrLink4', '', '2012-06-28 16:28:39'),
('FlickrEmailTo5', '  ', '2012-06-28 16:28:24'),
('FlickrLink5', '', '2012-06-28 16:28:39'),
('FlickrEmailTo6', '  ', '2012-06-28 16:28:24'),
('FlickrLink6', '', '2012-06-28 16:28:39'),
('FlickrEmailTo7', '  ', '2012-06-28 16:28:24'),
('FlickrLink7', '', '2012-06-28 16:28:39'),
('FlickrEmailTo8', '  ', '2012-06-28 16:28:24'),
('FlickrLink8', '', '2012-06-28 16:28:39'),
('FlickrEmailTo9', '  ', '2012-06-28 16:28:24'),
('FlickrLink9', '', '2012-06-28 16:28:39'),
('FlickrEmailTo10', '  ', '2012-06-28 16:28:24'),
('FlickrLink10', '', '2012-06-28 16:28:39'),
('YoutubeEmailFrom', '', '2012-07-31 17:21:46'),
('YoutubeEmailTo1', '', '2012-08-01 00:12:12'),
('YoutubeLink1', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo2', '', '2012-08-01 00:12:12'),
('YoutubeLink2', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo3', '', '2012-08-01 00:12:12'),
('YoutubeLink3', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo4', '', '2012-08-01 00:12:12'),
('YoutubeLink4', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo5', '', '2012-08-01 00:12:12'),
('YoutubeLink5', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo6', '', '2012-08-01 00:12:12'),
('YoutubeLink6', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo7', '', '2012-08-01 00:12:12'),
('YoutubeLink7', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo8', '', '2012-08-01 00:12:12'),
('YoutubeLink8', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo9', '', '2012-08-01 00:12:12'),
('YoutubeLink9', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo10', '', '2012-08-01 00:12:12'),
('YoutubeLink10', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo11', '', '2012-08-01 00:12:12'),
('YoutubeLink11', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo12', '', '2012-08-01 00:12:12'),
('YoutubeLink12', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo13', '', '2012-08-01 00:12:12'),
('YoutubeLink13', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo14', '', '2012-08-01 00:12:12'),
('YoutubeLink14', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo15', '', '2012-08-01 00:12:12'),
('YoutubeLink15', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo16', '', '2012-08-01 00:12:12'),
('YoutubeLink16', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo17', '', '2012-08-01 00:12:12'),
('YoutubeLink17', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo18', '', '2012-08-01 00:12:12'),
('YoutubeLink18', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo19', '', '2012-08-01 00:12:12'),
('YoutubeLink19', '', '2012-07-31 23:18:20'),
('YoutubeEmailTo20', '', '2012-08-01 00:12:12'),
('YoutubeLink20', '', '2012-07-31 23:18:20'),
('DelayYSPost', '60', '2012-07-31 19:32:05'),
('YoutubeStoresEmailFrom', '', '2012-07-31 17:21:46'),
('YoutubeStoresEmailTo1', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink1', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo2', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink2', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo3', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink3', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo4', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink4', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo5', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink5', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo6', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink6', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo7', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink7', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo8', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink8', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo9', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink9', '', '2012-07-31 23:18:20'),
('YoutubeStoresEmailTo10', '', '2012-08-01 00:12:12'),
('YoutubeStoresLink10', '', '2012-07-31 23:18:20'),
('ExpiredOffersDaysRemain', '365', '2012-12-05 10:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `Tag`
--

CREATE TABLE IF NOT EXISTS `Tag` (
  `TagID` int(11) NOT NULL AUTO_INCREMENT,
  `TagName` varchar(100) DEFAULT NULL,
  `TagDescription` text,
  `SEOTitle` varchar(200) DEFAULT NULL,
  `SEOKeyword` varchar(200) DEFAULT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`TagID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `Tag`
--

INSERT INTO `Tag` (`TagID`, `TagName`, `TagDescription`, `SEOTitle`, `SEOKeyword`, `DateAdded`) VALUES
(1, 'coffee', '', '', '', '2015-04-06 20:44:31'),
(2, 'gourmet coffee', '', '', '', '2015-04-06 20:44:31'),
(3, 'fresh roasted coffee', '', '', '', '2015-04-06 20:44:31'),
(4, 'GIRLS', '', '', '', '2015-04-06 20:56:03'),
(5, 'POPULAR', '', '', '', '2015-04-06 20:56:03'),
(6, 'COSTUMES', '', '', '', '2015-04-06 20:56:03'),
(7, 'Satellite Internet', '', '', '', '2015-04-07 18:43:54'),
(8, 'Broadband Satellite', '', '', '', '2015-04-07 18:43:54'),
(9, 'hair', '', '', '', '2015-04-07 19:37:13'),
(10, 'extensions', '', '', '', '2015-04-07 19:37:13'),
(11, 'hair extensions', '', '', '', '2015-04-07 19:37:13'),
(12, 'halloween', '', '', '', '2015-04-07 19:50:01'),
(13, 'kids costumes', '', '', '', '2015-04-07 19:50:01'),
(14, 'Auto', '', '', '', '2015-04-07 19:58:22'),
(15, 'detailing', '', '', '', '2015-04-07 19:58:22'),
(16, 'buffing supplies', '', '', '', '2015-04-07 19:58:22'),
(17, 'beauty supplies', '', '', '', '2015-04-07 20:09:24'),
(18, 'shopping Cosmetics', '', '', '', '2015-04-07 20:09:24'),
(19, 'beauty products', '', '', '', '2015-04-07 20:09:24'),
(20, 'party supplies', '', '', '', '2015-04-07 20:18:33'),
(21, 'birthday', '', '', '', '2015-04-07 20:18:33'),
(22, 'kids party', '', '', '', '2015-04-07 20:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `Tag_Offers`
--

CREATE TABLE IF NOT EXISTS `Tag_Offers` (
  `Tag_OffersID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferTitle` varchar(200) DEFAULT NULL,
  `Description` text,
  `LandingPage` varchar(200) DEFAULT NULL,
  `Image` varchar(100) DEFAULT NULL,
  `TagID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Tag_OffersID`),
  KEY `TagID` (`TagID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TwitterAccount`
--

CREATE TABLE IF NOT EXISTS `TwitterAccount` (
  `TwitterAccountID` int(11) NOT NULL AUTO_INCREMENT,
  `User` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `ConsumerKey` varchar(100) NOT NULL,
  `ConsumerSecret` varchar(100) NOT NULL,
  `UserToken` varchar(100) NOT NULL,
  `UserSecret` varchar(100) NOT NULL,
  `Type` tinyint(3) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`TwitterAccountID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `VotingLog`
--

CREATE TABLE IF NOT EXISTS `VotingLog` (
  `VotingID` int(11) NOT NULL AUTO_INCREMENT,
  `IP` varchar(100) DEFAULT NULL,
  `CouponID` int(11) DEFAULT NULL,
  `VotingValue` int(11) DEFAULT '0',
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`VotingID`),
  KEY `CouponID` (`CouponID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `VotingLog`
--

INSERT INTO `VotingLog` (`VotingID`, `IP`, `CouponID`, `VotingValue`, `DateAdded`) VALUES
(1, '38.122.158.130', 2, 1, '2015-04-06 21:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `Website`
--

CREATE TABLE IF NOT EXISTS `Website` (
  `WebsiteID` int(11) NOT NULL AUTO_INCREMENT,
  `WebsiteTitle` varchar(100) DEFAULT NULL,
  `WebsiteName` varchar(100) DEFAULT NULL,
  `WebsiteURL` varchar(200) DEFAULT NULL,
  `Description` text,
  `AffilateURL` varchar(200) DEFAULT NULL,
  `SEOTitle` varchar(200) DEFAULT NULL,
  `SEOKeyword` varchar(200) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '0',
  `IsFeatured` tinyint(1) DEFAULT NULL,
  `SearchKeywords` text,
  `DateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Views` int(11) DEFAULT '0',
  `CjID` int(11) NOT NULL,
  `ShareasaleID` int(11) NOT NULL,
  `LinkshareID` int(11) NOT NULL,
  `RegnowID` int(11) NOT NULL,
  `GanID` int(11) NOT NULL,
  PRIMARY KEY (`WebsiteID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=643 ;

--
-- Dumping data for table `Website`
--

INSERT INTO `Website` (`WebsiteID`, `WebsiteTitle`, `WebsiteName`, `WebsiteURL`, `Description`, `AffilateURL`, `SEOTitle`, `SEOKeyword`, `IsActive`, `IsFeatured`, `SearchKeywords`, `DateAdded`, `Views`, `CjID`, `ShareasaleID`, `LinkshareID`, `RegnowID`, `GanID`) VALUES
(253, 'TechDepot.com', 'TechDepot.com', '', '     One-Source purchasing for technology and office supplies      ; Expert Account Management teams specializing in technology solutions for business      ; U.S. based customer service and support      ; Unparalleled selection of hard-to-find products      ; Business Services including installation, maintenance and recycling programs      ; A comprehensive distribution network, including virtual and instock inventory, allowing for 98% immediate product availability      ; Flexible procurement options including equipment leasing and payment plans', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=41019.10000001&type=3&subid=0', 'Tech Depot coupon code. Get coupons, deals, promo, offers, voucher, discount codes for TechDepot.com', 'technology, hardware, software, storage, networking, services, accesories', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(254, 'InviteHealth.com', 'InviteHealth.com', '', 'The scientific team at InViteÂ® Health analyzes the latest scientific information. This information is used to create our products and also to advise our clients. This is why we are very special and why you need us for maintaining your health.    The InViteÂ® Health team is made up of dedicated Nutritionists, Naturopathic Doctors and Pharmacists they bring you the most important health information and the finest products available today. You can sit across the desk from one of these professionals at each of our InViteÂ® Health retail locations.  These professionals are highly skilled at guiding you through the selection of our supplements so that you can choose the most appropriate products for your lifestyle; a custom fit. ', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=196052&type=3&subid=0', 'Invite Health coupon code. Get coupons, deals, promo, offers, voucher, discount codes for InviteHealth.com', 'vitamins, store, health, medication, supplements ', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(255, 'HonestFlorist.com', 'HonestFlorist.com', '', 'We created Honest Florist to make ordering flowers simple and easy, honest!    We strive to ensure that Honest Florist operates just like a real, brick and mortar flower shop. For example, you can show us what flowers you want from another florist with our Price Comparison Tool or even use Upload an Image to send us a photo of what you are looking for. Weâ€™ll most likely be able to save you money on that purchase. You can even negotiate your price (Raise/Lower This Price) so you control exactly what your order will cost you.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=170937&type=3&subid=0', 'Honest Florist coupon code. Get coupons, deals, promo, offers, voucher, discount codes for HonestFlorist.com', 'flowers, plants,Freshness, ', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(256, 'MagicKitchen.com', 'MagicKitchen.com', '', 'MagicKitchen.com chefs prepare healthy, nutritious meals delivered nationwide. We have great meal plans for seniors or busy families, and the meals make great gifts!', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=183278&type=3&subid=0', 'Magic Kitchen coupon code. Get coupons, deals, promo, offers, voucher, discount codes for MagicKitchen.com', 'Chef-prepared meals, meal delivery, prepared meals, prepared meal, prepared food, gourmet meals, gourmet food, meals delivered, food delivered, senior meals, diabetic meals, low sodium meals', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(257, 'CurrentLabels.com', 'CurrentLabels.com', '', 'Current Labels! Our products are designed to make your life easier and to show your unique style!  Youll find address labels, address stamps, pet tags, stationery, personalized pencils, personalized address labels, personalized address stamps, business cards, calling cards and more - which can all be personalized for you, or to give as a gift!  We offer many designs to choose from, all value priced so you wont break the bank.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=130095&type=3&subid=0', 'Current Labels coupon code. Get coupons, deals, promo, offers, voucher, discount codes for CurrentLabels.com', 'name and address labels, pet tags, stationery, greeting cards, address stamps, mini printers, calling cards, business cards, designer labels, image labels, dispensers, clearance items', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(258, 'TextBookX.com', 'TextBookX.com', '', 'TextbookX.com sells new and used textbooks, reference titles, and bestsellers at discounts 10% to 80% off retail prices.  Buy cheap used textbooks on our marketplace, and earn 200% more for textbook buyback. Free shipping over $49.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=20738&type=3&subid=0', 'Text Book X coupon code. Get coupons, deals, promo, offers, voucher, discount codes for TextBookX.com', 'textbook, textbooks, used textbook, used textbooks, buy textbooks, sell textbooks, textbook buyback, cheap textbooks, textbook marketplace, used books, buy textbooks, sell textbooks, text books', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(259, 'SierraClub.org', 'SierraClub.org', '', 'The Sierra Club is Americas oldest, largest, and most influential grassroots environmental organization.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=46111&type=3&subid=0', 'Sierra Club coupon code. Get coupons, deals, promo, offers, voucher, discount codes for SierraClub.org', 'sierra club, parks, healthy, energy solutions, wild places', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(260, 'SmartHome.com', 'SmartHome.com', '', 'Since our first catalog was mailed out in 1992, our goal at Smarthome has been to offer homeowners and contractors the widest selection of affordable electronic home improvement and home automation products possible. Over the years, Smarthome has grown from a distributor of technical products to one of the worlds largest home automation retailers, becoming a single, easy-to-use source for thousands of affordable lighting, security, and home entertainment products that the average do-it-yourselfer can safely install.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=173444&type=3&subid=0', 'Smart Home coupon code. Get coupons, deals, promo, offers, voucher, discount codes for SmartHome.com', 'Home Automation, Remote Control, Lighting Control, Audio IR Distribution, Video IR Distribution, Surveillance, Security', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(261, 'Fye.com', 'Fye.com', '', 'Fye.com - New & Used DVDs, CDs, Games, Books, and Electronics', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=132481&type=3&subid=0', 'Fye coupon code. Get coupons, deals, promo, offers, voucher, discount codes for Fye.com', 'music, dvd, blu-ray, games, electronics, used', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(262, 'IonizerOasis.com', 'IonizerOasis.com', '', 'Buy Water Ionizers, Replacement Filters &amp; Accessories. FREE Gifts with the Tyent MMP-7070 Turbo, IonQuench 8080, Jupiter Orion, Life 8100 &amp; More! 888 760 0902', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=198983&type=3&subid=0', 'Ionizer Oasis coupon code. Get coupons, deals, promo, offers, voucher, discount codes for IonizerOasis.com', 'water ionizers, kyk genesis, tyent mmp-7070 turbo, tyent mmp-7070, jupiter orion, kangen water, replacement filters', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(263, 'MusicNotes.com', 'MusicNotes.com', '', 'Instantly download sheet music and guitar tab from the largest catalog of official and licensed digital sheet music. Also browse traditional sheet music songbooks.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=90283&type=3&subid=0', 'Music Notes coupon code. Get coupons, deals, promo, offers, voucher, discount codes for MusicNotes.com', 'sheet music,free sheetmusic,sheet music,free,sheet,music,downloads,music notes,scores,piano,guitar,sheet,violin,saxophone,drums,percussion,clarinet,flute,cello,trumpet,bass guitar,lessons,sheet,music', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(264, 'TheKaraokeChannel.com', 'TheKaraokeChannel.com', '', 'The KARAOKE Channel is the ultimate KARAOKE experience. 4 ways to experience KARAOKE at its best: Karaoke Online Community, Karaoke for Mobile, Karaoke Download Store and KARAOKE on TV.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=197793&type=3&subid=0', 'The Karaoke Channel coupon code. Get coupons, deals, promo, offers, voucher, discount codes for TheKaraokeChannel.com', 'Stingray, Media, Group,24-hour,Karaoke,channel,download,online,hardware,music,songs,musical,genres,ipod,video,dvd,player,singing,fun', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(265, 'PhysicalAddictions.com', 'PhysicalAddictions.com', '', 'Physical Addictions is a nutrition company with world class service. We deliver the highest quality of Xtend, IGF-1, No Shotgun, Fucothin, Slimquick Cleanse, Stacker2, Zencore, Nutrex Vitrix, Super Cissus, Fire Caps, No Synthesize and Stacker 2, at fair and competitive prices.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=176621&type=3&subid=0', 'Physical Addictions coupon code. Get coupons, deals, promo, offers, voucher, discount codes for PhysicalAddictions.com', 'Xtend, IGF-1, No Shotgun, Fucothin, Slimquick Cleanse, Stacker2, Zencore, Nutrex Vitrix, Super Cissus, Fire Caps, No Synthesize, Stacker 2, Solus', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(266, 'CurrentCatalog.com', 'CurrentCatalog.com', '', 'Today Current USA, Inc., is a multi-brand direct marketing company with more than 2,000 products and millions of customers. Yet the company still retains its friendly family feeling. And, while we still have a fundraising division, most of our products are sold directly to consumers who enjoy keeping in touch with their family and friends. Youll discover Current is your best source for unique, thoughtful, affordable gifts, warmhearted cards for everyone, and the thickest, peekproof gift wrap around. Theyre the perfect products to keep on hand, so youll always be prepared for any special occasion that pops up. We invite you to start stocking your Current closet" today! "', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=136731&type=3&subid=0', 'Current Catalog coupon code. Get coupons, deals, promo, offers, voucher, discount codes for CurrentCatalog.com', 'marketing, company,postcards , campaign , greeting cards, recipe cards', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(267, 'ArtisticLabels.com', 'ArtisticLabels.com', '', 'Artistic Labels! Our products are designed to make your life easier and to show your unique style!  Youll find address labels, address stamps, pet tags, stationery, personalized pencils, personalized address labels, personalized address stamps, business cards, calling cards and more - which can all be personalized for you, or to give as a gift!  We offer many designs to choose from, all value priced so you wont break the bank.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=134643&type=3&subid=0', 'Artistic Labels coupon code. Get coupons, deals, promo, offers, voucher, discount codes for ArtisticLabels.com', 'name and address labels, pet tags, stationery, greeting cards, address stamps, mini printers, calling cards, business cards, designer labels, image labels, dispensers, clearance items', 0, NULL, NULL, '2015-04-06 19:55:04', 1, 0, 0, 0, 0, 0),
(268, 'StarsTruck.com', 'StarsTruck.com', '', 'Unrivaled selection of Sports Products at Star Struck. Plus great prices on NFL Products & MLB Products. Most of our officially licensed NBA Products, NHL Products and NCAA Products ship same day. Youll love our service and selection on Pro and College Products.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=194369&type=3&subid=0', 'Stars Truck coupon code. Get coupons, deals, promo, offers, voucher, discount codes for StarsTruck.com', 'nfl, nhl, NCAA, nba, mlb, Sports Products', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(269, 'HostelBookers.com', 'HostelBookers.com', '', 'Hostels & cheap hotel accommodation available in over 100 countries worldwide. Students, backpackers and budget travelers get the best prices for youth hostels and budget hostel accommodation.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=184383&type=3&subid=0', 'Hostel Bookers coupon code. Get coupons, deals, promo, offers, voucher, discount codes for HostelBookers.com', 'hostels, hostel, cheap hotel, backpacker hostel, youth hostel, youth hostels, student hostels, backpacker hostels, london, rome, paris, new york, student travel, cheap hotels, cheap beds, cheap hostel', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(270, 'WorldSoccerShop.com', 'WorldSoccerShop.com', '', 'World Soccer Shop is the world premier destination for soccer gear. Shop soccer jerseys, soccer shoes, soccer t-shirts, soccer equipment, and more. Gear for World Cup 2010, Champions League, Premier League, MLS, Serie A, Bundesliga, FIFA Federations and more.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=202977&type=3&subid=0', 'World Soccer Shop coupon code. Get coupons, deals, promo, offers, voucher, discount codes for WorldSoccerShop.com', 'soccer, soccer jersey, soccer shoes, cleats, soccer store, soccer shirt, manchester united, real madrid, world cup 2010, fifa, chelsea fc, world cup soccer, adidas soccer, nike soccer, south africa', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(271, 'HomeRunMonkey.com', 'HomeRunMonkey.com', '', 'Get the baseball bat that gives you the edge.  Make one of our baseball bats yours today and dominate the ball park tomorrow!', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=192915&type=3&subid=0', 'Home Run Monkey coupon code. Get coupons, deals, promo, offers, voucher, discount codes for HomeRunMonkey.com', 'Easton baseball bat,  Adult Baseball Bat', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(272, 'Gowfb.com', 'Gowfb.com', '', 'Contemporary Furniture at Wholesale Furniture Brokers.  Find bedroom furniture, living room furniture, dining room furniture, home office furniture, patio furniture, and kids furniture at GoWFB.com.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=183824.10000001&type=4&subid=0', 'Gowfb coupon code. Get coupons, deals, promo, offers, voucher, discount codes for Gowfb.com', 'bedroom furniture, living room furniture, formal dining room furniture', 0, NULL, NULL, '2015-04-06 19:55:04', 1, 0, 0, 0, 0, 0),
(273, 'HotelsCombined.com', 'HotelsCombined.com', '', 'Hotels Combined is a price comparison service for hotels. We search all major accommodation websites and compares rates. We also provide hotel information, reviews and maps.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=163355&type=3&subid=0', 'Hotels Combined coupon code. Get coupons, deals, promo, offers, voucher, discount codes for HotelsCombined.com', 'Hotels Combined,compare hotel price,accommodation reservations', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(274, 'BathAndBed.com', 'BathAndBed.com', '', 'To our customers, the name, Uniquely Yours, means many things. It means shopping from one of the most unique and innovative collections of products available anywhere in the world. It is an assurance of the highest quality. It means customer service, second to none, provided by dedicated professionals who are willing to go the extra step.    It is our mission to enhance our customers lives by bringing them unique products that they need or further enhance their lifestyle. It eliminates the need to comparison shop by providing them with, not only the best products in the marketplace, but information supporting the reasons why these products are truly the best.    The kind of dedication to excellence has been our mission since we first opened our doors. It began in 1994 when Tony Jacobs, had a vision to bring the finest bed and bath items the world had to offer to people in Southwestern Ontario. Then in 1998 we brought what people in Southwestern Ontario, loved and brought it to the world by the way of the Internet. ', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=199789&type=3&subid=0', 'Bath And Bed coupon code. Get coupons, deals, promo, offers, voucher, discount codes for BathAndBed.com', 'unique, innovative, pillow, home fashion', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(275, 'SimpleFloors.com', 'SimpleFloors.com', '', 'Simplefloors.com will help you find the best Laminate Flooring, Cork Flooring, Bamboo Flooring, Wood Flooring and Hardwood Floors.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=186697&type=3&subid=0', 'Simple Floors coupon code. Get coupons, deals, promo, offers, voucher, discount codes for SimpleFloors.com', 'Laminate Flooring, Cork Flooring, Bamboo Flooring, Wood Flooring, Hardwood Floors', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(276, 'TotalPetSupply.com', 'TotalPetSupply.com', '', 'Pet Drugs Pharmacy: Total Pet Supply offers pet medications online with exceptional service to pet owners across the United States of America.  			', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=178953&type=3&subid=0', 'Total Pet Supply coupon code. Get coupons, deals, promo, offers, voucher, discount codes for TotalPetSupply.com', 'TotalPetSupply,PetMeds,Pet Meds com,Heartgard plus,Heartguard,Frontline, Frontline Plus,Discount Pet Pharmacy,Pet Meds on line,Cheap Pet Drugs', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(277, 'VitaminMenu.com', 'VitaminMenu.com', '', 'VitaminMenu.com has a full menu of health supplements and products to offer our customers.  Our philosophy is to provide various choices for our customers and offer an extensive list of products and excellent customer service.  We hope that after placing your first order you will see what distinguishes VitaminMenu.com from its competitors.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=183758&type=3&subid=0', 'Vitamin Menu coupon code. Get coupons, deals, promo, offers, voucher, discount codes for VitaminMenu.com', 'Vitamins, Supplements, Herbs, Minerals, Homeopathy, Health, Diet, Weight Loss', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(278, 'PremiumSeatsUsa.com', 'PremiumSeatsUsa.com', '', 'PremiumSeatsUSA.com is a leading online ticket agency that specializes in finding its clients the best sports, concert and theater tickets at the best possible prices.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=198997&type=3&subid=0', 'Premium Seats Usa coupon code. Get coupons, deals, promo, offers, voucher, discount codes for PremiumSeatsUsa.com', 'tickets, concert tickets, sports tickets, NFL football tickets, football tickets, baseball tickets, Red Sox tickets, Yankees tickets, Dallas Cowboys tickets, Miami Heat tickets, Hannah Montana tickets', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(279, 'Mate1.com', 'Mate1.com', '', 'Whether youre looking for a long-term relationship, casual date, or just a larger social circle, Mate1.com is the only name you need to know.    Ranked by Comscore MediamatrixÂ® and Neilsen NetratingsÂ® among the top 5 mainstream dating sites on the planet, Mate1.com has over 15 million members, with tens of thousands joining daily. ', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=204100&type=3&subid=0', 'Mate 1 coupon code. Get coupons, deals, promo, offers, voucher, discount codes for Mate1.com', 'dating, relation, female, male, dating site, members, singles, photo, voice profile', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(280, 'OnlyNaturalPet.com', 'OnlyNaturalPet.com', '', 'Only Natural Pet Store - healthy supplies for your dog or cat for holistic health care. Natural dog food, cat food, treats, chews, supplements, organic canine feline products, food, vitamins, medicine, herbs & herbal remedy, homeopathy, flea control, grooming.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=202319&type=3&subid=0', 'Only Natural Pet coupon code. Get coupons, deals, promo, offers, voucher, discount codes for OnlyNaturalPet.com', 'natural, pet, store, only, health, healthy, food, remedy, products, supplies, dog, cat, puppy, kitten, holistic, medicine, herbal, meds, treats, organic, supplements, vitamins, herbs, homeopathy', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 6187, 0, 0, 0),
(281, 'MyChelle.com', 'MyChelle.com', '', 'From vitamin consultant at the retail level to representing a natural products distributor, then years as an independent sales representative for manufacturers of natural remedies and natural skin care, Myra has cultivated a well-rounded knowledge of the skin care industry. As a top sales producer, she successfully conducted many educational trainings and consumer seminars on nutritional supplements and natural skin care.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=197983&type=3&subid=0', 'My Chelle coupon code. Get coupons, deals, promo, offers, voucher, discount codes for MyChelle.com', 'Nature, skin, dermatology, skin care, natural ', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(282, 'HotelClub.com', 'HotelClub.com', '', 'Save more on hotel deals worldwide! No booking fees. Compare 60,000 discount hotels in 134 countries. Earn HotelClub member $. Book now and save!', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=183661&type=3&subid=0', 'Hotel Club coupon code. Get coupons, deals, promo, offers, voucher, discount codes for HotelClub.com', 'hotel, club, hotelclub, hotelclub.net, hotels, reservation, reservations, accommodation, accommodations, rooms, lodging, service, rates, hotels, discounts, cheap, online, travel, booking, information', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(283, 'GolfEtail.com', 'GolfEtail.com', '', 'Discount golf equipment from GolfEtail, featuring cheap golf clubs and deep discounts on brand name golf bags, golf balls, golf gloves, golf shoes, golf accessories, and golf apparel.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=181322&type=3&subid=0', 'Golf Etail coupon code. Get coupons, deals, promo, offers, voucher, discount codes for GolfEtail.com', 'Cheap Golf Clubs, Discount Golf Equipment, Discounted Golf Clubs, Golf Gloves, Golf Shoes, Golf Apparel', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(284, '300dpi.com', '300dpi.com', '', 'DCWV  has been in the scrapbooking industry for 15 years and we have now launched our 300dpi online digital scrapbooking website in 2009 which incorporated Digital Scrapbooking, the eScap App for the iphone where you can make scrapbook pages. 300dpi has easy downloadable products to create online scrapbook pages, gift ideas,tutorials to show you step-by-step how to make your pages and everything you would need to personalize your blog.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=195855&type=3&subid=0', '300 dpi coupon code. Get coupons, deals, promo, offers, voucher, discount codes for 300dpi.com', '300dpi, 300dpi.com, Digital Scrapbooking, eScrap, iPhone, Scrapbooking, Scrapbook Pages, DCWV Inc., Scrapbooking, Bloging, Blogger, Digital Kits, Digital Downloads, Alphabets, Numbers, Blog Graphics', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(285, 'SkinCubed.com', 'SkinCubed.com', '', 'Buy online, highly effective age defying cream with proven results. Also buy anti aging wrinkle cream, anti wrinkle cream, dark eye circles cream and wrinkle reducer.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=202148&type=3&subid=0', 'Skin Cubed coupon code. Get coupons, deals, promo, offers, voucher, discount codes for SkinCubed.com', 'Age defying cream, anti wrinkle cream, anti aging cream, age defying products, dark eye circles cream, wrinkle reducer, anti wrinkle treatment', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(286, 'PetSmart.com', 'PetSmart.com', '', 'PetSmart offers the best pet supplies, services, and expertise to help you care for your pets.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=81005.10000003&type=3&subid=0', 'Pet Smart coupon code. Get coupons, deals, promo, offers, voucher, discount codes for PetSmart.com', 'petsmart, pets mart, pet supplies, pet products, pet supply, pet store, pet stores, pet shop, pet shops', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(287, 'GourmetGiftBaskets.com', 'GourmetGiftBaskets.com', '', 'Authentic Gourmet Gift Baskets, Fruit Baskets, Wine Gift Baskets, and more. Unique, Original, Upscale Gift Baskets at excellent prices.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=193025&type=3&subid=0', 'Gourmet Gift Baskets coupon code. Get coupons, deals, promo, offers, voucher, discount codes for GourmetGiftBaskets.com', 'Gift Baskets, Gourmet Gift Baskets, Wine Gift Baskets, Fruit Baskets, Holiday Gift Baskets, Christmas Gift Baskets, Italian Gift Baskets, Thank You Gift Baskets, Healthy Gift Baskets', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(288, 'WindAndWeather.com', 'WindAndWeather.com', '', 'We have a passion for the weather. We love to study clouds, gauge winds, count raindrops, predict storms, and track every single life-affecting detail. This boundless enthusiasm for all things meteorological began brewing in 1976 when Wind & Weather opened its doors on the beautiful north coast of California. Over three decades later, were drenched in industry knowledge and experience, and recognized as a world-trusted supplier of weather instruments.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=183748&type=3&subid=0', 'Wind And Weather coupon code. Get coupons, deals, promo, offers, voucher, discount codes for WindAndWeather.com', 'Wind and Weather, Weather, Home, Garden Products', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(289, 'EqualExchange.com', 'EqualExchange.com', '', 'Equal Exchange Online Store: Fair Trade Coffee, Tea, Chocolate and Snacks.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=188930&type=3&subid=0', 'Equal Exchange coupon code. Get coupons, deals, promo, offers, voucher, discount codes for EqualExchange.com', 'buy fair trade, fair trade, organic, fair trade coffee, fair trade products, fair trade chocolate, fair trade tea, fair trade cocoa, Equal Exchange', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(290, 'CheapOStay.com', 'CheapOStay.com', '', 'Cheap Hotels - Make hotel reservations online with CheapOstay and get cheap hotels booking rates. Find best discount hotels and rooms accommodation on over 100,000 properties.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=196032&type=3&subid=0', 'Cheap O Stay coupon code. Get coupons, deals, promo, offers, voucher, discount codes for CheapOStay.com', 'Cheap Hotels, Cheap Hotel Reservations, Cheap Hotel Rates, Cheap Hotel Rooms, Best Hotel Rates, Discounted Hotels, Cheap Discount Hotels, Discount Hotel Rooms, Hotel Reservations, Hotel Rooms, Hotels', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(291, 'CwiMedical.com', 'CwiMedical.com', '', 'CWI Medical, LLC and our diverse community profits by transforming ordinary interactions into extraordinary relationships which result in the creation of opportunities for everyone to have their need for quality healthcare products and services fulfilled.  ', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=186605&type=3&subid=0', 'Cwi Medical coupon code. Get coupons, deals, promo, offers, voucher, discount codes for CwiMedical.com', 'Medical Supplies, Health Care Products, health, wellness, nutritional supplements, enteral formulas, incontinence products, durable medical equipment, supplies, aids', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(292, '525America.com', '525America.com', '', 'In 1985, founder Bobby Bock had an idea for a sweater; a quality knitted top for women that was thick, rich, oversized, and produced domestically. It didnt exist. He set to work producing it, and in the 20 years since has transformed 525 America into a thriving lifestyle brand whose hallmark is distinctive knit tops for women, renowned for comfort, color, diversity, and youthful attitude. We are always catching the trend before it hits the curve and not after', ' says Bock, whose three company divisions feature styles that utilize the most current shapes and modern fabrics, and continue to pursue the hip and comfortable" principles that have made 525 America ', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=198182&type=3&subid=0', '525 America coupon code. Get coupons, deals, promo, offers, voucher, discount codes for 525america.com', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(293, 'GiftsForYouNow.com', 'GiftsForYouNow.com', '', 'Find the best personalized gifts and personalized gift ideas at www.GiftsForYouNow.com Your home for Personalized Gifts For All Occasions, with personalized gifts for everyone in your family. We specialize in Valentines Day Gifts,Birthday Gifts, Wedding Gifts, fathers Day Gifts, graduation Gifts,Personalized Baby Gifts &amp; Mothers Day Gifts. We have Gifts for Sisters, Gifts for Mom, Gifts For Dad &amp; Personalized Gifts for Grandparents. Personalized Gifts make the greatest impression for Mothers Day, Fathers Day, Valentines Day, Christmas, birthdays &amp; Weddings. We helps you celebrate the gifts of all your children and grandchildren with our unique personalized gifts for all gift giving occasions. Gifts For You LLC provides personalized gifts that make great gifts for Valentines Day Gifts, St Patricks Day Gifts, Easter Gifts, Mothers Day Gifts, Fathers Day Gifts, Grandparents Day Gifts, Sweetest Day Gifts, Halloween Gifts, Thanksgiving Gifts and Christmas Gifts. Shop Gifts For You LLC for your other personalized gifts for childrens gifts, new baby gifts, religious gifts, wedding gifts, birthday gifts,memorial gifts, pet gifts, christening gifts, graduation gifts, friendship gifts and sister gifts. All of the items at Gifts For You LLC include free personalization. Our complete selection of personalized gifts can be personalized for Mom, Dad, Grandma, Grandpa, Nana, Aunt or whatever you call that someone special in your life. We Specialize in Personalized Christmas Gifts &amp; Personalized Christmas Ornaments, Personalized Sweetest Day Gifts &amp; Personalized Halloween Gifts.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=130019&type=3&subid=0', 'Gifts For You Now coupon code. Get coupons, deals, promo, offers, voucher, discount codes for GiftsForYouNow.com', 'Personalized Gifts, Personalized Birthday gifts, personalized wedding gifts, Fathers day gifts, Irish Gifts, Memorial Gifts, Personalized Golf Gifts, Personalized Photo Gifts, Teacher Gifts', 0, NULL, NULL, '2015-04-06 19:55:04', 0, 0, 0, 0, 0, 0),
(597, 'Beauty.com', 'Beauty.com', '', 'Shop for prestige cosmetics, fragrances, makeup, skin care, hair care and gifts. Expert advice on beauty tips and perfumes.', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000728&type=3&subid=0', 'Beauty coupon code. Get coupons, deals, promo, offers, voucher, discount codes for Beauty.com', 'beauty supplies, shopping Cosmetics, beauty products, makeup, cosmetics, discount perfume, fragrances, makeover, Calvin Klein, skin care, moisturizers, creams, cosmetic, make up, oil, cologne, blush ', 1, 1, NULL, '2015-04-06 19:55:05', 50, 0, 0, 0, 0, 0),
(637, 'CostumeSuperCenter.com', 'CostumeSuperCenter.com', NULL, 'GIRLS POPULAR COSTUMES UNDER $20 COST\r\n', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000166&type=3&subid=0', 'GIRLS POPULAR COSTUMES UNDER $20 COST', 'GIRLS,POPULAR,COSTUMES, UNDER $20 COST', 1, 1, NULL, '2015-04-06 20:56:03', 106, 0, 0, 0, 0, 0),
(639, 'abhair.com', 'abhair.com', NULL, 'The hair extension experts! \r\nMake Everyday a Great Hair Day With abHair.com!\r\nabHair.com is online human hair extensions shop. Depending on the professional manufacture plant in China, we sell various hair extensions with high quality but low price across the world.', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=280480.368&type=3&subid=0', 'Save 10% off on your first order, plus free shipping. Use code FIRST10 ', 'hair,extensions,hair extensions', 1, 1, NULL, '2015-04-07 19:37:12', 47, 0, 0, 0, 0, 0),
(640, 'AnytimeCostumes.com', 'AnytimeCostumes.com', NULL, 'Huge selection of Adult, Kids, and Plus size Halloween costumes, hats, accessories, wigs and masks.', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.31&type=3&subid=0', '15% OFF ORDERS $50+ - USE CODE TREAT15', 'costumes,halloween,kids costumes,adult costumes,sexy costumes,masks', 1, 1, NULL, '2015-04-07 19:50:01', 53, 0, 0, 0, 0, 0),
(641, 'ChemicalGuys.com', 'ChemicalGuys.com', NULL, 'Chemical Guys offers the largest selection of car care chemicals, body shop detailing supplies, professional accessories, buffing pad systems and machines. Our extensive manufacturing background has enabled us to become one of the leading design, development and manufacturing facilities for many OEMs and Private Labelers.', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.8&type=3&subid=0', 'ChemicalGuys.com Auto Detailing Best Sellers', 'Auto,detailing,buffing supplies', 1, 1, NULL, '2015-04-07 19:58:22', 42, 0, 0, 0, 0, 0),
(642, 'BirthdayinaBox.com', 'BirthdayinaBox.com', NULL, 'Since 1996, weve been helping parents host memorable, affordable, fun, and educational parties. We know how time-consuming it can be to put together a birthday party, which is why we deliver high-quality, theme-related birthday party favors, supplies, piÃ±atas, and personalized items directly to our customers doors.', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=288426.7&type=3&subid=0', 'Kids Birthday Party Supplies & Kids Party Ideas at Birthday in a Box', 'party supplies,birthday,kids party,costumes', 1, NULL, NULL, '2015-04-07 20:18:33', 76, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Website_Offers`
--

CREATE TABLE IF NOT EXISTS `Website_Offers` (
  `Website_OffersID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferTitle` varchar(200) DEFAULT NULL,
  `Description` text,
  `LandingPage` varchar(200) DEFAULT NULL,
  `Image` varchar(100) DEFAULT NULL,
  `WebsiteID` int(11) DEFAULT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  PRIMARY KEY (`Website_OffersID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=290 ;

--
-- Dumping data for table `Website_Offers`
--

INSERT INTO `Website_Offers` (`Website_OffersID`, `OfferTitle`, `Description`, `LandingPage`, `Image`, `WebsiteID`, `StartDate`, `EndDate`) VALUES
(288, 'COSTUMES AT WHOLESALE PRICES', 'COSTUMES AT WHOLESALE PRICES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=288426.11&type=3&subid=0', '', 642, '2012-10-12', '2017-12-12'),
(289, 'HALLOWEEN DECOR AND PROPS', 'HALLOWEEN DECOR AND PROPS', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=288426.16&type=3&subid=0', '', 642, '2013-08-13', '2019-08-13'),
(286, '10% OFF ALL PARTY SUPPLIES - USE CODE PARTYTEN', '10% OFF ALL PARTY SUPPLIES - USE CODE PARTYTEN', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=288426.12&type=3&subid=0', '', 642, '2012-10-12', '2017-12-12'),
(287, 'FREE PERSONALIZED SUPPLIES - $20 ON $60 & $40 ON $100', 'FREE PERSONALIZED SUPPLIES - $20 ON $60 & $40 ON $100', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=288426.13&type=3&subid=0', '', 642, '2012-11-29', '2015-12-29'),
(284, '20% off all personalized orders - Use code BDAY20', '20% off all personalized orders - Use code BDAY20', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=288426.6&type=3&subid=0', '', 642, '2012-08-16', '2015-12-31'),
(285, 'Free Shipping on orders over $60 - Use code BDAY60', 'Free Shipping on orders over $60 - Use code BDAY60', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=288426.7&type=3&subid=0', '', 642, '2012-08-16', '2016-12-31'),
(277, 'bareMinerals Spring 2015 Color Collection at Beauty.com', 'bareMinerals Spring 2015 Color Collection at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001650&type=3&subid=0', '', 597, '2015-02-27', '2015-05-30'),
(276, 'butter LONDON Spring 2015 Color Collection at Beauty.com', 'butter LONDON Spring 2015 Color Collection at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001651&type=3&subid=0', '', 597, '2015-02-27', '2015-05-30'),
(275, 'Urban Decay Spring 2015 Color Collection at Beauty.com', 'Urban Decay Spring 2015 Color Collection at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001647&type=3&subid=0', '', 597, '2015-02-27', '2015-05-30'),
(274, 'Tarte Spring 2015 Color Collection at Beauty.com', 'Tarte Spring 2015 Color Collection at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001649&type=3&subid=0', '', 597, '2015-02-27', '2015-05-30'),
(272, 'Buy BB Cream at Beauty.com!', 'Buy BB Cream at Beauty.com!', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001033&type=3&subid=0', '', 597, '2012-05-02', '2018-09-02'),
(273, 'Final Clearance!  Get these beautiful finds before they\\''re gone!', 'Final Clearance!  Get these beautiful finds before they\\''re gone!', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001603&type=3&subid=0', '', 597, '2014-05-30', '2020-05-30'),
(270, 'LORAC Spring 2015 Color Collection at Beauty.com', 'LORAC Spring 2015 Color Collection at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001652&type=3&subid=0', '', 597, '2015-02-27', '2015-05-30'),
(271, 'Laura Gellar Spring 2015 Color Collection at Beauty.com', 'Laura Gellar Spring 2015 Color Collection at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10001653&type=3&subid=0', '', 597, '2015-02-27', '2015-05-30'),
(268, 'Get ', 'Get \\"Favorite Things\\" philosophy hope in a jar at Beauty.com!', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000807&type=3&subid=0', '', 597, '2010-11-22', '2016-11-22'),
(269, 'Get the Too Faced Naked Eye Collection at Beauty.com!', 'Get the Too Faced Naked Eye Collection at Beauty.com!', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000739&type=3&subid=0', '', 597, '2010-08-20', '2016-08-20'),
(260, 'Shop for Skin Care products at Beauty.com', 'Shop for Skin Care products at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000735&type=3&subid=0', '', 597, '2010-08-18', '2016-08-18'),
(261, 'Get skin care products on sale at Beauty.com', 'Get skin care products on sale at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000737&type=3&subid=0', '', 597, '2010-08-18', '2016-08-18'),
(262, 'Get Summer Hair with Frederic Fekkai!', 'Get Summer Hair with Frederic Fekkai!', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000690&type=3&subid=0', '', 597, '2010-04-23', '2016-04-23'),
(263, 'Buy Fresh Sugar Plum Lip Treatment, SPF 15 at Beauty.com', 'Buy Fresh Sugar Plum Lip Treatment, SPF 15 at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000726&type=3&subid=0', '', 597, '2010-08-13', '2016-08-13'),
(267, 'Beauty.com - the world of beauty online', 'Beauty.com - the world of beauty online', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000728&type=3&subid=0', '', 597, '2010-08-18', '2016-08-18'),
(266, 'Shop for certified organic products at Beauty.com!', 'Shop for certified organic products at Beauty.com!', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000734&type=3&subid=0', '', 597, '2010-08-18', '2016-08-18'),
(265, 'Shop the Men\\''s category at Beauty.com', 'Shop the Men\\''s category at Beauty.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000731&type=3&subid=0', '', 597, '2010-08-18', '2016-08-18'),
(264, 'Shop for makeup at Beauty.com!', 'Shop for makeup at Beauty.com!', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=298790.10000729&type=3&subid=0', '', 597, '2010-08-18', '2016-08-18'),
(241, 'Leather Lovers Sample Kit', 'Leather Lovers Sample Kit', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.14&type=3&subid=0', '', 641, '2014-05-29', '2020-05-29'),
(239, 'V Line Kit', 'V Line Polish & Compound Sample Kit', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.15&type=3&subid=0', '', 641, '2014-05-29', '2020-05-29'),
(240, 'AIR_300', 'Best Sellers Scent Kit', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.16&type=3&subid=0', '', 641, '2014-05-29', '2020-05-29'),
(237, 'Second Skin', 'Second Skin Coating System', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.17&type=3&subid=0', '', 641, '2014-05-29', '2020-05-29'),
(238, 'Vintage Line', 'Vintage Line Care Car Kit', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.18&type=3&subid=0', '', 641, '2014-05-29', '2020-05-29'),
(235, 'Homepage', 'Chemical Guys Auto Detailing Supplies & Car Wash Chemicals', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.5&type=3&subid=0', '', 641, '2013-10-22', '2019-10-22'),
(236, 'Chemical Guys Leather Lovers Kit', 'Leather Lovers Kit', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.13&type=3&subid=0', '', 641, '2013-11-20', '2019-11-20'),
(234, 'New Car Scent and Leather Scent Kit', 'New Car Scent and Leather Scent Kit', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.12&type=3&subid=0', '', 641, '2013-11-19', '2019-11-19'),
(232, 'New Products', 'New Products on ChemicalGuys.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.6&type=3&subid=0', '', 641, '2013-10-22', '2019-10-22'),
(233, 'Coupons', 'Coupons on ChemicalGuys.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.7&type=3&subid=0', '', 641, '2013-10-22', '2019-10-22'),
(231, 'Best Sellers', 'Best Sellers on ChemicalGuys.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.8&type=3&subid=0', '', 641, '2013-10-22', '2019-10-22'),
(228, 'Stripper Scent', 'Stripper Scent from Chemical Guys', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.11&type=3&subid=0', '', 641, '2013-10-22', '2019-10-22'),
(229, 'Clearance', 'Clearance Products on ChemicalGuys.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.9&type=3&subid=0', '', 641, '2013-10-22', '2019-10-22'),
(168, 'FREE EXCHANGES - COSTUMES', 'FREE EXCHANGES - COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.19&type=3&subid=0', NULL, 640, '2012-08-16', '2016-08-16'),
(230, 'Soaps, Shampoos & Car Wash Products', 'Soaps, Shampoos & Car Wash Products on ChemicalGuys.com', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=313980.10&type=3&subid=0', '', 641, '2013-10-22', '2019-10-22'),
(166, 'SALE / CLEARANCE COSTUMES', 'SALE / CLEARANCE COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.17&type=3&subid=0', NULL, 640, '2012-08-16', '2017-08-16'),
(167, 'TEEN COSTUMES', 'TEEN COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.18&type=3&subid=0', NULL, 640, '2012-08-16', '2016-08-16'),
(165, 'GIRLS COSTUMES', 'GIRLS COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.16&type=3&subid=0', NULL, 640, '2012-08-16', '2016-08-16'),
(162, 'KIDS / TODDLER COSTUMES', 'KIDS / TODDLER COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.12&type=3&subid=0', NULL, 640, '2012-08-16', '2018-08-16'),
(163, 'MEN&#039;S TOP COSTUMES', 'MEN&#039;S COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.14&type=3&subid=0', NULL, 640, '2012-08-16', '2016-08-16'),
(164, 'PLUS SIZE COSTUMES', 'PLUS SIZE COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.15&type=3&subid=0', NULL, 640, '2012-08-16', '2017-08-16'),
(160, 'AVENGERS COSTUMES', 'AVENGERS COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.10&type=3&subid=0', NULL, 640, '2012-08-16', '2016-08-16'),
(161, 'SEXY COSTUMES', 'SEXY COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.11&type=3&subid=0', NULL, 640, '2012-08-16', '2017-08-16'),
(158, 'BATMAN COSTUMES', 'BATMAN COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.8&type=3&subid=0', NULL, 640, '2012-08-16', '2015-10-16'),
(159, 'DISNEY PRINCESS COSTUMES AND ACCESSORIES', 'DISNEY PRINCESS COSTUMES AND ACCESSORIES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.9&type=3&subid=0', NULL, 640, '2012-08-16', '2016-08-16'),
(156, '15% OFF $25+ COSTUMES', '15% OFF $25+ COSTUMES - SALE15', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.5&type=3&subid=0', NULL, 640, '2012-08-16', '2016-12-31'),
(157, 'SPIDERMAN COSTUMES', 'SPIDERMAN COSTUMES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.7&type=3&subid=0', NULL, 640, '2012-08-16', '2015-08-16'),
(154, 'HALLOWEEN DECOR AND PROPS', 'HALLOWEEN DECOR AND PROPS', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.28&type=3&subid=0', NULL, 640, '2013-08-13', '2019-08-13'),
(155, 'FREE SHIPPING ON ORDER $49 OR MORE - USE CODE WINTER49', 'FREE SHIPPING ON ORDER $49 OR MORE - USE CODE WINTER49', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.25&type=3&subid=0', NULL, 640, '2012-11-16', '2016-12-31'),
(152, 'First Order 10% Off', 'We now offer 10% off on your first order, plus free shipping, use code FIRST10. Ends 6/30/2015.', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=280480.369&type=3&subid=0', '', 639, '2015-02-27', '2015-06-30'),
(153, '15% OFF ORDERS $50+ - USE CODE TREAT15', '15% OFF ORDERS $50+ - USE CODE TREAT15', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=305517.31&type=3&subid=0', NULL, 640, '2014-01-07', '2016-12-30'),
(146, 'BOYS POPULAR COSTUMES UNDER $20 COST', 'BOYS POPULAR COSTUMES UNDER $20 COST', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000167&type=3&subid=0', '', 637, '2014-07-10', '2018-07-10'),
(98, 'Choose to Lease your HughesNet equipment and reduce your upfront costs with FREE Standard Installation.', 'Choose to Lease your HughesNet equipment and reduce your upfront costs with FREE Standard Installation.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.99&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(97, 'Lease your HughesNet equipment and reduce your upfront costs with FREE Standard Installation.', 'Lease your HughesNet equipment and reduce your upfront costs with FREE Standard Installation.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.98&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(96, 'FREE Standard Installation included with Lease of HughesNet equipment! New subscribers only.', 'FREE Standard Installation included with Lease of HughesNet equipment! New subscribers only.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.97&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(95, 'Plans as low as $39.99/month for three months to new residential subscribers! Limited time only.', 'Plans as low as $39.99/month for three months to new residential subscribers! Limited time only.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.96&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(94, 'Plans as low as $39.99/month for three months to new residential subscribers!', 'Plans as low as $39.99/month for three months to new residential subscribers!', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.95&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(93, 'Plans as low as $39.99/month for three months! Limited time only.', 'Plans as low as $39.99/month for three months! Limited time only.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.94&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(92, 'Special rate for new HughesNet customers: SAVE $10/month for 3 months with Purchase or Lease of any service plan. Offer ends 6/30/15.', 'Special rate for new HughesNet customers: SAVE $10/month for 3 months with Purchase or Lease of any service plan. Offer ends 6/30/15.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.93&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(91, 'Special rate for new HughesNet customers: SAVE $10/month for 3 months on any service plan. Offer ends 6/30/15.', 'Special rate for new HughesNet customers: SAVE $10/month for 3 months on any service plan. Offer ends 6/30/15.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.92&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(90, 'SAVE $10 a month for three months for new subscribers with Purchase or Lease of any HughesNet service plan. Offer ends 6/30/15.', 'SAVE $10 a month for three months for new subscribers with Purchase or Lease of any HughesNet service plan. Offer ends 6/30/15.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.91&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(89, '$10 monthly savings for 3 months on all HughesNet service plans! New residential subscribers only.', '$10 monthly savings for 3 months on all HughesNet service plans! New residential subscribers only.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.90&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(88, '$10 monthly savings for 3 months on all HughesNet service plans. Limited time only!', '$10 monthly savings for 3 months on all HughesNet service plans. Limited time only!', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.89&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(87, '$10 monthly savings for 3 months on all HughesNet service plans!', '$10 monthly savings for 3 months on all HughesNet service plans!', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.88&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(86, 'FREE Standard Installation for new HughesNet Lease customers only. Limited-time offer.', 'FREE Standard Installation for new HughesNet Lease customers only. Limited-time offer.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.87&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(85, 'FREE Standard Installation valid for new HughesNet Lease orders only. Not valid with Purchase option. Limited-time offer.', 'FREE Standard Installation valid for new HughesNet Lease orders only. Not valid with Purchase option. Limited-time offer.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.86&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(84, 'FREE Standard Installation valid on new HughesNet Lease orders only. Not valid with Purchase option. Limited-time offer.', 'FREE Standard Installation valid on new HughesNet Lease orders only. Not valid with Purchase option. Limited-time offer.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.85&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(83, 'FREE Standard Installation valid for new HughesNet Lease customers only. Not valid with Purchase option. Limited-time offer.', 'FREE Standard Installation valid for new HughesNet Lease customers only. Not valid with Purchase option. Limited-time offer.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.84&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(82, '$100 Instant savings with Purchase of a new HughesNet system. Not valid with Lease option. Offer ends 6/30/15.', '$100 Instant savings with Purchase of a new HughesNet system. Not valid with Lease option. Offer ends 6/30/15.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.83&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(81, '$100 Instant savings with Purchase of a new HughesNet system. Offer ends 6/30/15.', '$100 Instant savings with Purchase of a new HughesNet system. Offer ends 6/30/15.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.82&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(80, 'SAVE $100 Instantly with Purchase of a new HughesNet system. Not valid with Lease option. Offer ends 6/30/15.', 'SAVE $100 Instantly with Purchase of a new HughesNet system. Not valid with Lease option. Offer ends 6/30/15.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.81&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(79, 'SAVE $100 Instantly with Purchase of a new HughesNet system. Offer ends 6/30/15.', 'SAVE $100 Instantly with Purchase of a new HughesNet system. Offer ends 6/30/15.', 'http://click.linksynergy.com/fs-bin/click?id=TAxaJCQsRZk&offerid=330833.80&type=3&subid=0', '', 638, '2015-04-01', '2015-06-30'),
(145, '15% off costumes priced $20 or more -  code X15', '15% off costumes priced $20 or more -  code X15', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000165&type=3&subid=0', '', 637, '2014-06-30', '2015-12-31'),
(142, '25% OFF PERSONALIZED ITEMS - USE CODE PSC25', '25% OFF PERSONALIZED ITEMS - USE CODE PSC25', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000154&type=3&subid=0', '', 637, '2013-04-02', '2016-09-30'),
(143, 'HALLOWEEN DECORATIONS AND PROPS', 'HALLOWEEN DECORATIONS AND PROPS', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000159&type=3&subid=0', '', 637, '2013-08-13', '2019-08-13'),
(141, 'PARTY SUPER CENTER - 50% OFF ALL TABLEWARE - BEST PRICES ONLINE FOR PARTY SUPPLIES', 'PARTY SUPER CENTER - 50% OFF ALL TABLEWARE - BEST PRICES ONLINE FOR PARTY SUPPLIES', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000158&type=3&subid=0', '', 637, '2013-07-09', '2016-07-09'),
(144, 'GIRLS POPULAR COSTUMES UNDER $20 COST', 'GIRLS POPULAR COSTUMES UNDER $20 COST', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000166&type=3&subid=0', '', 637, '2014-07-10', '2018-07-10'),
(140, '5% OFF AND FREE SHIPPING ON ORDERS $100 OR MORE - USE CODE PSC5', '5% OFF AND FREE SHIPPING ON ORDERS $100 OR MORE - USE CODE PSC5', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000157&type=3&subid=0', '', 637, '2013-04-02', '2015-12-30'),
(139, 'FREE SHIPPING ON ORDERS $60 OR MORE - USE CODE FREE60', 'FREE SHIPPING ON ORDERS $60 OR MORE - USE CODE FREE60', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000151&type=3&subid=0', '', 637, '2013-01-04', '2015-07-31'),
(137, '10% OFF $60+ ORDERS - USE CODE SAVETEN', '10% OFF $60+ ORDERS - USE CODE SAVETEN', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000149&type=3&subid=0', '', 637, '2012-11-15', '2015-11-30'),
(138, '50% off PARADE QUALITY EASTER BUNNY COSTUMES - DISCOUNT ALREADY REFLECTED IN PRICE', '50% off PARADE QUALITY EASTER BUNNY COSTUMES - DISCOUNT ALREADY REFLECTED IN PRICE', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000153&type=3&subid=0', '', 637, '2013-03-04', '2016-06-04'),
(135, 'Get your Memorial Day Costumes', 'Get your Memorial Day Costumes at Costume SuperCenter', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000124&type=3&subid=0', '', 637, '2010-04-19', '2016-04-19'),
(136, 'Get your Cinco De Mayo Costumes', 'Get your Cinco De Mayo Costumes at Costume SuperCenter', 'http://click.linksynergy.com/fs-bin/click?id=6aIVIhZYSRE&offerid=338234.10000125&type=3&subid=0', '', 637, '2010-04-19', '2016-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `Website_OffersExpired`
--

CREATE TABLE IF NOT EXISTS `Website_OffersExpired` (
  `Website_OffersID` int(11) NOT NULL,
  `LandingPage` varchar(200) DEFAULT NULL,
  `WebsiteID` int(11) DEFAULT NULL,
  `StartDate` date NOT NULL,
  PRIMARY KEY (`Website_OffersID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Website_Tag`
--

CREATE TABLE IF NOT EXISTS `Website_Tag` (
  `TagID` int(11) DEFAULT NULL,
  `WebsiteID` int(11) DEFAULT NULL,
  KEY `WebsiteID` (`WebsiteID`),
  KEY `TagID` (`TagID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Website_Tag`
--

INSERT INTO `Website_Tag` (`TagID`, `WebsiteID`) VALUES
(3, 294),
(2, 294),
(1, 294),
(6, 637),
(5, 637),
(4, 637),
(8, 638),
(7, 638),
(11, 639),
(10, 639),
(9, 639),
(13, 640),
(12, 640),
(6, 640),
(5, 640),
(4, 640),
(16, 641),
(15, 641),
(14, 641),
(19, 597),
(18, 597),
(17, 597),
(22, 642),
(21, 642),
(20, 642);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

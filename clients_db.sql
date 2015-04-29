-- phpMyAdmin SQL Dump
-- version 3.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 09, 2010 at 05:44 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clients_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE IF NOT EXISTS `Admins` (
  `AdminID` int(11) NOT NULL auto_increment,
  `AdminEmail` varchar(100) default NULL,
  `IsSite_Manage` tinyint(1) default '1',
  `IsCoupon_Manage` tinyint(1) default '1',
  `IsWebsite_Manage` tinyint(1) default '1',
  `IsTag_Manage` tinyint(1) default '1',
  `IsComment_Manage` tinyint(1) default '1',
  `IsAccount_Manage` tinyint(1) default '1',
  `IsPage_Manage` tinyint(1) default '1',
  `AdminPassword` varchar(50) default NULL,
  `IsEnable` tinyint(1) default '1',
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`AdminID`),
  UNIQUE KEY `AdminEmail` (`AdminEmail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Admins`
--

INSERT INTO `Admins` (`AdminID`, `AdminEmail`, `IsSite_Manage`, `IsCoupon_Manage`, `IsWebsite_Manage`, `IsTag_Manage`, `IsComment_Manage`, `IsAccount_Manage`, `IsPage_Manage`, `AdminPassword`, `IsEnable`, `DateAdded`) VALUES
(1, 'admin', 1, 1, 1, 1, 1, 1, 1, '21232f297a57a5a743894a0e4a801fc3', 1, '2010-02-22 09:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `CommentID` int(11) NOT NULL auto_increment,
  `UserName` varchar(100) default NULL,
  `EmailAddress` varchar(150) default NULL,
  `Comments` text,
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `IsApproved` tinyint(1) default '0',
  `CouponID` int(11) default NULL,
  PRIMARY KEY  (`CommentID`),
  KEY `CouponID` (`CouponID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `Coupon`
--

CREATE TABLE IF NOT EXISTS `Coupon` (
  `CouponID` int(11) NOT NULL auto_increment,
  `CouponCode` varchar(100) default NULL,
  `CountSuccess` int(11) default '0',
  `CountFail` int(11) default '0',
  `Hits` int(11) default '0',
  `IsApproved` tinyint(1) default '1',
  `IsFeatured` tinyint(1) default '0',
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `Discount` decimal(10,2) default NULL,
  `Description` text,
  `WebsiteID` int(11) default NULL,
  `Expiry` int(11) default NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `CouponLink` varchar( 255 ) NOT NULL,
  PRIMARY KEY  (`CouponID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Coupon`
--


-- --------------------------------------------------------

--
-- Table structure for table `Link_Footer`
--

CREATE TABLE IF NOT EXISTS `Link_Footer` (
  `ID` int(11) NOT NULL auto_increment,
  `Link` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `Link_Footer`
--

INSERT INTO `Link_Footer` (`ID`, `Link`, `Name`) VALUES
(1, 'http://www.couponsitescript.com/', 'Coupon Site Script'),
(2, 'http://www.coupodon.com/', 'Coupodon'),
(3, 'http://www.cloud-deals.com/', 'Cloud Deals'),
(4, 'http://www.gadget-coupons.com/', 'Gadget Coupons'),
(5, 'http://www.scriptcoupons.com/', 'Script Coupons'),
(6, 'http://www.thinkpadcupons.com/', 'Think Pad Coupons'),
(7, 'http://www.codecoupondiscount.com/', 'Code Coupon Discount'),
(8, 'http://www.couponcodehosting.com/', 'Coupon Code Hosting'),
(9, 'http://www.sonycupons.com/', 'Sony Coupons'),
(10, 'http://www.laptopcupons.com/', 'Laptop Coupons'),
(11, 'http://www.couponsitescript.com/terms-of-use/', 'Terms Of Use'),
(12, 'http://www.couponsitescript.com/disclaimer/', 'Disclaimer');

-- --------------------------------------------------------

--
-- Table structure for table `MarketingAdManager`
--

CREATE TABLE IF NOT EXISTS `MarketingAdManager` (
  `MarketingAdID` int(11) NOT NULL auto_increment,
  `MarketingScript` text,
  `MarketingPlacing` varchar(30) default NULL,
  PRIMARY KEY  (`MarketingAdID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `MarketingAdManager`
--


-- --------------------------------------------------------

--
-- Table structure for table `Newsletter`
--

CREATE TABLE IF NOT EXISTS `Newsletter` (
  `ID` int(11) NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `date_aplic` datetime NOT NULL,
  `date_register` datetime NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Newsletter`
--


-- --------------------------------------------------------

--
-- Table structure for table `PageManager`
--

CREATE TABLE IF NOT EXISTS `PageManager` (
  `PageManagerID` int(11) NOT NULL auto_increment,
  `PageName` varchar(100) default NULL,
  `PageContents` text,
  `IncludeFooter` tinyint(1) default NULL,
  `IncludeHeader` tinyint(1) default NULL,
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`PageManagerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `PageManager`
--

INSERT INTO `PageManager` (`PageManagerID`, `PageName`, `PageContents`, `IncludeFooter`, `IncludeHeader`, `DateAdded`) VALUES
(1, 'How To Do It', '<p>This 2 minute reading will teach you how to use <strong>Coupon Site Script</strong>. The fact that you know how to use it will save and money you time in the future.<br /><br /><strong>A fact about shopping</strong><br />When you are buying items or services online you can make 2 steps in only one:<br />-&nbsp;&nbsp;&nbsp; Get what you want;<br />-&nbsp;&nbsp;&nbsp; Save money in the same time.<br />In the checkout process many online stores will have a field where you can enter a coupon or a discount code. This means that you&rsquo;ll get something in exchange:<br />-&nbsp;&nbsp;&nbsp; Free shipping<br />-&nbsp;&nbsp;&nbsp; Save money<br />-&nbsp;&nbsp;&nbsp; Get something else for free.<br /><br />At <strong>Coupon Site Script</strong> we even simplified the process and included sites that sustain:<br />&ldquo;... promotion are rare because we give you the lowest prices available everyday&ldquo;.<br />That is why we include websites, with no coupon or discount offers, only because they have the lowest price on the market.<br />An example what the means:<br />If a website has a coupon that saves you 10$ and the product is 99$ that means you will get the product with 89$.<br />A site with no coupon but with the lowest price on the market has the same product at the price of 85$.<br /><br /><strong>Instructions</strong><br />Step1: You want to buy from videowhisper.com or simply videowhisper<br />Step2: You visit <a href=\\"\\\\\\"><strong>http://www.couponsitescript.com</strong></a><br />Step3: In the search section you enter the title website from step1<br />Step4: Any coupon available for this store will now be shown.<br />Step5: Choose the coupon code that best fit you and click on it. Just paste the code ( that already copied ) in the payment process.<br />Following the five steps will save you money and get you great discount or bonus!<br /><br /></p>', 0, 1, '2010-11-02 12:33:45'),
(2, 'Contact', '<p>For any ideas and suggestions<em><strong> </strong></em>contact us at</p>\r\n<p>&nbsp;</p>\r\n<p><strong>couponsitescript</strong> ( you know the sign ) gmail.com</p>', 0, 1, '2010-11-02 12:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `SEF_URL`
--

CREATE TABLE IF NOT EXISTS `SEF_URL` (
  `SEF_URL_ID` int(11) NOT NULL auto_increment,
  `URL` varchar(200) default NULL,
  `EntityType` varchar(50) default NULL,
  `EntityID` int(11) default NULL,
  PRIMARY KEY  (`SEF_URL_ID`),
  UNIQUE KEY `URL` (`URL`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `SEF_URL`
--

INSERT INTO `SEF_URL` (`SEF_URL_ID`, `URL`, `EntityType`, `EntityID`) VALUES
(2, 'Contact', 'StaticPage', 2),
(1, 'How-To-Do-It', 'StaticPage', 1);

-- --------------------------------------------------------

--
-- Table structure for table `SiteManager`
--

CREATE TABLE IF NOT EXISTS `SiteManager` (
  `SiteVariable` varchar(50) NOT NULL,
  `SiteValue` varchar(500) default NULL,
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`SiteVariable`),
  UNIQUE KEY `SiteVariable` (`SiteVariable`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SiteManager`
--

INSERT INTO `SiteManager` (`SiteVariable`, `SiteValue`, `DateAdded`) VALUES
('SiteName', 'CouponSiteScript.com', '2010-08-24 12:22:06'),
('SiteTitle', 'Demo Coupon Script', '2010-08-24 12:21:20'),
('SiteKeyword', 'code, coupon, discount, free, sale, get, save, off', '2010-02-22 09:36:02'),
('SiteDescription', 'Coupon Site Script is about saving money on internet purchases.', '2010-10-07 18:13:42'),
('CurrentSkin', 'NewLook', '2010-08-25 07:07:09'),
('OwnerEmail', NULL, '2010-11-04 16:36:54'),
('IsEditorAllow', '0', '2010-02-22 09:23:30'),
('DefaultStatus', '0', '2010-02-22 09:36:02'),
('DefaultStatusComments', '0', '2010-02-22 09:36:02'),
('RSS', '', '2010-02-22 09:23:30'),
('SignupAuthentication', '1', '2010-02-22 09:23:30'),
('GoogleAnalytics', NULL, '2010-11-04 16:36:54'),
('SiteVersion', '1.0', '2010-10-25 08:49:34'),
('TagDescription', '', '2010-11-02 07:34:41'),
('DaysToExpire', '10', '2010-02-22 09:23:30'),
('PopularStoresHome', '15', '2010-07-26 10:52:15'),
('FeaturedStoresHome', '10', '2010-02-22 09:23:30'),
('FeaturedCouponsHome', '10', '2010-02-22 09:23:30'),
('NewCouponsHome', '5', '2010-09-10 05:21:10'),
('RegistrationEmail', '', '2010-02-22 09:23:30'),
('ADConfirmationEmail', '', '2010-02-22 09:23:30'),
('SendToFriendEmail', 'Hello {Friend_Name} \n Your friend {Sender_Name} wants you to visit {URL} \n He has requested from {Sender_Email} to your email {Friend_Email}', '2010-02-22 09:23:30'),
('IsSiteClose', '0', '2010-02-22 09:23:30'),
('SocialNet_Twitter', NULL, '2010-10-11 05:57:47'),
('SocialNet_FaceBook', NULL, '2010-10-11 05:57:47'),
('SocialNet_Delicious', NULL, '2010-11-04 16:37:32'),
('SocialNet_Digg', NULL, '2010-03-31 18:20:52'),
('SocialNet_Linkedin', NULL, '2010-03-04 13:25:31'),
('SocialNet_Reddit', NULL, '2010-03-04 13:25:31'),
('SocialNet_Stumbleupon', NULL, '2010-03-04 13:25:31'),
('SocialNet_Newsvine', NULL, '2010-03-04 13:25:31'),
('SocialNet_Googlebookmarks', NULL, '2010-03-04 13:25:31'),
('SocialNet_Technorati', NULL, '2010-03-04 13:25:31'),
('DelayCPost', '30', '2010-06-23 12:42:52'),
('DelayOPost', '30', '2010-06-23 12:42:52'),
('DelayTPost', '30', '2010-06-24 06:21:20'),
('DelayTUpdate', '720', '2010-06-24 06:21:36'),
('TwitterText', 'Code Coupon', '2010-10-25 08:49:34'),
('TagSEOTitle', '', '2010-11-02 07:35:29'),
('TagSEOKeyword', '', '2010-11-02 07:35:29'),
('RssMaxStoreRecords', '25', '2011-03-17 06:06:59'),
('RssTitle', '', '2011-03-17 10:47:55'),
('RssDescription', 'Rss feed for coupons and offers', '2011-03-17 06:09:38'),
('RssMaxGeneralRecords', '50', '2011-03-17 06:08:04'),
('RssTextLink', 'Offer taken from ', '2011-03-18 06:47:25'),
('DelayBPost', '30', '2011-05-27 06:06:59'),
('BloggerEmail', 'xyz@blogger.com', '2011-04-27 10:47:55'),
('RecordsPerPage', '30', '2011-07-06 04:50:13'),
('DelayB1Post', NULL, '2011-06-07 06:37:38'),
('Blog1Email', NULL, '2011-06-07 06:37:09'),
('Blog1Link', NULL, '2011-07-06 06:59:01'),
('DelayB2Post', NULL, '2011-06-11 05:23:31'),
('Blog2Email', NULL, '2011-06-11 05:23:25'),
('Blog2Link', NULL, '2011-07-06 06:59:26'),
('DelayB3Post', NULL, '2011-06-11 05:18:40'),
('Blog3Email', NULL, '2011-06-11 05:18:40'),
('Blog3Link', NULL, '2011-07-06 06:59:26'),
('BloggerEmail1', NULL, '2011-06-07 05:40:24'),
('BloggerEmail2', NULL, '2011-06-07 05:35:24'),
('BloggerEmail3', NULL, '2011-06-07 05:35:24'),
('BloggerLink1', NULL, '2011-07-06 06:50:58'),
('BloggerLink2', NULL, '2011-07-06 06:50:58'),
('BloggerLink3', NULL, '2011-07-06 06:50:58'),
('DelayWPost', NULL, '2011-07-09 17:10:36'),
('WordpressEmail', NULL, '2011-07-09 17:05:32'),
('WordpressLink', NULL, '2011-07-09 17:05:32'),
('DelayPPost', NULL, '2011-07-11 06:16:47'),
('PosterousEmailTo', NULL, '2011-07-06 08:03:35'),
('PosterousEmailFrom', NULL, '2011-07-06 08:03:00'),
('PosterousLink', NULL, '2011-07-06 08:03:11'),
('DelayTumblrPost', NULL, '2011-07-12 04:13:49'),
('TumblrEmail', NULL, '2011-07-12 04:13:49'),
('TumblrLink', NULL, '2011-07-12 04:14:01'), 
('DelayYPost', '60', '2012-07-31 15:32:05'),
('DelayFlPost', '60', '2012-07-01 15:32:05'),
('FlickrEmailFrom', '', '2012-06-27 13:21:46'),
('FlickrEmailTo1', '', '2012-07-06 20:12:12'),
('FlickrLink1', '', '2012-07-06 19:18:20'),
('FlickrEmailTo2', '  ', '2012-06-28 12:28:24'),
('FlickrLink2', '', '2012-06-28 12:28:39'),
('FlickrEmailTo3', '  ', '2012-06-28 12:28:24'),
('FlickrLink3', '', '2012-06-28 12:28:39'),
('FlickrEmailTo4', '  ', '2012-06-28 12:28:24'),
('FlickrLink4', '', '2012-06-28 12:28:39'),
('FlickrEmailTo5', '  ', '2012-06-28 12:28:24'),
('FlickrLink5', '', '2012-06-28 12:28:39'),
('FlickrEmailTo6', '  ', '2012-06-28 12:28:24'),
('FlickrLink6', '', '2012-06-28 12:28:39'),
('FlickrEmailTo7', '  ', '2012-06-28 12:28:24'),
('FlickrLink7', '', '2012-06-28 12:28:39'),
('FlickrEmailTo8', '  ', '2012-06-28 12:28:24'),
('FlickrLink8', '', '2012-06-28 12:28:39'),
('FlickrEmailTo9', '  ', '2012-06-28 12:28:24'),
('FlickrLink9', '', '2012-06-28 12:28:39'),
('FlickrEmailTo10', '  ', '2012-06-28 12:28:24'),
('FlickrLink10', '', '2012-06-28 12:28:39'),
('YoutubeEmailFrom', '', '2012-07-31 13:21:46'),
('YoutubeEmailTo1', '', '2012-07-31 20:12:12'),
('YoutubeLink1', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo2', '', '2012-07-31 20:12:12'),
('YoutubeLink2', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo3', '', '2012-07-31 20:12:12'),
('YoutubeLink3', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo4', '', '2012-07-31 20:12:12'),
('YoutubeLink4', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo5', '', '2012-07-31 20:12:12'),
('YoutubeLink5', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo6', '', '2012-07-31 20:12:12'),
('YoutubeLink6', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo7', '', '2012-07-31 20:12:12'),
('YoutubeLink7', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo8', '', '2012-07-31 20:12:12'),
('YoutubeLink8', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo9', '', '2012-07-31 20:12:12'),
('YoutubeLink9', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo10', '', '2012-07-31 20:12:12'),
('YoutubeLink10', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo11', '', '2012-07-31 20:12:12'),
('YoutubeLink11', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo12', '', '2012-07-31 20:12:12'),
('YoutubeLink12', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo13', '', '2012-07-31 20:12:12'),
('YoutubeLink13', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo14', '', '2012-07-31 20:12:12'),
('YoutubeLink14', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo15', '', '2012-07-31 20:12:12'),
('YoutubeLink15', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo16', '', '2012-07-31 20:12:12'),
('YoutubeLink16', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo17', '', '2012-07-31 20:12:12'),
('YoutubeLink17', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo18', '', '2012-07-31 20:12:12'),
('YoutubeLink18', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo19', '', '2012-07-31 20:12:12'),
('YoutubeLink19', '', '2012-07-31 19:18:20'),
('YoutubeEmailTo20', '', '2012-07-31 20:12:12'),
('YoutubeLink20', '', '2012-07-31 19:18:20'),
('DelayYSPost', '60', '2012-07-31 15:32:05'),
('YoutubeStoresEmailFrom', '', '2012-07-31 13:21:46'),
('YoutubeStoresEmailTo1', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink1', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo2', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink2', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo3', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink3', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo4', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink4', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo5', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink5', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo6', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink6', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo7', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink7', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo8', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink8', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo9', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink9', '', '2012-07-31 19:18:20'),
('YoutubeStoresEmailTo10', '', '2012-07-31 20:12:12'),
('YoutubeStoresLink10', '', '2012-07-31 19:18:20'),
('ExpiredOffersDaysRemain', '365', '2012-12-05 05:23:31');
-- --------------------------------------------------------

--
-- Table structure for table `Tag`
--

CREATE TABLE IF NOT EXISTS `Tag` (
  `TagID` int(11) NOT NULL auto_increment,
  `TagName` varchar(100) default NULL,
  `TagDescription` text,
  `SEOTitle` varchar(200) default NULL,
  `SEOKeyword` varchar(200) default NULL,
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`TagID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Tag`
--


-- --------------------------------------------------------

--
-- Table structure for table `Tag_Offers`
--

CREATE TABLE IF NOT EXISTS `Tag_Offers` (
  `Tag_OffersID` int(11) NOT NULL auto_increment,
  `OfferTitle` varchar(200) default NULL,
  `Description` text,
  `LandingPage` varchar(200) default NULL,
  `Image` varchar(100) default NULL,
  `TagID` int(11) default NULL,
  PRIMARY KEY  (`Tag_OffersID`),
  KEY `TagID` (`TagID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Tag_Offers`
--


-- --------------------------------------------------------

--
-- Table structure for table `TwitterAccount`
--

CREATE TABLE IF NOT EXISTS `TwitterAccount` (
  `TwitterAccountID` int(11) NOT NULL auto_increment,
  `User` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `ConsumerKey` varchar(100) NOT NULL,
  `ConsumerSecret` varchar(100) NOT NULL,
  `UserToken` varchar(100) NOT NULL,
  `UserSecret` varchar(100) NOT NULL,
  `Type` tinyint(3) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  PRIMARY KEY  (`TwitterAccountID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `TwitterAccount`
--


-- --------------------------------------------------------

--
-- Table structure for table `VotingLog`
--

CREATE TABLE IF NOT EXISTS `VotingLog` (
  `VotingID` int(11) NOT NULL auto_increment,
  `IP` varchar(100) default NULL,
  `CouponID` int(11) default NULL,
  `VotingValue` int(11) default '0',
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`VotingID`),
  KEY `CouponID` (`CouponID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `VotingLog`
--


-- --------------------------------------------------------

--
-- Table structure for table `Website`
--

CREATE TABLE IF NOT EXISTS `Website` (
  `WebsiteID` int(11) NOT NULL auto_increment,
  `WebsiteTitle` varchar(100) default NULL,
  `WebsiteName` varchar(100) default NULL,
  `WebsiteURL` varchar(200) default NULL,
  `Description` text,
  `AffilateURL` varchar(200) default NULL,
  `SEOTitle` varchar(200) default NULL,
  `SEOKeyword` varchar(200) default NULL,
  `IsActive` tinyint(1) default '0',
  `IsFeatured` tinyint(1) default NULL,
  `SearchKeywords` text,
  `DateAdded` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `Views` int(11) default '0',
  `CjID` int(11) NOT NULL,
  `ShareasaleID` int(11) NOT NULL,
  `LinkshareID` int(11) NOT NULL,
  `RegnowID` int(11) NOT NULL,
  `GanID` int(11) NOT NULL,
  PRIMARY KEY  (`WebsiteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Website`
--


-- --------------------------------------------------------

--
-- Table structure for table `Website_Offers`
--

CREATE TABLE IF NOT EXISTS `Website_Offers` (
  `Website_OffersID` int(11) NOT NULL auto_increment,
  `OfferTitle` varchar(200) default NULL,
  `Description` text,
  `LandingPage` varchar(200) default NULL,
  `Image` varchar(100) default NULL,
  `WebsiteID` int(11) default NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  PRIMARY KEY  (`Website_OffersID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Website_Offers`
--

CREATE TABLE IF NOT EXISTS `Website_OffersExpired` (
  `Website_OffersID` int(11) NOT NULL,
  `LandingPage` varchar(200) default NULL,
  `WebsiteID` int(11) default NULL,
  `StartDate` date NOT NULL,
  PRIMARY KEY  (`Website_OffersID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Website_Tag`
--

CREATE TABLE IF NOT EXISTS `Website_Tag` (
  `TagID` int(11) default NULL,
  `WebsiteID` int(11) default NULL,
  KEY `WebsiteID` (`WebsiteID`),
  KEY `TagID` (`TagID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Website_Tag`
--

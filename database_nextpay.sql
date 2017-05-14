CREATE TABLE IF NOT EXISTS `tblpaymentgateways` (
  `gateway` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  `order` int(1) NOT NULL,
  KEY `gateway_setting` (`gateway`(32),`setting`(32)),
  KEY `setting_value` (`setting`(32),`value`(32))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpaymentgateways`
--

INSERT INTO `tblpaymentgateways` (`gateway`, `setting`, `value`, `order`) VALUES
('nextpay', 'name', 'درگاه پرداخت - nextpay', 4),
('nextpay', 'api_key', '', 0),
('nextpay', 'visible', 'on', 0),
('nextpay', 'type', 'invoices', 0),
('nextpay', 'Currencies', 'Toman', 0),
('nextpay', 'convertto', '', 0);

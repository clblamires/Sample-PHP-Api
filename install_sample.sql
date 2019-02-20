-- Table structure for sample data

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL COMMENT 'Using md5, length=32',
  `archive` varchar(45) DEFAULT NULL COMMENT '0=active\n1=archived'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `employees` ADD PRIMARY KEY (`employee_id`);

INSERT INTO `employees`
(`employee_id`, `firstname`, `lastname`, `password`, `archive`)
VALUES
(1, 'Casey', 'Blamires', '98F6BCD4621D373CADE4E832627B4F6', '0');

-- That password is md5('test');
-- It's literally 'test''
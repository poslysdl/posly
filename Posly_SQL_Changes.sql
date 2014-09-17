/*
POSLY SQL Changes
*/

-- -- 01-September-2014
-- add a field in user table to keep track of steps of registration

ALTER TABLE `users` ADD `user_registration_steps` TINYINT( 1 ) NOT NULL DEFAULT '0' COMMENT '0-intial, 1-userInfo, 2-profilepic, 3-invite frnd, 4-like pics, 5-Tour, 6-finish';

UPDATE `users` SET `user_registration_steps` = 6;
-- -- 02-September-2014

TRUNCATE TABLE `users_ethnicity`;

INSERT INTO `users_ethnicity` (`users_ethnicity_id`, `users_ethnicity_name`) VALUES
(1, 'Mixed Race'),
(2, 'Arctic (Siberian, Eskimo)'),
(3, 'Caucasian (European)'),
(4, 'Caucasian (Indian)'),
(5, 'Caucasian (Middle East)'),
(6, 'Caucasian (North African, Other)'),
(7, 'Indigenous Australian'),
(8, 'Native American'),
(9, 'North East Asian (Mongol, Japanese)'),
(10, 'Pacific (Polynesian, Micronesian)'),
(11, 'South East Asian (Chinese, Thai, Malay)'),
(12, 'West African, Bushmen, Ethiopian'),
(13, 'Other Race');

TRUNCATE TABLE `users_language`;

INSERT INTO `users_language` (`users_language_id`, `users_language_name`) VALUES
(1, 'Arabic'),
(2, 'English'),
(3, 'French'),
(4, 'German'),
(5, 'Hindi'),
(6, 'Portuguese'),
(7, 'Spanish');

--
-- Newly Added Table City
--
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=5 ;

INSERT INTO `city` (`id`, `country_id`, `state_id`, `name`) VALUES
(1, 99, 2, 'Bangalore'),
(2, 99, 2, 'Mangalore'),
(3, 99, 1, 'New Delhi'),
(4, 99, 3, 'Calicut'),
(5, 81, NULL, 'Berlin');

--
-- Newly Added Table Region
--
CREATE TABLE IF NOT EXISTS `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=3 ;

INSERT INTO `regions` (`id`, `country_id`, `name`) VALUES
(1, 99, 'North'),
(2, 99, 'South');

--
-- Newly Added Table State
--
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=5 ;

INSERT INTO `states` (`id`, `country_id`, `region_id`, `name`) VALUES
(1, 99, 1, 'Delhi'),
(2, 99, 2, 'Karnataka'),
(3, 99, 2, 'kerala'),
(4, 99, 1, 'Rajasthan');

---------------------

CREATE TABLE IF NOT EXISTS `countries_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alpha_2_code` varchar(15) NOT NULL,
  `begin_ip` varchar(15) NOT NULL,
  `end_ip` varchar(15) NOT NULL,
  `begin_ip_num` int(11) NOT NULL,
  `end_ip_num` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97052 ;

--------------------
ALTER TABLE `users_socialmedia` ADD INDEX ( `user_socialmedia_provider` , `user_socialmedia_identifier` ) ;

----------11Sept14-----
ALTER TABLE `users_details` ADD `user_details_phone` VARCHAR(25) NULL AFTER `user_id` ,
ADD `user_details_address` VARCHAR(255) NULL AFTER `user_details_phone` ;

---------12Sept14------------
ALTER TABLE `users_details` ADD  `reset_password_token` varchar(256) DEFAULT NULL ;  
ALTER TABLE `users_details` ADD  `reset_password_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ;

-----------13Sep14----------------
DROP TABLE IF EXISTS `users_messages`;
CREATE TABLE IF NOT EXISTS `users_messages` (
  `user_message_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `status` varchar(2) NOT NULL DEFAULT '0' COMMENT '0 - unread, 1 - read',
  `message_created_date` int(11) NOT NULL,
  PRIMARY KEY (`user_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users_messages_reply` (
  `messages_reply_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_message_id` bigint(20) NOT NULL,
  `user_details_id` int(11) NOT NULL,
  `reply` text,
  `reply_attachment` varchar(255) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0' COMMENT '0 - unread, 1 - read',
  `reply_created_date` int(11) NOT NULL,
  PRIMARY KEY (`messages_reply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 AUTO_INCREMENT=1 ;

--------------16-Sept-14--------------------------------
ALTER TABLE `users` ADD `user_notification_count` BIGINT( 20 ) NULL ;

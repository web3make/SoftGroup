CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(8) NOT NULL,
  `title` varchar(125) NOT NULL,
  `create` int(16) NOT NULL,
  `descript` varchar(500) NOT NULL,
  `photo` varchar(125) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26;
--
INSERT INTO `articles` (`id`, `category`, `title`, `create`, `descript`, `photo`, `text`) VALUES
(1, 'weapon', 'Two title', 1482177551, 'Two descript', '6580378340524b3988e4c8a1890b92ec.jpg', 'Two text'),
(2, 'weapon', 'Two title', 1482177551, 'Two descript', '67ef0b507e5d920a5b9432cdf24ab244.jpg', 'Two text'),
(3, 'war', 'Two title', 1482311838, 'Two descript', '8dd6f28cb7f2e07401e37ce6d83da92f.jpg', 'Two text'),
(4, 'weapon', 'Two title', 1481906957, 'Two descript', '4521641262c1197914046eb2e6946321.jpg', 'Two text'),
(5, 'weapon', 'Test title', 1481796829, 'Test Descript', '88f18d9c6362c6c3290915c086d11841.jpg', 'Test text'),
(6, 'weapon', 'Two title', 1481906957, 'Two descript', '0747c035e0e438496b30c2f74e31091a.jpg', 'Two text'),
(7, 'world', 'Test title', 1482311838, 'Test Descript', '371ff1aa6bd99ab47fc53c8133ec572a.jpeg', 'Test text'),
(8, 'world', 'Two title', 1481906957, 'Two descript', 'da9f68cd29f1458713c6613fb75b3780.jpg', 'Two text'),
(9, 'world', 'Test title', 1481796829, 'Test Descript', '99e8280e5f5ae7cdf8cfc96628f547d6.jpg', 'Test text'),
(10, 'world', 'Two title', 1481906957, 'Two descript', '41d7e4195be08f695f661a6cddd277ca.jpg', 'Two text'),
(11, 'world', 'Two title', 1482311838, 'Two descript', 'c511df876b4a2fa7ee55e8452ecb2312.jpg', 'Two text'),
(12, 'world', 'Two title', 1482177551, 'Two descript', 'bc9baad6ac9cf5ec61597f44ac62d0e5.jpg', 'Two text'),
(13, 'world', 'Two title', 1482311838, 'Two descript', '3f0175a4ee50aecf53ecaf2ffb4d3bc2.jpg', 'Two text'),
(14, 'world', 'Two title', 1482177551, 'Two descript', 'aeaac43d86e5264f21e34f7976d4aa21.jpg', 'Two text'),
(15, 'world', 'Two title', 1482177551, 'Two descript', 'bff5b0f563291bea26ed2494af9e6680.jpg', 'Two text'),
(16, 'world', 'Two title', 1482311838, 'Two descript', '7d59c2f9fb0e3e13d8e6c91743ab2f80.jpg', 'Two text'),
(17, 'world', 'Two title', 1481906957, 'Two descript', '2e8f6d0425a8486000502d7c0191244f.jpg', 'Two text'),
(18, 'world', 'Test title', 1481796829, 'Test Descript', '4ebd7dfbb479ce4b4608b92873acb174.jpg', 'Test text'),
(19, 'world', 'Two title', 1481906957, 'Two descript', '382bd8d5868ac8029eee8ac627eeb498.jpg', 'Two text'),
(21, 'libel', 'Edit', 1482508181, 'edit descript', '779837d6ad2de9d8e14597256d20da4f.jpg', 'sdfgsd'),
(22, 'war', 'тест', 1482514911, 'вгщ', '2444fabdd391b94ca2dfe21bd9badec8.jpg', 'фафв'),
(23, 'weapon', 'Two title', 1482311838, 'Two descript', '961db04caaf76f5db6b71e36736026f9.jpg', 'Two text'),
(24, 'techno', 'Two title', 1482177551, 'Two descript', '30cf209900b4e1cefa70b3c4fce4c9b2.jpg', 'Two text'),
(25, 'space', 'Two title', 1482311838, 'Two descript', 'e6411d735d0073a7784aa221bc3236d4.jpg', 'Two text');
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories` (
  `category` varchar(8) NOT NULL,
  `title` varchar(15) NOT NULL,
  `activated` enum('a','b') NOT NULL,
  PRIMARY KEY (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
INSERT INTO `categories` (`category`, `title`, `activated`) VALUES
('libel', 'Дифамація', 'a'),
('space', 'Космос', 'a'),
('techno', 'Техно', 'a'),
('war', 'Війна', 'a'),
('weapon', 'Зброя', 'a'),
('world', 'Світ', 'a');
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `contacts` (
  `contact` varchar(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `about` varchar(30) NOT NULL,
  `slogan` varchar(150) NOT NULL,
  `email` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `rank` int(1) NOT NULL,
  `soc_fb` varchar(55) NOT NULL,
  `soc_gp` varchar(55) NOT NULL,
  `soc_tw` varchar(55) NOT NULL,
  `soc_in` varchar(55) NOT NULL,
  `bio` text NOT NULL,
  PRIMARY KEY (`contact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
INSERT INTO `contacts` (`contact`, `name`, `about`, `slogan`, `email`, `photo`, `rank`, `soc_fb`, `soc_gp`, `soc_tw`, `soc_in`, `bio`) VALUES
('crockford', 'Дуглас Крокфорд', 'засновник WEB-8.3.0', 'Швидко, ще не значить митєво, але потрібно швидше', 'crockford@mail.com', '571b21080fbc2360e18d86e7fb2ccaa7.jpg', 3, 'crockford', 'crockford', 'crockford', 'crockford', 'crockford'),
('ford', 'Генрі Форд', 'ідеолог конвеєра', 'Навіть мавпа справиться з віником, а що можеш ти?', 'ford@mail.com', 'henry_ford.jpg', 2, '', '', '', '', ''),
('ive', 'Джонатан Айв', 'наслідник Марцано', 'Якість визначається в деталях, які можуть здатися незначними', 'ive@mail.com', 'ive.jpg', 1, '', '', '', '', ''),
('linus', 'Лінус Торвальдс', 'ідеолог вільних О.С.', 'Хороший результат роботи, це коли ти задоволений нею', 'linus@mail.com', 'linus.jpg', 5, '', '', '', '', ''),
('marzano', 'Стефано Марцано ', 'батько тех.дизайну', 'Кращий дизайн - той який не помічають, але який зручний для всіх', 'marzano@mail.com', '72f9a6e735d90608ade08241dbbe27bd.jpg', 4, 'marzano', 'marzano', 'marzano', 'marzano', 'Стефано Марцано окончил Миланский технический университет с докторской степенью по архитектуре. Свою деятельность в Philips начал в 1973 году в Италии с работы над проектами в отделе крупной бытовой техники; с 1978 года работал в качестве главы направления дизайна систем данных и телекоммуникационной продукции Philips в Нидерландах; в 1982 вернулся в Италию, чтобы возглавить дизайн-центр Philips-Ire (крупная бытовая техника).'),
('musk', 'Ілон Маск', 'наслідник Тесли', 'Я залізна людина, хоча ні - Залізна людина це Я', 'musk@mail.com', 'elon_musk.jpg', 8, '', '', '', 'http://linkedin.com/mask', 'Ілон Маск біографія'),
('stroustrup', 'Б''ярн Страуструп', 'ідеолог С++', 'Навіщо говорити, вистрели собі в ногу, або покажи свій код', 'stroustrup@mail.com', 'f5725bb5bed7dc2edaefde7733fc7860.jpg', 7, 'stroustrup', 'stroustrup', 'stroustrup', 'stroustrup', 'stroustrup'),
('tesla', 'Нікола Тесла', 'творець ел.тех ери', 'Навіть рух стебла трави приносить зміни всесвіту', 'tesla@mail.com', '8a9a62313417ad012c3e7ab516b1041d.jpg', 9, 'tesla', 'tesla', 'tesla', 'tesla', 'Нико́ла Те́сла (серб. Ни́кола Те́сла, англ. Nikola Tesla; 10 июля 1856, Смилян, Австрийская империя, ныне в Хорватии — 7 января 1943, Нью-Йорк, США) — изобретатель в области электротехники и радиотехники сербского происхождения, инженер, физик. Родился и вырос в Австро-Венгрии, в последующие годы в основном работал во Франции и США. В 1891 году получил гражданство США.');
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `default_engine` (
  `id` int(1) NOT NULL,
  `site_name` varchar(30) NOT NULL,
  `per_page` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
--
INSERT INTO `default_engine` (`id`, `site_name`, `per_page`) VALUES
(1, 'Сучасні герої', 3);
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `create` int(16) NOT NULL,
  `descript` varchar(500) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;
--
INSERT INTO `news` (`id`, `title`, `create`, `descript`, `text`) VALUES
(2, 'srfdgsrg', 0, 'sfghdrtfgh', ''),
(3, 'sfhgsfghsdf', 0, 'srfgdhdgfh', ''),
(4, '1324123', 0, 'wertwer', ''),
(5, 'wergwer', 0, 'dfghfgth', ''),
(6, 'fnhgjfgdh', 0, 'drftghdsrtfh', ''),
(7, 'dyjdh', 0, 'drtyhdrthj', ''),
(8, 'srdysdxght', 0, 'dfghdfgjh', ''),
(9, 'sfjgfghj', 0, 'dfghjfghj', ''),
(10, 'dfgjfghkj asdjh klasdf halksd faalskjdf alsdkjfhasldkjf laskjdf laksdjf asldkjfahsdlkfjhasdf asdf', 0, 'fghfgj sdfjgsdl slkfjgsdlk fslkfj slkdjf sldkjg ls djfgsldkjf kdfsjgldksj ksljg sdljlsjkdf glskj s sljkfgshdlkfjgs dflsjd lsdkjfg sdfjkghs s ldgkfjhsalkgjsdflkjs flkj sldjfgslkjfghsdlkjfghsdljkfgh', 'іілпафо дфцоу фвдфлов фідвоафів флво флвіоа філвоа  jkhsldjfg slkdjfglskdjfg llsjdfglksdjfgklsdjfh lskdjfgldsjfgfj lsdkjgfh'),
(11, 'New News', 1482511452, 'New Descript', 'New Text'),
(12, 'test two #news+', 1482511661, 'descript two news', 'text two news ');
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
--
INSERT INTO `promo` (`id`, `title`, `text`, `photo`, `link`) VALUES
(1, 'Компанія "Тесла Моторс" розробила новий двигун', 'На останій виставці було представленно новий двигун, що спровокувало чимало запитань...', 'bg4.jpeg', 'http://vk.com'),
(2, 'Відбулася зістріч Айва з Марцано', 'Ключовими були питання звязані з авторськими правами', 'bg5.jpg', 'http://ukr.net'),
(3, 'Ілон Маск прогнозує колонізацію Марса.', 'Ілон Маск прогнозує колонізацію Марса. Для цього було розробленно новий скафандр', 'bg6.jpg', 'contacts/mask'),
(6, 'Знайденно секретні розробки Ніколи Тесла', 'Знайденно архів Ніколи Тесла, що відкрив таємницю вічного двигуна', '59000a49e41aa36c3bbe667f421a5c95.jpg', 'http://google.com'),
(7, 'Hello', 'I''m too', '97fd270b2a5a142a61090342d2774f02.jpg', 'news/id12');
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `control` enum('a','b') NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;
--
INSERT INTO `users` (`id_user`, `user_name`, `role`, `control`, `password`) VALUES
(1, 'admin', 'admin', 'a', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'zxcvxcx', 'admin', 'a', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'user', 'user', 'a', 'ee11cbb19052e40b07aac0ca060c23ee'),
(4, 'xcvbxcvbcxv', 'admin', 'b', '21232f297a57a5a743894a0e4a801fc3');

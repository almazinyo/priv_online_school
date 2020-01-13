-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2020 at 09:41 PM
-- Server version: 5.6.39-83.1
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cx50269_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE IF NOT EXISTS `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-auth-user_id-user-id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `user_id`, `source`, `source_id`) VALUES
(1, 2, 'vkontakte', '163662408'),
(2, 3, 'vkontakte', '362315917'),
(3, 4, 'vkontakte', '196663403'),
(4, 5, 'vkontakte', '1887916'),
(5, 6, 'vkontakte', '500729970'),
(6, 7, 'vkontakte', '226776813');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `title` varchar(500) NOT NULL,
  `img_name` varchar(500) DEFAULT NULL,
  `slug` varchar(500) NOT NULL,
  `short_description` text,
  `description` text,
  `seo_keywords` varchar(300) DEFAULT NULL,
  `seo_description` varchar(300) DEFAULT NULL,
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_subjects_blog` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `subject_id`, `title`, `img_name`, `slug`, `short_description`, `description`, `seo_keywords`, `seo_description`, `created_at`, `updated_at`, `is_status`) VALUES
(2, NULL, 'Глобальное потепление «подарило» человечеству опасный грибок и сделает его еще смертоноснее', 'bXSJNvLMC3cXI9DLve3BY46DZEoGszK3.jpg', 'global-noye-potepleniye-podarilo-chelovechestvu-opasnyy-gribok-i-sdelayet-yego-yeshche-smertonosneye', 'Глобальное потепление «подарило» человечеству опасный грибок и сделает его еще смертоноснее', '<p>Один из самых опасных для человека грибов, Candida auris, эволюционирует в сторону большей устойчивости к повышенным температурам, утверждают авторы исследования, опубликованного в журнале mBio. По словам ученых, это происходит из-за глобального потепления и может привести к тому, что главная природная защита человека против грибов — постоянно высокая температура тела — перестанет действовать. Вероятно, что Candida auris в принципе начал инфицировать людей из-за повышения температуры на планете, отмечают исследователи.</p><article><p>Грибы сравнительно редко поражают теплокровных животных. Одна из главных причин этого — диапазон комфортных для них температур. При 37—42 градусах Цельсия (обычно такова базальная температура тел млекопитающих и птиц) они с трудом растут и размножаются. Поэтому у человека грибковые инфекции чаще наблюдаются на менее теплых частях тела, а во внутренних органах — лишь у тех, чей иммунитет крайне ослаблен.</p><p>Последние десятилетия климат на Земле заметно теплеет, и грибы, как и другие живые организмы, должны приспособиться к новому температурному режиму. Если рассматривать только грибы, то, вероятно, наиболее разрушительные последствия человечеству принесет адаптация к жаре у Candida auris. Проникая в кровь, этот организм вызывает у людей инфекции с летальным исходом в 60 процентах случаев. Чаще всего им заражаются в больницах, где обитают наиболее устойчивые к лекарствам возбудители заболеваний. C. auris не исключение: это единственный гриб, для которого известны устойчивые ко всем антимикотикам штаммы.</p></article>', 'Глобальное потепление «подарило» человечеству опасный грибок и сделает его еще смертоноснее', 'Глобальное потепление «подарило» человечеству опасный грибок и сделает его еще смертоноснее', '1576225005', '1576225005', 1),
(3, 1, 'Сверхпроводимость муаровой сверхрешетки из графена оказалась настраиваемой', 'zcx-ZOIzTi3xN1byHDfMnMqkaSauQS31.jpg', 'sverkhprovodimost-muarovoy-sverkhreshetki-iz-grafena-okazalas-nastraivayemoy', 'Сверхпроводимость муаровой сверхрешетки из графена оказалась настраиваемой', '<p>Один из самых опасных для человека грибов, Candida auris, эволюционирует в сторону большей устойчивости к повышенным температурам, утверждают авторы исследования, опубликованного в журнале mBio. По словам ученых, это происходит из-за глобального потепления и может привести к тому, что главная природная защита человека против грибов — постоянно высокая температура тела — перестанет действовать. Вероятно, что Candida auris в принципе начал инфицировать людей из-за повышения температуры на планете, отмечают исследователи.</p><p>Грибы сравнительно редко поражают теплокровных животных. Одна из главных причин этого — диапазон комфортных для них температур. При 37—42 градусах Цельсия (обычно такова базальная температура тел млекопитающих и птиц) они с трудом растут и размножаются. Поэтому у человека грибковые инфекции чаще наблюдаются на менее теплых частях тела, а во внутренних органах — лишь у тех, чей иммунитет крайне ослаблен.</p><p>Последние десятилетия климат на Земле заметно теплеет, и грибы, как и другие живые организмы, должны приспособиться к новому температурному режиму. Если рассматривать только грибы, то, вероятно, наиболее разрушительные последствия человечеству принесет адаптация к жаре у Candida auris. Проникая в кровь, этот организм вызывает у людей инфекции с летальным исходом в 60 процентах случаев. Чаще всего им заражаются в больницах, где обитают наиболее устойчивые к лекарствам возбудители заболеваний. C. auris не исключение: это единственный гриб, для которого известны устойчивые ко всем антимикотикам штаммы.</p>', 'Сверхпроводимость муаровой сверхрешетки из графена оказалась настраиваемой', 'Сверхпроводимость муаровой сверхрешетки из графена оказалась настраиваемой', '1576225125', '1576225156', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grid_sort`
--

CREATE TABLE IF NOT EXISTS `grid_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `visible_columns` text,
  `default_columns` text,
  `page_size` varchar(300) DEFAULT NULL,
  `class_name` varchar(300) DEFAULT NULL,
  `theme` varchar(300) DEFAULT NULL,
  `label` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grid_sort`
--

INSERT INTO `grid_sort` (`id`, `user_id`, `visible_columns`, `default_columns`, `page_size`, `class_name`, `theme`, `label`) VALUES
(1, 3, NULL, NULL, NULL, 'common\\models\\Subjects', NULL, 'Предметы'),
(2, 3, '[\"id\",\"name\",\"sortable_id\",\"slug\",\"subject_id\",\"short_description\",\"description\",\"seo_keywords\",\"seo_description\",\"created_at\",\"updated_at\",\"is_status\"]', NULL, '', 'common\\models\\SectionSubjects', '', 'Разделы'),
(3, 3, NULL, NULL, NULL, 'common\\models\\Lessons', NULL, 'Уроки'),
(4, 1, NULL, NULL, NULL, 'common\\models\\SectionSubjects', NULL, 'Разделы'),
(5, 1, NULL, NULL, NULL, 'common\\models\\Subjects', NULL, 'Предметы'),
(6, 1, NULL, NULL, NULL, 'common\\models\\Lessons', NULL, 'Уроки'),
(7, 1, NULL, NULL, NULL, 'common\\models\\OrderList', NULL, 'Order Lists'),
(8, NULL, NULL, NULL, NULL, 'common\\models\\OrderList', NULL, 'Order Lists');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE IF NOT EXISTS `lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_lessons` int(11) DEFAULT '0',
  `name` varchar(500) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `background` varchar(300) DEFAULT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `slug` varchar(500) NOT NULL,
  `short_description` text,
  `description` text,
  `seo_keywords` varchar(300) DEFAULT NULL,
  `seo_description` varchar(300) DEFAULT NULL,
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lessons` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `sort_lessons`, `name`, `section_id`, `background`, `logo`, `slug`, `short_description`, `description`, `seo_keywords`, `seo_description`, `created_at`, `updated_at`, `is_status`) VALUES
(1, 0, 'Уравнение движения', 2, 'Фон', ' Логотип', 'uravneniye-dvizheniya', 'Урок 1', '<p>Урок 1. Уравнения движения и основные понятия.</p>', 'Уроки', 'Уроки', '1573018613', '1578353369', 1),
(2, 0, 'Пространство и время в теории относительности', 2, 'Фон', ' Логотип', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti', 'Пространство и время в теории относительности\r\n', '<ul><li>Пространство и время в теории относительности</li></ul><ul class=\"redactor-toolbar\" id=\"redactor-toolbar-0\"><span></span><li></li></ul>', 'Пространство и время в теории относительности', 'Пространство и время в теории относительности\r\n', '1573018715', '1573942686', 1),
(3, 0, 'Пространство и время в теории относительности', 2, 'Фон', 'Фон', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti-2', 'Урок 3', '<p>Описание </p>', 'Пространство и время в теории относительности', 'Краткое описание', '1573018796', '1573967921', 1),
(4, 0, 'Закон сохранения импульса', 8, 'Фон', ' Логотип', 'zakon-sokhraneniya-impul-sa-2', 'Краткое описание', '<p>Описание</p>', 'Уроки', 'Уроки', '1573967948', '1573968007', 1),
(5, 0, 'Пространство и время в теории относительности', 9, 'Фон', 'Фон', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti-3', 'Урок 3', '<p>Описание </p>', 'Пространство и время в теории относительности', 'Краткое описание', '1573968061', '1573968153', 1),
(6, 0, 'Закон сохранения импульса', 9, 'Фон', ' Логотип', 'zakon-sokhraneniya-impul-sa-3', 'Краткое описание', '<p>Описание</p>', 'Уроки', 'Уроки', '1573968309', '1573968367', 1),
(7, 0, 'Закон сохранения импульса', 10, 'Фон', ' Логотип', 'zakon-sokhraneniya-impul-sa-4', 'Краткое описание', '<p>Описание</p>', 'Уроки', 'Уроки', '1573968312', '1573968385', 1),
(8, 0, 'Пространство и время в теории относительности', 9, 'Фон', 'Фон', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti-4', 'Урок 3', '<p>Описание </p>', 'Пространство и время в теории относительности', 'Краткое описание', '1573968426', '1573968426', 1),
(9, 0, 'Пространство и время в теории относительности', 8, 'Фон', 'Фон', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti-5', 'Урок 3', '<p>Описание </p>', 'Пространство и время в теории относительности', 'Краткое описание', '1573968959', '1573968971', 1),
(10, 0, 'Пространство и время в теории относительности', 8, 'Фон', 'Фон', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti-6', 'Урок 3', '<p>Описание </p>', 'Пространство и время в теории относительности', 'Краткое описание', '1573968988', '1573968988', 1),
(11, 0, 'Пространство и время в теории относительности', 10, 'Фон', 'Фон', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti-7', 'Урок 3', '<p>Описание </p>', 'Пространство и время в теории относительности', 'Краткое описание', '1573969008', '1573969017', 1),
(12, 0, 'Пространство и время в теории относительности', 10, 'Фон', 'Фон', 'prostranstvo-i-vremya-v-teorii-otnositel-nosti-8', 'Урок 3', '<p>Описание </p>', 'Пространство и время в теории относительности', 'Краткое описание', '1573969022', '1573969022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `logo` varchar(500) DEFAULT NULL,
  `parent_id` varchar(300) DEFAULT '0',
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m130524_201442_init', 1577225361),
('m190124_110200_add_verification_token_column_to_user_table', 1577194836),
('m190813_092119_subjects', 1572817137),
('m190823_012957_blog', 1572817137),
('m190823_020442_section_subjects', 1572817137),
('m190831_093524_options', 1572817137),
('m190901_212843_lessons', 1572817137),
('m190903_104002_menu', 1572817137),
('m190903_110452_storage_lessons', 1572817137),
('m190910_070454_teachers', 1573333357),
('m190913_024036_profile', 1577225361),
('m190913_031513_order_list', 1578430866),
('m190913_083839_promotional_code', 1572817137),
('m190929_110438_quiz', 1572817137),
('m190929_110848_quizzes_users', 1572817137),
('m191011_030357_reviews', 1572817137),
('m191018_140218_grid_sort', 1572817137),
('m140506_102106_rbac_init', 1572818062),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1572818062),
('m180523_151638_rbac_updates_indexes_without_prefix', 1572818062),
('m191127_100141_auth', 1577225361),
('m191127_100204_session', 1577225362);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(500) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`) VALUES
(1, 'mainSection', 'a:3:{s:8:\"img_name\";s:37:\"sGOpcXJp25elPnH-fjA7HbSApnk4ZO95.jpeg\";s:4:\"name\";s:60:\"Более 1000 заданий из реальных ЕГЭ!\";s:11:\"description\";s:611:\"После каждого видеоурока необходимо правильно решить контрольные задания по пройденной теме, чтобы получить доступ к следующему занятию. В любой момент, для повторения раздела, можно вернуться к пройденному уроку и решать дополнительные задания. Если не получается решить с первого раза - можно всегда посмотреть подробное решение.\";}'),
(2, 'mainSection', 'a:3:{s:8:\"img_name\";s:37:\"rgWEu7ETukvz6Fl516OZQsw2AoJexZ0N.jpeg\";s:4:\"name\";s:67:\"Видеоуроки на 80% состоят из практики!\";s:11:\"description\";s:476:\"Формат видеоуроков нацелен исключительно на результат. Уже после прохождения первого урока вы сразу начнете решать реальные задачи из ЕГЭ. Уровень сложности будет постепенно расти с каждым уроком- так что вы легко научитесь выполнять даже задания “части С”.\";}'),
(3, 'mainSection', 'a:3:{s:8:\"img_name\";s:37:\"ulEAcZarB0Vp1NjPbbQrDLFF9YY2xMNf.jpeg\";s:4:\"name\";s:55:\"Остались вопросы - запишись на\";s:11:\"description\";s:410:\"бесплатное онлайн занятие!\r\nВ любой момент можно записаться на бесплатное онлайн занятие с опытными преподавателями - экспертами ЕГЭ. Актуальное расписание занятий по каждому предмету можно узнать в нашей группе Вконтакте.\";}');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE IF NOT EXISTS `order_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subjects_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `operation_label` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `operation_id` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datetime` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notification_type` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_user` (`user_id`),
  KEY `FK_order_subject` (`subjects_id`),
  KEY `FK_order_section` (`section_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `user_id`, `subjects_id`, `section_id`, `name`, `email`, `price`, `sender`, `operation_label`, `operation_id`, `datetime`, `notification_type`, `is_status`) VALUES
(7, 2, NULL, 14, 'Arsen Papikyan', NULL, '1.99', '410019506852585', '25a85e2a-0011-5000-a000-1d6039e29d09', '631834351967017004', '2020-01-08T21:32:31Z', 'p2p-incoming', 1),
(9, 2, NULL, 14, 'Arsen Papikyan', NULL, '1.99', '410019506852585', '25a85e2a-0011-5000-a000-1d6039e29d09', '631834351967017004', '2020-01-08T21:32:31Z', 'p2p-incoming', 1),
(12, 2, NULL, 14, 'Arsen Papikyan', NULL, '1.99', '410019506852585', '25a85e2a-0011-5000-a000-1d6039e29d09', '631834351967017004', '2020-01-08T21:32:31Z', 'p2p-incoming', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `bonus_points` int(11) DEFAULT NULL,
  `first_name` varchar(300) DEFAULT NULL,
  `last_name` varchar(300) DEFAULT NULL,
  `date_of_birth` varchar(300) DEFAULT NULL,
  `phone` varchar(300) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `city` varchar(300) DEFAULT NULL,
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_profile_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `bonus_points`, `first_name`, `last_name`, `date_of_birth`, `phone`, `image`, `city`, `created_at`, `updated_at`, `is_status`) VALUES
(1, 2, 0, 'Arsen', 'Papikyan', '', '00000000000', '6GjHSpUxud4.jpg', 'Gyumri', '1577225399', NULL, 1),
(2, 3, 0, 'Linaz', 'Rizvanov', '', '79173936213', 'ILhzNUOc4Nk.jpg', 'Almetyevsk', '1577248345', NULL, 1),
(3, 4, 0, 'Timur', 'Zakirov', '1-12', NULL, 'PamqThg6Ndo.jpg', 'Kazan', '1577251389', NULL, 1),
(4, 5, 0, 'Rishat', 'Dunaev', '11-1-1990', NULL, 'JTtcMjpto4M.jpg', 'Kazan', '1578327437', NULL, 1),
(5, 6, 0, 'Anna', 'Tiraturyan', '', NULL, 'cDvRhFPQkWE.jpg', 'Moscow', '1578509506', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotional_code`
--

CREATE TABLE IF NOT EXISTS `promotional_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subjects_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `created_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_promotional_user` (`user_id`),
  KEY `FK_promotional_subject` (`subjects_id`),
  KEY `FK_promotional_section` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lessons_id` int(11) DEFAULT NULL,
  `bonus_points` int(11) DEFAULT NULL,
  `question` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hint` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correct_answer` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_quiz_lessons` (`lessons_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `lessons_id`, `bonus_points`, `question`, `hint`, `correct_answer`, `created_at`, `updated_at`, `is_status`) VALUES
(1, 1, 20, 'rF-g6b13N0rg-lza78tiEYD-Rnn3T9ej.jpg', 'aEqbZSfPXt5bMUBNSgg8rkV_rp0jNDbk.jpg', '5', '1573019917', '1573019917', 1),
(2, 1, 20, 'rF-g6b13N0rg-lza78tiEYD-Rnn3T9ej.jpg', 'aEqbZSfPXt5bMUBNSgg8rkV_rp0jNDbk.jpg', '5', '1574025742', '1574025742', 1),
(3, 1, 20, 'rF-g6b13N0rg-lza78tiEYD-Rnn3T9ej.jpg', 'aEqbZSfPXt5bMUBNSgg8rkV_rp0jNDbk.jpg', '5', '1574025747', '1574025747', 1),
(4, 1, 20, 'rF-g6b13N0rg-lza78tiEYD-Rnn3T9ej.jpg', 'aEqbZSfPXt5bMUBNSgg8rkV_rp0jNDbk.jpg', '5', '1574025748', '1574025748', 1),
(5, 1, 20, 'rF-g6b13N0rg-lza78tiEYD-Rnn3T9ej.jpg', 'aEqbZSfPXt5bMUBNSgg8rkV_rp0jNDbk.jpg', '5', '1574025749', '1574025749', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes_users`
--

CREATE TABLE IF NOT EXISTS `quizzes_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `created_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_quizzes_users_user` (`user_id`),
  KEY `FK_quizzes_users_quiz` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subjects_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `rating` tinyint(2) DEFAULT NULL,
  `description` text,
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reviews_user` (`user_id`),
  KEY `FK_reviews_subject` (`subjects_id`),
  KEY `FK_reviews_section` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `section_subjects`
--

CREATE TABLE IF NOT EXISTS `section_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `sortable_id` int(11) DEFAULT '0',
  `price` varchar(500) NOT NULL,
  `background` varchar(300) DEFAULT NULL,
  `icon` varchar(500) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `seo_keywords` varchar(300) DEFAULT NULL,
  `seo_description` varchar(300) DEFAULT NULL,
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  `img_path` varchar(500) NOT NULL,
  `stock` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_subjects` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section_subjects`
--

INSERT INTO `section_subjects` (`id`, `subject_id`, `parent_id`, `name`, `slug`, `sortable_id`, `price`, `background`, `icon`, `short_description`, `description`, `seo_keywords`, `seo_description`, `created_at`, `updated_at`, `is_status`, `img_path`, `stock`) VALUES
(1, 1, 0, 'Механика', 'mekhanika', 0, '1450', '#F18764', 'physics', 'Механика', '<p>Механика включает в себя 5 подразделов - Кинематика, Динамика, Статика, Законы сохранения, Колебания и Волны</p>', 'Механика ', 'Механика', '1573017396', '1578350944', 1, 'http://api.examator.ru/images/sections/2dChT1VcvxfV1USccyVCIlmmKr1vN-5_.svg', ''),
(2, 1, 1, 'Кинематика', 'kinematika', 1, '1450', '#ed5a7a', 'course', 'Характеристики движения тела', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Кинематика', 'Кинематика', '1573017485', '1576135325', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', ''),
(3, 1, 0, 'Термодинамика', 'termodinamika', 2, '4500', '#3FB7F6', '', 'МКТ и Термодинамика', '<p>МКТ и Термодинамика</p>', '', '', '1573911681', '1578350875', 1, 'http://api.examator.ru/images/sections/VptqQwB-Z737fpuDh_0cEVOGDvGH1YpD.svg', ''),
(6, 1, NULL, 'Уравнения', 'uravneniya-2', NULL, '400', '#3c78d8', 'physics', 'Математика — область естествознания: наука о законах природы.', '<p>Математика — область естествознания: наука о законах природы. Математика — область естествознания: наука о законах природы.<span class=\"redactor-invisible-space\"> Математика — область естествознания: наука о законах природы.<span class=\"redactor-invisible-space\"></span></span></p>', '', '', '1573913672', '1573913705', 1, '', ''),
(8, 1, 1, 'Динамика', 'dinamika', 1, '1250', '#ed5a7a', 'physics', 'Силы в природе, законы Ньютона', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Динамика', 'Динамика', '1573967365', '1576135255', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', ''),
(9, 1, 1, 'Законы сохранения', 'zakony-sokhraneniya', 3, '800', '#3fb7f6', 'russian', 'Законы сохранения импульса и энергии', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Неинерциальные системы отсчета', 'Законы сохранения импульса и энергии', '1573967641', '1576135156', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', ''),
(10, 1, 1, 'Статика', 'statika', 4, '500', '#9e9e9e', 'social', 'Равновесие тел', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Статика', 'Статика', '1573967644', '1576135068', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', ''),
(11, 1, 0, 'Электричество', 'elektrichestvo', NULL, '500', '#f6b26b', '', 'Электричество и Магнетизм', '<p>Электричество и Магнетизм состоит из 4 подразделов: </p><p>- Электростатика</p><p>- Постоянный ток</p><p>- Магнитное поле</p><p>- Электромагнитные колебания</p>', '', 'Физика ЕГЭ электростатика постоянный ток магнитное поле', '1578351325', '1578351325', 1, '', ''),
(12, 1, 0, 'Оптика и Атомная физика', 'optika-i-atomnaya-fizika', NULL, '500', '#e69138', '', 'Оптика и атомная физика', '<p>Геометрическая и волновая оптика</p><p>Атомная и Ядерная физика</p>', '', '', '1578351670', '1578351709', 1, '', ''),
(13, 1, 0, 'Квантовая физика', 'kvantovaya-fizika', NULL, '500', '#cc0000', '', 'Кванты и фотоэффект', '<p>Квантовая физика</p><p>Фотоэффект</p>', '', '', '1578351896', '1578351942', 1, '', ''),
(14, 1, 1, 'Колебания', 'kolebaniya', NULL, '2', '#980000', '', 'Колебания и волны', '<p>Механические колебания и волны</p>', '', '', '1578352077', '1578518029', 1, '', ''),
(15, 1, 3, 'МКТ', 'mkt', NULL, '500', '#1c4587', '', '', '', '', '', '1578352162', '1578352415', 1, '', ''),
(18, 1, 3, 'Термодинамика', 'termodinamika-3', NULL, '500', '#a61c00', '', '', '', '', '', '1578352485', '1578352485', 1, '', ''),
(19, 1, 11, 'Электростатика', 'elektrostatika', NULL, '500', '#cc4125', '', 'Электростатика', '', '', '', '1578352578', '1578352578', 1, '', ''),
(20, 1, 11, 'Постоянный ток', 'postoyannyy-tok', NULL, '500', '#cc4125', '', 'постоянный ток', '', '', '', '1578352639', '1578352639', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  `token` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` smallint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk-session-user_id-user-id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `expire`, `data`, `token`, `user_id`, `status`) VALUES
(1, 1577226797, 0x31353737323235333938, 'yIlk8xVx443-NKU8isEXpR1hlhWjJf3H', 2, 1),
(2, 1577227261, 0x31353737323236393132, 'gL7VFrFm96OJqTfMlQQBkxHpqPpQZ2zV', 2, 1),
(3, 1577228219, 0x31353737323237373837, 'R0-AVo4w09GaAe6LpZ61tmZA6e_vNuhc', 2, 1),
(7, 1577248353, 0x31353737323438333435, 'oFz5bkAG9ANru3VAgg9piGKVx8v8TPa7', 3, 1),
(8, 1585024577, 0x31353737323438353737, 'GjWMIbTezWT7GPss1Uayrk9gXo5TCRbV', 3, 1),
(62, 1585027388, 0x31353737323531333838, 'Wndz1b9mVMFnih42rPxYiXpwHJMAHk0d', 4, 1),
(63, 1577258518, 0x31353737323538333733, 'igQgcSwZzDyS4osX7cOueCK3N5h6zxmm', 2, 1),
(64, 1585034564, 0x31353737323538353634, 'eu3HIgrkPbbXt7s0o6lOfFya-iTaxooo', 2, 1),
(65, 1586103436, 0x31353738333237343336, 'o-TXleXvg0LaK1B0mFpPk14omdWliiSY', 5, 1),
(66, 1586285506, 0x31353738353039353036, 'N78h9wmN-cmulC4En1WYpqTEKj1052hZ', 6, 1),
(67, 1586504556, 0x31353738373238353536, '3kEM4hBtosQlWIAUM5okidm3EY_u1ZhN', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `storage_lessons`
--

CREATE TABLE IF NOT EXISTS `storage_lessons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `name` varchar(500) NOT NULL,
  `type` varchar(500) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_storage` (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storage_lessons`
--

INSERT INTO `storage_lessons` (`id`, `lesson_id`, `name`, `type`, `is_status`) VALUES
(1, 1, 'rm2gTCpTzTNy2JNiCheBr4eRWU8JQyHD.png', 'image', 1),
(2, 1, 'ohKgfXq8GmkkAWHWsdMTRnc0np8Xdub2.png', 'image', 1),
(3, 1, 'wT5ccHK0LVpbo8CQg0daL2fgK30MTKt9.png', 'image', 1),
(8, 1, 'gIFJ4nsee0HasPm3lvQNc2XeEsB1Kau4.pdf', 'pdf', 1),
(9, 1, '6a2kAHo8r5Fcs0FsO_getrUGSEOdX-YC.mp4', 'video', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `icon` text,
  `color` varchar(300) DEFAULT NULL,
  `sortable_id` varchar(300) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `seo_keywords` varchar(300) DEFAULT NULL,
  `seo_description` varchar(300) DEFAULT NULL,
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `title`, `slug`, `icon`, `color`, `sortable_id`, `short_description`, `description`, `seo_keywords`, `seo_description`, `created_at`, `updated_at`, `is_status`) VALUES
(1, 'Физика', 'fizika', 'physics', '#77e624', '2', 'ЕГЭ по Физике состоит из 32 заданий. ', '<p>ЕГЭ по Физике состоит из 32 заданий. </p><p>Основные разделы Физики:</p><p>- Механика</p><p>- МКТ и Термодинамика</p><p>- Электричество и магнетизм</p><p>- Атомная и ядерная физика</p><p>- Квантовая физика</p>', 'Физика', 'Физика подготовка к ЕГЭ', '1573016152', '1578350660', 1),
(2, 'Математика ', 'matematika', 'map', '#ed597a', '1', 'ЕГЭ по Математике состоит из 19 заданий. Первая часть содержит 12 заданий, остальные 7 заданий требуют полного решения.', '<p>ЕГЭ по Математике состоит из 19 заданий. Первая часть содержит 12 заданий, остальные 7 заданий требуют полного решения.</p>', 'Математика', 'Математика', '1573163016', '1578472182', 1),
(3, 'Русский', 'russkiy', 'russian', '#3fb7f6', '3', 'Русский ', '<p>Русский</p>', 'Русский', 'Русский', '1573723148', '1576223656', 2),
(4, 'Общество', 'obshchestvo', 'social', '#9e9e9e', '4', 'Общество', '<p>Общество</p>', 'Общество', 'Общество', '1573933584', '1576228209', 2),
(5, 'История', 'istoriya', 'history', '#50b6ac', '5', 'История', '<p>История</p>', 'История', 'История', '1573933777', '1576228214', 2),
(6, 'Химия', 'khimiya', 'chemistry', '#9fa8da', '6', 'Химия', '<p>Химия</p>', 'Химия', '', '1573934126', '1576228218', 2),
(7, 'Биология', 'biologiya', 'biology', '#81c783', '7', 'Биология', '<p>Биология</p>', 'Биология', 'Биология', '1573934265', '1576228226', 2);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `social_link` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_experience` tinyint(2) DEFAULT NULL,
  `img_name` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `small_img_path` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `large_img_path` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_teachers` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `subject_id`, `social_link`, `work_experience`, `img_name`, `small_img_path`, `large_img_path`, `slug`, `description`, `created_at`, `updated_at`, `is_status`) VALUES
(1, 'Алмаз Хан', 1, 'https://vk.com/aalmaz_khan', 11, 'pQsSnp2Pzp7Y1JDCm86xs8PYVZGnODCY.png', 'http://api.examator.ru/images/teachers/small/pQsSnp2Pzp7Y1JDCm86xs8PYVZGnODCY.png', 'http://api.examator.ru/images/teachers/pQsSnp2Pzp7Y1JDCm86xs8PYVZGnODCY.png', 'almaz-khan', '<p>Алмаз Хан</p>', '1573333440', '1578353159', 1),
(2, 'Алмаз Хан', 2, 'https://vk.com/aalmaz_khan', 2, '0SVejAe18mQhFW0uCy48NUMXD5DaMmB6.png', 'http://api.examator.ru/images/teachers/small/0SVejAe18mQhFW0uCy48NUMXD5DaMmB6.png', 'http://api.examator.ru/images/teachers/0SVejAe18mQhFW0uCy48NUMXD5DaMmB6.png', 'almaz-khan-2', '<p>Математика</p>', '1573386479', '1578353191', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'wNmbaJAt0DJLAFeJDB43mo1KpKfykMtZ', '$2y$13$KqIIHX9RYheiRuLWnA07oOBTJUxhrX1Xi6nichnglxJaosl8AwdIy', NULL, 'admin@example.com', 10, 1577225361, 1577225361),
(2, '163662408', 'Sr7p3ThOJ2BbbNMneczZp4UmdZJT-krX', '$2y$13$2LCd4XTU0S5RmVBbn6Au0OtjadFQ1iD6x9GKVRauQPaZCkKuzjBc2', 'lH5bww1EpjL3FwOsizqqH_RVa1oq-ALC', 'teste@mail.ru', 10, 1577225398, 1577258752),
(3, '362315917', 'qwCgHT94uTh_Z4hHbmExk-UaUC78DNom', '$2y$13$UYP6ljbt2tO1rXQ.swx4J.z2Xk4U4sZfb3j6MzV13.WV7131x4/3m', 'wpSNfmgX4AGOTZkZvbU_skDmXNj0Rtxn', 'test@test.ru', 10, 1577248345, 1577248533),
(4, '196663403', 'GMFzOGPIutylGjktl3-mVqqsJly-6u71', '$2y$13$edTC2WX9xFvyGinh8Hgkt.CN0/48F2sgPyqXR5oKcJZszLhy72i3S', 'Xt-_Cb7pPEO92sRYJhsXj-FKjGIRuipy', ' ', 10, 1577251388, 1577251388),
(5, '1887916', 'ddgiShvH3H-195CuJoFpT-rCvSQYU3Ku', '$2y$13$pgQ9EpvQsjB6L4rbuxtPLeaEa9ct.NMw1YjXPraviWD6WMU5Jq/g2', 'kpvFoCthPnSrgk-dD2mV2CwhS7ysHRh5', ' ', 10, 1578327436, 1578327436),
(6, '500729970', 'PLkLEMoX1WUoy1pOQ7oKv_a-9t0eJQKo', '$2y$13$tDFUQ/Bmk1srTqW.wedCFeuG7FghtKYFIgJXbRgG6YL2B4/4QD5ga', 'AcQtwgUU-6ppga9mVR9_JqucEnIHNy4q', ' ', 10, 1578509506, 1578509506),
(7, '226776813', 'DJ0HaYclFylVMyLY52yM-EoTfR3rm82W', '$2y$13$Oet5wLVZIWcpVY4X50hUAufP9ugcE6LHgDPBRJE9PUG19Nbd05VMG', 'KqK5bSVfw5rt_LKNziqu8kTTju4cUtLY', ' ', 10, 1578728510, 1578728510);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk-auth-user_id-user-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `FK_subjects_blog` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `FK_lessons` FOREIGN KEY (`section_id`) REFERENCES `section_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_list`
--
ALTER TABLE `order_list`
  ADD CONSTRAINT `FK_order_section` FOREIGN KEY (`section_id`) REFERENCES `section_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_subject` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `FK_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotional_code`
--
ALTER TABLE `promotional_code`
  ADD CONSTRAINT `FK_promotional_section` FOREIGN KEY (`section_id`) REFERENCES `section_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_promotional_subject` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_promotional_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `FK_quiz_lessons` FOREIGN KEY (`lessons_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizzes_users`
--
ALTER TABLE `quizzes_users`
  ADD CONSTRAINT `FK_quizzes_users_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_quizzes_users_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_section` FOREIGN KEY (`section_id`) REFERENCES `section_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_subject` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `section_subjects`
--
ALTER TABLE `section_subjects`
  ADD CONSTRAINT `FK_subjects` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk-session-user_id-user-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `storage_lessons`
--
ALTER TABLE `storage_lessons`
  ADD CONSTRAINT `FK_storage` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `FK_teachers` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

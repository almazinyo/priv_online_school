-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 13, 2019 at 01:40 PM
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
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-auth-user_id-user-id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `user_id`, `source`, `source_id`) VALUES
(10, 18, 'vkontakte', '500729970'),
(30, 133, 'vkontakte', '32300688'),
(29, 132, 'vkontakte', '1887916'),
(28, 131, 'vkontakte', '163662408');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grid_sort`
--

INSERT INTO `grid_sort` (`id`, `user_id`, `visible_columns`, `default_columns`, `page_size`, `class_name`, `theme`, `label`) VALUES
(1, 3, NULL, NULL, NULL, 'common\\models\\Subjects', NULL, 'Предметы'),
(2, 3, '[\"id\",\"name\",\"sortable_id\",\"slug\",\"subject_id\",\"short_description\",\"description\",\"seo_keywords\",\"seo_description\",\"created_at\",\"updated_at\",\"is_status\"]', NULL, '', 'common\\models\\SectionSubjects', '', 'Разделы'),
(3, 3, NULL, NULL, NULL, 'common\\models\\Lessons', NULL, 'Уроки');

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
(1, 0, 'Закон сохранения импульса', 2, 'Фон', ' Логотип', 'zakon-sokhraneniya-impul-sa', 'Краткое описание', '<p>Описание</p>', 'Уроки', 'Уроки', '1573018613', '1573940145', 1),
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
('m000000_000000_base', 1572817133),
('m130524_201442_init', 1572817137),
('m190124_110200_add_verification_token_column_to_user_table', 1572817137),
('m190813_092119_subjects', 1572817137),
('m190823_012957_blog', 1572817137),
('m190823_020442_section_subjects', 1572817137),
('m190831_093524_options', 1572817137),
('m190901_212843_lessons', 1572817137),
('m190903_104002_menu', 1572817137),
('m190903_110452_storage_lessons', 1572817137),
('m190910_070454_teachers', 1573333357),
('m190913_024036_profile', 1575385105),
('m190913_031513_order_list', 1572817137),
('m190913_083839_promotional_code', 1572817137),
('m190929_110438_quiz', 1572817137),
('m190929_110848_quizzes_users', 1572817137),
('m191011_030357_reviews', 1572817137),
('m191018_140218_grid_sort', 1572817137),
('m140506_102106_rbac_init', 1572818062),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1572818062),
('m180523_151638_rbac_updates_indexes_without_prefix', 1572818062);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(500) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE IF NOT EXISTS `order_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `subjects_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_user` (`user_id`),
  KEY `FK_order_subject` (`subjects_id`),
  KEY `FK_order_section` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `city` varchar(300) DEFAULT NULL,
  `created_at` varchar(300) DEFAULT NULL,
  `updated_at` varchar(300) DEFAULT NULL,
  `is_status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_profile_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `bonus_points`, `first_name`, `last_name`, `date_of_birth`, `phone`, `city`, `created_at`, `updated_at`, `is_status`) VALUES
(1, 18, 20, 'test', 'test', '1995-10-01', '70000000000', 'Москва', '', '', 1),
(3, 131, NULL, 'test', 'ew', NULL, '00000000000', 'xdas', NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section_subjects`
--

INSERT INTO `section_subjects` (`id`, `subject_id`, `parent_id`, `name`, `slug`, `sortable_id`, `price`, `background`, `icon`, `short_description`, `description`, `seo_keywords`, `seo_description`, `created_at`, `updated_at`, `is_status`, `img_path`, `stock`) VALUES
(1, 1, 0, 'Механика', 'mekhanika', 0, '1450', '#F18764', 'physics', 'Фи́зика — область естествознания: наука о законах природы.', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. Так, исследования в области электромагнетизма привели к появлению телефонов и позже мобильных телефонов, открытия в термодинамике позволили создать автомобиль, развитие электроники привело к появлению компьютеров. Развитие фотоники способно дать возможность создать принципиально новые — фотонные — компьютеры и другую фотонную технику, которые сменят существующую электронную технику. Развитие газодинамики привело к появлению самолётов и вертолётов.</p>', 'Механика ', 'Механика', '1573017396', '1573935741', 1, 'http://api.examator.ru/images/sections/2dChT1VcvxfV1USccyVCIlmmKr1vN-5_.svg', ''),
(2, 1, 1, 'Кинематика', 'kinematika', 1, '1450', '#ed5a7a', 'course', 'Характеристики движения тела', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Кинематика', 'Кинематика', '1573017485', '1576135325', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', ''),
(3, 1, 0, 'Термодинамика', 'termodinamika', 2, '4500', '#3FB7F6', '', 'Фи́зика (от др.-греч. φύσις — природа) ', '<p>Фи́зика (от др.-греч. φύσις — природа) — область естествознания: наука о простейших и вместе с тем наиболее общих законах природы, о материи, её структуре и движении. Фи́зика (от др.-греч. φύσις — природа) — область естествознания: наука о простейших и вместе с тем наиболее общих законах природы, о материи, её структуре и движении.<span class=\"redactor-invisible-space\"> Фи́зика (от др.-греч. φύσις — природа) — область естествознания: наука о простейших и вместе с тем наиболее общих законах природы, о материи, её структуре и движении.<span class=\"redactor-invisible-space\"> </span></span></p>', '', '', '1573911681', '1576135371', 1, 'http://api.examator.ru/images/sections/VptqQwB-Z737fpuDh_0cEVOGDvGH1YpD.svg', ''),
(6, 1, NULL, 'Уравнения', 'uravneniya-2', NULL, '400', '#3c78d8', 'physics', 'Математика — область естествознания: наука о законах природы.', '<p>Математика — область естествознания: наука о законах природы. Математика — область естествознания: наука о законах природы.<span class=\"redactor-invisible-space\"> Математика — область естествознания: наука о законах природы.<span class=\"redactor-invisible-space\"></span></span></p>', '', '', '1573913672', '1573913705', 1, '', ''),
(8, 1, 1, 'Динамика', 'dinamika', 1, '1250', '#ed5a7a', 'physics', 'Силы в природе, законы Ньютона', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Динамика', 'Динамика', '1573967365', '1576135255', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', ''),
(9, 1, 1, 'Законы сохранения', 'zakony-sokhraneniya', 3, '800', '#3fb7f6', 'russian', 'Законы сохранения импульса и энергии', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Неинерциальные системы отсчета', 'Законы сохранения импульса и энергии', '1573967641', '1576135156', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', ''),
(10, 1, 1, 'Статика', 'statika', 4, '500', '#9e9e9e', 'social', 'Равновесие тел', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий.<span class=\"redactor-invisible-space\"></span></p>', 'Статика', 'Статика', '1573967644', '1576135068', 1, 'http://api.examator.ru/images/sections/XNVDOzzYPwZLFCaRJ_ShZoVjOZC92b0K.svg', '');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  `token` varchar(500) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` smallint(1) DEFAULT '0',
  KEY `fk-session-user_id-user-id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `expire`, `data`, `token`, `user_id`, `status`) VALUES
('HiJJXcAnPaRzFfUaCtcoMVdTcNd2M1HUaUM7Xuiu', 1574753775, NULL, 'QaCDwaWTgLpNCI1lR5PfaAsEaoX2DL_8', 17, 1),
('LIbjS-qlaH37CtSA48vyJBTMaCr-Y76hZWlB9PXr', 1575121232, NULL, 'khDSC_vEEInOaPk0TAy4iMlYG_Y8-E_5', 18, 1),
('3D8PkY4qhvEXVgLKoqO2uqRAjm-5YE2sZrlFNySK', 1575357109, NULL, 'EmAwrfXGY0aXzeg4N0RPzxKPk0HgOJ46', 20, 1),
('TrylV0c7-xVoYp50wly38BUCRiXmjMHQJ0VWGfFZ', 1575357154, NULL, 'Tgi832U8rScySEzjIbTEwJpFKPdbwDw9', 22, 1),
('3IXi91rYUSWnEC4tCx61VMOa7fDTI4fhsRs8wal_', 1575357229, NULL, 'Nokm7jKhW8RetEk9YaaeLUgVGDj4gITa', 18, 1),
('h-fdtdArgMyrpUMvch5aN7w2TBbF_AZKDKJlr9lw', 1575446988, NULL, 'r5UuUsujgq-qSnp9Imna6eSP5AcdF_fW', 40, 1),
('zCgycNqJu-Nnx4-8KGPpLveQkeu8TeSrDFQTZ-ty', 1575463217, NULL, '8fE-L0dUnxpiHU12zu1HQd1ylIi5cxU8', 67, 1),
('S4d_IQjHiTw6CeqyNvpWAajswciIC_rkldt3MuOn', 1575463319, NULL, 'NambWVhaXJkI-R-M6M91fOH35St-ABax', 68, 1),
('aqedVpUwhjq9dshg8-rGLKQ6QzKdkR_tGSfJSFyl', 1575463339, NULL, 'bD1aZGmj6FXWOd7sLLTMuU7dX7knoj_8', 69, 1),
('xBZxyCNKqqbKze_bqAJqRvvunZv9m-LiVCw2AUCc', 1575522420, NULL, 'THyfZfkvCODM067Fu8yRDvYddmOmOVvh', 71, 1),
('E8mB8LuNkxjzwSznP2bEHeHF-BN9O4P8TqOrOw1r', 1575522755, NULL, 'ZxilRU6CmFd-Ixkd-WBshtU4fdAu0sTP', 72, 1),
('qqZCNs4sa3yEk98AsynVQL4xEielOJtpLMXoSOn4', 1575570627, NULL, 'ICTXqqFNy5gmBas_iYgBm82vSfx1sCeK', 77, 1),
('D_fEa_7d22i0fRD7AWKxp7wwKx99fyyH4y9dcFXh', 1575570654, NULL, 'yUidPsqYHcM46_jI4dty5uoRTA89FZFE', 78, 1),
('jrtvWzTNosyhorRCTGrR2SwuerHgXKO9uJgZYB0a', 1575608802, NULL, 'kFYkHCw7EwT_7s3FGxBvAHKGF-tMBmRe', 80, 1),
('aH1U1H8sFIuNymR7KVNGOP7nYdR-CMTIZNaFWCuN', 1575873560, NULL, 'jcc5tJnOtPl4utUAfPVIGNCwEH1X8LhW', 105, 1),
('n7kDkA7ydj0WCZPyOlpUdu7_koQuhnOqTLAMFNGi', 1575875441, NULL, 'dNKQyJxJTnabuAbJHPyO025Gpfy-DYbW', 119, 1),
('I39TpKTZ2WUfvF5y5dmWVT53nCmDQ2ULMNd2EgJa', 1575875582, NULL, '2hMeQqIjhohgkUiqKEBkH4E3L0yCFdmC', 122, 1),
('Wh0c9nJoWdqiuBO23AIrVBOQOkF7SpkMuyTnFIyy', 1575875688, NULL, 'fCGqkg3Dqq3oH8TkQwgSI1kUxuieEqOe', 124, 1),
('9o95pteaenkc7XfcoPknn2b0WYmIokvFCxdJ08M2', 1575875721, NULL, 'D1n5taGTWbAyMqCRbLUE_4WA_MlKkTAa', 126, 1),
('We1wg3GQce9IWzlevOYM5_HkAXTYYWeZVH_vBN2c', 1575876624, NULL, 'wyBzAKEwS9_kPeDlWwyUoF9AR-VuRJYD', 127, 1),
('qTAF8-0qbcHVJYIKVD0MmBRAbt-g0TGq-F0Tbj5R', 1575876881, NULL, 'LT-dHSCGTDR3bJ3CnuWdEGcX31KsqevH', 131, 1),
('bouQfuDD8DVLkKODX9-Ad0KYarWzAP_ZNRZZvsgn', 1575912748, NULL, 'VRlphXha5yOzZNSSRIiACrYbgfe_PLCr', 18, 1),
('NKmgzpE6QIXOHCdfASM_6mlSpvBuOZ42m0sr6_yy', 1575959416, NULL, 'w806lAT98-e3WfkCuJvSJFsl_5PW_Eoy', 132, 1),
('ghvjVq1rsn5QuZ1VciZKZCxUkYEDsAhjTeuRfRPT', 1576107415, NULL, 'Fs1aOUsl6Eyke37QDgaBYfpM0EuebMb4', 133, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `storage_lessons`
--

INSERT INTO `storage_lessons` (`id`, `lesson_id`, `name`, `type`, `is_status`) VALUES
(1, 1, 'rm2gTCpTzTNy2JNiCheBr4eRWU8JQyHD.png', 'image', 1),
(2, 1, 'ohKgfXq8GmkkAWHWsdMTRnc0np8Xdub2.png', 'image', 1),
(3, 1, 'wT5ccHK0LVpbo8CQg0daL2fgK30MTKt9.png', 'image', 1),
(4, 1, 'XWa7xAKeuKjeRK_B0dL0vQQLeEx2dv51.mp4', 'video', 1),
(5, 1, 'Uo01bTEf6v38SoWmsfUAUMY4Ry9T4KhH.pdf', 'pdf', 1),
(6, 1, 'jkJS4rAd7CpyytWiQj_9NPNtPLMmJ-3P.mp4', 'video', 1);

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
(1, 'Физика', 'fizika', 'physics', '#77e624', '2', 'В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. ', '<p>В современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. Так, исследования в области электромагнетизма привели к появлению телефонов и позже мобильных телефонов, открытия в термодинамике позволили создать автомобиль, развитие электроники привело к появлению компьютеров. Развитие фотоники способно дать возможность создать принципиально новые — фотонные — компьютеры и другую фотонную технику, которые сменят существующую электронную технику. Развитие газодинамики привело к появлению самолётов и вертолётов.</p><p>Знания физики процессов, происходящих в природе, постоянно расширяются и углубляются. Большинство новых открытий вскоре получают технико-экономическое применение (в частности в промышленности). Однако перед исследователями постоянно встают новые загадки, — обнаруживаются явления, для объяснения и понимания которых требуются новые физические теории. Несмотря на огромный объём накопленных знаний, современная физика ещё очень далека от того, чтобы объяснить все явления природы.</p><p>Общенаучные основы физических методов разрабатываются в теории познания и методологии науки.</p><p>В русский язык слово «физика» было введено М. В. Ломоносовым, издавшим первый в России учебник физики — свой перевод с немецкого языка учебника «Вольфианская экспериментальная физика» Х. Вольфа (1746)[3]. Первым оригинальным учебником физики на русском языке стал курс «Краткое начертание физики» (1810), написанный П. И. Страховым.</p>', 'Физика', 'Физика', '1573016152', '1573933275', 1),
(2, 'Математика', 'matematika', 'map', '#ed597a', '1', 'Математика', '<p>Математика</p>', 'Математика', 'Математика', '1573163016', '1573933240', 2),
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
(1, 'Полина Павлова', 1, 'https://www.instagram.com/teachers/', 4, 'pQsSnp2Pzp7Y1JDCm86xs8PYVZGnODCY.png', 'http://api.examator.ru/images/teachers/small/pQsSnp2Pzp7Y1JDCm86xs8PYVZGnODCY.png', 'http://api.examator.ru/images/teachers/pQsSnp2Pzp7Y1JDCm86xs8PYVZGnODCY.png', 'polina-pavlova', '<p>Привет! Меня зовут Полина Павлова<br><br>Я сдала русский язык на 100 баллов в 2015 году и теперь готова делиться с вами секретами успешной сдачи и ошибками, которые я допускала при подготовке, а также заряжать вас мотивацией и доказывать: сдать русский язык на 90+ баллов реально!<br><br>Я студентка четвертого курса Казанского Медицинского Университета, поэтому я знаю, как сделать обучение максимально эффективным за короткий срок! От тебя требуется терпение, старание и бешеное желание показать, кто здесь босс.</p>', '1573333440', '1573333440', 1),
(2, 'test', 2, 'https://www.instagram.com/teachers/', 2, '0SVejAe18mQhFW0uCy48NUMXD5DaMmB6.png', 'http://api.examator.ru/images/teachers/small/0SVejAe18mQhFW0uCy48NUMXD5DaMmB6.png', 'http://api.examator.ru/images/teachers/0SVejAe18mQhFW0uCy48NUMXD5DaMmB6.png', 'test', '<p>dd</p>', '1573386479', '1573386479', 1);

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
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(3, 'admin', 'fOeWIEJkrEWvFfsbBBGqfxnzvgvrM1UR', '$2y$13$J/.uk90HtEJQjsotGZwdTuvGGu75rIlJBZgYr3osx0hK.HprlEdPe', 'NULL', 'admin@mail.ru', 10, 1570777744, 1570777744, 'rKDNCehpmFuYeigZh2_MQoApQEc8-XvM_1570777744'),
(18, '500729970', '81XzYxq1E_fq9IKGxcGbZVjS9nBWQdYE', '$2y$13$xJrX9S/3DD5S2zDiGK5d8.qhztRWenr3YeX4.Mnp2W16lhuxgegx.', NULL, 'test@mail.ru', 10, 1575121232, 1575874493, NULL),
(131, '163662408', 'eIUZmCJAp6cc1DU1yLXSKHWBaHhvAOcm', '$2y$13$tnwbbLUbAAsgyC8gA/0b/egMdpP9WUE5AwetisWzH8v1.3Mn/cwwy', NULL, 'tdsfs@mail.rux', 10, 1575876881, 1575877670, NULL),
(132, '1887916', 'QXGI-ZOk09mfYk0tu7IY9x5lSBDU6TJI', '$2y$13$aLzscjlX.fVYo.o/1H4FtegqrjmioCn/pCVnNonNdKPvf6N/WAXca', NULL, ' ', 10, 1575959416, 1575959416, NULL),
(133, '32300688', 'l5rjJcO2UIuQMBBZ2oQaHoBK7YCMM9oP', '$2y$13$Cc6SKXZnKqsSOtIfwIgBiuhLpVjO/b5NC4tVnoPHhrU9wuB3pjD6W', NULL, ' ', 10, 1576107415, 1576107415, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user` ADD FULLTEXT KEY `email` (`email`);

--
-- Constraints for dumped tables
--

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

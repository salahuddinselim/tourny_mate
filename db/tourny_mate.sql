-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 12:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourny_mate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pass_key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass_key`) VALUES
(1, 'selim', '$2y$10$dummyhashformigration123456789abcdefghijklmnop');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `full_name`, `email`, `message`, `created_at`) VALUES
(2, 'Emily Smith', 'emily.smith@gmail.com', 'When is the next football tournament scheduled? I would like to register my team.', '2025-01-24 10:37:33'),
(4, 'Sarah Williams', 'sarah.w@yahoo.com', 'Is there a way to view individual player statistics from past tournaments?', '2025-01-24 10:37:33'),
(7, 'Robert Wilson', 'robert.wilson@example.com', 'How can I become a tournament official or referee?', '2025-01-24 10:37:33'),
(8, 'Jennifer Lee', 'jennifer.lee@hotmail.com', 'Are there any youth sports programs available?', '2025-01-24 10:37:33'),
(9, 'Christopher Martin', 'chris.martin@yahoo.com', 'I would like to sponsor an upcoming tournament. Who should I contact?', '2025-01-24 10:37:33'),
(10, 'Amanda Garcia', 'amanda.garcia@outlook.com', 'Can you provide information about past tournament winners?', '2025-01-23 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `highlights`
--

CREATE TABLE `highlights` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` longtext DEFAULT NULL,
  `video_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `highlights`
--

INSERT INTO `highlights` (`id`, `user_id`, `title`, `details`, `video_file`, `created_at`) VALUES
(1, 1, 'Ratione obcaecati en', 'Beatae voluptas illu', '1737830794_3978429-hd_1920_1080_24fps.mp4', '2025-01-25 18:46:34'),
(2, 1, 'Nam ducimus tempore', 'Commodo modi ex erro', '1737830884_4446327-hd_1920_1080_30fps.mp4', '2025-01-25 18:48:04'),
(4, 1, 'Labore laudantium s', 'Accusamus unde optio', '1737831259_2932301-uhd_4096_2160_24fps.mp4', '2025-01-25 18:54:19'),
(5, 1, 'Distinctio Qui expl', 'Exercitation consect', '1737831615_3978429-hd_1920_1080_24fps.mp4', '2025-01-25 19:00:15'),
(6, 1, 'Dolorem ut aliquam d', 'Ipsam aut nesciunt ', '1737831622_4446327-hd_1920_1080_30fps.mp4', '2025-01-25 19:00:22'),
(7, 1, 'Itaque voluptas cupi', 'In ullam aute incidi', '1737831630_2932301-uhd_4096_2160_24fps.mp4', '2025-01-25 19:00:30'),
(8, 1, 'Aut ad est quasi aut', 'Delectus autem temp', '1737831640_2932301-uhd_4096_2160_24fps.mp4', '2025-01-25 19:00:40'),
(9, 1, 'Nihil in sit est qui', 'Similique esse est', '1737831647_4446327-hd_1920_1080_30fps.mp4', '2025-01-25 19:00:47'),
(10, 1, 'kuddus', 'Why do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\r\n\r\nWhere can I get some?\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\n5\r\n	paragraphs\r\n	words\r\n	bytes\r\n	lists\r\n	Start with \'Lorem\r\nipsum dolor sit amet...\'\r\n\r\nDonate: If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated - click here to donate using PayPal. Thank you for your support. Donate bitcoin: 16UQLq1HZ3CNwhvgrarV6pMoA2CDjb4tyF\r\nTranslations: Can you help translate this site into a foreign language ? Please email us with details if you can help.\r\nThere is a set of mock banners available here in three colours and in a range of standard banner sizes:\r\nBannersBannersBanners\r\nNodeJS Python Interface GTK Lipsum Rails .NET\r\nThe standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius mo', '1737832336_2932301-uhd_4096_2160_24fps.mp4', '2025-01-25 19:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `individual_score`
--

CREATE TABLE `individual_score` (
  `id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `no_of_matches` int(11) DEFAULT NULL,
  `runs` int(11) DEFAULT NULL,
  `short_pitch_runs` int(11) DEFAULT NULL,
  `total_six` int(11) DEFAULT NULL,
  `total_fours` int(11) DEFAULT NULL,
  `total_three` int(11) DEFAULT 0,
  `total_two` int(11) DEFAULT 0,
  `total_one` int(11) DEFAULT 0,
  `total_wickets` int(11) DEFAULT NULL,
  `total_over` float DEFAULT NULL,
  `total_dots` int(11) DEFAULT NULL,
  `total_goals` int(11) DEFAULT 0,
  `total_saves` int(11) DEFAULT NULL,
  `total_assists` int(11) DEFAULT NULL,
  `total_wins_football` int(11) DEFAULT NULL,
  `total_wins_cricket` int(11) DEFAULT NULL,
  `total_yellow` int(11) DEFAULT NULL,
  `total_red` int(11) DEFAULT NULL,
  `positions` varchar(10) DEFAULT NULL,
  `is_out` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `individual_score`
--

INSERT INTO `individual_score` (`id`, `match_id`, `tournament_id`, `user_id`, `team_id`, `no_of_matches`, `runs`, `short_pitch_runs`, `total_six`, `total_fours`, `total_three`, `total_two`, `total_one`, `total_wickets`, `total_over`, `total_dots`, `total_goals`, `total_saves`, `total_assists`, `total_wins_football`, `total_wins_cricket`, `total_yellow`, `total_red`, `positions`, `is_out`) VALUES
(55, 12, 26, 10, 15, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(56, 12, 26, 11, 15, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(57, 12, 26, 13, 16, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(58, 12, 26, 14, 16, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(59, 10, 25, 13, 16, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(60, 10, 25, 14, 16, NULL, 12, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(61, 10, 25, 12, 17, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(62, 10, 25, 2, 17, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(63, 11, 25, 10, 15, NULL, 13, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(64, 11, 25, 11, 15, NULL, 10, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(65, 11, 25, 13, 17, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(66, 11, 25, 2, 17, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(67, 11, 25, 12, 15, NULL, 0, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(68, 14, 26, 10, 15, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(69, 14, 26, 11, 15, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(70, 14, 26, 12, 17, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `match_played`
--

CREATE TABLE `match_played` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `team_1_id` int(11) DEFAULT NULL,
  `team_2_id` int(11) DEFAULT NULL,
  `match_day` datetime NOT NULL,
  `official_1_id` int(11) DEFAULT NULL,
  `official_2_id` int(11) DEFAULT NULL,
  `official_3_id` int(11) DEFAULT NULL,
  `match_type` varchar(10) NOT NULL,
  `match_end` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `match_played`
--

INSERT INTO `match_played` (`id`, `tournament_id`, `team_1_id`, `team_2_id`, `match_day`, `official_1_id`, `official_2_id`, `official_3_id`, `match_type`, `match_end`) VALUES
(4, 13, 5, 6, '2025-01-28 13:29:00', NULL, NULL, NULL, 'T20', NULL),
(5, 24, 15, 16, '2025-01-27 00:21:00', NULL, NULL, NULL, 'Test', 1),
(6, 24, 17, 15, '2025-01-27 00:40:00', NULL, NULL, NULL, 'Friendly', 1),
(7, 24, 16, 17, '2025-01-27 00:42:00', NULL, NULL, NULL, 'ODI', 1),
(8, 25, 15, 16, '2025-01-27 02:55:00', NULL, NULL, NULL, 'T20', 1),
(9, 25, 16, 17, '2025-01-27 02:57:00', NULL, NULL, NULL, 'T20', 1),
(10, 25, 16, 17, '2025-01-27 02:57:00', NULL, NULL, NULL, 'T20', 1),
(11, 25, 15, 17, '2025-01-27 02:59:00', NULL, NULL, NULL, 'Friendly', 1),
(12, 26, 15, 16, '2025-01-27 03:03:00', NULL, NULL, NULL, 'Football', 1),
(13, 26, 16, 17, '2025-01-27 03:05:00', NULL, NULL, NULL, 'Football', NULL),
(14, 26, 17, 15, '2025-01-27 03:07:00', NULL, NULL, NULL, 'Football', 1),
(15, 26, 17, 15, '2025-01-27 03:07:00', NULL, NULL, NULL, 'Football', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL,
  `image_3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `subtitle`, `description`, `main_image`, `image_1`, `image_2`, `image_3`, `created_at`) VALUES
(6, 1, 'Quia culpa sint in ', 'Autem neque reprehen', 'Odio eaque at neque ', 'download (1).jpeg', 'download (2).jpeg', 'download (3).jpeg', 'download.jpeg', '2025-01-20 18:52:59'),
(7, 42, 'Jannik Sinner in a different universe: Zverev after losing Australian Open final', '', 'Alexander Zverev heaped praise on Jannik Sinner, saying that the Italian star is in a \"different universe\". On Sunday, Sinner defeated Zverev in straight sets in the final of the Australian Open. It was Zverev\'s third defeat in as many Grand Slams after he lost to Dominic Thiem in the US Open, followed by Carlos Alcaraz in the French Open 2024.\r\n\r\nSinner also became the first Italian to win three majors, going past Nicola Pietrangeli, who had two French Open titles in 1959 and 1960. Sinner also became only the third player since 2000 to win a Grand Slam final without facing a single break point. The 27-year-old Zverev hailed Sinner for being \"the best\" on hard courts.\r\n\r\nAustralian Open 2025 men\'s singles final Highlights\r\n\r\n\"Yeah, by far the best. I mean, the facts speak for themselves. He\'s won all the Grand Slams on hard courts since last year. He\'s lost, I think, three matches on hard courts, right? Three, four, something like that. I\'m not sure, but somewhere around that. I mean, I think the facts speak for themselves. He\'s in a different universe right now to anyone else,\" Zverev said.', 'AA1xTgDX.jpg', 'UIUPC-6279.jpg', '', '', '2025-01-26 19:37:09'),
(9, 44, '\'He Has Something Special\': Erling Haaland On Omar Marmoush After Man City Debut', '', 'Erling Haaland believes his new strike partner Omar Marmoush will be a “fantastic” signing for Manchester City after an impressive debut in the English champions’ 3-1 win over Chelsea on Saturday.\r\n\r\nHaaland was the difference maker as City leapfrogged the Blues into fourth in the Premier League despite a nightmare start for another new signing Abdukodir Khusanov.\r\n\r\nThe Uzbek’s error gifted Chelsea the lead inside three minutes through Noni Madueke.\r\n\r\nMarmoush had a goal ruled out for offside before Josko Gvardiol levelled for the home side before half-time.\r\n\r\nThe tactic of hitting Haaland’s physical presence with long balls from goalkeeper Ederson then turned the game decisively in the favour of Pep Guardiola’s men.\r\n\r\nHaaland shrugged off Trevoh Chalobah to chip in his 24th goal of the season before teeing up Phil Foden for City’s third.\r\n\r\nMarmoush scored 20 goals in 26 appearances for Eintracht Frankfurt this season before making the move to Manchester for a £59 million ($72.6 million) fee this week.\r\n\r\n“I think in the first half you could see he has something special. That is obviously the reason Manchester City bought him,” said Haaland.\r\n\r\n“It’s about giving him confidence. He’s going to be a fantastic player for us.\r\n\r\n“He had an amazing first half of the season for Eintracht Frankfurt. Hopefully he’s going to have the same second half of the season for us.”\r\n\r\nCity face a huge week ahead as they must beat Club Brugge at home on Wednesday to avoid an early exit from the Champions League before travelling to second-placed Arsenal in the Premier League next weekend.\r\n\r\nHaaland is hoping they can kick on after a fourth win in five league games.\r\n\r\n“When we had the start like we did it is difficult but we played really well and we kept on going and kept on going,” added Haaland.\r\n\r\n“We kept pushing and second half was the same. In the end it is what we need to do.”', 'AA1xS7oa.jpg', 'AA1xTgDX.jpg', '', '', '2025-01-26 19:41:56'),
(10, 44, 'Pakistan\'s \'spin-plan\' vs West Indies backfires as hosts face embarrassment in Multan', 'spin-plan\' vs West Indies ', 'Pakistan were left in deep water after their plan to subdue the West Indies with a \'trial by spin\' spectacularly backfired on Day 2 of the 2nd Test match of the series. Chasing a target of 254 runs in Multan, Pakistan were reduced to 76/4 at stumps after losing their entire top order.\r\n\r\nCaptain Shan Masood and senior batter Babar Azam went back to the hut, leaving Pakistan in a lurch on Sunday, 26th January. After 20 wickets fell on the first day of the second Test, the trend continued on Day 2 as well. However, the West Indies side appeared better equipped to tackle the spin and took a proactive approach against the spinners.\r\n\r\nPAK vs WI, 2nd Test: Day 2 Highlights\r\n\r\nCaptain Kraigg Brathwaite led the charge for the Windies with a gritty half-century (52 off 74 balls). The batters of the visiting nation made important contributions throughout the line-up, as they racked up a commanding 244 runs on the square-turner on Sunday.\r\n\r\nExpand article logo  Continue reading\r\n\r\nWest Indies\' tailenders put in a tremendous show once again, as spinners Kevin Sinclair (28), Gudakesh Motie (18), and Jomel Warrican (18) helped the side surpass the 200-run mark in the second innings and put the Windies in a commanding position.\r\n\r\nNoman Ali and Sajid Khan picked up 4 wickets each, completing 10-wicket and 6-wicket hauls respectively in the Test match to continue their dominance at home.', 'AA1xT1EA.jpg', '', '', '', '2025-01-26 19:43:30'),
(11, 14, 'Antony\'s crisp first words after completing Betis loan move from United', '', 'Antony dos Santos, widely known as Antony, has completed a loan move from Manchester United to La Liga\'s Real Betis, marking a pivotal opportunity for the Brazilian winger to rediscover his form after a disappointing stint in the Premier League. The loan agreement, which runs until the end of the season in June, is seen as a chance for Antony to revive his Ajax-era brilliance.\r\n\r\nAntony joined Manchester United from Ajax in 2022 for a staggering â¬86 million, reuniting with former coach Erik ten Hag. However, the move didn\'t live up to expectations, with Antony contributing just 17 goals and assists in 96 appearances. Following Ten Hag\'s dismissal, new United manager Ruben Amorim handed Antony opportunities to prove himself, but inconsistent performances led to his temporary exit. The 24-year-old now looks to Real Betis as a platform to reclaim his confidence and value.\r\n\r\nUpon confirming his move, Antony released a succinct six-word statement on his social media, expressing determination and optimism.', 'AA1xSmHw.jpg', '', '', '', '2025-01-26 19:45:04'),
(12, 14, 'Tottenham Hotspur suffered a fourth consecutive Premier League defeat as Leicester City completed a stunning comeback to climb out of the relegation zone.', '', 'The Foxes, trailing 1-0 at half-time, scored twice in four minutes after the break through Jamie Vardy and Bilal El Khannouss to end a run of seven consecutive defeats in the Premier League.\r\n\r\nBrazil striker Richarlison had opened the scoring for Spurs just after the half-hour mark, heading in a brilliant cross from defender Pedro Porro.\r\n\r\nLeicester captain Vardy equalised from close range a minute into the second half when goalkeeper Antonin Kinsky failed to deal with Bobby De Cordova-Reid\'s cross.\r\n\r\nRuud van Nistelrooy\'s side were ahead four minutes later when midfielder El Khannouss curled in a fantastic effort from 25 yards into the bottom corner.\r\n\r\nSpurs poured forward in search of an equaliser but their failure to find one means Ange Postecoglou\'s side have won just one of their past 11 matches in the Premier League, leaving them in 15th.\r\n\r\nLeicester\'s win lifts the Foxes into 17th, one point above Wolves - who drop into the bottom three as a result.', 'Screenshot 2025-01-27 014714.png', '', '', '', '2025-01-26 19:47:32'),
(13, 14, 'Kylian Mbappe \'getting into a rhythm\' says Carlo Ancelotti after Real Madrid hat-trick v Real Valladolid', '', 'Kylian Mbappe scored his first Real Madrid hat-trick in an ultimately comfortable 3-0 victory over Real Valladolid. The 26-year-old appears to have hit his stride after scoring eight goals in his previous five games across all competitions. Meanwhile, it was a night to forget for Valladolid, who had Mario Martin sent off late on as part of Real\'s late penalty award.\r\n\r\n\r\n\r\nAncelotti \'certain\' Vinicius is \'very happy\' at Real Madrid amid reported Saudi interest\r\n\r\nVideo credit: Eurosport\r\n\r\nCarlo Ancelotti believes Kylian Mbappe is now \"getting into a rhythm\" after the France captain netted a hat-trick in Real Madrid\'s 3-0 win over Real Valladolid on Saturday.\r\nMbappe scored his first when curling home a strike into the far corner from Jude Bellingham\'s cross, before taking Rodrygo\'s pass into his stride and dispatching a finish past Karl Hein for his second.\r\nThe 26-year-old completed his treble in stoppage time from the penalty spot, leaving Ancelotti\'s men four points clear of Atletico Madrid at the summit of La Liga.', 'Screenshot 2025-01-27 015135.png', 'Screenshot 2025-01-27 015055.png', 'Screenshot 2025-01-27 015143.png', 'Screenshot 2025-01-27 015203.png', '2025-01-26 19:52:46'),
(16, 46, 'BPL', 'RR vs DR', 'DR beats RR by 2 goals in today\'s match.', 'WhatsApp Image 2025-01-27 at 03.19.54_d65e9056.jpg', '', '', '', '2025-01-26 21:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `sports_type` varchar(10) NOT NULL,
  `position` varchar(10) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `score_id` int(11) NOT NULL,
  `match_id` int(11) DEFAULT NULL,
  `team_1_id` int(11) DEFAULT NULL,
  `team_2_id` int(11) DEFAULT NULL,
  `team_1_score` int(11) NOT NULL,
  `team_2_score` int(11) NOT NULL,
  `winner_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `manager_id`, `logo`) VALUES
(5, 'team robust', 1, 'download.jpeg'),
(6, 'Erasmus Fuentes', 2, 'download (3).jpeg'),
(9, 'Mohammadpur Fc', 41, '46687653900871.594570bf70791.png'),
(10, 'Kuril FC', 40, 'OIP.jpg'),
(11, 'Pirganj FC', 35, 'OIP (1).jpg'),
(12, 'Dinajpur Cricket Club', 34, 'OIP (2).jpg'),
(14, 'Titumir University FC', 16, 'letter-t-logo-icon-design-template-elements-vector-18053568.jpg'),
(15, 'Manager1 FC', 43, '46687653900871.594570bf70791.png'),
(16, 'Manager2 FC', 44, 'OIP.jpg'),
(17, 'Manager3 FC', 45, 'OIP (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team_player`
--

CREATE TABLE `team_player` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_player`
--

INSERT INTO `team_player` (`id`, `team_id`, `user_id`, `created_at`) VALUES
(7, 5, 2, '2025-01-20 19:11:27'),
(8, 6, 2, '2025-01-20 20:20:12'),
(16, 9, 1, '2025-01-26 17:28:58'),
(17, 9, 2, '2025-01-26 17:28:58'),
(19, 9, 9, '2025-01-26 17:28:58'),
(20, 10, 10, '2025-01-26 17:32:09'),
(21, 10, 11, '2025-01-26 17:32:09'),
(22, 10, 12, '2025-01-26 17:32:09'),
(23, 10, 13, '2025-01-26 17:32:09'),
(24, 11, 2, '2025-01-26 17:35:10'),
(25, 11, 10, '2025-01-26 17:35:10'),
(26, 11, 12, '2025-01-26 17:35:10'),
(27, 11, 14, '2025-01-26 17:35:10'),
(28, 12, 2, '2025-01-26 17:38:20'),
(29, 12, 10, '2025-01-26 17:38:20'),
(30, 12, 11, '2025-01-26 17:38:20'),
(31, 12, 14, '2025-01-26 17:38:20'),
(36, 14, 1, '2025-01-26 17:45:07'),
(37, 14, 12, '2025-01-26 17:45:07'),
(38, 14, 13, '2025-01-26 17:45:07'),
(39, 14, 14, '2025-01-26 17:45:07'),
(40, 15, 10, '2025-01-26 18:15:00'),
(41, 15, 11, '2025-01-26 18:15:00'),
(42, 15, 12, '2025-01-26 18:15:00'),
(43, 16, 13, '2025-01-26 18:15:53'),
(44, 16, 14, '2025-01-26 18:15:53'),
(45, 16, 15, '2025-01-26 18:15:53'),
(46, 17, 2, '2025-01-26 18:16:38'),
(47, 17, 12, '2025-01-26 18:16:38'),
(48, 17, 13, '2025-01-26 18:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `venue` varchar(40) NOT NULL,
  `region` varchar(40) NOT NULL,
  `district` varchar(40) NOT NULL,
  `thana` varchar(40) NOT NULL,
  `area` varchar(40) NOT NULL,
  `tour_type` varchar(10) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`id`, `name`, `creator_id`, `venue`, `region`, `district`, `thana`, `area`, `tour_type`, `start_date`, `end_date`) VALUES
(7, 'Lucius Garrison', 1, 'Officia voluptate co', 'Qui architecto iste ', 'Minima non velit con', 'Labore sint corporis', 'Pariatur Et quo acc', 'cricket', '2026-12-12', '2027-06-22'),
(10, 'Stewart Macdonald', 1, 'Laudantium quis cil', 'Dolorem numquam cons', 'Laborum dolore dicta', 'Dolores tempora anim', 'Id dicta vitae esse', 'cricket', '2008-05-05', '1988-05-29'),
(11, 'Shelley Barry', 1, 'Voluptas lorem adipi', 'Sunt dolorem modi ip', 'Consequatur quia nih', 'Corporis aut qui ips', 'Expedita unde quis f', 'cricket', '2022-11-26', '2006-05-04'),
(12, 'Dawn Landry', 1, 'Atque cupidatat vel ', 'Facere aspernatur do', 'Dolore aut non neces', 'Corporis perspiciati', 'Velit libero est mol', 'cricket', '2006-05-10', '2018-08-17'),
(13, 'Test To', 1, 'Ipsam dolor ut obcae', 'Non dolores et eiusm', 'Iste aut id culpa re', 'Voluptatem quis nost', 'Qui voluptate nostru', 'football', '1991-09-06', '1995-12-21'),
(14, 'UIU VC CUP', 19, 'UIU Play ground', 'Dhaka', 'Dhaka', 'Vatara', 'Satarkul', 'football', '2025-01-14', '2025-01-30'),
(15, 'UIU VC CUP 25', 19, 'UIU Play ground', 'Dhaka', 'Dhaka', 'Vatara', 'Satarkul', 'cricket', '2025-01-01', '2025-01-15'),
(16, 'Mohammadpur Gold CUP', 41, 'Mohammadpur Public Field', 'Dhaka', 'Dhaka', 'Mohammadpur', 'Nobodoy', 'football', '2025-01-01', '2025-01-15'),
(17, 'Kuril Premier League', 40, 'Kuril Stadium', 'Dhaka', 'Dhaka', 'Kuril', 'Bissho Road', 'football', '2024-12-15', '2025-01-30'),
(18, 'Pirganj Super Cup', 35, 'Pirganj Public Stadium', 'Rangpur', 'Thakurgaon', 'Pirganj', 'Pirganj', 'cricket', '2025-03-01', '2025-03-10'),
(19, 'Dinaj Super Cup', 34, 'Dinajpur  Stadium', 'Rangpur', 'Dinajpur', 'Kalitola', 'Kalitola', 'cricket', '2025-01-01', '2025-01-30'),
(20, 'Thakurgaon Super Cup', 15, 'Dinajpur  Stadium', 'Rangpur', 'Dinajpur', 'Kalitola', 'Kalitola', 'football', '2025-01-02', '2025-01-10'),
(21, 'Public University Super Cup', 16, 'Dinajpur  Stadium', 'Rangpur', 'Dinajpur', 'Kalitola', 'Kalitola', 'football', '2025-01-08', '2025-01-29'),
(22, 'Public University Super Cup2', 33, 'Dinajpur  Stadium', 'Rangpur', 'Dinajpur', 'Kalitola', 'Kalitola', 'cricket', '2025-01-04', '2025-01-17'),
(23, 'Public University Super Cup3', 33, 'Dinajpur  Stadium', 'Rangpur', 'Dinajpur', 'Kalitola', 'Kalitola', 'football', '2025-01-29', '2025-02-05'),
(24, 'Public University Super Cup3', 42, 'Dinajpur  Stadium', 'Rangpur', 'Dinajpur', 'Kalitola', 'Kalitola', 'football', '2025-01-27', '2025-01-30'),
(25, 'DBMS Cricket Cup', 47, 'UIU', 'Dhaka', 'Dhaka', 'dhaka', 'dhaka', 'cricket', '2025-01-27', '2025-01-29'),
(26, 'DBMS Football Cup', 47, 'UIU', 'Dhaka', 'Dhaka', 'dhaka', 'dhaka', 'football', '2025-01-28', '2025-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_officials`
--

CREATE TABLE `tournament_officials` (
  `id` int(11) NOT NULL,
  `official_id` int(11) DEFAULT NULL,
  `tournament_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament_officials`
--

INSERT INTO `tournament_officials` (`id`, `official_id`, `tournament_id`) VALUES
(2, 1, 7),
(3, 2, 7),
(7, 1, 10),
(8, 2, 10),
(10, 2, 11),
(11, 9, 11),
(13, 9, 12),
(15, 9, 13),
(16, 10, 14),
(17, 11, 14),
(18, 12, 14),
(19, 17, 15),
(20, 18, 15),
(21, 19, 15),
(22, 10, 16),
(23, 25, 17),
(24, 37, 18),
(25, 2, 19),
(26, 11, 20),
(27, 30, 21),
(28, 16, 22),
(29, 40, 23),
(30, 41, 23),
(31, 46, 24),
(32, 46, 25),
(33, 46, 26);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_request`
--

CREATE TABLE `tournament_request` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament_request`
--

INSERT INTO `tournament_request` (`id`, `tournament_id`, `user_id`, `team_id`, `status`, `created_at`) VALUES
(10, 10, 2, 6, 'pending', '2025-01-21 01:29:11'),
(11, 11, 2, 6, 'pending', '2025-01-25 12:26:00'),
(12, 12, 2, 6, 'pending', '2025-01-25 12:26:37'),
(14, 13, 2, 6, 'approved', '2025-01-25 18:25:09'),
(15, 14, 2, 6, 'pending', '2025-01-26 15:06:25'),
(16, 15, 1, 5, 'pending', '2025-01-26 15:07:35'),
(17, 16, 1, 5, 'pending', '2025-01-26 17:28:16'),
(18, 17, 41, 9, 'pending', '2025-01-26 17:34:12'),
(19, 18, 40, 10, 'pending', '2025-01-26 17:37:06'),
(20, 19, 40, 10, 'pending', '2025-01-26 17:39:44'),
(21, 20, 2, 6, 'pending', '2025-01-26 17:42:26'),
(24, 23, 16, 14, 'approved', '2025-01-26 18:04:05'),
(25, 23, 34, 12, 'approved', '2025-01-26 18:04:05'),
(26, 23, 35, 11, 'approved', '2025-01-26 18:04:05'),
(27, 24, 43, 15, 'approved', '2025-01-26 18:17:54'),
(28, 24, 44, 16, 'approved', '2025-01-26 18:17:54'),
(29, 24, 45, 17, 'approved', '2025-01-26 18:17:54'),
(30, 25, 43, 15, 'approved', '2025-01-26 20:50:37'),
(31, 25, 44, 16, 'approved', '2025-01-26 20:50:37'),
(32, 25, 45, 17, 'approved', '2025-01-26 20:50:37'),
(33, 26, 43, 15, 'approved', '2025-01-26 20:59:44'),
(34, 26, 44, 16, 'approved', '2025-01-26 20:59:44'),
(35, 26, 45, 17, 'approved', '2025-01-26 20:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_team`
--

CREATE TABLE `tournament_team` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament_team`
--

INSERT INTO `tournament_team` (`id`, `tournament_id`, `team_id`) VALUES
(2, 7, 5),
(6, 10, 5),
(7, 13, 5),
(8, 13, 6),
(9, 23, 14),
(10, 23, 12),
(11, 23, 11),
(12, 24, 15),
(13, 24, 16),
(14, 24, 17),
(15, 25, 15),
(16, 25, 16),
(17, 25, 17),
(18, 26, 15),
(19, 26, 16),
(20, 26, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_team_score`
--

CREATE TABLE `tournament_team_score` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `score` int(11) DEFAULT 0,
  `wickets` int(11) DEFAULT 0,
  `goals` int(255) DEFAULT 0,
  `match_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament_team_score`
--

INSERT INTO `tournament_team_score` (`id`, `tournament_id`, `team_id`, `score`, `wickets`, `goals`, `match_id`) VALUES
(59, 26, 15, 0, 0, 6, 12),
(61, 26, 16, 0, 0, 2, 12),
(64, 25, 16, 1, 0, 0, NULL),
(66, 25, 17, 4, 0, 0, NULL),
(69, 25, 15, 23, 0, 0, 11),
(77, 26, 17, 0, 0, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `fullName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password_key` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `dp` varchar(100) DEFAULT NULL,
  `cover` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `username`, `fullName`, `email`, `password_key`, `role`, `phone`, `dp`, `cover`) VALUES
(1, 'xubixab', 'Mariko', 'bulevom@mailinator.com', '$2y$10$a6qpOl9hrZB5XTCZbzYZBu./4wPzFbn6/aplY/DKqNykQ5MaWLYnq', 'user', '+1 (917) 82', '../../../../uploads/user/678edcd126dad_download (3).jpeg', '../../../../uploads/user/678edcd126e8a_download (2).jpeg'),
(2, 'kutiluhyg', 'Reed Benton', 'topo@mailinator.com', '$2y$10$0AI37MlIggcPB3KlLGrPjeJrVjQNjhb.BagKRqtPbACUeRJs.Y4Z2', 'user', '+1 (221) 76', NULL, NULL),
(9, 'afr', 'Juliet Hogan', 'bulevom@mailinator.com', '$2y$10$HXBuTk3NvCMhBQFg7SM5h.89ES0al2zD1d0qNxRU7GVCvTvEN92j.', 'user', '1234567890', NULL, NULL),
(10, 'Monirul', 'MD. MONIRUL ISLAM', 'monirulislam1@gmail.com', '$2y$10$OA45SNCxR6E/o89UHQArQ.kfRu.7BNNmwSgmtPKa.7znB1f4i4ZpW', 'user', '01575429438', '../../../../uploads/user/67964bc038718_39655.jpg', '../../../../uploads/user/67964bc038a40_DSC_0016.JPG'),
(11, 'monirulislam2', 'MD. MONIRUL ISLAM 2', 'monirulislam2@gmail.com', '$2y$10$2v2TRi96EDscGvg/VQ4Ny.X.BR8LPNU90815BGqYcHSKkMP4jyJ4.', 'user', '01575429438', NULL, NULL),
(12, 'monirulislam3', 'MD. MONIRUL ISLAM 3', 'monirulislam3@gmail.com', '$2y$10$YOzA/sEr3Co4ZrqMHLiPDOZJGyAM0emY147tqbnnTn48dKAO2yf7S', 'user', '01575429438', NULL, NULL),
(13, 'monirulislam', 'MD. MONIRUL ISLAM 4', 'monirulislam4@gmail.com', '$2y$10$GOgS9S3oUCsI05JxHuNbDObFyW8NLdDlwJzS2H6q4n0oX1wUMZLgS', 'user', '01575429438', NULL, NULL),
(14, 'monirulislam5', 'MD. MONIRUL ISLAM 5', 'monirulislam5@gmail.com', '$2y$10$E9h3Ed3CUF3rtbaYlVnJA.YDWDvasycsAye/BE1gjWHyBV8grNaa6', 'user', '01575429438', NULL, NULL),
(15, 'monirulislam6', 'MD. MONIRUL ISLAM 6', 'monirulislam6@gmail.com', '$2y$10$F7ofL3eQoIRrsg5Jc/dL5uBFnqf1jbgYr7GIiVGpct8St8ElPqsuq', 'user', '01757865222', NULL, NULL),
(16, 'monirulislam7', 'MD. MONIRUL ISLAM 7', 'monirulislam7@gmail.com', '$2y$10$FlYbuuJFR1qD/lPfrWHCk.XDtStB3f3druJrnkyUZGK7mmc6CwLai', 'user', '01757865222', NULL, NULL),
(17, 'monirulislam8', 'MD. MONIRUL ISLAM 8', 'monirulislam8@gmail.com', '$2y$10$nL62jUi/b.oUU3rNYQ9PVeigCOHHMyL1THkV.qRKNFUFgEe9Qbe6e', 'user', '01757865222', NULL, NULL),
(18, 'monirulislam9', 'MD. MONIRUL ISLAM 9', 'monirulislam9@gmail.com', '$2y$10$np4lf6VZAl2LDFV.kQeOBO0q82y0TYJCICBj0YoHNqzWMTdxR3IH6', 'user', '01757865222', NULL, NULL),
(19, 'monirulislam10', 'MD. MONIRUL ISLAM 10', 'monirulislam10@gmail.com', '$2y$10$XgqAiXkv1rZQhrxECsFuFuBad9JH4SpKMhlGRhZrBesxQNxP5Z0Za', 'user', '01757865223', NULL, NULL),
(20, 'monirulislam11', 'MD. MONIRUL ISLAM 11', 'monirulislam11@gmail.com', '$2y$10$qWQre5s0iYCpK1sI.rY4sONjieqR006es7A6xQIFz0/eNo6r.NvNW', 'user', '01757865222', NULL, NULL),
(21, 'monirulislam12', 'MD. MONIRUL ISLAM 12', 'monirulislam12@gmail.com', '$2y$10$TmKxbwP50EGbf24/YA5qhOE8AQjwpNFzERI2zIgK6DN/wceXq0ENa', 'user', '01757865222', NULL, NULL),
(22, 'monirulislam13', 'MD. MONIRUL ISLAM 13', 'monirulislam13@gmail.com', '$2y$10$zRDZrQcjIAO2iSrdDm5IVeONiGJ/KVFEMVBzigDVru026HgQ9y9Ju', 'user', '01757865222', NULL, NULL),
(23, 'monirulislam14', 'MD. MONIRUL ISLAM 14', 'monirulislam14@gmail.com', '$2y$10$RWGNBaLas2ebgA1bjbIawOJLCYWbgXWlvNsDFHkKAwfz3yglU.q/u', 'user', '01757865222', NULL, NULL),
(24, 'monirulislam15', 'MD. MONIRUL ISLAM 15', 'monirulislam15@gmail.com', '$2y$10$baXHeT6qdXo0F1tWfIUOXOC1i6uMmw7u9FDt6ddyvvWP5iAHtd5r.', 'user', '01757865222', NULL, NULL),
(25, 'selim', 'salah uddin selim', 'selim@gmail.com', '$2y$10$gvdCZuE7RrTj95RPrpF5YODXHVcvXc6TGDkWoui56yc0XDFHSj1Uq', 'user', '01757865223', NULL, NULL),
(26, 'selim1', 'salah uddin selim1', 'selim1@gmail.com', '$2y$10$ui.dJaFPzpWdVOThVtBt/eG1m7mYSq3orlP3HvDQ7CCH8r1X4Y8yy', 'user', '01757865221', NULL, NULL),
(27, 'selim2', 'salah uddin selim2', 'selim2@gmail.com', '$2y$10$traryGa3g56BVdYURJn17uso.H2HW0RdriwlOL/NkSwiKSSYHPQfG', 'user', '01757865222', NULL, NULL),
(28, 'selim3', 'salah uddin selim3', 'selim3@gmail.com', '$2y$10$ob9CK4l1VfjrA/0oaEAwAuIy8wAAjE/9kmkS9aElqsT3rEYcN1yfK', 'user', '01757865224', NULL, NULL),
(29, 'selim4', 'salah uddin selim4', 'selim4@gmail.com', '$2y$10$GHH3nTNqLRXlSVf40PYytuf9UMptURuhaDZYQwL/LLLrbhuvB0/WC', 'user', '01757865224', NULL, NULL),
(30, 'selim5', 'salah uddin selim5', 'selim5@gmail.com', '$2y$10$DEIRatorRqKKudgJEZ4Z/urIfsTe5XFYGnIjxDvwrIZXVkOCYZh.a', 'user', '01757865225', NULL, NULL),
(31, 'selim6', 'salah uddin selim6', 'selim6@gmail.com', '$2y$10$Ikf/K2lBo9b1IVojNqhxquWZOBRjIPYcVn09WAMsLlyvAjVQhIStW', 'user', '01757865226', NULL, NULL),
(32, 'selim7', 'salah uddin selim7', 'selim7@gmail.com', '$2y$10$2ORoiNXCfpPpqxiCiGsoV.AOtgGmUKmusdsAxrUi9JgXR/WrXmc0W', 'user', '01757865227', NULL, NULL),
(33, 'selim8', 'salah uddin selim8', 'selim8@gmail.com', '$2y$10$Bi4cH/mTu3s1XK0kwy0FhuO.6caf0SL70Z9bJ.UyU0sziSbxFPbi6', 'user', '01757865228', NULL, NULL),
(34, 'selim9', 'salah uddin selim9', 'selim9@gmail.com', '$2y$10$RqdCErXeWCHhYmHMoYoTO.iGyf9V5quAF3z3EQXrk21WMKpp1HZS.', 'user', '01757865229', NULL, NULL),
(35, 'selim10', 'salah uddin selim10', 'selim10@gmail.com', '$2y$10$u/QOExXcSmlbxRysTdyqOuH/Mc044FCPICsQVI5KFt/ENHn2dnWxq', 'user', '01757865230', NULL, NULL),
(36, 'afia', 'Afia tasnim ria', 'afia@gmail.com', '$2y$10$PXFWo7PZsf/7PhTuT76GUu/eeJbfENfshYW2MQNaHO/jxL2BBivlG', 'user', '01757865231', NULL, NULL),
(37, 'afia1', 'Afia tasnim ria1', 'afia1@gmail.com', '$2y$10$u1KAv7lruEAi4zOUFJWC5uxN.EModxYTU9qZprW59X.mus9gAR4LW', 'user', '01757865232', NULL, NULL),
(38, 'afia2', 'Afia tasnim ria2', 'afia2@gmail.com', '$2y$10$PY61T8hrxfZEXTwMy7fC5OFKf34U/xqpD9wXITliReEqQEx6cDzQu', 'user', '01757865233', NULL, NULL),
(39, 'afia3', 'Afia tasnim ria3', 'afia3@gmail.com', '$2y$10$Vg8FX/VQ8KSdldJJBHwuFeRERAdjapqM2h5lqX21yrSTxj.gM/MZW', 'user', '01757865234', NULL, NULL),
(40, 'afia4', 'Afia tasnim ria4', 'afia4@gmail.com', '$2y$10$/jCOQ5d6n5RJ6jCnNfV2sOQrtToAgh.YRo4lD8YQSFL7rkkajXK32', 'user', '01757865235', NULL, NULL),
(41, 'afia5', 'Afia tasnim ria5', 'afia5@gmail.com', '$2y$10$elaYmlLEMlXaU1axQNtfs.bfbodAoB.QCEPMNYI4sccL9Dt4jU2fC', 'user', '01757865235', NULL, NULL),
(42, 'Organizer', 'Organizer', 'organizer@gmail.com', '$2y$10$Hrpo3yaq5KuJfHZTUX.Mlu9toLF8ySl.AUiENX1Q9F31o2gpOogsm', 'user', '01757865222', NULL, NULL),
(43, 'Manager1', 'Manager1', 'manager1@gmail.com', '$2y$10$sFlPdSd3bC0QtmIT6SQs5OZ4UnIHtYnGRrWCrMEVddAhjbsk76fPe', 'user', '01757865222', NULL, NULL),
(44, 'Manager2', 'Manager2', 'manager2@gmail.com', '$2y$10$Q9iOX08JS3nyghPJtyuNzOFOGyPykueHfK3BFEkC0J.aOaLNV3CNm', 'user', '01757865222', NULL, NULL),
(45, 'Manager3', 'Manager3', 'manager3@gmail.com', '$2y$10$lf5t2lbCvKWnikQ5fjmQxetPMlO4E1KPWHIcHWoaux0EfpVHK0qNW', 'user', '01757865222', NULL, NULL),
(46, 'Official', 'Official', 'official@gmail.com', '$2y$10$IXN1Zo1y.VYKVcevWo7Pl.kFEXFcMbY5.O1oFDhWnHtOi4Z6CXAx6', 'user', '01757865222', NULL, NULL),
(47, 'afia123232434234', 'Afia Tasnim', 'nothin@gmail.com', '$2y$10$k8QVojLZHm2GSsQFI5blb.uy8TTDZk87jjuc.6yu8x2nCfnrNeDKS', 'user', '12345', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `highlights`
--
ALTER TABLE `highlights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `individual_score`
--
ALTER TABLE `individual_score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_individual_score_team` (`team_id`),
  ADD KEY `fk_individual_score_tournament` (`tournament_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `match_played`
--
ALTER TABLE `match_played`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_1_id` (`team_1_id`),
  ADD KEY `team_2_id` (`team_2_id`),
  ADD KEY `official_1_id` (`official_1_id`),
  ADD KEY `official_2_id` (`official_2_id`),
  ADD KEY `official_3_id` (`official_3_id`),
  ADD KEY `fk_match_played_tournament` (`tournament_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_news_user` (`user_id`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `team_1_id` (`team_1_id`),
  ADD KEY `team_2_id` (`team_2_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `team_player`
--
ALTER TABLE `team_player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_team` (`team_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexes for table `tournament_officials`
--
ALTER TABLE `tournament_officials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `official_id` (`official_id`),
  ADD KEY `tournament_id` (`tournament_id`);

--
-- Indexes for table `tournament_request`
--
ALTER TABLE `tournament_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tournament_request_tournament` (`tournament_id`),
  ADD KEY `fk_tournament_request_user` (`user_id`),
  ADD KEY `fk_tournament_request_team` (`team_id`);

--
-- Indexes for table `tournament_team`
--
ALTER TABLE `tournament_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `tournament_team_score`
--
ALTER TABLE `tournament_team_score`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tournament_team` (`tournament_id`,`team_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--

ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--

ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `highlights`
--
ALTER TABLE `highlights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `individual_score`
--
ALTER TABLE `individual_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_played`
--
ALTER TABLE `match_played`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `team_player`
--
ALTER TABLE `team_player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tournament_officials`
--
ALTER TABLE `tournament_officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tournament_request`
--
ALTER TABLE `tournament_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tournament_team`
--
ALTER TABLE `tournament_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tournament_team_score`
--
ALTER TABLE `tournament_team_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `highlights`
--
ALTER TABLE `highlights`
  ADD CONSTRAINT `highlights_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `individual_score`
--
ALTER TABLE `individual_score`
  ADD CONSTRAINT `fk_individual_score_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_individual_score_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_match_id` FOREIGN KEY (`match_id`) REFERENCES `match_played` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `individual_score_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `match_played` (`id`),
  ADD CONSTRAINT `individual_score_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`id`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Constraints for table `match_played`
--
ALTER TABLE `match_played`
  ADD CONSTRAINT `fk_match_played_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `match_played_ibfk_1` FOREIGN KEY (`team_1_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `match_played_ibfk_2` FOREIGN KEY (`team_2_id`) REFERENCES `team` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `match_played_ibfk_3` FOREIGN KEY (`official_1_id`) REFERENCES `userinfo` (`id`),
  ADD CONSTRAINT `match_played_ibfk_4` FOREIGN KEY (`official_2_id`) REFERENCES `userinfo` (`id`),
  ADD CONSTRAINT `match_played_ibfk_5` FOREIGN KEY (`official_3_id`) REFERENCES `userinfo` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_user` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `player_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`id`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `match_played` (`id`),
  ADD CONSTRAINT `score_ibfk_2` FOREIGN KEY (`team_1_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `score_ibfk_3` FOREIGN KEY (`team_2_id`) REFERENCES `team` (`id`);

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `userinfo` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_player`
--
ALTER TABLE `team_player`
  ADD CONSTRAINT `fk_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `tournament_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `userinfo` (`id`);

--
-- Constraints for table `tournament_officials`
--
ALTER TABLE `tournament_officials`
  ADD CONSTRAINT `tournament_officials_ibfk_1` FOREIGN KEY (`official_id`) REFERENCES `userinfo` (`id`),
  ADD CONSTRAINT `tournament_officials_ibfk_2` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tournament_request`
--
ALTER TABLE `tournament_request`
  ADD CONSTRAINT `fk_tournament_request_team` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tournament_request_tournament` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tournament_request_user` FOREIGN KEY (`user_id`) REFERENCES `userinfo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tournament_team`
--
ALTER TABLE `tournament_team`
  ADD CONSTRAINT `tournament_team_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tournament_team_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tournament_team_score`
--
ALTER TABLE `tournament_team_score`
  ADD CONSTRAINT `tournament_team_score_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournament` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tournament_team_score_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

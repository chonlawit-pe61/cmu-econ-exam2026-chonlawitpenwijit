-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 24, 2026 at 07:56 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `econ_research`
--

-- --------------------------------------------------------

--
-- Table structure for table `Research`
--

CREATE TABLE `Research` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `abstract` text NOT NULL,
  `researcher_name` varchar(255) NOT NULL,
  `research_type` int(11) NOT NULL,
  `publication_year` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Research`
--

INSERT INTO `Research` (`id`, `title`, `abstract`, `researcher_name`, `research_type`, `publication_year`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'testชื่องานวิจัยedit123xx', 'test', 'testชื่อผู้วิจัยxx1', 2, 2020, 1, '2026-02-24 13:58:30', '2026-02-24 14:25:14', '2026-02-24 14:25:52'),
(2, 'testชื่องานวิจัย', 'test', 'testชื่อผู้วิจัย', 1, 2020, 0, '2026-02-24 13:59:28', '2026-02-24 13:59:28', '2026-02-24 14:18:02'),
(3, 'ทดสอบสร้าง', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus consequuntur magnam nulla libero ratione quis quaerat autem! Ipsa sapiente assumenda sit repellendus praesentium dignissimos illo ad, cum atque delectus officiis magnam adipisci, labore nemo velit cupiditate sequi, doloribus fugit iusto accusamus odio? Eligendi a impedit amet expedita ipsam repudiandae, fugit ipsa iure omnis cumque. Assumenda totam deleniti voluptatum pariatur earum temporibus, libero possimus id cumque facilis atque magni. Aspernatur alias, magnam repudiandae doloremque veritatis quis eveniet quisquam repellendus saepe ipsum qui earum veniam dolorem culpa unde blanditiis fugiat dolor odio iste dolorum ex. Harum sit asperiores recusandae assumenda non ut.', 'ชลวิทย์', 1, 2021, 1, '2026-02-24 14:24:34', '2026-02-24 14:24:34', '2026-02-24 14:25:54'),
(4, 'test123', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam perferendis corporis autem earum libero aliquam eius illo tempore doloremque voluptatibus fugiat minima esse, aperiam rem deserunt exercitationem numquam commodi sapiente atque aliquid. Accusamus sequi id minima quod laudantium distinctio perspiciatis similique animi voluptatum quae nostrum soluta nemo fuga temporibus reprehenderit at, deserunt dignissimos unde deleniti debitis quaerat? Laboriosam vero cum assumenda ex illum aperiam consectetur sapiente quaerat repellat, consequuntur reprehenderit fugit quasi iusto nam, provident numquam quisquam repellendus praesentium explicabo quibusdam veritatis, incidunt deleniti. Optio labore dolor expedita fugit ut fugiat veritatis a? Nobis harum exercitationem, rem dicta eum molestiae!', 'test123', 1, 2020, 1, '2026-02-24 14:32:01', '2026-02-24 14:32:01', '2026-02-24 14:34:10'),
(5, 'test123', ' Lorem ipsum, dolor sit amet consectetur adipisicing elit. Omnis molestiae veniam quae, sed inventore, tenetur adipisci porro eos officia laborum quo ipsum voluptatum, doloremque aliquam est facere laboriosam fuga repudiandae libero delectus in corrupti cum alias. Nisi, quae iure! Maxime ipsam quaerat rerum architecto quam est, optio voluptatem eveniet deserunt earum placeat quisquam possimus ratione repudiandae asperiores aliquid in praesentium assumenda exercitationem incidunt ea iste adipisci illo. Similique officiis nisi doloribus harum dicta? Blanditiis voluptas expedita quibusdam libero natus ut praesentium asperiores. Expedita, magnam iure deserunt optio fugiat sunt officiis magni aut consequatur nihil reiciendis cumque. Exercitationem aspernatur necessitatibus adipisci!', 'testชื่อผู้วิจัย', 1, 2021, 1, '2026-02-24 14:32:14', '2026-02-24 14:43:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ResearchType`
--

CREATE TABLE `ResearchType` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ResearchType`
--

INSERT INTO `ResearchType` (`id`, `name`, `description`) VALUES
(1, 'การวิจัยเชิงประวัติศาสตร์', 'Historical Research'),
(2, 'การวิจัยเชิงพรรณนา ', 'Descriptive Research');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Research`
--
ALTER TABLE `Research`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ResearchType`
--
ALTER TABLE `ResearchType`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Research`
--
ALTER TABLE `Research`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ResearchType`
--
ALTER TABLE `ResearchType`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

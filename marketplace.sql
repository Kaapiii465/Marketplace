-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2026 at 04:51 PM
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
-- Database: `marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(20) NOT NULL DEFAULT 'Różne'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`) VALUES
(1, 'Różne'),
(2, 'Ubrania'),
(3, 'Elektronika i AGD'),
(4, 'Sportowe'),
(5, 'Dom i ogród');

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(150) NOT NULL,
  `opis` text DEFAULT NULL,
  `cena` decimal(10,2) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'dostepny',
  `user_id` int(11) DEFAULT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `opis`, `cena`, `kategoria_id`, `status`, `user_id`, `data_dodania`) VALUES
(3, 'produkt1', 'opis1', 999.00, 1, 'sprzedany', 4, '2026-05-13 09:26:08'),
(4, 'asdasd', 'dgeg', 234234.00, 3, 'sprzedany', 4, '2026-05-13 09:26:15'),
(5, 'sadw', 't3r23', 12312452.00, 2, 'sprzedany', 5, '2026-05-13 09:35:51'),
(6, '2342', 'wfeege', 23423.00, 2, 'sprzedany', 5, '2026-05-13 09:35:56'),
(7, 'afeh', 'rther', 34.00, 5, 'sprzedany', 5, '2026-05-13 09:35:59'),
(8, 'sfs', '453453erge', 234.00, 1, 'dostepny', 6, '2026-05-13 09:41:02'),
(9, 'produkt4', 'opis4', 1234.00, 4, 'dostepny', 6, '2026-05-14 06:30:33'),
(10, 'produkt5', 'opis56', 1234.00, 3, 'dostepny', 7, '2026-05-14 07:17:06'),
(11, 'test5', 'opis5', 55.00, 1, 'dostepny', 6, '2026-05-14 08:56:49'),
(12, 'test6', 'opis6', 66.00, 5, 'dostepny', 6, '2026-05-14 08:57:38'),
(15, 'test11', 'test11', 11.00, 1, 'sprzedany', 9, '2026-05-14 09:18:22'),
(16, 'test112', 'test112', 112.00, 1, 'dostepny', 9, '2026-05-14 09:18:30'),
(17, 'Jabłkaa', 'Czerwone, żółte, zielone, polskie.', 5.00, 2, 'dostepny', 8, '2026-05-14 10:18:59'),
(18, '12314252sf e', 'dfge ggd', 23.00, 1, 'dostepny', 8, '2026-05-14 13:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `haslo`, `email`) VALUES
(3, 'Kacper', '$2y$10$HJMPj6nqO0p4CCzEpbbtruFNhI6LulR2dQ.J.2wvx3iMe23qOBy9.', 'email1@gmail.com'),
(4, 'Kacper1', '$2y$10$80LPzS4cid5qyLSUvxli3.9xvCXFFHmJqYxPwTHG8VbRjdWCPj1.G', 'email2@gmail.com'),
(5, 'Kacper3', '$2y$10$x.IwhMwszOP97ZVqSVL0iuYXGb4QJlJCP1ah2i7EaCarUqENyjDdO', 'email3@gmail.com'),
(6, 'kacper4', '$2y$10$OuTmLnReR0oFvFgR5e7UVuoth6acREMy0qIAfvoAyBtP.fo2LmkBi', 'email4@gmail.com'),
(7, 'test', '$2y$10$.iJ9A17LlNwHNzQx0NwxNeRLLef0TogwOuufJaUiT2G4dlA93BF4y', 'test@test.com'),
(8, 'test10', '$2y$10$YP/D7.RDD9OMUdnOlYB8xObthsnT5qwvJ4WALXzrL5SnL4sjN3Vma', 'test10@test10'),
(9, 'test11', '$2y$10$mfecbjWceRdtqqyMRpC3sOR7TrjGdhTj66Q/UPSH5FvCB/Hev2vw6', 'test11@test11');

-- --------------------------------------------------------

--
-- Table structure for table `zakupy`
--

CREATE TABLE `zakupy` (
  `id` int(11) NOT NULL,
  `produkt_id` int(11) DEFAULT NULL,
  `kupujacy_id` int(11) DEFAULT NULL,
  `data_zakupu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zakupy`
--

INSERT INTO `zakupy` (`id`, `produkt_id`, `kupujacy_id`, `data_zakupu`) VALUES
(1, 3, 5, '2026-05-13 09:35:20'),
(2, 4, 5, '2026-05-13 09:35:24'),
(3, 6, 6, '2026-05-13 09:40:52'),
(4, 3, 6, '2026-05-13 09:40:53'),
(5, 7, 7, '2026-05-14 07:16:53'),
(6, 5, 7, '2026-05-14 07:17:09'),
(8, 15, 8, '2026-05-14 10:19:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `zakupy`
--
ALTER TABLE `zakupy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produkt_id` (`produkt_id`),
  ADD KEY `kupujacy_id` (`kupujacy_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `zakupy`
--
ALTER TABLE `zakupy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `uzytkownicy` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `zakupy`
--
ALTER TABLE `zakupy`
  ADD CONSTRAINT `zakupy_ibfk_1` FOREIGN KEY (`produkt_id`) REFERENCES `produkty` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `zakupy_ibfk_2` FOREIGN KEY (`kupujacy_id`) REFERENCES `uzytkownicy` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

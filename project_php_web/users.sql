-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2023 pada 23.30
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_php_web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
('111', 'doni', '$2y$10$BzEg8ty/vMgzuM4VcCx1BuOqp5knr5p4fJxvpZ.JzQ0s4wor4p9fy'),
('112', 'alif', '$2y$10$Rae/tPaBuRxkTaqbp5724eVO7C6J4cKkvY/v7D3GNOOck7UXqj/wG'),
('113', 'dio', '$2y$10$xcZ9QuZZCxeSmTo4a5cnvexdOQxwXnGJDRST9MSEbbmVScCoaRJO.'),
('114', 'edy', '$2y$10$ovSQIH33.rmd3ix4OiIYXeZ/t5DMWS6Rc2axn.JfV.4EwJxIIdtrq'),
('admin', 'Admin', '$2y$10$DjQktBCd3frMnGoy4ADWhOFd7YmQiPmwq0hUVyxiALjLhelQYpvhG'),
('benar', 'benar', '$2y$10$LZGZw/8A3h26wRgiFbhY3.SaW67BQyS6dGWhz3GzVD2HDio9W468O'),
('client', 'Client', '$2y$10$mXR2TdIYI7tcVz0xX4gtfefQtw/Yd2feBI7yv4nhorhTboMU7k2vi'),
('custamer', 'Custamer', '$2y$10$Y6GrlMx8KRYh2Be8N.jfhOOS//mDeP7qK2t/EIjrypc7nxzg2sGh2'),
('hakim', 'KimZaidan', '$2y$10$F6zD/ZLb2t4fxKcTcaZNeudWuxSoTSMgYDP6zZwiIlPyFOkXbsxMK'),
('salah', 'salah', '$2y$10$OlPPKAAeUYeE0Ei4UwiU/u8TTa6q7f2msK6W23W.D92N41yALPIn6'),
('user', 'User', '$2y$10$D86kkLL/wfljIFbSC4Glk.l.uzh363Q2Bp8SCXCBlwERTKLHs6Yva');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

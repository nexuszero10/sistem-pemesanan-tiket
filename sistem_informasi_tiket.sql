-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 03:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_informasi_tiket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `role`) VALUES
(1, 'admin1', 'admin_pw', 'admin'),
(2, 'admin2', 'admin2_pw', 'admin'),
(3, 'admin3', 'admin3_pw', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `film_id` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `judul` varchar(100) NOT NULL,
  `director` varchar(25) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `cast` varchar(50) NOT NULL,
  `synopsis` text NOT NULL,
  `harga` int(11) NOT NULL,
  `tahun_rilis` year(4) NOT NULL,
  `url_trailer` varchar(255) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`film_id`, `kategori_id`, `judul`, `director`, `genre`, `duration`, `cast`, `synopsis`, `harga`, `tahun_rilis`, `url_trailer`, `image`) VALUES
(1, 1, 'Suzume No Tojimari', 'Makoto Shinkai', 'Sci-Fi, Drama, Animation, Action', 121, 'Hatuko Matsumura, Nanoka Hara', 'A modern action adventure road story where a 17-year-old girl named Suzume helps a mysterious young man close doors from the other side that are releasing disasters all over in Japan.', 35000, '2022', 'https://www.youtube.com/embed/9oI5sO9zB20', 'suzumenotojimari.png'),
(2, 1, 'Tenki No Ko', 'Makoto Shinkai', 'Sci-Fi, Drama, Animation, Action, Romance', 171, 'Nana Mori, Honda Tsubasa, Katarou Daigo', 'eternal downpour arrives the runaway high school student Hodaka Morishima, who struggles to financially support himself-ending up with a job at a small-time publisher. At the same time, the orphaned Hina Amano also strives to find work to sustain herself and her younger brother.', 35000, '2019', 'https://www.youtube.com/embed/rzKcrJ77wBY', 'tenkinoko.png'),
(3, 1, 'Kimi No Nawa', 'Makoto Shinkai', 'Sci-Fi, Drama, Animation, Action', 167, 'Mone Kamishiraishi, Ryunosuke Kamiki, Masami Nagas', 'Mitsuha Miyamizu, a high school girl, yearns to live the life of a boy in the bustling city of Tokyo-a dream that stands in stark contrast to her present life in the countryside. Meanwhile in the city, Taki Tachibana lives a busy life as a high school student while juggling his part-time job and hopes for a future in architecture.', 35000, '2016', 'https://www.youtube.com/embed/3KR8_igDs1Y', 'kiminonawa.png'),
(4, 1, 'Jujutsu Kaisen 0\r\n', 'Park Sunghoo', 'Action, Fantasy', 164, 'Yuuichi Nakamura, Takahiro Sakurai, Megumi Ogata', 'Violent misfortunes frequently occur around 16-year-old Yuuta Okkotsu, a timid victim of high school bullying. Yuuta is saddled with a monstrous curse, a power that dishes out brutal revenge against his bullies. Rika Orimoto, Yuuta\'s curse, is a shadow from his tragic childhood and a potentially lethal threat to anyone who dares wrong him.', 35000, '2021', 'https://www.youtube.com/embed/UPRqnFnnrr8', 'jujutsukaisen0.png'),
(5, 1, 'Haikyuu!!: The Dumpster Battle', 'Susumu Mitsunaka', 'School, Sport', 85, 'Yuuichi Nakamura, Takahiro Sakurai, Megumi Ogata', 'After a long wait, Haikyuu!! anime fans can finally watch the continuation of the story of the Karasuno High School volleyball team in the Spring Nationals tournament. They defeated Inarizaki High School in the previous round and moved on.The victory will bring the Karasuno High School volleyball team to meet their arch rivals, the Nekoma High School team. This match was the first time for both teams although they have met many times during their training together.', 35000, '2024', 'https://www.youtube.com/embed/MqVA0dl36bc', 'haikyuuthedumpsterbattle.png'),
(6, 1, 'Violet Evergarden: The Movies', 'Taichi Isidate', 'Fantasy, Action, Romance', 140, 'Yui Ishikawa, Daisuke Namikawa, Aya Endou', 'Several years have passed since the end of The Great War. As the radio tower in Leidenschaftlich continues to be built, telephones will soon become more relevant, leading to a decline in demand for \"Auto Memory Dolls.\" Even so, Violet Evergarden continues to rise in fame after her constant success with writing letters. However, sometimes the one thing you long for is the one thing that does not  appear.Violet Evergarden Movie follows Violet as she continues to comprehend the concept of emotion and the meaning of love. At the same time, she pursues a glimmer of hope that the man who once told her, \"I love you,\" may still be alive even after the many years that have passed.', 35000, '2019', 'https://www.youtube.com/embed/BUfSen2rYQs', 'violetevergardenthemovies.png'),
(7, 1, 'Demon Slayer: Mugen Train', 'Haruo Sotozaki', 'Fantasy, Action', 116, 'Satoshi Hino, Natsuki Hanae', 'After a string of mysterious disappearances begin to plague a train, the Demon Slayer Corps\' multiple attempts to remedy the problem prove fruitless. To prevent further casualties, the Flame Pillar, Kyoujurou Rengoku, takes it upon himself to eliminate the threat. Accompanying him are some of the Corps\' most promising new blood: Tanjirou Kamado, Zenitsu Agatsuma, and Inosuke Hashibira, who all hope to witness the fiery feats of this model demon slayer firsthand.', 35000, '2019', 'https://www.youtube.com/embed/ATJYac_dORw', 'demonslayermugentrain.png'),
(8, 1, 'The Boy And The Heron', 'Haruo Sotozaki', 'Fantasy, Action, Drama, Adventure', 116, 'Satoshi Hino, Natsuki Hanae', 'Three years into the war, Mahito Maki loses his mother in a tragic fire at the hospital. Shortly thereafter, his father marries Natsuko, the younger sister of Mahito\'s mother. They take Mahito out of Tokyo to seek refuge in his late mother\'s rural family home. There, Mahito is constantly taunted by a strange gray heron, who seems to have taken an interest in him.', 35000, '2023', 'https://www.youtube.com/embed/t5khm-VjEu4', 'theboyantheheron.png'),
(9, 2, 'Dune: Part One', 'Denis Villeneuve', 'Fantasy, Action, Sci-Fi, Drama, Adventure', 155, 'Timothee Chalamet, Zendaya', 'A mythical and emotional hero\'s journey, Dune tells the story of Paul Atreides, a bright and talented young man born into a great destiny beyond his understanding, who must travel to the most dangerous planet in the universe to ensure his future.', 40000, '2021', 'https://www.youtube.com/embed/n9xhJrPXop4', 'dunepartone.png'),
(10, 2, 'Dune: Part Two', 'Denis Villeneuve', 'Fantasy, Action, Drama, Adventure', 166, 'Timothee Chalamet, Zendaya', 'Paul Atreides unites with Chani and the Fremen while seeking revenge against the conspirators who destroyed his family.', 40000, '2024', 'https://www.youtube.com/embed/Way9Dexny3w', 'dunepasrttwo.png'),
(11, 2, 'Fantastic Beast: The Crimes Of Grindelwald', 'David Yates', 'Fantasy, Action, Adventure', 133, 'Eddy Redmayne, Jude Law, Johnny Depp', 'Gellert Grindelwald plans to raise an army of wizards to rule over non-magical beings. In response, Newt Scamander\'s former professor, Albus Dumbledore, seeks his help to stop him', 40000, '2018', 'https://www.youtube.com/embed/8bYBOVWLNIs', 'fantasticbeastthecrimesofgrindelwald.png'),
(12, 2, 'Fantastic Beats: The Secret of Dumbeldore', 'David Yates', 'Fantasy, Action, Adventure', 142, 'Eddy Redmayne, Jude Law', 'Albus Dumbledore knows that Gellert Grindelwald is moving to take control of the wizarding world.Unable to stop him alone, he asks Newt Scamander to lead an intrepid team on a dangerous mission.', 40000, '2022', 'https://www.youtube.com/embed/8bYBOVWLNIs', 'fantasticbeatsthesecretofdumbeldore.png'),
(13, 3, 'Rembulan Tenggelam Di Wajahmu', 'Ridle Scott', 'HIstory, Action, Adventure', 93, 'Arifin Putra, Anya Geraldine, Cornelio Sunny', 'A lonely and rich man were sick in the hospital, and someone brings him back to the past to find an answers of his questions that he shouted to God, and finally get the answers one by one', 30000, '2019', 'https://www.youtube.com/embed/bIBTj3sOrxA', 'rembulantenggelamdiwajahmu.jpg'),
(14, 2, 'Kingdom Of The Planets Of The Apes', 'Wes Ball', 'Sci-Fi, Action, Adventure', 145, 'Freya Allan, Kevin Durand, Owen Teague', 'Many years after the reign of Caesar, a young ape goes on a journey that will lead him to question everything he\'s been taught about the past and make choices that will define a future for apes and humans alike.', 40000, '2024', 'https://www.youtube.com/embed/Kdr5oedn7q8', 'kingdomoftheplanetsoftheapes.png'),
(15, 2, 'Despicable Me 4', 'Chris Renaud', 'Animation, Comedy, Adventure, Sci-Fi', 94, 'Steve Carell, Pierre Coffin, Will Ferrell', 'Gru, Lucy, Margo, Edith, and Agnes welcome a new member to the family, Gru Jr., who is intent on tormenting his dad. Gru faces a new nemesis in Maxime Le Mal and his girlfriend Valentina, and the family is forced to go on the run.', 40000, '2024', 'https://www.youtube.com/embed/qQlr9-rF32A', 'despicableme4.png'),
(16, 3, 'Wonderland', 'Kim Tae-yong', 'Sci-Fi, Romance, Drama', 113, 'Bae Suzy, Park Bo-Gum, Choi Woo-shik', 'A virtual world where AI simulates reunions, a 20-year-old woman requests to meet her comatose lover, and a 40-year-old man requests to meet his deceased wife.', 35000, '2024', 'https://www.youtube.com/embed/NFIRWIGxWl8', 'wonderland.png');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `studio_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pukul` time NOT NULL,
  `hari` varchar(10) DEFAULT NULL,
  `kapasitas_studio` int(11) NOT NULL DEFAULT 24,
  `status` enum('selesai','belum_selesai') DEFAULT 'belum_selesai',
  `admin_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`jadwal_id`, `film_id`, `studio_id`, `tanggal`, `pukul`, `hari`, `kapasitas_studio`, `status`, `admin_id`) VALUES
(1, 1, 1, '2025-01-13', '10:00:00', 'Monday', 24, 'belum_selesai', 1),
(2, 2, 2, '2024-12-24', '13:00:00', 'Tuesday', 24, 'belum_selesai', 1),
(3, 3, 1, '2024-12-25', '16:00:00', 'Wednesday', 24, 'belum_selesai', 1),
(4, 4, 2, '2024-12-26', '19:00:00', 'Thursday', 24, 'belum_selesai', 1),
(5, 5, 1, '2024-12-27', '16:00:00', 'Friday', 24, 'belum_selesai', 1),
(6, 6, 2, '2024-12-28', '13:00:00', 'Saturday', 24, 'belum_selesai', 1),
(7, 7, 1, '2024-12-29', '10:00:00', 'Sunday', 24, 'belum_selesai', 1),
(8, 8, 1, '2024-12-23', '13:00:00', 'Monday', 24, 'belum_selesai', 1),
(9, 9, 2, '2024-12-24', '19:00:00', 'Tuesday', 24, 'belum_selesai', 1),
(10, 10, 1, '2024-12-25', '10:00:00', 'Wednesday', 24, 'belum_selesai', 1),
(11, 11, 2, '2024-12-26', '13:00:00', 'Thursday', 24, 'belum_selesai', 1),
(12, 12, 1, '2024-12-27', '10:00:00', 'Friday', 24, 'belum_selesai', 1),
(13, 13, 2, '2024-12-28', '19:00:00', 'Saturday', 24, 'belum_selesai', 1),
(14, 14, 1, '2024-12-29', '16:00:00', 'Sunday', 24, 'belum_selesai', 1),
(15, 15, 1, '2024-12-28', '10:00:00', 'Saturday', 24, 'belum_selesai', 1),
(16, 16, 2, '2024-12-29', '19:00:00', 'Sunday', 24, 'belum_selesai', 1),
(17, 2, 2, '2024-12-23', '13:00:00', 'Monday', 24, 'belum_selesai', 1),
(20, 3, 1, '2024-12-26', '16:00:00', 'Thursday', 24, 'belum_selesai', 1);

--
-- Triggers `jadwal`
--
DELIMITER $$
CREATE TRIGGER `set_hari_on_insert` BEFORE INSERT ON `jadwal` FOR EACH ROW BEGIN
  
  SET NEW.hari = DAYNAME(NEW.tanggal);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_hari_on_update` BEFORE UPDATE ON `jadwal` FOR EACH ROW BEGIN
    
    IF NEW.tanggal <> OLD.tanggal THEN
        SET NEW.hari = DAYNAME(NEW.tanggal);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_jadwal_on_status_selesai` BEFORE UPDATE ON `jadwal` FOR EACH ROW BEGIN
    
    IF NEW.status = 'selesai' AND OLD.status = 'belum_selesai' THEN
        
        SET NEW.tanggal = DATE_ADD(OLD.tanggal, INTERVAL 7 DAY);
        SET NEW.kapasitas_studio = 24; 
        SET NEW.status = 'belum_selesai'; 
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama` enum('Jepang','Barat','Lainnya') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama`) VALUES
(1, 'Jepang'),
(2, 'Barat'),
(3, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE `studio` (
  `studio_id` int(11) NOT NULL,
  `nomor_studio` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`studio_id`, `nomor_studio`, `kapasitas`) VALUES
(1, 1, 24),
(2, 2, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `tiket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `baris_kursi` enum('A','B','C','D') NOT NULL,
  `nomor_kursi` int(11) NOT NULL,
  `status_tiket` enum('success') DEFAULT NULL,
  `order_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`tiket_id`, `user_id`, `jadwal_id`, `baris_kursi`, `nomor_kursi`, `status_tiket`, `order_id`) VALUES
(1, 14, 1, 'A', 1, 'success', 'order-6764a8b2c897e'),
(2, 14, 1, 'A', 2, 'success', 'order-6764a8b2c897e'),
(3, 15, 1, 'A', 3, 'success', 'order-6764afd9d02d4');

--
-- Triggers `tiket`
--
DELIMITER $$
CREATE TRIGGER `update_studio_capacity` AFTER INSERT ON `tiket` FOR EACH ROW BEGIN
    
    IF NEW.status_tiket = 'success' THEN
        -- Kurangi kapasitas studio berdasarkan jadwal_id tiket
        UPDATE jadwal
        SET kapasitas_studio = kapasitas_studio - 1
        WHERE jadwal_id = NEW.jadwal_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `ulasan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 10),
  `komentar` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('visitor') NOT NULL DEFAULT 'visitor'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role`) VALUES
(14, 'nexuszero10', '$2y$10$ZHFGMV6oCZekfqHXJ//HEO2uiF8o6W73MSpB0/bfTH6wlHZkKcfl.', 'visitor'),
(15, 'kingrd', '$2y$10$H6LWsYXS8R8KWajhiONf1uK92N7LSMZk9xcm3Xkg0LnOq99QcAcN6', 'visitor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`),
  ADD KEY `fk_kategori_id` (`kategori_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`jadwal_id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `studio_id` (`studio_id`),
  ADD KEY `fk_jadwal_admin` (`admin_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`studio_id`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`tiket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `jadwal_id` (`jadwal_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`ulasan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studio`
--
ALTER TABLE `studio`
  MODIFY `studio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `tiket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `ulasan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `fk_kategori_id` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_jadwal_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`studio_id`) REFERENCES `studio` (`studio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`jadwal_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2025 at 04:35 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diagnosa_mental`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `nomor` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `nomor`, `feedback`, `tanggal`) VALUES
(1, '6285786792674@s.whatsapp.net', 'masuk ga', '2025-05-26 03:07:47'),
(2, '6285786792674@s.whatsapp.net', 'cihuyyy', '2025-05-26 10:17:33'),
(3, '6282137939099@s.whatsapp.net', 'Kepo ah', '2025-05-26 10:20:41'),
(4, '6285786792674@s.whatsapp.net', 'tes lagi', '2025-05-26 10:57:07'),
(5, '6285786792674@s.whatsapp.net', 'hmm', '2025-05-26 10:57:46'),
(6, '6285786792674@s.whatsapp.net', 'tes lagi', '2025-05-26 11:21:47'),
(7, '6285786792674@s.whatsapp.net', 'Infooo masehhhh', '2025-05-30 09:19:20'),
(8, '628987944081@s.whatsapp.net', 'Cukup baik', '2025-05-30 09:56:26'),
(9, '6285786792674@s.whatsapp.net', 'tes lagi', '2025-06-11 08:29:14'),
(10, '6281400744843@s.whatsapp.net', 'bot gajelas', '2025-06-17 12:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `gangguan_mental`
--

CREATE TABLE `gangguan_mental` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `ringkasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gangguan_mental`
--

INSERT INTO `gangguan_mental` (`id`, `nama`, `deskripsi`, `ringkasan`) VALUES
(1, 'Autism Spectrum Disorder (ASD) / Autisme', 'ASD adalah gangguan perkembangan saraf yang ditandai oleh kesulitan dalam interaksi sosial, komunikasi verbal dan nonverbal, serta perilaku terbatas dan repetitif. Gejala biasanya muncul sebelum usia 3 tahun.', 'Anak susah bicara atau berinteraksi dengan orang lain, suka melakukan hal yang sama berulang-ulang, dan sulit memahami perasaan orang'),
(2, 'Attention Deficit Hyperactivity Disorder (ADHD) / Gangguan Konsentrasi dan Hiperaktif', 'ADHD ditandai oleh pola berkelanjutan dari kurang perhatian dan/atau hiperaktivitas-impulsivitas yang mengganggu fungsi atau perkembangan.', 'Anak sulit fokus, tidak bisa diam, dan suka bertindak tanpa pikir panjang'),
(3, 'Depression in Children / Depresi Anak', 'Gangguan mood yang ditandai oleh suasana hati yang sedih atau mudah marah, hilangnya minat, gangguan tidur dan makan, dan kadang-kadang pikiran untuk bunuh diri.', 'Gangguan mood yang ditandai oleh suasana hati yang sedih atau mudah marah, hilangnya minat, gangguan tidur dan makan, dan kadang-kadang pikiran untuk bunuh diri.'),
(4, 'Anxiety Disorders / Gangguan Cemas Anak', 'Meliputi fobia spesifik, gangguan kecemasan sosial, gangguan kecemasan umum (GAD), dan gangguan panik. Anak menunjukkan ketakutan atau kecemasan yang tidak proporsional dengan situasi.', 'Anak mudah takut, gelisah, atau khawatir berlebihan terutama saat sekolah atau bertemu orang baru'),
(5, 'Obsessive-Compulsive Disorder (OCD) / pikiran yang terus-menerus muncul dan mengganggu', 'Gangguan Obsesif-Kompulsif (OCD) adalah keadaan di mana seseorang punya pikiran yang terus-menerus muncul dan mengganggu (ini namanya obsesi), lalu dia merasa harus melakukan tindakan berulang-ulang (ini namanya kompulsi) untuk menenangkan atau menghilangkan pikiran mengganggu itu.', 'Takut kuman, khawatir keselamatan, ingin segala sesuatu rapi, takut menyakiti diri/orang lain, cemas sakit/meninggal, pikiran buruk; sering cuci tangan/mandi/membersihkan, memeriksa berulang, menata ulang barang, mencari kepastian, menyentuh/mengetuk, menghitung/mengulang.'),
(6, 'Eating Disorder (Anorexia, Bulimia, ARFID) / Gangguan Makan', 'Gangguan Makan adalah masalah serius saat seseorang punya hubungan yang tidak sehat dengan makanan dan berat badan, sampai mengganggu kesehatan.', 'Perhatian berlebihan pada makanan, cemas akan berat badan, penyalahgunaan laksatif/pencahar, olahraga berlebihan, konsumsi makanan/snack berlebihan, serta depresi dan rasa bersalah terkait kebiasaan makan.'),
(7, 'Post-Traumatic Stress Disorder (PTSD) / kilas balik (flashback) atau mimpi buruk tentang peristiwa traumatis', 'Post-Traumatic Stress Disorder (PTSD) atau Gangguan Stres Pascatrauma adalah kondisi kesehatan mental yang muncul setelah seseorang mengalami atau menyaksikan kejadian yang sangat menakutkan atau traumatis.', 'Mengalami kilas balik atau pikiran berulang tentang peristiwa traumatis, mimpi buruk, menjadi sangat kesal saat dipicu, kurangnya emosi positif, rasa takut atau sedih yang intens, mudah tersinggung atau marah, selalu waspada terhadap ancaman, mudah terkejut, merasa tidak berdaya/putus asa/menarik diri, menyangkal kejadian, atau menghindari tempat/orang yang terkait trauma.');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` int NOT NULL,
  `id_gangguan` int NOT NULL,
  `gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `id_gangguan`, `gejala`) VALUES
(1, 1, 'Sulit mengungkapkan perasaan dan mengekspresikan emosi; Sulit mengerti apa yang diucapkan dipikirkan dan dirasakan orang lain; Memiliki minat tinggi pada suatu kegiatan sehingga terkesan obsesif dan melakukan suatu perilaku secara berulang (stimming); Menyukai rutinitas yang terstruktur dan sama. Jika rutinitas terganggu ia akan sangat marah; Sulit untuk menjalin pertemanan dan lebih suka menyendiri; Sering kali menjawab sesuatu yang tidak sesuai dengan pertanyaan. Alih-alih menjawab mereka lebih sering mengulang apa yang dikatakan orang lain; Sulit mengungkapkan kebutuhannya dengan kata-kata atau gerakan; Tidak melakukan permainan “pura-pura” seperti tidak berpura-pura memberi makan pada boneka saat anak main boneka; Sering melakukan gerakan yang berulang; Sulit beradaptasi ketika rutinitas berubah; Memiliki reaksi yang tidak biasa terhadap bau rasa tampilan perasaan atau suara; Anak kehilangan keterampilan yang pernah mereka miliki seperti berhenti mengucapkan kata-kata yang pernah mereka gunakan'),
(2, 2, 'banyak melamun; sering lupa atau kehilangan banyak hal; menggeliat atau gelisah; bicara terlalu banyak; melakukan kesalahan ceroboh atau mengambil risiko yang tidak perlu; sulit menahan godaan; mengalami kesulitan dalam mengambil giliran; mengalami kesulitan bergaul dengan orang lain'),
(3, 3, 'Mudah tersinggung bahkan cenderung untuk mengamuk atau tantrum; Sering merasa sedih dan hampa karena menganggap bahwa hidupnya tidak berarti; Nafsu makan meningkat karena mencoba menenangkan diri; Kurang nafsu makan karena merasa semua makanan tidak enak; Tidak tertarik pada hal yang biasanya ia sukai; Mengalami kesulitan tidur dan merasa lelah sepanjang hari; Sulit berkonsentrasi sehingga terjadi penurunan prestasi yang drastis di sekolah; Adanya keluhan fisik seperti sakit perut atau sakit kepala; Kesulitan berinteraksi dengan orang lain sehingga menarik diri dari lingkungan sosial; Tertarik dengan kematian yang tidak biasa seperti ingin melakukan bunuh diri; Tidak percaya diri; Terlihat lemas dan kurang bersemangat karena kehilangan energi dari menangis; Merasa pesimis putus asa dan tidak berguna yang berlebihan.'),
(4, 4, 'ketakutan berlebihan terhadap keluarga sekolah teman atau aktivitas; khawatir tentang masa depan; perubahan pola tidur dan makan; gejala fisik seperti sakit perut sakit kepala nyeri otot atau ketegangan; kegelisahan atau mudah tersinggung; takut membuat kesalahan atau dipermalukan'),
(5, 5, 'Takut terhadap kuman dan kotoran; Kekhawatiran tentang keselamatan; Berfokus pada menjaga barang-barang dalam urutan atau lokasi tertentu; Khawatir akan cedera atau menyakiti orang lain; Takut bahwa mereka atau orang yang mereka sayangi akan sakit atau meninggal; Takut akan melakukan hal-hal yang buruk (seperti menjadi agresif atau melakukan tindakan seksual); Terlalu sering mencuci tangan mandi atau berendam; Sering membersihkan permukaan; Memeriksa apakah pintu dan jendela terkunci (berulang kali); Terus-menerus menata ulang item; Mencari kepastian terus-menerus dari orang tua atau pengasuh; Menyentuh atau mengetuk item tertentu; Menghitung menceritakan kembali atau mengulang angka kata atau suara'),
(6, 6, 'Perhatian yang berlebihan terhadap menu makanan; Merasa cemas akan berat badannya; Penyalahgunaan laksatif atau obat pencahar; Olahraga berlebihan; Konsumsi banyak makanan atau snack; Depresi dan merasa bersalah atas kebiasaan makannya'),
(7, 7, 'Menghidupkan kembali peristiwa tersebut berulang-ulang dalam pikiran atau permainan; Mimpi buruk dan masalah tidur; Menjadi sangat kesal ketika sesuatu memicu ingatan tentang peristiwa tersebut; Kurangnya emosi positif; Ketakutan atau kesedihan yang intens dan berkelanjutan; Mudah tersinggung dan meledak-ledak marah; Terus-menerus mencari kemungkinan ancaman mudah terkejut; Bertindak tidak berdaya putus asa atau menarik diri; Menyangkal bahwa peristiwa tersebut terjadi atau merasa mati rasa; Menghindari tempat atau orang yang terkait dengan acara tersebut');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gangguan_mental`
--
ALTER TABLE `gangguan_mental`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gangguan` (`id_gangguan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gangguan_mental`
--
ALTER TABLE `gangguan_mental`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gejala`
--
ALTER TABLE `gejala`
  ADD CONSTRAINT `gejala_ibfk_1` FOREIGN KEY (`id_gangguan`) REFERENCES `gangguan_mental` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

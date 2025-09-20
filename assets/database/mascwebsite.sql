-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2025 at 06:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mascwebsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `actor` varchar(100) DEFAULT NULL,
  `entity_type` enum('event','news') NOT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `entity_title` varchar(255) NOT NULL,
  `action` enum('create','update','publish','unpublish','delete','upload_image') NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'MASCAdmin', '$2y$10$xLEnDBM4dfRBUaZkU3/Qn.HtWg9dR570ZBrwuYX.tgjllqPY.0MlS', '2025-08-21 08:50:36'),
(2, 'MASCSAdmin', '$2y$10$YDcs1tJVD1HqBMY79YM98.Lo4k/w6.Tocf6Jz59djdRSF0mc839lq', '2025-08-22 14:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `category` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `category`, `image`, `created_at`) VALUES
(1, 'INπNITY 2023 First Round', 'The Mathematics and Statistics Circle of NSBM Faculty of Computing proudly hosted “𝗜𝗡π𝗡𝗜𝗧𝗬 2023” on 10th May 2023, engaging math enthusiasts across the faculty. The first two rounds were held during the event, selecting the top 10 teams for the next stage.\r\n\r\nThe day also marked the inauguration of the Circle, where its Logo, Mission, Vision, and Objectives were officially unveiled in the presence of distinguished guests including the Vice-Chancellor, Deputy Vice-Chancellor, Deans, and academics.', '2023-05-10', 'past', 'assets/image/events/INFINITY 2023 First Round.png', '2025-08-22 10:32:44'),
(2, 'INπNITY 2023 Final Round', 'The Mathematics and Statistics Circle of NSBM Faculty of Computing proudly congratulates the 10 outstanding groups who participated in the final round of INFINITY 2023. Having demonstrated excellence in the earlier rounds, these teams showcased their remarkable math skills and creativity in the ultimate challenge. The INFINITY 2023 Final Competition was a great success thanks to the hard work and enthusiasm of all participants. We extend our heartfelt thanks to the participants, volunteers, and supporters for making this event possible.', '2023-05-31', 'past', 'assets/image/events/INFINITY 2023 Final Round.png', '2025-08-22 11:38:48'),
(3, 'INπNITY 2023 Rewards Ceremony', 'The Mathematics and Statistics Circle of the NSBM Faculty of Computing successfully concluded the “𝗜𝗡π𝗡𝗜𝗧𝗬 2023” Maths Quiz Competition with the Grand Finale and Awarding Ceremony held on 6th September 2023. The competition brought together over 100 mathematics enthusiasts from the faculty, who showcased their skills and problem-solving prowess across several challenging rounds. Emerging victorious in the Grand Finale, team “Eureka” claimed first place, while team “Mathmagicians” and team “Math Strangers” secured second and third places respectively.\n\nThe Grand Finale and Awarding Ceremony were conducted in the distinguished presence of Deputy Vice-Chancellor Prof. Chaminda Rathnayake, Deans of the Faculty of Computing including Dr. Rasika Ranaweera, heads of departments, and faculty academics and staff.', '2023-09-06', 'past', 'assets/image/events/INFINITY 2023 Rewards Ceremony.png', '2025-08-22 11:55:46'),
(4, 'Brainwave 1.0', '“BRAINWAVE 1.0: Numbers in Motion!”, the ultimate math competition organized by the Mathematics and Statistics Circle of NSBM Faculty of Computing, concluded on 10th July 2024 at the faculty premises. The competition aimed to enhance the critical thinking of computing students and showcase their mathematical prowess through a series of engaging math games, thrilling challenges, and valuable networking opportunities.\r\n\r\nThe event was graced by the Dean of the Faculty of Computing, Dr. Chaminda Wijesinghe; Head of the Department of Software Engineering & Information Systems, Dr. Mohamed Shafraz; Head of the Department of Computer and Data Science, Mr. Naji Saravanabavan; Mistress in Charge of the Mathematics and Statistics Circle, Ms. Hirushi Dilpriya; along with the faculty’s academics and staff.', '2024-07-10', 'past', 'assets/image/events/Brainwave 1.0.png', '2025-08-22 12:07:09'),
(5, 'Elevate 24', 'Mathematica Elevate ’24, an insightful workshop organized by the Mathematics and Statistics Circle at NSBM Faculty of Computing, was held on 25th November 2024 at the faculty premises. The workshop provided computing undergraduates with an exceptional platform to explore the dynamic interplay between mathematics and artificial intelligence, highlighting their pivotal roles in shaping the future of technology. The sessions featured two distinguished speakers: Ms. Madushi Welikala, Software Engineer at WorldRemit, and Mr. Dulan Dias, Ph.D. Candidate specializing in Data Science and Artificial Intelligence.\r\n\r\nIn conjunction with the workshop, the Annual General Meeting (AGM) of the Mathematics and Statistics Circle was held, fostering collaboration and outlining the agenda for the upcoming year.\r\n\r\nThe occasion was graced by the Dean of the Faculty of Computing, Dr. Chaminda Wijesinghe, Lecturer in Charge of the Mathematics and Statistics Circle, Ms. Hirushi Dilpriya, along with the academics of NSBM Faculty of Computing.', '2024-11-25', 'past', 'assets/image/events/Elevate 24.png', '2025-08-22 12:22:11'),
(6, 'NSBM MathMaster First Round', 'The Mathematics and Statistics Circle proudly hosted the first round of the NSBM Math Master – Inter-School Mathematics Competition on 28th April 2025, marking the beginning of an exciting journey to identify and celebrate young mathematical talent. The event brought together 250 Advanced Level students representing 50 leading schools across the Western Province, providing a platform for showcasing analytical thinking, problem-solving skills, and competitive spirit.\r\n\r\nIn conjunction with the competition, the Circle also launched the official NSBM Math Master website at the Green Boardroom, celebrating innovation and academic advancement. The launch was held in the esteemed presence of Dr. Rasika Ranaweera, Dean of the Faculty of Computing; Prof. Chaminda Wijesinghe, Head of the Department of Data Science; and fellow lecturers, under the guidance of Ms. Hirushi Dilpriya, Lecturer-in-Charge of the Circle.', '2025-04-28', 'past', 'assets/image/events/NSBM MathMaster First Round.png', '2025-08-22 12:40:34'),
(7, 'NSBM MathMaster Final Round', 'The Mathematics and Statistics Circle proudly concluded the Final Round of the MathMaster Inter-School Mathematics Competition on 19th May 2025 at NSBM Green University. The event brought together brilliant young minds from across the Western Province, celebrating mathematical talent, teamwork, and critical thinking.\r\n\r\nThe final round showcased the culmination of weeks of challenging rounds, with students demonstrating exceptional problem-solving skills and creativity. The Circle extends its hearty congratulations to all participants and winners for their remarkable enthusiasm and dedication to mathematics.', '2025-05-19', 'past', 'assets/image/events/NSBM MathMaster Final Round.png', '2025-08-22 12:54:29'),
(8, 'Dynalab - Session 1', 'Ready to Elevate Your Coding and Data Skills? Gain hands-on experience and unlock the power of MATLAB to build smarter solutions and think bigger!<br><br>Dynalab: The MATLAB Workshop is coming soon. Stay tuned for more details!', '2025-09-01', 'past', 'assets/image/events/Dynalab - Session 1.png', '2025-08-22 12:59:04'),
(9, 'Dynalab - Session 2', 'Ready to Elevate Your Coding and Data Skills? Gain hands-on experience and unlock the power of MATLAB to build smarter solutions and think bigger!Dynalab: The MATLAB Workshop is coming soon. Stay tuned for more details!', '2025-09-04', 'upcoming', 'assets/image/events/Dynalab - Session 2.png', '2025-08-27 16:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publish_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `source_link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `full_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `category`, `author`, `publish_date`, `image`, `source_link`, `description`, `full_content`, `created_at`) VALUES
(1, 'New Algorithm Solves Graph Theory Problem', 'Breakthroughs & Research', 'By MIT News', '2025-08-12', 'assets/image/news/New Algorithm Solves Graph Theory Problem.png', 'https://news.mit.edu/', 'A team at MIT has published a new, faster algorithm for solving a famous problem in graph theory, with major implications for network design.', 'For decades, the \'traveling salesman problem\' has been a benchmark for computational complexity in graph theory. The new algorithm, developed by Dr. Evelyn Reed and her team, utilizes quantum-inspired principles to find near-optimal solutions in a fraction of the time of previous methods. This breakthrough is expected to revolutionize logistics, circuit design, and data network optimization.', '2025-08-16 15:09:09'),
(2, 'AI Discovers New Geometric Proofs', 'Breakthroughs & Research', 'By Science Daily', '2025-08-10', 'assets/image/news/AI Discovers New Geometric Proofs.png', 'https://www.sciencedaily.com/', 'Researchers are now using artificial intelligence to explore mathematical concepts, leading to previously unknown geometric theorems.', 'A new AI system named \'Euclid\'s Dream\' has been making waves in the mathematical community. By analyzing vast datasets of geometric shapes and relationships, the AI has formulated and proven several new theorems related to non-Euclidean geometry. This marks a significant step in human-AI collaboration for pure mathematical discovery, suggesting that AI can be a partner in creative reasoning, not just computation.', '2025-08-16 15:09:09'),
(3, 'Topology Breakthrough in 4D Spaces', 'Breakthroughs & Research', 'By Quanta Magazine', '2025-08-05', 'assets/image/news/Topology Breakthrough in 4D Spaces.png', 'https://www.quantamagazine.org/', 'A recent paper sheds new light on the complex nature of four-dimensional manifolds, a notoriously difficult area of topology.', 'Understanding shapes in dimensions beyond our own is a core challenge of topology. A new paper published in \'Nature Mathematics\' provides a novel classification system for certain types of 4-manifolds. This could have profound implications for theoretical physics, particularly in string theory and models of the early universe, where extra dimensions are a key component.', '2025-08-16 15:09:09'),
(4, 'Progress on the Twin Prime Conjecture', 'Breakthroughs & Research', 'By Numberphile', '2025-07-28', 'assets/image/news/Progress on the Twin Prime Conjecture.png', 'https://www.numberphile.com/', 'Mathematicians have made significant progress towards proving the twin prime conjecture, one of the oldest unsolved problems in number theory.', 'The twin prime conjecture posits that there are infinitely many pairs of prime numbers that differ by only 2 (like 11 and 13). While a full proof remains elusive, recent work by Yitang Zhang and others has established finite bounds on prime gaps, bringing mathematicians closer than ever to solving this centuries-old mystery. The latest findings have narrowed the gap significantly, creating a buzz in the number theory community.', '2025-08-16 15:09:09'),
(5, 'The Lost Notebooks of Ramanujan', 'Figures & History', 'By Math History', '2025-07-25', 'assets/image/news/The Lost Notebooks of Ramanujan.png', 'https://mathshistory.st-andrews.ac.uk/', 'Exploring the fascinating and profound mathematical ideas found within the lost notebooks of Srinivasa Ramanujan.', 'Srinivasa Ramanujan was an Indian mathematician whose contributions to number theory, continued fractions, and infinite series were extraordinary. His \'lost notebook\', a collection of pages written during the last year of his life, was rediscovered in 1976 and continues to be a source of deep mathematical problems. This article explores the history of the notebook and some of the incredible formulas contained within, many of which were centuries ahead of their time.', '2025-08-16 15:09:09'),
(6, 'A Profile on Maryam Mirzakhani', 'Figures & History', 'By Stanford University', '2025-07-22', 'assets/image/news/A Profile on Maryam Mirzakhani.png', 'https://news.stanford.edu/', 'Remembering the incredible life and work of Maryam Mirzakhani, the first and only female Fields Medalist.', 'Maryam Mirzakhani was an Iranian mathematician and a professor at Stanford University. In 2014, she was awarded the Fields Medal, the most prestigious award in mathematics, for her groundbreaking work on the dynamics and geometry of Riemann surfaces. Her story is one of brilliance, perseverance, and inspiration, breaking barriers and leaving a lasting legacy in the world of mathematics.', '2025-08-16 15:09:09'),
(7, 'Euclid\'s Elements: Still Relevant Today?', 'Figures & History', 'By Classic Texts', '2025-07-18', 'assets/image/news/Euclid\'s Elements Still Relevant Today.png', 'https://www.gutenberg.org/ebooks/21076', 'How the foundational principles laid out in Euclid\'s Elements over 2000 years ago still influence modern mathematics and logic.', 'Written around 300 BC, Euclid\'s \'Elements\' is one of the most influential works in the history of mathematics. It served as the main textbook for teaching mathematics for over two millennia. This article examines its core axioms and propositions and traces their influence through history, showing how the rigorous, deductive logic pioneered by Euclid remains the fundamental standard for mathematical proof today.', '2025-08-16 15:09:09'),
(8, 'Alan Turing: The Father of Computing', 'Figures & History', 'By Tech Archives', '2025-07-15', 'assets/image/news/Alan Turing The Father of Computing.png', 'https://www.turing.org.uk/', 'A look into the mathematical genius of Alan Turing and his foundational work that led to the modern computer.', 'Alan Turing was a brilliant mathematician and logician whose work is considered foundational to theoretical computer science and artificial intelligence. His concept of the \'Turing machine\' provided a formalization of the concepts of algorithm and computation. This article explores his life, his critical role in breaking Enigma codes during WWII, and his visionary ideas that shaped the digital world we live in.', '2025-08-16 15:09:09'),
(9, 'Exploring the Monty Hall Problem', 'Puzzles & Paradoxes', 'By Brilliant.org', '2025-06-20', 'assets/image/news/Exploring the Monty Hall Problem.png', 'https://brilliant.org/wiki/monty-hall-problem/', 'A deep dive into the famous probability puzzle that has stumped even professional mathematicians. Do you switch doors?', 'The Monty Hall problem is a brain teaser based on a game show scenario. You are given a choice of three doors; behind one is a car, and behind the other two are goats. You pick a door, and the host, who knows what\'s behind the doors, opens another door to reveal a goat. He then asks if you want to switch your choice to the other remaining door. Counter-intuitively, switching doors doubles your chances of winning the car from 1/3 to 2/3. This article breaks down the probability to show why.', '2025-08-16 15:09:09'),
(10, 'The Seven Bridges of Königsberg', 'Puzzles & Paradoxes', 'By MathPlanet', '2025-06-15', 'assets/image/news/The Seven Bridges of Königsberg.png', 'https://www.mathplanet.com/education/pre-algebra/graphing-and-functions/the-bridges-of-konigsberg', 'The historical problem that led to the development of graph theory. Can you find a path that crosses each bridge exactly once?', 'The city of Königsberg was set on a river and included two large islands connected to each other and the mainland by seven bridges. The puzzle was to find a walk through the city that would cross each of those bridges once and only once. In 1736, Leonhard Euler proved that the problem has no solution. His method of analyzing the problem by abstracting it into nodes (land masses) and edges (bridges) laid the foundations of graph theory, a major branch of modern mathematics.', '2025-08-16 15:09:09'),
(11, 'Zeno\'s Paradoxes of Motion', 'Puzzles & Paradoxes', 'By Philosophy Now', '2025-06-10', 'assets/image/news/Zeno\'s Paradoxes of Motion.png', 'https://philosophynow.org/issues/85/Zenos_Paradox_of_the_Racetrack', 'Can you ever truly reach your destination? Exploring the ancient Greek paradoxes that question the nature of infinity and motion.', 'Zeno\'s paradoxes are a set of philosophical problems thought to have been devised by the Greek philosopher Zeno of Elea. The most famous is the paradox of Achilles and the Tortoise, which argues that the fleet-footed Achilles can never overtake a slow-moving tortoise given a head start. To do so, he must first reach the tortoise\'s starting point, by which time the tortoise has moved ahead. This process repeats infinitely. The paradox challenged the concepts of space, time, and infinity, and was only satisfactorily resolved with the development of calculus.', '2025-08-16 15:09:09'),
(12, 'The Infinite Complexity of Fractals', 'Puzzles & Paradoxes', 'By 3Blue1Brown', '2025-06-05', 'assets/image/news/The Infinite Complexity of Fractals.png', 'https://www.3blue1brown.com/lessons/fractals', 'Discover the beauty of fractals like the Mandelbrot set, where infinite complexity arises from simple mathematical rules.', 'A fractal is a never-ending pattern that is self-similar across different scales. They are created by repeating a simple process over and over in an ongoing feedback loop. Driven by recursion, fractals are images of dynamic systems – the pictures of Chaos. From the intricate branches of a tree to the jagged coastline of a continent, fractals are found everywhere in nature. This article explores the mathematics behind these beautiful and infinitely complex structures.', '2025-08-16 15:09:09'),
(13, 'The Calculus Behind Machine Learning', 'Math in Action', 'By Towards Data Science', '2025-05-30', 'assets/image/news/The Calculus Behind Machine Learning.png', 'https://towardsdatascience.com/machine-learning/home', 'Understanding how fundamental concepts of calculus, like gradient descent, power modern artificial intelligence.', 'At the heart of many machine learning algorithms is the process of optimization. To train a model, we need to find the parameters that minimize a \'loss\' function. This is where calculus comes in. The algorithm of \'gradient descent\' uses the derivative of the loss function to find the direction in which to tweak the parameters to make the model more accurate. Essentially, machine learning is a practical application of finding the minimum of a complex, high-dimensional function.', '2025-08-16 15:09:09'),
(14, 'How Cryptography Secures Your Data', 'Math in Action', 'By Computerphile', '2025-05-25', 'assets/image/news/How Cryptography Secures Your Data.png', 'https://www.youtube.com/user/Computerphile', 'An overview of the number theory and prime factorization that makes modern encryption possible and keeps your information safe.', 'Modern public-key cryptography, the system that secures online banking and e-commerce, relies on a simple principle from number theory: it is easy to multiply two large prime numbers together, but it is extremely difficult to do the reverse (i.e., factor the product back into its primes). Your device can use a \'public key\' (the product) to encrypt data, but only the recipient with the \'private key\' (the original prime numbers) can decrypt it. This asymmetry is the bedrock of modern digital security.', '2025-08-16 15:09:09'),
(15, 'The Mathematics of Spacetime', 'Math in Action', 'By PBS Space Time', '2025-05-20', 'assets/image/news/The Mathematics of Spacetime.png', 'https://www.youtube.com/c/pbsspacetime', 'How Einstein\'s theory of general relativity uses differential geometry to describe the fabric of the universe.', 'Albert Einstein\'s theory of general relativity describes gravity not as a force, but as a curvature of spacetime caused by mass and energy. To describe this curvature, Einstein used the mathematical language of differential geometry and tensor calculus, which had been developed by mathematicians like Riemann and Ricci. The equations of general relativity are a set of complex differential equations that precisely describe how spacetime is warped by matter, and in turn, how matter moves through that warped spacetime.', '2025-08-16 15:09:09'),
(16, 'Financial Modeling with Stochastic Calculus', 'Math in Action', 'By Investopedia', '2025-05-15', 'assets/image/news/Financial Modeling with Stochastic Calculus.png', 'https://www.investopedia.com/terms/s/stochastic-calculus.asp', 'A look at the complex mathematics used in the financial world to model stock prices and manage risk.', 'Stock prices and other financial assets are notoriously difficult to predict due to their random, unpredictable nature. Stochastic calculus, a branch of mathematics that deals with random processes, provides the tools to model this uncertainty. The famous Black-Scholes model, for example, uses stochastic differential equations to price financial derivatives like options. This area of \'quantitative finance\' is a major field for applied mathematicians.', '2025-08-16 15:09:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

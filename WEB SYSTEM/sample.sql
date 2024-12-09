-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 02:54 PM
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
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_profile`
--

CREATE TABLE `customer_profile` (
  `cus_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `gender` char(1) NOT NULL,
  `ua_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_profile`
--

INSERT INTO `customer_profile` (`cus_id`, `name`, `gender`, `ua_id`) VALUES
(1, 'intjj', 'F', 1),
(2, 'chimy', 'M', 2),
(3, 'minimoniee', 'M', 3),
(4, 'thv', 'M', 4);

-- --------------------------------------------------------

--
-- Table structure for table `items_lists`
--

CREATE TABLE `items_lists` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(55) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `total_qty_sold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_lists`
--

INSERT INTO `items_lists` (`item_id`, `item_name`, `item_desc`, `item_price`, `total_qty_sold`) VALUES
(1, 'Caramel macchiato', 'A freshly steamed milk with vanilla flavoured syrup, marked with expresso and finished with caramel sauce.', 99.00, 0),
(2, 'Latte', 'A milk coffee that boast a silky layer of foam as real highlight to the drink.', 88.75, 0),
(3, 'Espresso', 'Strong black coffee that\'s created when hot water is forced through ground coffee beans.', 50.00, 0),
(4, 'Cappuccino', 'A perfect balance of espresso, steamed milk and foam.', 95.00, 0),
(5, 'Iced classic chocolate ', 'Milk and mocha sauce topped with whipped cream and a chocolate-flavoured drizzle. A timeless classic make to sweetened your spirit.', 105.00, 0),
(6, 'Iced caffe mocha', 'Espresso combined with bitter sweet mocha sauce and milk over ice, topped with sweetened whipped cream.', 105.75, 0),
(7, 'French  butter croissant', 'A beautiful golden color, moist, and buttery meltingly smooth, with a final note of caramel', 125.00, 0),
(8, 'Dark chocolate macadamia cookie', 'A decadent combination of belgian chocolate and chunk macadamia nuts in a buttery, chewy cookie', 129.00, 0),
(9, 'Bacon belgian waffle ', 'Yeast-raised dough with sugar pearls and loaded with bacon bits.', 99.00, 0),
(10, 'Classic lasagna ', 'This classic lasagna is the perfect italian comfort food made with ground patty bolognese layered with cheese and al-dente noddles.', 159.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `item_name`, `item_category`, `item_desc`, `item_price`, `item_image`) VALUES
(1, 'Espresso', 'Hot Beverages', 'Strong black coffee that\'s created when hot water is forced through ground coffee beans.', 99.50, 'EEspresso.jpg'),
(2, 'Latte', 'Hot Beverages', 'A milk coffee that boast a silky layer of foam as real highlight to the drink.', 93.00, 'LLatte.jpg'),
(3, 'French Butter Croissant', 'Pastries & Snacks', 'A beautiful golden color, moist, and buttery meltingly smooth, with a final note of caramel', 99.00, 'FrenchButtercroissant.jpg'),
(4, 'Iced Classic Chocolate', 'Cold Beverages', 'Milk and mocha sauce topped with whipped cream and a chocolate-flavoured drizzle. A timeless classic make to sweetened your spirit.', 98.00, 'icedclassicchocolate.jpg'),
(5, 'Caramel Macchiato', 'Specialty Drinks', 'A freshly steamed milk with vanilla flavoured syrup, marked with expresso and finished with caramel sauce.', 99.50, 'CaramelMacchiato.jpg'),
(6, 'Iced Caffe Mocha', 'Cold Beverages', 'Espresso combined with bitter sweet mocha sauce and milk over ice, topped with sweetened whipped cream.', 105.75, 'IcedCaffeMocha.jpg'),
(7, 'Dark Chocolate Macadamia Cookie', 'Pastries & Snacks', 'A decadent combination of belgian chocolate and chunk macadamia nuts in a buttery, chewy cookie', 129.00, 'DarkChocolateMacadamiaCookie.jpg'),
(8, 'Bacon Belgian Waffle', 'Pastries & Snacks', 'Yeast-raised dough with sugar pearls and loaded with bacon bits.', 99.00, 'BaconBelgianWaffle.jpg'),
(9, 'Classic Lasagna', 'Pastries & Snacks', 'This classic lasagna is the perfect italian comfort food made with ground patty bolognese layered with cheese and al-dente noddles.', 159.00, 'ClassicLasagna.jpg'),
(10, 'Cappuccino', 'Hot Beverages', 'A perfect balance of espresso, steamed milk and foam.', 95.00, 'cappuccino.jpg'),
(11, 'Chai Latte\r\n', 'Tea & Non-Coffee Drinks\r\n', 'Spiced black tea combined with steamed milk for a sweet and warming treat.\r\n', 200.00, 'ChaiLatte.jpg'),
(12, 'Matcha Latte', 'Tea & Non-Coffee Drinks', 'Vibrant green tea powder whisked into steamed milk for a creamy, earthy flavor.', 240.00, 'MatchaLatte.jpg'),
(13, 'Hot Chocolate', 'Tea & Non-Coffee Drinks', 'A comforting blend of rich cocoa and steamed milk, topped with whipped cream.', 180.00, 'hotchocolate.jpg'),
(14, 'Iced Tea (Lemon/Peach)', 'Tea & Non-Coffee Drinks', 'Refreshing iced tea served in lemon or peach flavors.', 150.00, 'PeachIcedTea.jpg'),
(15, 'Lemonade', 'Tea & Non-Coffee Drinks', 'Freshly squeezed lemonade, served ice-cold for a zesty, sweet refreshment.', 160.00, 'lemonade.jpg'),
(16, 'Fruit Smoothie (Mango, Strawberry, Banana)', 'Tea & Non-Coffee Drinks', 'Blended fresh fruit with yogurt or juice for a creamy, sweet smoothie.', 210.00, 'Banana FruitSmoothie.jpg'),
(17, 'Milkshake (Chocolate, Vanilla, Strawberry)', 'Tea & Non-Coffee Drinks', 'A creamy, sweet milkshake made with rich ice cream and milk.', 250.00, 'StrawberryMilkshake.jpg'),
(18, 'Matcha Lemonade', 'Tea & Non-Coffee Drinks', 'A refreshing blend of matcha green tea and lemonade for a tangy, energizing drink.', 230.00, 'matcha lemon.jpg'),
(19, 'Blueberry Muffin', 'Snacks & Pastries', 'Soft and moist muffin packed with juicy blueberries.', 150.00, 'BlueberryMuffin.jpg'),
(20, 'Chocolate Croissant', 'Snacks & Pastries', 'Flaky pastry with a rich chocolate filling.', 170.00, 'ChocolateCroissant.jpg'),
(21, 'Avocado Toast', 'Snacks & Pastries', 'Toasted artisan bread topped with fresh avocado, olive oil, and seasonings.', 280.00, 'avocadotoast.jpg'),
(22, 'Banana Bread Slice', 'Snacks & Pastries', 'Sweet, moist banana bread with a hint of cinnamon.', 160.00, 'BananaBread.jpg'),
(23, 'Cinnamon Roll', 'Snacks & Pastries', 'Soft and sticky roll filled with cinnamon, sugar, and a creamy glaze.', 180.00, 'CinnamonRoll.jpg'),
(24, 'Bagel with Cream Cheese', 'Snacks & Pastries', 'Toasted bagel served with a generous spread of cream cheese.', 170.00, 'Bagelwith CreamCheese.jpg'),
(25, 'Crispy Bacon and Egg Sandwich', 'Snacks & Pastries', 'A hearty breakfast sandwich with crispy bacon, a fried egg, and fresh bread.', 220.00, 'BaconBelgianWaffle.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` enum('Cash on Delivery','Credit Card','PayPal') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_status` char(1) NOT NULL,
  `user_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `username`, `password`, `fullname`, `address`, `contact_no`, `gender`, `date_added`, `user_status`, `user_type`) VALUES
(1, 'claries@gmial.com', 'guseguse', 'Claries Amistoso', 'bu polangui albay', '09123456788', 'F', '2024-11-19 09:16:31', 'A', 'A'),
(2, 'intjj', 'bubu19', 'Shanley Resentes', 'Bongoran, Oas, Albay', '09075193156', 'F', '2024-11-20 01:52:54', '', 'A'),
(3, '_mb', 'Mariz123', 'Mariz Bata', 'Obaliw-Rinas, Oas, Albay', '09123456789', 'F', '2024-11-20 01:54:13', '', 'A'),
(4, 'jc', 'jc1234', 'Jaennie Fetil', 'Alomon,Polangui, Albay', '09123456788', 'F', '2024-11-20 01:54:32', '', 'A'),
(5, 'Pen', '12345678', 'Penelope Sablayan', 'Napo, Polangui, Albay', '09213465789', 'F', '2024-11-20 01:54:53', '', 'A'),
(6, 'TC', 'tiny123', 'Tiny coders', 'bu polangui', '09876543211', 'X', '2024-11-20 06:29:51', '', 'C'),
(7, 'xsjuydg', '12gsdjs', 'marss', 'syudgshfbskj', '09987654321', 'M', '2024-11-20 06:48:33', '', 'C'),
(8, 'mars', 'mars', 'marss', 'syudgshfbskj', '09987654321', 'M', '2024-11-20 06:47:45', '', 'C'),
(9, 'mmm', '12345', 'Mb', 'tabi', '09124356987', 'F', '2024-11-20 07:32:07', '', 'C'),
(11, 'Pogito', '********', 'Pogi', 'polanguialbay', '09989989792', 'X', '2024-11-20 08:01:55', '', 'C'),
(12, 'msb', '00000', 'msbata', 'P1-Obaliw,Oas, Albay', '09994719859', 'F', '2024-11-24 06:15:53', '', 'C'),
(13, 'ana', 'ana123', 'Ana Nacion', 'Santicon, Polangui, Albay', '09987654321', 'F', '2024-11-24 08:22:49', '', 'C'),
(14, 'Eun Woo', 'eu123', 'Cha Eun Woo', 'South Korea', '09123654879', 'M', '2024-11-24 08:27:19', '', 'C'),
(15, 'hahahaha', 'hahahaha', 'hahahaha', 'South Korea', '09989989792', 'M', '2024-11-27 05:59:17', '', 'C'),
(16, 'hellopo', 'hel123', 'hello', 'bu polangui albay', '09876543211', 'X', '2024-11-28 05:59:38', '', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_profile`
--
ALTER TABLE `customer_profile`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `items_lists`
--
ALTER TABLE `items_lists`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_profile`
--
ALTER TABLE `customer_profile`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items_lists`
--
ALTER TABLE `items_lists`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

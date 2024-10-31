--
-- Plan Table add new colom 
--

ALTER TABLE `plans` ADD `plan_type` VARCHAR(100) NOT NULL AFTER `interval_count`;

--
-- Table structure for table `template_importer`
--

CREATE TABLE `template_importer` (
  `id` int(11) NOT NULL,
  `importe_name` varchar(255) NOT NULL,
  `imported_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `template_importer`
--
ALTER TABLE `template_importer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `template_importer`
--
ALTER TABLE `template_importer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

--
-- User Table access colom comment text change 
--

ALTER TABLE `users` CHANGE `access_level` `access_level` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'Plan ID';

--
-- payment_method change type 
--
ALTER TABLE `user_subscriptions` CHANGE `payment_method` `payment_method` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

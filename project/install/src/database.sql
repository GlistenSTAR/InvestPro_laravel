-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2020 at 04:34 PM
-- Server version: 5.7.31-0ubuntu0.16.04.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankzone_investpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `is_super`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$hPuE/RFAK0q6DsFqcB9z3uuzs9X3nYHVJmO1bdagEYDiuu4/YMxzy', 1, NULL, '2020-05-08 00:21:15', '2020-06-03 15:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `gateway_id` bigint(20) NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `try` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_requests`
--

CREATE TABLE `deposit_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `gateway_id` bigint(20) DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usd_amo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accepted` int(11) NOT NULL DEFAULT '0',
  `r_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generals`
--

CREATE TABLE `generals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `web_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Banking E-Wallet',
  `currency` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'USD',
  `color_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '#fff',
  `contact_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Berlin,Germany',
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'support@example.com',
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0123654789',
  `copyright_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'All Rights Reserved',
  `banner_header` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_footer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_head` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_body` longtext COLLATE utf8mb4_unicode_ci,
  `about_video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `single_about1_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `single_about1_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `single_about1_description` longtext COLLATE utf8mb4_unicode_ci,
  `single_about2_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `single_about2_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `single_about2_description` longtext COLLATE utf8mb4_unicode_ci,
  `invest_head` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invest_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invest_description` text COLLATE utf8mb4_unicode_ci,
  `investor_head` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investor_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `investor_description` text COLLATE utf8mb4_unicode_ci,
  `footer_text` text COLLATE utf8mb4_unicode_ci,
  `email_template` text COLLATE utf8mb4_unicode_ci,
  `sms_api` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `esender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_script` text COLLATE utf8mb4_unicode_ci,
  `bal_trans_fixed_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `bal_trans_percentage_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `email_verification` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generals`
--

INSERT INTO `generals` (`id`, `web_name`, `currency`, `color_code`, `contact_address`, `contact_email`, `contact_phone`, `copyright_text`, `banner_header`, `banner_body`, `banner_footer`, `about_head`, `about_title`, `about_body`, `about_video_url`, `single_about1_icon`, `single_about1_title`, `single_about1_description`, `single_about2_icon`, `single_about2_title`, `single_about2_description`, `invest_head`, `invest_title`, `invest_description`, `investor_head`, `investor_title`, `investor_description`, `footer_text`, `email_template`, `sms_api`, `created_at`, `updated_at`, `esender`, `comment_script`, `bal_trans_fixed_charge`, `bal_trans_percentage_charge`, `email_verification`) VALUES
(1, 'InvestPro', 'USD', '0C87EF', 'Berlin,Germany', 'support@example.com', '0123654789', 'All Rights Reserved', 'We have 24/7 supported team', 'Best Invest Company Since 2011', 'look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.  Inter your email address', 'Who We Are?', 'About details', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', 'https://www.youtube.com/watch?v=_51KXfwcPMs', NULL, 'Licensed & Certified', 'The Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.', NULL, 'Saving & Investments', 'Financial institutions offer a number of different savings options. Investing is buying assets such as stocks, bonds, mutual funds or real estate with the expectation.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.\r\n\r\nThe Certified Licensing Professional certification is for individuals working in the fields of licensing, business development and commercialization of intellectual.', 'Investon Price', 'Grab Our Mega Package', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many', 'Top Investors', 'Fast Smart think', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web', NULL, 'Hi {{name}}, {{message}} , Thank you', NULL, NULL, '2020-10-14 09:54:20', 'do-no-reply@example.com', '<div id="fb-root"></div>\r\n                                    <script>(function(d, s, id) {\r\n                                            var js, fjs = d.getElementsByTagName(s)[0];\r\n                                            if (d.getElementById(id)) return;\r\n                                            js = d.createElement(s); js.id = id;\r\n                                            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1421567158073949";\r\n                                            fjs.parentNode.insertBefore(js, fjs);\r\n                                        }(document, \'script\', \'facebook-jssdk\'));\r\n                                    </script>\r\n                                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%" data-numposts="5"></div>', '2', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `image`, `name`, `designation`, `fb_link`, `twitter_link`, `linkedin_link`, `created_at`, `updated_at`) VALUES
(2, '5ec1654a23285186.png', 'Bradon Crithia', 'Founder', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', '2020-05-17 10:24:42', '2020-06-09 14:09:27'),
(4, '5ec16567a178c381.png', 'Katrin Alex', 'Top Investor', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', '2020-05-17 10:25:11', '2020-06-09 15:47:33'),
(5, '5ec16573d1cc5850.png', 'Prema Boura', 'Affilator', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', '2020-05-17 10:25:23', '2020-06-09 15:48:20'),
(6, '5edf7789aa78e958.png', 'Suvro Sen', 'CEO', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', '2020-06-09 15:50:33', '2020-06-09 15:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `invest_logs`
--

CREATE TABLE `invest_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `get_percent` char(4) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '% get every ROI',
  `get_action` int(11) DEFAULT NULL COMMENT 'plan wise action number',
  `get_period` int(11) NOT NULL COMMENT 'plan wise period:1=Hourly,24=Daily,168=Weekly,720=Monthly,2880=Quarterly,8640=Yearly',
  `took_action` int(11) NOT NULL DEFAULT '0' COMMENT 'already taken action',
  `invest_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = Running, 1 = complete',
  `next_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, 'About', 'Bankzone Investment Fund :\r\nBankzone is the best choice. An investment fund is a supply of capital belonging to numerous investors used to collectively purchase securities while each investor retains ownership and control of his own shares. An investment fund provides a broader selection of investment opportunities, greater management expertise, and lower investment fees than investors might be able to obtain on their own. Types of investment funds include mutual funds, exchange-traded funds, money market funds, and hedge funds.\r\n\r\n\r\nBREAKING DOWN Investment Fund:\r\nWith investment funds, individual investors do not make decisions about how a fund\'s assets should be invested. They simply choose a fund based on its goals, risk, fees and other factors. A fund manager oversees the fund and decides which securities it should hold, in what quantities and when the securities should be bought and sold. An investment fund can be broad-based, such as an index fund that tracks the S&P 500, or it can be tightly focused, such as an ETF that invests only in small technology stocks.\r\n\r\n\r\nWhile investment funds in various forms have been around for many years, the Massachusetts Investors Trust Fund is generally considered the first open-end mutual fund in the industry. The fund, investing in a mix of large-cap stocks, launched in 1924.\r\n\r\nOpen-end vs. Closed-end\r\nThe majority of investment fund assets belong to open-end mutual funds. These funds issue new shares as investors add money to the pool, and retire shares as investors redeem. These funds are typically priced just once at the end of the trading day.\r\n\r\nClosed-end funds trade more similarly to stocks than open-end funds. Closed-end funds are managed investment funds that issue a fixed number of shares, and trade on an exchange. While a net asset value (NAV) for the fund is calculated, the fund trades based on investor supply and demand. Therefore, a closed-end fund may trade at a premium or a discount to its NAV.\r\n\r\nEmergence of ETFs\r\nExchange-traded funds (ETFs) emerged as an alternative to mutual funds for traders who wanted more flexibility with their investment funds. Similar to closed-end funds, ETFs trade on exchanges, and are priced and available for trading throughout the business day. Many mutual funds, such as the Vanguard 500 Index Fund, have ETF counterparts. The Vanguard S&P 500 ETF is essentially the same fund, but came to be bought and sold intraday. ETFs frequently have the additional advantage of slightly lower expense ratios than their mutual fund equal.\r\n\r\nThe first ETF, the SPDR S&P 500 ETF, debuted in the United States in 1993. By the end of 2018, ETFs had roughly $3.4 trillion in assets under management.\r\n\r\nInvestment Funds: Hedge Funds\r\nA hedge fund is an investment type that is distinct from mutual funds or ETFs. This fund is an actively managed fund made available to accredited investors. A hedge fund faces less federal regulation and is therefore able to invest in a variety of asset classes using a wide range of strategies. For example, a hedge find might pairs stocks it wants to short (bet will decrease) with stocks it expects to go up in order to decrease the potential for loss.\r\n\r\nHedge funds also tend to invest in riskier assets in addition to stocks, bonds, ETFs, commodities and alternative assets. These include derivatives such as futures and options that may also be purchased with leverage, or borrowed money. \r\n\r\nCompete Risk Free with $100,000 in Virtual Cash\r\nPut your trading skills to the test with our FREE Stock Simulator. Compete with thousands of Investopedia traders and trade your way to the top! Submit trades in a virtual environment before you start risking your own money. Practice trading strategies so that when you\'re ready to enter the real market, you\'ve had the practice you need. Try our Stock Simulator today >>\r\n\r\nRelated Terms\r\nDefinition of an Equity Unit Investment Trust (EUIT)\r\nAn equity unit investment trust is a publicly offered, pooled trust fund managed by an investment company. \r\n\r\nShould You Be Open to a Closed-End Fund?\r\nA closed-end fund is created when an investment company raises money through an IPO and then trades the fund shares on the public market like a stock. After its IPO, no additional shares are issued by the fund\'s parent investment company.\r\n\r\nFamily of Funds Definition\r\nA family of funds includes all of the funds managed by one investment company. \r\n\r\nExchange Traded Fund – ETFs\r\nAn exchange traded fund (ETF) is a basket of securities that tracks an underlying index. ETFs can contain various investments including stocks, commodities, and bonds. \r\n\r\nNew Fund Offer (NFO) Definition\r\nA new fund offer is the first subscription offering for any new fund offered by an investment company. \r\n\r\nOpen-End Fund\r\nAn open-end fund is a mutual fund that can issue unlimited new shares, priced daily on their net asset value. The fund sponsor sells shares directly to investors and buys them back as well.', '2020-05-18 02:37:00', '2020-06-10 21:21:48'),
(3, 'Service', 'Financial institutions and professional financial advisers offer a host of investment services that are focused on helping their clients meet predetermined financial goals. These investment services may be customized to a client’s income levels, circumstances and objectives and focus on wealth creation and protection. Investment services include making, organizing and managing investments and may also encompass financial planning, accounting, life insurance and tax planning.\r\n\r\n \r\nTypes of Investment Services\r\nPrior to the late 1990s, US commercial banks were forbidden by law to offer investment services. The Gramm-Leach-Bliley Act of 1999 made it legal for a bank to offer both commercial and investment services. Over the years, the distinction between commercial and investment banks has blurred. The types of investment services offered by banks include:\r\n\r\nMoney management: The first step for any investor is to ascertain the amount of money he has at his disposal for investing and the various financial options available to maximize returns and tax rebates and minimize risks.\r\n \r\n\r\nPortfolio management services: These services are aimed at investors achieving the right mix of investments, such as stocks, bonds, commodities, derivatives and CDs, depending upon their financial goals and risk appetite. Portfolio management encompasses making a choice between equity and debt, domestic and international investments as well as growth and safety.\r\n \r\n\r\nRetirement planning services: Once the retirement goals have been laid down, appropriate investments need to be made into pension plans, 401(k) plans and profit sharing plans. One may also need to invest into the financial and money markets to ensure a steady stream of income post retirement.\r\n \r\n\r\nCollective investment portfolio management: Banks offer advice on collective investments, such as mutual funds, ETFs and managed funds. One may also need professional advice for investing in hedge funds. Such funds hedge their risks via methods like short selling.\r\n \r\n\r\nBrokerage services: Investors need brokers to trade in bonds, stocks, foreign currency and derivatives. The brokerage services offered by banks are considered more reliable and are preferred to those offered by individual brokers.\r\n \r\n\r\nApart from financial goals, investors may have other priorities that financial institutions providing investment services can take into account. Such priorities may include socially responsible investing, green investing and sustainable investing.', '2020-05-18 02:37:06', '2020-06-10 21:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_08_051020_create_admins_table', 1),
(9, '2020_05_08_062218_create_generals_table', 2),
(10, '2020_05_15_181205_create_work_areas_table', 3),
(11, '2020_05_17_152754_create_services_table', 4),
(12, '2020_05_17_155345_create_investors_table', 5),
(13, '2020_05_18_062629_create_partners_table', 6),
(14, '2020_05_18_065907_create_news_table', 7),
(15, '2020_05_18_075332_create_socials_table', 8),
(16, '2020_05_18_082957_create_menus_table', 9),
(19, '2020_05_27_165523_create_plans_table', 10),
(20, '2020_05_29_194526_create_invest_logs_table', 10),
(21, '2020_05_29_201328_create_transactions_table', 11),
(25, '2020_05_30_180013_create_deposits_table', 12),
(26, '2020_05_30_181943_create_gateways_table', 12),
(27, '2020_05_30_190242_create_trxes_table', 12),
(28, '2020_06_01_152124_create_deposit_requests_table', 13),
(29, '2020_06_01_195520_add_column_to_generals', 14),
(30, '2020_06_02_115734_create_withdraw_methods_table', 15),
(31, '2020_06_02_120651_create_withdraw_logs_table', 16),
(32, '2020_06_02_193551_add_column_to_users', 17),
(33, '2020_08_21_125824_create_payment_gatways_table', 18),
(37, '2020_09_23_120617_add_column_ref_id_to_users', 19);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `image`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, '5ee112c2f2405970.png', 'Grab Our Mega Package For You', 'Create an account and get 50$ free on MEGA\'s end-to-end encrypted cloud collaboration .Subject to your participation in our achievements program.\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. \r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2020-05-18 01:25:15', '2020-10-11 00:54:15'),
(3, '5ee112e030e50494.png', 'How To Earn Money From Investment', 'Bank fixed deposits (FD) A bank fixed deposit (FD) is a popular choice for investing owing to its assured return and the safety involved.. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2020-05-18 01:25:30', '2020-06-10 21:05:36'),
(4, '5ee112f96559e260.png', 'How To Reinvestment Earn Money', 'Reinvesting in your company is using a percentage of your company\'s profits to invest in your company all over again. Instead of using the capital money, you use profits. This is a wise business move because it will keep your company running. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2020-05-18 01:25:45', '2020-06-10 21:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, '5ee1102971ba7577.png', '2020-05-18 00:43:49', '2020-06-10 20:54:01'),
(2, '5ee11038520df180.png', '2020-05-18 00:43:57', '2020-06-10 20:54:16'),
(4, '5ee11046a6513432.png', '2020-05-18 00:51:52', '2020-06-10 20:54:30'),
(5, '5ee111bab3ed8461.png', '2020-06-09 16:06:27', '2020-06-10 21:00:42'),
(6, '5ee111c82b485950.png', '2020-06-10 21:00:56', '2020-06-10 21:00:56');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `status`, `token`, `created_at`) VALUES
('Olatundeolumide123@gmail.com', 0, 'Gip7XMGxZ452fWZRSdwJiV90wS3jed', '2020-07-05 20:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gatways`
--

CREATE TABLE `payment_gatways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimum_deposit_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `maximum_deposit_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '100',
  `fixed_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `percentage_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `gateway_key_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_key_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_key_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_key_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gatways`
--

INSERT INTO `payment_gatways` (`id`, `image`, `name`, `minimum_deposit_amount`, `maximum_deposit_amount`, `fixed_charge`, `percentage_charge`, `rate`, `gateway_key_one`, `gateway_key_two`, `gateway_key_three`, `gateway_key_four`, `status`, `created_at`, `updated_at`) VALUES
(1, '1600414774.jpg', 'Paypal', '10', '1000', '1', '1', '1', 'sb-eiuis3003399_api1.business.example.com', '9ADSGMTGZU2M3345', 'ARHPijWmCCSUguBRmsQZVk1xNcMRA5duAKOpWAtXHPWg7G-dogEDAUxf', 'APP-80W284485P519543T', 1, NULL, '2020-09-18 01:39:34'),
(2, '1600416608.jpg', 'Coinpayment', '1', '100', '0', '0', '1', 'db1d9f12444e65c921604e289a281c56', 'db1d9f12444e65c921604e289a281c56', NULL, NULL, 1, NULL, '2020-09-18 02:45:04'),
(3, '1600415960.jpg', 'Stripe', '1', '100', '0', '0', '1', 'sk_test_aat3tzBCCXXBkS4sxY3M8A1B', 'pk_test_AU3G7doZ1sbdpJLj0NaozPBu', NULL, NULL, 1, NULL, '2020-09-18 01:59:20'),
(4, '1598017936.jpg', 'Citi Bank', '10', '100', '1.1', '1.2', '1', NULL, NULL, NULL, 'Account Num : 4242 4242 4242 4242', 1, '2020-08-21 07:52:16', '2020-08-21 07:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` char(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` tinyint(4) DEFAULT NULL,
  `period` int(11) NOT NULL COMMENT '1=Hourly,24=Daily,168=Weekly,720=Monthly,2880=Quarterly,8640=Yearly',
  `return_time_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = ROI, 0 = Fixed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `min_amount`, `max_amount`, `fixed_amount`, `percent`, `action`, `period`, `return_time_status`, `created_at`, `updated_at`) VALUES
(1, 'Roi Standard', '100', '5000', NULL, '2.5', 10, 24, 1, '2020-05-29 14:11:52', '2020-06-05 21:49:19'),
(2, 'Fixed Standard', NULL, NULL, '1000', '7.5', NULL, 720, 0, '2020-05-29 14:12:17', '2020-06-05 22:15:04'),
(3, 'ROI Advanced', '500', '50000', NULL, '7.5', 20, 168, 1, '2020-06-05 00:08:46', '2020-06-05 21:51:09'),
(4, 'ROI Premium', '600', '80000', NULL, '15', 99, 720, 1, '2020-06-05 21:54:36', '2020-06-05 21:54:36'),
(5, 'Fixed Advanced', NULL, NULL, '5000', '15', NULL, 2880, 0, '2020-06-05 22:22:02', '2020-06-05 22:22:02'),
(6, 'Fixed Premium', NULL, NULL, '7000', '35', NULL, 8640, 0, '2020-06-05 22:23:41', '2020-06-05 22:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `percentage`, `created_at`, `updated_at`) VALUES
(1, '10', '2020-10-14 15:09:54', '2020-10-14 15:09:54'),
(2, '5', '2020-10-14 15:09:54', '2020-10-14 15:09:54'),
(3, '3', '2020-10-14 15:09:54', '2020-10-14 15:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, '5ec15aeba12e0938.png', 'Stable & Profitable', 'Experienced business owners and managers know that 3 things are necessary to ensure the long- term success of any business: growth, profit and stability', '2020-05-17 09:40:27', '2020-06-09 15:19:18'),
(2, '5ec15af1d7c70717.png', 'Instant Withdraw', 'Withdrawal Speed: Up to 4 hours .General rules for depositing and withdrawing funds . If a deposit or withdrawal is not subject to instant execution', '2020-05-17 09:40:33', '2020-06-09 15:22:05'),
(3, '5ec15b40a5fb9648.png', 'Referral Provides', 'A referral program is an organized process in which customers are rewarded for spreading the word.', '2020-05-17 09:40:38', '2020-06-09 15:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socials`
--

INSERT INTO `socials` (`id`, `icon`, `link`, `created_at`, `updated_at`) VALUES
(2, 'facebook', 'https://www.facebook.com/pranto101201', '2020-05-18 02:18:00', '2020-05-18 02:18:00'),
(3, 'instagram', 'https://www.instagram.com/pranto101201', '2020-05-18 02:18:25', '2020-05-18 02:18:25'),
(4, 'twitter', 'https://twitter.com/pranto101201', '2020-05-18 02:18:43', '2020-05-18 02:18:43'),
(5, 'linkedin', 'https://linkedin.com/in/pranto101201', '2020-05-18 02:19:14', '2020-05-18 02:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `trans_id` bigint(20) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_bal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_bal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 = Purchase Plan, 1 = Deposit, 2 = Bal Trans, 3 = Withdraw, 4 = ROI',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `gender` tinyint(1) DEFAULT NULL COMMENT '1 = Men & 0 = Female',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `referral_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_logs`
--

CREATE TABLE `withdraw_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0 = pending, 1 = approved, 2 = Reject',
  `method_cur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_amo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargefx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chargepc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `name`, `image`, `min_amo`, `max_amo`, `chargefx`, `chargepc`, `rate`, `processing_day`, `status`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'City Bank', '1591971498.jpg', '10', '5000', '5', '5', '84', '5-7', 1, 'BDT', '2020-06-02 06:45:04', '2020-06-12 08:18:18'),
(2, 'Sonali Bank', '1591971390.jpg', '50', '500', '2', '2.5', '84', '5-7', 1, 'BDT', '2020-06-02 06:49:40', '2020-06-12 08:16:30'),
(3, 'Cobra Bank', '1591971249.jpg', '10', '1000', '2', '1', '1', '5-7 Days', 1, 'USD', '2020-06-12 08:14:09', '2020-06-12 08:15:58'),
(4, 'ICIC Bank', '1591971325.jpg', '50', '5000', '2', '1', '1', '5-7 Days', 1, 'USD', '2020-06-12 08:15:25', '2020-06-12 08:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `work_areas`
--

CREATE TABLE `work_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_areas`
--

INSERT INTO `work_areas` (`id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, '5edf6e8574dc7852.png', 'OPEN AN ACCOUNT', 'You can open bank accounts entirely online, with no need for signatures or branch ... you can complete most banking tasks online—even opening your account', '2020-05-15 14:00:18', '2020-06-09 15:12:05'),
(3, '5edf6ed6035bb901.png', 'GIVE INTEREST', 'Review and compare interest rates to find the best bank for a savings account, ... While it\'s true that some checking accounts pay interest, the vast majority don\'t.', '2020-05-15 14:00:30', '2020-06-09 15:13:26'),
(4, '5edf6d01b90ef567.png', 'GET DEPOSIT', 'Using GET from a Web Browser to make an Online Credit Card Deposit. Using the UMass GET web site, you can make VISA, MC, or Discover card deposits', '2020-05-15 14:28:53', '2020-06-09 15:09:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_requests`
--
ALTER TABLE `deposit_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generals`
--
ALTER TABLE `generals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invest_logs`
--
ALTER TABLE `invest_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gatways`
--
ALTER TABLE `payment_gatways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_areas`
--
ALTER TABLE `work_areas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `deposit_requests`
--
ALTER TABLE `deposit_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `generals`
--
ALTER TABLE `generals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `invest_logs`
--
ALTER TABLE `invest_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payment_gatways`
--
ALTER TABLE `payment_gatways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_areas`
--
ALTER TABLE `work_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

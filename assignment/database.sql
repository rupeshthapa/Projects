-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `assignment`;
CREATE DATABASE `assignment` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `assignment`;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(2,	'admin',	'admin@gmail.com',	'admin');

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(240) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(240) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `textarea` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `article` (`id`, `title`, `category`, `textarea`) VALUES
(1,	'Man is imprisoned in a point of interest caste-based discrimination ruling.',	'Local News',	'In a noteworthy choice, the Locale Court Ramechhap on Friday sentenced a man to a year in imprison on the charge of caste-based segregation. He got another three and a half a long time behind bars for holding the casualty hostage. Along with the imprison term, locale court judge Indira Sharma moreover slapped a fine of Rs75,000 on Sher Bahadur Nagarkoti, who was indicted of separating against a minor based on her caste and holding her hostage. Lawyers and social activists the Post talked to said such a choice from a district-level court was critical as caste-based discriminations are wild in society but seldom reach court. “Such choices from lower-level courts will dishearten individuals from separating others, particularly in towns, on the grounds of caste, and clear the way for rebuffing comparable offenders,” said advocate Prakash Nepali, who may be a lawful officer of Samata Establishment, a non-profit that battles for the rights of Dalits and underestimated groups.'),
(2,	'SAFF shows prospects of women’s football',	'Sports',	'The primary ever women’s universal competition at the domestic of Nepali football was able to attract housefull onlookers within the Nepal vs Bangladesh clash. So near however so distant for the slippery SAFF Women’s Championship trophy, the domestic group bowed out with a terrible 3-1 overcome to Bangladesh at the title clash on Monday. The competition held for the primary time in Kathmandu not as it were broke the ironfisted dominance of India, the victors of all past five versions of the biennial competition, but also gave a few clear message almost the prospect of women’s football within the country.'),
(3,	'Gold, silver costs rise marginally',	'Business',	'KATHMANDU, SEPTEMBER 24 The cost of valuable metals expanded somewhat within the exchanging week between September 18 and 23.In the residential showcase, gold cost rose by Rs 1,000 per tola, whereas silver cost too went up by Rs 15 a tola amid the survey week. Concurring to the rate list of League of Nepal Gold and Silver Merchants Affiliation (FeNe- GoSiDA), gold cost was settled at Rs 91,800 per tola on Sunday. Its cost fell by Rs 400 a tola to be exchanged at Rs 91,400 per tola on Monday. On Tuesday, gold cost bounced back to Rs 91,800 a tola once more some time recently dropping to Rs 91,300 per tola on Wednesday. On Thursday, the cost of valuable yellow metal expanded by Rs 500 a tola to Rs 91,800 per tola. The cost of gold encourage expanded to Rs 92,800 a tola on Friday.Similarly, silver was exchanged at Rs 1,185 per tola on Sunday and diminished by Rs 10 a tola on Monday. Its cost expanded by five rupees per tola to Rs 1,180 a tola on Tuesday, as per the FeNeGoSiDA. The cost of the dark metal diminished '),
(4,	'Unused space telescope appears Jupiter\'s auroras, modest moons',	'Technology',	'CAPE CANAVERAL, Florida, Eminent 23The world\'s most current and greatest space telescope is appearing Jupiter as never some time recently, auroras and all. Scientists discharged the shots Monday of the sun based system\'s greatest planet. The James Webb Space Telescope took the photographs in July, capturing phenomenal sees of Jupiter\'s northern and southern lights, and twirling polar cloudiness. Jupiter\'s Incredible Ruddy Spot, a storm huge sufficient to swallow Soil, stands out brightly nearby incalculable littler storms. One wide-field picture is especially emotional, appearing the black out rings around the planet, as well as two minor moons against a sparkling foundation of galaxies. \"We\'ve never seen Jupiter like this. It\'s all very mind blowing,\" said planetary space expert Imke de Pater, of the College of California, Berkeley, who made a difference lead the observations. \"We hadn\'t truly anticipated it to be this great, to be genuine,\" she included in a articulation.'),
(5,	'Himalayan Goats to be brought to Kathmandu from Darchula for Dashain',	'Business',	'Himalayan goats, too known as chyangra, will be brought to Kathmandu from Darchula area in see of the up and coming Dashain celebration. It is the primary time the Himalayan goats are being brought here from Darchula.Food Administration and Exchanging Company is bringing chyangra from Darchula due to over the top taken a toll of transportation from Bronco area. The company\'s Official Executive\r\n Mohan Prakash Chand said it was the primary time that chyangra meat from Darchula, the western-most locale of the nation, would be a portion of Dashain food. The company is obtaining chyangra (lively) at Rs 1,150 per kg. This effort will offer assistance balance out the cost of chyangra within the advertise.'),
(6,	'Alumutairi stops as Nepal football coach',	'Sports',	'The Kuwaiti, who had a contract with national group until December 2023, has charged ANFA of damaging the contract. Nepal national football group coach Abdullah Almutairi, maybe more famous for his discussions than accomplishments, surrendered from his position on Sunday. The Kuwaiti national, right now at his domestic nation on a three-month take off since June, declared through a Facebook post that he was clearing out the hot situate about after one-and-a-half-year. “After 525 days within the benefit of Nepalese football, I declare the conclusion of my residency as coach of the Nepal national team,” Almutairi composed. “Thank you to everybody who bolstered me on this travel that was not without minutes of delight, adore, pity and torment. One Group, Jay Nepal [sic].”'),
(7,	'Three harmed in stockroom fire in Dhobighat',	'Local News',	'Agreeing to the Metropolitan Police Division Sanepa, the harmed were taken to Star Clinic for beginning treatment. Arrangements are on to require them to Kirtipur Clinic for encourage treatment, said police. The distribution center was run by Bachhu Sah, an Indian citizen, said ASI Prakash Rayamajhi of the Metropolitan Police Division Sanepa. Most of the merchandise within the distribution center were devastated within the inferno. The fire has been taken beneath control, said police. '),
(8,	'VMware points to make strides security perceivability with modern administrations',	'Technology',	'Disclosed at VMware Investigate, the company\'s unused security administrations incorporate Venture Trinidad, Extend Observe and Extend Northstar. All three offer client perceivability enhancements. VMware on Tuesday presented unused security upgrades to move forward client perceivability and restrain sidelong movement. The declarations were made as portion of VMware Investigate 2022, VMware\'s lead conference in San Francisco. A few VMware security offerings, such as Extend Trinidad, Venture Observe and Venture Northstar, are expecting to donate expanded perceivability to customers. Project Trinidad may be a modern observing benefit that conveys sensors on Kubernetes clusters to distinguish anomalous behavior in microservice-based east-west activity. The benefit is right now in innovation see and recognizes suspicious action through \"machine learning with trade rationale induction,\" agreeing to the company\'s press see.'),
(9,	'ACCESS Health Southeast Asia Presents at the Sustainable Development Goals Innovation Roadshow',	'Health',	'Get to Wellbeing Southeast Asia, Senior Procedure Specialist Simeen Mirza talked at the Economical Advancement Objectives Advancement Roadshow 2022 on May 25 nearby accomplices at Amazon Web Administrations (AWS) and The Startup Buddy. Simeen highlighted key concepts within the whitepaper she co-authored “Overcoming Obstructions to Cloud Adoption in Open Healthcare within the Asia Pacific,” clarifying how the cloud can have a positive affect on coming to the Maintainable Advancement Objectives when utilized in a healthcare setting.'),
(10,	'China dispatches 2022 Wellbeing Prospects Grant and Partnership Program by Get to Wellbeing',	'Health',	'On May 13, 2022, Inquire Wellbeing propelled its Wellbeing Prospects Grant and Partnership Program with a virtual opening class. The course was gone to by the 2022 colleagues, past colleagues and the whole Inquire Wellbeing group. Colleagues will have the opportunity to take part in Inquire Health’s continuous investigate and counseling ventures and organize with industry pioneers and scholastic specialists all through the program. The Inquire Wellbeing group looks forward to working with these enthusiastic and gifted future healthcare pioneers.');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `category` (`category_id`, `name`) VALUES
(1,	'Local'),
(2,	'Sports'),
(3,	'Technology'),
(4,	'Business'),
(6,	'Health'),
(7,	'Health');

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `comment` (`id`, `comment`) VALUES
(1,	'hello'),
(2,	'hello'),
(3,	'hello'),
(4,	'hello'),
(5,	'hello');

DROP TABLE IF EXISTS `database`;
CREATE TABLE `database` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`id`, `name`, `email`, `password`) VALUES
(1,	'rupesh',	'rupesh@gmail.com',	'rupesh'),
(2,	'Rupesh Thapa',	'rupesh@gmail.com',	'rupesh'),
(3,	'rupesh',	'rupeshthapa@gmail.com',	'rupesh'),
(4,	'hello hello',	'hello@gmail.com',	'hello');

-- 2022-09-25 18:05:37
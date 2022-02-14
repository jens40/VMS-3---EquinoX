-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Feb 2022 um 10:44
-- Server-Version: 10.4.21-MariaDB
-- PHP-Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `vms3`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_bilanzen`
--

CREATE TABLE `equinox_1_bilanzen` (
  `id` int(15) NOT NULL,
  `tag` char(2) NOT NULL DEFAULT '0',
  `monat` char(2) NOT NULL DEFAULT '0',
  `jahr` varchar(4) NOT NULL DEFAULT '0',
  `wtag` tinyint(1) NOT NULL DEFAULT 0,
  `einnahmen` double(15,2) NOT NULL DEFAULT 0.00,
  `ausgaben` double(15,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_1_bilanzen`
--

INSERT INTO `equinox_1_bilanzen` (`id`, `tag`, `monat`, `jahr`, `wtag`, `einnahmen`, `ausgaben`) VALUES
(3, '28', '05', '2007', 1, 2887.37, 636.79),
(2, '27', '05', '2007', 0, 6.24, 124.75),
(4, '29', '05', '2007', 2, 346.47, 279.06),
(5, '30', '05', '2007', 3, 236.67, 192.85),
(6, '31', '05', '2007', 4, 341.87, 270.03),
(7, '01', '06', '2007', 5, 214.89, 172.74),
(8, '02', '06', '2007', 6, 618.74, 565.88),
(9, '03', '06', '2007', 0, 770.42, 643.98),
(10, '04', '06', '2007', 1, 355.94, 288.30),
(11, '05', '06', '2007', 2, 903694.48, 668979.94),
(12, '06', '06', '2007', 3, 1206532.00, 878114.78),
(13, '07', '06', '2007', 4, 1124317.00, 814145.26),
(14, '08', '06', '2007', 5, 1173281.00, 5788397.70),
(15, '09', '06', '2007', 6, 1387634.50, 533007.23),
(16, '10', '06', '2007', 0, 1248449.00, 786580.42),
(17, '03', '09', '2018', 1, 0.00, 0.00),
(18, '25', '09', '2018', 2, 0.00, 0.00),
(19, '08', '10', '2018', 1, 0.00, 0.20);


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_config`
--

CREATE TABLE `equinox_1_config` (
  `config_id` char(2) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `lizenzkey` varchar(50) DEFAULT NULL,
  `seitenname` varchar(50) DEFAULT NULL,
  `seitenurl` varchar(250) DEFAULT NULL,
  `betreibermail` varchar(250) DEFAULT NULL,
  `cronpasswort` varchar(50) DEFAULT NULL,
  `waehrungsname` varchar(50) DEFAULT NULL,
  `refebenen` varchar(255) DEFAULT NULL,
  `bank` tinyint(4) NOT NULL DEFAULT 0,
  `paypal` tinyint(4) NOT NULL DEFAULT 0,
  `moneybookers` tinyint(4) NOT NULL DEFAULT 0,
  `klamm` tinyint(4) NOT NULL DEFAULT 0,
  `funcoins` tinyint(4) NOT NULL DEFAULT 0,
  `nickey` tinyint(4) NOT NULL DEFAULT 0,
  `downies` tinyint(4) NOT NULL DEFAULT 0,
  `ueberweisung` tinyint(1) NOT NULL DEFAULT 0,
  `ueberweisungssumme` int(11) NOT NULL DEFAULT 0,
  `bettel_min` double(20,6) NOT NULL DEFAULT 0.000000,
  `bettel_max` double(20,6) NOT NULL DEFAULT 0.000000,
  `bettel_reload` int(11) NOT NULL DEFAULT 0,
  `kurs_euro` double(20,6) NOT NULL DEFAULT 0.000000,
  `kurs_klamm` double(20,6) NOT NULL DEFAULT 0.000000,
  `kurs_funcoins` double(20,6) NOT NULL DEFAULT 0.000000,
  `kurs_nickey` double(20,6) NOT NULL DEFAULT 0.000000,
  `kurs_downie` double(20,6) NOT NULL DEFAULT 0.000000,
  `skr_start` int(11) NOT NULL DEFAULT 0,
  `skr_ende` int(11) NOT NULL DEFAULT 0,
  `skr_plaetze` varchar(255) DEFAULT NULL,
  `sar_start` int(11) NOT NULL DEFAULT 0,
  `sar_ende` int(11) NOT NULL DEFAULT 0,
  `sar_plaetze` varchar(255) DEFAULT NULL,
  `sbr_start` int(11) NOT NULL DEFAULT 0,
  `sbr_ende` int(11) NOT NULL DEFAULT 0,
  `sbr_plaetze` varchar(255) DEFAULT NULL,
  `dkr_start` int(11) NOT NULL DEFAULT 0,
  `dkr_ende` int(11) NOT NULL DEFAULT 0,
  `dkr_startpot` double(20,6) NOT NULL DEFAULT 0.000000,
  `dkr_zuwachs` double(20,6) NOT NULL DEFAULT 0.000000,
  `dkr_plaetze` varchar(255) DEFAULT NULL,
  `dar_start` int(11) NOT NULL DEFAULT 0,
  `dar_ende` int(11) NOT NULL DEFAULT 0,
  `dar_startpot` double(20,6) NOT NULL DEFAULT 0.000000,
  `dar_zuwachs` double(20,6) NOT NULL DEFAULT 0.000000,
  `dar_plaetze` varchar(255) DEFAULT NULL,
  `dbr_start` int(11) NOT NULL DEFAULT 0,
  `dbr_ende` int(11) NOT NULL DEFAULT 0,
  `dbr_startpot` double(20,6) NOT NULL DEFAULT 0.000000,
  `dbr_zuwachs` double(20,6) NOT NULL DEFAULT 0.000000,
  `dbr_plaetze` varchar(255) DEFAULT NULL,
  `srr_start` varchar(11) DEFAULT NULL,
  `srr_ende` varchar(11) DEFAULT NULL,
  `srr_plaetze` varchar(255) DEFAULT NULL,
  `ocs` tinyint(1) NOT NULL DEFAULT 0,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_passwort` varchar(255) NOT NULL,
  `smtp_port` varchar(255) NOT NULL,
  `nach_koma` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_1_config`
--

INSERT INTO `equinox_1_config` (`config_id`, `lizenzkey`, `seitenname`, `seitenurl`, `betreibermail`, `cronpasswort`, `waehrungsname`, `refebenen`, `bank`, `paypal`, `moneybookers`, `klamm`, `funcoins`, `nickey`, `downies`, `ueberweisung`, `ueberweisungssumme`, `bettel_min`, `bettel_max`, `bettel_reload`, `kurs_euro`, `kurs_klamm`, `kurs_funcoins`, `kurs_nickey`, `kurs_downie`, `skr_start`, `skr_ende`, `skr_plaetze`, `sar_start`, `sar_ende`, `sar_plaetze`, `sbr_start`, `sbr_ende`, `sbr_plaetze`, `dkr_start`, `dkr_ende`, `dkr_startpot`, `dkr_zuwachs`, `dkr_plaetze`, `dar_start`, `dar_ende`, `dar_startpot`, `dar_zuwachs`, `dar_plaetze`, `dbr_start`, `dbr_ende`, `dbr_startpot`, `dbr_zuwachs`, `dbr_plaetze`, `srr_start`, `srr_ende`, `srr_plaetze`, `ocs`, `smtp_host`, `smtp_username`, `smtp_passwort`, `smtp_port`, `nach_koma`) VALUES
('1', '', '', '', '', '', 'lose', '10', 1, 1, 1, 0, 0, 0, 1, 0, 11, 11.000000, 12.000000, 1, 1.000000, 12.000000, 0.000000, 0.000000, 1.000000, 0, 0, '1111119999|1111111999|999999|77777', 1534372193, 1534399999, '', 0, 0, '999|888', 1534372140, 1534399980, 0.000000, 0.000000, '9999999', 1534372193, 1534399999, 0.000000, 0.000000, '', 1534372193, 1534399999, 0.000000, 0.000000, '', '0', '0', '', 1, '', '', '', '', 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_config_games`
--

CREATE TABLE `equinox_1_config_games` (
  `id` smallint(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(25) NOT NULL DEFAULT '0',
  `settings` text NOT NULL,
  `cat` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


--
-- Tabellenstruktur für Tabelle `equinox_1_crons`
--

CREATE TABLE `equinox_1_crons` (
  `cronid` int(11) NOT NULL,
  `cronname` varchar(100) DEFAULT NULL,
  `crondatei` varchar(100) DEFAULT NULL,
  `laufzeit` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_1_crons`
--

INSERT INTO `equinox_1_crons` (`cronid`, `cronname`, `crondatei`, `laufzeit`) VALUES
(1, 'Forcedklicks - Adcocktail', 'adcocktail_forcedbanner', 1535989692),
(2, 'Paidmailss - Adcocktail', 'adcocktail_paidmails', 1535978293),
(11, 'Adcocktail - Traffic', 'traffic_adcocktail', 1536048896),
(7, 'Refzahlung', 'refzahlung', 1535974786),
(8, 'Zinskonto - Erfassung', 'kontomessungen', 1535974983),
(9, 'Zinskonto - Zinszahlung', 'zinszahlungen', 1535974987),
(10, 'Mailquery', 'sendmail', 1535978553);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_doppelaccounts`
--

CREATE TABLE `equinox_1_doppelaccounts` (
  `zeit` int(11) NOT NULL DEFAULT 0,
  `von` varchar(255) DEFAULT NULL,
  `zu` varchar(255) DEFAULT NULL,
  `did` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_faq`
--

CREATE TABLE `equinox_1_faq` (
  `id` bigint(20) NOT NULL,
  `number` int(11) NOT NULL DEFAULT 0,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_gamestats`
--

CREATE TABLE `equinox_1_gamestats` (
  `id` int(11) NOT NULL,
  `file` varchar(25) NOT NULL,
  `win` int(11) NOT NULL DEFAULT 0,
  `lose` int(11) NOT NULL DEFAULT 0,
  `winamount` bigint(20) NOT NULL DEFAULT 0,
  `loseamount` bigint(20) NOT NULL DEFAULT 0,
  `lastgame` int(11) NOT NULL DEFAULT 0,
  `lastplayer` int(11) NOT NULL DEFAULT 0,
  `draw` mediumint(9) NOT NULL DEFAULT 0,
  `jackpot` text NOT NULL,
  `cache` text NOT NULL,
  `opt` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_games_einzelzeche`
--

CREATE TABLE `equinox_1_games_einzelzeche` (
  `zeche` int(11) NOT NULL DEFAULT 0,
  `spiel` int(11) NOT NULL DEFAULT 0,
  `mitspieler` longtext DEFAULT NULL,
  `bilanz` bigint(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_games_multiplayzeche`
--

CREATE TABLE `equinox_1_games_multiplayzeche` (
  `zeche` int(11) NOT NULL DEFAULT 0,
  `spiel` int(11) NOT NULL DEFAULT 0,
  `bilanz` bigint(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_games_multizeche`
--

CREATE TABLE `equinox_1_games_multizeche` (
  `zeche` int(11) NOT NULL DEFAULT 0,
  `spiel` int(11) NOT NULL DEFAULT 0,
  `bilanz` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_games_rotazeche`
--

CREATE TABLE `equinox_1_games_rotazeche` (
  `zeche` int(11) NOT NULL DEFAULT 0,
  `spiel` int(11) NOT NULL DEFAULT 0,
  `bilanz` bigint(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_games_zeche_reload`
--

CREATE TABLE `equinox_1_games_zeche_reload` (
  `uid` int(11) NOT NULL DEFAULT 0,
  `zeche` varchar(150) DEFAULT NULL,
  `zeit` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_interface`
--

CREATE TABLE `equinox_1_interface` (
  `interface_id` int(11) NOT NULL,
  `interface` varchar(50) DEFAULT NULL,
  `werbeart` varchar(75) DEFAULT NULL,
  `betreiber` int(7) NOT NULL DEFAULT 0,
  `seite` int(7) NOT NULL DEFAULT 0,
  `pass` varchar(50) DEFAULT NULL,
  `eigenverdienst` int(2) NOT NULL DEFAULT 0,
  `mindestverguetung` double(10,6) NOT NULL DEFAULT 0.000000,
  `restklicks` int(4) NOT NULL DEFAULT 0,
  `umrechnung` double(10,4) NOT NULL DEFAULT 0.0000,
  `aufendhalt` int(3) NOT NULL DEFAULT 0,
  `loeschen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_1_interface`
--

INSERT INTO `equinox_1_interface` (`interface_id`, `interface`, `werbeart`, `betreiber`, `seite`, `pass`, `eigenverdienst`, `mindestverguetung`, `restklicks`, `umrechnung`, `aufendhalt`, `loeschen`) VALUES
(1, 'adcocktail', 'forcedbanner', '', '', '', 50, 0.000001, 100, 1.0000, 10, 1),
(2, 'adcocktail_m', 'paidmails', '', '', '', 50, 0.000001, 100, 1.0000, 10, 1),
(3, 'lose-ads', 'forcedbanner', 0, 0, '0', 0, 0.000000, 0, 0.0000, 0, 0),
(4, 'losebox', 'forcedbanner', 0, 0, '0', 0, 0.000000, 0, 0.0000, 0, 0),
(5, 'hp-lose', 'forcedbanner', 0, 0, '0', 0, 0.000000, 0, 0.0000, 0, 0),
(6, 'fucoex', 'forcedbanner', 0, 0, '0', 0, 0.000000, 0, 0.0000, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_kampagnen`
--

CREATE TABLE `equinox_1_kampagnen` (
  `kampagnen_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT 0,
  `format` varchar(50) DEFAULT NULL,
  `do_views` int(10) NOT NULL DEFAULT 0,
  `do_clicks` int(10) NOT NULL DEFAULT 0,
  `in_views` int(10) NOT NULL DEFAULT 0,
  `in_clicks` int(10) NOT NULL DEFAULT 0,
  `reload` int(11) NOT NULL DEFAULT 0,
  `url_banner` varchar(255) DEFAULT NULL,
  `url_ziel` varchar(255) DEFAULT NULL,
  `text_link` varchar(255) DEFAULT NULL,
  `text_mail` longtext DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bemerkung` varchar(255) DEFAULT NULL,
  `payout` double(10,6) NOT NULL DEFAULT 0.000000,
  `aufendhalt` int(3) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `nb` double(20,6) NOT NULL DEFAULT 0.000000,
  `preis` double(10,6) NOT NULL DEFAULT 0.000000
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_kontoauszug`
--

CREATE TABLE `equinox_1_kontoauszug` (
  `bid` int(11) NOT NULL,
  `buchungs_id` varchar(32) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `sender` varchar(50) DEFAULT NULL,
  `empfaenger` varchar(50) DEFAULT NULL,
  `summe` double(20,6) NOT NULL DEFAULT 0.000000,
  `vzweck` varchar(150) DEFAULT NULL,
  `zeit` int(11) NOT NULL DEFAULT 0,
  `transip` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_mailcounter`
--

CREATE TABLE `equinox_1_mailcounter` (
  `nickname` varchar(30) DEFAULT NULL,
  `counter` int(10) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_mailquery`
--

CREATE TABLE `equinox_1_mailquery` (
  `mid` int(11) NOT NULL,
  `kid` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `email` varchar(250) DEFAULT NULL,
  `mailtitel` varchar(100) DEFAULT NULL,
  `mailtext` longtext DEFAULT NULL,
  `gueltig` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `bestaedigt` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_nachrichten`
--

CREATE TABLE `equinox_1_nachrichten` (
  `id` int(11) NOT NULL,
  `von` varchar(50) NOT NULL DEFAULT '',
  `an` varchar(50) NOT NULL DEFAULT '',
  `betreff` varchar(50) NOT NULL DEFAULT '',
  `inhalt` text NOT NULL,
  `zeit` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_news`
--

CREATE TABLE `equinox_1_news` (
  `news_id` int(11) NOT NULL,
  `zeit` int(11) NOT NULL DEFAULT 0,
  `titel` varchar(50) DEFAULT NULL,
  `news` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_nickpage`
--

CREATE TABLE `equinox_1_nickpage` (
  `nickname` varchar(50) NOT NULL,
  `werbernick` varchar(50) DEFAULT NULL,
  `benutzertext` longtext DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `downie_id` int(11) NOT NULL DEFAULT 0,
  `klamm_id` int(11) NOT NULL DEFAULT 0,
  `fuco_id` int(11) NOT NULL DEFAULT 0,
  `nickey_id` int(11) NOT NULL DEFAULT 0,
  `icq` int(11) NOT NULL DEFAULT 0,
  `skype` varchar(50) DEFAULT NULL,
  `msn` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `url_1` varchar(255) DEFAULT NULL,
  `beschreibung_1` varchar(255) DEFAULT NULL,
  `url_2` varchar(255) DEFAULT NULL,
  `beschreibung_2` varchar(255) DEFAULT NULL,
  `url_3` varchar(255) DEFAULT NULL,
  `beschreibung_3` varchar(255) DEFAULT NULL,
  `url_4` varchar(255) DEFAULT NULL,
  `beschreibung_4` varchar(255) DEFAULT NULL,
  `url_5` varchar(255) DEFAULT NULL,
  `beschreibung_5` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_reloads`
--

CREATE TABLE `equinox_1_reloads` (
  `kampagnen_id` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(15) DEFAULT NULL,
  `reload_bis` int(11) NOT NULL DEFAULT 0,
  `zusatz` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_schnittstelle`
--

CREATE TABLE `equinox_1_schnittstelle` (
  `betreiber_id` varchar(50) DEFAULT NULL,
  `betreiber_passwort` varchar(50) DEFAULT NULL,
  `betreiber_kennung` varchar(50) DEFAULT NULL,
  `schnittstelle` varchar(20) DEFAULT NULL,
  `einzahltext` varchar(40) DEFAULT NULL,
  `auszahltext` varchar(40) DEFAULT NULL,
  `einzahlsumme` int(11) NOT NULL DEFAULT 0,
  `auszahlsumme` int(11) NOT NULL DEFAULT 0,
  `anfragen_tag` int(11) NOT NULL DEFAULT 0,
  `anfragen_geb` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_1_schnittstelle`
--

INSERT INTO `equinox_1_schnittstelle` VALUES ('', '', '', 'fucoex', '', '', 0, 0, 0, 0);
INSERT INTO `equinox_1_schnittstelle` VALUES ('', '', '', 'klamm', '', '', 0, 0, 0, 0);
INSERT INTO `equinox_1_schnittstelle` VALUES ('', '', '', 'nickeyforce', '', '', 0, 0, 0, 0);
INSERT INTO `equinox_1_schnittstelle` VALUES ('', '', '', 'dcc', '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_support`
--

CREATE TABLE `equinox_1_support` (
  `id` int(11) NOT NULL,
  `parentid` int(11) NOT NULL DEFAULT 0,
  `user` varchar(50) NOT NULL DEFAULT '',
  `erstellt` int(11) NOT NULL DEFAULT 0,
  `zuletzt` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `betreff` varchar(55) NOT NULL DEFAULT 'Kein Betreff',
  `nachricht` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_surfreloads`
--

CREATE TABLE `equinox_1_surfreloads` (
  `ip` varchar(255) DEFAULT NULL,
  `uid` int(255) NOT NULL DEFAULT 0,
  `tan` int(255) NOT NULL DEFAULT 0,
  `bis` int(255) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_timer`
--

CREATE TABLE `equinox_1_timer` (
  `tid` int(11) NOT NULL,
  `kampagnen_id` int(11) NOT NULL DEFAULT 0,
  `uid` int(11) NOT NULL DEFAULT 0,
  `ip` varchar(15) DEFAULT NULL,
  `timer_bis` int(11) NOT NULL DEFAULT 0,
  `tos` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_traffic`
--

CREATE TABLE `equinox_1_traffic` (
  `uid` int(11) NOT NULL DEFAULT 0,
  `tan` varchar(32) NOT NULL DEFAULT '',
  `kid` int(11) NOT NULL DEFAULT 0,
  `link` text NOT NULL,
  `reloadsperre` int(11) NOT NULL DEFAULT 0,
  `aufendhalt` int(11) NOT NULL DEFAULT 0,
  `verguetung` double(10,6) NOT NULL DEFAULT 0.000000,
  `preis` double(10,6) NOT NULL DEFAULT 0.000000,
  `gebucht` int(11) NOT NULL DEFAULT 0,
  `sponsor` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_traffic_reload`
--

CREATE TABLE `equinox_1_traffic_reload` (
  `ip` varchar(15) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT 0,
  `tan` varchar(32) NOT NULL DEFAULT '',
  `reload_bis` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_url_log`
--

CREATE TABLE `equinox_1_url_log` (
  `url_id` int(11) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `aufrufe` int(11) NOT NULL DEFAULT 0,
  `durch` varchar(50) DEFAULT NULL,
  `sperre` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_user`
--

CREATE TABLE `equinox_1_user` (
  `uid` int(11) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `passwort` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `werber_id` int(11) NOT NULL DEFAULT 0,
  `werber_nick` varchar(50) DEFAULT NULL,
  `werberverdienst_aktuell` double(20,6) NOT NULL DEFAULT 0.000000,
  `werberverdienst_gesamt` double(20,6) NOT NULL DEFAULT 0.000000,
  `werber_refback` tinyint(3) NOT NULL DEFAULT 0,
  `email` varchar(255) DEFAULT NULL,
  `guthaben` double(20,6) NOT NULL DEFAULT 0.000000,
  `tresorguthaben` double(20,6) NOT NULL DEFAULT 0.000000,
  `tresorpasswort` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `anmeldezeit` int(11) NOT NULL DEFAULT 0,
  `regip` varchar(16) DEFAULT NULL,
  `max_banner` int(3) NOT NULL DEFAULT 10,
  `max_pmail` int(4) NOT NULL DEFAULT 0,
  `zinspunkte` double(20,6) NOT NULL DEFAULT 0.000000,
  `knt_guthaben` double(20,6) NOT NULL DEFAULT 0.000000,
  `knt_messungen` int(4) NOT NULL DEFAULT 0,
  `aktivzeit` int(11) NOT NULL DEFAULT 0,
  `skr` int(11) NOT NULL DEFAULT 0,
  `dkr` int(11) NOT NULL DEFAULT 0,
  `sbr` int(11) NOT NULL DEFAULT 0,
  `dbr` int(11) NOT NULL DEFAULT 0,
  `sar` double(20,6) NOT NULL DEFAULT 0.000000,
  `dar` double(20,6) NOT NULL DEFAULT 0.000000,
  `srr` int(5) NOT NULL DEFAULT 0,
  `bettelklicks` int(11) NOT NULL DEFAULT 0,
  `bettelsumme` double(20,6) NOT NULL DEFAULT 0.000000,
  `forcedklicks` int(11) NOT NULL DEFAULT 0,
  `forcedsumme` double(20,6) NOT NULL DEFAULT 0.000000,
  `trafficseiten` int(11) NOT NULL,
  `trafficsumme` double(20,6) NOT NULL,
  `refanzahl` int(5) NOT NULL DEFAULT 0,
  `aktivpunkte` double(30,6) NOT NULL DEFAULT 0.000000,
  `d_acc` tinyint(1) NOT NULL DEFAULT 0,
  `klick_count` int(11) NOT NULL,
  `klick_key` varchar(6) NOT NULL,
  `klick_stop` int(11) NOT NULL,
  `rang` int(2) NOT NULL,
  `rangklicks` int(11) NOT NULL,
  `leads_offen` int(3) NOT NULL DEFAULT 0,
  `leads_verguetet` int(3) NOT NULL DEFAULT 0,
  `leads_abgelehnt` int(3) NOT NULL DEFAULT 0,
  `leads_verdienst` double(100,2) NOT NULL DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_useraktivierung`
--

CREATE TABLE `equinox_1_useraktivierung` (
  `nickname` varchar(50) DEFAULT NULL,
  `aktivierungskey` varchar(32) DEFAULT NULL,
  `zeit` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_userdaten`
--

CREATE TABLE `equinox_1_userdaten` (
  `nickname` varchar(50) DEFAULT NULL,
  `vorname` varchar(50) DEFAULT NULL,
  `nachname` varchar(50) DEFAULT NULL,
  `geschlecht` varchar(255) NOT NULL,
  `geburtsdatum` varchar(10) DEFAULT NULL,
  `strasse` varchar(220) DEFAULT NULL,
  `plz` varchar(11) DEFAULT NULL,
  `ort` varchar(100) DEFAULT NULL,
  `land` varchar(255) NOT NULL,
  `firma` varchar(100) DEFAULT NULL,
  `telefon` varchar(30) DEFAULT NULL,
  `mobil` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_userkonten`
--

CREATE TABLE `equinox_1_userkonten` (
  `nickname` varchar(50) DEFAULT NULL,
  `kreditinstitut` varchar(100) DEFAULT NULL,
  `kontoinhaber` varchar(250) DEFAULT NULL,
  `kontonummer` varchar(50) DEFAULT NULL,
  `bankleitzahl` varchar(20) DEFAULT NULL,
  `iban` varchar(50) DEFAULT NULL,
  `bic` varchar(50) DEFAULT NULL,
  `paypal` varchar(255) DEFAULT NULL,
  `moneybookers` varchar(255) DEFAULT NULL,
  `klamm_id` int(11) NOT NULL DEFAULT 0,
  `fuco_id` int(11) NOT NULL DEFAULT 0,
  `nickey_id` int(11) NOT NULL DEFAULT 0,
  `downie_id` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_werbepreise`
--

CREATE TABLE `equinox_1_werbepreise` (
  `id` int(1) NOT NULL DEFAULT 0,
  `gebuehr_betreiber` double(20,6) NOT NULL DEFAULT 0.000000,
  `gebuehr_storne` double(20,6) NOT NULL DEFAULT 0.000000,
  `rabatt_0` double(20,6) NOT NULL DEFAULT 0.000000,
  `rabatt_1` double(20,6) NOT NULL DEFAULT 0.000000,
  `rabatt_2` double(20,6) NOT NULL DEFAULT 0.000000,
  `rabatt_3` double(20,6) NOT NULL DEFAULT 0.000000,
  `rabatt_4` double(20,6) NOT NULL DEFAULT 0.000000,
  `rabatt_5` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_forcedbanner` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_bannerviews` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_bannerklicks` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_buttonviews` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_buttonklicks` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_surfbarviews` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_surfbarklicks` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_textlinkviews` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_textlinkklicks` double(20,6) NOT NULL DEFAULT 0.000000,
  `grundpreis_paidmails` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_1` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_2` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_4` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_8` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_12` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_16` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_20` double(20,6) NOT NULL DEFAULT 0.000000,
  `reloadpreis_24` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_0` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_5` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_10` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_15` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_20` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_25` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_30` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_45` double(20,6) NOT NULL DEFAULT 0.000000,
  `aufendhaltspreis_60` double(20,6) NOT NULL DEFAULT 0.000000,
  `minbuchung` double(20,6) NOT NULL DEFAULT 0.000000
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_1_werbepreise`
--

INSERT INTO `equinox_1_werbepreise` (`id`, `gebuehr_betreiber`, `gebuehr_storne`, `rabatt_0`, `rabatt_1`, `rabatt_2`, `rabatt_3`, `rabatt_4`, `rabatt_5`, `grundpreis_forcedbanner`, `grundpreis_bannerviews`, `grundpreis_bannerklicks`, `grundpreis_buttonviews`, `grundpreis_buttonklicks`, `grundpreis_surfbarviews`, `grundpreis_surfbarklicks`, `grundpreis_textlinkviews`, `grundpreis_textlinkklicks`, `grundpreis_paidmails`, `reloadpreis_1`, `reloadpreis_2`, `reloadpreis_4`, `reloadpreis_8`, `reloadpreis_12`, `reloadpreis_16`, `reloadpreis_20`, `reloadpreis_24`, `aufendhaltspreis_0`, `aufendhaltspreis_5`, `aufendhaltspreis_10`, `aufendhaltspreis_15`, `aufendhaltspreis_20`, `aufendhaltspreis_25`, `aufendhaltspreis_30`, `aufendhaltspreis_45`, `aufendhaltspreis_60`, `minbuchung`) VALUES
(1, 10.000000, 10.000000, 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 0.000000, 1.000000, 1.000000, 1.000000, 1.000000, 1.000000, 1.000000, 1.000000, 1.000000, 1.000000, 1.000000, 0.900000, 0.950000, 1.000000, 1.030000, 1.050000, 1.100000, 1.150000, 1.250000, 1.000000, 2.000000, 2.000000, 3.000000, 4.000000, 5.000000, 6.000000, 7.000000, 8.000000, 10.000000);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_1_zinssaetze`
--

CREATE TABLE `equinox_1_zinssaetze` (
  `zinsid` int(11) NOT NULL,
  `zinspunkte_von` double(20,6) NOT NULL DEFAULT 0.000000,
  `zinspunkte_bis` double(20,6) NOT NULL DEFAULT 0.000000,
  `max_verzinsen` int(11) NOT NULL DEFAULT 0,
  `zinssatz` double(16,6) NOT NULL DEFAULT 0.000000
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_rangsystem`
--

CREATE TABLE `equinox_rangsystem` (
  `rang` int(2) NOT NULL DEFAULT 0,
  `name` varchar(50) NOT NULL DEFAULT '',
  `grenzwert` int(100) NOT NULL DEFAULT 0,
  `bonus` int(100) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_rangsystem`
--

INSERT INTO `equinox_rangsystem` (`rang`, `name`, `grenzwert`, `bonus`) VALUES
(2, 'Rang 2', 2000, 20000),
(3, 'Rang 3', 4000, 30000),
(4, 'Rang 4', 8000, 40000),
(5, 'Rang 5', 15000, 50000),
(6, 'Rang 6', 30000, 60000),
(7, 'Rang 7', 60000, 70000),
(8, 'Rang 8', 90000, 80000),
(9, 'Rang 9', 120000, 90000),
(1, 'Rang 1', 1000, 10000),
(10, 'Rang 10', 150000, 100000),
(11, 'Rang 11', 180000, 110000),
(12, 'Rang 12', 210000, 120000),
(13, 'Rang 13', 240000, 130000),
(14, 'Rang 14', 270000, 140000),
(15, 'Rang 15', 300000, 150000),
(16, 'Rang 16', 400000, 160000),
(17, 'Rang 17', 500000, 170000),
(18, 'Rang 18', 600000, 180000),
(19, 'Rang 19', 700000, 190000),
(20, 'Rang 20', 1000000, 250000),
(0, 'Anfänger', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `equinox_rangsystem_conf`
--

CREATE TABLE `equinox_rangsystem_conf` (
  `art` varchar(20) NOT NULL DEFAULT '',
  `einstellung` int(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `equinox_rangsystem_conf`
--

INSERT INTO `equinox_rangsystem_conf` (`art`, `einstellung`) VALUES
('aktiv', 0),
('anzahl', 10);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `equinox_1_bilanzen`
--
ALTER TABLE `equinox_1_bilanzen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `equinox_1_config`
--
ALTER TABLE `equinox_1_config`
  ADD PRIMARY KEY (`config_id`);

--
-- Indizes für die Tabelle `equinox_1_config_games`
--
ALTER TABLE `equinox_1_config_games`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `equinox_1_crons`
--
ALTER TABLE `equinox_1_crons`
  ADD PRIMARY KEY (`cronid`),
  ADD UNIQUE KEY `crondatei` (`crondatei`),
  ADD UNIQUE KEY `cronname_2` (`cronname`);

--
-- Indizes für die Tabelle `equinox_1_doppelaccounts`
--
ALTER TABLE `equinox_1_doppelaccounts`
  ADD PRIMARY KEY (`did`),
  ADD KEY `von` (`von`);

--
-- Indizes für die Tabelle `equinox_1_faq`
--
ALTER TABLE `equinox_1_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `equinox_1_gamestats`
--
ALTER TABLE `equinox_1_gamestats`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `equinox_1_games_einzelzeche`
--
ALTER TABLE `equinox_1_games_einzelzeche`
  ADD PRIMARY KEY (`zeche`);

--
-- Indizes für die Tabelle `equinox_1_games_multiplayzeche`
--
ALTER TABLE `equinox_1_games_multiplayzeche`
  ADD PRIMARY KEY (`zeche`);

--
-- Indizes für die Tabelle `equinox_1_games_multizeche`
--
ALTER TABLE `equinox_1_games_multizeche`
  ADD PRIMARY KEY (`zeche`);

--
-- Indizes für die Tabelle `equinox_1_games_rotazeche`
--
ALTER TABLE `equinox_1_games_rotazeche`
  ADD KEY `zeche` (`zeche`);

--
-- Indizes für die Tabelle `equinox_1_games_zeche_reload`
--
ALTER TABLE `equinox_1_games_zeche_reload`
  ADD KEY `uid` (`uid`,`zeche`,`zeit`);

--
-- Indizes für die Tabelle `equinox_1_interface`
--
ALTER TABLE `equinox_1_interface`
  ADD PRIMARY KEY (`interface_id`),
  ADD UNIQUE KEY `interface_2` (`interface`),
  ADD KEY `interface` (`interface`,`werbeart`);

--
-- Indizes für die Tabelle `equinox_1_kampagnen`
--
ALTER TABLE `equinox_1_kampagnen`
  ADD PRIMARY KEY (`kampagnen_id`),
  ADD KEY `status` (`status`),
  ADD KEY `format` (`format`),
  ADD KEY `userid` (`userid`);

--
-- Indizes für die Tabelle `equinox_1_kontoauszug`
--
ALTER TABLE `equinox_1_kontoauszug`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `user` (`user`),
  ADD KEY `buchungs_id` (`buchungs_id`),
  ADD KEY `transip` (`transip`);

--
-- Indizes für die Tabelle `equinox_1_mailquery`
--
ALTER TABLE `equinox_1_mailquery`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `kid` (`kid`,`uid`,`email`,`gueltig`,`status`),
  ADD KEY `bestaedigt` (`bestaedigt`),
  ADD KEY `hash` (`hash`);

--
-- Indizes für die Tabelle `equinox_1_nachrichten`
--
ALTER TABLE `equinox_1_nachrichten`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `equinox_1_news`
--
ALTER TABLE `equinox_1_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indizes für die Tabelle `equinox_1_nickpage`
--
ALTER TABLE `equinox_1_nickpage`
  ADD PRIMARY KEY (`nickname`);

--
-- Indizes für die Tabelle `equinox_1_reloads`
--
ALTER TABLE `equinox_1_reloads`
  ADD KEY `kampagnen_id` (`kampagnen_id`,`uid`,`reload_bis`),
  ADD KEY `zusatz` (`zusatz`),
  ADD KEY `ip` (`ip`);

--
-- Indizes für die Tabelle `equinox_1_schnittstelle`
--
ALTER TABLE `equinox_1_schnittstelle`
  ADD UNIQUE KEY `schnittstelle` (`schnittstelle`);

--
-- Indizes für die Tabelle `equinox_1_support`
--
ALTER TABLE `equinox_1_support`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `equinox_1_timer`
--
ALTER TABLE `equinox_1_timer`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `kampagnen_id` (`kampagnen_id`,`uid`,`timer_bis`);

--
-- Indizes für die Tabelle `equinox_1_url_log`
--
ALTER TABLE `equinox_1_url_log`
  ADD PRIMARY KEY (`url_id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indizes für die Tabelle `equinox_1_user`
--
ALTER TABLE `equinox_1_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `nickname` (`nickname`,`passwort`,`status`),
  ADD KEY `skr` (`skr`),
  ADD KEY `dkr` (`dkr`),
  ADD KEY `sbr` (`sbr`),
  ADD KEY `dbr` (`dbr`),
  ADD KEY `sar` (`sar`),
  ADD KEY `dar` (`dar`),
  ADD KEY `werber_id` (`werber_id`),
  ADD KEY `zinspunkte` (`zinspunkte`),
  ADD KEY `max_pmail` (`max_pmail`),
  ADD KEY `regip` (`regip`),
  ADD KEY `aktivpunkte` (`aktivpunkte`),
  ADD KEY `d_acc` (`d_acc`),
  ADD KEY `srr` (`srr`),
  ADD KEY `klick_count` (`klick_count`,`klick_key`,`klick_stop`);

--
-- Indizes für die Tabelle `equinox_1_useraktivierung`
--
ALTER TABLE `equinox_1_useraktivierung`
  ADD UNIQUE KEY `aktivierungskey` (`aktivierungskey`);

--
-- Indizes für die Tabelle `equinox_1_userdaten`
--
ALTER TABLE `equinox_1_userdaten`
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- Indizes für die Tabelle `equinox_1_userkonten`
--
ALTER TABLE `equinox_1_userkonten`
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD KEY `klamm_id` (`klamm_id`),
  ADD KEY `fuco_id` (`fuco_id`),
  ADD KEY `nickey_id` (`nickey_id`),
  ADD KEY `downie_id` (`downie_id`);

--
-- Indizes für die Tabelle `equinox_1_werbepreise`
--
ALTER TABLE `equinox_1_werbepreise`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `equinox_1_zinssaetze`
--
ALTER TABLE `equinox_1_zinssaetze`
  ADD PRIMARY KEY (`zinsid`),
  ADD KEY `zinspunkte_von` (`zinspunkte_von`,`zinspunkte_bis`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `equinox_1_bilanzen`
--
ALTER TABLE `equinox_1_bilanzen`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_config_games`
--
ALTER TABLE `equinox_1_config_games`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_crons`
--
ALTER TABLE `equinox_1_crons`
  MODIFY `cronid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_doppelaccounts`
--
ALTER TABLE `equinox_1_doppelaccounts`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_faq`
--
ALTER TABLE `equinox_1_faq`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_gamestats`
--
ALTER TABLE `equinox_1_gamestats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_interface`
--
ALTER TABLE `equinox_1_interface`
  MODIFY `interface_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_kampagnen`
--
ALTER TABLE `equinox_1_kampagnen`
  MODIFY `kampagnen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_kontoauszug`
--
ALTER TABLE `equinox_1_kontoauszug`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT für Tabelle `equinox_1_mailquery`
--
ALTER TABLE `equinox_1_mailquery`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_nachrichten`
--
ALTER TABLE `equinox_1_nachrichten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_news`
--
ALTER TABLE `equinox_1_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_support`
--
ALTER TABLE `equinox_1_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_timer`
--
ALTER TABLE `equinox_1_timer`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_url_log`
--
ALTER TABLE `equinox_1_url_log`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_user`
--
ALTER TABLE `equinox_1_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT für Tabelle `equinox_1_zinssaetze`
--
ALTER TABLE `equinox_1_zinssaetze`
  MODIFY `zinsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

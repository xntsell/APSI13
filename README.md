# APSI CR002 PERT 13 MEMBUAT PROTOTYPE BLOG
---
## Bahasa yang digunakan
- PHP
- HTML
- CSS
- MySQL

## Tools
- Laptop/PC
- Docker
- Navicat
- Koneksi Internet (untuk build)
- Browser

## Struktur Folder
```
strktur folder : 
|-- db
|    |-- data
|    |-- conf.d
|    
|-- .env
|    
|-- src 
|
|-- dockerfile
|-- httpd.vhost.conf
|-- docker-compose.yml
```

## Langkah-Langkah
buat dulu tempat untuk menyimpan file
```bash
mkdir pert13
```

buat file-file yang diperlukan
```bash
touch .env docker-compose.yml Dockerfile httpd.vhost.conf
```
```bash
mkdir src
```

kemudian build folder pert13 di terminal dengan
```bash
docker compose up -d --build
```

pastikan tidak ada error selama proses build

selanjutnya masuk ke navicat dan buat koneksi baru dengan klik **new connection** -> **MySQL**, kemudian isi sebagai berikut:
```
connection_name = APSI_CR002 (boleh bebas)
host = 127.0.0.1
port = 12307
user Name = root
password = 123
```
setelah itu jalankan **test connection**, pastikan berhasil dan klik **save**

klik kanan pada koneksi yang baru dibuat (APSI_CR002) kemudian **add new database**  
```
web_blog
```

setelah jadi database nya silahkan anda klik New Querry dan pastekan code sql nya
```bash
/*
 Navicat Premium Data Transfer

 Source Server         : apsi_cr002
 Source Server Type    : MySQL
 Source Server Version : 100244
 Source Host           : 127.0.0.1:12306
 Source Schema         : web_blog

 Target Server Type    : MySQL
 Target Server Version : 100244
 File Encoding         : 65001

 Date: 07/07/2025 12:39:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blog
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user`(`user_id`) USING BTREE,
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for login
-- ----------------------------
DROP TABLE IF EXISTS `login`;
CREATE TABLE `login`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
```

klik **Run**

Lanjutkan dengan ngoding PHP 🍺

---

## Jalankan pada browser
Akses pada browser dengan
```bash 
http://localhost:83
```

by xntsell👻

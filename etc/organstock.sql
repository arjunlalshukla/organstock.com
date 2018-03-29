CREATE DATABASE IF NOT EXISTS organstock;
USE organstock;

CREATE TABLE IF NOT EXISTS buyer_seller (
	username VARCHAR(255),
	password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	country VARCHAR(255) NOT NULL,
	picture_path VARCHAR(511),
	PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS physician (
	username VARCHAR(255),
	password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	country VARCHAR(255) NOT NULL,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	suffix VARCHAR(255),
	degree VARCHAR(255),
	agency VARCHAR(255) NOT NULL,
	license_num VARCHAR(255) NOT NULL,
	picture_path VARCHAR(511),
	PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS organ (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	seller_username VARCHAR(255) NOT NULL REFERENCES buyer_seller,
	organ_type VARCHAR(255) NOT NULL,
	blood_type VARCHAR(255) NOT NULL,
	weight INTEGER UNSIGNED NOT NULL,
	owner_dob DATE NOT NULL,
	description TEXT,
	picture_path VARCHAR(511),

	FOREIGN KEY (seller_username) REFERENCES buyer_seller (username)
);

CREATE TABLE IF NOT EXISTS cart (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	buyer_username VARCHAR(255) NOT NULL REFERENCES buyer_seller,
	organ_id INTEGER NOT NULL REFERENCES organ,

	FOREIGN KEY (buyer_username) REFERENCES buyer_seller (username),
	FOREIGN KEY (organ_id) REFERENCES organ (id)
);

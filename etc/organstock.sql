CREATE DATABASE organstock;

CREATE TABLE user (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR NOT NULL UNIQUE,
	password VARCHAR NOT NULL,
	email VARCHAR NOT NULL,
	country VARCHAR NOT NULL,
	province VARCHAR NOT NULL,
	address VARCHAR NOT NULL,
	physician BIT NOT NULL,
	first_name VARCHAR NOT NULL,
	last_name VARCHAR NOT NULL,
	suffix VARCHAR,
	degree VARCHAR,
	agency VARCHAR NOT NULL,
	license_num VARCHAR NOT NULL
);

CREATE TABLE organ (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	seller_id INTEGER NOT NULL REFERENCES user,
	organ_type VARCHAR NOT NULL,
	blood_type VARCHAR NOT NULL,
	weight INTEGER UNSIGNED NOT NULL,
	owner_dob DATE NOT NULL,
	description TEXT,

	FOREIGN KEY (seller_id) REFERENCES user (id),
	INDEX (seller_id)
);

CREATE TABLE cart (
	user_id INTEGER PRIMARY KEY REFERENCES user,
	organ_id INTEGER PRIMARY KEY REFERENCES organ,

	FOREIGN KEY (user_id) REFERENCES user (id),
	FOREIGN KEY (organ_id) REFERENCES organ (id),
	INDEX (user_id),
	INDEX (organ_id)
);

CREATE DATABASE airanaDB;

USE airanaDB;

CREATE TABLE Admin (
    aid INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    password VARCHAR(50) NOT NULL);

CREATE TABLE User (
    uid INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(50) NOT NULL UNIQUE, 
    password VARCHAR(50) NOT NULL, 
    email VARCHAR(50) NOT NULL UNIQUE);

CREATE TABLE VacationHome (
    vhid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    startDate DATE NOT NULL,
    endDate DATE NOT NULL
);

CREATE TABLE Review (
    revid INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    review VARCHAR(255),
    rating DECIMAL(2, 1),
    vhid INT NOT NULL,
    FOREIGN KEY (uid) REFERENCES User(uid),
    FOREIGN KEY (vhid) REFERENCES VacationHome(vhid)
);

CREATE TABLE Photo (
    pid INT PRIMARY KEY AUTO_INCREMENT,
    photo VARCHAR(50) NOT NULL,
    vhid INT NOT NULL,
    FOREIGN KEY (vhid) REFERENCES VacationHome(vhid)
);

CREATE TABLE Photo2 (
    vhid INT NOT NULL,
    photo VARCHAR(50) NOT NULL,
    FOREIGN KEY (vhid) REFERENCES VacationHome(vhid)
);

CREATE TABLE Photo3 (
    vhid INT NOT NULL,
    photo VARCHAR(50) NOT NULL,
    FOREIGN KEY (vhid) REFERENCES VacationHome(vhid)
);

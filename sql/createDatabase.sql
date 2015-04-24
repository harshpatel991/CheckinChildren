CREATE TABLE company (
  id INT unique key,
  company_name VARCHAR(50),
  address VARCHAR(50),
  phone VARCHAR(10)
);

CREATE TABLE users (
  id  INT auto_increment unique key,
  email VARCHAR(40),
  password VARCHAR(40), #SHA-1 is 40 characters,
  auth_token VARCHAR(40),
  role ENUM('company', 'manager', 'employee', 'parent')
);

CREATE TABLE facility (
  facility_id INT auto_increment unique key,
  company_id INT,
  address VARCHAR(50),
  phone varchar(10)
);

CREATE TABLE employee (
  id INT unique key,
  emp_name VARCHAR(31),
  facility_id INT
);

CREATE TABLE parent (
  id INT unique key,
  parent_name varchar(30),
  address varchar(50),
  phone_number varchar(10),
  carrier varchar(20),
  contact_pref varchar(30)
);

CREATE TABLE child (
  child_id INT auto_increment unique key,
  parent_id INT,
  facility_id INT,
  child_name varchar(30),
  allergies varchar(50),
  trusted_parties varchar(100),
  last_checkin DATETIME DEFAULT 0,
  last_checkout DATETIME DEFAULT 0,
  expect_checkin VARCHAR(50) DEFAULT '-1,-1,-1,-1,-1,-1,-1',
  expect_checkout VARCHAR(50) DEFAULT '-1,-1,-1,-1,-1,-1,-1',
  last_message_status int default -1
);

CREATE TABLE logs (
  primary_id INT,
  secondary_id INT,
  primary_name varchar(30),
  secondary_name varchar(50),
  facility_id INT,
  transaction_type varchar(100),
  additional_info varchar(100),
  time_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  transaction_id INT auto_increment unique KEY
);
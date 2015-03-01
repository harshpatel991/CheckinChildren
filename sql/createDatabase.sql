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
  phone_number varchar(10)
);

CREATE TABLE child (
  child_id INT auto_increment unique key,
  parent_id INT,
  child_name varchar(30),
  allergies varchar(50),
  facility_id INT
);
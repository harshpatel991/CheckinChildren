CREATE DATABASE `checkin_children` /*!40100 DEFAULT CHARACTER SET latin1 */;
CREATE TABLE company
(
id INT unique key,
address VARCHAR(50),
phone VARCHAR(10)
);

CREATE TABLE users
(
id  INT auto_increment unique key,
pass VARCHAR(50),
role varchar(10)
);

CREATE TABLE day_care_facility
(
company_id INT unique key,
id INT,
address VARCHAR(50),
phone varchar(10)
);

CREATE TABLE employee
(
id INT unique key,
emp_name VARCHAR(30),
facility_id INT
);

CREATE TABLE parent
(
id INT unique key,
parent_name varchar(30),
address varchar(50),
phone_number varchar(10),
email varchar(20)
);

CREATE TABLE child
(
child_id INT auto_increment unique key,
parent_id INT,
child_name varchar(30),
allergies varchar(50)
);

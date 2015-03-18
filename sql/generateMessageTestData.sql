DROP TABLE IF EXISTS company;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS facility;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS parent;
DROP TABLE IF EXISTS child;


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


#Add sample users with SHA-1 hashed passwords
INSERT INTO users(id, email, password, role) VALUES (1, 'company1@checkinchildren.com', 'e38ad214943daad1d64c102faec29de4afe9da3d', 'company'); #password: 'password1'
INSERT INTO users(id, email, password, role) VALUES (2, 'company2@checkinchildren.com', 'e38ad214943daad1d64c102faec29de4afe9da3d', 'company'); #password: 'password1'
INSERT INTO users(id, email, password, role) VALUES (3, 'manager1@checkinchildren.com', 'e38ad214943daad1d64c102faec29de4afe9da3d', 'manager'); #password: 'password1'
INSERT INTO users(id, email, password, role) VALUES (4, 'manager2@checkinchildren.com', 'e38ad214943daad1d64c102faec29de4afe9da3d', 'manager'); #password: 'password1'
INSERT INTO users(id, email, password, role) VALUES (5, 'mwallic2@illinois.edu', 'e38ad214943daad1d64c102faec29de4afe9da3d', 'parent'); #password: 'password1'
INSERT INTO users(id, email, password, role) VALUES (6, 'mcwallick@gmail.com', 'e38ad214943daad1d64c102faec29de4afe9da3d', 'parent'); #password: 'password1'

#Add sample facilities
INSERT INTO facility(facility_id, company_id, address, phone) VALUES (1, 1, '1 Facility Rd. Champaign IL 61820', '1235933945');
INSERT INTO facility(facility_id, company_id, address, phone) VALUES (2, 2, '2 Facility Rd. Champaign IL 61820', '1235933945');

#Add sample companies
INSERT INTO company(id, company_name, address, phone) VALUES (1, 'Company 1', '1 Fake St.\n Champaign IL 61820', '847123456');
INSERT INTO company(id, company_name, address, phone) VALUES (2, 'Company 2','3 Real Blvd.\n Urbana IL 61821', '8474833945');

#Insert manager employees
INSERT INTO employee(id, emp_name, facility_id) VALUES (3, 'Saul Goodman', 1);
INSERT INTO employee(id, emp_name, facility_id) VALUES (4, 'Rick Grimes', 2);

#Insert parents
INSERT INTO parent(id, parent_name, address, phone_number, contact_pref, carrier) VALUES (5, 'Natt Wallick', '123 Fake Ave Champaign IL 61820', '6163895565', 'email,text', 'Sprint');
INSERT INTO parent(id, parent_name, address, phone_number, contact_pref, carrier) VALUES (6, 'Elzabad Kennedy', '456 Real Ave Urbana IL 61820', '6786546789', 'email', 'Boost Mobile');

#Insert children, it has to be 3:00 PM on March 4th (900 minutes)
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (10, 5, 'Late Wallick', 'Dogs', 'Friendly Neighbor', 1, '2015-03-03 13:28:48', '2015-03-03 16:49:30', '870,870,870,870,870,870,870', '1020,1020,1020,1020,1020,1020,1020');
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (11, 6, 'Late Kennedy', 'Dogs', 'Lil Trev', 1, '2015-03-04 12:58:48', '2015-03-03 15:38:30', '780,780,780,780,780,780,780', '880,880,880,880,880,880,880');

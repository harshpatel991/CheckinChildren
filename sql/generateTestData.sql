#Add sample companies
INSERT INTO company(id, company_name, address, phone) VALUES (1, 'Company 1', '1 Fake St.\n Champaign IL 61820', '8471234567');
INSERT INTO company(id, company_name, address, phone) VALUES (3, 'Company 2','3 Real Blvd.\n Urbana IL 61821', '8474833945');
INSERT INTO company(id, company_name, address, phone) VALUES (5, 'Company 3','7 Unreal Blvd.\n Austin TX 78728', '8472031023');

#Add sample users with SHA-1 hashed passwords
INSERT INTO users(id, email, password, role) VALUES (1, 'bigcompany1@gmail.com', 'e38ad214943daad1d64c102faec29de4afe9da3d', 'company'); #password: 'password1'
INSERT INTO users(id, email, password, role) VALUES (2, 'baba_ganush2@gmail.com', '2aa60a8ff7fcd473d321e0146afd9e26df395147', 'employee'); #password: 'password2'
INSERT INTO users(id, email, password, role) VALUES (3, 'bigcompany3@gmail.com', '1119cfd37ee247357e034a08d844eea25f6fd20f', 'company'); #password: 'password3'
INSERT INTO users(id, email, password, role) VALUES (4, 'employee4@gmail.com', 'a1d7584daaca4738d499ad7082886b01117275d8', 'employee'); #password: 'password4'
INSERT INTO users(id, email, password, role) VALUES (5, 'bigcompany5@gmail.com', 'edba955d0ea15fdef4f61726ef97e5af507430c0', 'company'); #password: 'password5'
INSERT INTO users(id, email, password, role) VALUES (6, 'manager6@gmail.com', '6d749e8a378a34cf19b4c02f7955f57fdba130a5', 'manager'); #password: 'password6'
INSERT INTO users(id, email, password, role) VALUES (7, 'bigcompany5@gmail.com', '330ba60e243186e9fa258f9992d8766ea6e88bc1', 'company'); #password: 'password7'
INSERT INTO users(id, email, password, role) VALUES (8, 'parent8@gmail.com','a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2', 'parent'); #password: 'password8'

INSERT INTO users(id, email, password, role) VALUES (9, 'manager9@gmail.com', '024b01916e3eaec66a2c4b6fc587b1705f1a6fc8', 'manager'); #password: 'password9'
INSERT INTO users(id, email, password, role) VALUES (10, 'manager10@gmail.com', 'f68ec41cde16f6b806d7b04c705766b7318fbb1d', 'manager'); #password: 'password10'
INSERT INTO users(id, email, password, role) VALUES (11, 'manager11@gmail.com', 'ddf6c9a1df4d57aef043ca8610a5a0dea097af0b', 'manager'); #password: 'password11'
INSERT INTO users(id, email, password, role) VALUES (12, 'manager12@gmail.com', '10c28f9cf0668595d45c1090a7b4a2ae98edfa58', 'manager'); #password: 'password12'
INSERT INTO users(id, email, password, role) VALUES (13, 'manager13@gmail.com', 'd505832286e2c1d2839f394de89b3af8dc3f8c1f', 'manager'); #password: 'password13'
INSERT INTO users(id, email, password, role) VALUES (14, 'manager14@gmail.com', '89f747bced37a9d8aee5c742e2aea373278eb29f', 'manager'); #password: 'password14'

INSERT INTO users(id, email, password, role) VALUES (15, 'employee15@gmail.com', 'bd021e21c14628faa94d4aaac48c869d6b5d0ec3', 'employee'); #password: 'password15'
INSERT INTO users(id, email, password, role) VALUES (16, 'employee16@gmail.com', '3de778e515e707114b622e769a308d1a2f84052b', 'employee'); #password: 'password16'
INSERT INTO users(id, email, password, role) VALUES (17, 'employee17@gmail.com', 'b9c3d15c70a945d9e308ac763dd254b47c29bc0a', 'employee'); #password: 'password17'
INSERT INTO users(id, email, password, role) VALUES (18, 'employee18@gmail.com', 'e7369527332f65fe86c44d87116801a0f4fbe5d3', 'employee'); #password: 'password18'

INSERT INTO users(id, email, password, role) VALUES (19, 'parent19@gmail.com', '2c30de294b2ca17d5c356645a04ff4d0de832594', 'parent'); #password: 'password19'

#Add sample facilities
INSERT INTO facility(facility_id, company_id, address, phone) VALUES (1, 1, '1 Facility Rd. Champaign IL 61820', '1235933945');
INSERT INTO facility(facility_id, company_id, address, phone) VALUES (2, 1, '2 Facility Rd. Champaign IL 61820', '1235933945');

INSERT INTO facility(facility_id, company_id, address, phone) VALUES (3, 3, '3 Facility Rd. Champaign IL 61820', '1234562343');
INSERT INTO facility(facility_id, company_id, address, phone) VALUES (4, 3, '4 Facility Rd. Champaign IL 61820', '4564854985');

INSERT INTO facility(facility_id, company_id, address, phone) VALUES (5, 5, '5 Facility Rd. Champaign IL 61820', '2942956875');
INSERT INTO facility(facility_id, company_id, address, phone) VALUES (6, 5, '6 Facility Rd. Champaign IL 61820', '6875963921');
INSERT INTO facility(facility_id, company_id, address, phone) VALUES (7, 5, '7 Facility Rd. Champaign IL 61820', '2939949969');

#Insert regular employees
INSERT INTO employee(id, emp_name, facility_id) VALUES (2, 'Matt Wallick', 1);
INSERT INTO employee(id, emp_name, facility_id) VALUES (4, 'Nick Samata', 2);
INSERT INTO employee(id, emp_name, facility_id) VALUES (15,'Elzabad Kennedy' , 3);
INSERT INTO employee(id, emp_name, facility_id) VALUES (16, 'Olzhas Alipov', 4);
INSERT INTO employee(id, emp_name, facility_id) VALUES (17, 'Alex Dahlquist', 5);
INSERT INTO employee(id, emp_name, facility_id) VALUES (18, 'Harsh Patel', 6);

#Insert manager employees
INSERT INTO employee(id, emp_name, facility_id) VALUES (6, 'Bob Dude', 1);
INSERT INTO employee(id, emp_name, facility_id) VALUES (9, 'Rick Grimes', 2);
INSERT INTO employee(id, emp_name, facility_id) VALUES (10, 'Tyrion Lannister', 3);
INSERT INTO employee(id, emp_name, facility_id) VALUES (11, 'Alex Trebeck', 6);
INSERT INTO employee(id, emp_name, facility_id) VALUES (12, 'Princess Bubblegum', 4);
INSERT INTO employee(id, emp_name, facility_id) VALUES (13, 'Saul Goodman', 5);
INSERT INTO employee(id, emp_name, facility_id) VALUES (14, 'Sterling Archer', 6);

#Insert parents
INSERT INTO parent(id, parent_name, address, phone_number, contact_pref, carrier) VALUES (8, 'Big Daddy', '123 Fake Ave Champaign IL 61820', '1234563456', 'text', 'Verizon Wireless');
INSERT INTO parent(id, parent_name, address, phone_number, contact_pref, carrier) VALUES (19, 'Momma Jamma', '456 Real Ave Urbana IL 61820', '6786546789', 'email,text', 'Boost Mobile');

#Insert children
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id) VALUES (2, 8, 'Mark Zuckerberg', 'Peanut Butter', 'Chmiel', 1);
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id) VALUES (3, 8, 'Dawn Summers', 'Vampires', 'Leftlisa74', 2);

INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id) VALUES (0, 19, 'Peter Parker', '', 'Stormin Schwermin', 3);
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (1, 19, 'Ludvig Beethoven', 'Dogs', 'Stocky', 4, '2013-03-02 11:32:48', '2013-03-02 15:49:30', '15,15,15,15,15,15,15', '30,30,30,30,30,30,30');

#Attempting to cover all use cases, it has to be 3:00 PM on March 4th (900 minutes)
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (10, 19, 'Late Parent1', 'Dogs', 'Friendly Neighbor', 5, '2015-03-04 12:58:48', '2015-03-03 15:38:30', '780,780,780,780,780,780,780', '880,880,880,880,880,880,880');
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (9, 19, 'Late Parent2', 'Dogs', 'Lil Trev', 5, '2015-03-04 12:58:48', '2015-03-03 15:38:30', '780,780,780,780,780,780,780', '880,880,880,880,880,880,880');

INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (11, 19, 'Child Expected Later1', 'Dogs', 'Big Mike', 5, '2015-03-03 13:28:48', '2015-03-03 19:49:30', '930,930,930,930,930,930,930', '1200,1200,1200,1200,1200,1200,1200');
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (5, 19, 'Child Expected Later2', 'Dogs', 'Grandma Jane', 5, '2015-03-03 13:28:48', '2015-03-03 19:49:30', '930,930,930,930,930,930,930', '1200,1200,1200,1200,1200,1200,1200');

INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (12, 19, 'Child Missing1', 'Dogs', 'Test adult', 5, '2015-03-03 13:28:48', '2015-03-03 16:49:30', '870,870,870,870,870,870,870', '1020,1020,1020,1020,1020,1020,1020');
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (6, 19, 'Child Missing2', 'Dogs', 'Grandpa Joe', 5, '2015-03-03 13:28:48', '2015-03-03 16:49:30', '870,870,870,870,870,870,870', '1020,1020,1020,1020,1020,1020,1020');

INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (13, 19, 'Child CheckedOut1', 'Dogs', 'Dick Johnson', 5, '2015-03-04 12:15:48', '2015-03-04 14:49:30', '700,700,700,700,700,700,700', '890,890,890,890,890,890,890');
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (7, 19, 'Child CheckedOut2', 'Dogs', 'Peter Joe', 5, '2015-03-04 12:15:48', '2015-03-04 14:49:30', '700,700,700,700,700,700,700', '890,890,890,890,890,890,890');

INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (14, 19, 'Child Pickup Later1', 'Dogs', 'Happy Guy',5, '2015-03-04 14:28:48', '2014-03-03 16:49:30', '870,870,870,870,870,870,870', '1020,1020,1020,1020,1020,1020,1020');
INSERT INTO child(child_id, parent_id, child_name, allergies, trusted_parties, facility_id, last_checkin, last_checkout, expect_checkin, expect_checkout)
VALUES (8, 19, 'Child Pickup Later2', 'Dogs', 'Grandpa Joe', 5, '2015-03-04 14:28:48', '2014-03-03 16:49:30', '870,870,870,870,870,870,870', '1020,1020,1020,1020,1020,1020,1020');

INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "Rick Grimes", null, 2, "Parent Created", "Failed With Error 1");
INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(6, 10, "A Dude", 'Dogs', 2, "Child Checked In", "N/A");
INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(10, 10, "Other Dude", 'Dogs', 3, "Child Checked Out", "N/A");

# Add logs to facilities of company id 5
INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "Frank Underwood", null, 6, "Child Checked In", "Failed With Error 1");
INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "Doug", null, 6, "Child Checked Out", "Failed With Error 1");

INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "Daredevil", null, 6, "Employee Created", "Failed With Error 1");
INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "T-Dog", null, 7, "Parent Created", "Failed With Error 1");
INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "Johnny Bravo", null, 7, "Child Created", "Failed With Error 2");

INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "Dexter", null, 7, "Employee Promoted", "N/A");
INSERT INTO logs(primary_id,secondary_id,primary_name, secondary_name,facility_id,transaction_type, additional_info)
VALUES(9, null, "Rick Grimes", null, 7, "Employee Edited", "Failed With Error 1");
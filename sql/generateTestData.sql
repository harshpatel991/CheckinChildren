#TODO: fix this file so it runs


#Add sample companies
INSERT INTO company(id, address, phone) VALUES (1, '1 Fake St.\n Champaign IL 61820', '847123456');
INSERT INTO company(id, address, phone) VALUES (3, '3 Real Blvd.\n Urbana IL 61821', '8474833945');
INSERT INTO company(id, address, phone) VALUES (5, '7 Unreal Blvd.\n Austin TX 78728', '8472031023');

#Add sample users with SHA-1 hashed passwords

INSERT INTO users(id, pass, role) VALUES (1, 'e38ad214943daad1d64c102faec29de4afe9da3d', 'company'); #password: 'password1'
INSERT INTO users(id, pass, role) VALUES (2, '2aa60a8ff7fcd473d321e0146afd9e26df395147', 'employee'); #password: 'password2'
INSERT INTO users(id, pass, role) VALUES (3, '1119cfd37ee247357e034a08d844eea25f6fd20f', 'company'); #password: 'password3'
INSERT INTO users(id, pass, role) VALUES (4, 'a1d7584daaca4738d499ad7082886b01117275d8', 'employee'); #password: 'password4'
INSERT INTO users(id, pass, role) VALUES (5, 'edba955d0ea15fdef4f61726ef97e5af507430c0', 'company'); #password: 'password5'
INSERT INTO users(id, pass, role) VALUES (6, '6d749e8a378a34cf19b4c02f7955f57fdba130a5', 'manager'); #password: 'password6'
INSERT INTO users(id, pass, role) VALUES (7, '330ba60e243186e9fa258f9992d8766ea6e88bc1', 'company'); #password: 'password7'
INSERT INTO users(id, pass, role) VALUES (8, 'a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2', 'parent'); #password: 'password8'

INSERT INTO users(id, pass, role) VALUES (9, '024b01916e3eaec66a2c4b6fc587b1705f1a6fc8', 'manager'); #password: 'password9'
INSERT INTO users(id, pass, role) VALUES (10, 'f68ec41cde16f6b806d7b04c705766b7318fbb1d', 'manager'); #password: 'password10'
INSERT INTO users(id, pass, role) VALUES (11, 'ddf6c9a1df4d57aef043ca8610a5a0dea097af0b', 'manager'); #password: 'password11'
INSERT INTO users(id, pass, role) VALUES (12, '10c28f9cf0668595d45c1090a7b4a2ae98edfa58', 'manager'); #password: 'password12'
INSERT INTO users(id, pass, role) VALUES (13, 'd505832286e2c1d2839f394de89b3af8dc3f8c1f', 'manager'); #password: 'password13'
INSERT INTO users(id, pass, role) VALUES (14, '89f747bced37a9d8aee5c742e2aea373278eb29f', 'manager'); #password: 'password14'

INSERT INTO users(id, pass, role) VALUES (15, 'bd021e21c14628faa94d4aaac48c869d6b5d0ec3', 'employee'); #password: 'password15'
INSERT INTO users(id, pass, role) VALUES (16, '3de778e515e707114b622e769a308d1a2f84052b', 'employee'); #password: 'password16'
INSERT INTO users(id, pass, role) VALUES (17, 'b9c3d15c70a945d9e308ac763dd254b47c29bc0a', 'employee'); #password: 'password17'
INSERT INTO users(id, pass, role) VALUES (18, 'e7369527332f65fe86c44d87116801a0f4fbe5d3', 'employee'); #password: 'password18'

INSERT INTO users(id, pass, role) VALUES (19, '2c30de294b2ca17d5c356645a04ff4d0de832594', 'parent'); #password: 'password19'


#Add sample facilities
INSERT INTO day_care_facility(facility_id, company_id, address, phone) VALUES (1, 1, '1 Facility Rd. Champaign IL 61820', '1235933945');
INSERT INTO day_care_facility(facility_id, company_id, address, phone) VALUES (2, 1, '2 Facility Rd. Champaign IL 61820', '1235933945');

INSERT INTO day_care_facility(facility_id, company_id, address, phone) VALUES (3, 3, '3 Facility Rd. Champaign IL 61820', '1234562343');
INSERT INTO day_care_facility(facility_id, company_id, address, phone) VALUES (4, 3, '4 Facility Rd. Champaign IL 61820', '4564854985');

INSERT INTO day_care_facility(facility_id, company_id, address, phone) VALUES (5, 5, '5 Facility Rd. Champaign IL 61820', '2942956875');
INSERT INTO day_care_facility(facility_id, company_id, address, phone) VALUES (6, 5, '6 Facility Rd. Champaign IL 61820', '6875963921');
INSERT INTO day_care_facility(facility_id, company_id, address, phone) VALUES (7, 5, '7 Facility Rd. Champaign IL 61820', '2939949969');

#Insert regular employees
INSERT INTO employee(id, emp_name, facility_id) VALUES (2, 'Matt Wallick', 1);
INSERT INTO employee(id, emp_name, facility_id) VALUES (4, 'Nick Samata', 2);
INSERT INTO employee(id, emp_name, facility_id) VALUES (15,'Elzabad Kennedy' , 3);
INSERT INTO employee(id, emp_name, facility_id) VALUES (16, 'Olzhas Alipov', 4);
INSERT INTO employee(id, emp_name, facility_id) VALUES (17, 'Alex Dahlquist', 5);
INSERT INTO employee(id, emp_name, facility_id) VALUES (18, 'Harsh Patel', 6);

#Insert manager employees
INSERT INTO employee(id, emp_name, facility_id) VALUES (6, 'Bob Dude', 6);
INSERT INTO employee(id, emp_name, facility_id) VALUES (9, 'Rick Grimes', 6);
INSERT INTO employee(id, emp_name, facility_id) VALUES (10, 'Tyrion Lanister', 6);
INSERT INTO employee(id, emp_name, facility_id) VALUES (11, 'Alex Trebeck', 6);
INSERT INTO employee(id, emp_name, facility_id) VALUES (12, 'Princess Bubblegum', 6);
INSERT INTO employee(id, emp_name, facility_id) VALUES (13, 'Saul Goodman', 6);
INSERT INTO employee(id, emp_name, facility_id) VALUES (14, 'Sterling Archer', 6);

#Insert parents
INSERT INTO parent(id, parent_name, address, phone_number, email) VALUES (8, 'Big Daddy', '123 Fake Ave Champaign IL 61820', '1234563456', 'bigdaddy@gmail.com' );
INSERT INTO parent(id, parent_name, address, phone_number, email) VALUES (19, 'Momma Jamma', '456 Real Ave Urbana IL 61820', '6786546789', 'mommaJamma@gmail.com');

#Insert children
INSERT INTO child(child_id, parent_id, child_name, allergies) VALUES (2, 8, 'Mark Zuckerberg', 'Peanut Butter');
INSERT INTO child(child_id, parent_id, child_name, allergies) VALUES (3, 8, 'Dawn Summers', 'Vampires');

INSERT INTO child(child_id, parent_id, child_name, allergies) VALUES (0, 19, 'Peter Parker', '');
INSERT INTO child(child_id, parent_id, child_name, allergies) VALUES (1, 19, 'Ludvig Beetoven', 'Dogs');
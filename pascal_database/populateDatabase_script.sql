
use pascal_db;

insert into permission(description, permission) values ("Admin", 666);
insert into permission(description, permission) values ("Reporter", 644);
insert into permission(description, permission) values ("Instructor", 611);

insert into role(role_name, permission_id) values ("Administrator", 1);
insert into role(role_name, permission_id) values ("course co-ordinator", 2);
insert into role(role_name, permission_id) values ("assessment co-ordinator", 2);
insert into role(role_name, permission_id) values ("program co-ordinator", 2);
insert into role(role_name, permission_id) values ("Instructor", 3);

insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("jamesUser", "jamesPass", "James", "Herbermans", "james@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("michaelUser", "michaelPass", "Michale", "Floeser", "michael@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("linUser", "linPass", "lin", "Saiwu", "lin@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("danielUser", "danielPass", "Daniel", "Kennedy", "daniel@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("jamesUser", "jamesPass", "James", "Herbermans", "james@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("vallinoUser", "vallinoPass", "James", "Vallino", "james@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("peterUser", "peterPass", "Peter", "Lutz", "peter@gmail.com", 1);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("jenniferUser", "JenniferPass", "Jennifer", "Wilson", "Jennifer@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("donaldUser", "donaldPass", "Donald", "Strreks", "donald@gmail.com", 5);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("robertUser", "robertPass", "Robert", "Barbato", "robert@gmail.com", 1);


insert into program(program_name, program_objective, program_CoOrdinator) values ("IT", "To become a IT specialist",2);
insert into program(program_name, program_objective, program_CoOrdinator) values ("IB", "To become a business manager",3);

insert into section(section_number, term, Notes,  user_id) values (01, 2, "good class", 1);
insert into section(section_number, term, Notes, user_id) values (02, 2, "students had difficulty", 2);
insert into section(section_number, term, Notes,  user_id) values (03, 2, "good", 3);
insert into section(section_number, term, Notes,  user_id) values (04, 2, "students did well", 1);


insert into assessment(course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, section_id) values ( "php", 84, 60, "good", 1);
insert into assessment(course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, section_id) values ( "java", 77, 60, "ok", 2);
insert into assessment(course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, section_id) values ( "presentation", 69, 60, "bad", 2);
insert into assessment(course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, section_id) values ( "group project", 91, 60, "exciting", 1);
insert into assessment(course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, section_id) values ( "project beer service", 82, 60, "productiv", 3);

insert into course(course_name,  course_number, course_coOrdinator, program_id) values ("Intro to DB and data modelling",230, 1, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("DB connectivity and access", 330, 2, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("DB apps development", 432, 3, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("DB management systems",  320,4, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Web server development and administration", 444,5, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Web and mobile 1",  140,6, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Web and mobile 2",  240,7, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Client programming",  340,8, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Computer problem solving info domain 2", 121,9, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Intro to software engineering", 261,10, 1);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Global marketing", 320, 1,2);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("International marketing", 320, 2, 2);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Management accounting", 210, 1, 2);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Financial management", 220, 4, 2);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Cross cultural management",  300,5,  2);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("Global business environment", 225, 6, 2);
insert into course(course_name,  course_number, course_coOrdinator,program_id) values ("The world of business", 150, 7 ,2);

insert into grade(charGrade, grade) values ('A', 90);
insert into grade(charGrade, grade) values ('B', 80);
insert into grade(charGrade, grade) values ('C', 70);
insert into grade(charGrade, grade) values ('D', 60);
insert into grade(charGrade, grade) values ('F', 59);


insert into course_notes(notes, noteWrittenBy, course_id) values ("this is the first comment", "niksa", 1);
insert into course_notes(notes, noteWrittenBy, course_id) values ("this is the secone comment", "ben", 2);
insert into course_notes(notes, noteWrittenBy, course_id) values ("this is the third comment", "john", 3);
insert into course_notes(notes, noteWrittenBy, course_id) values ("this is the fourth comment", "mario", 4);

insert into course_section(course_id, section_id) values (1,1);
insert into course_section(course_id, section_id) values (2,2);
insert into course_section(course_id, section_id) values (3,1);
insert into course_section(course_id, section_id) values (4,1);
insert into course_section(course_id, section_id) values (5,1);
insert into course_section(course_id, section_id) values (6,1);
insert into course_section(course_id, section_id) values (7,1);
insert into course_section(course_id, section_id) values (8,1);
insert into course_section(course_id, section_id) values (9,2);
insert into course_section(course_id, section_id) values (10,4);
insert into course_section(course_id, section_id) values (11,2);
insert into course_section(course_id, section_id) values (12,2);
insert into course_section(course_id, section_id) values (13,2);
insert into course_section(course_id, section_id) values (14,1);
insert into course_section(course_id, section_id) values (15,1);
insert into course_section(course_id, section_id) values (16,2);
insert into course_section(course_id, section_id) values (17,2);


insert into section_grade(section_id, grade_id) values (2,3);
insert into section_grade(section_id, grade_id) values (1, 2);
insert into section_grade(section_id, grade_id) values (1,4);
insert into section_grade(section_id, grade_id) values (1, 1);
insert into section_grade(section_id, grade_id) values (2,2);
insert into section_grade(section_id, grade_id) values (2,5);
insert into section_grade(section_id, grade_id) values (1, 5);


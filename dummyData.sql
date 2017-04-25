use pascal_finito;
/*
insert into program(program_name, program_objective) values ("IT", "To be able to work in an IT company");
insert into program(program_name, program_objective) values ("IB", "to be a manager");

insert into student(first_name, last_name, uni_year, studentEmail, program_id) values ("Niksa", "Simic", 3, "myEmail@gmail.com", 1);
insert into student(first_name, last_name, uni_year, studentEmail, program_id) values ("Mario", "Simic", 2, "theMarioEmail@gmail.com",2);
insert into student(first_name, last_name, uni_year, studentEmail, program_id) values ("dora", "barbir", 3, "dora@gmail.com", 1);
insert into student(first_name, last_name, uni_year, studentEmail, program_id) values ("andrea", "bajto", 2, "andrea@gmail.com",2);
*/
insert into section(section_number) values(01);
insert into section(section_number) values(02);
insert into section(section_number) values(03);

insert into course(course_name, term, course_number, program_id) values ("server", "2", 470, 1);
insert into course(course_name, term, course_number, program_id) values ("managemant", "2", 350, 2);

insert into course_student(course_id, student_id) values (1, 1);
insert into course_student(course_id, student_id) values (2, 2);
insert into course_student(course_id, student_id) values (1, 3);
insert into course_student(course_id, student_id) values (2, 4);


insert into course_section(course_id, section_id) values (1, 1);
insert into course_section(course_id, section_id) values (1, 2);
insert into course_section(course_id, section_id) values (2, 1);
insert into course_section(course_id, section_id) values (2, 2);

insert into grade(charGrade, grade) values ('A', 90);
insert into grade(charGrade, grade) values ('B+', 85);
insert into grade(charGrade, grade) values ('C+', 75);
insert into grade(charGrade, grade) values ('C', 70);
insert into grade(charGrade, grade) values ('D', 74);
insert into grade(charGrade, grade) values ('B', 82);

insert into grade_student(grade_id, student_id) values (1, 1);
insert into grade_student(grade_id, student_id) values (2, 2);
insert into grade_student(grade_id, student_id) values (1, 3);
insert into grade_student(grade_id, student_id) values (2, 4);
insert into grade_student(grade_id, student_id) values (3, 3);
insert into grade_student(grade_id, student_id) values (4, 1);
/*
insert into course_student(course_id, student_id) values (2, 4);
insert into course_student(course_id, student_id) values (1, 1);
insert into course_student(course_id, student_id) values (2, 2);
insert into course_student(course_id, student_id) values (1, 3);
*/
insert into permission(description, permission) values ("can do all", 666);
insert into permission(description, permission) values ("read and write only", 611);
insert into permission(description, permission) values ("read only", 644);

insert into role(role_name, permission_id) values ("Admin", 1);
insert into role(role_name, permission_id) values ("Instructor", 2);
insert into role(role_name, permission_id) values ("Reporter", 3);

insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("the Username", "thePass", "branko", "mihaljevic", "brank@gmsil.com", 1);
insert into program_user(username, user_password, first_name, last_name, userEmail, role_id) values ("myUsername", "myPass", "kike", "bumbar", "kike@gmsil.com", 2);

insert into user_program(user_id, program_id) values (1, 1);
insert into user_program(user_id, program_id) values (2, 2);

insert into assessment(assessmentName, course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, deadline, course_id) values ("Project", "BeerPrices Project", 72, 70, "the class did very well", 2016/03/03, 1);
insert into assessment(assessmentName, course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, deadline, course_id) values ("presentation", "seminar-nature", 64, 70, "the class did very well", 2016/03/03, 1);
insert into assessment(assessmentName, course_assessment_item, percent_students_achieved_obj, expected_percent_achieved, assessment_notes, deadline, course_id) values ("exam", "javaa", 84, 70, "the class did very well", 2016/03/03, 1);

insert into assessment_student(assessment_id, student_id) values (1, 1);
insert into assessment_student(assessment_id, student_id) values (1, 4);
insert into assessment_student(assessment_id, student_id) values (1, 3);
insert into assessment_student(assessment_id, student_id) values (1, 2);
insert into assessment_student(assessment_id, student_id) values (2, 2);
insert into assessment_student(assessment_id, student_id) values (2, 3);
insert into assessment_student(assessment_id, student_id) values (2, 1);
insert into assessment_student(assessment_id, student_id) values (2, 4);

insert into score(score, assessment_id, student_id) values (77, 1, 1);
insert into score(score, assessment_id, student_id) values (97, 3,2);
insert into score(score, assessment_id, student_id) values (84, 1,3);
insert into score(score, assessment_id, student_id) values (63, 1,4);
insert into score(score, assessment_id, student_id) values (90, 2, 3);
insert into score(score, assessment_id, student_id) values (77, 2, 1);
insert into score(score, assessment_id, student_id) values (55, 1,2);
insert into score(score, assessment_id, student_id) values (88, 2,4);
insert into score(score, assessment_id, student_id) values (71, 1,4);
insert into score(score, assessment_id, student_id) values (70, 2, 3);


/*
BEGIN;

insert into program(program_name) values ("tour");
insert into course(course_name, term,course_number, section, program_id)values("bbb mnagement", "1", 114, 02, 2);
insert into assessment(course_assessment_item, percent_students_achieved_obj, expected_percent_achieved,course_id)values("project1-berr", 60, 70, 2);

COMMIT;*/

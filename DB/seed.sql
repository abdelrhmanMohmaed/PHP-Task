INSERT INTO departments
(`name`)
VALUES 
("Department One"),
("Department Two"),
("Department There");

INSERT  INTO users -- Password = @123456aAqw
(department_id, manager_id, first_name, last_name, email, `password`, phone, salary, avatar)
VALUES
("1",NULL,"Ahmed","Mohamed","ahmed@hotmail.com","$2y$10$mamYEoEA/gr.d3TuusadlO5.3D0yvkG0oE.cCoOgVKM1RqGysVbaG","01623843786",15000.52,"1.avif"),
("1",1,"Mohamed","Ahmed","mohamed@hotmail.com","$2y$10$mamYEoEA/gr.d3TuusadlO5.3D0yvkG0oE.cCoOgVKM1RqGysVbaG","0183843786",1300.00,"1.avif"),

("2",NULL,"Hassan","Ail","hassan@hotmail.com","$2y$10$mamYEoEA/gr.d3TuusadlO5.3D0yvkG0oE.cCoOgVKM1RqGysVbaG","01123843786",5781.20,"1.avif"),
("2",3,"Ail","Hassan","ail@hotmail.com","$2y$10$mamYEoEA/gr.d3TuusadlO5.3D0yvkG0oE.cCoOgVKM1RqGysVbaG","0183843786",1300.00,"1.avif"),

("3",NULL,"Hany","Adel","Hany@hotmail.com","$2y$10$mamYEoEA/gr.d3TuusadlO5.3D0yvkG0oE.cCoOgVKM1RqGysVbaG","01123843786",87523.10,"1.avif"),
("3",5,"Adel","Hany","Adel@hotmail.com","$2y$10$mamYEoEA/gr.d3TuusadlO5.3D0yvkG0oE.cCoOgVKM1RqGysVbaG","0183843786",5623.99,"1.avif");

INSERT INTO tasks 
(`user_id`, created_by, title, `description`, `status`)
VALUES
(2,1,"Title","dasdasdasdasdasdasdasdasd","Pending"),
(2,1,"Title","dasdasdasdasdasdasdasdasd","Pending"),
(2,1,"Title","dasdasdasdasdasdasdasdasd","In Progress"),
(2,1,"Title","dasdasdasdasdasdasdasdasd","In Progress"),
(2,1,"Title","dasdasdasdasdasdasdasdasd","Complete"),
(2,1,"Title","dasdasdasdasdasdasdasdasd","Complete"),

(4,3,"Title","dasdasdasdasdasdasdasdasd","Pending"),
(4,3,"Title","dasdasdasdasdasdasdasdasd","Pending"),
(4,3,"Title","dasdasdasdasdasdasdasdasd","In Progress"),
(4,3,"Title","dasdasdasdasdasdasdasdasd","In Progress"),
(4,3,"Title","dasdasdasdasdasdasdasdasd","Complete"),
(4,3,"Title","dasdasdasdasdasdasdasdasd","Complete"),

(6,5,"Title","dasdasdasdasdasdasdasdasd","Pending"),
(6,5,"Title","dasdasdasdasdasdasdasdasd","Pending"),
(6,5,"Title","dasdasdasdasdasdasdasdasd","In Progress"),
(6,5,"Title","dasdasdasdasdasdasdasdasd","In Progress"),
(6,5,"Title","dasdasdasdasdasdasdasdasd","Complete"),
(6,5,"Title","dasdasdasdasdasdasdasdasd","Complete");


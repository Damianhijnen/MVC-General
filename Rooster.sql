drop database if exists rooster;
create database rooster;
use rooster;




create table `instructorName` (
	ID int primary key not null auto_increment,
    Naam varchar(256) not null
    );
    
create table `instructorEmail` (
	ID int primary key,
    Email varchar(100),
    Naam varchar(256),
    foreign key (Naam) REFERENCES instructorName(Naam) ON DELETE CASCADE ON UPDATE CASCADE,
    foreign key (ID)  REFERENCES instructorName(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

create table `lessen`(
	ID int primary key not null auto_increment,
    Datum DATE not null,
    instructorID int,
    Instructor varchar(100),
	FOREIGN KEY (instructor) REFERENCES instructorEmail(Email) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN key (instructorID)  REFERENCES instructorName(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

create table `Onderwerpen`(
	ID int primary key not null auto_increment,
    LES int not null,
    Onderwerp varchar(100),
	FOREIGN KEY (LES) REFERENCES instructorEmail(Email) ON DELETE CASCADE ON UPDATE CASCADE
);


insert into `instructorName` VALUES(3, 'Groen');
insert into `instructorName` VALUES(4, 'Konijn');
insert into `instructorName` VALUES(6, 'Frasi');

insert into `instructorEmail` VALUES((select ID from instructorName where ID = '3'), 'groen@mail.nl', (select Naam from instructorName where ID = '3'));
insert into `instructorEmail` VALUES((select ID from instructorName where ID = '4'), 'konijn@mail.nl', (select Naam from instructorName where ID = '4'));
insert into `instructorEmail` VALUES((select ID from instructorName where ID = '6'), 'frasi@mail.nl', (select Naam from instructorName where ID = '6'));



insert into `lessen` VALUES(45, DATE('2022/05/20') , (select ID from `instructorName` where ID = '3'),  (select Naam from instructorEmail where Naam = 'Groen'));
insert into `lessen` VALUES(46, DATE('2022/05/20') , (select ID from `instructorName` where ID = '6'),  (select Naam from instructorEmail where Naam = 'Frasi'));
insert into `lessen` VALUES(47, DATE('2022/05/21') , (select ID from `instructorName` where ID = '4'),  (select Naam from instructorEmail where Naam = 'Konijn'));
insert into `lessen` VALUES(48, DATE('2022/05/21') , (select ID from `instructorName` where ID = '6'),  (select Naam from instructorEmail where Naam = 'Frasi'));
insert into `lessen` VALUES(49, DATE('2022/05/22') , (select ID from `instructorName` where ID = '3'),  (select Naam from instructorEmail where Naam = 'Groen'));
insert into `lessen` VALUES(50, DATE('2022/05/28') , (select ID from `instructorName` where ID = '4'),  (select Naam from instructorEmail where Naam = 'Konijn'));
insert into `lessen` VALUES(51, DATE('2022/06/01') , (select ID from `instructorName` where ID = '3'),  (select Naam from instructorEmail where Naam = 'Groen'));
insert into `lessen` VALUES(52, DATE('2022/06/12') , (select ID from `instructorName` where ID = '3'),  (select Naam from instructorEmail where Naam = 'Groen'));
insert into `lessen` VALUES(53, DATE('2022/06/22') , (select ID from `instructorName` where ID = '3'),  (select Naam from instructorEmail where Naam = 'Groen'));

insert into `Onderwerpen` VALUES(2343, (select ID from `lessen` where ID = '45'),  'File Parkeren');
insert into `Onderwerpen` VALUES(2344, (select ID from `lessen` where ID = '46'),  'Achteruit Rijden');
insert into `Onderwerpen` VALUES(2345, (select ID from `lessen` where ID = '49'),  'File parkeren');
insert into `Onderwerpen` VALUES(2346, (select ID from `lessen` where ID = '49'),  'Invoegen snelweg');
insert into `Onderwerpen` VALUES(2347, (select ID from `lessen` where ID = '50'),  'Achteruit rijden');
insert into `Onderwerpen` VALUES(2348, (select ID from `lessen` where ID = '52'),  'Achteruit rijden');
insert into `Onderwerpen` VALUES(2349, (select ID from `lessen` where ID = '52'),  'Invoegen snelweg');
insert into `Onderwerpen` VALUES(2350, (select ID from `lessen` where ID = '52'),  'File Parkeren');





select * from InstructorEmail;
select * from InstructorName;
SELECT * FROM lessen;


    


show table status;


    
    
    
    use rooster;
    
    select * from lessen;
    
    
 --   DESCRIBE lessen;


-- Inner left and right joins zijn om data te mergen

SELECT instructorName.ID, instructorName.Naam
FROM instructorName
INNER JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;

SELECT instructorName.ID, instructorName.Naam
FROM instructorName
left JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;

SELECT instructorName.ID, instructorName.Naam
FROM instructorName
right JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;

SELECT *
FROM instructorName
left JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;

SELECT *
FROM instructorName
right JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;

SELECT *
FROM instructorName
inner JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;



-- Full and self join attempts

SELECT *
FROM instructorName
full JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;

SELECT *
FROM instructorName, instructorEmail
where instructorName.ID=instructorEmail.ID;



-- Advaned left right join
SELECT instructorName.ID, instructorName.Naam, instructorEmail.Email
FROM instructorName
right JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;


SELECT instructorName.ID, instructorName.Naam, instructorEmail.Email
FROM instructorName
left JOIN instructorEmail ON instructorName.ID=instructorEmail.ID;


-- Triple join
select * from instructorName;
select * from instructorEmail;
select * from lessen;

SELECT instructorName.ID, instructorName.Naam, instructorEmail.Email, lessen.Datum
FROM instructorName
left JOIN instructorEmail ON instructorName.ID=instructorEmail.ID
left JOIN lessen ON instructorName.ID=instructorID;


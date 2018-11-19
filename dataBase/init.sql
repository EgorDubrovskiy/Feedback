IF db_id('Feedback') IS NOT NULL
BEGIN DROP DATABASE Feedback END
GO
create database Feedback
GO
USE Feedback
GO

--types and rules
CREATE RULE srcRule AS @a like '%.png' or @a like '%.jpg' or @a like '%.jpeg'
GO

--tables begin
create table Admins(
id int not null identity primary key,
login varchar(30) not null UNIQUE,
password varchar(100) not null)

create table Messages(
id int not null identity primary key,
name varchar(50) not null,
email varchar(50) not null,
text varchar(200) not null,
photo varchar(259) not null,
date datetime not null default getdate()
)
EXEC sp_bindrule srcRule, 'Messages.photo'
CREATE INDEX MessageIndex ON Messages (name, email, date)
GO
--tables end

--procedures begin
--get
go
CREATE PROCEDURE GetMessages
AS
	SELECT * FROM Messages ORDER BY date DESC
GO

--add
CREATE PROCEDURE AddMessage(@name varchar(50), @email varchar(50), @text varchar(200), @photo varchar(259))
AS 
	INSERT INTO Messages(name,email,text,photo) values(@name,@email,@text,@photo)
GO

--delete
CREATE PROCEDURE DeleteMessage(@id int)
AS
	Delete FROM Messages where id = @id
GO
--procedures end

--filling
INSERT INTO Admins(login,password) VALUES('admin','50e3ba1079d6230dce7f98d5e7910e91')--password = md5(123 + salt)
GO
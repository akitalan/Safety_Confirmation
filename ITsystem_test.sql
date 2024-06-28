CREATE TABLE EMPLOYEE01(
    EMP_NO varchar(7),
    Name varchar(30) NOT NULL,
    Dep_NO CHAR(3) NOT NULL,
    Birthday DATE,
    address_No INT(1),

    PRIMARY KEY(EMP_NO)
);

CREATE TABLE Confirm_Safety (
    EMP_NO varchar(7),
    STATE INT(1) NOT NULL DEFAULT 0,
    COMMENT varchar(50) DEFAULT NULL,

    PRIMARY KEY(EMP_NO) 
);

CREATE TABLE Password(
    EMP_NO char(7),
    Password_Value varchar(255) NOT NULL,

    PRIMARY KEY(EMP_NO)
);

CREATE TABLE Department(
    Dep_NO CHAR(3),
    Dep_Name varchar(10) UNIQUE,

    PRIMARY KEY(Dep_NO)
);

CREATE TABLE Edit(
    EMP_NO varchar(7),
    Edit_Right INT(1) DEFAULT NULL,

    PRIMARY KEY(EMP_NO)
);

CREATE TABLE Visit(
    EMP_NO varchar(7),
    Visit_No INT(1) DEFAULT NULL,

    PRIMARY KEY(EMP_NO) 
);

CREATE TABLE region(
    region_No INT(1),
    region_Name CHAR(3),
    damage_area INT(1) DEFAULT 0,

    PRIMARY KEY(region_No)
);


INSERT INTO EMPLOYEE01
VALUE 
('2230001','A太郎','001','2002-01-01',1),
('2230002','B太郎','001','2002-01-02',1),
('2230003','C太郎','002','2002-01-03',2),
('2230004','D太郎','003','2002-01-04',3),
('2230005','E太郎','004','2002-01-05',4),
('2230006','F太郎','005','2002-01-06',5),
('2230007','G太郎','001','2002-01-07',6),
('2230008','H太郎','002','2002-01-08',7),
('2230009','I太郎','003','2002-01-09',8),
('2230010','J太郎','004','2002-01-10',1),
('2230011','K太郎','005','2002-01-11',2),
('2230012','L太郎','001','2002-01-12',3),
('2230013','M太郎','002','2002-01-13',4),
('2230014','N太郎','003','2002-01-14',5),
('2230015','O太郎','004','2002-01-15',6),
('2230016','P太郎','005','2002-01-16',7),
('2230017','Q太郎','001','2002-01-17',8),
('2230018','R太郎','002','2002-01-18',1),
('2230019','S太郎','003','2002-01-19',2),
('2230020','T太郎','004','2002-01-20',3),
('2230021','U太郎','005','2002-01-21',4),
('2230022','V太郎','001','2002-01-22',5),
('2230023','W太郎','002','2002-01-23',6),
('2230024','X太郎','003','2002-01-24',7),
('2230025','Y太郎','004','2002-01-25',8),
('2230026','Z太郎','005','2002-01-26',1);

INSERT INTO Confirm_Safety
VALUE 
('2230001',0,NULL),
('2230002',2,NULL),
('2230003',1,NULL),
('2230004',0,NULL),
('2230005',0,NULL),
('2230006',2,NULL),
('2230007',1,NULL),
('2230008',0,NULL),
('2230009',0,NULL),
('2230010',2,NULL),
('2230011',1,NULL),
('2230012',0,NULL),
('2230013',0,NULL),
('2230014',2,NULL),
('2230015',1,NULL),
('2230016',0,NULL),
('2230017',0,NULL),
('2230018',2,NULL),
('2230019',1,NULL),
('2230020',0,NULL),
('2230021',0,NULL),
('2230022',2,NULL),
('2230023',1,NULL),
('2230024',0,NULL),
('2230025',1,NULL),
('2230026',0,NULL);


INSERT INTO Department
VALUE 
('001','総務部'),
('002','人事部'),
('003','経理部'),
('004','ITシステム部'),
('005','企画部');

INSERT INTO Edit
VALUE 
('2230001',1),
('2230002',1),
('2230003',1),
('2230004',1),
('2230005',1),
('2230006',1);

INSERT INTO Visit
VALUE 
('2230003',1),
('2230006',2),
('2230009',3),
('2230012',4),
('2230015',5),
('2230018',6),
('2230021',7),
('2230024',8);

INSERT INTO region (region_No, region_Name)
VALUE 
(0,"全体"),
(1,"北海道"),
(2,"東北"),
(3,"関東"),
(4,"中部"),
(5,"近畿"),
(6,"中国"),
(7,"四国"),
(8,"九州");

commit;
/************************************************************ 

	This SQL Script was tested on GCP phpMyAdmin.
	To run, simply import the script.
	
************************************************************/

-- This will remove a database with the same name if it already exists
DROP DATABASE IF EXISTS `internit`;
CREATE DATABASE IF NOT EXISTS `internit`;
USE `internit`;


/************************************************************ 
	Part A - Create tables and Constraints
************************************************************/

-- TABLE 1.
-- LOCATIONS Table definition and state
-- This table stores data about the locations in which jobs are available.
CREATE TABLE LOCATIONS
(
    LocationId     	 	INTEGER         	NOT NULL    PRIMARY KEY,
	Country				VARCHAR(160)		NOT NULL 	DEFAULT 'USA',	
	State_Region		VARCHAR(160)
);


-- TABLE 2.
-- JOB_SKILLS Table definition and state
-- This table stores data about the job skills that a user has or a job requires.
CREATE TABLE JOB_SKILLS
(
    KSAnum         		INTEGER             NOT NULL        PRIMARY KEY,
    Skills 				VARCHAR(120)
);


-- TABLE 3.
-- BENEFITS Table definition and state
-- This table stores data about the benefits that a job may have.
CREATE TABLE BENEFITS
(
    BenefitId          	INTEGER        		NOT NULL        PRIMARY KEY,
    HealthInsurance     VARCHAR(3)			NOT NULL		DEFAULT 'no',       
    VisionInsurance     VARCHAR(3) 			NOT NULL		DEFAULT 'no',   
    DentalInsurance     VARCHAR(3) 			NOT NULL		DEFAULT 'no',   
    PTO			        VARCHAR(3)			NOT NULL		DEFAULT 'no',   		
    SickLeave		    VARCHAR(3)			NOT NULL		DEFAULT 'no'   		
);


-- TABLE 4.
-- JOB_ADS Table definition and state
-- This table stores data about available jobs.
CREATE TABLE JOB_ADS
(
    JobNum     			INTEGER        		NOT NULL    	PRIMARY KEY,
    Title       		VARCHAR(160)   		NOT NULL,
    Company    			VARCHAR(160)    	NOT NULL,
	Location			INTEGER				DEFAULT 1,
	JobType    			VARCHAR(160),
	BenefitNo			INTEGER,
	TimeCommit			INTEGER,
	Salary				INTEGER,			
	Description			VARCHAR(160),
	URL					VARCHAR(160)
);


-- TABLE 5.
-- REMINDERS Table definition and state
-- This table stores data about the available messages that can be sent to a user.
CREATE TABLE REMINDERS
(
    MsgId         		INTEGER         	NOT NULL        PRIMARY KEY,
    Message         	VARCHAR(200)    	NOT NULL
);


-- TABLE 6.
-- DEGREE_STATUS  Table definition and state
-- This table stores data all the possible degree status.
CREATE TABLE DEGREE_STATUS  
(
    DegreeID      		INTEGER         	NOT NULL       	PRIMARY KEY,
    Degree           	VARCHAR(160)        NOT NULL
);


-- TABLE 7.
-- INTEREST_AREA  Table definition and state
-- This table stores data about all possible interest areas.
CREATE TABLE INTEREST_AREA 
(
    InterestId      	INTEGER         	NOT NULL       	PRIMARY KEY,
    Interest          	VARCHAR(160)        NOT NULL
);


-- TABLE 8.
-- TRAINING_TYPE Table definition and state
-- This table stores data about the training options for the users.
CREATE TABLE TRAINING_TYPE
(
    TrainingId      	INTEGER         	NOT NULL      	PRIMARY KEY,
    Training        	VARCHAR(200)    	NOT NULL
);


-- TABLE 9.
-- APPLICANTS Table definition and state
-- This table stores data about the applicants/users.
CREATE TABLE APPLICANTS
(
    ApplicantId    		INTEGER         	NOT NULL    	AUTO_INCREMENT  PRIMARY KEY ,
    FName         		VARCHAR(120),
	LName         		VARCHAR(120),
	DOB    				DATE,
	Age					INTEGER,
	PhoneNumber			VARCHAR(12),
	Degree_Status		INTEGER,
	PreferredLocation 	INTEGER				DEFAULT 1,
	Password			VARCHAR(120)		NOT NULL,
	Email				VARCHAR(120)		NOT NULL
);


-- TABLE 10.
-- REMINDERS_SENT  Table definition and state
-- This table stores log data about messages sent to the users.
CREATE TABLE REMINDERS_SENT  
(
    MsgLog       		INTEGER         	NOT NULL		PRIMARY KEY,
    UserId           	INTEGER,
    MsgId            	INTEGER,
	DateSent			DATE
);


-- TABLE 11.
-- TRAINING_LOG Table definition and state
-- This table stores log data about the trainings that a user has completed.
CREATE TABLE TRAINING_LOG
(
    TrainLog        	INTEGER         	NOT NULL        PRIMARY KEY,
    UserId         		INTEGER,
	TrainID				INTEGER,
    DateTrained   		DATE
);

-- TABLE 12.
-- INTEREST_LOG  Table definition and state
-- This table stores data about all possible interest areas.
CREATE TABLE INTEREST_LOG 
(
    UserID      		INTEGER         	NOT NULL,
    InterestID      	INTEGER        		NOT NULL
);


-- TABLE 13.
-- KSA_JOB Table definition and state
-- This is a look-up table for the jobs and associated KSAs.
CREATE TABLE KSA_JOB
(
    KLogId          	INTEGER         	NOT NULL,
	JobNo				INTEGER         	NOT NULL
);


-- TABLE 14.
-- KSA_APPLICANT Table definition and state
-- This is a look-up table for the applicants and associated KSAs.
CREATE TABLE KSA_APPLICANT
(
    KLogId          	INTEGER         	NOT NULL,
	ApplicantId			INTEGER         	NOT NULL
);


/* To drop a FOREIGN KEY Constraint in phpMyAdmin
ALTER TABLE KSA_LOG DROP FOREIGN KEY KSA_LOG_JOB_SKILLS1 */

/* Add the constraints for the primary key sets. */
ALTER TABLE INTEREST_LOG	ADD PRIMARY KEY (UserId, InterestId);
ALTER TABLE KSA_JOB			ADD PRIMARY KEY (KLogId, JobNo);
ALTER TABLE KSA_APPLICANT	ADD PRIMARY KEY (KLogId, ApplicantId);

/* Add the constraints for FK and ON DELETE and On Update Here */
ALTER TABLE KSA_JOB 		ADD CONSTRAINT KSA_JOB_JOB_SKILLS				FOREIGN KEY (KLogId) 				REFERENCES JOB_SKILLS(KSAnum) 			ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE KSA_JOB 		ADD CONSTRAINT KSA_JOB_JOB_ADS					FOREIGN KEY (JobNo) 				REFERENCES JOB_ADS(JobNum) 				ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE KSA_APPLICANT 	ADD CONSTRAINT KSA_APPLICANT_JOB_SKILLS 		FOREIGN KEY (KLogId) 				REFERENCES JOB_SKILLS(KSAnum) 			ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE KSA_APPLICANT 	ADD CONSTRAINT KSA_APPLICANT_APPLICANTS			FOREIGN KEY (ApplicantId) 			REFERENCES APPLICANTS(ApplicantId) 		ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE JOB_ADS 		ADD CONSTRAINT JOB_ADS_LOCATIONS				FOREIGN KEY (Location) 				REFERENCES LOCATIONS(LocationId)		ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE JOB_ADS 		ADD CONSTRAINT JOB_ADS_BENEFITS					FOREIGN KEY (BenefitNo)				REFERENCES BENEFITS(BenefitId)			ON DELETE SET NULL 	ON UPDATE NO ACTION;

ALTER TABLE APPLICANTS 		ADD CONSTRAINT APPLICANTS_LOCATIONS 			FOREIGN KEY (PreferredLocation) 	REFERENCES LOCATIONS(LocationId)		ON DELETE NO ACTION	ON UPDATE NO ACTION;	
ALTER TABLE APPLICANTS 		ADD CONSTRAINT APPLICANTS_DEGREE_STATUS 		FOREIGN KEY (Degree_Status) 		REFERENCES DEGREE_STATUS(DegreeID)		ON DELETE SET NULL 	ON UPDATE NO ACTION; 

ALTER TABLE REMINDERS_SENT 	ADD CONSTRAINT REMINDERS_SENT_REMINDER 			FOREIGN KEY (MsgId) 				REFERENCES REMINDERS(MsgId)				ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE REMINDERS_SENT 	ADD CONSTRAINT REMINDERS_SENT_APPLICANTS 		FOREIGN KEY (UserId) 				REFERENCES APPLICANTS(ApplicantId)		ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE TRAINING_LOG 	ADD CONSTRAINT TRAINING_LOG_SENT_REMINDER 		FOREIGN KEY(TrainID) 				REFERENCES TRAINING_TYPE(TrainingId)	ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE TRAINING_LOG 	ADD CONSTRAINT TRAINING_LOG_SENT_APPLICANTS 	FOREIGN KEY(UserId) 				REFERENCES APPLICANTS(ApplicantId)		ON DELETE NO ACTION	ON UPDATE NO ACTION;

ALTER TABLE INTEREST_LOG 	ADD CONSTRAINT INTEREST_LOG_INTEREST_AREA 		FOREIGN KEY(InterestId) 			REFERENCES INTEREST_AREA(InterestId)	ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE INTEREST_LOG 	ADD CONSTRAINT INTEREST_LOG_APPLICANTS 			FOREIGN KEY(UserId) 				REFERENCES APPLICANTS(ApplicantId)		ON DELETE NO ACTION	ON UPDATE NO ACTION;

ALTER TABLE JOB_ADS 		ADD CONSTRAINT SalaryCheck 		CHECK ( NOT EXISTS ( SELECT * FROM JOB_ADS 		WHERE  Salary < 0));
ALTER TABLE APPLICANTS		ADD CONSTRAINT AgeCheck 		CHECK ( NOT EXISTS ( SELECT * FROM APPLICANTS 	WHERE  Age >= 18));
ALTER TABLE BENEFITS		ADD CONSTRAINT HealthInsCheck 	CHECK ( NOT EXISTS ( SELECT * FROM BENEFITS 	WHERE HealthInsurance = 'yes' or HealthInsurance = 'no'));
ALTER TABLE BENEFITS		ADD CONSTRAINT VisionInsCheck 	CHECK ( NOT EXISTS ( SELECT * FROM BENEFITS 	WHERE VisionInsurance = 'yes' or VisionInsurance = 'no'));
ALTER TABLE BENEFITS		ADD CONSTRAINT DentalInsCheck 	CHECK ( NOT EXISTS ( SELECT * FROM BENEFITS 	WHERE DentalInsurance = 'yes' or DentalInsurance = 'no'));
ALTER TABLE BENEFITS	 	ADD CONSTRAINT PTOCheck 		CHECK ( NOT EXISTS ( SELECT * FROM BENEFITS	 	WHERE PTO = 'yes' or PTO = 'no'));
ALTER TABLE BENEFITS		ADD CONSTRAINT SickLeaveCheck 	CHECK ( NOT EXISTS ( SELECT * FROM BENEFITS 	WHERE SickLeave = 'yes' or SickLeave = 'no'));







/************************************************************ 
 ************************************************************ 
 ************************************************************ 
	Part B - Inserts
 ************************************************************ 
 ************************************************************ 
 ************************************************************/

-- Sample data for LOCATIONS  table
-- Summary: store data about locations of the jobs 

INSERT INTO LOCATIONS VALUES ('1', 'USA', 'WA');
INSERT INTO LOCATIONS VALUES ('2', 'USA', 'FL'); 
INSERT INTO LOCATIONS VALUES ('3', 'USA', 'OH');
INSERT INTO LOCATIONS VALUES ('4', 'USA', 'TX');
INSERT INTO LOCATIONS VALUES ('5', 'USA', 'HI'); 
INSERT INTO LOCATIONS VALUES ('6', 'USA', 'AK');
INSERT INTO LOCATIONS VALUES ('7', 'USA', 'NV');
INSERT INTO LOCATIONS VALUES ('8', 'Canada', 'AB'); 
INSERT INTO LOCATIONS VALUES ('9', 'Canada', 'BC');
INSERT INTO LOCATIONS VALUES ('10', 'UK', 'CUL'); 

-- Sample data for JOB_SKILLS  table
-- Summary: store data about possible job skills required 
-- 			by a job or that an applicant has. 
INSERT INTO JOB_SKILLS VALUES ('1', 'Java');
INSERT INTO JOB_SKILLS VALUES ('2', 'JavaScript'); 
INSERT INTO JOB_SKILLS VALUES ('3', 'Python');
INSERT INTO JOB_SKILLS VALUES ('4', 'C/C++'); 
INSERT INTO JOB_SKILLS VALUES ('5', 'Ruby');
INSERT INTO JOB_SKILLS VALUES ('6', 'HTML');
INSERT INTO JOB_SKILLS VALUES ('7', 'CSS'); 
INSERT INTO JOB_SKILLS VALUES ('8', 'SQL');
INSERT INTO JOB_SKILLS VALUES ('9', 'Kotlin'); 
INSERT INTO JOB_SKILLS VALUES ('10', 'PHP');


-- Sample data for BENEFITS  table
-- Summary: store data about all possible combination of benefits 
-- 			that a company may offer

INSERT INTO BENEFITS VALUES ('0', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes');
INSERT INTO BENEFITS VALUES ('1', 'Yes', 'Yes', 'Yes', 'Yes', 'No');
INSERT INTO BENEFITS VALUES ('2', 'Yes', 'Yes', 'Yes', 'No', 'Yes'); 
INSERT INTO BENEFITS VALUES ('3', 'Yes', 'Yes', 'Yes', 'No', 'No');
INSERT INTO BENEFITS VALUES ('4', 'Yes', 'Yes', 'No', 'Yes', 'Yes'); 
INSERT INTO BENEFITS VALUES ('5', 'Yes', 'Yes', 'No', 'Yes', 'No');
INSERT INTO BENEFITS VALUES ('6', 'Yes', 'Yes', 'No', 'No', 'Yes');
INSERT INTO BENEFITS VALUES ('7', 'Yes', 'Yes', 'No', 'No', 'No'); 
INSERT INTO BENEFITS VALUES ('8', 'Yes', 'No', 'Yes', 'Yes', 'Yes');
INSERT INTO BENEFITS VALUES ('9', 'Yes', 'No', 'Yes', 'Yes', 'No'); 
INSERT INTO BENEFITS VALUES ('10', 'Yes', 'No', 'Yes', 'No', 'Yes');
INSERT INTO BENEFITS VALUES ('11', 'Yes', 'No', 'Yes', 'No', 'No');
INSERT INTO BENEFITS VALUES ('12', 'Yes', 'No', 'No', 'Yes', 'Yes');
INSERT INTO BENEFITS VALUES ('13', 'Yes', 'No', 'Yes', 'No', 'No');
INSERT INTO BENEFITS VALUES ('14', 'Yes', 'No', 'No', 'No', 'Yes');
INSERT INTO BENEFITS VALUES ('15', 'Yes', 'No', 'No', 'No', 'No');
INSERT INTO BENEFITS VALUES ('16', 'No', 'Yes', 'Yes', 'Yes', 'Yes');
INSERT INTO BENEFITS VALUES ('17', 'No', 'Yes', 'Yes', 'Yes', 'No');
INSERT INTO BENEFITS VALUES ('18', 'No', 'Yes', 'Yes', 'No', 'Yes'); 
INSERT INTO BENEFITS VALUES ('19', 'No', 'Yes', 'Yes', 'No', 'No');
INSERT INTO BENEFITS VALUES ('20', 'No', 'Yes', 'No', 'Yes', 'Yes'); 
INSERT INTO BENEFITS VALUES ('21', 'No', 'Yes', 'No', 'Yes', 'No');
INSERT INTO BENEFITS VALUES ('22', 'No', 'Yes', 'No', 'No', 'Yes');
INSERT INTO BENEFITS VALUES ('23', 'No', 'Yes', 'No', 'No', 'No'); 
INSERT INTO BENEFITS VALUES ('24', 'No', 'No', 'Yes', 'Yes', 'Yes');
INSERT INTO BENEFITS VALUES ('25', 'No', 'No', 'Yes', 'Yes', 'No'); 
INSERT INTO BENEFITS VALUES ('26', 'No', 'No', 'Yes', 'No', 'Yes');
INSERT INTO BENEFITS VALUES ('27', 'No', 'No', 'Yes', 'No', 'No');
INSERT INTO BENEFITS VALUES ('28', 'No', 'No', 'No', 'Yes', 'Yes');
INSERT INTO BENEFITS VALUES ('29', 'No', 'No', 'Yes', 'No', 'No');
INSERT INTO BENEFITS VALUES ('30', 'No', 'No', 'No', 'No', 'Yes');
INSERT INTO BENEFITS VALUES ('31', 'No', 'No', 'No', 'No', 'No');


-- Sample data for JOB_ADS  table
-- Summary: Each tuple stores information related to an advertised job.
INSERT INTO JOB_ADS VALUES ('1', 'Software Engineering Internship', 'Amazon', '1', 'entry-level internship', '11', '40', '75000', 'Work on real projects as part of the Amazon Team', 'amazon.jobs');
INSERT INTO JOB_ADS VALUES ('2', 'Aerospace Engineering Internship', 'SpaceX', '4', 'high-level internship', '0', '40', '97000', 'Build Rockets', 'spacex.com'); 
INSERT INTO JOB_ADS VALUES ('3', 'Back End Programmer', 'ebay', '2', 'entry-level', '29', '35', '64000', 'help improve our website!', 'ebay.com');
INSERT INTO JOB_ADS VALUES ('4', 'AI Research Internship', 'Microsoft', '10', 'mid-level internship', '8', '40', '80000', 'Help design the future of AI', 'microsoft.com'); 
INSERT INTO JOB_ADS VALUES ('5', 'Full Stack Dev', 'Sound Credit Union', '1', 'entry-level', '17', '40', '75000', 'Updates and maintains entire banking system', 'soundcu.com');
INSERT INTO JOB_ADS VALUES ('6', 'Full Stack Dev', 'Tech 100', '7', 'high-level', '13', '45', '95000', 'ensures cohesion between web and database', 'uw.edu');
INSERT INTO JOB_ADS VALUES ('7', 'Database Systems Manager', 'AWS', '1', 'high-level', '11', '40', '120000', 'Manages our database', 'amazon.jobs');
INSERT INTO JOB_ADS VALUES ('8', 'Machine Learning Internship', 'Oxford-tech', '10', 'high-level', '9', '40', '70000', 'Work on exciting projects involving machine learning', 'oxfordtechnology.com'); 
INSERT INTO JOB_ADS VALUES ('9', 'Computer Physics Engineer', 'NASA', '4', 'high-level', '6', '40', '80000', 'Work with computers to simulate test flights', 'nasa.gov');
INSERT INTO JOB_ADS VALUES ('10', 'Network Manager', 'Bank of America', '2', 'mid-level', '7', '40', '92000', 'Updates and monitors transfers network wide', 'bankofamerica.com');  


-- Sample data for REMINDERS  table
-- Summary: Each tuple stores a message that can be sent to a user.
INSERT INTO REMINDERS VALUES ('1', 'Remember to share the site with your friends!');
INSERT INTO REMINDERS VALUES ('2', 'We need some extra infromation to help find the right opportuinity for you'); 
INSERT INTO REMINDERS VALUES ('3', 'An employer has reached out to invite you to interview!');
INSERT INTO REMINDERS VALUES ('4', 'We have found a position that fits your experiance and needs!'); 
INSERT INTO REMINDERS VALUES ('5', 'How has your experiance been on our website? Please consider giving us a rating on the homepage');
INSERT INTO REMINDERS VALUES ('6', 'Confirm your email address');
INSERT INTO REMINDERS VALUES ('7', 'You\'ll get a job!'); 
INSERT INTO REMINDERS VALUES ('8', 'Don\'t for get to rest and enjoy life.');
INSERT INTO REMINDERS VALUES ('9', 'test reminder'); 
INSERT INTO REMINDERS VALUES ('10', 'This is an automated message to test the reminder system, please disregard');

-- Sample data for DEGREE_STATUS  table
-- Summary: Each tuple stores a educational status.
INSERT INTO DEGREE_STATUS  VALUES ('1', 'High School Diploma');
INSERT INTO DEGREE_STATUS  VALUES ('2', 'Associate of Arts'); 
INSERT INTO DEGREE_STATUS  VALUES ('3', 'Associate of Science');
INSERT INTO DEGREE_STATUS  VALUES ('4', 'Bachelor of Arts'); 
INSERT INTO DEGREE_STATUS  VALUES ('5', 'Bachelor of Science');
INSERT INTO DEGREE_STATUS  VALUES ('6', 'Master of Arts'); 
INSERT INTO DEGREE_STATUS  VALUES ('7', 'Master of Sciece');
INSERT INTO DEGREE_STATUS  VALUES ('8', 'PhD'); 
INSERT INTO DEGREE_STATUS  VALUES ('9', 'Technical Degree');
INSERT INTO DEGREE_STATUS  VALUES ('10', 'Certificate');


-- Sample data for INTEREST_AREA  table
-- Summary: Each tuple stores an area that an applicant might be interested in working.
INSERT INTO INTEREST_AREA  VALUES ('1', 'Machine Learning');
INSERT INTO INTEREST_AREA  VALUES ('2', 'Artificial Intelligence'); 
INSERT INTO INTEREST_AREA  VALUES ('3', 'Front End');
INSERT INTO INTEREST_AREA  VALUES ('4', 'Back End'); 
INSERT INTO INTEREST_AREA  VALUES ('5', 'Full Stack');
INSERT INTO INTEREST_AREA  VALUES ('6', 'Algorithms'); 
INSERT INTO INTEREST_AREA  VALUES ('7', 'Architecture');
INSERT INTO INTEREST_AREA  VALUES ('8', 'Natural Language Processing'); 
INSERT INTO INTEREST_AREA  VALUES ('9', 'Database Systems');
INSERT INTO INTEREST_AREA  VALUES ('10', 'Network Systems'); 



-- Sample data for TRAINING_TYPE  table
-- Summary: Each tuple stores an area that an applicant has been trained in.
INSERT INTO TRAINING_TYPE  VALUES ('1', 'SQL');
INSERT INTO TRAINING_TYPE  VALUES ('2', 'JAVA'); 
INSERT INTO TRAINING_TYPE  VALUES ('3', 'Algroithms');
INSERT INTO TRAINING_TYPE  VALUES ('4', 'Data Structures'); 
INSERT INTO TRAINING_TYPE  VALUES ('5', 'Operating Systems');
INSERT INTO TRAINING_TYPE  VALUES ('6', 'JavaScript'); 
INSERT INTO TRAINING_TYPE  VALUES ('7', 'R');
INSERT INTO TRAINING_TYPE  VALUES ('8', 'Web Development'); 
INSERT INTO TRAINING_TYPE  VALUES ('9', 'C/C++');
INSERT INTO TRAINING_TYPE  VALUES ('10', 'Python');
INSERT INTO TRAINING_TYPE  VALUES ('11', 'None');


-- Sample data for APPLICANTS  table
-- Summary: Each tuple stores information about an applicant (aka the user of the site).
INSERT INTO APPLICANTS VALUES ('1', 'John', 	'Smith', 	'1998-01-01', '0', '123-123-1234', '1', '1', 'password' ,'jsmith@gmail.com');
INSERT INTO APPLICANTS VALUES ('2', 'William', 	'Smith', 	'1998-01-02', '0', '321-321-1234', '2', '2', 'password' ,'wsmith@gmail.com'); 
INSERT INTO APPLICANTS VALUES ('3', 'Trevor', 	'caster', 	'1988-01-01', '0', '206-206-1234', '3', '3', 'password' ,'tcaster@gmail.com');
INSERT INTO APPLICANTS VALUES ('4', 'Travis', 	'Maxwell', 	'1994-01-01', '0', '567-567-1234', '3', '4', 'password' ,'tmaxwell@gmail.com'); 
INSERT INTO APPLICANTS VALUES ('5', 'Julian', 	'Smith', 	'1966-01-01', '0', '897-897-1234', '3', '5', 'password' ,'jsmith@gmail.com');
INSERT INTO APPLICANTS VALUES ('6', 'Tim', 		'Dillon', 	'1998-01-03', '0', '102-102-1234', '3', '2', 'password' ,'tdillon@gmail.com'); 
INSERT INTO APPLICANTS VALUES ('7', 'Sam', 		'Smmack', 	'2001-01-04', '0', '654-645-1234', '3', '10', 'password' ,'ssmmack@gmail.com');
INSERT INTO APPLICANTS VALUES ('8', 'Jenifer', 	'Aston', 	'1998-01-05', '0', '789-789-1234', '4', '2', 'password' ,'jaston@gmail.com'); 
INSERT INTO APPLICANTS VALUES ('9', 'Wendy', 	'lanistar', '1998-01-06', '0', '987-987-1234', '4', '9', 'password' ,'wlanistar@gmail.com');
INSERT INTO APPLICANTS VALUES ('10', 'Jason', 	'Baitmen', 	'1965-01-07', '0', '679-679-1234', '4', '2', 'password' ,'jbaitmen@gmail.com'); 



-- Sample data for REMINDERS_SENT  table
-- Summary: Each tuple stores the log of messages that have been sent to the user and
--			the user they have been sent to. 
INSERT INTO REMINDERS_SENT  VALUES ('1', '1', '10', '2021-1-1');
INSERT INTO REMINDERS_SENT  VALUES ('2', '2', '10', '2021-1-2'); 
INSERT INTO REMINDERS_SENT  VALUES ('3', '3', '10', '2021-1-3');
INSERT INTO REMINDERS_SENT  VALUES ('4', '4', '10', '2021-1-4');
INSERT INTO REMINDERS_SENT  VALUES ('5', '5', '10', '2021-1-5'); 
INSERT INTO REMINDERS_SENT  VALUES ('6', '6', '10', '2021-1-6');
INSERT INTO REMINDERS_SENT  VALUES ('7', '7', '10', '2021-1-7'); 
INSERT INTO REMINDERS_SENT  VALUES ('8', '8', '10', '2021-1-8');
INSERT INTO REMINDERS_SENT  VALUES ('9', '9', '10', '2021-1-9');
INSERT INTO REMINDERS_SENT  VALUES ('10', '10', '10', '2021-1-10');

-- Sample data for TRAINING_LOG  table
-- Summary: Each tuple stores a log of the trainings to link the trainings
--			with the users. 
INSERT INTO TRAINING_LOG  VALUES ('1', '1', '1', '2021-1-10');
INSERT INTO TRAINING_LOG  VALUES ('2', '2', '2', '2021-1-11'); 
INSERT INTO TRAINING_LOG  VALUES ('3', '3', '3', '2021-1-12');
INSERT INTO TRAINING_LOG  VALUES ('4', '4', '4', '2021-1-13');
INSERT INTO TRAINING_LOG  VALUES ('5', '5', '5', '2021-1-14'); 
INSERT INTO TRAINING_LOG  VALUES ('6', '6', '6', '2021-1-15');
INSERT INTO TRAINING_LOG  VALUES ('7', '7', '7', '2021-1-16'); 
INSERT INTO TRAINING_LOG  VALUES ('8', '8', '8', '2021-1-17');
INSERT INTO TRAINING_LOG  VALUES ('9', '9', '9', '2021-1-18');
INSERT INTO TRAINING_LOG  VALUES ('10', '10', '10', '2021-1-19');
INSERT INTO TRAINING_LOG  VALUES ('11', '1', '1', '2021-1-20');



-- Sample data for KSA_JOB  table
-- Summary: Each tuple stores the skill and the associated job number. 
INSERT INTO KSA_JOB VALUES ('1', '2');
INSERT INTO KSA_JOB VALUES ('1', '10'); 
INSERT INTO KSA_JOB VALUES ('3', '4');
INSERT INTO KSA_JOB VALUES ('4', '1'); 
INSERT INTO KSA_JOB VALUES ('5', '7');
INSERT INTO KSA_JOB VALUES ('6', '1');
INSERT INTO KSA_JOB VALUES ('7', '7'); 
INSERT INTO KSA_JOB VALUES ('8', '8');
INSERT INTO KSA_JOB VALUES ('9', '9'); 
INSERT INTO KSA_JOB VALUES ('10', '10');


-- Sample data for KSA_APPLICANT  table
-- Summary: Each tuple stores the skill and the associated job number. 
INSERT INTO KSA_APPLICANT VALUES ('1', '2');
INSERT INTO KSA_APPLICANT VALUES ('2', '10'); 
INSERT INTO KSA_APPLICANT VALUES ('3', '4');
INSERT INTO KSA_APPLICANT VALUES ('4', '1'); 
INSERT INTO KSA_APPLICANT VALUES ('5', '7');
INSERT INTO KSA_APPLICANT VALUES ('6', '1');
INSERT INTO KSA_APPLICANT VALUES ('7', '7'); 
INSERT INTO KSA_APPLICANT VALUES ('2', '8');
INSERT INTO KSA_APPLICANT VALUES ('9', '2'); 
INSERT INTO KSA_APPLICANT VALUES ('10', '10');

-- Sample data for INTEREST_LOG  table
-- Summary: Each tuple stores the skill and the associated job number. 

INSERT INTO INTEREST_LOG VALUES ('1', '2');
INSERT INTO INTEREST_LOG VALUES ('2', '10'); 
INSERT INTO INTEREST_LOG VALUES ('3', '4');
INSERT INTO INTEREST_LOG VALUES ('4', '1'); 
INSERT INTO INTEREST_LOG VALUES ('5', '7');
INSERT INTO INTEREST_LOG VALUES ('6', '1');
INSERT INTO INTEREST_LOG VALUES ('7', '7'); 
INSERT INTO INTEREST_LOG VALUES ('8', '8');
INSERT INTO INTEREST_LOG VALUES ('3', '9'); 
INSERT INTO INTEREST_LOG VALUES ('10', '10');

-- Derived Data for Age
-- Summary: Each tuple's age value will be updated based on the current year. 
UPDATE  APPLICANTS 		SET		Age = year(current_date)-year(dob);




/************************************************************ 
 ************************************************************ 
 ************************************************************ 
	Part C - QUERIES
 ************************************************************ 
 ************************************************************ 
 ************************************************************/

-- Query 1
-- Purpose: The purpose is to get a skill associated with an applicant, and the applicant's first and last names.
-- Expected: We expect a list of all the users and their first documented skill.
SELECT 	APPLICANTS.FName, APPLICANTS.Lname, JOB_SKILLS.Skills 
FROM 	KSA_APPLICANT
JOIN 	APPLICANTS ON APPLICANTS.ApplicantId = KSA_APPLICANT.ApplicantId
JOIN 	JOB_SKILLS ON JOB_SKILLS.KSAnum = KSA_APPLICANT.KLogId;


-- Query 2
-- Purpose: This query will return all the company’s names who are willing to give Sick Leave.
-- Expected: A list of companies who have sick leave as a benefit.
SELECT Company 
FROM JOB_ADS 
WHERE BenefitNo IN (SELECT BenefitId 
					FROM BENEFITS 
					WHERE SickLeave = 'Yes') 
GROUP BY Company;


-- Query 3
-- Purpose: This query finds the applicants that are older than the average applicant with the same degree status.
-- Expected: A list of first and last names and ages of the applicants are older than the average applicant with the same degrees. 
SELECT A.Fname, A.Lname, A.Age 
FROM APPLICANTS A 
WHERE A.Age > (	SELECT AVG(I.Age) 
				FROM APPLICANTS I 
				WHERE I.DEGREE_STATUS = A.DEGREE_STATUS);


-- Query 4
-- Purpose:  To get all information in both the TRAINING_TYPE and Training_log tables.
-- Expected: A list of all information in both the tables.
-- NOTE: The instructions for this said to use a full outer join, based on an internet search and trials, mySQL in phpMyAdmin does
-- 		 not allow the use of "FULL JOIN" or "FULL OUTER JOIN" so we had to use a combo of a left and right join.
SELECT TRAINING_LOG.DateTrained AS "Date", TRAINING_TYPE.Training
FROM  TRAINING_LOG
LEFT JOIN TRAINING_TYPE ON TRAINING_LOG.TrainID = TRAINING_TYPE.TrainingId
UNION
SELECT TRAINING_LOG.DateTrained AS "Data", TRAINING_TYPE.Training
FROM  TRAINING_LOG
RIGHT JOIN TRAINING_TYPE ON TRAINING_LOG.TrainID = TRAINING_TYPE.TrainingId;


-- Query 5
-- Purpose: To get a subset of information related to each job that is advertised.
-- Expected: Specifically, this query will return a list of all the companies, the job types 
--			 salaries, and locations and orders them by salary from highest to lowest salary.
SELECT JOB_ADS.Company, JOB_ADS.JobType, JOB_ADS.Salary,LOCATIONS.State_Region 
FROM JOB_ADS 
LEFT JOIN LOCATIONS on (JOB_ADS.Location = LOCATIONS.LocationId) 
UNION 	SELECT JOB_ADS.Company, JOB_ADS.JobType, JOB_ADS.Salary,LOCATIONS.State_Region 
		FROM JOB_ADS 
		RIGHT JOIN LOCATIONS on (JOB_ADS.Location = LOCATIONS.LocationId) 
		WHERE JOB_ADS.Company IS NOT NULL 
		ORDER BY Salary DESC;


-- Query 6
-- Purpose:  Find all the applicants who have an interest area with "ems" at the end and group them by their preferred location, and interest area.
-- Expected: A table that shows the first and last name of the applicant and the state and city of their preferred location, and their interest area.
SELECT APPLICANTS.Fname AS "First Name", APPLICANTS.Lname  AS "Last Name", LOCATIONS.Country  AS "Preferred Country", LOCATIONS.State_Region  AS "Preferred State", INTEREST_AREA.Interest AS "Interest Area"
FROM APPLICANTS, LOCATIONS, INTEREST_AREA, INTEREST_LOG
WHERE 	APPLICANTS.PreferredLocation = LOCATIONS.LocationId AND 
		INTEREST_LOG.UserId = APPLICANTS.ApplicantId AND 
		INTEREST_LOG.InterestId = INTEREST_AREA.InterestId AND
		INTEREST_AREA.Interest LIKE '%ems'
GROUP BY LOCATIONS.State_Region, LOCATIONS.Country, APPLICANTS.Lname, APPLICANTS.Fname, INTEREST_AREA.Interest;


-- Query 7
-- Purpose: List the applicants and their contact information if listed JavaScript as one of their skills
-- Expected: A table that shows the first and last name of the applicant and their phone number if they are skilled in JavaScript
SELECT APPLICANTS.Fname AS "First Name", APPLICANTS.Lname AS "Last Name", APPLICANTS.PhoneNumber  AS "Phone Number"
FROM APPLICANTS, KSA_APPLICANT, JOB_SKILLS
WHERE APPLICANTS.ApplicantId = KSA_APPLICANT.ApplicantId AND 
	  KSA_APPLICANT.KLogId = JOB_SKILLS.KSAnum  AND 
	  JOB_SKILLS.Skills = 'JavaScript';


-- Query 8
-- Purpose: Show the jobs where they provide health insurance and PTO or Sick Leave
-- Expected: A table of jobs (the job title and company) where you can get health insurance and
--			 PTO or Sick Leave.
SELECT JOB_ADS.Title AS "Job Title", JOB_ADS.Company
FROM JOB_ADS, BENEFITS 
WHERE JOB_ADS.BenefitNo = BENEFITS.BenefitId AND
      BENEFITS.HealthInsurance = 'Yes' AND
	  (BENEFITS.PTO = 'Yes' OR
	   BENEFITS.SickLeave = 'Yes');


-- Query 9
-- Purpose:	 Finds the number of applicants in each state.
-- Expected: A table that shows the number of people per state that are currently looking for jobs. 
SELECT 	LOCATIONS.State_Region as "State", COUNT(APPLICANTS.PreferredLocation) AS "Number of Applicants"
FROM	APPLICANTS, LOCATIONS
WHERE 	APPLICANTS.PreferredLocation = LOCATIONS.LocationId
GROUP BY LOCATIONS.State_Region; 


-- Query 10
-- Purpose:  Show the reminders sent to each user by showing the message, their name, and the date it was sent
-- Expected: A table showing the message sent to an applicant, the name of the applicant and the date it was sent to 
--			 the applicant.
SELECT REMINDERS.Message AS "Reminder Message", REMINDERS_SENT.DateSent AS "Date Sent", APPLICANTS.Fname AS "Applicant First Name", APPLICANTS.Lname AS "Applicant Last Name" 
FROM REMINDERS 
JOIN REMINDERS_SENT ON REMINDERS.MsgId = REMINDERS_SENT.MsgId
JOIN APPLICANTS ON REMINDERS_SENT.UserId = APPLICANTS.ApplicantId;


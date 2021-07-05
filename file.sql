SET
  FEEDBACK 1
SET
  NUMWIDTH 10
SET
  LINESIZE 80
SET
  TRIMSPOOL ON
SET
  TAB OFF
SET
  PAGESIZE 100
SET
  ECHO OFF 
DROP TABLE DietPlan;

DROP TABLE ExercisePlan;

DROP TABLE DietLog;

DROP TABLE ExerciseLog;

DROP TABLE DailyProgressLog;

DROP TABLE WorkoutPlan;

DROP TABLE TrainedStaff;

DROP TABLE Member;

DROP TABLE ApplicationAccount;

DROP TABLE Membership;

CREATE TABLE Membership (
  membershipID VARCHAR2(10),
  membershipType VARCHAR2(20),
  activationDate VARCHAR2(20),
  membershipPayment NUMBER
);


ALTER TABLE
  Membership
ADD
  (
    CONSTRAINT membershipID_pk PRIMARY KEY (membershipID)
  );

CREATE TABLE Member (
  memberID VARCHAR2(10),
  memberName VARCHAR2(30),
  memberAge NUMBER,
  memberWeight NUMBER,
  memberHeight NUMBER,
  memberBMI NUMBER,
  memberGender VARCHAR2(10),
  membershipID VARCHAR2(10),
  LoginUsername VARCHAR2(20),
  PRIMARY KEY (memberID)
);

CREATE TABLE WorkoutPlan (PlanID VARCHAR2(10), PlanType VARCHAR2(20), MemberID VARCHAR2(10));

CREATE UNIQUE INDEX PlanID_pk ON WorkoutPlan(PlanID);

ALTER TABLE
  WorkoutPlan
ADD
  (CONSTRAINT PlanID_pk PRIMARY KEY (PlanID),
   CONSTRAINT WorkOutPlan_MemberID_fk FOREIGN KEY(MemberID) REFERENCES Member (MemberID));

CREATE TABLE ApplicationAccount (
  LoginUsername VARCHAR2(20),
  LoginPassword VARCHAR2(10),
  CreationDate VARCHAR2(20),
  LastActiveDate VARCHAR(20),
  PRIMARY KEY(LoginUsername)
);

CREATE TABLE TrainedStaff (
  StaffID VARCHAR2(10) NOT NULL,
  StaffName VARCHAR2(20),
  StaffRole VARCHAR2(10),
  StaffEmail VARCHAR2(10),
  StaffUsername VARCHAR2(20),
  PRIMARY KEY (StaffID)
);



ALTER TABLE
  TrainedStaff
ADD
  (
    CONSTRAINT staffUsername_fk FOREIGN KEY (StaffUsername) REFERENCES ApplicationAccount (LoginUsername)
  );




ALTER TABLE
  Member
ADD
  (
    CONSTRAINT MembershipID_fk FOREIGN KEY (MembershipID) REFERENCES Membership(MembershipID),
    CONSTRAINT LoginUsername_fk FOREIGN KEY (LoginUsername) REFERENCES ApplicationAccount(LoginUsername)
  );

CREATE TABLE DailyProgressLog (
  logID VARCHAR2(10),
  logdate VARCHAR2(20),
  logtime VARCHAR2(10),
  newWeight NUMBER,
  memberID VARCHAR2(10)
);


ALTER TABLE
  DailyProgressLog
ADD
  (
    CONSTRAINT logID_pk PRIMARY KEY (logID),
    CONSTRAINT daily_progress_memberID_fk FOREIGN KEY (memberID) REFERENCES Member (memberID)
  );

CREATE TABLE ExerciseLog (
  TypeofExercises VARCHAR2(20),
  muscleGroup VARCHAR2(20),
  workoutTime NUMBER
);

CREATE TABLE DietLog (
  Food VARCHAR2(20),
  CaloriesIntake NUMBER,
  ProteinIntake NUMBER
);

CREATE TABLE ExercisePlan (
  TypeOfExercises VARCHAR2(20),
  TargetedMmuscleGroup VARCHAR2(10),
  workoutHours NUMBER
);

CREATE TABLE DietPlan (CaloriesIntake NUMBER, ProteinIntake NUMBER);
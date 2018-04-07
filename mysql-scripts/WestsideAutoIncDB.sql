DROP DATABASE if exists WestsideAutoIncDB;
CREATE DATABASE WestsideAutoIncDB;

USE WestsideAutoIncDB;

CREATE TABLE Buyer (
	BuyerID		INT(6),
	FirstName	VARCHAR(25),
	LastName	VARCHAR(25),
	Phone		INT(10),
	PRIMARY KEY (BuyerID)
);

CREATE TABLE Salesperson (
	SalespersonID	INT(6),
	FirstName		VARCHAR(25),
	LastName		VARCHAR(25),
	Phone			INT(10),
	PRIMARY KEY 	(SalespersonID)
);

CREATE TABLE WarrantyItem (
	WarrantyItemID	INT(6),
	Type			VARCHAR(50),
	Description		VARCHAR(200),
	PRIMARY KEY 	(WarrantyItemID)
);

CREATE TABLE Customer (
	CustomerID	INT(6),
	FirstName	VARCHAR(50),
	LastName	VARCHAR(50),
	Gender		VARCHAR(20),
	Birthday	DATE,
	TaxID		INT(10),
	Phone		INT(10),
	Address		VARCHAR(50),
	City		VARCHAR(20),
	State		VARCHAR(20),
	Zip			VARCHAR(6),
	PRIMARY KEY (CustomerID)
);

CREATE TABLE Payment (
	PaymentID		INT(6),
	CustomerID		INT(6),
	ExpectedDate	DATE,
	PaidDate		DATE,
	AmountDue		FLOAT(8,2),
	AmountPaid		FLOAT(8,2),
	BankAccount		INT(20),
	PRIMARY KEY (PaymentID),
	FOREIGN KEY (CustomerID) REFERENCES (Customer.CustomerID)
);

CREATE TABLE EmploymentHistory (
	EmploymentHistoryID	INT(6),
	CustomerID			INT(6),
	Employer 			VARCHAR(50),
	Title				VARCHAR(50),
	Supervisor			VARCHAR(50),
	Phone				INT(10),
	Address				VARCHAR(100),
	StartDate			DATE,
	PRIMARY KEY (EmploymentHistoryID),
	FOREIGN KEY (CustomerID) REFERENCES (Customer.CustomerID)
);

CREATE TABLE Purchase (
	PurchaseID	INT(6),
	BuyerID		INT(6),
	Date 		DATE,
	Location	VARCHAR(50),
	Seller		VARCHAR(50),
	Auction		BOOLEAN,
	PRIMARY KEY (PurchaseID),
	FOREIGN KEY (BuyerID) REFERENCES (Buyer.BuyerID)
);

CREATE TABLE Vehicle (
	VehicleID		INT(6),
	PurchaseID		INT(6),
	Make			VARCHAR(50),
	Model			VARCHAR(50),
	Year			INT(4),
	Color			VARCHAR(25),
	Mileage			INT(7),
	Condition		VARCHAR(20),
	BookPrice		FLOAT(8,2),
	PricePaid		FLOAT(8,2),
	Style			VARCHAR(20),
	InteriorColor	VARCHAR(20),
	PRIMARY KEY (VehicleID),
	FOREIGN KEY (PurchaseID) REFERENCES (Purchase.PurchaseID)
);

CREATE TABLE Sale (
	SaleID 			INT(6),
	SalespersonID	INT(6),
	CustomerID		INT(6),
	VehicleID		INT(6),
	Date 			DATE,
	TotalDue		FLOAT(8,2),
	DownPayment		FLOAT(8,2),
	FinanceAmount	FLOAT(8,2),
	Commission		FLOAT(8,2),
	PRIMARY KEY (SaleID),
	FOREIGN KEY (SalespersonID) REFERENCES (Salesperson.SalespersonID),
	FOREIGN KEY (CustomerID) REFERENCES (Customer.CustomerID),
	FOREIGN KEY (VehicleID) REFERENCES (Vehicle.VehicleID)
);

CREATE TABLE Warranty (
	WarrantyID 	INT(6),
	SaleID 		INT(6),
	SaleDate	DATE,
	TotalCost	FLOAT(8,2),
	PRIMARY KEY (WarrantyID),
	FOREIGN KEY (SaleID) REFERENCES (Sale.SaleID)
);

CREATE TABLE Coverage (
	CoverageID		INT(6),
	WarrantyItemID	INT(6),
	WarrantyID 		INT(6),
	StartDate		DATE,
	EndDate			DATE,
	Cost 			FLOAT(8,2),
	Deductible		FLOAT(8,2)
	PRIMARY KEY (CoverageID),
	FOREIGN KEY (WarrantyItemID) REFERENCES (WarrantyItem.WarrantyItemID),
	FOREIGN KEY (WarrantyID) REFERENCES (Warranty.WarrantyID)
);

CREATE TABLE Repair (
	RepairID	INT(6),
	VehicleID	INT(6),
	Problem		VARCHAR(200),
	Estimate	FLOAT(8,2),
	PRIMARY KEY (RepairID),
	FOREIGN KEY (VehicleID) REFERENCES (Vehicle.VehicleID)
);
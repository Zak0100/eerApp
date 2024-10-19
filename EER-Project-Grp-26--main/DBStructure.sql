
DROP TABLE IF EXISTS account;
CREATE TABLE account (
    accountID INTEGER PRIMARY KEY IDENTITY(1,1),
    emailAddress VARCHAR(255) NOT NULL,
    verifyEmail BIT NOT NULL DEFAULT 0,
    emailChanged DATETIME NOT NULL DEFAULT GETDATE(), -- when first created is the same time as date created
    emailChangedBy INTEGER NOT NULL DEFAULT 0,
    password VARCHAR(255) NOT NULL,
    dateCreated DATE NOT NULL DEFAULT GETDATE(),
    role VARCHAR(255) NOT NULL,
    active BIT NOT NULL DEFAULT 0
);
DROP TABLE IF EXISTS property;
CREATE TABLE property (
    propertyID INTEGER PRIMARY KEY IDENTITY(1,1),
    ownerID INTEGER NOT NULL FOREIGN KEY REFERENCES account(accountID) ON DELETE CASCADE,
    EER CHAR NOT NULL, 
    postcode VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    propertyType VARCHAR(255) NOT NULL,
    addressChanged DATETIME NOT NULL DEFAULT GETDATE(), -- when first created is the same time as date created
    addressChangedBy INTEGER NOT NULL,
    reportIssueDate DATE NOT NULL
);

DROP TABLE IF EXISTS userSavedProperty;
CREATE TABLE userSavedProperty (
    ID INTEGER PRIMARY KEY IDENTITY(1,1),
    userID INTEGER FOREIGN KEY REFERENCES account(accountID) ON DELETE CASCADE, 
    propertyID INTEGER FOREIGN KEY REFERENCES property(propertyID) 
);
-- DROP TABLE IF EXISTS recommendation;
-- CREATE TABLE recommendation ( 
--     recommendationID INTEGER PRIMARY KEY IDENTITY(1,1), 
--     propertyID INTEGER NOT NULL, -- foreign key refference property ID 
--     carbonEmistionsImpact VARCHAR NOT NULL, 
--     recomendedChanges VARCHAR(255) NOT NULL
-- );

-- DROP TABLE IF EXISTS equation;
-- CREATE TABLE equation (
--     equationID INTEGER PRIMARY KEY IDENTITY(1,1),
--     equation VARCHAR NOT NULL
-- );
 
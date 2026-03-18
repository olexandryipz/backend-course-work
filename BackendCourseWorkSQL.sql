CREATE DATABASE ClothingStoreDB;
GO

USE ClothingStoreDB;
GO

CREATE TABLE Users (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    Role NVARCHAR(20) NOT NULL DEFAULT 'user',
    Name NVARCHAR(100) NOT NULL,
    Email NVARCHAR(150) NOT NULL UNIQUE,
    PasswordHash NVARCHAR(255) NOT NULL,
    CreatedAt DATETIME2 NOT NULL DEFAULT GETDATE()
);
GO

INSERT INTO Users (Role, Name, Email, PasswordHash) 
VALUES ('admin', N'Адміністратор', 'admin@store.com', 'hashed_password_here');
GO

CREATE TABLE Categories (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    Name NVARCHAR(100) NOT NULL UNIQUE
);
GO

INSERT INTO Categories (Name) VALUES (N'Чоловічий одяг'), (N'Жіночий одяг'), (N'Дитячий одяг');
GO

CREATE TABLE Products (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    CategoryId INT NOT NULL FOREIGN KEY REFERENCES Categories(Id) ON DELETE CASCADE,
    Name NVARCHAR(200) NOT NULL,
    Description NVARCHAR(MAX),
    Price DECIMAL(10,2) NOT NULL CHECK (Price > 0),
    Size NVARCHAR(20) NOT NULL,
    StockQuantity INT NOT NULL DEFAULT 0,
    ImagePath NVARCHAR(255),
    IsActive BIT NOT NULL DEFAULT 1
);
GO

CREATE TABLE News (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    Title NVARCHAR(200) NOT NULL,
    Content NVARCHAR(MAX) NOT NULL,
    PublishedAt DATETIME2 NOT NULL DEFAULT GETDATE()
);
GO

CREATE TABLE Reviews (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    ProductId INT NOT NULL FOREIGN KEY REFERENCES Products(Id) ON DELETE CASCADE,
    UserId INT NOT NULL FOREIGN KEY REFERENCES Users(Id) ON DELETE CASCADE,
    Rating INT NOT NULL CHECK (Rating BETWEEN 1 AND 5),
    Comment NVARCHAR(MAX) NOT NULL,
    CreatedAt DATETIME2 NOT NULL DEFAULT GETDATE()
);
GO

CREATE TABLE Orders (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    UserId INT NOT NULL FOREIGN KEY REFERENCES Users(Id),
    TotalPrice DECIMAL(10,2) NOT NULL,
    Status NVARCHAR(50) NOT NULL DEFAULT 'New',
    CreatedAt DATETIME2 NOT NULL DEFAULT GETDATE()
);
GO

CREATE TABLE OrderItems (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    OrderId INT NOT NULL FOREIGN KEY REFERENCES Orders(Id) ON DELETE CASCADE,
    ProductId INT NOT NULL FOREIGN KEY REFERENCES Products(Id),
    Quantity INT NOT NULL CHECK (Quantity > 0),
    Price DECIMAL(10,2) NOT NULL
);
GO

USE master;
GO

IF NOT EXISTS (SELECT * FROM sys.server_principals WHERE name = N'NT AUTHORITY\SYSTEM')
BEGIN
    CREATE LOGIN [NT AUTHORITY\SYSTEM] FROM WINDOWS;
END
GO

ALTER SERVER ROLE sysadmin ADD MEMBER [NT AUTHORITY\SYSTEM];
GO

USE ClothingStoreDB;
GO

INSERT INTO Products (Name, Price, Description, CategoryId, Size)
VALUES 
('Футболка базова біла', 450.00, 'Зручна базова футболка.', 1, 'M'),
('Джинси класичні сині', 1200.50, 'Стильні джинси прямого крою.', 1, '32'),
('Худі оверсайз чорне', 950.00, 'Тепле худі з глибоким капюшоном.', 1, 'L');
GO

USE ClothingStoreDB;
GO

DELETE FROM Products;
GO

INSERT INTO Products (Name, Price, Description, CategoryId, Size)
VALUES 
(N'Футболка базова біла', 450.00, N'Зручна базова футболка.', 1, 'M'),
(N'Джинси класичні сині', 1200.50, N'Стильні джинси прямого крою.', 1, '32'),
(N'Худі оверсайз чорне', 950.00, N'Тепле худі з глибоким капюшоном.', 1, 'L');
GO
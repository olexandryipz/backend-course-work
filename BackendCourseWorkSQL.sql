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

USE ClothingStoreDB;
GO

INSERT INTO Users (Role, Name, Email, PasswordHash, CreatedAt) 
VALUES ('Customer', N'Тестовий Клієнт', 'test@test.com', 'dummy_hash_123', GETDATE());
GO

USE ClothingStoreDB;
GO

IF NOT EXISTS (SELECT * FROM sys.columns WHERE object_id = OBJECT_ID(N'Products') AND name = N'ImageUrl')
BEGIN
    ALTER TABLE Products ADD ImageUrl NVARCHAR(255) NULL;
END
GO

USE ClothingStoreDB;
GO

DELETE FROM Products;
GO

INSERT INTO Products (CategoryId, Name, Price, Description, Size, ImageUrl)
VALUES 
(1, N'Класична біла футболка', 450.00, N'Базова біла футболка зі 100% бавовни. М''яка та приємна до тіла.', 'M', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=300&auto=format&fit=crop'),
(1, N'Джинси Straight Fit сині', 1250.00, N'Стильні чоловічі джинси прямого крою. Якісний денім.', '32', 'https://images.pexels.com/photos/1598507/pexels-photo-1598507.jpeg?auto=compress&cs=tinysrgb&w=300'),
(1, N'Чорне худі Oversize', 980.00, N'Тепле худі з капюшоном та кишенею кенгуру. Унісекс.', 'L', 'https://images.unsplash.com/photo-1578587018452-892bacefd3f2?q=80&w=300&auto=format&fit=crop'),
(1, N'Шкіряна куртка байкерська', 3500.00, N'Стильна куртка зі штучної шкіри. Застібка на блискавку.', 'L', 'https://images.pexels.com/photos/1124468/pexels-photo-1124468.jpeg?auto=compress&cs=tinysrgb&w=300'),
(1, N'Білі кросівки Classic', 2100.00, N'Класичні білі кросівки на кожен день. Зручна підошва.', '42', 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=300&auto=format&fit=crop'),
(1, N'Сукня літня квіткова', 1150.00, N'Легка літня сукня з квітковим принтом. Підкреслює талію.', 'S', 'https://images.pexels.com/photos/985635/pexels-photo-985635.jpeg?auto=compress&cs=tinysrgb&w=300'),
(1, N'Чоловічий костюм сірий', 4200.00, N'Діловий костюм-двійка. Піджак та штани. Вовна.', '50', 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?q=80&w=300&auto=format&fit=crop'),
(1, N'Жіночий кардиган в''язаний', 1300.00, N'Теплий в''язаний кардиган на ґудзиках. М''яка пряжа.', 'M', 'https://images.pexels.com/photos/1031737/pexels-photo-1031737.jpeg?auto=compress&cs=tinysrgb&w=300');
GO

USE ClothingStoreDB;
GO

DELETE FROM OrderItems;

DELETE FROM Orders;

DELETE FROM Products;
GO

INSERT INTO Products (CategoryId, Name, Price, Description, Size, ImageUrl)
VALUES 
(1, N'Класична біла футболка', 450.00, N'Базова біла футболка зі 100% бавовни. М''яка та приємна до тіла.', 'M', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=300&auto=format&fit=crop'),
(1, N'Джинси Straight Fit сині', 1250.00, N'Стильні чоловічі джинси прямого крою. Якісний денім.', '32', 'https://images.pexels.com/photos/1598507/pexels-photo-1598507.jpeg?auto=compress&cs=tinysrgb&w=300'),
(1, N'Чорне худі Oversize', 980.00, N'Тепле худі з капюшоном та кишенею кенгуру. Унісекс.', 'L', 'https://images.unsplash.com/photo-1578587018452-892bacefd3f2?q=80&w=300&auto=format&fit=crop'),
(1, N'Шкіряна куртка байкерська', 3500.00, N'Стильна куртка зі штучної шкіри. Застібка на блискавку.', 'L', 'https://images.pexels.com/photos/1124468/pexels-photo-1124468.jpeg?auto=compress&cs=tinysrgb&w=300'),
(1, N'Білі кросівки Classic', 2100.00, N'Класичні білі кросівки на кожен день. Зручна підошва.', '42', 'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=300&auto=format&fit=crop'),
(1, N'Сукня літня квіткова', 1150.00, N'Легка літня сукня з квітковим принтом. Підкреслює талію.', 'S', 'https://images.pexels.com/photos/985635/pexels-photo-985635.jpeg?auto=compress&cs=tinysrgb&w=300'),
(1, N'Чоловічий костюм сірий', 4200.00, N'Діловий костюм-двійка. Піджак та штани. Вовна.', '50', 'https://images.unsplash.com/photo-1593032465175-481ac7f401a0?q=80&w=300&auto=format&fit=crop'),
(1, N'Жіночий кардиган в''язаний', 1300.00, N'Теплий в''язаний кардиган на ґудзиках. М''яка пряжа.', 'M', 'https://images.pexels.com/photos/1031737/pexels-photo-1031737.jpeg?auto=compress&cs=tinysrgb&w=300');
GO

USE ClothingStoreDB;
GO

UPDATE Products 
SET ImageUrl = 'https://smash.com.ua/image/cache/catalog/0.new2025/1.%D0%B2%D0%B5%D1%80%D1%85/5.%D1%85%D1%83%D0%B4%D0%B8/Boxy%20Fit%20440%20gsm/%D0%A7%D1%91%D1%80%D0%BD%D0%BE%D0%B5/1-700x956.png'
WHERE Name LIKE N'%Чорне худі%';

UPDATE Products 
SET ImageUrl = 'https://images.pexels.com/photos/11039284/pexels-photo-11039284.jpeg?auto=compress&cs=tinysrgb&w=300&h=400&fit=crop'
WHERE Name LIKE N'%Жіночий кардиган%';
GO

USE ClothingStoreDB;
GO

UPDATE Users 
SET Role = 'Admin' 
WHERE Id = (SELECT MIN(Id) FROM Users);
GO

USE ClothingStoreDB;
GO
SELECT Id, Name, Email, Role FROM Users;
GO

USE ClothingStoreDB;
GO
UPDATE Users SET Role = 'Admin' WHERE Id = 3;
GO

USE ClothingStoreDB;
GO

DELETE FROM OrderItems;

DELETE FROM Orders;

DBCC CHECKIDENT ('OrderItems', RESEED, 0);
DBCC CHECKIDENT ('Orders', RESEED, 0);

DELETE FROM Users WHERE Id != 3;
GO

USE ClothingStoreDB;
GO

UPDATE Products 
SET StockQuantity = 10;
GO

SELECT Name, StockQuantity FROM Products;

USE ClothingStoreDB;
GO

CREATE TABLE Reviews (
    Id INT IDENTITY(1,1) PRIMARY KEY,
    ProductId INT NOT NULL,
    UserId INT NOT NULL,
    Rating INT NOT NULL CHECK (Rating >= 1 AND Rating <= 5),
    Comment NVARCHAR(MAX) NOT NULL,
    CreatedAt DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (ProductId) REFERENCES Products(Id) ON DELETE CASCADE,
    FOREIGN KEY (UserId) REFERENCES Users(Id) ON DELETE CASCADE
);
GO
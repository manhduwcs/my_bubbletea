USE bubbletea;

-- Insert into Products and Product_sizeprice --
INSERT INTO products (name, main_name, category, main_category, size, price, image, popular, description, created_at, updated_at) 
VALUES
-- Trà Ô Long Bốn Mùa
('Trà Ô Long Bốn Mùa', 'tra_o_long_bon_mua', 'Trà Hoa Quả', 'tra_hoa_qua', 'M', 20000, 'images/products/Tra-O-Long-Bon-Mua-600x600.jpg', 2, 'Trà Ô Long Bốn Mùa là sự kết hợp hoàn hảo giữa vị đắng nhẹ của trà ô long và vị ngọt thanh của các loại hoa quả tươi mát. Với hương vị đặc trưng, trà mang lại cảm giác sảng khoái và thư giãn. Đây là sự lựa chọn lý tưởng cho những ai yêu thích sự pha trộn độc đáo của trà và trái cây.', NOW(), NOW()),
('Trà Ô Long Bốn Mùa', 'tra_o_long_bon_mua', 'Trà Hoa Quả', 'tra_hoa_qua', 'L', 35000, 'images/products/Tra-O-Long-Bon-Mua-600x600.jpg', 2, '', NOW(), NOW()),
('Trà Ô Long Bốn Mùa', 'tra_o_long_bon_mua', 'Trà Hoa Quả', 'tra_hoa_qua', 'XL', 42000, 'images/products/Tra-O-Long-Bon-Mua-600x600.jpg', 2, '', NOW(), NOW()),

-- Trà Sữa Thạch Dừa
('Trà Sữa Thạch Dừa', 'tra_sua_thach_dua', 'Trà Sữa', 'tra_sua', 'M', 24000, 'images/products/Tra-Sua-Thach-Dua-600x600.jpg', 0, 'Trà Sữa Thạch Dừa với vị ngọt béo của sữa hòa quyện cùng thạch dừa giòn giòn, tạo nên một trải nghiệm thú vị trong từng ngụm. Hương vị thơm ngon của trà sữa truyền thống kết hợp cùng topping thạch dừa sẽ mang lại cho bạn cảm giác thích thú và mới lạ.', NOW(), NOW()),
('Trà Sữa Thạch Dừa', 'tra_sua_thach_dua', 'Trà Sữa', 'tra_sua', 'L', 33000, 'images/products/Tra-Sua-Thach-Dua-600x600.jpg', 0, '', NOW(), NOW()),
('Trà Sữa Thạch Dừa', 'tra_sua_thach_dua', 'Trà Sữa', 'tra_sua', 'XL', 41000, 'images/products/Tra-Sua-Thach-Dua-600x600.jpg', 0, '', NOW(), NOW()),

-- Trà Đào BigSize
('Trà Đào BigSize', 'tra_dao_bigsize', 'Trà Hoa Quả', 'tra_hoa_qua', 'XL', 44000, 'images/products/Tra-Dao-BigSize-600x600.jpg', 4, 'Trà Đào BigSize là sự lựa chọn hoàn hảo cho những người yêu thích vị ngọt và thơm của đào tươi. Trà được pha chế từ nguyên liệu chọn lọc, mang lại vị thanh mát, ngọt dịu. Mỗi ly trà đào đều có sự kết hợp hài hòa giữa vị trà và hương vị trái cây, mang đến cảm giác sảng khoái và dễ chịu.', NOW(), NOW()),

-- Trà Sữa Bá Vương
('Trà Sữa Bá Vương', 'tra_sua_ba_vuong', 'Trà Sữa', 'tra_sua', 'M', 22000, 'images/products/Tra-Sua-Ba-Vuong-600x600.jpg', 10, 'Trà Sữa Bá Vương mang lại trải nghiệm vị giác mạnh mẽ với hương vị trà đậm đà và lớp sữa béo ngậy. Với sự kết hợp giữa trà sữa và các topping phong phú, mỗi ly trà là một cuộc hành trình khám phá những tầng hương vị khác nhau. Đặc biệt phù hợp cho những ai yêu thích vị ngọt vừa phải.', NOW(), NOW()),
('Trà Sữa Bá Vương', 'tra_sua_ba_vuong', 'Trà Sữa', 'tra_sua', 'L', 30000, 'images/products/Tra-Sua-Ba-Vuong-600x600.jpg', 10, '', NOW(), NOW()),
('Trà Sữa Bá Vương', 'tra_sua_ba_vuong', 'Trà Sữa', 'tra_sua', 'XL', 45000, 'images/products/Tra-Sua-Ba-Vuong-600x600.jpg', 10, '', NOW(), NOW()),

-- Trà Olong Kiwi
('Trà Olong Kiwi', 'tra_olong_kiwi', 'Trà Hoa Quả', 'tra_hoa_qua', 'M', 21000, 'images/products/Tra-Olong-Kiwi-600x600.jpeg', 0, 'Trà Olong Kiwi mang đến hương vị đặc trưng của trà ô long kết hợp cùng vị chua ngọt tươi mát của kiwi. Sự hòa quyện giữa trà và trái cây tạo nên thức uống thanh mát, sảng khoái, giúp giải nhiệt và kích thích vị giác. Đây là lựa chọn hoàn hảo cho những ai yêu thích sự tươi mới và sáng tạo.', NOW(), NOW()),
('Trà Olong Kiwi', 'tra_olong_kiwi', 'Trà Hoa Quả', 'tra_hoa_qua', 'L', 36000, 'images/products/Tra-Olong-Kiwi-600x600.jpeg', 0, '', NOW(), NOW()),

-- Super Sundae Trân Châu Đường Đen
('Super Sundae Trân Châu Đường Đen', 'super_sundae_tran_chau_duong_den', 'Kem', 'kem', 'M', 23000, 'images/products/Super-Sundae-Tran-Chau-Duong-Den-600x600.jpg', 0, 'Super Sundae Trân Châu Đường Đen là sự kết hợp độc đáo giữa kem mát lạnh và trân châu đường đen ngọt lịm. Với lớp kem mềm mịn và topping trân châu dai dai, đây chắc chắn là món ăn tráng miệng không thể bỏ qua cho những ai yêu thích kem và trân châu đường đen.', NOW(), NOW()),
('Super Sundae Trân Châu Đường Đen', 'super_sundae_tran_chau_duong_den', 'Kem', 'kem', 'L', 39000, 'images/products/Super-Sundae-Tran-Chau-Duong-Den-600x600.jpg', 0, '', NOW(), NOW()),
('Super Sundae Trân Châu Đường Đen', 'super_sundae_tran_chau_duong_den', 'Kem', 'kem', 'XL', 43000, 'images/products/Super-Sundae-Tran-Chau-Duong-Den-600x600.jpg', 0, '', NOW(), NOW());

-- Các sản phẩm khác tương tự...

-- Create Tables --
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  main_name VARCHAR(255) NOT NULL,
  category VARCHAR(255) NOT NULL,
  main_category VARCHAR(255) NOT NULL,
  size ENUM('M','L','XL') NOT NULL,
  price INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  popular INT DEFAULT 0,
  description TEXT NULLABLE,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  address VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  status BOOLEAN DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  total_price INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  unit_price INT NOT NULL,
  status ENUM('InCart', 'Ordered', 'Completed'),
  add_to_cart_at DATETIME,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (order_id) REFERENCES orders(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);


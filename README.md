# Crypto-exchange

Back-end Test

## Installation & Setup

- Install project (require composer)

```bash
  git clone https://github.com/PongpolR/crypto-exchange
  cd crypto-exchange
  composer install
```

- สร้างไฟล์ .env
```bash
  สามารถ copy จากไฟล์ .env.example มาใช้ได้
  (อย่าลืมเพิ่ม JWT_SECREAT และ JWT_EXPIRE_HOUR ใน .env)
```

- Run web service (เช่น xampp, nginx, ...)

- Run project

```bash
  php artisan serve
```

## Migration
- สร้าง database ที่มีชื่อตรงกับ DB_DATABASE ใน .env
- migrate เพื่อสร้างตาราง พร้อมกับ seed ข้อมูลตามคำสั่งด้านล่าง
```bash
  php artisan migrate:fresh --seed
```

## API Endpoint
 - คลิปทดสอบ API: https://www.youtube.com/watch?v=BI5Q58XoKM4

- Register - สมัครสมาชิก (require: name, email, password, confirm_password)
```bash
  /api/register (method: POST)
```
- Login - เข้าสู่ระบบ (require: email, password)
```bash
  /api/login (method: POST)
```
- รายละเอียดผู้ใช้ที่อยู่ในระบบ
```bash
  /api/me (method: GET)
```
- รายละเอียดผู้ใช้ทั้งหมด
```bash
  /api/users (method: GET)
```
- รายละเอียดผู้ใช้คนนั้นๆ
```bash
  /api/user/{id} (method: GET) [id คือ id ของผู้ใช้ที่ต้องการเติมเงิน]
```
- รายละเอียดผู้ใช้ทั้งหมดพร้อมกับจำนวนเงิน (Fiat Money) ของผู้ใช้แต่ละคน
```bash
  /api/users/amount (method: GET)
```
- รายละเอียดผู้ใช้ทั้งหมดพร้อมกับ cryptocurrencies ที่ผู้ใช้แต่ละคนมี
```bash
  /api/users/crypto (method: GET)
```
- เติมเงิน (Fiat Money) เข้าไอดีของผู้ใช้คนนั้นๆ (require: amount *ใส่ใน params)
```bash
  /api/fiat_money/topup/{id} (method: PUT) [id คือ id ของผู้ใช้ที่ต้องการเข้าถึง]
```
- รายละเอียด Cryptocurrency ทั้งหมด
```bash
  /api/cryptocurrency (method: GET)
```
- โอนเหรียญหรือ cryptocurrency ให้ผู้ใช้อื่น (require: with_user_id)
```bash
  /api/crypto/transfer/{id} (method: POST) [id คือ id ของ crypto ที่ต้องการโอน]
```
- ซื้อเหรียญหรือ cryptocurrency 
```bash
  /api/crypto/buy/{id} (method: POST) [id คือ id ของ crypto ที่ต้องการซื้อ]
```
- รายละเอียดผู้ใช้ทั้งหมดพร้อมกับ transactions ของผู้ใช้แต่ละคน
```bash
  /api/users/transactions (method: GET)
```

## ER Diagram
- https://drive.google.com/file/d/1qL1YKQeQHwkTfVkASP9aLXwKxHI6a3BF/view?usp=sharing

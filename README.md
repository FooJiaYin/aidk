# AIDK 說明文件

### 伺服器環境
- Apache2 or Nginx
- PHP 7.4
- MySQL 5.7.32

### 設定檔
設定檔位於
```sh
/config/config.php
```
需修改的項目
| 設定項 | 說明 |
| ------ | ------ |
| db=>host | 資料庫連線地址 |
| db=>username | 資料庫使用者名稱 |
| db=>password | 資料庫使用者密碼 |
| db=>dbname | 資料表名稱 |
| SNS_FB_AppId | FB登入API的APP ID |
| SNS_FB_Api_Version | FB登入API的版本，撰寫時為v9.0，可能需視情況設定v10.0 |
| SNS_Google_Client_Id | Google登入API的Client ID |
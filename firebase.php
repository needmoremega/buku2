<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseService {
    private $database;

    public function __construct() {
        // Path ke Firebase service account key
        $firebase = (new Factory)
        ->withServiceAccount([
            
                "type"=> "service_account",
                "project_id"=> "bukuluku-28d5a",
                "private_key_id"=> "9bcea8b83688afda36813aca054bb15e88f52628",
                "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQDkl74d5LgkGA+8\nNUn8Di+tz3JEEmBGaxIOSYAWlfftHyfTLmlCto6UqqOwu4vj3gCI6AnpEHzWug9Z\npmJtRIKF00qgzPiNoxZ9FAbpWvpN1uGouJ9QMjVE/1bfzxUJno2RC8tMvPKI8RIi\nS0BDyL9n7NXbjY5AaW8R6oQl/V7+MdDC5TcQY7sqF6In2EtoW+NVCWdOUPkKyCb8\nhwqZl0dKjYxkswY67PmPVWV0dA+HpTAX6Y+FA8iwGQtP8hNEpNNCw6zgPr7P9Y67\nY3p9vOKQEyg4p77POf2efHuIqdkkMKTsN5Ftu/ZyK2I6lkYet1wPlOrh6dKKLMpx\nHPoRTBu7AgMBAAECggEAHWGRmpcEwgLjtt2kkkSihTUWK0CvZi2p5vM0hvKkqLIp\n9L9Q4TXEssASBQu+Cb5FlFM6vt2TJihJA81adk/pdNj5DRz7T30oTVBPKRw78thN\nLdn5BB5H8YPePysHObLK4FtDOKxKgiZ2HblNW8kILQvoWu1hXM8Qax2Y+acM2CAB\nwEM7UX3XHDA1y33VDU+TLH+T764YcavFTzZD1UerJcQ5BWh3rh+hfWOCrRklQiJM\n39S7ocBzLkcSZV3jJNDOz8T3q+c4S0fZUs5eNtfZ+lpbiwlFviKD6jI36nl/WSQD\nIw2G1ydLKvlD567I6wDgBgMlH0ir6hESad4BhEu+yQKBgQD+kVOFGw8rHmcvVA0e\nDWtTqFG9U1fPANRmMAdiAzRAh6f8hD6y5Elpd2UJO2nbkJhFPiRggkGah7WdZH7E\nfcWX0p/zlK5tCT9kHpeAh2Sxpqv9foWFOv8a2dVjE65nO5ZYfo3pkGBFfUSsfDH6\nuZJ2d/ioV6hieArY6hQLAYC2UwKBgQDl4QCuZVEj/S7UqmG/tvm5gYI9AUdLz4Dg\nBrnTbCSez2/g8PUHikOZbEoiP5RR7Be4oBHBXCLuwT+QAVqVjTyTJQTweWmBAQsH\n1xySu3WpJe6X1aiTZybuuH4A1lADhhBIqGtH9bpRzxi8y8nb1ebScv/FjvzapTns\nNfvuEJeH+QKBgQDC05xVGYGBYZJdAXnMjz6d1ws/14IzdhIYZxevZn5eCLSDKP8H\nUHny0qKr7yG0HbS8AbQ7fFUTHFvdqmTuosdPy64I8LiR0GsIh/UxM+3XnJSyvFsZ\nvS4ycZbDbfOjJFKLRcf8gjd710RwsdhaaB30txrCU9wWCINcwcE3Lx4/6wKBgQDa\nSixUbt97Nlv3FIhX/g/raSDcf09NnRD7K0fgjWvE5qSNzSJQ86m3kg5fsVJN7Myl\nxFK38580a4vJWo/DPegMrnWfSRu3pd7spgd7CsnzQpLr2bcHqkddHxKABwLaJb9m\nz494OM6iCu+psDbSK6/RneRlnJ9dnNKBDM5bxaOvOQKBgQDxTXoST0hMo06RGDp/\nsLRo8eGenTtNVjlzohQA1PXIN+r/zn9cy3KelDuUy/gB/psiUljssuuCgNrBNXrd\n6+pHi7NtCy2pBp6qBtkdxc9OYGO8EHauxeaAfYCTx9ivRWzu+gP70cKz9BBscBOX\njyJ+mizEqNVLDI+JH1rPDwma2Q==\n-----END PRIVATE KEY-----\n",
                "client_email"=> "firebase-adminsdk-tvzms@bukuluku-28d5a.iam.gserviceaccount.com",
                "client_id"=> "111333551182374213524",
                "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
                "token_uri"=> "https://oauth2.googleapis.com/token",
                "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
                "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-tvzms%40bukuluku-28d5a.iam.gserviceaccount.com",
                "universe_domain"=> "googleapis.com"
              
        ])
        ->withDatabaseUri('https://bukuluku-28d5a-default-rtdb.asia-southeast1.firebasedatabase.app/');
    
        $this->database = $firebase->createDatabase();
    }

    public function getDatabase() {
        return $this->database;
    }
}
?>

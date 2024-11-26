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
            "private_key_id"=> "3c83af313ecb50af614c0874ed0806c819ef9875",
            "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCwp0pymzl8sFOI\n/ndaaNuz2vgox+doEMm5maPDkWLadOBHgcLDg/RzJXNGdlyl/Oceo7wkfiHu0TTu\ndEN+W0NYt8qNMRLP2qHIQxdLDi3GnJfMKjjd6Ym61WWyTQFmKZoFGKr5ekJI/Rj+\nKSr43x8nHKwXM0emvHHixw1uZRPkbS7CPznBUuNvEPKZwhzYVcOb6QPAL7S97iSL\nZx8iZ0Qn2BOp2Sgk8AZe2lOmn8Ois44lyz5NMrtvoWumqKzEXaYrHyV381C9nuBK\n5887ll8HLZvcbc5cdEjxIZyJJCys5My37P/dGCwq+j6BqBHtSl9SDaTVUWJeBVq4\ncNPJKfyxAgMBAAECggEADBy0TI5bDzMRzzNPYKoO4lKRsE4gjjCUfD7ODTMzOXJJ\nDG4XugsaoCiBsmOcL59bA21LkZ76WaMLg4wCMrA0OmmDoFGsjgbaD96VwsYqmlMT\nT2LXulNwZ5iJHAQOpAAXOOE7m9ZnpBSCea697QlzW92p6P9RmtuR3XAzeg3BIujC\nIL8r8u7A+0VE9EEj7nf+N0KikuR6rkaDhobA4l4gXUcQ3qviPzb973XROKkKXmyP\ngPjT8r0+1j/nCG/tdYvF5cgkOCAhy6tSwOwet79yspoeJ8xYHYLSxsqDliQ/HRaX\nAEUVcdrdXhb5FwSRSi4SeRk7P4Kv5gl/4bpj6sKFxwKBgQDytEqgReFgu0COQlxo\nmAVULKEHYtM8ltTzJva4Vlxw7vyeWZKsDM7iBX5U37JdDZfeNrKXwfFZQtK5sTxx\nuxTjYBLBTavqM2EK5Km3DXqoREefDJwuqKJRIqVUz/j0F9jUPj7RrIyUV4+2QUvZ\n7egocMDT54FfTa1m08eJSHBX7wKBgQC6VLJUtkh3u+sKqtrMOtlpd35Yg5X6QqlQ\nGPcART90B1pwSV4MBr1ZMUtSII58LTJdqm1Xv75J2T7a9WWDj+TWME/8zeFQDDbq\nfkNbNtgJBlzfKb90eDQOVQjrpiZkdZ2Vd6cwcYgiNiC3QM6ZbsUqIyWoPN0e2l6C\nTuWkyylVXwKBgQCCZM67MRAXMkNKquiO4S3rvVZ+a1/l63tZb5OaEfv0SNG8GY+t\nk+wKjr0CyHRBfi4bmvN0iSQrurUQQuKgj8x3JISvChXU6+m1Oojb6gf+I0D/eHzo\nrH0Ybi65VEsCiVVbIl4JtFSK1khFuOsRmLnkED/pGTXuiAMjfaB0Z1DETQKBgE5M\nFt+39T2zDnJeFzDorcE+wC3LpXMTHfiVdP19G8vS5zL18XoWPuzC5QauvZD6oQZw\n/h94aCq6CkqSAcVF6wACLyppDPvJFi51PjKPGjq4nL/92ADGHgHDw8rZ95oRPlW3\ngN6/ZlgR7K90oRwiSuGJAWLvqG81ja8uHhugb077AoGBAIw1EL+PGtgrpNOP5HNH\nb58DjssBrV33T3id7ut+/o14URIpyRoIC2EaW+ohwHxVVtyCJxWRloUjTcEaWZvn\n75Q3VQ2fCtxfNScjFYYWRfpNo7I/Myk4q489ghno8Sslip+qq9bBWGybQ06PFHgb\nMXl1HENCvSq6U7ncznKrLFX5\n-----END PRIVATE KEY-----\n",
            "client_email"=> "firebase-adminsdk-tvzms@bukuluku-28d5a.iam.gserviceaccount.com",
            "client_id"=> "111333551182374213524",
            "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
            "token_uri"=> "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-tvzms%40bukuluku-28d5a.iam.gserviceaccount.com",
            "universe_domain"=> "googleapis.com"
            // Tambahkan parameter lainnya dari file JSON
        ])
        ->withDatabaseUri('https://bukuluku-28d5a-default-rtdb.asia-southeast1.firebasedatabase.app/');
    
        $this->database = $firebase->createDatabase();
    }

    public function getDatabase() {
        return $this->database;
    }
}
?>

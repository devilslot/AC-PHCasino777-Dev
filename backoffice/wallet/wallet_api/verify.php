<?php
    function hashPassword($username, $password, $time) {
        $a = hash('sha256', $username . $password);
        $b = hash('sha256', (strlen($time) > 4) ? substr($time, 4) : $time);
        return hash('sha256', $b . $a);
    }
    function generateSignature($data) {
        return hash_hmac('sha1', $data, '9LXAVCxcITaABNK48pAVgc4muuTNJ4enIKS5YzKyGZ');
    }

    class Truewallet {
        private $phoneNumber;
        private $password;
        private $deviceID;
        private $mobileTracking;

        public function __construct($phoneNumber, $password) {
            $this->phoneNumber = $phoneNumber;
            $this->password = $password;
            $this->deviceID = strtoupper('e7555fe7-b9fe-4fe5-a075-a560ab96e6xd');
            $this->mobileTracking = base64_encode($this->deviceID);
        }

        public function requestOTP() {
            $timestamp = round(microtime(true) * 1000);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://mobile-api-gateway.truemoney.com/mobile-api-gateway/mobile-auth-service/v1/password/login/otp');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'User-Agent: V1/5.5.1 (com.tdcm.truemoneywallet; build:674; iOS 13.3.1) Alamofire/4.8.2',
                'timestamp: ' . $timestamp,
                'type: mobile',
                'username: ' . $this->phoneNumber,
                'password: ' . hashPassword($this->phoneNumber, $this->password, $timestamp)
            ]);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }

        function verifyOTP($otpRef, $otpCode) {
            $timestamp = round(microtime(true) * 1000);
            $password = hashPassword($this->phoneNumber, $this->password, $timestamp);
            $signature = generateSignature(implode('|', [$this->phoneNumber, $password, $this->deviceID, $this->mobileTracking, $otpCode, $otpRef, $this->phoneNumber]));
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://mobile-api-gateway.truemoney.com/mobile-api-gateway/mobile-auth-service/v1/password/login/otp');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'User-Agent: V1/5.5.1 (com.tdcm.truemoneywallet; build:674; iOS 13.3.1) Alamofire/4.8.2',
                'timestamp: ' . $timestamp,
                'X-Device: ' . $this->deviceID
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'brand' => 'apple',
                'device_os' => 'ios',
                'device_name' => 'chick4nnn’s iPhone',
                'device_id' => $this->deviceID,
                'model_number' => 'iPhone 11 Pro',
                'model_identifier' => 'iPhone 11 Pro',
                'app_version' => '5.5.1',
                'type' => 'mobile',
                'username' => $this->phoneNumber,
                'password' => $password,
                'mobile_tracking' => $this->mobileTracking,
                'otp_code' => $otpCode,
                'otp_reference' => $otpRef,
                'timestamp' => $timestamp,
                'mobile_number' => $this->phoneNumber
            ]));
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }

        function getTransactions($startDate, $endDate, $accessToken) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://mobile-api-gateway.truemoney.com/mobile-api-gateway/user-profile-composite/v1/users/transactions/history?start_date=' . $startDate . '&end_date=' . $endDate . '&limit=50&page=1');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'User-Agent: V1/5.5.1 (com.tdcm.truemoneywallet; build:674; iOS 13.3.1) Alamofire/4.8.2',
                'X-Device: ' . $this->deviceID,
                'Authorization: ' . $accessToken
            ]);
            $result = curl_exec($ch);
            curl_close($ch);
            return json_decode($result, true);
        }
    }

    $wallet = new Truewallet('0830806416', '77887788a');
    //var_dump($wallet->requestOTP());
    var_dump($wallet->verifyOTP($_GET['ref'], $_GET['otp']));
    // var_dump($wallet->getTransactions('2019-12-27', '2020-03-28', 'ACCESS_TOKEN'));
?>
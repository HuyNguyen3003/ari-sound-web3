<?php
if ($option == 'update') {
if (defined('IS_LOGGED') && IS_LOGGED == false) {
    $data['status'] = 300;
} else {
    if (isset($_POST['wallet']) && isset($_POST['address'])) {
    $wallet = secure($_POST['wallet']); 
    $address = secure($_POST['address']); 
    // get all wallet user
    $userId = $music->user->id;
    $totalReword = $db->where('user_id', $userId)->getValue(T_POINT_SYSTEM, "SUM(reword)");
        if ($totalReword < $wallet) {
            $data['status'] = 400;
            $data['error'] = 'Not enough balance';
        }else{
            // update wallet user
            $db->insert(T_POINT_SYSTEM, array(
            'user_id' => $music->user->id,
            'action' => 'update-wallet',
            'reword' => $wallet * 1000 * -1,
            'is_add' => 1,
            'time' => time()
            ));
            // sendcoin
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://sendcoin:8888/api/sendreward',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'receiverAddress' => $address,
                    'amount' => $wallet
                )),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));
            $response = curl_exec($curl);
             if (curl_errno($curl)) {
                $data['status'] = 500;
                $data['error'] = 'CURL Error:CHECK ' . curl_error($curl);
            } else {
                $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                if ($http_code == 200) {
                    $data['status'] = 200;
                    $data['message'] = 'success';
                    header('Content-Type: application/json');
                    json_encode($data);
                } else {
                    $data['status'] = $http_code;
                    $data['error'] = 'HTTP Error: ' . $response;
                }
            }
            curl_close($curl);
          }
        } else {
            $data['status'] = 400;
            $data['error'] = 'Missing wallet or address parameter.';
        }
    }
     header('Content-Type: application/json');
    // Trả dữ liệu về dưới dạng JSON
     json_encode($data);
}
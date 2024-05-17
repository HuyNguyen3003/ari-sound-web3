<?php






if ($option == 'get-adsms-detail'){
              if (!empty($_REQUEST['type'])) {
               
                  $type = secure($_REQUEST['type']); 
                 
                $res =   $db->where('type', $type)->get(T_ADSMS);
                $data['status'] = 200;
                $data['data'] = $res;
              }
         
}


if ($option == 'update-adsms-detail'){
          if (IS_LOGGED == false) {
              $data['status'] = 300;
          } else {
              if (!empty($_POST['id']) && !empty($_POST['provider']) && !empty($_POST['description']) && !empty($_POST['scripts'])) {
                  // Kiểm tra các tham số cần thiết từ yêu cầu POST
                  $id = secure($_POST['id']); // Bảo mật giá trị id
                  $provider = secure($_POST['provider']); // Bảo mật giá trị provider
                  $description = secure($_POST['description']); // Bảo mật giá trị description
                  $scripts = secure($_POST['scripts']); // Bảo mật giá trị scripts
      
                  // Cập nhật các trường dữ liệu cụ thể trong cơ sở dữ liệu
                  $db->where('id', $id)->update(T_ADSMS, ['provider' => $provider, 'description' => $description, 'scripts' => $scripts]);
                  
                  $data['status'] = 200; // Trả về mã thành công nếu cập nhật thành công
              }
          }
      }

      if ($option == 'get-adsms-all'){
     if (IS_LOGGED == false) {
              $data['status'] = 300;
    } else {
       

            $type = secure($_REQUEST['type']);

            $res = $db->get(T_ADSMS);
            $data['status'] = 200;
            $data['data'] = $res;
     
    }
         
}
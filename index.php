<?php
require_once('db_connect.php');
require_once('functions.php');



if (!isset($_REQUEST['action'])){
          $_REQUEST['action'] = 'view';
}  

if($_REQUEST['action'] == 'post_data'){
          post_data($_REQUEST);
          exit(1);
}
elseif($_REQUEST['action'] == 'get_data'){
          $lists = get_data();
          foreach($lists as $t){
                    $data[] = array(
                              'id' => $t['id'],
                              'subject' => $t['subject'],
                              'question' => $t['question'],
                              'local_time' => utc_string_to_local_date($t['time']),
                              'answered' => $t['answered'],
                            );
          }
          $list = json_encode($data);
          echo $list;
          exit(1);
}
elseif($_REQUEST['action'] == 'answered'){
          answered($_REQUEST['aid']);
          exit(1);
}
elseif($_REQUEST['action'] == 'view'){
          $list = get_data();
          require_once('header.html');
          require_once('view.html'); 
          require_once('posting.html'); 
          require_once('footer.html');
}
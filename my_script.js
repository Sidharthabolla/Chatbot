var app1 = angular.module('app1', []);

app1.controller('ctrl1', function($scope) {

  $scope.subject = '';
  $scope.question = '';
  $scope.all_posts = '';

  $scope.answered = function(id,ans) {  
    $.ajax({
      url : 'index.php',
      type : 'POST',
      data : {
          'aid' : id,
	  'ans' : ans,
          'action': 'answered',
        },
      //dataType:'json',
      success : function(data) {  
	if(ans == 1){
          anime(id);
        } else {unanime(id)}        
      },
      error : function(request,error)
      {
        alert("Request: "+JSON.stringify(request));
      }
    });  
  };

  
$scope.postData = function() {  
    if($scope.subject == '' ||  $scope.question == ''){
      alert('Please fill the subject and the Question Box');
    }else{
    $.ajax({
      url : 'index.php',
      type : 'POST',
      data : {
          'subject' : $scope.subject,
          'question' : $scope.question,
          'action': 'post_data',
        },
      //dataType:'json',
      success : function(data) {  
        $scope.$apply(function () {
          $scope.subject = '';
          $scope.question = '';
        });
      },
      error : function(request,error)
      {
        //alert("Request: "+JSON.stringify(request));
      }
    }); 
    $scope.getData();
  }
  };



  $scope.getData = function() {  
    $.ajax({
      url : 'index.php',
      type : 'GET',
      data : {
          'subject' : $scope.subject,
          'question' : $scope.question,
          'action': 'get_data',
        },
      dataType:'json',
      success : function(data) {  
       // console.log(data);
        $scope.$apply(function () {
          $scope.all_posts = data;
        });
      },
      error : function(request,error)
      {
        ///alert("Request: "+JSON.stringify(request));
      }
    }); 
  };
    
function anime(id){
    $('#ack'+id).fadeOut(function(){
      $('#unack'+id).fadeIn();
    });
    $('#'+id).animate({
      backgroundColor: "#dff0d8"
    }, 500 );
  }
  
  function unanime(id){
    $('#unack'+id).fadeOut(function(){
      $('#ack'+id).fadeIn();
    });
    $('#'+id).animate({
      backgroundColor: "#eed0d0"
    }, 500 );
  }


  setInterval(function(){
    $scope.getData();
  },6000)
});

<?php 

?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
    
    
    <script src="https://code.jquery.com/jquery-2.2.3.js" ></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
   
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="#"><strong>B E R T O</strong> CAR SHOP</a>
        </div>
      </div><!-- /.container -->
    </nav>    
   
    
    
    <div class="row">
        <div class="container">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li class="active">Car List</li>
                </ol>
            <!-- /.breadcrumb -->    
            <h1>Car List</h1>
            <hr>
            </div>
            <div class="col-lg-8" >
                <div id="list">
                  
                </div>
            </div>
            
            <div class="col-lg-4">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <a href="#modal" data-toggle="modal" data-title="Add Item" data-button="Save" >Add Item</a>
                  </div>
                </div>
                
                
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3 class="panel-title">Filter</h3>  
                  </div>
                  <div class="panel-body">
                      <label>Filter By:</label>
                      <select class="form-control" id="filter">
                        <option value="3" selected>None</option>
                        <option value="1" selected>Blue Car</option>
                        <option value="2" selected>Red Car</option>
                      </select>    
                  </div>
                </div>
            </div>
        </div>
    </div>
    
@include('cars.modal')
<script>

$('#filter').val(3);

load_car_list();

$('#filter').change(function(){
   var id = $(this).val();
   $.ajax({
       url : 'http://localhost:8000/car/filter',
       type: 'POST',
       data: {'id':id ,'_token': '{!! csrf_token() !!}'},
       success: function(data){
           $('#list').html(data);
       }
   });
});

function load_car_list(){
  $.ajax({
       url: '/car/car_list', 
       type: 'get',
       success: function(data){
           $('#list').html(data);
       }
    });
}
    $('#filter').val(3);

    $('#modal').on('shown.bs.modal',function(e){
        var button = $(e.relatedTarget);
        var modal_button_title = button.attr('data-button');
        var modal_button = $('#modal_button');
        $('.modal-title').html(button.attr('data-title'));          
        if(modal_button_title == 'Save'){
            modal_button.show();
            modal_button.addClass('btn-primary');
            modal_button.removeClass('btn-danger btn-info');
            modal_button.html(modal_button_title);
            $('#modal_content').load('http://localhost:8000/car/add');
            modal_button.on('click',function(){
                $.ajax({
                  url:$('#create_form').attr('action'),
                  type: 'POST',
                  data: $('#create_form').serialize()
                });

            $('#create_form')[0].reset();
            $('#modal').modal('hide');
            load_car_list();
            });
            
        }
        else if(modal_button_title == 'Update'){
            modal_button.show();
            modal_button.addClass('btn-info');
            modal_button.removeClass('btn-danger btn-primary');
            modal_button.html(modal_button_title);
            $.ajax({
                  url:'car/edit',
                  type: 'POST',
                  data: {'_token': '{!! csrf_token() !!}','id':button.attr('data-id')},
                  success: function(data){
                    $('#modal_content').html(data);
                  }
            });
             modal_button.on('click',function(){
             if($('#move_front').val()){   
                $.ajax({
                  url: 'car/update/'+button.attr('data-id')+'/'+$('#move_front').val()+'/true',
                  type: 'get'
                });
              }else{
                $.ajax({
                  url: 'car/update/'+button.attr('data-id')+'/'+$('#move_behind').val()+'/false',
                  type: 'get'
                });
              }
            $('#modal').modal('hide');
            load_car_list();
            });


        }
        else if(modal_button_title == 'Delete'){
            modal_button.show();
            modal_button.addClass('btn-danger');
            modal_button.removeClass('btn-info btn-primary');
            modal_button.html(modal_button_title);
            $('#modal_content').html('Are you sure to delete this car?');
            modal_button.on('click',function(){
              $.ajax({
                  url:'car/delete',
                  type: 'POST',
                  data: {'_token': '{!! csrf_token() !!}','id':button.attr('data-id')},
                  success: function(data){
                   
                  }
            });
            $('#modal').modal('hide');
            load_car_list();
            });
        }else{
            modal_button.hide();
            $.ajax({
                  url:'car/view',
                  type: 'POST',
                  data: {'_token': '{!! csrf_token() !!}','id':button.attr('data-id')},
                  success: function(data){
                    $('#modal_content').html(data);
                  }
            });
        }
            
    });
</script>
</body>
</html>

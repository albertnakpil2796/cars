@if(count($cars) > 0)
<table class="table table-bordered table-striped" >
    <thead>
        <tr>
            <th>Car name</th>
            <th>Color</th>
            <th width="15%">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($cars as $car)
        <tr>
            
            <td>{{$car->name}}</td>
            <td>{{$car->colors->color_name}}</td>
            <td>
                <a href="#modal" data-toggle="modal" data-title="View Car" data-button="None" class="btn btn-xs btn-primary" data-id="{{$car->id}}"><i class="fa fa-eye"></i></a>
                <a href="#modal" data-toggle="modal" data-title="Update Car" data-button="Update" class="btn btn-xs btn-info" data-id="{{$car->id}}"><i class="fa fa-edit"></i></a>
                <a href="#modal" data-toggle="modal" data-title="Delete Car" data-button="Delete" class="btn btn-xs btn-danger" data-id="{{$car->id}}"><i class="fa fa-trash"></i></a>
            </td>
            
        </tr>
    @endforeach    
    </tbody>
</table>
@else
<h2> No Data Found...</h2>

@endif
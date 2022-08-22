@extends('layouts.app')
@section('content')

<!--************
    Content body start
*************-->
<div class="content-body">
    <div class="container-fluid">
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Listing</h4>
                    <a href="{{route('products.create')}}" class="btn btn-primary btn-sm ">Add New</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <button style="margin-bottom: 10px" class="btn btn-primary delete_all" data-url="{{ url('deleteallProducts') }}">Delete All Selected</button>
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                <th width="50px"><input type="checkbox" id="master"></th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>UPC</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key=>$row)
                                <tr id="tr_{{$row->id}}">
                                <td><input type="checkbox" class="sub_chk" data-id="{{$row->id}}"></td>
                                    <td>{{++$key}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->price}}</td>
                                    <td>{!! DNS1D::getBarcodeHTML($row->upc, 'UPCA') !!}</td>
                                    <td>{{$row->status}}</td>
                                    <td> <img src="images/{{$row->image}}" style="height:50px"></td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('products.edit',$row->id)}}" style="margin-right: 20px;"
                                                class="btn btn-primary btn-lg active">Edit</a>

                                            <form action="{{ route('products.delete', $row->id) }}" method="POST"
                                                onsubmit="return confirm('{{trans('Are You Sure')}}');"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-danger btn-lg active"
                                                    value="Delete">
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!--************
    Content body end
*************-->

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  


            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  


                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  


                    var join_selected_values = allVals.join(","); 


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>
@endsection
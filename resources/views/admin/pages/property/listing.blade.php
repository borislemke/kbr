@extends('admin.master')
@section('page', 'properties')

@section('fab')

<!-- <m-fab salmon class="modal-open" data-target="#property-add"><i class="material-icons">add</i></m-fab> -->
<a href="{{ route('admin.properties', ['term' => null, 'action' => 'create', 'category' => $request['category']]) }}"><m-fab salmon><i class="material-icons">add</i></m-fab></a>

@stop

@section('content')
<br>

<m-template list class="property-wrapper">

    <table id="property-table">
        <thead>
            <td width="5%">
                <!-- <m-list-item-check all class="item-select-all"></m-list-item-check> -->
                Id
            </td>
            <td>Image</td>
            <td>Title</td>
            <td>Code</td>
            <td>Type</td>
            <td>Status</td>
            <td>Agent</td>
            <td>Price</td>
            <td>View</td>
            <td>Created</td>
            <td>Action</td>
        </thead>

    </table>


</m-template>

@endsection

@section('scripts')

<script>
    // Matter.admin.properties();

    $(document).ready(function() {        

        $(document).on('click', '[delete]', function(event) {
            event.preventDefault();

            var id = $(this).parent().attr('data-id');            
            var url = "{{ route('api.property.delete', $id = null) }}/" + id;
            // var method = 'delete';
            var token = "{{ csrf_token() }}";

            Monolog.confirm('delete item', 'are you sure to delete this item? this cannot be undone', function() {
                NProgress.start();
                $.post(url, {_token: token}, function(data, textStatus, xhr) {
                    
                    switch(data.status) {

                        case 200:

                            Monolog.notify(data.monolog.title, data.monolog.message);

                            removeItem(data);

                            break;

                        default:

                            Monolog.notify(data.monolog.title, data.monolog.message);

                            consoleLog(data);
                    }
                });
            });

        });

        $('#property-table').DataTable({
            "processing": true,
            "serverSide": true,            
            "ajax": {
                "url": "{!! $api_url !!}",
                "type": "GET"
            },
            "deferRender": true,
            "columns": [                
                {"data": "id"}
                ,{
                    "orderable": false,
                    "targets": 1,
                    "data": "attachments",
                    "render": function (data, type, row) {

                        if (data.length != 0) {

                            return '<img width="100" src="'+ baseUrl +'/uploads/property/' + data[0].file +'">';
                        } else {

                            return '<img width="100" src="'+ baseUrl +'/no-image.png">';
                        }

                    }
                    
                },
                {
                    "data": "property_locales",
                    "render": function (data, type, row) {

                        if (data.length != 0) {

                            return data[0].title;
                        } else {

                            return '-';
                        }

                    }

                },
                {"data": "code"},
                {"data": "type"},
                {
                    "data": "status",
                    "render": function (data, type, row) {
                        var output = '';

                        switch(data) {
                            case '0':
                                output = 'UNAVAILABLE';
                                break;
                            case '1':
                                output = 'AVAILABLE';
                                break;
                            case '-1':
                                output = 'HIDDEN';
                                break;
                            case '-2':
                                output = 'MODERATION';
                                break;
                        }
                        return output;
                    }
                },
                {
                    "data": "user",
                    "render": function (data, type, row) {
                        return  data ? data.username : '-';
                    }
                },
                {
                    "data": "price",
                    "render": function (data, type, row) {

                        return (""+ data).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
                    }
                },
                {"data": "view"},
                {
                    "data": "created_at",
                    "render": function (data, type, row) {
                        var date = new Date(data);
                        var newDate = date.toISOString().split('T')[0];
                        return newDate;
                    }
                },
                {
                    "orderable": false,
                    "data": 'id',
                    "render": function (data, type, row) {

                        return ''
                        + '<m-table-list-more>'
                            + '<i class="material-icons">more_horiz</i>'
                            + '<m-list-menu data-id="'+ data +'">'
                                + '<a href="'+ baseUrl +'/admin/properties?category={{ Input::get("category") }}&action=edit&id='+ data +'"><m-list-menu-item edit data-source="property/get" data-function="populatePropertyEdit">EDIT</m-list-menu-item></a>'
                                + '<a href="'+ baseUrl +'/admin/properties?category={{ Input::get("category") }}&action=edit-translation&id='+ data +'"><m-list-menu-item data-function="populatePropertyTranslate">TRANSLATION</m-list-menu-item></a>'
                                + '<m-list-menu-item delete data-url="property/destroy">DELETE</m-list-menu-item>'
                            + '</m-list-menu>'
                        + '</m-table-list-more>';
                    }
                }

            ],
            "createdRow": function ( row, data, index ) {

                $('td', row).eq(7).css('text-align', 'right');
                $('td', row).eq(8).css('text-align', 'right');

                $(row).attr('id', 'row-item-' + data.id);

                $('td:last-child', row).attr('button', '');
            },
            "order": [[ 3, "desc" ]]
        });

    });

    function removeItem(data) {

        var id = data.id;

        $('#row-item-' + id).remove();

        NProgress.done();
    }

</script>

@endsection
@extends('admin.master')
@section('page', 'properties')

@section('fab')

<!-- <m-fab salmon class="modal-open" data-target="#page-add"><i class="material-icons">add</i></m-fab> -->
<a href="{{ route('admin.pages', ['term' => null, 'action' => 'create']) }}"><m-fab salmon data-target="#page-add"><i class="material-icons">add</i></m-fab></a>

@stop

@section('content')
<br>

<m-template list class="page-wrapper">

    <table>
        <thead>
            <td width="5%">
                <!-- <m-list-item-check all class="item-select-all"></m-list-item-check> -->
                Id
            </td>
            <td>title</td>
            <td>slug</td>
            <td>route</td>
            <td>status</td>
            <td>Created</td>
            <td>Action</td>
        </thead>

    </table>


</m-template>

@endsection

@section('scripts')

<script>
    // Matter.admin.pages();

    $(document).ready(function() {

        $(document).on('click', '[delete]', function(event) {
            event.preventDefault();

            var id = $(this).parent().attr('data-id');            
            var url = "{{ route('api.page.destroy', $id = null) }}/" + id;
            var method = 'delete';
            var token = "{{ csrf_token() }}";

            Monolog.confirm('delete item', 'are you sure to delete this item? this cannot be undone', function() {
                NProgress.start();
                $.post(url, {_method: method, _token: token}, function(data, textStatus, xhr) {
                    
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

        $('table').DataTable({
            "processing": true,
            "serverSide": true,            
            "ajax": {
                "url": "{!! $api_url !!}",
                "type": "GET"
            },
            "deferRender": true,
            "columns": [
                {"data": "id"},
                {"data": "page_locales.0.title"},
                {"data": "slug"},
                {"data": "route"},
                {
                    "data": "status",
                    "render": function (data, type, row) {
                        return data == 1 ? 'publish' : 'draft';
                    }
                },
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
                                + '<a href="'+ baseUrl +'/admin/pages?action=edit&id='+ data +'"><m-list-menu-item edit data-source="property/get" data-function="populatePropertyEdit">EDIT</m-list-menu-item></a>'
                                + '<m-list-menu-item delete data-url="property/destroy">DELETE</m-list-menu-item>'
                            + '</m-list-menu>'
                        + '</m-table-list-more>';
                    }
                }
            ],
            "createdRow": function ( row, data, index ) {

                $('td:last-child', row).attr('button', '');

                $(row).attr('id', 'row-item-' + data.id);
            },
            "order": [[ 0, "desc" ]]
        });

    });

    function removeItem(data) {

        var id = data.id;

        $('#row-item-' + id).remove();

        NProgress.done();
    }

</script>

@endsection
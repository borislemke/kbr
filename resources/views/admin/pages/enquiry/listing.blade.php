@extends('admin.master')
@section('page', 'properties')

@section('fab')

<m-fab salmon class="modal-open" data-target="#enquiry-add"><i class="material-icons">add</i></m-fab>

@stop

@section('content')
<br>

<m-template list class="enquiry-wrapper">

    <table>
        <thead>
            <td width="5%">
                <!-- <m-list-item-check all class="item-select-all"></m-list-item-check> -->
                Id
            </td>
            <td>Image</td>
            <td>Property</td>
            <td>Subject</td>
            <td>Name</td>
            <td>Created</td>
            <td>Action</td>
        </thead>

    </table>


</m-template>

@endsection

@section('scripts')

<script>
    // Matter.admin.enquiries();

    $(document).ready(function() {

        $(document).on('click', '[delete]', function(event) {
            event.preventDefault();

            var id = $(this).parent().attr('data-id');            
            var url = "{{ route('enquiry.destroy') }}/" + id;
            var method = 'delete';
            var token = "{{ csrf_token() }}";

            $.post(url, {_method: method, _token: token}, function(data, textStatus, xhr) {

                switch(data.status) {

                    case 200:

                        Monolog.notify(data.monolog.title, data.monolog.message);

                        doneFunc(data);

                        break;

                    default:

                        Monolog.notify(data.monolog.title, data.monolog.message);

                        consoleLog(data);
                }

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
                {
                    "orderable": false,
                    "data": "property.attachments",
                    "render": function (data, type, row) {

                        if (data.length != 0) {

                            return '<img width="100" src="'+ baseUrl +'/uploads/property/' + data[0].file +'">';
                        } else {

                            return '<img width="100" src="'+ baseUrl +'/no-image.png">';
                        }

                    }
                },
                {"data": "property.property_locales.0.title"},
                {"data": "subject"},
                {"data": "firstname"},
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
                                + '<m-list-menu-item delete data-url="property/destroy">DELETE</m-list-menu-item>'
                            + '</m-list-menu>'
                        + '</m-table-list-more>';
                    }
                }
            ],
            "createdRow": function ( row, data, index ) {
                $('td:last-child', row).attr('button', '');
            },
            "order": [[ 0, "desc" ]]
        });

    });

</script>

@endsection
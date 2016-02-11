@extends('admin.master')
@section('page', 'properties')


@section('fab')

<m-fab salmon class="modal-open" data-target="#property-add"><i class="material-icons">add</i></m-fab>


@stop

@section('content')

    <table id="property-list" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>image</th>
                <th>title</th>
                <th>price</th>
                <th>status</th>
                <th>agent</th>
                <th>created</th>
            </tr>
        </thead>
    </table>

@endsection

@section('scripts')

<script>
    Matter.admin.properties();

    $(document).ready(function() {

        $('#property-list').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "{{ baseUrl() }}/system/ajax/property/all"
        } );

    });
</script>

@endsection
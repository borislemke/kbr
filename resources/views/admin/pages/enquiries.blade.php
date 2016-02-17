@extends('admin.master')
@section('page', 'enquiries')


@section('content')

<div class="search-input w25-6">
    <form>
        <input value="{{ Input::get('q') }}" class="w50-6" name="q" type="text" placeholder="search">
    </form>
</div>

<m-template list class="inquiry-wrapper">

    @if(isset($enquiries) AND count($enquiries) > 0)

    <table id="enquiry-table" class="m-table-list enquiry-table">
        <thead>
            <td><a href class="m-table-item-select m-table-item-select-all inquiry-item-select-all"><i class="m-checkbox"></i></a></td>
            <td>Property</td>
            <td>Subject</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Action</td>

        </thead>
        <tbody>
            @foreach($enquiries as $inquiry)
            <tr class="inquiry-item" data-id="{{ $inquiry->id }}" id="inquiry-item-{{ $inquiry->id }}">
                <td class="select"><a href class="m-table-item-select m-table-item-select-single" data-id="1"><i class="m-checkbox"></i></a></td>
                <td class="property">{{ $inquiry->property ? $inquiry->property->lang()->title : '-' }}</td>
                <td class="subject">{{ $inquiry->subject }}</td>
                <td class="name">{{ $inquiry->firstname . ' ' . $inquiry->lastname }}</td>
                <td class="phone">{{ $inquiry->phone }}</td>
                <td class="email">{{ $inquiry->email }}</td>

                <td button>
                    <m-table-list-more>
                        <i class="material-icons">more_horiz</i>
                        <m-list-menu data-id="{{ $inquiry->id }}">
                            <m-list-menu-item edit data-source="inquiry/get" data-function="populateInquiryEdit">EDIT</m-list-menu-item>
                            <m-list-menu-item delete data-url="inquiry/destroy">DELETE</m-list-menu-item>
                        </m-list-menu>
                    </m-table-list-more>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else

    <p class="empty-content">No inquiries created yet. Create one now</p>

    @endif

</m-template>

<p style="float: left">Total: {{ $enquiries->total() }} rows</p>

@include('admin.fragments.pagination', ['paginator' => $enquiries])

@endsection


@section('modal')

<m-modal-wrapper id="enquiry-add">

    {!! Form::open(array('class' => 'modal-window', 'id' => 'enquiry-form', 'data-function' => 'modalClose', 'data-url' => 'inquiry/store')) !!}
    <h3>Add enquiry</h3>

    <m-input>
        <input type="text" id="inquiry-input-subject" name="subject" required>
        <label for="inquiry-input-subject">Subject</label>
    </m-input>

    <m-input-group textarea>
        <h3 class="input-group-title">Content</h3>
        <div class="input-wrapper fwidth">
            <textarea name="content" id="inquiry-input-content" rows="5"></textarea>
        </div>
    </m-input-group>

    <m-input>
        <input type="text" id="inquiry-input-firstname" name="firstname" required>
        <label for="inquiry-input-firstname">Firstname</label>
    </m-input>

    <m-input>
        <input type="text" id="inquiry-input-lastname" name="lastname" required>
        <label for="inquiry-input-lastname">Lastname</label>
    </m-input>

    <m-input>
        <input type="text" id="inquiry-input-phone" name="phone" required>
        <label for="inquiry-input-phone">Phone</label>
    </m-input>

    <m-input>
        <input type="text" id="inquiry-input-email" name="email" required>
        <label for="inquiry-input-email">Email</label>
    </m-input>

    <input type="hidden" name="author" id="account-input-admin" value="admin">
    <input type="hidden" name="edit" value="0" id="edit-flag">

    <div class="button-holder align-right">
        <m-button plain modal-close>cancel</m-button>
        <m-button plain save-form>save</m-button>
    </div>
    {!! Form::close() !!}
</m-modal-wrapper>
@stop

@section('scripts')

<script>
    Matter.admin.inquiries();
</script>

@endsection

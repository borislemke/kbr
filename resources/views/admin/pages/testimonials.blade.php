@extends('admin.master')
@section('page', 'testimonials')

@section('content')

<div class="search-input w25-6">
    <form>
        <input value="{{ Input::get('q') }}" class="w50-6" name="q" type="text" placeholder="search">
    </form>
</div>

<m-template list class="testimony-wrapper">

    @if(isset($testimonials) AND count($testimonials) > 0)

    <table class="m-table-list testimonials-table">
        <thead>
            <td width="3%"><a href class="m-table-item-select m-table-item-select-all"><i class="m-checkbox"></i></a></td>
            <td width="22%">name</td>
            <td width="22%">title</td>
            <td width="58%">content</td>
            <td width="15%">created</td>
            <td width="15%" class="align-center">status</td>
            <td width="3%"></td>
        </thead>

        <tbody>
            @foreach($testimonials as $testimony)
            <tr class="testimony-item" id="testimony-item-{{ $testimony->id }}">
                <td class="select">
                    <m-list-item-check class="single" data-id="{{ $testimony->id }}"></m-list-item-check>
                </td>
                <td>{{ $testimony->customer->firstname . ' ' . $testimony->customer->lastname }}</td>
                <td>{{ $testimony->title }}</td>
                <td>{{ $testimony->content }}</td>
                <td>{{ $testimony->created_at->format('Y-m-d') }}</td>
                <td class="status align-center">{{ $testimony->status ? 'publish' : 'none'}}</td>

                <td button>
                    <m-table-list-more>
                        <i class="material-icons">more_horiz</i>
                        <m-list-menu data-id="{{ $testimony->id }}">
                            <m-list-menu-item edit data-source="testimony/get" data-function="populateTestimonyEdit">EDIT</m-list-menu-item>
                            <m-list-menu-item delete data-url="testimony/destroy">DELETE</m-list-menu-item>
                        </m-list-menu>
                    </m-table-list-more>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else

    <p class="empty-content">No testimonials registered yet. Create one manually now</p>

    @endif
</m-template>

<p style="float: left">Total: {{ $testimonials->total() }} rows</p>

@include('admin.fragments.pagination', ['paginator' => $testimonials])

@endsection

@section('modal')

<m-modal-wrapper id="testimony-add">

    {!! Form::open(array('class' => 'modal-window', 'id' => 'testimony-form', 'data-function' => 'modalClose', 'data-url' => 'testimony/store')) !!}
    <h3>Add testimony</h3>
    <m-input-group class="m-input-group fwidth flexbox-wrap justify-between">

        <m-input w66-8>
            <input type="text" name="title" id="testimony-input-title" required>
            <label for="title">title</label>
        </m-input>

        <m-input data-label="status" select w33-8>
            <input type="text" select id="testimony-input-status" name="status" value="" required>
            <label for="testimony-input-status">status</label>
            <m-select>
                <m-option value="1">publish</m-option>
                <m-option value="0">none</m-option>
            </m-select>
        </m-input>

        <div class="m-input-group textarea fwidth flexbox flexbox-wrap">
            <h3 class="input-group-title">Content</h3>
            <div class="input-wrapper fwidth">
                <textarea name="content" id="testimony-input-content" rows="10" style="padding-top: 0"></textarea>
            </div>
        </div>

    </m-input-group>

    <input type="hidden" name="edit" value="0" id="edit-flag">

    <div class="button-holder align-right">
        <m-button plain class="modal-close">cancel</m-button>
        <m-button save-form plain>save</m-button>
    </div>
    {!! Form::close() !!}
</m-modal-wrapper>
@endsection

@section('scripts')

<script>
    Matter.admin.testimonials();
</script>

@endsection

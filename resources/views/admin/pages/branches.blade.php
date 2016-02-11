@extends('admin.master')
@section('page', 'branches')

@section('fab')

<m-fab salmon class="modal-open" data-target="#branch-add"><i class="material-icons">add</i></m-fab>

@stop

@section('content')

<div class="search-input w25-6">
    <form>
        <input value="{{ Input::get('q') }}" class="w50-6" name="q" type="text" placeholder="search">
    </form>
</div>

<m-template list class="branch-wrapper">

    @if(isset($branches) AND count($branches) > 0)

    <table class="m-table-list branches-table">
        <thead>
            <td width="3%"><a href class="m-table-item-select m-table-item-select-all"><i class="m-checkbox"></i></a></td>
            <td width="15%">name</td>
            <td width="15%">city</td>
            <td width="20%">province</td>
            <td width="20%">country</td>
            <td width="20%">manager</td>
            <td width="3%"></td>
        </thead>

        <tbody>
            @foreach($branches as $branch)
            <tr class="branch-item" id="branch-item-{{ $branch->id }}">
                <td class="select">
                    <m-list-item-check class="single" data-id="{{ $branch->id }}"></m-list-item-check>
                </td>
                <td>{{ $branch->name }}</td>
                <td>{{ $branch->city }}</td>
                <td>{{ $branch->province }}</td>
                <td>{{ $branch->country }}</td>
                <td>{{ $branch->manager }}</td>

                <td button>
                    <m-table-list-more>
                        <i class="material-icons">more_horiz</i>
                        <m-list-menu data-id="{{ $branch->id }}">
                            <m-list-menu-item edit data-source="branch/get" data-function="populateBranchEdit">EDIT</m-list-menu-item>
                            <m-list-menu-item delete data-url="branch/destroy">DELETE</m-list-menu-item>
                        </m-list-menu>
                    </m-table-list-more>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else

    <p class="empty-content">No branches registered yet. Create one manually now</p>

    @endif
</m-template>

<p style="float: left">Total: {{ $branches->total() }} rows</p>

@include('admin.fragments.pagination', ['paginator' => $branches])

@endsection

@section('modal')

<m-modal-wrapper id="branch-add">

    {!! Form::open(array('class' => 'modal-window', 'id' => 'branch-form', 'data-function' => 'modalClose', 'data-url' => 'branch/store')) !!}
    <h3>Add branch</h3>
    <m-input-group class="m-input-group fwidth flexbox-wrap justify-between">

        <m-input w66-8>
            <input type="text" name="name" id="branch-input-name" required>
            <label for="name">name</label>
        </m-input>

        <m-input data-label="city" select w33-8>
            <input type="text" select id="branch-input-city" name="city" value="" required>
            <label for="branch-input-city">city</label>
            <m-select>

                @foreach(\App\City::orderBy('city_name')->get() as $city)
                <m-option value="{{ $city->city_name }}">{{ $city->city_name }}</m-option>
                @endforeach

            </m-select>
        </m-input>

        <m-input fwidth>
            <input type="text" name="manager" id="branch-input-manager" required>
            <label for="manager">manager</label>
        </m-input>

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
    Matter.admin.branches();
</script>

@endsection

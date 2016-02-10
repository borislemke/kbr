@extends('admin.master')
@section('page', 'messages')

@section('content')

<div class="search-input w25-6">
    <form>
        <input value="{{ Input::get('q') }}" class="w50-6" name="q" type="text" placeholder="search">
    </form>
</div>

<m-template list class="message-wrapper">

    @if(isset($messages) AND count($messages) > 0)

    <table class="m-table-list messages-table">
        <thead>
            <td width="3%"><a href class="m-table-item-select m-table-item-select-all"><i class="m-checkbox"></i></a></td>
            <td width="22%">name</td>
            <td width="22%">email</td>
            <td width="58%">message</td>
            <td width="15%">created</td>
            <td width="3%"></td>
        </thead>

        <tbody>
            @foreach($messages as $message)
            <tr class="message-item" id="message-item-{{ $message->id }}">
                <td class="select">
                    <m-list-item-check class="single" data-id="{{ $message->id }}"></m-list-item-check>
                </td>
                <td>{{ $message->firstname . ' ' . $message->lastname }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->created_at->format('Y-m-d') }}</td>

                <td button>
                    <m-table-list-more>
                        <i class="material-icons">more_horiz</i>
                        <m-list-menu data-id="{{ $message->id }}">
                            <m-list-menu-item delete data-url="message/destroy">DELETE</m-list-menu-item>
                        </m-list-menu>
                    </m-table-list-more>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @else

    <p class="empty-content">No messages registered yet. Create one manually now</p>

    @endif
</m-template>

<p style="float: left">Total: {{ $messages->total() }} rows</p>

@include('admin.fragments.pagination', ['paginator' => $messages])

@endsection

@section('scripts')

<script>
    Matter.admin.messages();
</script>

@endsection

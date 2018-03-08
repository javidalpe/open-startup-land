<table class="table table-bordered" id="startups-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Speech</th>
        <th>Website</th>
        <th>Metrics status</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($startups as $startup)
        <tr>
            <td>@include('components.startup')</td>
            <td>{!! $startup->speech !!}</td>
            <td>{!! $startup->website !!}</td>
            <td>@include('startups.components.status')</td>
            <td>
                {!! Form::open(['route' => ['startups.destroy', $startup->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('startups.edit', [$startup->id]) !!}" class='btn btn-secondary btn-xs'>Edit</a>
                    {!! Form::button('Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
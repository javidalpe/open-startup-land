<table class="table table-bordered" id="startups-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Speech</th>
        <th>Website</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($startups as $startup)
        <tr>
            <td>{!! $startup->name !!}</td>
            <td>{!! $startup->speech !!}</td>
            <td>{!! $startup->website !!}</td>
            <td>@include('startups.components.status')</td>
            <td>
                {!! Form::open(['route' => ['startups.destroy', $startup->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('startups.show', [$startup->id]) !!}" class='btn btn-default btn-xs' role="button"><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('startups.edit', [$startup->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
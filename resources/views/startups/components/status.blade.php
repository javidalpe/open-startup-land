@if($startup->status)
    <span class="badge badge-success">Ready</span>
@else
    <span class="badge badge-warning">Invalid endpoint</span>
@endif
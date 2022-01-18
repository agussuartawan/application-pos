<div class="card shadow-none acticity-data">
    <span>{!! $activity->description !!}</span>
    <span>Menu: <span class='badge badge-info'>{{ $activity->log_name }}</span></span>
    <span>Watku: {{ $activity->created_at->isoFormat('LLLL') }}</span>
    @foreach ($data as $activity)
        
    @endforeach
        <hr>
        <span>Aktivitas:</span>
        <ul class="list-group">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
</div>
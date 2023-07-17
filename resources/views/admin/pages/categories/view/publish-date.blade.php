<div class="badge  {{ ($row->published_at > date(now()) ? 'bg-label-danger' : 'bg-label-primary') }}">{{ \Illuminate\Support\Carbon::parse($row->published_at)->format('d, M-Y | H:i') }}</div>

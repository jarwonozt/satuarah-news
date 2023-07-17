<div class="badge  {{ ($row->created_at > date(now()) ? 'bg-label-danger' : 'bg-label-primary') }}">{{ \Illuminate\Support\Carbon::parse($row->created_at)->format('d, M-Y | H:i') }}</div>

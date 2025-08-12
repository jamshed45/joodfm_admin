@php
    $name = $name;
    $items = json_decode($itemsJson, true);
    $modalId = 'donation-items-modal-' . $recordId;
@endphp

<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
    View Items
</a>

<!-- Modal -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (!empty($items))
                    <table class="table table-bordered w-100">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
{{--
                            @php
                                echo "<pre>";
                                print_r($item['attribute']);
                                echo "</pre>";
                            @endphp --}}

                                <tr class="{{ $loop->odd ? 'table-row-odd' : 'table-row-even' }}">
                                    <td><strong>{{ $item['attribute']['name'] ?? '-' }}</strong></td>
                                    <td>{{ $item['value'] ?? '-' }}</td>
                                    <td>
                                        @if (!empty($item['amount']))
                                            {{ number_format($item['amount'], 2) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="Image"
                                                style="max-width: 100px; border: 1px solid #ccc; padding: 2px;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <span class="text-muted">No attributes added</span>
                @endif
            </div>
        </div>
    </div>
</div>

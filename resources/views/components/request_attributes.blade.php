<div id="attributeContainer" class="mt-3">
</div>
<div class="d-flex justify-content-end mt-2">
    <button type="button" class="btn btn-primary" id="addAttributeBtn" style="display:none;">
        Add Attribute
    </button>
</div>


@if (Str::contains(Route::currentRouteName(), 'edit'))
    {{-- Edit Mode --}}
@else
    {{-- Add Mode --}}
@endif

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        var savedAttributes = @json($savedAttributes ?? []);
        var selectedServiceId = '{{ $selectedServiceId ?? '' }}';

        console.log("Selected Service ID:", selectedServiceId);

        $(document).ready(function() {

            if (selectedServiceId) {
                $('#inventory_service_id').val(selectedServiceId).trigger('change');
            }

            if (savedAttributes.length > 0) {
                triggerSavedAttributes(savedAttributes);
            }
        });

        function triggerSavedAttributes(attributes) {
            console.log("Triggering saved attributes logic:", attributes);
            attributes.forEach(attr => {

                console.log("Attribute:", attr);
            });
        }

        $('#inventory_service_id').on('change', function() {
            let service_id = $(this).val();

            if (service_id) {
                $.ajax({
                    url: '{{ route('get.request.attributes', ':id') }}'.replace(':id', service_id),
                    type: 'GET',
                    data: {
                        saved: savedAttributes
                    },
                    success: function(response) {

                        $('#attributeContainer').html(response.html);
                        $('#addAttributeBtn').show();
                    },
                    error: function() {
                        $('#attributeContainer').html(
                            '<p class="text-danger">Unable to load attributes.</p>');
                    }
                });
            } else {
                $('#attributeContainer').empty();
                $('#addAttributeBtn').hide();
            }
        });

        let attrIndex = 1;

        $('#addAttributeBtn').on('click', function() {
            let service_id = $('#inventory_service_id').val();

            if (!service_id) {
                alert('Please select a service first.');
                return;
            }

            $.get('{{ route('get.request.attributes', ':id') }}'.replace(':id', service_id) + '?index=' + attrIndex, function(res) {
                $('#attributeContainer').append(res.html);
                attrIndex++;
            });
        });

        $(document).on('click', '.remove-attribute', function() {
            $(this).closest('.attribute-block').remove();
        });
    </script>
@endsection

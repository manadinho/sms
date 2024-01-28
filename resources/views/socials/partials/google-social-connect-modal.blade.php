<div id="google-modal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Google Businesses</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="google-accounts-draw-section" class="mt-4 modal-social-entities-listing-section"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="google-entitiy-connect-btn" onclick="doGoogleConnect()">Connect</button>
      </div>
    </div>
  </div>
</div>
@push('script')
    <script>

        $('#google-modal').on('show.bs.modal', function (event) {
            fetchInstaEntitiesAccounts();
        });

        window.GOOGLE_SELECTED_ENTITIES = {};

        function fetchInstaEntitiesAccounts() {
            if (window.CONNECTSTATUS !== null && window.CONNECTSTATUS === 'true') {
                window.GOOGLE_SELECTED_ENTITIES = {};
                $('#google-entitiy-connect-btn').html('Connect');
                $('#google-accounts-draw-section').html(getLoaderComponent());
                $.ajax({
                    url: "{{ route('socials.search-entities') }}",
                    method: 'POST',
                    data: {
                        provider: 'GOOGLE',
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#google-accounts-draw-section').html(response.html);
                        $('#google-accounts-draw-section').find('.entity-active').each(function(index, element) {
                            window.GOOGLE_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
                        });
                    }
                });
            }
        }
        
        function toggleGoogleEntity(element) {
            if($(element).data('entity').id in window.GOOGLE_SELECTED_ENTITIES) {
                delete window.GOOGLE_SELECTED_ENTITIES[$(element).data('entity').id];
            } else {
                window.GOOGLE_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
            }

            $('#google-entitiy-connect-btn').html('Connect ' + Object.keys(window.GOOGLE_SELECTED_ENTITIES).length);
            $(element).toggleClass('entity-active');
        }

        function doGoogleConnect() {
            if(!Object.keys(window.GOOGLE_SELECTED_ENTITIES).length) {
                alert('Please select at least one ');
                return;
            }

            $('#google-entitiy-connect-btn').html('Connecting...');
            $('#google-entitiy-connect-btn').attr('disabled', true);
            $.ajax({
                url: "{{ route('socials.connect-entities') }}",
                method: 'POST',
                data: {
                    provider: 'GOOGLE',
                    entities: Object.values(window.GOOGLE_SELECTED_ENTITIES),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#google-entitiy-connect-btn').html('Connect');
                    window.location.href = "{{ route('socials.index') }}";
                }
            });
        }

    </script>
@endpush

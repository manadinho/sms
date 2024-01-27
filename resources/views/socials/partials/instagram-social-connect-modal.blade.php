<div id="instagram-modal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Instagram Accounts</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="instagram-accounts-draw-section" class="mt-4 modal-social-entities-listing-section"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="instagram-entitiy-connect-btn" onclick="doInstaConnect()">Connect</button>
      </div>
    </div>
  </div>
</div>
@push('script')
    <script>

        $('#instagram-modal').on('show.bs.modal', function (event) {
            fetchInstaEntitiesAccounts();
        });

        window.INSTA_SELECTED_ENTITIES = {};

        function fetchInstaEntitiesAccounts() {
           
            if (window.CONNECTSTATUS !== null && window.CONNECTSTATUS === 'true') {
                window.INSTA_SELECTED_ENTITIES = {};
                $('#instagram-entitiy-connect-btn').html('Connect');
                $('#instagram-accounts-draw-section').html(getLoaderComponent());
                $.ajax({
                    url: "{{ route('socials.search-entities') }}",
                    method: 'POST',
                    data: {
                        provider: 'INSTAGRAM',
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#instagram-accounts-draw-section').html(response.html);
                        $('#instagram-accounts-draw-section').find('.entity-active').each(function(index, element) {
                            window.INSTA_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
                        });
                    }
                });
            }
        }
        
        function toggleInstagramEntity(element) {
            if($(element).data('entity').id in window.INSTA_SELECTED_ENTITIES) {
                delete window.INSTA_SELECTED_ENTITIES[$(element).data('entity').id];
            } else {
                window.INSTA_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
            }

            $('#instagram-entitiy-connect-btn').html('Connect ' + Object.keys(window.INSTA_SELECTED_ENTITIES).length);
            $(element).toggleClass('entity-active');
        }

        function doInstaConnect() {
            console.log('===here');
            if(!Object.keys(window.INSTA_SELECTED_ENTITIES).length) {
                alert('Please select at least one ');
                return;
            }

            $('#instagram-entitiy-connect-btn').html('Connecting...');
            $('#instagram-entitiy-connect-btn').attr('disabled', true);
            $.ajax({
                url: "{{ route('socials.connect-entities') }}",
                method: 'POST',
                data: {
                    provider: 'INSTAGRAM',
                    entities: Object.values(window.INSTA_SELECTED_ENTITIES),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#instagram-entitiy-connect-btn').html('Connect');
                    window.location.href = "{{ route('socials.index') }}";
                }
            });
        }

    </script>
@endpush

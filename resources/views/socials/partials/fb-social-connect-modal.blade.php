<div id="facebook-modal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Facebook Pages/Groups</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="pages-connect-buttons-section">
            <button class="page-connect-button" onclick="fetchFacebookEntitiesByType(this, 'pages')">
                <img src="{{ asset('/images/on-board-fb_page.svg') }}" alt="">
                <div class="text">Pages</div>
            </button>
            <button class="page-connect-button" onclick="fetchFacebookEntitiesByType(this, 'groups')">
                <img src="{{ asset('/images/on-board-fb_group.svg') }}" alt="">
                <div class="text">Groups</div>
            </button>
        </div>
        <div id="pages-or-groups" class="mt-4 modal-social-entities-listing-section"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="fb-entitiy-connect-btn" onclick="doFbConnect()">Connect</button>
      </div>
    </div>
  </div>
</div>
@push('script')
    <script>
        window.FB_ENTITY_TYPE = null;
        window.FB_SELECTED_ENTITIES = {};

        function fetchFacebookEntitiesByType(element, type) {
            $('.page-connect-button').removeClass('page-connect-button-active');
            $(element).addClass('page-connect-button-active');

            if (window.CONNECTSTATUS !== null && window.CONNECTSTATUS === 'true') {
                window.FB_ENTITY_TYPE = type;
                window.FB_SELECTED_ENTITIES = {};
                $('#fb-entitiy-connect-btn').html('Connect');
                $('#pages-or-groups').html(getLoaderComponent());
                $.ajax({
                    url: "{{ route('socials.search-entities') }}",
                    method: 'POST',
                    data: {
                        provider: 'FACEBOOK',
                        type,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#pages-or-groups').html(response.html);
                        $('#pages-or-groups').find('.entity-active').each(function(index, element) {
                            window.FB_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
                        });
                    }
                });
            }
        }

        function toggleFbEntity(element) {
            if($(element).data('entity').id in window.FB_SELECTED_ENTITIES) {
                delete window.FB_SELECTED_ENTITIES[$(element).data('entity').id];
            } else {
                window.FB_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
            }

            $('#fb-entitiy-connect-btn').html('Connect ' + Object.keys(window.FB_SELECTED_ENTITIES).length + ' ' + window.FB_ENTITY_TYPE);
            $(element).toggleClass('entity-active');
        }

        function doFbConnect() {
            if(!Object.keys(window.FB_SELECTED_ENTITIES).length) {
                alert('Please select at least one ' + window.FB_ENTITY_TYPE);
                return;
            }

            $('#fb-entitiy-connect-btn').html('Connecting...');
            $('#fb-entitiy-connect-btn').attr('disabled', true);
            $.ajax({
                url: "{{ route('socials.connect-entities') }}",
                method: 'POST',
                data: {
                    provider: 'FACEBOOK',
                    type: window.FB_ENTITY_TYPE,
                    entities: Object.values(window.FB_SELECTED_ENTITIES),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#fb-entitiy-connect-btn').html('Connect');
                    window.location.href = "{{ route('socials.index') }}";
                }
            });
        }

    </script>
@endpush

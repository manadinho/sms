<div id="linkedin-modal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">LinedIn Accounts/Organisations</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="pages-connect-buttons-section">
            <button class="page-connect-button" onclick="fetchLinkedinEntitiesByType(this, 'account')">
                <img src="{{ asset('/images/linkedin.svg') }}" alt="">
                <div class="text">Accounts</div>
            </button>
            <button class="page-connect-button" onclick="fetchLinkedinEntitiesByType(this, 'organisation')">
                <img src="{{ asset('/images/linkedin.svg') }}" alt="">
                <div class="text">Organisations</div>
            </button>
        </div>
        <div id="linkedin-accounts-organisation" class="mt-4 modal-social-entities-listing-section"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="linkedin-entitiy-connect-btn" onclick="doLinkedinConnect()">Connect</button>
      </div>
    </div>
  </div>
</div>
@push('script')
    <script>
        window.LINKEDIN_ENTITY_TYPE = null;
        window.LINKEDIN_SELECTED_ENTITIES = {};

        function fetchLinkedinEntitiesByType(element, type) {
            $('.page-connect-button').removeClass('page-connect-button-active');
            $(element).addClass('page-connect-button-active');

            if (window.CONNECTSTATUS !== null && window.CONNECTSTATUS === 'true') {
                window.LINKEDIN_ENTITY_TYPE = type;
                window.LINKEDIN_SELECTED_ENTITIES = {};
                $('#linkedin-entitiy-connect-btn').html('Connect');
                $('#linkedin-accounts-organisation').html(getLoaderComponent());
                $.ajax({
                    url: "{{ route('socials.search-entities') }}",
                    method: 'POST',
                    data: {
                        provider: 'LINKEDIN',
                        type,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#linkedin-accounts-organisation').html(response.html);
                        $('#linkedin-accounts-organisation').find('.entity-active').each(function(index, element) {
                            window.LINKEDIN_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
                        });
                    }
                });
            }
        }

        function toggleLinkedinEntity(element) {
            console.log('===,',$(element).data('entity'));
            if($(element).data('entity').id in window.LINKEDIN_SELECTED_ENTITIES) {
                delete window.LINKEDIN_SELECTED_ENTITIES[$(element).data('entity').id];
            } else {
                window.LINKEDIN_SELECTED_ENTITIES[$(element).data('entity').id] = $(element).data('entity');
            }

            $('#linkedin-entitiy-connect-btn').html('Connect ' + Object.keys(window.LINKEDIN_SELECTED_ENTITIES).length + ' ' + window.LINKEDIN_ENTITY_TYPE);
            $(element).toggleClass('entity-active');
        }

        function doLinkedinConnect() {
            if(!Object.keys(window.LINKEDIN_SELECTED_ENTITIES).length) {
                alert('Please select at least one ' + window.LINKEDIN_ENTITY_TYPE);
                return;
            }

            $('#linkedin-entitiy-connect-btn').html('Connecting...');
            $('#linkedin-entitiy-connect-btn').attr('disabled', true);
            $.ajax({
                url: "{{ route('socials.connect-entities') }}",
                method: 'POST',
                data: {
                    provider: 'LINKEDIN',
                    type: window.LINKEDIN_ENTITY_TYPE,
                    entities: Object.values(window.LINKEDIN_SELECTED_ENTITIES),
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#linkedin-entitiy-connect-btn').html('Connect');
                    window.location.href = "{{ route('socials.index') }}";
                }
            });
        }

    </script>
@endpush

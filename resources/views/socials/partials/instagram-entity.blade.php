<div class="d-flex flex-row gap-2 border rounded p-2 mb-2 c-pointer {{ (in_array($entity['id'],$connectedSocials)) ? 'entity-active':'' }}" style="cursor: pointer;" data-entity='@json($entity)' onclick="toggleInstagramEntity(this)">
    <div class="align-self-center">
        <img src="{{ $entity['instagram_business_account']['profile_picture_url'] ??  asset('/images/instagram.svg') }}" style="width: 50px;">
    </div>
    <div class="align-self-center">
        <span class="weight-500">{{$entity['instagram_business_account']['username']}}</span>
    </div>
</div>
